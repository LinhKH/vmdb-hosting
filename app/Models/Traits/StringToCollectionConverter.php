<?php

namespace App\Models\Traits;

use \Illuminate\Support\Collection;

trait StringToCollectionConverter
{
    /**
     * @param  string $commaSeparatedString
     * @return Collection
     */
    public function convertCommaSeparatedToCollection($commaSeparatedString): Collection
    {
        return collect(explode(',', $commaSeparatedString))->reject('');
    }
}
