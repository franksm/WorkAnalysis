<?php

use Illuminate\Database\Seeder;

class VacancyCategoryTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $DB=DB::table('vacancy_category_tags');
        # 工程
        $DB->insert([
            'vacancy_id'=>'1',
            'category_id'=>'1'
        ]);
        $DB->insert([
            'vacancy_id'=>'1',
            'category_id'=>'2'
        ]);
        $DB->insert([
            'vacancy_id'=>'1',
            'category_id'=>'3'
        ]);
        $DB->insert([
            'vacancy_id'=>'2',
            'category_id'=>'2'
        ]);
        $DB->insert([
            'vacancy_id'=>'2',
            'category_id'=>'4'
        ]);
        $DB->insert([
            'vacancy_id'=>'3',
            'category_id'=>'1'
        ]);
        $DB->insert([
            'vacancy_id'=>'3',
            'category_id'=>'2'
        ]);
        $DB->insert([
            'vacancy_id'=>'3',
            'category_id'=>'5'
        ]);
        $DB->insert([
            'vacancy_id'=>'4',
            'category_id'=>'1'
        ]);
        $DB->insert([
            'vacancy_id'=>'4',
            'category_id'=>'2'
        ]);
        $DB->insert([
            'vacancy_id'=>'4',
            'category_id'=>'6'
        ]);
        $DB->insert([
            'vacancy_id'=>'5',
            'category_id'=>'1'
        ]);
        $DB->insert([
            'vacancy_id'=>'5',
            'category_id'=>'2'
        ]);
        $DB->insert([
            'vacancy_id'=>'5',
            'category_id'=>'5'
        ]);
        # 行政
        $DB->insert([
            'vacancy_id'=>'6',
            'category_id'=>'7'
        ]);
        $DB->insert([
            'vacancy_id'=>'6',
            'category_id'=>'8'
        ]);
        $DB->insert([
            'vacancy_id'=>'6',
            'category_id'=>'9'
        ]);
        $DB->insert([
            'vacancy_id'=>'7',
            'category_id'=>'10'
        ]);
        $DB->insert([
            'vacancy_id'=>'7',
            'category_id'=>'11'
        ]);
        $DB->insert([
            'vacancy_id'=>'7',
            'category_id'=>'12'
        ]);
        $DB->insert([
            'vacancy_id'=>'8',
            'category_id'=>'7'
        ]);
        $DB->insert([
            'vacancy_id'=>'8',
            'category_id'=>'13'
        ]);
        $DB->insert([
            'vacancy_id'=>'8',
            'category_id'=>'14'
        ]);
        $DB->insert([
            'vacancy_id'=>'9',
            'category_id'=>'7'
        ]);
        $DB->insert([
            'vacancy_id'=>'9',
            'category_id'=>'8'
        ]);
        $DB->insert([
            'vacancy_id'=>'9',
            'category_id'=>'9'
        ]);
        $DB->insert([
            'vacancy_id'=>'10',
            'category_id'=>'7'
        ]);
        $DB->insert([
            'vacancy_id'=>'10',
            'category_id'=>'9'
        ]);
        $DB->insert([
            'vacancy_id'=>'10',
            'category_id'=>'15'
        ]);
        $DB->insert([
            'vacancy_id'=>'11',
            'category_id'=>'7'
        ]);
        $DB->insert([
            'vacancy_id'=>'11',
            'category_id'=>'8'
        ]);
    }
}
