<?php
namespace App\ValueObjects;

use Illuminate\Support\Carbon;

/**
 * Class PasswordResetExpirationDate
 * @package App\ValueObjects\Password
 */
class PasswordResetExpirationDate
{
    const REMINDER_LIMIT = 24; 

    const DESCRIPTION = self::REMINDER_LIMIT."時間";

    private $startDate;

    private $endDate;

    public function __construct(Carbon $startDate)
    {
        $this->startDate = new Carbon($startDate);
        $this->endDate = $this->endDate($startDate);
    }

    /**
     * @param Carbon $startDate
     * @return Carbon
     */
    private function endDate(Carbon $startDate): Carbon
    {
        return $startDate->addHours(self::REMINDER_LIMIT);
    }

    /**
     * @return bool
     */
    public function canResetting(): bool
    {
        $currentTime = Carbon::now();
        return $currentTime->gte($this->startDate) && $currentTime->lte($this->endDate);
    }
}
