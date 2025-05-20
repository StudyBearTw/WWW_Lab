<?php
class Validator {
    private $errors = [];

    public function validateId($id) {
        if (!preg_match('/^\d{3,10}$/', $id)) {
            $this->errors['id'] = "ID必須為3-10位數字";
            return false;
        }
        return true;
    }

    public function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "無效的Email格式";
            return false;
        }
        return true;
    }

    public function validatePassword($password) {
        if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
            $this->errors['password'] = "密碼必須至少8個字符，包括大小寫字母和數字";
            return false;
        }
        return true;
    }

    public function validateConfirmPassword($password, $confirmPassword) {
        if ($password !== $confirmPassword) {
            $this->errors['confirm'] = "密碼不匹配";
            return false;
        }
        return true;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function hasErrors() {
        return !empty($this->errors);
    }
}