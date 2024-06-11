<?php

include("Includes\dbConnection.php");

// Include PHPMailer classes and setup
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Function to generate a random password
function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}


try {
    if(isset($_POST['id']) && is_numeric($_POST['id']))  {
        $teacher_id = $_POST['id'];
        
        $sql = "SELECT * FROM teacher WHERE teacher_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            // Fetch admission details
            $row = $result->fetch_assoc();
            $email= $row['email'];
            $name= $row['name'];

             // Generate a random password
             $password = generateRandomPassword(); // Implement this function
             
             // Update teacher record with hashed password
             $updateSql = "UPDATE teacher SET password = ?, role = 'teacher' WHERE teacher_id = ?";
             $updateStmt = $conn->prepare($updateSql);
             $updateStmt->bind_param("si", $password, $teacher_id);
             $updateStmt->execute();
             

            $mail = new PHPMailer(true);
            $message = "You are now part of our CampusCompanion family Your login ID: $email Password: $password";
                try {
                   
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'atulgaurav2309@gmail.com';
                    $mail->Password = 'wosa koqk kvhn vxlp';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('atulgaurav2309@gmail.com');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject="Welcome To CampusCompanion";
                    $mail->Body=$message;
                    $mail->send();
                    echo "<script>alert(' Email Sent Successfully');</script>";
                } catch(Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                } 
        } 
    } else {
        echo "Invalid Teacher ID";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
