<?php
    session_start();
    include("Includes\dbConnection.php");

    $fileId = $_GET['id'];
    $sql = $conn->prepare ("SELECT * FROM notes WHERE notes_id = ?");
    $sql-> bind_param("i",$fileId);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pdfContent = $row['filename']; 

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . rawurlencode('downloaded.pdf') . '"');

        readfile($filePath);
    } else {
        echo "PDF file not found";
    }

    $conn->close();

?>