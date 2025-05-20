<!DOCTYPE html>
<html>
<head>
    <title>登入表單</title>
    <style>
        .button-group {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_GET['error'])) {
        echo "<p style='color: red;'>登入失敗，請重試！</p>";
    }
    if(isset($_GET['success'])) {
        echo "<p style='color: green;'>註冊成功！請登入。</p>";
    }
    ?>
    <form action="process.php" method="POST">
        <div>
            <label>ID:</label>
            <input type="text" name="id" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div class="button-group">
            <button type="submit">登入</button>
            <a href="register.php"><button type="button">註冊新帳號</button></a>
        </div>
    </form>
</body>
</html>