<?php

use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $DB=DB::table('vacancies');
        $DB->insert([
            'vacancy_name'=>'Java軟體設計工程師',
            'vacancy_category'=>'軟體設計工程師',
            'salary_category'=>'月薪',
            'salary'=>'33000~45000',
            'work_nature'=>'全職',
            'company_id'=>'1',
            'claim_education'=>"專科",
            'claim_experience'=>"不拘",
            'claim_people'=>"1~2",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/6lcsk?jobsource=hotjob_chr',
        ]);
        $DB->insert([
            'vacancy_name'=>'遠雄房地產-數據探勘工程師',
            'vacancy_category'=>'軟體設計工程師',
            'salary_category'=>'月薪',
            'salary'=>'待遇面議',
            'work_nature'=>'全職',
            'company_id'=>'2',
            'claim_education'=>"大學",
            'claim_experience'=>"5年",
            'claim_people'=>"1",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/6vi1a?jobsource=hotjob_chr',
        ]);
        $DB->insert([
            'vacancy_name'=>'前端軟體設計工程師',
            'vacancy_category'=>'軟體設計工程師',
            'salary_category'=>'月薪',
            'salary'=>'50000~75000',
            'work_nature'=>'全職',
            'company_id'=>'3',
            'claim_education'=>"大學",
            'claim_experience'=>"不拘",
            'claim_people'=>"1~2",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/6jjsj?jobsource=jolist_b_relevance',
        ]);
        $DB->insert([
            'vacancy_name'=>'DevOps/SRE工程師',
            'vacancy_category'=>'軟體設計工程師',
            'salary_category'=>'月薪',
            'salary'=>'80000',
            'work_nature'=>'全職',
            'company_id'=>'4',
            'claim_education'=>"大學",
            'claim_experience'=>"3年",
            'claim_people'=>"2~4",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/69tl3?jobsource=hotjob_chr',
        ]);
        $DB->insert([
            'vacancy_name'=>'資深WordPress工程師',
            'vacancy_category'=>'軟體設計工程師',
            'salary_category'=>'月薪',
            'salary'=>'待遇面議',
            'work_nature'=>'全職',
            'company_id'=>'5',
            'claim_education'=>"專科",
            'claim_experience'=>"2年",
            'claim_people'=>"1~2",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/6tvkx?jobsource=hotjob_chr',
        ]);
        $DB->insert([
            'vacancy_name'=>'行政人員',
            'vacancy_category'=>'行政人員',
            'salary_category'=>'月薪',
            'salary'=>'24000',
            'work_nature'=>'全職',
            'company_id'=>'6',
            'claim_education'=>"專科",
            'claim_experience'=>"不拘",
            'claim_people'=>"1",
            'management_responsibility'=>'0',
            'expatriate'=>'需出差，一年累積時間約一個月以',
            'link'=>'https://www.104.com.tw/job/46rbq?jobsource=hotjob_chr',
        ]);
        $DB->insert([
            'vacancy_name'=>'職業安全衛生主任',
            'vacancy_category'=>'行政人員',
            'salary_category'=>'月薪',
            'salary'=>'待遇面議',
            'work_nature'=>'全職',
            'company_id'=>'7',
            'claim_education'=>"大學",
            'claim_experience'=>"5年",
            'claim_people'=>"1",
            'management_responsibility'=>'管理4人以下',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/6ns6p?jobsource=hotjob_chr',
        ]);
        $DB->insert([
            'vacancy_name'=>'櫃檯行政人員(高儒營業所)',
            'vacancy_category'=>'行政人員',
            'salary_category'=>'月薪',
            'salary'=>'25000',
            'work_nature'=>'全職',
            'company_id'=>'8',
            'claim_education'=>"專科",
            'claim_experience'=>"不拘",
            'claim_people'=>"1~2",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/4wr4t?jobsource=jolist_b_relevance',
        ]);
        $DB->insert([
            'vacancy_name'=>'櫻女僕咖啡-行政人員',
            'vacancy_category'=>'行政人員',
            'salary_category'=>'月薪',
            'salary'=>'23800~25000',
            'work_nature'=>'全職',
            'company_id'=>'9',
            'claim_education'=>"不拘",
            'claim_experience'=>"不拘",
            'claim_people'=>"1",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/6uf7e?jobsource=jolist_b_relevance',
        ]);
        $DB->insert([
            'vacancy_name'=>'業務行政人員',
            'vacancy_category'=>'行政人員',
            'salary_category'=>'月薪',
            'salary'=>'27000~30000',
            'work_nature'=>'全職',
            'company_id'=>'10',
            'claim_education'=>"專科",
            'claim_experience'=>"2年",
            'claim_people'=>"2~3",
            'management_responsibility'=>'0',
            'expatriate'=>'需出差，一年累積時間約一個月以',
            'link'=>'https://www.104.com.tw/job/526mn?jobsource=hotjob_chr',
        ]);
        $DB->insert([
            'vacancy_name'=>'遠雄房地產-行政人員-新北市中和區',
            'vacancy_category'=>'行政人員',
            'salary_category'=>'月薪',
            'salary'=>'30000',
            'work_nature'=>'全職',
            'company_id'=>'2',
            'claim_education'=>"專科",
            'claim_experience'=>"不拘",
            'claim_people'=>"1",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/6wx80?jobsource=hotjob_chr',
        ]);
        $DB->insert([
            'vacancy_name'=>'.NET 後端工程師 (資深)',
            'vacancy_category'=>'軟體設計工程師',
            'salary_category'=>'月薪',
            'salary'=>'55000~75000',
            'work_nature'=>'全職',
            'company_id'=>'3',
            'claim_education'=>"專科",
            'claim_experience'=>"不拘",
            'claim_people'=>"1~2",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/4731i?jobsource=jolist_b_relevance',
        ]);
        $DB->insert([
            'vacancy_name'=>'.NET 後端工程師',
            'vacancy_category'=>'軟體設計工程師',
            'salary_category'=>'月薪',
            'salary'=>'40000~60000',
            'work_nature'=>'全職',
            'company_id'=>'3',
            'claim_education'=>"專科",
            'claim_experience'=>"不拘",
            'claim_people'=>"1~2",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/5rvb7?jobsource=jolist_b_relevance',
        ]);
        $DB->insert([
            'vacancy_name'=>'測試工程師 QA Engineer',
            'vacancy_category'=>'軟體設計工程師',
            'salary_category'=>'月薪',
            'salary'=>'40000~70000',
            'work_nature'=>'全職',
            'company_id'=>'4',
            'claim_education'=>"大學",
            'claim_experience'=>"不拘",
            'claim_people'=>"1~2",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/5sbek?jobsource=hotjob_chr',
        ]);
        $DB->insert([
            'vacancy_name'=>'App 工程師 App Engineer(React Native)',
            'vacancy_category'=>'軟體設計工程師',
            'salary_category'=>'月薪',
            'salary'=>'50000~80000',
            'work_nature'=>'全職',
            'company_id'=>'4',
            'claim_education'=>"大學",
            'claim_experience'=>"不拘",
            'claim_people'=>"2~3",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/5ufzn?jobsource=hotjob_chr',
        ]);
        $DB->insert([
            'vacancy_name'=>'前端工程師 Front-end Engineer (Vue)',
            'vacancy_category'=>'軟體設計工程師',
            'salary_category'=>'月薪',
            'salary'=>'50000~120000',
            'work_nature'=>'全職',
            'company_id'=>'4',
            'claim_education'=>"大學",
            'claim_experience'=>"不拘",
            'claim_people'=>"1~4",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/5oxxv?jobsource=hotjob_chr',
        ]);
        $DB->insert([
            'vacancy_name'=>'後端工程師 Back-end Engineer (Python)',
            'vacancy_category'=>'軟體設計工程師',
            'salary_category'=>'月薪',
            'salary'=>'50000~80000',
            'work_nature'=>'全職',
            'company_id'=>'4',
            'claim_education'=>"大學",
            'claim_experience'=>"不拘",
            'claim_people'=>"1~2",
            'management_responsibility'=>'0',
            'expatriate'=>'0',
            'link'=>'https://www.104.com.tw/job/5oxtq?jobsource=jolist_c_relevance',
        ]);
    }
}
