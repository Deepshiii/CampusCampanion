<?php
    session_start();
    include("Includes\dbConnection.php");

    if(isset($_POST['id']) && is_numeric($_POST['id'])) {
        $adm_id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM admission WHERE ad_id = ?");
        $stmt->bind_param("i", $adm_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: $current_url");
            exit();
        } else {
            echo "Error: Unable to Admission record.";
        }
        $stmt->close();
    } else {
        echo "Error: Admission ID is missing or invalid.";
    }
    $conn->close();
?>
