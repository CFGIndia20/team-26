<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(CentreSeeder::class);
         $this->call(PatientSeeder::class);
         $this->call(DonorSeeder::class);
         $this->call(UnitSeeder::class);
         $this->call(QuestionSeeder::class);
         $this->call(QuestionResponseSeeder::class);
         $this->call(ExtraQuestionSeeder::class);
        $this->call(ContributionSeeder::class);
        $this->call(DonorUnitSeeder::class);

    }
}
