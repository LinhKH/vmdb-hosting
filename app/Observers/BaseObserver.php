<?php

namespace App\Observers;

namespace App\Observers;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BaseObserver
{
  //

  public function updating(BaseModel $model)
  {
    $model->update_time = Carbon::now()->toDateTimeString();
  }

  public function creating(BaseModel $model)
  {
    $model->create_time = Carbon::now()->toDateTimeString();
  }

  public function saving(BaseModel $model)
  {
    $secret_column = config('tablesecret');
    $secret_key = config('app.secret_key');
    $table = $model->getTable();
    if (isset($secret_column[$table])) {
      foreach ($model->getAttributes() as $key => $value) {
        if (in_array($key, $secret_column[$table])) {
          $value = DB::getPdo()->quote($value);
          $model->$key = DB::raw("AES_ENCRYPT($value, '$secret_key')");
        }
      }
    }
  }
}
