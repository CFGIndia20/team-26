<?php

use Illuminate\Database\Seeder;

class DonorUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\DonorUnit::class, rand(10, 20))->create();
    }
}
