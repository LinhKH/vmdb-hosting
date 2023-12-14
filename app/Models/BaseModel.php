<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeActive(Builder $query): void
    {
        $query->where('del_flg', '0');
    }

    public function scopeNormal($query)
    {
        return $query->where('status', '=', 'N');
    }

    protected $encryptedColumns = [];

    // add select query
    public function newQuery(): Builder
    {
        $query = parent::newQuery();
        return $query->select($this->addDecryptCols($this->encryptedColumns));
    }

    public function addDecryptCols(?array $encryptedColumns): array
    {
        $columns = ['*'];
        if (isset($encryptedColumns)) {
            foreach ($encryptedColumns as $encryptedColumn) {
                $columns[] = DB::raw("AES_DECRYPT({$encryptedColumn}, '" . config('app.mysql_aes_crypto_key') . "') AS {$encryptedColumn}");
            }
        }
        return $columns;
    }

    public function addEncryptCols(?string $value)
    {
        $val = $value ?? '';
        if (!is_null($val)) {
            $escaped = DB::connection()->getPDO()->quote($val);
            return DB::raw("AES_ENCRYPT(". $escaped . ", '" . config('app.mysql_aes_crypto_key') . "')");
        } else {
            return null;
        }
    }


    public function setAttribute($key, $value){
        if(in_array($key, $this->encryptedColumns)){
            $this->attributes[$key] = $this->addEncryptCols($value);
            return $this;
        }
        return parent::setAttribute($key, $value);
    }



}
