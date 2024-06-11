<?php
session_start();
// Check if the session variable 'name' is set
if (isset($_SESSION['name'])) {
    $adminName = $_SESSION['name'];
} else {
    // Redirect to login page if the session variable is not set
    header('Location: login.php');
    exit();
}
include("Includes\dbConnection.php");
//class count
$sql = "SELECT COUNT(*) as total_classes FROM class";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_classes = $row["total_classes"];
    } else {
        $total_classes = 0;
    }
}
//notice count
$notice = "SELECT COUNT(*) as total_notice FROM notice";
$r1 = $conn->query($notice);
if (!$r1) {
    echo "Error: " . $conn->error;
} else {
    if ($r1->num_rows > 0) {
        $row = $r1->fetch_assoc();
        $total_notice = $row["total_notice"];
    } else {
        $total_notice = 0;
    }
}
// Fetch total students
$stu = "SELECT COUNT(*) as total_student FROM student";
$a = $conn->query($stu);
if (!$a) {
    echo "Error: " . $conn->error;
} else {
    $total_student = ($a->num_rows > 0) ? $a->fetch_assoc()['total_student'] : 0;
}

// Fetch gender counts
$query = "SELECT gender, COUNT(*) as count FROM student GROUP BY gender";
$result = mysqli_query($conn, $query);

$dataPointsGender = array();
while ($row = mysqli_fetch_assoc($result)) {
    $gender = $row['gender'];
    $count = (int)$row['count'];
    $dataPointsGender[] = array("label" => $gender, "y" => $count);
}

// Fetch feedback counts
$feedbackQuery = "
    SELECT 
        'college_experience' as parameter, SUM(college_experience) as total 
    FROM collegefeedback
    UNION ALL
    SELECT 
        'teacher_effectiveness' as parameter, SUM(teacher_effectiveness) as total 
    FROM collegefeedback
    UNION ALL
    SELECT 
        'classroom_facilities' as parameter, SUM(classroom_facilities) as total 
    FROM collegefeedback
    UNION ALL
    SELECT 
        'support_services' as parameter, SUM(support_services) as total 
    FROM collegefeedback
    UNION ALL
    SELECT 
        'campus_infrastructure' as parameter, SUM(campus_infrastructure) as total 
    FROM collegefeedback";

$feedbackResult = mysqli_query($conn, $feedbackQuery);

$feedbackCounts = [
    'college_experience' => 0,
    'teacher_effectiveness' => 0,
    'classroom_facilities' => 0,
    'support_services' => 0,
    'campus_infrastructure' => 0,
];

while ($row = mysqli_fetch_assoc($feedbackResult)) {
    $parameter = $row['parameter'];
    $total = (int)$row['total'];

    if (isset($feedbackCounts[$parameter])) {
        $feedbackCounts[$parameter] = $total;
    }
}

$dataPointsFeedback = [];
foreach ($feedbackCounts as $parameter => $total) {
    $dataPointsFeedback[] = ["label" => str_replace('_', ' ', ucfirst($parameter)), "y" => $total];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="./css/adminstyle.css">


    <!-- This is for displaying bar graph -->
    <script>
        window.onload = function() {
            var chartGender = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Student Gender Distribution"
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($dataPointsGender, JSON_NUMERIC_CHECK); ?>
                }]
            });

            chartGender.render();

            var chartFeedback = new CanvasJS.Chart("chartContainerFeedback", {
                animationEnabled: true,
                title: {
                    text: "Feedback Ratings Distribution"
                },
                axisY: {
                    title: "Total Score"
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($dataPointsFeedback, JSON_NUMERIC_CHECK); ?>
                }]
            });

            chartFeedback.render();
        }
    </script>
    <!-- Feedback section -->

</head>

