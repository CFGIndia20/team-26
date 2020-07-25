<?php

use Illuminate\Database\Seeder;

class QuestionResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\QuestionResponse::class, rand(10, 20))->create();
    }
}
