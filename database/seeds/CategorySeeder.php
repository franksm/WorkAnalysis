<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $DB=DB::table('vacancy_categories');
        $DB->insert([
            'vacancy_category'=>'軟體工程師'
        ]);
        $DB->insert([
            'vacancy_category'=>'行政人員'
        ]);
    }
}
