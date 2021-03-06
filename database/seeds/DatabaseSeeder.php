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
        $this->call(CategorySeeder::class);
        $this->call(ToolSeeder::class);
        $this->call(VacancySeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(VacancyCategoryTagSeeder::class);
        $this->call(VacancyToolTagSeeder::class);
    }
}
