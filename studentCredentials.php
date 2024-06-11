<?php

include("Includes\dbConnection.php");

// Include PHPMailer classes and setup
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Function to generate a random password
function generateRandomPassword($length = 8)
{
    if ($length < 8) {
        throw new InvalidArgumentException('Password length must be at least 8 characters.');
    }
    
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digits = '0123456789';
    $special = '!@#$%^&*()-_=?';

    $allCharacters = $lowercase . $uppercase . $digits . $special;

    // Ensuring at least one character from each required set
    $password = $lowercase[rand(0, strlen($lowercase) - 1)];
    $password .= $uppercase[rand(0, strlen($uppercase) - 1)];
    $password .= $special[rand(0, strlen($special) - 1)];

    // Fill the rest of the password length with random characters
    for ($i = 3; $i < $length; $i++) {
        $password .= $allCharacters[rand(0, strlen($allCharacters) - 1)];
    }

    // Shuffle the password to ensure randomness
    $password = str_shuffle($password);

    return $password;
}


try {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $student_id = $_POST['id'];

        $sql = "SELECT * FROM admission WHERE ad_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch admission details
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $phone = $row['phone'];
            $email = $row['email'];
            $father = $row['father'];
            $mother = $row['mother'];
            $gender = $row['gender'];
            $bgroup = $row['bgroup'];
            $pcontact = $row['pcontact'];
            $address = $row['address'];
            $city = $row['city'];
            $state = $row['state'];
            $pincode = $row['pincode'];

            $tenth_school = $row['10th_school'];
            $tenth_institute_name = $row['10_institute_name'];
            $tenth_passing_year = $row['10_passing_year'];
            $tenth_marks = $row['10th_marks'];
            $tenth_percentage = $row['10_percentage'];

            $twelfth_board = $row['12_board'];
            $twelfth_clg = $row['12_clg'];
            $twelfth_passing_year = $row['12_passing_year'];
            $twelfth_marks = $row['12_marks'];
            $twelfth_percentage = $row['12_percentage'];

            $grad_uni = $row['grad_uni'];
            $grad_clg = $row['grad_clg'];
            $grad_passing_year = $row['grad_passing_year'];
            $grad_marks = $row['grad_marks'];
            $grad_percentage = $row['grad_percentage'];

            $cet_roll = $row['cet_roll'];
            $cet_center_code = $row['cet_center_code'];
            $cet_center_name = $row['cet_center_name'];
            $cet_percentile = $row['cet_percentile'];

            // Generate a random password
            $password = generateRandomPassword(); // Implement this function

            //inserting into student table

            $insertSql = "INSERT INTO student (ad_id,id,role,password,name,phone,email,father,mother,gender,bgroup,pcontact,address,city,state,pincode,10th_school,10_institute_name,
             10_passing_year,10th_marks,10_percentage,12_board,12_clg,12_passing_year,12_marks,12_percentage,grad_uni,grad_clg,grad_passing_year,
             grad_marks,grad_percentage,cet_roll,cet_center_code,cet_percentile,cet_center_name) 
             VALUES ('$student_id',null,'student','$password','$name', '$phone', '$email', '$father', '$mother','$gender',' $bloodgroup', '$pcontact', '$address', '$city', '$state', '$pincode', '$tenth_board', '$tenth_school',
             ' $tenth_passingyear', ' $tenth_total_marks', '$tenth_percentage', '$twelfth_board', '$twelfth_school', '$twelfth_passingyear', '$twelfth_obtained_marks', 
             '$twelfth_percentage', '$grad_university', '$grad_college', ' $grad_passingyear', '$grad_obtained_marks', '$grad_percentage', '$cet_roll', '$cet_center_code',
             ' $cet_percentile',' $cet_center_name')";

            if ($conn->query($insertSql) === TRUE) {
                $mail = new PHPMailer(true);
                $message = "Dear $name ,You are now part of our CampusCompanion family Your login ID: $email Password: $password you can login to browse";
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
                    $mail->Subject = "Welcome To CampusCompanion";
                    $mail->Body = $message;
                    $mail->send();
                    echo "<script>alert(' Email Sent Successfully');</script>";
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                // Redirect to an error page or show an error message
                echo "<script>alert(' Error Occured');</script>";
                exit();
            }
        }
    } else {
        echo "Invalid Student ID";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
