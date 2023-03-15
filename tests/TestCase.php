<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Src\ClientRepository;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null)
    {
    	$user = $user ?: factory('App\User')->create();
		$this->actingAs($user);
		$this->artisan('db:seed');
		$this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
		Passport::actingAs(
		    $user
		);
    }
}
