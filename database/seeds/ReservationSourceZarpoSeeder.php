<?php

use Illuminate\Database\Seeder;

class ReservationSourceZarpoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservation_sources')->insert([
            'id_magento' => 0,
            'name' => 'Zarpo',
            'website_magento' => 2,
            'sort_order' => 1,
            'commission_percentage' => 0,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
