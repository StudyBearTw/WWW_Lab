<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php';

try {
    // 從 registrations 資料表中取得所有資料
    $stmt = $pdo->query("SELECT * FROM registrations ORDER BY id DESC");
    $registrations = $stmt->fetchAll();

    if (count($registrations) === 0) {
        echo "<p>目前沒有任何註冊資料。</p>";
        exit;
    }
} catch(PDOException $e) {
    die("查詢錯誤: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>註冊資料列表</title>
    <style>
        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin-top: 20px;
        }
        th, td { 
            padding: 8px; 
            border: 1px solid #ddd; 
            text-align: left;
        }
        th { 
            background-color: #f5f5f5; 
        }
        tr:nth-child(even) { 
            background-color: #f9f9f9; 
        }
    </style>
</head>
<body>
    <h1>註冊資料列表</h1>
    <table>
        <tr>
            <th>編號</th>
            <th>名字</th>
            <th>姓氏</th>
            <th>電話</th>
            <th>電子郵件</th>
            <th>學歷</th>
            <th>註冊時間</th>
        </tr>
        <?php foreach ($registrations as $registration): ?>
        <tr>
            <td><?= htmlspecialchars($registration['id']) ?></td>
            <td><?= htmlspecialchars($registration['first_name']) ?></td>
            <td><?= htmlspecialchars($registration['last_name']) ?></td>
            <td><?= htmlspecialchars($registration['telephone']) ?></td>
            <td><?= htmlspecialchars($registration['email']) ?></td>
            <td><?= htmlspecialchars($registration['qualification']) ?></td>
            <td><?= htmlspecialchars($registration['created_at']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>