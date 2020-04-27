<?php

use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $DB=DB::table('vacancy_tools');
        $DB->insert([
            'vacancy_tool'=>'PHP'
        ]);
        $DB->insert([
            'vacancy_tool'=>'中文打字75~100'
        ]);
        $DB->insert([
            'vacancy_tool'=>'Mysql'
        ]);
        $DB->insert([
            'vacancy_tool'=>'Microsoft Office'
        ]);
        $DB->insert([
            'vacancy_tool'=>'英文打字75~100'
        ]);
        $DB->insert([
            'vacancy_tool'=>'Laravel'
        ]);
    }
}
