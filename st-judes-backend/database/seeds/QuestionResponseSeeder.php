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
        foreach (\App\Patient::all() as $patient){
            foreach (\App\Question::all() as $question) {
                factory(\App\QuestionResponse::class, rand(10, 20))->create([
                        'question_id' => $question->id,
                        'patient_id' => $patient->id,
                    ]);
            }
        }
    }
}
