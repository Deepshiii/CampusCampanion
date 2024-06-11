<?php
session_start();
include("Includes\dbConnection.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_table_last_insert_id = $_GET['id'];
        echo "$first_table_last_insert_id";

        // Check if all files are uploaded
        if (
            isset($_FILES['10th_marksheet']['name']) &&
            isset($_FILES['12th_marksheet']['name']) &&
            isset($_FILES['grad_marksheet']['name']) &&
            isset($_FILES['cet_score']['name']) &&
            isset($_FILES['domicile']['name']) &&
            isset($_FILES['aadhaar_card']['name']) &&
            isset($_FILES['nationality']['name']) &&
            isset($_FILES['photograph']['name']) &&
            isset($_FILES['signature']['name']) &&
            isset($_FILES['income']['name'])
        ) {

            $tenth_marksheet = $_FILES['10th_marksheet']['name'];
            $twelfth_marksheet = $_FILES['12th_marksheet']['name'];
            $grad_marksheet = $_FILES['grad_marksheet']['name'];
            $cet_scorecard = $_FILES['cet_score']['name'];
            $domicile = $_FILES['domicile']['name'];
            $aadhar_card = $_FILES['aadhaar_card']['name'];
            $nationality = $_FILES['nationality']['name'];
            $income = $_FILES['income']['name'];
            $photograph = $_FILES['photograph']['name'];
            $signature = $_FILES['signature']['name'];

            // Move files to upload directory

            move_uploaded_file($_FILES['10th_marksheet']['tmp_name'], "./Student_admission_Documents/" . $tenth_marksheet);
            move_uploaded_file($_FILES['12th_marksheet']['tmp_name'], "./Student_admission_Documents/" . $twelfth_marksheet);
            move_uploaded_file($_FILES['grad_marksheet']['tmp_name'], "./Student_admission_Documents/" . $grad_marksheet);
            move_uploaded_file($_FILES['cet_score']['tmp_name'], "./Student_admission_Documents/" . $cet_scorecard);
            move_uploaded_file($_FILES['domicile']['tmp_name'], "./Student_admission_Documents/" . $domicile);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], "./Student_admission_Documents/" . $aadhar_card);
            move_uploaded_file($_FILES['nationality']['tmp_name'], "./Student_admission_Documents/" . $nationality);
            move_uploaded_file($_FILES['income']['tmp_name'], "./Student_admission_Documents/" . $income);
            move_uploaded_file($_FILES['photograph']['tmp_name'], "./Student_admission_Documents/" . $photograph);
            move_uploaded_file($_FILES['signature']['tmp_name'], "./Student_admission_Documents/" . $signature);

            $sql = "INSERT INTO documents (ad_id, doc_id, tenth_marksheet, tewelfth_marksheet, grad_marksheet, cet_scorecard, domicile, aadhar_card, nationality, income, photograph, signature) 
            VALUES ('$first_table_last_insert_id', NULL, '$tenth_marksheet', '$twelfth_marksheet', '$grad_marksheet', '$cet_scorecard', '$domicile', '$aadhar_card', '$nationality', '$income', '$photograph', '$signature')";

            $iquery = mysqli_query($conn, $sql);
            if ($iquery) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Please upload all');</script>";
        }
    }
} else {
    echo "<script>alert('Admission ID not found');</script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button.view-btn {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button.view-btn:hover {
            background-color: #0056b3;
        }

        .grievance-btn {
            padding: 5px 10px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .grievance-btn:hover {
            background-color: red;
        }

        input[type="submit"] {
            padding: 12px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
            margin-left: 400px;
            display: block;
            width: 20%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <form action="document_upload.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
        <h1>Upload Your Document</h1>
        <h3>Note: Upload in PDF format , Photo and Sign in jpg</h3>
        <table>
            <tr>
                <th>File Upload</th>
                <th>Select File</th>
                <th>Grievance</th>
                <th>View Document</th>
            </tr>
            <tr>
                <th>Upload 10th Marksheet</th>
                <td><input type="file" id="10th_marksheet" name="10th_marksheet" accept=".pdf"></td>
                <td><button class='grievance-btn'>Raise Grievance</button></td>
                <td><button class='view-btn' data-fileInputId="10th_marksheet">Preview</button></td>
            </tr>
            <tr>
                <th>Upload 12th Marksheet</th>
                <td><input type="file" id="12th_marksheet" name="12th_marksheet" accept=".pdf"></td>
                <td><button class='grievance-btn'>Raise Grievance</button></td>
                <td><button class='view-btn' data-fileInputId="12th_marksheet">Preview</button></td>
            </tr>
            <tr>
                <th>Upload Graduation Marksheet</th>
                <th><input type="file" id="grad_marksheet" name="grad_marksheet" accept=".pdf"></th>
                <td><button class='grievance-btn'>Raise Grievance</button></td>
                <td><button class='view-btn' data-fileInputId="grad_marksheet">Preview</button></td>

            </tr>
            <tr>
                <th>Upload CET Score Card</th>
                <td><input type="file" id="cet_score" name="cet_score" accept=".pdf"></td>
                <td><button class='grievance-btn'>Raise Grievance</button></td>
                <td><button class='view-btn' data-fileInputId="cet_scorecard">Preview</button></td>
            </tr>
            <tr>
                <th>Domicile</th>
                <td><input type="file" id="domicile" name="domicile" accept=".pdf"></td>
                <td><button class='grievance-btn'>Raise Grievance</button></td>
                <td><button class='view-btn' data-fileInputId="domicile">Preview</button></td>

            </tr>
            <tr>
                <th>Aadhaar Card</th>
                <td> <input type="file" id="aadhaar_card" name="aadhaar_card" accept=".pdf"></td>
                <td><button class='grievance-btn'>Raise Grievance</button></td>
                <td><button class='view-btn' data-fileInputId="aadhaar_card">Preview</button></td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td> <input type="file" id="nationality" name="nationality" accept=".pdf"></td>
                <td><button class='grievance-btn'>Raise Grievance</button></td>
                <td><button class='view-btn' data-fileInputId="nationality">Preview</button></td>
            </tr>
            <tr>
                <th>Income</th>
                <td><input type="file" id="income" name="income" accept=".pdf"></td>
                <td><button class='grievance-btn'>Raise Grievance</button></td>
                <td><button class='view-btn' data-fileInputId="income">Preview</button></td>
            </tr>
            <tr>
                <th>Photograph</th>
                <td><input type="file" id="photograph" name="photograph" accept="image/*"></td>
                <td><button class='grievance-btn'>Raise Grievance</button></td>
                <td><button class='view-btn' data-fileInputId="photograph">Preview</button></td>
            </tr>
            <tr>
                <th>Signature</th>
                <td><input type="file" id="signature" name="signature" accept="image/*"></td>
                <td><button class='grievance-btn'>Raise Grievance</button></td>
                <td><button class='view-btn' data-fileInputId="signature">Preview</button></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Upload and Finish">

        <script>
            // Get all view buttons by class name
            var viewButtons = document.querySelectorAll('.view-btn');

            // Add click event listener to each view button
            viewButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default form submission behavior

                    // Get the ID of the associated file input
                    var fileInputId = this.dataset.fileinputid;

                    // Get the file input element
                    var fileInput = document.getElementById(fileInputId);
                    if (fileInput && fileInput.files.length > 0) {
                        var file = fileInput.files[0];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            // Open a new tab and display the file
                            var previewWindow = window.open("", "_blank");
                            if (file.type === 'application/pdf') {
                                previewWindow.document.write("<embed src='" + e.target.result + "' width='100%' height='100%' type='application/pdf'>");
                            } else {
                                previewWindow.document.write("<img src='" + e.target.result + "' width='100%' height='100%'>");
                            }
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert("Please select a file.");
                    }
                });
            });
        </script>
    </form>

</body>

</html>