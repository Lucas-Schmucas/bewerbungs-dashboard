<?php

namespace App\Services;

use Carbon\Carbon;

class InterviewDate
{
    private Carbon $interviewDate;
    public function __construct(string $interviewDate)
    {
        $this->interviewDate = new Carbon($interviewDate);
    }

    public function readable() : string
    {
        return $this->interviewDate->format('d.m.Y');
    }

    public function timeLeft() : string
    {
        return $this->interviewDate->diffForHumans();
    }
}
