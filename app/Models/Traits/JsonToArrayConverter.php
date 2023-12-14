<?php

namespace App\Models\Traits;

trait JsonToArrayConverter
{
    /**
     * @param string $value
     * @param string $key
     * @return array
     */
    public function convertFreeOptionInputToArray(string $value, string $key): array
    {
        $optionInput = json_decode($value, true);
        
        return collect($optionInput)->filter(
            function ($value) use ($key) {
                return isset($value[$key]);
            }
        )
        ->pluck($key, 'opt_ids')
        ->toArray();
    }
}
