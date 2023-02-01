<?php

namespace App\Http\Controllers;

use App\Exports\HotelExport;
use App\Exports\HotelsExport;
use Illuminate\Http\Request;
use App\Repository\HotelRepositoryInterface;
use App\Http\Requests\HotelsRequest;
use App\Hotel;
use Maatwebsite\Excel\Facades\Excel;
use App\Repository\MagentoRepositoryInterface;
use App\Jobs\SendCsvAccommodations;

class HotelController extends Controller
{
    private $hotelRepository;
    protected $magentoRepository;

    public function __construct(HotelRepositoryInterface $hotelRepository, MagentoRepositoryInterface $magentoRepository)
    {
        $this->hotelRepository = $hotelRepository;
        $this->magentoRepository = $magentoRepository;
    }

    public function index()
    {
        return view('hotel.index');
    }

    public function getHotels(Request $request)
    {
        return $this->hotelRepository->getHotels($request);
    }

    public function getHotel(Hotel $hotel)
    {
        return $this->hotelRepository->show($hotel);
    }

    public function getReservationsHotel(Request $request, Hotel $hotel)
    {
        return $this->hotelRepository->getReservationsHotel($request, $hotel);
    }

    public function store(HotelsRequest $request)
    {
        $this->hotelRepository->create($request);
        return view('hotel.index');
    }

    public function destroy(Hotel $hotel)
    {
        return $this->hotelRepository->destroy($hotel);
    }

    public function create()
    {
        return view('hotel.create');
    }

    public function show(Hotel $hotel)
    {
        return view('hotel.show', compact('hotel'));
    }

    public function edit(Hotel $hotel)
    {
        $this->hotelRepository->update($hotel);
        return $hotel;
    }

    public function syncMagento(Hotel $hotel)
    {
        return $this->magentoRepository->sync($hotel);
    }
    public function sendCsvAccommodations(Hotel $hotel, Request $request)
    {
        /*
            Toda o envio de CSV deverá rodar via job, assim não comprometemos a API do Booker
        */
        $data = [
            "hotel" => $hotel,
            "file" => Excel::toCollection(collect([]), $request->file('file')),
            "data" => $request['data']
        ];
        SendCsvAccommodations::dispatch($data);
        return [
            "code" => 200,
            "message" => "Success"
        ];
    }
}
