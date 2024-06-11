<?php
session_start();
include("Includes\dbConnection.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    

    // Insert data into enquiry table
    $insertSql = "INSERT INTO enquiry (e_id, name, email, phone, message) 
                  VALUES (Null, ?, ?, ?, ?)";
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Sent Successfully');</script>";
        // Redirect to index.php after successful submission
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Error Occurred');</script>";
        // Redirect to enquiry.php in case of error
        header("Location: enquiry.php");
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="CSS\enquiry.css" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="container">
      <span class="big-circle"></span>
      <img src="img/shape.png" class="square" alt="" />
      <div class="form">
        <div class="contact-info">
          <h3 class="title">Let's get in touch</h3>
          <p class="text">
           Having issues? No worries! Reach out to us anytime and we'll happily answer your questions.

          </p>

          <div class="info">
            <div class="information">
              <img src="img/location.png" class="icon" alt="" />
              <p>Campus Companion, Pune, Pin-90112</p>
            </div>
            <div class="information">
              <img src="img/email.png" class="icon" alt="" />
              <p>campuscompanion@gmail.com</p>
            </div>
            <div class="information">
              <img src="img/phone.png" class="icon" alt="" />
              <p>123 456 7899</p>
            </div>
          </div>

          <div class="social-media">
            <p>Connect with us :</p>
            <div class="social-icons">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

          <form action="enquiry.php" method="POST" autocomplete="off">
            <h3 class="title">Contact us</h3>
            <div class="input-container">
              <input type="text" name="name" class="input" />
              <label for="">Name</label>
              <span>Name</span>
            </div>
            <div class="input-container">
              <input type="email" name="email" class="input" />
              <label for="">Email</label>
              <span>Email</span>
            </div>
            <div class="input-container">
              <input type="tel" name="phone" class="input" />
              <label for="">Phone</label>
              <span>Phone</span>
            </div>
            <div class="input-container textarea">
              <textarea name="message" class="input"></textarea>
              <label for="">Message</label>
              <span>Message</span>
            </div>
            <input type="submit" name="send" value="Send" class="btn" />
          </form>
        </div>
      </div>
    </div>

    <script src="js\app.js"></script>
  </body>
</html>
