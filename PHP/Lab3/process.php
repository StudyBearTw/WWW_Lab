<?php
session_start();

$host = 'localhost';
$port = '3307';
$dbname = 'LoginForm';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 移除 id 條件，只用 email 查詢
    $stmt = $pdo->prepare("SELECT * FROM User WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    // 因為密碼是明文，直接比對
    if ($user && $user['password'] === $_POST['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        // 設定 cookies
        setcookie("School", "NKNU", time() + 3600);
        setcookie("Department", "Software Engineering and Management", time() + 3600);

        header("Location: HomePage.php");
        exit();
    } else {
        header("Location: Login_form.php?error=1");
        exit();
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}