<?php

use App\User;
use Illuminate\Database\Seeder;

class DonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::where('role_id', 1)->get() as $user){
            factory(\App\Donor::class)->create(['user_id'=>$user->id]);
        }
    }
}
