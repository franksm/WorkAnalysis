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
            'welfare'=>'獎金
　1.年終獎金
　2.三節獎金/禮品 

保險 
　1.勞保 
　2.健保 

制度
1.教育訓練
2.尾牙、員工聚餐

健身器材、桌球、投籃機、小點心'
        ]);
        $DB->insert([
            'company_name'=>'遠雄房地產發展股份有限公司',
            'industry_category'=>'不動產經營業',
            'capital'=>'2000',
            'workers'=>'400',
            'region'=>'台北市',
            'area'=>'信義區',
            'link'=>'https://www.104.com.tw/company/1a2x6bkcg9?jobsource=hotjob_chr',
            'welfare'=>'●獎酬優 荷包超有感
            高額薪資：透過與績效連結的調薪制度共創雙贏
            獎金無限：高個人獎金率+每月/季的競賽獎金+不定期舉辦激勵競賽獎勵
            
            ●資源優 創造高成交
            專業肯定：豐富的廠辦、住宅銷售實績，累積豐富的客戶資源與信譽
            整合服務：從建設.營造到行銷，一條龍的服務，深受各方肯定
            
            ●福利優 生活有靠山
            激勵性福利：績優員工獎勵、考取證照獎勵
            照顧性福利：健康檢查、團體保險、生育補助、1~6歲幼兒照顧補助、 國高中子女獎學金、心理諮商資源
            生活性福利：端午.中秋禮金、旅遊補助、生日賀禮、生日假、健康活動補助'
        ]);
        $DB->insert([
            'company_name'=>'威煦軟體開發有限公司',
            'industry_category'=>'電腦軟體服務業',
            'capital'=>'3000',
            'workers'=>'暫不提供',
            'region'=>'台北市',
            'area'=>'信義區',
            'link'=>'https://www.104.com.tw/company/1a2x6biwzn?jobsource=jolist_b_relevance',
            'welfare'=>'【Work And  Life => Balance】 
            -拒絕加班，用最聰明的方法做最有價值的事
            -吃不完的零食、看不完的書
            -舒服且自在的工作環境、超大的戶外空間，讓工作效率百分百
            
            【福利制度】 
            -週休二日，休假與年假優於勞基法規定。
            -春節、端午、中秋三節津貼，年終獎金，尾牙。
            -每年提供全體員工健檢。
            -研發及銷售擁有高額獎金分紅
            -績優員工配股
            
            【學習與成長】
            -最新穎開發技術，學習數十個新創公司必備工具。
            -大型軟體平台開發及導入上市企業經驗。
            -跨國性軟體開發機會。'
        ]);
        $DB->insert([
            'company_name'=>'創順科技有限公司',
            'industry_category'=>'其它軟體及網路相關業',
            'capital'=>'80',
            'workers'=>'30',
            'region'=>'台北市',
            'area'=>'內湖區',
            'link'=>'https://www.104.com.tw/company/1a2x6bk72b?jobsource=hotjob_chr',
            'welfare'=>'我們目前進駐更寬敞舒適的辦公室，請不要猶豫立刻應徵吧！
            擴大徵才中，關於我們能給的……　｡:.ﾟヽ(*´∀`)ﾉﾟ.:｡
            
            ✿　關於荷包的事　✿　也關於薪情的事！
            　-	優於市場競爭力的薪資 
            　-	這一年為了公司感謝你的兩個月固定獎金 
            　-	公司賺錢依照個人績效來的紅利獎金 
            　-	中秋端午祝你佳節快樂的佳節禮金
            
            ✿　關於津貼的事　✿　 陪伴你的人生大小事！
            　-	內部推薦獎金 
            　-	每年固定旅遊補貼金 
            　-	生日禮金 
            　-	結婚禮金 
            　-	生育禮金 
            　-	住院慰問金 
            　-	喪葬慰問金 
            　-	員工技術及職業生涯規劃培訓
            
            ✿　關於福利的事　✿　休息為了能走更長遠的路！
            　-	試用期過完即享七天特休 
            　-	帶薪病假五天 
            　-	生日當月一天生日假 
            　-	每月部門聚餐/公司聚餐 
            　-	正式員工每兩個月，每人兩張電影票 
            　-	高級咖啡機給你無限量的咖啡 
            　-	吃不完的零食以及飲料 
            　-	每週三、五醒腦下午茶
            
            ✿　關於團隊的事　✿　未來你會接觸到這樣子的團隊！
            　-	良好的團隊互助分享的氛圍
            　-	輕型工作流和扁平化的組織架構
            　-	施行完善的職級系統，定期績效考核
            　-	推行成長激勵機制幫助和鼓勵個人的職業發展'
        ]);
        $DB->insert([
            'company_name'=>'竑盛科技股份有限公司',
            'industry_category'=>'數位內容產業',
            'capital'=>'暫不提供',
            'workers'=>'6',
            'region'=>'台北市',
            'area'=>'大安區',
            'link'=>'https://www.104.com.tw/company/olbusds?jobsource=hotjob_chr',
            'welfare'=>'1. 早鳥工作模式 5:30下班，極少加班
            2. 不定期電影欣賞、戶外踏青、室內娛樂等
            3. 三節獎金
            4. 生日聚餐/獎金
            5. Lynda.com, Udemy, Hahow, 等線上學習資源
            6. 外部教育訓練、研討會參與
            7. 得到App訂閱與討論'
        ]);
        $DB->insert([
            'company_name'=>'社團法人台灣畜犬協會',
            'industry_category'=>'寵物相關服務業',
            'capital'=>'20',
            'workers'=>'6',
            'region'=>'高雄市',
            'area'=>'三民區',
            'link'=>'https://www.104.com.tw/company/19tjjizk?jobsource=hotjob_chr',
            'welfare'=>'健保，員工意外險，週休二日'
        ]);
        $DB->insert([
            'company_name'=>'台灣維達衛生用品股份有限公司',
            'industry_category'=>'紙相關製造',
            'capital'=>'140000',
            'workers'=>'300',
            'region'=>'台北市',
            'area'=>'大安區',
            'link'=>'https://www.104.com.tw/company/a7127bc?jobsource=jolist_b_relevance',
            'welfare'=>'除公司提供之福利外，台灣維達衛生用品股份有限公司同時設有福利委員會，讓同仁享有更完善的福利措施。

            ◆ 獎金/禮品類
                1.年終獎金
                2.三節禮金
            ◆ 保險類
                1.勞保
                2.健保
                3.員工團保
                    4.勞退提撥6%
            ◆ 休閒類
                1.國內旅遊
            ◆ 制度類
                1.完整的教育訓練
                2.順暢的升遷管道
            ◆ 請 / 休假制度
                1.特休/年假
                2.家庭照顧假
                3.女性同仁生理假
                4.女性同仁育嬰假
            ◆ 其他
                1.員工購物優惠
                2.健康檢查
            ◆ 補助類
                1.結婚禮金
                2.員工進修補助
                3.員工教育獎助學金
                4.子女教育獎助學金'
        ]);
        $DB->insert([
            'company_name'=>'志光教育科技股份有限公司',
            'industry_category'=>'其他教育服務',
            'capital'=>'20000',
            'workers'=>'暫不提供',
            'region'=>'台中市',
            'area'=>'中區',
            'link'=>'https://www.104.com.tw/company/1a2x6biw6r?jobsource=jolist_b_relevance',
            'welfare'=>'1. 完善的休假及升遷制度，相關福利制度最完善。
            2.專業的相關教育訓練，以增進員工相關技能及自我提升。
            3.各主要連鎖班系均位於全省火車站旁，交通便捷。
            4. 企業歷史悠久，穩健發展，歡迎有志於此的朋友加入我們的行列。'
        ]);
        $DB->insert([
            'company_name'=>'櫻女僕咖啡_勻翔專業攝影有限公司',
            'industry_category'=>'寵物相關服務業',
            'capital'=>'100',
            'workers'=>'3',
            'region'=>'高雄市',
            'area'=>'三民區',
            'link'=>'https://www.104.com.tw/company/1a2x6bkcne?jobsource=jolist_b_relevance',
            'welfare'=>'每半年加薪1000'
        ]);
        $DB->insert([
            'company_name'=>'千機創意科技有限公司',
            'industry_category'=>'建築及工程技術服務業',
            'capital'=>'暫不提供',
            'workers'=>'暫不提供',
            'region'=>'高雄市',
            'area'=>'鼓山區',
            'link'=>'https://www.104.com.tw/company/1a2x6biltt?jobsource=hotjob_chr',
            'welfare'=>'◎保險福利制度：
            1. 勞工保險。
            2. 全民健保。
            3. 工地保險。
            4. 勞工退休金。
         
         ◎各類獎(禮)金福利：
            1. 端午禮金(依個人1~5月份績效表現及公司實際經營狀況發放獎金或禮品)。
            2. 中秋禮金(依個人6~9月績效及公司實際經營狀況發放獎金或禮品)。
            3. 年終獎金(依個人年度績效及公司實際經營狀況發放獎金，至少一個月)。
            4. 出國員工旅遊(需任職滿二年)。
            5. 進修、專業證照補助金(需任職滿一年，且與工作內容相關)。
            6. 業務案件簽約獎金(係指從開發案件至簽約完成)。
         
         ◎請(休)假制度：
            1. 週休二日及國定假日。
            2. 普通傷病假(按勞基法請假規則)。
            3. 事假(按勞基法請假規則)。
            4. 喪假(按勞基法請假規則)。
            5. 其它不足備載處按勞基法之規定。
         
         ◎出差制度：
            1.  住宿費、日支費。(依出差地區、時間彈性調整)。
         '
        ]);
    }
}
