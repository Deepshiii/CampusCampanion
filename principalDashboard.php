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
    <title>Principle</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="./css/adminstyle.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .teacher-details {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        .teacher-details h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .teacher-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .teacher-table th,
        .teacher-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .teacher-table th {
            background-color: #f2f2f2;
        }

        .back-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>

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

                <a href="#" class="sidebar-link" data-section="notice-section">
                    <span class="material-icons-sharp">note</span>
                    <h3>Notice</h3>
                </a>

                <a href="#" class="sidebar-link" data-section="notice-section-view">
                    <span class="material-icons-sharp">visibility</span>
                    <h3>View Notice</h3>
                </a>

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
                                        <td><button class='view-btn' onclick=viewDetailsOfTeacher(<?php echo $result['teacher_id']; ?>)>View Details</button></td>
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
                <h1>Class section</h1>
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

            <div class="section" id="notice-section">
                <h2>Add Notice</h2>
                <form action="teacherDashboard.php" method="POST">
                    <div>
                        <label for="notice_title">Notice Title:</label><br>
                        <input type="text" id="notice_title" name="notice_title" required>
                    </div>
                    <br>
                    <div>
                        <label for="notice_message">Notice Message:</label><br>
                        <textarea id="notice_message" name="notice_message" rows="4" required></textarea>
                    </div>
                    <br>
                    <button type="submit" name="submit">Submit</button>
                </form>
            </div>

            <div class="section" id="notice-section-view">
                <?php
                $nt = $conn->query("SELECT * FROM notice");
                if ($nt->num_rows > 0) {
                    echo "<table border='1' id='view-notice-table'>";
                    echo "<tr>
                            <th>Notice Title</th>
                            <th>Message</th>
                            <th>Notice Date</th>
                            <th>Action</th>";
                    while ($row = $nt->fetch_assoc()) {
                        echo "<tr>
                                    <td>" . $row["title"] . "</td>
                                    <td>" . $row["message"] . "</td>
                                    <td>" . $row["creationdate"] . "</td>
                                    <td><button class='delete-btn' onclick='deleteNotice(" . $row['id'] . ")'>Delete</button></td>
                                </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
                ?>
            </div>

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
    <!-- Viewing Admitted Teacher -->
    <script>
        $(document).ready(function() {
            $(".sidebar-link").click(function() {
                var sectionId = $(this).data("section");
                $(".section").hide();
                $("#" + sectionId).show();
            });
        });

        function viewDetailsOfTeacher(TeacherID) {
            $.ajax({
                type: 'POST',
                url: 'teacherDetail.php',
                data: {
                    id: TeacherID
                },
                success: function(response) {
                    console.log(response);
                    $('.container').hide(); // Hide the main container
                    $('body').append(response); // Append the teacher details
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function goBack() {
            $('.teacher-details').remove(); // Remove the teacher details
            $('.container').show(); // Show the main container again
        }
    </script>

    <script>
        function deleteNotice(noticeId) {
            $.ajax({
                type: 'POST',
                url: 'notice_delete.php',
                data: {
                    id: noticeId
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