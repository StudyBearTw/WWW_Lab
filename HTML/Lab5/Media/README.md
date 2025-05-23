# HTML5 音樂播放器

這是一個使用 HTML5、CSS3 與原生 JavaScript 製作的網頁音樂播放器，支援播放清單、音量控制、靜音、隨機播放、重複播放等功能，並有美觀的 UI 介面。

## 目錄結構

```
index.html
css/
  ├─ style.css
  └─ input_range_reset.css
JS/
  ├─ data.js
  ├─ player.js
  └─ ui.js
cover/
  ├─ gundam.jpg
  ├─ icon.png
  ├─ 夢幻.jpg
  └─ 深愛.jpg
images/
  ├─ bg.jpg
  ├─ fastforward.png
  ├─ mute.png
  ├─ pause.png
  ├─ play.png
  ├─ playing.png
  ├─ repeat.png
  ├─ rewind.png
  ├─ shuffle.png
  ├─ stop.png
  └─ volume.png
music/
  ├─ AlbumArtSmall.jpg
  └─ Folder.jpg
```

## 功能特色

- 播放/暫停/停止/上一首/下一首
- 播放清單顯示與切換
- 封面顯示
- 進度條與時間顯示
- 音量調整與靜音
- 隨機播放與重複播放模式
- 音量記憶（localStorage）

## 使用方式

1. **下載或複製本專案**
2. 將專案資料夾內容放在本機或伺服器上
3. 直接用瀏覽器開啟 `index.html` 即可使用

## 檔案說明

- [`index.html`](index.html)：主頁面，載入播放器 UI。
- [`css/style.css`](css/style.css)：播放器樣式。
- [`css/input_range_reset.css`](css/input_range_reset.css)：自訂 input range 樣式。
- [`JS/data.js`](JS/data.js)：播放清單資料。
- [`JS/player.js`](JS/player.js)：播放器核心邏輯，負責音訊控制。
- [`JS/ui.js`](JS/ui.js)：UI 控制與 DOM 綁定。
- [`cover/`](cover/)：專輯封面圖。
- [`images/`](images/)：播放器控制圖示與背景。

## 播放清單擴充

可在 [`JS/data.js`](JS/data.js) 中新增或修改歌曲資訊：

```js
export const playlist = [
  {
    album: "專輯名稱",
    track: "歌曲名稱",
    artist: "歌手",
    cover: "cover/xxx.jpg",
    mp3: "音樂檔案網址",
  },
  // ...更多歌曲
];
```

## 瀏覽器支援

- 建議使用最新版 Chrome、Firefox、Edge 或 Safari

## 授權

本專案僅供學習與教學用途，音樂檔案請依照相關授權規範使用。

---
