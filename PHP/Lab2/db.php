<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $host = 'localhost';
    $port = '3307';
    $dbname = 'RegisterForm';
    $user = 'root';
    $pass = '';
    
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    die("資料庫連線錯誤: " . $e->getMessage());
}