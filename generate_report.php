<?php
// generate_report.php
include("Includes/dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Ensure dates are provided
    if (empty($startDate) || empty($endDate)) {
        echo "Start date and end date are required.";
        exit;
    }

    // Validate date format yyyy-mm-dd
    if (!validateDate($startDate, 'Y-m-d') || !validateDate($endDate, 'Y-m-d')) {
        echo "Invalid date format. Please use yyyy-mm-dd.";
        exit;
    }

    // Dates are already in Y-m-d format from the form, so no conversion needed
    $startDate = mysqli_real_escape_string($conn, $startDate);
    $endDate = mysqli_real_escape_string($conn, $endDate);

    $query = "SELECT * FROM admission WHERE date_of_admission BETWEEN '$startDate' AND '$endDate'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Query Failed: " . mysqli_error($conn);
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        // Store result data in a session variable for use in the download script
        session_start();
        $_SESSION['reportData'] = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Report</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }
                th {
                    background-color: #f2f2f2;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
                h1 {
                    text-align: center;
                }
                .no-records {
                    text-align: center;
                    font-weight: bold;
                    color: red;
                }
                .download-button {
                    display: block;
                    width: 200px;
                    margin: 20px auto;
                    padding: 10px;
                    background-color: #4CAF50;
                    color: white;
                    text-align: center;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .download-button:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
            <h1>Admission Report</h1>
            <table>
                <tr>";
        
        // Output table headers
        while ($fieldinfo = mysqli_fetch_field($result)) {
            echo "<th>{$fieldinfo->name}</th>";
        }
        
        echo "</tr>";
        
        // Output table rows
        mysqli_data_seek($result, 0); // Reset result pointer
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $data) {
                echo "<td>$data</td>";
            }
            echo "</tr>";
        }
        
        echo "</table>
            <a class='download-button' href='download_excel.php'>Download Report</a>
        </body>
        </html>";
    } else {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Report</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                }
                .no-records {
                    text-align: center;
                    font-weight: bold;
                    color: red;
                    margin-top: 50px;
                }
            </style>
        </head>
        <body>
            <div class='no-records'>No records found.</div>
        </body>
        </html>";
    }
} else {
    echo "Invalid request method.";
}

// Function to validate date format
function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
?>

