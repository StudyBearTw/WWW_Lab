<?php
include 'db.php';

try {
    $stmt = $pdo->prepare("INSERT INTO registrations (first_name, last_name, telephone, email, qualification) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute(['Test', 'User', '1234567890', 'test@example.com', 'B.Sc.']);
    echo "Test data inserted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>