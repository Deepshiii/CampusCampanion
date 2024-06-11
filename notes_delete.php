<?php
    session_start();
    include("Includes\dbConnection.php");

    if(isset($_POST['id']) && is_numeric($_POST['id'])) {
        $n_id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM notes WHERE notes_id = ?");
        $stmt->bind_param("i", $n_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: $current_url");
            exit();
        } else {
            echo "Error: Unable to delete notice.";
        }
        $stmt->close();
    } else {
        echo "Error: Notes ID is missing or invalid.";
    }
    $conn->close();
?>
