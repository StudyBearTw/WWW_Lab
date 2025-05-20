<?php
$host = 'localhost';
$port = '3307';
$dbname = 'LoginForm';
$username = 'root';
$password = '';

try {
    // 加入錯誤報告
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once 'Validator.php';  // 確保包含驗證類別
    
    $validator = new Validator();
    
    // 驗證所有輸入
    $validator->validateId($_POST['id']);
    $validator->validateEmail($_POST['email']);
    $validator->validatePassword($_POST['password']);
    $validator->validateConfirmPassword($_POST['password'], $_POST['confirm_password']);
    
    if ($validator->hasErrors()) {
        header("Location: register.php?error=" . urlencode(implode(", ", $validator->getErrors())));
        exit();
    }

    // 建立資料庫連線
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 新增除錯訊息
    echo "Connected successfully";
    var_dump($_POST);

    // 插入新用戶
    $stmt = $pdo->prepare("INSERT INTO User (id, email, password) VALUES (?, ?, ?)");
    $result = $stmt->execute([
        $_POST['id'],
        $_POST['email'],
        $_POST['password']
    ]);

    // 檢查是否成功插入
    if ($result) {
        header("Location: Login_form.php?success=1");
    } else {
        throw new Exception("資料插入失敗");
    }
    exit();

} catch(PDOException $e) {
    // 記錄錯誤
    error_log($e->getMessage());
    header("Location: register.php?error=" . urlencode($e->getMessage()));
    exit();
} catch(Exception $e) {
    error_log($e->getMessage());
    header("Location: register.php?error=" . urlencode($e->getMessage()));
    exit();
}