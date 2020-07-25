<?php

use Illuminate\Database\Seeder;

class ExtraQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ExtraQuestion::class, rand(10, 20))->create();
    }
}
