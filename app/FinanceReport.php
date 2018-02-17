<?php

namespace App;

use Carbon\Carbon;

interface FinanceReport
{
    /**
     * @param string $symbol
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return mixed
     */
    public function report(string $symbol, Carbon $startDate, Carbon $endDate);
}