<?php
session_start();
include("Includes\dbConnection.php");

// Include PHPMailer classes and setup
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

try {
    if(isset($_POST['id']) && is_numeric($_POST['id']))  {
        $adm_id = $_POST['id'];
        
        $sql = "SELECT * FROM admission WHERE ad_id = $adm_id";
        $result = mysqli_query($conn, $sql);

        if($result->num_rows > 0) {
            // Fetch admission details
            $row = $result->fetch_assoc();
            $email= $row['email'];
                $mail = new PHPMailer(true);
                try {
                    $message = "Your Documents have been successfully verified. Please pay fees to take admission. Your admission ID is: $adm_id";
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
                    $mail->Subject="Document Approval";
                    $mail->Body=$message;
                    $mail->send();
                    echo "<script>alert('Sent Successfully');</script>";
                } catch(Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                } 
        } 
    } else {
        echo "Invalid admission ID";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
