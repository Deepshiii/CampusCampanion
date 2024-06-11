<?php
session_start();

// Include necessary files
include("Includes/dbConnection.php");
require 'instamojo/Instamojo.php';

// Retrieve form data
$admissionId = $_POST['admission_id'];
$name = $_POST['name'];
$contact = $_POST['contact_number'];
$email = $_POST['email'];

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, 
  array(
    'X-Api-Key:test_75f777d25c13406752ceb85308a',
    'X-Auth-Token:test_c73918129951ca4f39335fd835c'
));

// Payment payload
$payload = array(
    'purpose' => 'Fee Payment',
    'amount' => '91709',
    'buyer_name' => $name,
    'email' => $email,
    'phone' => $contact,
    'redirect_url' => 'http://localhost/CAMPUSCOMPANION/thankyou.php',
    'send_email' => 'True',
    'allow_repeated_payments' => 'False',
);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch);

// Process the response
$response = json_decode($response, true);
// echo "<pre>";
// print_r($response)

if ($response['success']) {
    
    $p_id = $response['payment_request']['id'];
    $name = $conn->real_escape_string($name);
    $contact = $conn->real_escape_string($contact);
    $email = $conn->real_escape_string($email);
    $admissionId = $conn->real_escape_string($admissionId);

    // Insert Payment Transaction Details
    $sqlQuery = "INSERT INTO paymentdetails (payment_id, amount, name, contact_number, email, ad_id) 
               VALUES ('$p_id', 91709, '$name', '$contact', '$email', '$admissionId')";

    if ($conn->query($sqlQuery)) {
        echo "<script>alert('Payment Link has been sent you can pay'); setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";

    } else {
        // If the SQL query fails
        echo "Error: " . $conn->error;
    }
} else {
    // If the payment request was not successful
    echo "Payment request failed: " . ($response ? $response['error_message'] : "Unknown error");
}
?>

