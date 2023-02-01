<?php

namespace Tests\Unit\Repository\Eloquent;

use App\Repository\Eloquent\CalendarRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalendarRepositoryTest extends TestCase
{
    use WithFaker, RefreshDatabase;



    /** @test */
    public function if_client_discount_and_net_discount_are_null()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $getDiscount = new CalendarRepository();

        $hotel = factory('App\Hotel')->make([
            'net_discount' => null,
            'client_discount' => null,
        ]);

        $structure = $getDiscount->getDiscountHotel($hotel);

        $expected = [
            'discount_net' => 1,
            'discount_client' => 1,
        ];

        $this->assertEquals($structure, $expected);
    }
    /** @test */
    public function if_client_discount_is_not_null_and_net_discount_is_null()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $getDiscount = new CalendarRepository();

        $hotel = factory('App\Hotel')->make([
            'net_discount' => null,
            'client_discount' => 25,
        ]);

        $structure = $getDiscount->getDiscountHotel($hotel);

        $expected = [
            'discount_net' => 1,
            'discount_client' => (100 - $hotel->client_discount) / 100
        ];

        $this->assertEquals($structure, $expected);
    }
    /** @test */
    public function if_client_discount_is_null_and_net_discount_is_not_null()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $getDiscount = new CalendarRepository();

        $hotel = factory('App\Hotel')->make([
            'net_discount' => 25,
            'client_discount' => null,
        ]);

        $structure = $getDiscount->getDiscountHotel($hotel);

        $expected = [
            'discount_net' => (100 - $hotel->net_discount) / 100,
            'discount_client' => 1
        ];

        $this->assertEquals($structure, $expected);
    }

    /** @test */
    public function if_client_discount_is_not_null_and_net_discount_is_not_null()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $getDiscount = new CalendarRepository();

        $hotel = factory('App\Hotel')->make([
            'net_discount' => 25,
            'client_discount' => 35,
        ]);

        $structure = $getDiscount->getDiscountHotel($hotel);

        $expected = [
            'discount_net' => (100 - $hotel->net_discount) / 100,
            'discount_client' => (100 - $hotel->client_discount) / 100
        ];

        $this->assertEquals($structure, $expected);
    }

    /** @test */
    public function the_crud_returns_empty_if_there_are_no_periods()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $hotel = factory('App\Hotel')->create();
        $discount = factory('App\PackageDiscounts')->create([
            'hotel_id' => $hotel->id,
            'discount_net' => 25,
            'discount_client' => 30,
            'date_start' => "2021-05-18",
            'date_end' => "2021-05-30"
        ]);

        $checkin = "2021-06-19";
        $checkout = "2021-06-22";

        $getDiscount = new CalendarRepository();
        $discountCrud = $getDiscount->getDiscountPackage($hotel, $checkin, $checkout);

        $expected = [];

        $this->assertEquals($discountCrud, $expected);
    }

    /** @test */
    public function if_the_crud_exists_and_the_checkin_and_checkout_interval_is_between_the_date_start_data_end_interval()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $getDiscount = new CalendarRepository();

        $hotel = factory('App\Hotel')->create();
        $discount = factory('App\PackageDiscounts')->create([
            'hotel_id' => $hotel->id,
            'discount_net' => 25,
            'discount_client' => 30,
            'date_start' => "2021-05-18",
            'date_end' => "2021-05-30"
        ]);

        $checkin = "2021-05-19";
        $checkout = "2021-05-22";

        $discountCrud = $getDiscount->getDiscountPackage($hotel, $checkin, $checkout);

        $expected = [
            "discount_net" => 0.75,
            "discount_client" => 0.7
        ];

        $this->assertEquals($discountCrud, $expected);
    }

    /** @test */
    public function if_the_crud_exists_and_the_checkin_and_checkout_interval_is_between_the_date_start_data_end_interval_and_have_more_than_a_period_()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $getDiscount = new CalendarRepository();

        $hotel = factory('App\Hotel')->create();
        factory('App\PackageDiscounts')->create([
            'hotel_id' => $hotel->id,
            'discount_net' => 25,
            'discount_client' => 30,
            'date_start' => "2021-05-18",
            'date_end' => "2021-05-25"
        ]);
        factory('App\PackageDiscounts')->create([
            'hotel_id' => $hotel->id,
            'discount_net' => 10,
            'discount_client' => 15,
            'date_start' => "2021-05-25",
            'date_end' => "2021-05-27"
        ]);
        factory('App\PackageDiscounts')->create([
            'hotel_id' => $hotel->id,
            'discount_net' => 15,
            'discount_client' => 15,
            'date_start' => "2021-05-28",
            'date_end' => "2021-05-31"
        ]);

        $checkin = "2021-05-19";
        $checkout = "2021-05-22";

        $discountCrud = $getDiscount->getDiscountPackage($hotel, $checkin, $checkout);

        $expected = [
            "discount_net" => 0.8333333333333333,
            "discount_client" => 0.8
        ];

        $this->assertEquals($discountCrud, $expected);
    }

    /** @test */
    public function if_in_getTotalDiscounts_find_the_crud_empty()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $getDiscount = new CalendarRepository();

        $hotel = factory('App\Hotel')->create([
            'net_discount' => 15,
            'client_discount' => 10
        ]);
        $discount = factory('App\PackageDiscounts')->create([
            'hotel_id' => $hotel->id,
            'discount_net' => 25,
            'discount_client' => 30,
            'date_start' => "2021-04-18",
            'date_end' => "2021-04-30"
        ]);

        $checkin = "2021-05-19";
        $checkout = "2021-05-22";

        $discountCrud = $getDiscount->getTotalDiscounts($hotel, $checkin, $checkout);

        $expected = [
            'discount_net' => (100 - ($hotel->net_discount)) / 100,
            'discount_client' => (100 - ($hotel->client_discount)) / 100
        ];

        $this->assertEquals($discountCrud, $expected);
    }
}
