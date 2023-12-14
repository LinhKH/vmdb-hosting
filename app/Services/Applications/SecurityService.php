<?php

namespace App\Services\Applications;

use App\Enums\StatusYN;
use App\Services\Util as ServicesUtil;
use App\Models\TAdmin;
use PSpell\Config;

class SecurityService
{
    public const CRYPTO_METHOD = 'des-ede3';
    public function checkIPAddress(TAdmin $admin, string $ipAddress): bool
    {
        if ($admin->ip_use_yn === StatusYN::NO) {
            return true;
        }

        $ips = explode("\n", $admin->login_ips);
        foreach ($ips as $ip) {
            if (empty($ip)) {
                continue;
            }
            
            if (ServicesUtil::isNetworkRangeText($ip)) {
                if (ServicesUtil::isIPAddressInNetworkRange($ipAddress, $ip)) {
                    return true;
                }
            } elseif (ServicesUtil::isSameIPAddress($ipAddress, $ip)) {
                return true;
            }
        }
        $this->updateErrorLoginIp($admin, $ipAddress);
        return false;
    }

    /**
     * @param TAdmin $admin
     * @param string $ipAddress
     * @return bool
     */
    private function updateErrorLoginIp(TAdmin $admin, string $ipAddress): bool
    {
        $admin->error_login_ip = $ipAddress;
        return $admin->save();
    }


    /**
     * 暗号化処理
     *
     * 暗号化したデータはDB保存など外部での取り回しを意識してbase64_encode()でエンコードしたものを返す
     *
     * @param string $plain_text 暗号化したい文字列
     * @return string 暗号化されたデータ(base64_encode()済み)
     * @throws \Exception
     */
    public static function encrypt(string $plain_text): string
    {
        return base64_encode(
            openssl_encrypt(
                self::pkcs5Padding($plain_text),
                self::CRYPTO_METHOD,
                config('app.crypto_key'),
                OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING
            )
        );
    }

    /**
     * 復号処理
     *
     * @param string $encrypted_text 復号したいデータ (16進数表記されたもの)
     * @return string 復号された文字列
     * @throws \Exception
     */
    public static function decrypt(string $encrypted_text): string
    {
        return self::pkcs5Suppress(
            openssl_decrypt(
                base64_decode($encrypted_text),
                self::CRYPTO_METHOD,
                config('app.crypto_key'),
                OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING
            )
        );
    }

    /**
     * 初期化ベクトルを取得
     *
     * 外部から初期化ベクトルが与えられていない場合、ここでランダムな初期化ベクトルを生成して返す
     *
     * @return string 初期化ベクトル
     * @throws \Exception
     */
    private static function getInitialVector(): string
    {
        return openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::CRYPTO_METHOD));
    }

    /**
     * パディング処理
     *
     * 暗号化方式で指定されているブロックサイズに合わせて文字列を埋める
     *
     * @param string $text 対象文字列
     * @return string パディング済みの文字列
     * @throws \Exception
     */
    private static function pkcs5Padding(string $text): string
    {
        $block_size = self::opensslCipherBlockLength();
        $pad = $block_size - (strlen($text) % $block_size);
        return $text . str_repeat(chr($pad), $pad);
    }

    /**
     * サプレス処理
     *
     * 暗号化の際にブロックサイズ調整で埋められた文字を取り除く
     *
     * @param string $text 対象文字列
     * @return string ブロックサイズ調整文字を取り除いた文字列
     */
    private static function pkcs5Suppress(string $text): string
    {
        $pad = ord($text[strlen($text)-1]);
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;
        }
        return substr($text, 0, strpos($text, chr($pad)));
    }

    /**
     * 暗号化方式が指定するブロック長を算出
     *
     * @return int 暗号化方式が指定しているブロック長
     */
    private static function opensslCipherBlockLength(): int
    {
        $ivSize = openssl_cipher_iv_length(self::CRYPTO_METHOD);

        // サポートしていない暗号化方式だった
        if ($ivSize === false) {
            return false;
        }

        $iv = str_repeat("a", $ivSize);

        // 1バイトから1024バイトまで順に暗号化可能なブロック長を試していく
        for ($size = 1; $size < 1024; $size++) {
            $output = openssl_encrypt(
                str_repeat("a", $size),
                self::CRYPTO_METHOD,
                "a",
                OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
                $iv
            );

            if ($output !== false) {
                return $size;
            }
        }

        return false;
    }
}
