<?php

namespace App\Models\Traits;

use App\Enums\ZeroDay;

/**
 * Modelクラスの$datesに定義したプロパティへ 0000-00-00 00:00:00 の日付けを設定しようとすると
 * -0001-11-30 といった存在しない日付けに変わってしまう。
 * さらに取得する際は、-0001-11-30だとCarbonへ変換出来ずに例外が発生する。
 * VMDBでは日付け型のデフォルト値を0000-00-00として扱っているため、更新処理の途中で意図せず例外が発生する等不都合が多い。
 * 対策として、-0001-11-30へ変換される原因となるメソッドをオーバーライドして、0000-00-00を変換せずそのまま通過させるようにする。
 */
trait ThroughZeroDate
{
    /**
     * @see \Illuminate\Database\Eloquent\Concerns\HasAttributes::fromDateTime() を参照
     */
    public function fromDateTime($value)
    {
        return $value === ZeroDay::DATETIME || $value === ZeroDay::DATE
            ? ZeroDay::DATETIME
            : parent::fromDateTime($value);
    }
}
