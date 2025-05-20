<!DOCTYPE html>
<html>
<head>
    <title>註冊新帳號</title>
    <style>
        .button-group {
            margin-top: 10px;
        }
        .error {
            color: red;
            font-size: 12px;
            display: none;
        }
            display: none;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_GET['error'])) {
        echo "<p style='color: red;'>註冊失敗：" . htmlspecialchars($_GET['error']) . "</p>";
    }
    ?>
    <h2>註冊新帳號</h2>
    <form action="process_register.php" method="POST" onsubmit="return validateForm()">
        <div>
            <label>ID:</label>
            <input type="text" name="id" id="id" required>
            <span class="error" id="idError"></span>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" id="email" required>
            <span class="error" id="emailError"></span>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" id="password" required>
            <span class="error" id="passwordError"></span>
        </div>
        <div>
            <label>確認密碼:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            <span class="error" id="confirmError"></span>
        </div>
        <div class="button-group">
            <button type="submit">註冊</button>
            <a href="Login_form.php"><button type="button">返回登入</button></a>
        </div>
    </form>

    <script src="js/validation.js"></script>
    <script>
    function validateForm() {
        let isValid = true;
        
        if (!FormValidator.validateId(document.getElementById('id').value)) {
            FormValidator.showError('id', 'ID必須為3-10位數字');
            isValid = false;
        } else {
            FormValidator.hideError('id');
        }

        if (!FormValidator.validateEmail(document.getElementById('email').value)) {
            FormValidator.showError('email', '請輸入有效的Email格式');
            isValid = false;
        } else {
            FormValidator.hideError('email');
        }

        const password = document.getElementById('password').value;
        if (!FormValidator.validatePassword(password)) {
            FormValidator.showError('password', '密碼必須包含至少8個字符，包括大小寫字母和數字');
            isValid = false;
        } else {
            FormValidator.hideError('password');
        }

        if (!FormValidator.validateConfirmPassword(
            password,
            document.getElementById('confirm_password').value
        )) {
            FormValidator.showError('confirm', '密碼不匹配');
            isValid = false;
        } else {
            FormValidator.hideError('confirm');
        }

        return isValid;
    }
    </script>
</body>
</html>