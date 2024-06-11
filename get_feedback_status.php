<?php
// get_feedback_status.php

include('Includes/dbConnection.php'); 

$sql = "SELECT feedback_active FROM settings WHERE id = 1"; 
$result = $conn->query($sql);

$status = 0; // Default to false if not found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $status = $row['feedback_active'];
}

echo json_encode(['feedback_active' => $status]);
$conn->close();
?>
