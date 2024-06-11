<?php
session_start();
include("Includes\dbConnection.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    
    // Check if email already exists in the database
    $checkEmailSql = "SELECT * FROM teacher WHERE email = ?";
    $stmt = $conn->prepare($checkEmailSql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists');</script>";
        // Redirect back to teacherRegister.php
        // header("Location: teacherRegister.php");
        exit();
    }
    
    // If email is not found, proceed with insertion
    $insertSql = "INSERT INTO teacher (teacher_id, name, phone, email, address, qualification, experience) 
                  VALUES (Null, ?, ?, ?, ?, ?, ?)";
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("ssssss", $name, $phone, $email, $address, $qualification, $experience);
    
    if ($stmt->execute()) {
        echo "<script>alert('Added Successfully');</script>";
        // Redirect to index.php after successful submission
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Error Occurred');</script>";
        // Redirect to teacherRegister.php in case of error
        header("Location: teacherRegister.php");
        exit();
    }
    
    $stmt->close();
    
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration Form</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .bg-white {
            max-height: 650px; 
            margin: auto;
        }
    </style>
   
</head>
<body>
    <!-- Registration 2 - Bootstrap Brain Component -->
    <div class="bg-light py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
                    <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <h2 class="h3">Teacher Registration</h2>
                                </div>
                            </div>
                        </div>
                        <form action="teacherRegister.php" method="POST">
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Your name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone" id="text" placeholder="Enter your contact" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address" id="address" value="" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="qualification" class="form-label">Qualification <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="qualification" id="qualification" value="" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="experience" class="form-label">Experience <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="experience" id="experience" value="" required>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                                        <label class="form-check-label text-secondary" for="iAgree">
                                            I agree to the <a href="#!" class="link-primary text-decoration-none">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-lg btn-primary" type="submit">Sign up</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

 <!-- <center><h2>Teacher Registration Form</h2></center>
    <div class="container">
    <form action="teacherRegister.php" method="POST">
        <label for="name">Teacher Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="phone">Email:</label>
        <input type="text" id="email" name="email" required><br><br>

        <label for="phone">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea><br><br>

        <label for="qualification">Qualification:</label>
        <input type="text" id="qualification" name="qualification" required><br><br>

        <label for="experience">Experience (in years):</label>
        <input type="text" id="experience" name="experience" required><br><br>

        <input type="submit" value="Submit">
    </form>
    </div> -->