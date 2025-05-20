<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // 資料驗證
        $errors = [];
        
        // 獲取並清理表單資料
        $firstName = trim($_POST["firstname"] ?? '');
        $lastName = trim($_POST["lastname"] ?? '');
        $telephone = trim($_POST["telephone"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $qualification = $_POST["qualification"] ?? '';

        // 驗證名字
        if (!preg_match("/^[a-zA-Z\s]+$/", $firstName)) {
            $errors[] = "名字只能包含字母與空格";
        }
        if (!preg_match("/^[a-zA-Z\s]+$/", $lastName)) {
            $errors[] = "姓氏只能包含字母與空格";
        }

        // 驗證 Email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "無效的 Email 格式";
        }

        // 驗證電話
        if (!preg_match("/^[0-9\-]+$/", $telephone)) {
            $errors[] = "電話號碼格式不正確";
        }

        // 檢查是否有錯誤
        if (!empty($errors)) {
            throw new Exception(implode("<br>", $errors));
        }

        // 準備 SQL 語句
        $sql = "INSERT INTO registrations (first_name, last_name, telephone, email, qualification) 
                VALUES (:firstname, :lastname, :telephone, :email, :qualification)";
        
        $stmt = $pdo->prepare($sql);
        
        // 執行預處理語句
        $result = $stmt->execute([
            ':firstname' => $firstName,
            ':lastname' => $lastName,
            ':telephone' => $telephone,
            ':email' => $email,
            ':qualification' => $qualification
        ]);

        if ($result && $stmt->rowCount() > 0) {
            echo '<div style="color: green; padding: 10px; margin: 20px; border: 1px solid green;">';
            echo "<h3>註冊成功！</h3>";
            echo "<p>感謝您的註冊，{$firstName}！</p>";
            echo '<p><a href="form.php">返回註冊表單</a></p>';
            echo '<p><a href="browse.php">查看所有註冊資料</a></p>';
            echo '</div>';
        } else {
            throw new Exception("資料儲存失敗");
        }

    } catch (PDOException $e) {
        echo '<div style="color: red; padding: 10px; margin: 20px; border: 1px solid red;">';
        echo '<h3>資料庫錯誤</h3>';
        echo '<p>' . $e->getMessage() . '</p>';
        echo '<p><a href="form.php">返回註冊表單</a></p>';
        echo '</div>';
    } catch (Exception $e) {
        echo '<div style="color: red; padding: 10px; margin: 20px; border: 1px solid red;">';
        echo '<h3>驗證錯誤</h3>';
        echo '<p>' . $e->getMessage() . '</p>';
        echo '<p><a href="form.php">返回註冊表單</a></p>';
        echo '</div>';
    }
} else {
    // 如果不是 POST 請求，重定向到表單頁面
    header("Location: form.php");
    exit();
}