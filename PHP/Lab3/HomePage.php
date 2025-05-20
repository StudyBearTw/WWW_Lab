<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Login_form.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>首頁</title>
</head>
<body>
    <h1>歡迎 <?php echo htmlspecialchars($_SESSION['user_email']); ?>!</h1>
    
    <h2>Cookie 資訊:</h2>
    <p>學校: <?php echo $_COOKIE['School'] ?? 'Not set'; ?></p>
    <p>系所: <?php echo $_COOKIE['Department'] ?? 'Not set'; ?></p>

    <a href="logout.php">登出</a>
</body>
</html>