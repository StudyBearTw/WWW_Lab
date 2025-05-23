# 小畫布 (HTML5 Canvas Paint)

這是一個簡易的 HTML5 Canvas 小畫布應用程式，支援多種顏色、筆刷粗細調整、模式切換（畫筆/填滿）、橡皮擦與清除畫布功能。適合用於學習 Canvas API 與前端互動設計。

## 功能特色

- 多種顏色選擇，並有橡皮擦功能
- 筆刷粗細可調整
- 畫筆模式與填滿模式切換
- 一鍵清除畫布
- 即時顯示滑鼠座標

## 專案結構

```
canvas.js        # Canvas 畫布邏輯
control.js       # 控制面板與 UI 互動
index.html       # 主頁面
style.css        # 樣式表
.idea/           # 開發環境設定檔
```

## 使用方式

1. 將專案所有檔案放在同一資料夾。
2. 使用瀏覽器開啟 `index.html`。
3. 開始繪圖！

## 檔案說明

- [`index.html`](index.html)：主頁面，包含 Canvas 與控制面板。
- [`canvas.js`](canvas.js)：負責 Canvas 畫圖、填滿、清除等功能。
- [`control.js`](control.js)：負責顏色、筆刷、模式等 UI 控制。
- [`style.css`](style.css)：頁面與控制面板的美化樣式。

## 預覽畫面

![畫布預覽](https://user-images.githubusercontent.com/your-image-link.png)

## 開發環境

- HTML5
- JavaScript (ES6)
- CSS3

## 版權

本專案僅供學術與教學用途。
