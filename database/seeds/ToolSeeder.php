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
        # HTML、JavaScript、CSS、Excel、PowerPoint、Word
        $DB->insert([
            'vacancy_tool'=>'Linux'
        ]);
        $DB->insert([
            'vacancy_tool'=>'Java'
        ]);
        $DB->insert([
            'vacancy_tool'=>'JSP'
        ]);
        $DB->insert([
            'vacancy_tool'=>'Spring'
        ]);
        $DB->insert([
            'vacancy_tool'=>'Struts'
        ]);
        $DB->insert([
            'vacancy_tool'=>'MySQL'
        ]);
        $DB->insert([
            'vacancy_tool'=>'HTML'
        ]);
        $DB->insert([
            'vacancy_tool'=>'JavaScript'
        ]);
        $DB->insert([
            'vacancy_tool'=>'CSS'
        ]);
        $DB->insert([
            'vacancy_tool'=>'不拘'
        ]);
        $DB->insert([
            'vacancy_tool'=>'Excel'
        ]);
        $DB->insert([
            'vacancy_tool'=>'PowerPoint'
        ]);
        $DB->insert([
            'vacancy_tool'=>'Word'
        ]);
        # Excel、Word、中文打字20~50、英文打字75~100
        $DB->insert([
            'vacancy_tool'=>'中文打字20-50'
        ]);
        $DB->insert([
            'vacancy_tool'=>'英文打字75-100'
        ]);
        $DB->insert([
            'vacancy_tool'=>'ReactNative'
        ]);
    }
}
