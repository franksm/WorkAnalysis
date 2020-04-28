<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $DB=DB::table('companies');
        $DB->insert([
            'company_name'=>'曜麟資訊有限公司',
            'industry_category'=>'電腦軟體服務業',
            'capital'=>'暫不提供',
            'workers'=>'暫不提供',
            'region'=>'台北市',
            'area'=>'信義區',
            'link'=>'https://www.104.com.tw/company/1a2x6bkubl?jobsource=hotjob_chr',
            'welfare'=>'【聯強的人才培育理念】

            更多聯強營運及人才發展過程請關注下方連結：
            https://youtu.be/Z6vS3cpeiLE
            
            聯強經營策略 = (人才) × (系統制度) × (營運知識)
            
            聯強國際長期積累通路經營、產品經營、運籌經營及相關支持功能之「營運知識」。並且建立高效之「營運制度」及「電腦運管系統」。
            
            我們招募「潛力人才」，授與「營運知識」的培訓，提供「營運制度」及「電腦運管系統」工具，使其短期内即能俱備專業職能及展現專業績效。
            
            「潛力人才」在這有系統的培訓下成為「人才」。「人才」開創提升「營運知識」、提升「制度系統」，來提升公司能耐、提升競爭力。
            
            歡迎潛力人才的加入，我們隨時都有職缺。
            　
            【薪資】
            年度總收入公平公正的反映個人的貢獻度，以凝聚公司同仁的向心力，激發每位同仁投入工作的動力，因而創造出更好的營運績效。同仁的年度總收入更好下，也會不斷形成善性循環。 
            　
            【福利】
            除了扎實的培訓機制與暢通的升遷管道外，聯強非常重視提供員工充份保障且安心的工作環境，讓同仁在工作之餘，健康有保障、經濟沒煩惱、家庭照顧無後顧之憂，簡述有四大類福利：
            　
            1.安心與安全保障
            　(1)	未滿一年新進同仁，優於勞基法額外賦予休假(依年度任職比例)。
            　(2)	為所有正職員工投保至少三百萬元的定期壽險，強化員工的家庭基本保障。
            　(3)	任職滿一年可申請購屋、房屋修繕、結婚、生育、購車、急難救助無息貸款。
            　(4)	結婚、喪葬、住院、生育、生日等禮金/禮券。
            　(5)	足額繳納勞工保險、勞工退休金提撥、全民健康保險等法定保障。
            　
            2.女性友善職場環境
            　(1)	公司選用與晉升人才不受性別影響，所有主管職中女性人數超過四成。
            　(2)	設有舒適且隱私不受打擾的哺集乳室，產後哺乳無壓力。
            　(3)	友善提供彈性的育嬰留停環境，五成的女性同仁產後申請育嬰假，降低女性同仁工作與家庭照顧間的衝突，使女性同仁不因短期因素中斷職涯！
            　
            3.團隊建設活動
            　(1)	部門旅遊與部門活動舉辦
            　(2)	不定期部門餐敘
            　(3)	優質新春聯歡晚會
            　(4)	聯強運動會
            　(5)	電影欣賞活動
            　(6)	資深同仁獎勵：任職滿五、十、十五、二十年同仁，可享特別獎勵獎金。
            　(7)	自助福利社：提供免費咖啡及自助福利社服務。
            　
            4.健康促進環境
            　(1)	設置專職護理師，提供健康諮詢、舉辦健康講座與健康促進競賽，提倡同仁注重自己與家人的健康。
            　(2)	定期免費健康檢查，並由護理師提供異常追蹤之必要協助。
            　(3)	辦公用電腦全面採用低藍光螢幕，並持續提升辦公環境的舒適與健康。
            　(4)	不定期提供專業肩頸舒壓按摩服務，改善久坐辦公的僵硬，促進血液循環。'
        ]);
        $DB->insert([
            'company_name'=>'遠雄房地產發展股份有限公司',
            'industry_category'=>'不動產經營業',
            'capital'=>'2000萬',
            'workers'=>'400',
            'region'=>'台北市',
            'area'=>'信義區',
            'link'=>'https://www.104.com.tw/company/1a2x6bkcg9?jobsource=hotjob_chr',
            'welfare'=>''
        ]);
        $DB->insert([
            'company_name'=>'威煦軟體開發有限公司',
            'industry_category'=>'電腦軟體服務業',
            'capital'=>'3000萬',
            'workers'=>'暫不提供',
            'region'=>'台北市',
            'area'=>'信義區',
            'link'=>'https://www.104.com.tw/company/1a2x6biwzn?jobsource=jolist_b_relevance',
            'welfare'=>''
        ]);
        $DB->insert([
            'company_name'=>'創順科技有限公司',
            'industry_category'=>'其它軟體及網路相關業',
            'capital'=>'80萬',
            'workers'=>'30',
            'region'=>'台北市',
            'area'=>'內湖區',
            'link'=>'https://www.104.com.tw/company/1a2x6bk72b?jobsource=hotjob_chr',
            'welfare'=>''
        ]);
        $DB->insert([
            'company_name'=>'竑盛科技股份有限公司',
            'industry_category'=>'數位內容產業',
            'capital'=>'暫不提供',
            'workers'=>'6',
            'region'=>'台北市',
            'area'=>'大安區',
            'link'=>'https://www.104.com.tw/company/olbusds?jobsource=hotjob_chr',
            'welfare'=>''
        ]);
        $DB->insert([
            'company_name'=>'社團法人台灣畜犬協會',
            'industry_category'=>'寵物相關服務業',
            'capital'=>'20萬',
            'workers'=>'6',
            'region'=>'高雄市',
            'area'=>'三民區',
            'link'=>'https://www.104.com.tw/company/19tjjizk?jobsource=hotjob_chr',
            'welfare'=>''
        ]);
        $DB->insert([
            'company_name'=>'台灣維達衛生用品股份有限公司',
            'industry_category'=>'紙相關製造',
            'capital'=>'14億',
            'workers'=>'300',
            'region'=>'台北市',
            'area'=>'大安區',
            'link'=>'https://www.104.com.tw/company/a7127bc?jobsource=jolist_b_relevance',
            'welfare'=>''
        ]);
        $DB->insert([
            'company_name'=>'志光教育科技股份有限公司',
            'industry_category'=>'其他教育服務',
            'capital'=>'2億',
            'workers'=>'暫不提供',
            'region'=>'台中市',
            'area'=>'中區',
            'link'=>'https://www.104.com.tw/company/1a2x6biw6r?jobsource=jolist_b_relevance',
            'welfare'=>''
        ]);
        $DB->insert([
            'company_name'=>'櫻女僕咖啡_勻翔專業攝影有限公司',
            'industry_category'=>'寵物相關服務業',
            'capital'=>'100萬',
            'workers'=>'3',
            'region'=>'高雄市',
            'area'=>'三民區',
            'link'=>'https://www.104.com.tw/company/1a2x6bkcne?jobsource=jolist_b_relevance',
            'welfare'=>''
        ]);
        $DB->insert([
            'company_name'=>'千機創意科技有限公司',
            'industry_category'=>'建築及工程技術服務業',
            'capital'=>'暫不提供',
            'workers'=>'暫不提供',
            'region'=>'高雄市',
            'area'=>'鼓山區',
            'link'=>'https://www.104.com.tw/company/1a2x6biltt?jobsource=hotjob_chr',
            'welfare'=>''
        ]);
    }
}
