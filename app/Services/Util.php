<?php

namespace App\Services;

class Util
{
    public static function convertBlankToNull($argument)
    {
        if (is_array($argument)) {
            foreach ($argument as $k => $item) {
                if (!is_array($item) && $item === '') {
                    $argument[$k] = null;
                }
            }
        } else {
            if ($argument === '') {
                $argument = null;
            }
        }
        return $argument;
    }
    
    /**
     * @param string $text
     * @return bool
     */
    public static function isNetworkRangeText(string $text): bool
    {
        $components = explode('/', $text);
        if (count($components) !== 2) {
            return false;
        }
        [$net, $mask] = $components;
        return self::isValidIPAddress($net) && self::isValidIPAddress($mask);
    }

    /**
     * @param string $ipAddressA
     * @param string $ipAddressB
     * @return bool
     */
    public static function isSameIPAddress(string $ipAddressA, string $ipAddressB): bool
    {
        if (!self::isValidIPAddress($ipAddressA) || !self::isValidIPAddress($ipAddressB)) {
            return false;
        }
        return self::ip2bit($ipAddressA) === self::ip2bit($ipAddressB);
    }

    /**
     * @param string $ipAddress
     * @param string $networkRange
     * @return bool
     */
    public static function isIPAddressInNetworkRange(string $ipAddress, string $networkRange): bool
    {
        [$net, $mask] = explode('/', $networkRange);
        if (!self::isValidIPAddress($ipAddress) || !self::isValidIPAddress($net) || !self::isValidIPAddress($mask)) {
            return false;
        }
        $ipAddressBit = self::ip2bit($ipAddress);
        $netBit  = self::ip2bit($net);
        $maskBit = self::ip2bit($mask);
        return ($ipAddressBit & $maskBit) === ($netBit & $maskBit);
    }

    /**
     * @param string $src
     * @return bool
     */
    private static function isValidIPAddress(string $src): bool
    {
        return filter_var($src, FILTER_VALIDATE_IP);
    }

    private static function ip2bit(string $src): int
    {
        $x = array_map(static function ($addr) {
            return (int) $addr;
        }, explode('.', $src));
        return ($x[0] << 24) | ($x[1] << 16) | ($x[2] << 8) | $x[3];
    }
}
