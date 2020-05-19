# 職缺分析比對

## 網站連結
[職缺分析比對](http://workanalysis-env.eba-jmzwncax.us-west-2.elasticbeanstalk.com/)

## 目的

旨在於協助求職者快速比對存儲工作資訊，透過統計方式來讓求職者了解與職缺的符合情形，另外運用餘弦演算來進行合適度推薦。

## 架構

此專案部署於AWS上，透過travis CI 與 Aws Elastic beanstalk 達到自動部署的功能。

![](https://i.imgur.com/eHrrxSZ.png)

## 分析項目

1. 列表分析
    * 比對職缺資訊差異
2. 細項分析
    * 顯示資訊百分比來反應職缺的資訊分佈
3. 合適分析
    * 透過四個指標來計算綜合評分，藉此讓求職者找到合適的職缺

## 使用流程
1. 請先註冊與登入系統
2. 使用履歷功能填寫個人履歷
3. 至存儲工作選擇感興趣的工作
4. 進行分析及觀看分析結果

## 演算法
餘弦演算