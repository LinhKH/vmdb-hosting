<?php

namespace App\Models\Traits;

use App\Enums\PlaceType;

trait DeliveryFreePlaces
{
    /**
     * @param PlaceType|null $placeType
     * @return bool
     */
    public function isInDeliveryFreePlaces($placeType): bool
    {
        if ($placeType === null) {
            return false;
        }

        return in_array($placeType->value, $this->postage_receive_free_places);
    }
}
