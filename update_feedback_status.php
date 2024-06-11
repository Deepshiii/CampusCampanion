<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('Includes/dbConnection.php');


// Check if the settings table exists, if not create it for demonstration
$conn->query("CREATE TABLE IF NOT EXISTS settings (
    id INT PRIMARY KEY,
    feedback_active TINYINT(1) NOT NULL DEFAULT 0
)");

// Insert a row if it does not exist
$conn->query("INSERT INTO settings (id, feedback_active) VALUES (1, 0) ON DUPLICATE KEY UPDATE id=id");

$sql = "SELECT feedback_active FROM settings WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentStatus = $row['feedback_active'];

    // Toggle the status
    $newStatus = $currentStatus == 1 ? 0 : 1;
    $sql = "UPDATE settings SET feedback_active = $newStatus WHERE id = 1";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No settings found']);
}

$conn->close();
?>
