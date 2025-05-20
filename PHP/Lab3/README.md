根據你提供的內容與截圖，我已整理與撰寫出完整格式良好的 `README.md` 檔案如下：

```markdown
# Lab3 - PHP 登入註冊系統

這是一個使用 PHP 和 MySQL 建立的基本登入註冊系統，支援使用者註冊、登入、資料驗證及 Cookie 設定。

---

## ✨ 功能特點

- ✅ 使用者註冊
- ✅ 使用者登入
- ✅ 表單驗證（前端 JavaScript + 後端 PHP）
- ✅ 資料庫整合（MySQL）
- ✅ Session 管理
- ✅ Cookie 設定

---

## ⚙️ 系統需求

- PHP 7.0+
- MySQL 5.7+
- Apache / XAMPP
- 現代瀏覽器（Chrome、Firefox、Safari 等）

---

## 📁 專案檔案結構

```

Lab3/
├── js/
│   └── validation.js           # 前端驗證函數
├── Login\_form.php             # 登入頁面
├── register.php               # 註冊頁面
├── process.php                # 處理登入邏輯
├── process\_register.php       # 處理註冊邏輯
├── HomePage.php               # 登入後首頁
├── Validator.php              # PHP 驗證邏輯類別
└── README.md                  # 專案說明文件

````

---

## 🛠️ 安裝說明

### 1️⃣ 確保 XAMPP 已安裝並運行

```bash
# 啟動 XAMPP（macOS）
sudo /Applications/XAMPP/xamppfiles/xampp start
````

### 2️⃣ 將專案複製到 XAMPP 的 `htdocs` 目錄下

```bash
cp -r Lab3 /Applications/XAMPP/htdocs/
```

### 3️⃣ 建立資料庫（使用 phpMyAdmin 或 MySQL CLI）

```sql
CREATE DATABASE LoginForm;
USE LoginForm;

CREATE TABLE User (
  id VARCHAR(10) PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);
```

---

## 🚀 使用說明

### 1️⃣ 訪問登入頁面

[http://localhost/Lab3/Login\_form.php](http://localhost/Lab3/Login_form.php)

### 2️⃣ 註冊帳號

* 點擊「註冊新帳號」按鈕
* 填寫 **ID、Email、密碼**
* 提交表單

### 3️⃣ 登入系統

* 輸入 **ID、Email、密碼**
* 點擊「登入」按鈕後導向首頁

---

## ✅ 驗證規則

| 欄位    | 驗證規則               |
| ----- | ------------------ |
| ID    | 3-10 位數字           |
| Email | 合法電子郵件格式           |
| 密碼    | 至少 8 個字元，含大小寫字母與數字 |

---

## 🍪 Cookie 設定

登入後，系統將自動設置下列 Cookie：

* `School`: `NKNU`
* `Department`: `Software Engineering and Management`
* `有效期限`: 1 小時

---

## ⚠️ 注意事項

* 確保 MySQL 使用 **port 3307**
* 檢查 `Login_form.php` 和連線檔案中的資料庫設定
* 確保 Apache 服務已啟動，且 `htdocs` 中權限允許讀寫
* 避免瀏覽器快取導致驗證錯誤

---

## 🐞 錯誤排除

如遇問題，可參考以下方式除錯：

* 查看 XAMPP 控制面板（Apache、MySQL 是否運作中）
* 查看 PHP 錯誤日誌：

  ```
  /Applications/XAMPP/logs/php_error.log
  ```
* 查看 MySQL 錯誤日誌：

  ```
  /Applications/XAMPP/logs/mysql_error.log
  ```
* 檢查資料夾或檔案的權限設定

---

## 📬 聯絡方式

如有任何問題，請聯繫系統管理員或授課教師。

```

---
