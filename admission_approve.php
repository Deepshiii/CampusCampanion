<?php
    session_start();
    include("Includes\dbConnection.php");
    try {
        if(isset($_POST['id']) && is_numeric($_POST['id']))  {
            $adm_id = $_POST['id'];

            $sql = "SELECT * FROM admission WHERE ad_id = $adm_id";
            $result = mysqli_query($conn, $sql);
    
            if($result->num_rows > 0) {
                // Fetch admission details
                $row = $result->fetch_assoc();
    
                // Insert data into the student table
                $name = $row['name'];
                $phone = $row['phone'];
                $email = $row['email'];
                $father = $row['father'];
                $mother = $row['mother'];
                $pcontact = $row['pcontact'];
                $address = $row['address'];
                $city = $row['city'];
                $state = $row['state'];
                $pincode = $row['pincode'];
                $tenth_board = $row['tenth_board'];
                $tenth_school = $row['tenth_school'];
                $tenth_marks = $row['tenth_marks'];
                $tenth_total = $row['tenth_total'];
                $tenth_percentage = $row['tenth_percentage'];
                $twelfth_boards = $row['twelfth_boards'];
                $twelfth_clg = $row['twelfth_clg'];
                $twelfth_marks = $row['twelfth_marks'];
                $twelfth_total = $row['twelfth_total'];
                $twelfth_percentage = $row['twelfth_percentage'];
                $grad_boards = $row['grad_boards'];
                $grad_clg = $row['grad_clg'];
                $grad_marks = $row['grad_marks'];
                $grad_total = $row['grad_total'];
                $grad_percentage = $row['grad_percentage'];
                $cet_roll = $row['cet_roll'];
                $cet_percentile = $row['cet_percentile'];

                $insertSql = "INSERT INTO student (id, name, phone, email, father, mother, pcontact, address, city, state, pincode, tenth_board, tenth_school, tenth_marks, tenth_total, tenth_percentage, twelfth_boards, twelfth_clg, twelfth_marks, twelfth_total, twelfth_percentage, grad_boards, grad_clg, grad_marks, grad_total, grad_percentage, cet_roll, cet_percentile) 
                             VALUES ($adm_id, '$name', '$phone', '$email','$father', '$mother', $pcontact, '$address', '$city', '$state', '$pincode', '$tenth_board', '$tenth_school', '$tenth_marks', '$tenth_total', '$tenth_percentage', '$twelfth_boards', '$twelfth_clg', '$twelfth_marks', '$twelfth_total', '$twelfth_percentage', '$grad_boards', '$grad_clg', '$grad_marks', '$grad_total', '$grad_percentage', '$cet_roll', '$cet_percentile')";

                if ($conn->query($insertSql) === TRUE) {
                    // echo "New record inserted successfully";
                    header("Location: ".$_SERVER['PHP_SELF']); // Redirect to the same page
                    exit();
                } else {
                    echo "Error: " . $insertSql . "<br>" . $conn->error;
                }
            } else {
                echo "No admission found with the given ID.";
            } 
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    
    
?>