<body>
    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <h2>Welcome<span class="danger"><?php echo $adminName; ?></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="#" class="sidebar-link " data-section="dashboard-section">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#" class="sidebar-link" data-section="admission-section">
                    <span class="material-icons-sharp">assignment</span>
                    <h3>Admission</h3>
                </a>
                <a href="#" class="sidebar-link" data-section="admissionPayment-section">
                    <span class="material-icons-sharp">assignment</span>
                    <h3>Admission Payment</h3>
                </a>
                <a href="#" class="sidebar-link" data-section="student-section">
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>Student</h3>
                </a>
                <a href="#" class="sidebar-link" data-section="teacher-section">
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>Teacher</h3>
                </a>
                <a href="#" class="sidebar-link" data-section="class-section">
                    <span class="material-icons-sharp">insights</span>
                    <h3>Class</h3>
                </a>

                <!-- <a href="#" class="sidebar-link" data-section="notice-section">
                    <span class="material-icons-sharp">note</span>
                    <h3>Notice</h3>
                </a> -->

                <a href="#" class="sidebar-link" data-section="report-section">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Report</h3>
                </a>
                <a href="logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <div class="section" id="dashboard-section">
                <h1>Database Statistics</h1>
                <div class="analyse">
                    <div class="sales">
                        <div class="status">
                            <div class="info">
                                <h3>Total Class</h3>
                                <h1><?php echo $total_classes; ?></h1>
                            </div>

                        </div>
                    </div>
                    <div class="visits">
                        <div class="status">
                            <div class="info">
                                <h3>Total Student</h3>
                                <h1><?php echo $total_student; ?></h1>
                            </div>

                        </div>
                    </div>
                    <div class="searches">
                        <div class="status">
                            <div class="info">
                                <h3>Notice Count</h3>
                                <h1><?php echo $total_notice; ?></h1>
                            </div>

                        </div>
                    </div>

                </div>
                <div id="chartContainer" style="height: 300px; width: 800px;"></div>
                <div id="chartContainerFeedback" style="height: 300px; width: 100%;"></div>

            </div>
            <div class="section" id="admission-section">
                <h1>Admission Details</h1>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <th>AID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Parent Contact</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Pincode</th>
                                <th>CET Roll</th>
                                <th>CET Percentile</th>
                                <th>Cancel </th>
                                <th>Approve </th>
                                <th>View Details</th>
                            </thead>
                            <tbody>

                                <?php
                                //this is for displaying admission record table
                                $selectQuery = "select * from admission";
                                $squery = mysqli_query($conn, $selectQuery);

                                while (($result = mysqli_fetch_assoc($squery))) {
                                ?>
                                    <tr>
                                        <td><?php echo $result['ad_id']; ?></td>
                                        <td><?php echo $result['name']; ?></td>
                                        <td><?php echo $result['phone']; ?></td>
                                        <td><?php echo $result['email']; ?></td>
                                        <td><?php echo $result['pcontact']; ?></td>
                                        <td><?php echo $result['city']; ?></td>
                                        <td><?php echo $result['state']; ?></td>
                                        <td><?php echo $result['pincode']; ?></td>
                                        <td><?php echo $result['cet_roll']; ?></td>
                                        <td><?php echo $result['cet_percentile']; ?></td>
                                        <td><button class='delete-btn' onclick=rejectAdmission(<?php echo $result['ad_id']; ?>)>Reject</button></td>
                                        <td><button name="send" class='approve-btn' onclick=approveAdmission(<?php echo $result['ad_id']; ?>)>Approve</button></td>
                                        <td><button class='view-btn' onclick=viewAdmission(<?php echo $result['ad_id']; ?>)>View</button></td>

                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="admissionPayment-section">
                <h1>Admission Payment</h1>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <th>AdmissionID</th>
                                <th>PaymentID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Student Credentials</th>
                            </thead>
                            <tbody>
                                <?php
                                //this is for displaying admission record table
                                $selectQuery = "select * from paymentdetails";
                                $squery = mysqli_query($conn, $selectQuery);

                                while (($result = mysqli_fetch_assoc($squery))) {
                                ?>
                                    <tr>
                                        <td><?php echo $result['ad_id']; ?></td>
                                        <td><?php echo $result['payment_id']; ?></td>
                                        <td><?php echo $result['name']; ?></td>
                                        <td><?php echo $result['email']; ?></td>
                                        <td><?php echo $result['contact_number']; ?></td>
                                        <td><button class='view-btn' onclick=sendCredentialsToStudent(<?php echo $result['ad_id']; ?>)>Send</button></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="student-section">
                <h1>Admitted Students</h1>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <th>AdmissionID</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Parent Contact</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Pincode</th>
                                <th>View Student Details</th>
                            </thead>
                            <tbody>

                                <?php
                                //this is for displaying admission record table
                                $selectQuery = "select * from student";
                                $squery = mysqli_query($conn, $selectQuery);

                                while (($result = mysqli_fetch_assoc($squery))) {
                                ?>
                                    <tr>
                                        <td><?php echo $result['ad_id']; ?></td>
                                        <td><?php echo $result['id']; ?></td>
                                        <td><?php echo $result['name']; ?></td>
                                        <td><?php echo $result['phone']; ?></td>
                                        <td><?php echo $result['email']; ?></td>
                                        <td><?php echo $result['pcontact']; ?></td>
                                        <td><?php echo $result['city']; ?></td>
                                        <td><?php echo $result['state']; ?></td>
                                        <td><?php echo $result['pincode']; ?></td>
                                        <td><button class='view-btn' onclick=newStudent(<?php echo $result['id']; ?>)>View</button></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="teacher-section">
                <h1>Registered Teacher</h1>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>

                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Qualification</th>
                                <th>Experience</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                //this is for displaying admission record table
                                $selectQuery = "select * from teacher";
                                $squery = mysqli_query($conn, $selectQuery);

                                while (($result = mysqli_fetch_assoc($squery))) {
                                ?>
                                    <tr>
                                        <td><?php echo $result['teacher_id']; ?></td>
                                        <td><?php echo $result['name']; ?></td>
                                        <td><?php echo $result['phone']; ?></td>
                                        <td><?php echo $result['email']; ?></td>
                                        <td><?php echo $result['phone']; ?></td>
                                        <td><?php echo $result['address']; ?></td>
                                        <td><?php echo $result['qualification']; ?></td>
                                        <td><?php echo $result['experience']; ?></td>
                                        <td><button class='view-btn' onclick=sendCredentials(<?php echo $result['teacher_id']; ?>)>Send Credentials</button></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="class-section">
                <h1>This is class section</h1>
                <center>
                    <h2>MCA Timetable</h2>
                </center>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; background-color: #f2f2f2;">Time / Day</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; background-color: #f2f2f2;">09:45-10:45</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; background-color: #f2f2f2;">10:45-11:45</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; background-color: #f2f2f2;">11:45-12:00</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; background-color: #f2f2f2;">12:00-01:00</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; background-color: #f2f2f2;">01:00-02:00</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; background-color: #f2f2f2;">02:00-02:45</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; background-color: #f2f2f2;">02:45-03:45</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; background-color: #f2f2f2;">03:45-04:45</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center; background-color: #f2f2f2;">04:45-05:15</th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Monday</th>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">OC4</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">Python Prog</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" rowspan="6">S<br>H<br>O<br>R<br>T<br><br>R<br>E<br>C<br>E<br>S<br>S</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">SPM</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">ADBMS</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" rowspan="6">L<br>O<br>N<br>G<br><br><br>R<br>E<br>C<br>E<br>S<br>S</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" colspan="2">AIT Lab</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">Guide Interaction<br>(Mini Project)</td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Tuesday</th>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">Python Prog</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">OT</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">AIT</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">SPM</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" colspan="2">Python Lab</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">Guide Interaction<br>(Mini Project)</td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Wednesday</th>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" colspan="2">Language Lab/SS-II</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">OC3</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">OT</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" colspan="2">Mini Project-II</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">Guide Interaction<br>(Mini Project)</td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Thursday</th>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">AIT</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">Python Prog</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">SPM</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">Tutorial/Theory Practical/HR</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" colspan="2">AIT Lab</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">Guide Interaction<br>(Mini Project)</td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Friday</th>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">ADBMS</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">AIT</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">OT</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">ADBMS</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" colspan="2">Python Lab</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">Guide Interaction<br>(Mini Project)</td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Saturday</th>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">AIT Lab</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">Python Lab</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" colspan="2">Mini Project-II</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" colspan="2">Academic Activity/Tutorial/Theory Practical/HR</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">Guide Interaction<br>(Mini Project)</td>
                    </tr>
                    <!-- Add similar rows for other days -->
                </table>
            </div>
            <!-- <div class="section" id="notice-section"> -->
            <!-- Content for notice section -->
            <!-- </div> -->
            <div class="section" id="report-section">
                <!-- Content for report section -->
                <h1>Feedback submit button</h1>
                <button class='view-btn' onclick=updateFeedback()>Activate/Deactivate Feedback</button>
                <h1>Reports</h1>

                <form id="reportForm" method="POST" action="generate_report.php" style="width: 100%; margin: auto;  margin-bottom: 20px; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); background-color: #f9f9f9;">
                    <h2 style="text-align: center; color: #333; margin-bottom: 20px;"><b>Admission Data:</b></h2>

                    <div style="margin-bottom: 15px;">
                        <label for="startDate" style="display: block; margin-bottom: 5px; color: #555;">Start Date:</label>
                        <input type="date" id="startDate" name="startDate" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="endDate" style="display: block; margin-bottom: 5px; color: #555;">End Date:</label>
                        <input type="date" id="endDate" name="endDate" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <div style="text-align: center;">
                        <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; ; margin-bottom: 20px;">Generate Report</button>
                    </div>
                </form>

                <form id="paymentReportForm" method="POST" action="generate_payment_report.php" style="width: 100%;; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); background-color: #f9f9f9;">
                    <h2 style="text-align: center; color: #333; margin-bottom: 20px;"><b>Fee collection Report:</b></h2>

                    <div style="margin-bottom: 15px;">
                        <label for="paymentStartDate" style="display: block; margin-bottom: 5px; color: #555;">Start Date:</label>
                        <input type="date" id="paymentStartDate" name="paymentStartDate" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="paymentEndDate" style="display: block; margin-bottom: 5px; color: #555;">End Date:</label>
                        <input type="date" id="paymentEndDate" name="paymentEndDate" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <div style="text-align: center;">
                        <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Generate Report</button>
                    </div>
                </form>


            </div>
    </div>

    </div>
    </main>
    <!-- End of Main Content -->
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".sidebar-link").click(function() {
                var sectionId = $(this).data("section");
                $(".section").hide();
                $("#" + sectionId).show();
            });
        });
    </script>
    <script>
        function rejectAdmission(admissionID) {
            $.ajax({
                type: 'POST',
                url: 'admission_delete.php',
                data: {
                    id: admissionID
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(xhr, status, error) {

                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    <script>
        function viewAdmission(admissionID) {
            $.ajax({
                type: 'POST',
                url: 'admission_view.php',
                data: {
                    id: admissionID
                },
                success: function(response) {
                    console.log(response);
                    $('body').html(response);

                },
                error: function(xhr, status, error) {

                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    <script>
        function approveAdmission(admissionID) {
            $.ajax({
                type: 'POST',
                url: 'approval_mail.php',
                data: {
                    id: admissionID
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    <!-- Teacher credentials -->
    <script>
        function sendCredentials(teacherID) {
            $.ajax({
                type: 'POST',
                url: 'teacherCredentials.php',
                data: {
                    id: teacherID
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>

    <!-- Student Credentials -->
    <script>
        function sendCredentialsToStudent(studentID) {
            $.ajax({
                type: 'POST',
                url: 'studentCredentials.php',
                data: {
                    id: studentID
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    <!-- Viewing Admitted Students -->
    <script>
        function newStudent(studentID) {
            $.ajax({
                type: 'POST',
                url: 'admittedStudent.php',
                data: {
                    id: studentID
                },
                success: function(response) {
                    console.log(response);
                    // location.reload();
                    $('body').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    <!-- To send request to activate feedback button -->
    <script>
        function updateFeedback() {
            $.ajax({
                type: 'POST',
                url: 'update_feedback_status.php',
                success: function(data) {
                    console.log('Server Response:', data); // Log the server response for debugging
                    if (typeof data !== 'object') {
                        try {
                            data = JSON.parse(data);
                        } catch (e) {
                            alert('Failed to update feedback status: Invalid response from server.');
                            return;
                        }
                    }

                    if (data.success) {
                        alert('Feedback status updated!');
                    } else {
                        alert('Failed to update feedback status: ' + data.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Failed to update feedback status.');
                }
            });
        }
    </script>
</body>

</html>