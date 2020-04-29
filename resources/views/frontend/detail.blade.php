@extends('frontend.layouts.master')
@section('nav_detail', 'active')
@section('content')
<link rel="stylesheet" href="https://www.104.com.tw/jobs/apply/static/css/app.min.css?id=7bc7c107a1569c7cfad5">

<div class="content_full analysis-section">
<section id="analysisSection" class="rpt_box">
                <div class="bar-row">
                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>性別分佈</h3>
                        </div>
                        <div class="box_analysis" id="box_sex"><dl><dt title="男">男</dt><dd class="bar"><div style="width: 92%;"></div></dd><dd class="ratio">92%</dd></dl><dl><dt title="女">女</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl></div>
                    </div>

                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>學歷分佈</h3>
                        </div>
                        <div class="box_analysis" id="box_edu"><dl><dt title="博碩士">博碩士</dt><dd class="bar"><div style="width: 38%;"></div></dd><dd class="ratio">38%</dd></dl><dl><dt title="大學">大學</dt><dd class="bar"><div style="width: 38%;"></div></dd><dd class="ratio">38%</dd></dl><dl><dt title="專科">專科</dt><dd class="bar"><div style="width: 0%;"></div></dd><dd class="ratio">0%</dd></dl><dl><dt title="高中職">高中職</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="國中(含)以下">國中(含)以下</dt><dd class="bar"><div style="width: 0%;"></div></dd><dd class="ratio">0%</dd></dl></div>
                    </div>
                </div>

                <div class="bar-row">

                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>年齡分佈</h3>
                        </div>
                        <div class="box_analysis" id="box_yearRange"><dl><dt title="20歲以下">20歲以下</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="21~25歲">21~25歲</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="26~30歲">26~30歲</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="31~35歲">31~35歲</dt><dd class="bar"><div style="width: 23%;"></div></dd><dd class="ratio">23%</dd></dl><dl><dt title="36~40歲">36~40歲</dt><dd class="bar"><div style="width: 23%;"></div></dd><dd class="ratio">23%</dd></dl><dl><dt title="41~45歲">41~45歲</dt><dd class="bar"><div style="width: 15%;"></div></dd><dd class="ratio">15%</dd></dl><dl><dt title="46~50歲">46~50歲</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="51~55歲">51~55歲</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="56~60歲">56~60歲</dt><dd class="bar"><div style="width: 0%;"></div></dd><dd class="ratio">0%</dd></dl><dl><dt title="60歲以上">60歲以上</dt><dd class="bar"><div style="width: 0%;"></div></dd><dd class="ratio">0%</dd></dl></div>
                    </div>

                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>語言能力分佈</h3>
                        </div>
                        <div class="box_analysis" id="box_language"><dl><dt title="英文：略懂">英文：略懂</dt><dd class="bar"><div style="width: 15%;"></div></dd><dd class="ratio">15%</dd></dl><dl><dt title="英文：中等">英文：中等</dt><dd class="bar"><div style="width: 53%;"></div></dd><dd class="ratio">53%</dd></dl><dl><dt title="英文：精通">英文：精通</dt><dd class="bar"><div style="width: 15%;"></div></dd><dd class="ratio">15%</dd></dl><dl><dt title="日文：略懂">日文：略懂</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="中文：精通">中文：精通</dt><dd class="bar"><div style="width: 23%;"></div></dd><dd class="ratio">23%</dd></dl></div>
                    </div>

                </div>

                <div class="bar-row">

                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>科系分佈</h3>
                        </div>
                        <div class="box_analysis" id="box_major"><dl><dt title="資訊工程相關">資訊工程相關</dt><dd class="bar"><div style="width: 46%;"></div></dd><dd class="ratio">46%</dd></dl><dl><dt title="電機電子工程相關">電機電子工程相關</dt><dd class="bar"><div style="width: 23%;"></div></dd><dd class="ratio">23%</dd></dl><dl><dt title="資訊管理相關">資訊管理相關</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="機械工程相關">機械工程相關</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl></div>
                    </div>

                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>技能分佈</h3>
                        </div>
                        <div class="box_analysis" id="box_skill"><dl><dt title="OOP">OOP</dt><dd class="bar"><div style="width: 38%;"></div></dd><dd class="ratio">38%</dd></dl><dl><dt title="Visual Studio">Visual Studio</dt><dd class="bar"><div style="width: 38%;"></div></dd><dd class="ratio">38%</dd></dl><dl><dt title="MFC">MFC</dt><dd class="bar"><div style="width: 23%;"></div></dd><dd class="ratio">23%</dd></dl><dl><dt title="Win32">Win32</dt><dd class="bar"><div style="width: 23%;"></div></dd><dd class="ratio">23%</dd></dl><dl><dt title="CGI">CGI</dt><dd class="bar"><div style="width: 23%;"></div></dd><dd class="ratio">23%</dd></dl><dl><dt title="Visual Studio .net">Visual Studio .net</dt><dd class="bar"><div style="width: 23%;"></div></dd><dd class="ratio">23%</dd></dl><dl><dt title="Visual C++">Visual C++</dt><dd class="bar"><div style="width: 30%;"></div></dd><dd class="ratio">30%</dd></dl><dl><dt title="UML">UML</dt><dd class="bar"><div style="width: 23%;"></div></dd><dd class="ratio">23%</dd></dl><dl><dt title="Linux">Linux</dt><dd class="bar"><div style="width: 53%;"></div></dd><dd class="ratio">53%</dd></dl><dl><dt title="Firewall">Firewall</dt><dd class="bar"><div style="width: 23%;"></div></dd><dd class="ratio">23%</dd></dl></div>
                    </div>

                </div>

                <div class="bar-row">

                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>工作經驗分佈</h3>
                        </div>
                        <div class="box_analysis" id="box_exp"><dl><dt title="無工作經驗">無工作經驗</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="1年以下">1年以下</dt><dd class="bar"><div style="width: 0%;"></div></dd><dd class="ratio">0%</dd></dl><dl><dt title="1~3年 ">1~3年 </dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="3~5年">3~5年</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="5~10年">5~10年</dt><dd class="bar"><div style="width: 38%;"></div></dd><dd class="ratio">38%</dd></dl><dl><dt title="10~15年">10~15年</dt><dd class="bar"><div style="width: 30%;"></div></dd><dd class="ratio">30%</dd></dl><dl><dt title="15~20年">15~20年</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="20~25年">20~25年</dt><dd class="bar"><div style="width: 0%;"></div></dd><dd class="ratio">0%</dd></dl><dl><dt title="25年以上">25年以上</dt><dd class="bar"><div style="width: 0%;"></div></dd><dd class="ratio">0%</dd></dl></div>
                    </div>

                    <div class="bar_analysis">
                        <div class="bar-title">
                            <h3>證照分佈</h3>
                        </div>
                        <div class="box_analysis" id="box_cert"><dl><dt title="SCJP">SCJP</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl><dl><dt title="TOEIC">TOEIC</dt><dd class="bar"><div style="width: 7%;"></div></dd><dd class="ratio">7%</dd></dl></div>
                    </div>

                </div>

            </section>
</div>
@endsection