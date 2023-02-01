<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\SettingsRepositoryInterface;
use Illuminate\Http\Request;
use App\Hotel;
use App\Jobs\SyncMagento;

class SettingsController extends Controller
{
    private $settingsRepository;
  
    public function __construct(SettingsRepositoryInterface $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function index()
    {
        return $this->settingsRepository->index();
    }

    public function store(Request $request)
    {
        return $this->settingsRepository->store($request);
    }


    public function show()
    {
        return view('settings.show');
    }

    public function testSync()
    {
        return $this->settingsRepository->testSync();
    }
}
