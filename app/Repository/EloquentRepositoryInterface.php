<?php
namespace App\Repository;

use App\Hotel;

interface EloquentRepositoryInterface
{
    public function getActivePromotions($promotions, $actv, $date);
    public function getAccommodationPromotions($promotions, $act, $date);
    public function getHotelCalendar(Hotel $hotel);
    public function updateHotelCalendar(Hotel $hotel);
    public function validateStay(Hotel $hotel, $checkin, $checkout, $occupation);
    public function validateMinStay($checkin, $checkout, $min_stay);
    public function validateStockAndStopSales($calendar, $occupation, $checkin, $checkout);
    public function getStopSales($calendar, $accommodations_id, $date);
    public function calculatePrices(Hotel $hotel, $checkin, $checkout, $occupation);
    public function getAttributeMagento($attribute_code, $allData);
    public function checkHotelMagento($bookerId);
}
