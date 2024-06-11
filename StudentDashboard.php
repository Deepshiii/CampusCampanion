<?php
session_start();
// Check if the session variable 'name' is set
if(isset($_SESSION['name'])) {
    $studentName = $_SESSION['name'];
} else {
    // Redirect to login page if the session variable is not set
    header('Location: login.php');
    exit();
}
include("Includes\dbConnection.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Student</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="./css/adminstyle.css">
    <!-- <link rel="stylesheet" href="./css/studentstyle.css"> -->
</head>

<body>
    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <h2>Welcome <span class="danger"><?php echo $studentName;?></span></h2>
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
                <a href="#" class="sidebar-link" data-section="class-section">
                    <span class="material-icons-sharp">insights</span>
                    <h3>Class</h3>
                </a>
                <a href="#" class="sidebar-link" data-section="notice-section-view">
                    <span class="material-icons-sharp">visibility</span>
                    <h3>View Notice</h3>
                </a>
                <a href="#" class="sidebar-link" data-section="notes-section">
                    <span class="material-icons-sharp">label</span>
                    <h3>Notes</h3>
                </a>
                <a href="#" class="sidebar-link" data-section="feedback-section">
                    <span class="material-icons-sharp">subject</span>
                    <h3>Feedback</h3>
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
                <h1>Profile</h1>
                <!-- Content for dashboard section -->
                <?php include("studentProfileView.php"); ?>

            </div>
            <div class="section" id="class-section">
            <center><h2>MCA Timetable</h2></center>
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
            <div class="section" id="feedback-section">
                <?php include("feedback.php"); ?>
            </div>
            <div class="section" id="notes-section">
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <th>Course ID</th>
                                <th>Teacher ID</th>
                                <th>Subject</th>
                                <th>Filename</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $selectQuery = "select * from notes";
                                $squery = mysqli_query($conn, $selectQuery);

                                while (($result = mysqli_fetch_assoc($squery))) {
                                ?>
                                    <tr>
                                        <td><?php echo $result['course_id']; ?></td>
                                        <td><?php echo $result['teacher_id']; ?></td>
                                        <td><?php echo $result['subject']; ?></td>
                                        <td><?php echo $result['filename']; ?></td>
                                        <td><button class='download-btn' onclick=downloadNotes(<?php echo $result['notes_id']; ?>)>Download</button></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="notice-section-view">
                <?php
                $nt = $conn->query("SELECT * FROM notice");
                if ($nt->num_rows > 0) {
                    echo "<table border='1' id='view-notice-table'>";
                    echo "<tr><th>Notice Title</th> <th>Message</th> <th>Notice Date</th> ";
                    while ($row = $nt->fetch_assoc()) {
                        echo "<tr>
                                    <td>" . $row["title"] . "</td>
                                    <td>" . $row["message"] . "</td>
                                    <td>" . $row["creationdate"] . "</td>
                                </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
                ?>
            </div>
        </main>
        <!-- End of Main Content -->
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
            function downloadNotes(notesId) {
                $.ajax({
                    type: 'GET',
                    url: 'notes_download.php',
                    data: {
                        id: notesId
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response) {
                        var url = window.URL.createObjectURL(new Blob([response]));
                        var a = document.createElement('a');
                        a.href = url;
                        a.download = 'downloaded.pdf'; // Set the filename
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                        $(a).remove();

                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>
</body>

</html>