<?php
session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="studentdbsem2";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $sqlAdmin = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
    $sqlAdmin->bind_param("ss", $username, $password);
    $sqlAdmin->execute();
    $resultAdmin = $sqlAdmin->get_result();

    // Use prepared statement to validate student details
    $sqlStu = $conn->prepare("SELECT * FROM student WHERE email = ? AND password = ?");
    $sqlStu->bind_param("ss", $username, $password);
    $sqlStu->execute();
    $resultStu = $sqlStu->get_result();

    // Use prepared statement to validate teacher details
    $sqlTeacher = $conn->prepare("SELECT * FROM teacher WHERE email = ? AND password = ?");
    $sqlTeacher->bind_param("ss", $username, $password);
    $sqlTeacher->execute();
    $resultTeacher = $sqlTeacher->get_result();

    // Check if the user is an admin
    if ($resultAdmin->num_rows == 1) {
        $user = $resultAdmin->fetch_assoc();
        $_SESSION['name'] =  $user['name'];

        // Redirect based on admin rolea
        switch ($user['role']) {
            case 'admin':
                header('location: ./adminDashboard.php');
                exit();
            case 'principal':
                header('location: ./principalDashboard.php');
                exit();
            default:
                // Handle unknown role
                header('location: ./login.php');
                exit();
        }
    }
    // Check if the user is a student
    elseif ($resultStu->num_rows == 1) {
        $user = $resultStu->fetch_assoc();
        $_SESSION['name'] = $user['name'];
        $_SESSION['ad_id'] = $user['ad_id'];
        header('location: ./studentDashboard.php');
        exit();
    } 
    // Check if the user is a teacher
    elseif ($resultTeacher->num_rows == 1) {
        $user = $resultTeacher->fetch_assoc();
        $_SESSION['name'] = $user['name'];
        header('location: ./teacherDashboard.php');
        exit();
    } 
    else {
        header('location: ./login.php');
        exit();
    }
}

// Redirect if the form is not submitted
header('location: ./login.php');
exit();
?>
