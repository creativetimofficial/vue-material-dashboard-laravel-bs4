<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use App\Occupations;
use App\Hotel;
use App\Accommodations;
use App\Dates;
use App\Http\Resources\Promotion as PromotionResource;
use App\Http\Resources\Occupation as OccupationResource;
use App\Repository\Eloquent\CalendarRepository;
use App\Repository\Eloquent\PromotionRepository;
use DateTime;
use Illuminate\Support\Facades\Cache;
use Grayloon\Magento\Magento;

class BaseRepository implements EloquentRepositoryInterface
{
    public function teste()
    {
        return "teste";
    }
}
