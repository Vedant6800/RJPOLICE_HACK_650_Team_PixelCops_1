<?php
require_once('conn.php');
include('../assets/php/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = $_POST['userName'];

    // Assume your database table is called 'users'
    $query = "UPDATE users SET ac_status = (CASE WHEN ac_status = 2 THEN 1 ELSE 2 END) WHERE username = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $userName);
    
    if ($stmt->execute()) {
        // Check the current ac_status value
        $checkQuery = "SELECT ac_status FROM users WHERE username = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param('s', $userName);
        $checkStmt->execute();

        $checkStmt->bind_result($currentStatus);
        $checkStmt->fetch();

        echo ($currentStatus == 2) ? 'blocked' : 'unblocked';
    } else {
        echo 'error';
    }
} else {
    echo 'Invalid request';
}
?>
