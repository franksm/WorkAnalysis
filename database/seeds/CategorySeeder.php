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
        # 工程
        $DB->insert([
            'vacancy_category'=>'Internet程式設計師'
        ]);
        $DB->insert([
            'vacancy_category'=>'軟體設計工程師'
        ]);
        $DB->insert([
            'vacancy_category'=>'MIS程式設計師'
        ]);
        $DB->insert([
            'vacancy_category'=>'顧問人員'
        ]);
        $DB->insert([
            'vacancy_category'=>'網頁設計師'
        ]);
        $DB->insert([
            'vacancy_category'=>'電腦系統分析師'
        ]);
        # 行政
        # 櫃檯接待人員、行政人員、門市／店員／專櫃人員
        $DB->insert([
            'vacancy_category'=>'行政人員'
        ]);
        $DB->insert([
            'vacancy_category'=>'行政助理'
        ]);
        $DB->insert([
            'vacancy_category'=>'業務助理'
        ]);
        $DB->insert([
            'vacancy_category'=>'職業安全衛生管理員'
        ]);
        $DB->insert([
            'vacancy_category'=>'職業安全衛生管理師'
        ]);
        $DB->insert([
            'vacancy_category'=>'行政主管'
        ]);
        $DB->insert([
            'vacancy_category'=>'櫃檯接待人員'
        ]);
        $DB->insert([
            'vacancy_category'=>'門市／店員／專櫃人員'
        ]);
        $DB->insert([
            'vacancy_category'=>'主管特別助理'
        ]);
        $DB->insert([
            'vacancy_category'=>'測試人員'
        ]);
        $DB->insert([
            'vacancy_category'=>'軟韌體測試工程師'
        ]);
        $DB->insert([
            'vacancy_category'=>'軟體專案主管'
        ]);
    }
}
