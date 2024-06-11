<?php
include("Includes/dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teacherId = $_POST['id'];

    // Ensure the teacher ID is provided and valid
    if (empty($teacherId)) {
        echo "Teacher ID is required.";
        exit;
    }

    // Fetch the teacher details from the database
    $query = "SELECT * FROM teacher WHERE teacher_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $teacherId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $teacher = $result->fetch_assoc();
        // Create the HTML response with teacher details
        echo "<div class='teacher-details fade-in'>
                <h2>Teacher Details</h2>
                <table class='teacher-table'>
                    <tr><th>ID</th><td>{$teacher['teacher_id']}</td></tr>
                    <tr><th>Name</th><td>{$teacher['name']}</td></tr>
                    <tr><th>Phone</th><td>{$teacher['phone']}</td></tr>
                    <tr><th>Email</th><td>{$teacher['email']}</td></tr>
                    <tr><th>Address</th><td>{$teacher['address']}</td></tr>
                    <tr><th>Qualification</th><td>{$teacher['qualification']}</td></tr>
                    <tr><th>Experience</th><td>{$teacher['experience']}</td></tr>
                </table>
                <button class='back-btn' onclick='goBack()'>Back</button>
              </div>";
    } else {
        echo "No teacher found with ID: $teacherId";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
