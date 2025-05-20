<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // 資料庫連線設定
    $host = 'localhost';
    $port = '3307';
    $db = 'RegisterForm';
    $user = 'root';
    $pass = '';
    
    // 建立連線
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo '<div style="background-color: #f5f5f5; padding: 15px; margin: 10px; border-radius: 5px;">';
    echo '<h3>資料庫連線測試結果</h3>';
    echo '<pre>';
    
    // 檢查資料庫版本和連線資訊
    echo "MySQL 版本: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "\n";
    echo "連線狀態: " . $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n\n";
    
    // 測試資料表是否存在
    $sql = "SHOW TABLES LIKE 'registrations'";
    $result = $pdo->query($sql);
    
    if ($result->rowCount() > 0) {
        echo "✅ registrations 資料表存在\n\n";
        
        // 顯示資料表結構
        $sql = "DESCRIBE registrations";
        $result = $pdo->query($sql);
        $columns = $result->fetchAll(PDO::FETCH_ASSOC);
        
        echo "資料表結構檢查：\n";
        echo str_repeat('-', 50) . "\n";
        foreach ($columns as $column) {
            echo sprintf("欄位名稱: %-15s 類型: %-15s 允許空值: %-5s\n",
                $column['Field'],
                $column['Type'],
                $column['Null'] === 'YES' ? '是' : '否'
            );
        }
        echo str_repeat('-', 50) . "\n\n";
        
        // 測試插入資料
        $testData = [
            '測試名字',        // first_name
            '測試姓氏',        // last_name
            '0912345678',     // telephone
            'test@test.com',  // email
            'B.Sc.'          // qualification
        ];
        
        echo "測試資料插入：\n";
        $stmt = $pdo->prepare("INSERT INTO registrations 
            (first_name, last_name, telephone, email, qualification) 
            VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt->execute($testData)) {
            $lastId = $pdo->lastInsertId();
            echo "✅ 測試資料插入成功\n";
            echo "→ 新記錄 ID: {$lastId}\n";
            echo "→ 影響資料列數: " . $stmt->rowCount() . "\n\n";
            
            // 驗證插入的資料
            echo "驗證插入的資料：\n";
            $stmt = $pdo->prepare("SELECT * FROM registrations WHERE id = ?");
            $stmt->execute([$lastId]);
            $insertedData = $stmt->fetch(PDO::FETCH_ASSOC);
            print_r($insertedData);
        }
    } else {
        echo "❌ registrations 資料表不存在\n";
        echo "請執行以下 SQL 建立資料表：\n\n";
        echo "CREATE TABLE registrations (\n";
        echo "    id INT AUTO_INCREMENT PRIMARY KEY,\n";
        echo "    first_name VARCHAR(50) NOT NULL,\n";
        echo "    last_name VARCHAR(50) NOT NULL,\n";
        echo "    telephone VARCHAR(15),\n";
        echo "    email VARCHAR(100) NOT NULL,\n";
        echo "    qualification VARCHAR(20) NOT NULL,\n";
        echo "    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP\n";
        echo ") CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;\n";
    }
    
    echo '</pre>';
    echo '</div>';
    
} catch (PDOException $e) {
    echo '<div style="background-color: #ffe0e0; padding: 15px; margin: 10px; border-radius: 5px;">';
    echo '<h3>資料庫錯誤</h3>';
    echo '<p>錯誤訊息：' . $e->getMessage() . '</p>';
    echo '<p>錯誤代碼：' . $e->getCode() . '</p>';
    echo '</div>';
}