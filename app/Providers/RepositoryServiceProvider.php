<?php

namespace App\Providers;

use App\Repository\EloquentRepositoryInterface;
use App\Repository\HotelRepositoryInterface;
use App\Repository\Eloquent\HotelRepository;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\RateRepositoryInterface;
use App\Repository\Eloquent\RateRepository;
use App\Repository\RoomRepositoryInterface;
use App\Repository\Eloquent\RoomRepository;
use App\Repository\AccommodationRepositoryInterface;
use App\Repository\ActivityLogRepositoryInterface;
use App\Repository\Eloquent\AccommodationRepository;
use App\Repository\OccupationRepositoryInterface;
use App\Repository\Eloquent\OccupationRepository;
use App\Repository\PromotionRepositoryInterface;
use App\Repository\Eloquent\PromotionRepository;
use App\Repository\TaxRepositoryInterface;
use App\Repository\Eloquent\TaxRepository;
use App\Repository\PackageDiscountRepositoryInterface;
use App\Repository\Eloquent\PackageDiscountRepository;
use App\Repository\DatesRepositoryInterface;
use App\Repository\Eloquent\DatesRepository;
use App\Repository\ReservationRepositoryInterface;
use App\Repository\Eloquent\ReservationRepository;
use App\Repository\ReservationRoomRepositoryInterface;
use App\Repository\Eloquent\ReservationRoomRepository;
use App\Repository\ReservationExportRepositoryInterface;
use App\Repository\Eloquent\ReservationExportRepository;
use App\Repository\CalendarRepositoryInterface;
use App\Repository\Eloquent\ActivityLogRepository;
use App\Repository\Eloquent\CalendarRepository;
use App\Repository\MagentoRepositoryInterface;
use App\Repository\Eloquent\MagentoRepository;
use App\Repository\SettingsRepositoryInterface;
use App\Repository\Eloquent\SettingsRepository;
use App\Repository\ThematicTagsRepositoryInterface;
use App\Repository\Eloquent\ThematicTagsRepository;
use App\Repository\ReservationFlightRepositoryInterface;
use App\Repository\Eloquent\ReservationFlightRepository;
use App\Repository\ReservationGiftCardRepositoryInterface;
use App\Repository\Eloquent\ReservationGiftCardRepository;
use App\Repository\ReservationSourceRepositoryInterface;
use App\Repository\Eloquent\ReservationSourceRepository;
use App\Repository\OmniApiBaseRepositoryInterface;
use App\Repository\Eloquent\OmniApi\OmniApiBaseRepository;
use App\Repository\GetRatePlansRepositoryInterface;
use App\Repository\Eloquent\OmniApi\GetRatePlansRepository;
use App\Repository\GetRoomTypesRepositoryInterface;
use App\Repository\Eloquent\OmniApi\GetRoomTypesRepository;
use App\Repository\GetReservationsRepositoryInterface;
use App\Repository\Eloquent\OmniApi\GetReservationsRepository;
use App\Repository\UpdateRatesRepositoryInterface;
use App\Repository\Eloquent\OmniApi\UpdateRatesRepository;
use App\Repository\ReservationRelatoryRepositoryInterface;
use App\Repository\Eloquent\ReservationRelatoryRepository;
use App\Repository\HistoricModificationReservationRepositoryInterface;
use App\Repository\Eloquent\HistoricModificationReservationRepository;
use App\Repository\CurrencyRepositoryInterface;
use App\Repository\Eloquent\CurrencyRepository;
use App\Repository\RateErrorReportRepositoryInterface;
use App\Repository\Eloquent\RateErrorReportRepository;
use App\Repository\Eloquent\ReservationReportsRepository;
use App\Repository\ReservationReportsRepositoryInterface;
use App\Repository\CurrencyHistoricModificationRepositoryInterface;
use App\Repository\Eloquent\CurrencyHistoricModificationRepository;
use App\Repository\PartnerMarkupRepositoryInterface;
use App\Repository\Eloquent\PartnerMarkupRepository;
use App\Repository\ContactRepositoryInterface;
use App\Repository\Eloquent\ContactRepository;

/**
* Class RepositoryServiceProvider
* @package App\Providers
*/

class RepositoryServiceProvider extends ServiceProvider
{
   /**
    * Register services.
    *
    * @return void
    */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(HotelRepositoryInterface::class, HotelRepository::class);
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(AccommodationRepositoryInterface::class, AccommodationRepository::class);
        $this->app->bind(OccupationRepositoryInterface::class, OccupationRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class, PromotionRepository::class);
        $this->app->bind(TaxRepositoryInterface::class, TaxRepository::class);
        $this->app->bind(PackageDiscountRepositoryInterface::class, PackageDiscountRepository::class);
        $this->app->bind(DatesRepositoryInterface::class, DatesRepository::class);
        $this->app->bind(ReservationRepositoryInterface::class, ReservationRepository::class);
        $this->app->bind(ReservationRoomRepositoryInterface::class, ReservationRoomRepository::class);
        $this->app->bind(ReservationExportRepositoryInterface::class, ReservationExportRepository::class);
        $this->app->bind(CalendarRepositoryInterface::class, CalendarRepository::class);
        $this->app->bind(MagentoRepositoryInterface::class, MagentoRepository::class);
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->bind(ThematicTagsRepositoryInterface::class, ThematicTagsRepository::class);
        $this->app->bind(ReservationFlightRepositoryInterface::class, ReservationFlightRepository::class);
        $this->app->bind(ReservationGiftCardRepositoryInterface::class, ReservationGiftCardRepository::class);
        $this->app->bind(ReservationSourceRepositoryInterface::class, ReservationSourceRepository::class);
        $this->app->bind(OmniApiBaseRepositoryInterface::class, OmniApiBaseRepository::class);
        $this->app->bind(GetRatePlansRepositoryInterface::class, GetRatePlansRepository::class);
        $this->app->bind(GetRoomTypesRepositoryInterface::class, GetRoomTypesRepository::class);
        $this->app->bind(GetReservationsRepositoryInterface::class, GetReservationsRepository::class);
        $this->app->bind(UpdateRatesRepositoryInterface::class, UpdateRatesRepository::class);
        $this->app->bind(ReservationRelatoryRepositoryInterface::class, ReservationRelatoryRepository::class);
        $this->app->bind(HistoricModificationReservationRepositoryInterface::class, HistoricModificationReservationRepository::class);
        $this->app->bind(ActivityLogRepositoryInterface::class, ActivityLogRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(RateErrorReportRepositoryInterface::class, RateErrorReportRepository::class);
        $this->app->bind(ReservationReportsRepositoryInterface::class, ReservationReportsRepository::class);
        $this->app->bind(CurrencyHistoricModificationRepositoryInterface::class, CurrencyHistoricModificationRepository::class);
        $this->app->bind(PartnerMarkupRepositoryInterface::class, PartnerMarkupRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
    }
}
