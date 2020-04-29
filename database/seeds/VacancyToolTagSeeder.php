<?php

use Illuminate\Database\Seeder;

class VacancyToolTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $DB=DB::table('vacancy_tool_tags');
        # 工程
        $DB->insert([
            'vacancy_id'=>'1',
            'tool_id'=>'1'
        ]);
        $DB->insert([
            'vacancy_id'=>'1',
            'tool_id'=>'2'
        ]);
        $DB->insert([
            'vacancy_id'=>'1',
            'tool_id'=>'3'
        ]);
        $DB->insert([
            'vacancy_id'=>'1',
            'tool_id'=>'4'
        ]);
        $DB->insert([
            'vacancy_id'=>'1',
            'tool_id'=>'5'
        ]);
        $DB->insert([
            'vacancy_id'=>'1',
            'tool_id'=>'6'
        ]);
        $DB->insert([
            'vacancy_id'=>'1',
            'tool_id'=>'7'
        ]);
        $DB->insert([
            'vacancy_id'=>'1',
            'tool_id'=>'8'
        ]);
        $DB->insert([
            'vacancy_id'=>'1',
            'tool_id'=>'9'
        ]);
        $DB->insert([
            'vacancy_id'=>'2',
            'tool_id'=>'10'
        ]);
        $DB->insert([
            'vacancy_id'=>'3',
            'tool_id'=>'7'
        ]);
        $DB->insert([
            'vacancy_id'=>'3',
            'tool_id'=>'8'
        ]);
        $DB->insert([
            'vacancy_id'=>'3',
            'tool_id'=>'9'
        ]);
        $DB->insert([
            'vacancy_id'=>'3',
            'tool_id'=>'11'
        ]);
        $DB->insert([
            'vacancy_id'=>'3',
            'tool_id'=>'12'
        ]);
        $DB->insert([
            'vacancy_id'=>'3',
            'tool_id'=>'13'
        ]);
        $DB->insert([
            'vacancy_id'=>'4',
            'tool_id'=>'10'
        ]);
        $DB->insert([
            'vacancy_id'=>'5',
            'tool_id'=>'10'
        ]);
        $DB->insert([
            'vacancy_id'=>'6',
            'tool_id'=>'11'
        ]);
        $DB->insert([
            'vacancy_id'=>'6',
            'tool_id'=>'13'
        ]);
        $DB->insert([
            'vacancy_id'=>'6',
            'tool_id'=>'14'
        ]);
        $DB->insert([
            'vacancy_id'=>'6',
            'tool_id'=>'15'
        ]);
        $DB->insert([
            'vacancy_id'=>'7',
            'tool_id'=>'11'
        ]);
        $DB->insert([
            'vacancy_id'=>'7',
            'tool_id'=>'12'
        ]);
        $DB->insert([
            'vacancy_id'=>'7',
            'tool_id'=>'13'
        ]);
        $DB->insert([
            'vacancy_id'=>'8',
            'tool_id'=>'10'
        ]);
        $DB->insert([
            'vacancy_id'=>'9',
            'tool_id'=>'10'
        ]);
        $DB->insert([
            'vacancy_id'=>'10',
            'tool_id'=>'10'
        ]);
    }
}