<?php

namespace App\Services\Statistics;

use App\Models\Image;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StatisticService
{
    public function getNumberOfTotalUsers(Carbon|null $timeFrom = null, Carbon|null $timeTo = null){
        return User::query()
            ->when(!is_null($timeFrom), fn(Builder $q) => $q->whereDate("created_at", ">=", $timeFrom))
            ->when(!is_null($timeTo), fn(Builder $q) => $q->whereDate("created_at", "<=", $timeTo))
            ->count();
    }

    public function getNumberOfTotalImages(Carbon|null $timeFrom = null, Carbon|null $timeTo = null){
        return Image::query()
            ->when(!is_null($timeFrom), fn(Builder $q) => $q->whereDate("created_at", ">=", $timeFrom))
            ->when(!is_null($timeTo), fn(Builder $q) => $q->whereDate("created_at", "<=", $timeTo))
            ->count();
    }
}
