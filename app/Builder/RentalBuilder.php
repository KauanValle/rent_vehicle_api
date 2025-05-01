<?php

namespace App\Builder;

use App\Models\Rental;
use Carbon\Carbon;

class RentalBuilder
{
    private $rental;

    public function withModel(Rental $rental): self
    {
        $this->rental = $rental;
        return $this;
    }

    public function setStartDate(): self
    {
        $this->rental->start_date = now();
        return $this;
    }

    public function setEndDate(): self
    {
        $this->rental->end_date = now();
        return $this;
    }

    public function setTotalValue(): self
    {
        $days = $this->calculateDifferenceInDays($this->rental->end_date, $this->rental->start_date);
        $days = $days == 0 ? $days + 1 : $days;
        $totalValue = $days * $this->rental->vehicle->daily_rate;
        $this->rental->total_amount = $totalValue;
        return $this;
    }

    public function build(): Rental
    {
        return $this->rental;
    }

    private function calculateDifferenceInDays($endDate, $startDate)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        return $startDate->diffInDays($endDate);
    }
}
