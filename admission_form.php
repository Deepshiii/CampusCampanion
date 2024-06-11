<?php
include("Includes\dbConnection.php");

$successMessage = "";
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $gender = $_POST['gender'];
    $bloodgroup = $_POST['bloodgroup'];
    $pcontact = $_POST['pcontact'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];

    $tenth_board = $_POST['tenth_board'];
    $tenth_school = $_POST['tenth_school'];
    $tenth_passingyear = $_POST['passing_year'];
    $tenth_total_marks = $_POST['tenth_total'];
    $tenth_percentage = $_POST['tenth_percentage'];

    $twelfth_board = $_POST['twelfth_boards'];
    $twelfth_school = $_POST['twelfth_clg'];
    $twelfth_passingyear = $_POST['passing_year'];
    $twelfth_obtained_marks = $_POST['twelfth_marks'];
    $twelfth_percentage = $_POST['twelfth_percentage'];

    $grad_university = $_POST['grad_boards'];
    $grad_college = $_POST['grad_clg'];
    $grad_passingyear = $_POST['passing_year'];
    $grad_obtained_marks = $_POST['grad_marks'];
    $grad_percentage = $_POST['grad_percentage'];

    $cet_roll = $_POST['cet_roll'];
    $cet_center_name = $_POST['center_name'];
    $cet_center_code = $_POST['center_code'];
    $cet_percentile = $_POST['cet_percentile'];

    // Validate phone number length
    if (strlen($phone) != 10) {
        echo "<script>alert('Phone number must be exactly 10 digits.'); window.history.back();</script>";
        exit();
    }

    if (strlen($pcontact) != 10) {
        echo "<script>alert('Parent\'s contact number must be exactly 10 digits.'); window.history.back();</script>";
        exit();
    }


    // Check for duplicate email or phone number
    $checkQuery = "SELECT * FROM admission WHERE email = '$email' OR phone = '$phone'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Email or phone number already exists.'); window.history.back();</script>";
        exit();
    }

    // Insert data into admission table
    $insertSql = "INSERT INTO admission (ad_id,name,phone,email,father,mother,gender,bgroup,pcontact,address,city,state,pincode,10th_school,10_institute_name,
        10_passing_year,10th_marks,10_percentage,12_board,12_clg,12_passing_year,12_marks,12_percentage,grad_uni,grad_clg,grad_passing_year,
        grad_marks,grad_percentage,cet_roll,cet_center_code,cet_percentile,cet_center_name) 
        VALUES (null,'$name', '$phone', '$email', '$father', '$mother','$gender',' $bloodgroup', '$pcontact', '$address', '$city', '$state', '$pincode', '$tenth_board', '$tenth_school',
        ' $tenth_passingyear', ' $tenth_total_marks', '$tenth_percentage', '$twelfth_board', '$twelfth_school', '$twelfth_passingyear', '$twelfth_obtained_marks', 
        '$twelfth_percentage', '$grad_university', '$grad_college', ' $grad_passingyear', '$grad_obtained_marks', '$grad_percentage', '$cet_roll', '$cet_center_code',
        ' $cet_percentile',' $cet_center_name')";

    if ($conn->query($insertSql) === TRUE) {
        // Retrieve the last inserted ID from the first table
        $first_table_last_insert_id = mysqli_insert_id($conn);

        // Redirect to the file responsible for inserting data into the second table
        header("Location: document_upload.php?id=" . $first_table_last_insert_id);
        // header("Location: document_upload.php");
        exit();
    } else {
        // Redirect to an error page or show an error message
        echo "<script>alert(' Error Occured');</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admission Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./CSS/admissionform.css">
</head>

<body classname="snippet-body">
    <form action="admission_form.php" method="POST">
        <div class="section active" id="personal-section">
            <div class="container-fluid px-1 mx-auto">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                        <div class="card">
                            <h5 class="text-center mb-4">Personal Details</h5>

                            <div class="row text-left">
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">Name<span class="text-danger">*</span></label> <input type="text" id="fname" name="name" placeholder=""> </div>
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">Email<span class="text-danger">*</span></label> <input type="text" id="lname" name="email" placeholder=""> </div>
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">Phone<span class="text-danger">*</span></label> <input type="text" id="phone" name="phone" placeholder=""> </div>
                            </div>

                            <div class="row text-left">
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">Father's Name<span class="text-danger">*</span></label> <input type="text" id="father" name="father" placeholder=""> </div>
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">Mother's Name<span class="text-danger">*</span></label> <input type="text" id="mother" name="mother" placeholder=""> </div>
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">Parents Contact<span class="text-danger">*</span></label> <input type="text" id="pcontact" name="pcontact" placeholder=""> </div>
                            </div>

                            <div class="row text-left">
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">Address<span class="text-danger">*</span></label> <input type="text" id="job" name="address" placeholder=""> </div>
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">City<span class="text-danger">*</span></label> <input type="text" id="city" name="city" placeholder=""> </div>
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">Pincode<span class="text-danger">*</span></label> <input type="text" id="pincode" name="pincode" placeholder=""> </div>
                            </div>

                            <div class="row text-left">
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">State<span class="text-danger">*</span></label> <input type="text" id="state" name="state" placeholder=""> </div>
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">Gender<span class="text-danger">*</span></label> <input type="text" id="gender" name="gender" placeholder=""> </div>
                                <div class="form-group col-md-4 flex-column d-flex"> <label class="form-control-label px-3">Blood Group<span class="text-danger">*</span></label> <input type="text" id="bloodgroup" name="bloodgroup" placeholder=""> </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="form-group col-sm-6">
                                    <button class="btn-block btn-primary move-to-next">Next Section</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section" id="educational-section">
            <div class="container-fluid px-1 py-5 mx-auto">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                        <div class="card edu">
                            <h3>Educational Details</h3>
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
                                        <td><input type="text" name="tenth_board" class="form-control"></td>
                                        <td><input type="text" name="tenth_school" class="form-control"></td>
                                        <td><input type="date" name="passing_year" class="form-control"></td>
                                        <td><input type="text" name="tenth_total" class="form-control"></td>
                                        <td><input type="text" name="tenth_percentage" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th>12th Details</th>
                                        <td><input type="text" name="twelfth_boards" class="form-control"></td>
                                        <td><input type="text" name="twelfth_clg" class="form-control"></td>
                                        <td><input type="date" name="passing_year" class="form-control"></td>
                                        <td><input type="text" name="twelfth_marks" class="form-control"></td>
                                        <td><input type="text" name="twelfth_percentage" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th>Graduation Details</th>
                                        <td><input type="text" name="grad_boards" class="form-control"></td>
                                        <td><input type="text" name="grad_clg" class="form-control"></td>
                                        <td><input type="date" name="passing_year" class="form-control"></td>
                                        <td><input type="text" name="grad_marks" class="form-control"></td>
                                        <td><input type="text" name="grad_percentage" class="form-control"></td>
                                    </tr>
                                </tbody>

                            </table>
                            <div class="row justify-content-center">
                                <div class="form-group col-sm-6">
                                    <button class="btn-block btn-primary move-to-next">Next Section</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="section" id="cet-section">
            <div class="container-fluid px-1 py-5 mx-auto">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                        <div class="card cet">
                            <h3>CET Details</h3>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">CET ROLL<span class="text-danger">*</span></label> <input type="text" id="cet_roll" name="cet_roll" placeholder=""> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">CET Center Name<span class="text-danger">*</span></label> <input type="text" id="cet_name" name="center_name" placeholder=""> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">CET Center Code<span class="text-danger">*</span></label> <input type="text" id="cet_code" name="center_code" placeholder=""> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Percetile<span class="text-danger">*</span></label>
                                    <input type="text" id="cet_percentile" name="cet_percentile" placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            // Function to move to the next section
            function moveToNextSection(currentSection) {
                currentSection.hide(); // Hide the current section
                currentSection.next('.section').show(); // Show the next section
            }

            // Click event listener for the buttons in personal and educational sections
            $('.move-to-next').click(function(event) {
                event.preventDefault(); // Prevent the default form submission behavior
                var currentSection = $(this).closest('.section');
                moveToNextSection(currentSection);
            });
        });
    </script>


</body>

</html>