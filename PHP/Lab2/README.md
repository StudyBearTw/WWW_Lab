# College Registration Form 專案

本專案是一個簡單的 PHP 學院註冊表單系統，使用 MySQL 資料庫儲存註冊資料，並提供資料瀏覽功能。

## 目錄結構

```
browse.php           # 註冊資料瀏覽頁面
db.php               # 資料庫連線設定
form.php             # 註冊表單頁面
process.php          # 表單處理與資料驗證
seccess.php          # 註冊成功頁面
style.css            # 樣式表
test_connection.php  # 資料庫連線與測試資料插入
test.php             # 資料庫與資料表測試
tmp/sessions/        # (可選) session 暫存目錄
```

## 安裝與使用

1. **建立資料庫**

   在 MySQL 建立 `RegisterForm` 資料庫，並執行下列 SQL 建立 `registrations` 資料表：

   ```sql
   CREATE TABLE registrations (
       id INT AUTO_INCREMENT PRIMARY KEY,
       first_name VARCHAR(50) NOT NULL,
       last_name VARCHAR(50) NOT NULL,
       telephone VARCHAR(15),
       email VARCHAR(100) NOT NULL,
       qualification VARCHAR(20) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. **設定資料庫連線**

   請確認 [`db.php`](db.php) 內的資料庫連線資訊（host、port、user、password）與你的環境相符。

3. **啟動 XAMPP 或其他 Apache + MySQL 環境**

   將本專案放入 `htdocs` 目錄下。

4. **使用說明**

   - 開啟 [`form.php`](form.php) 填寫註冊表單並送出。
   - 註冊成功後可點選「查看所有註冊資料」或直接瀏覽 [`browse.php`](browse.php)。
   - 可使用 [`test.php`](test.php) 或 [`test_connection.php`](test_connection.php) 測試資料庫連線與資料表狀態。

## 主要檔案說明

- [`form.php`](form.php)：註冊表單頁面。
- [`process.php`](process.php)：處理表單提交、資料驗證與寫入資料庫。
- [`browse.php`](browse.php)：顯示所有註冊資料。
- [`db.php`](db.php)：資料庫連線設定。
- [`style.css`](style.css)：簡易樣式表。
- [`test.php`](test.php)：資料庫與資料表測試工具。
- [`test_connection.php`](test_connection.php)：快速插入測試資料。

## 注意事項

- 請確保你的 MySQL 伺服器已啟動，且帳號密碼正確。
- 若遇到資料表不存在，請參考 [`test.php`](test.php) 輸出的 SQL 建立資料表。
- 表單有基本的資料驗證，請依需求自行擴充。

---

如有問題歡迎提出！
