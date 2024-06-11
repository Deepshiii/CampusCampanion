<?php
    session_start();
    include("Includes\dbConnection.php");
    if (isset($_POST['submit'])) {

        $name = $_POST['filename'];
        $c_id = $_POST['course_id'];
        $t_id = $_POST['teacher_id'];
        $s_id = $_POST['subject'];


        if (isset($_FILES['pdf_file']['name'])) {
            $file_name = $_FILES['pdf_file']['name'];
            $file_tmp = $_FILES['pdf_file']['tmp_name'];

            move_uploaded_file($file_tmp, "./Server_pdfs/" . $file_name);

            $sql = "INSERT INTO notes (notes_id,course_id,teacher_id,subject,filename) VALUES(NULL,'$c_id','$t_id','$s_id','$file_name')";
            $iquery = mysqli_query($conn, $sql);
            header("Location: teacherDashboard.php");
            exit();
        } 
    }
?>
       