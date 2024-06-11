<?php

include("Includes\dbConnection.php");

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $admissionID = $_POST['id'];
    // Query database to retrieve admission details based on the admission ID
    $sql = "SELECT * FROM admission WHERE ad_id = $admissionID";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch admission details
        $row = mysqli_fetch_assoc($result);
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View Admission</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f8f8f8;
                    margin: 0;
                    padding: 0;
                }

                main {
                    max-width: 800px;
                    margin: 20px auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                h1,
                h2,
                h3 {
                    color: #333;
                }

                section {
                    margin-bottom: 20px;
                }

                label {
                    font-weight: bold;
                }

                p {
                    margin: 5px 0;
                }
            </style>
        </head>

        <body>
            <main>
                <center>
                    <h1>Student Admission Form</h1>
                </center>
                <section class="personal">
                    <h2>Personal Details:</h2>

                    <table>
                        <tr>
                            <!-- photograph -->
                            <th>Photograph</th>
                            <td>
                                <?php
                                // Query to fetch photograph path based on admission ID
                                $sql_photo = "SELECT photograph FROM documents WHERE ad_id = $admissionID";
                                $result_photo = mysqli_query($conn, $sql_photo);

                                if (mysqli_num_rows($result_photo) > 0) {
                                    $row_photo = mysqli_fetch_assoc($result_photo);
                                    // Check if photograph path is not empty
                                    if (!empty($row_photo['photograph'])) {
                                        // Assuming photograph field stores the filename of the image file
                                        $photographFilename = $row_photo['photograph'];
                                        $photographPath = './Student_admission_Documents/' . $photographFilename;
                                        // Display the image using img tag
                                        echo "<img src='$photographPath' alt='Student Photograph' style='max-width: 25%; height: auto;'>";
                                    } else {
                                        echo "Photograph not available";
                                    }
                                } else {
                                    echo "No photograph found";
                                }
                                ?>

                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $row['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?php echo $row['phone']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                        <tr>
                            <th>Father's Name</th>
                            <td><?php echo $row['father']; ?></td>
                        </tr>
                        <tr>
                            <th>Mother's Name</th>
                            <td><?php echo $row['mother']; ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo $row['gender']; ?></td>
                        </tr>
                        <tr>
                            <th>Blood Group</th>
                            <td><?php echo $row['bgroup']; ?></td>
                        </tr>
                        <tr>
                            <th>Parents Contact Number</th>
                            <td><?php echo $row['pcontact']; ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo $row['address']; ?></td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td><?php echo $row['city']; ?></td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td><?php echo $row['state']; ?></td>
                        </tr>
                        <tr>
                            <th>Pincode</th>
                            <td><?php echo $row['pincode']; ?></td>
                        </tr>
                    </table>
                </section>

                <section class="education">
                    <h2>Educational Qualifications:</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Class</th>
                                <th scope="col">University/Board</th>
                                <th scope="col">Name of Institution</th>
                                <th scope="col">Passing Year</th>
                                <th scope="col">Marks</th>
                                <th scope="col">Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>10th Details</th>
                                <td><?php echo $row['10th_school']; ?></td>
                                <td><?php echo $row['10_institute_name']; ?></td>
                                <td><?php echo $row['10_passing_year']; ?></td>
                                <td><?php echo $row['10th_marks']; ?></td>
                                <td><?php echo $row['10_percentage']; ?></td>
                            </tr>
                            <tr>
                                <th>12th Details</th>
                                <td><?php echo $row['12_board']; ?></td>
                                <td><?php echo $row['12_clg']; ?></td>
                                <td><?php echo $row['12_passing_year']; ?></td>
                                <td><?php echo $row['12_marks']; ?></td>
                                <td><?php echo $row['12_percentage']; ?></td>
                            </tr>
                            <tr>
                                <th>Graduation Details</th>
                                <td><?php echo $row['grad_uni']; ?></td>
                                <td><?php echo $row['grad_clg']; ?></td>
                                <td><?php echo $row['grad_passing_year']; ?></td>
                                <td><?php echo $row['grad_marks']; ?></td>
                                <td><?php echo $row['grad_percentage']; ?></td>
                            </tr>
                        </tbody>

                    </table>
                </section>

                <section class="cet_details">
                    <h2>CET Details:</h2>

                    <table>
                        <tr>
                            <th>CET Roll Number</th>
                            <td><?php echo $row['cet_roll'] ?></td>
                        </tr>
                        <tr>
                            <th>CET Percentile</th>
                            <td><?php echo $row['cet_percentile']; ?></td>
                        </tr>
                        <tr>
                            <th>CET Center Code</th>
                            <td><?php echo $row['cet_center_code']; ?></td>
                        </tr>
                        <tr>
                            <th>CET Center Name</th>
                            <td><?php echo $row['cet_center_name']; ?></td>
                        </tr>
                    </table>
                </section>
            </main>
        </body>

        </html>

<?php
    } else {
        // No admission found with the given ID
        echo "No admission found with the given ID.";
    }
} else {
    // Invalid or missing admission ID
    echo "Invalid or missing admission ID.";
}
?>