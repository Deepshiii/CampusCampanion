<?php
session_start();
include('Includes/dbConnection.php'); 

// Get form data
$college_experience = $_POST['college_experience'];
$teacher_effectiveness = $_POST['teacher_effectiveness'];
$classroom_facilities = $_POST['classroom_facilities'];
$support_services = $_POST['support_services'];
$campus_infrastructure = $_POST['campus_infrastructure'];
$suggestion = $_POST['suggestion'];
$student_ad_id = $_SESSION['ad_id'];

// Fetch student_id from student table
$stmt = $conn->prepare("SELECT id FROM student WHERE ad_id = ?");
$stmt->bind_param("i", $student_ad_id);
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();

if ($id) {
    // Prepare and bind for feedback insertion
    $stmt = $conn->prepare("INSERT INTO collegefeedback (student_id, college_experience, teacher_effectiveness, classroom_facilities, support_services, campus_infrastructure, suggestion) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiiis", $id, $college_experience, $teacher_effectiveness, $classroom_facilities, $support_services, $campus_infrastructure, $suggestion);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
} else {
    echo "Error: Student not found";
}

$conn->close();
?>
