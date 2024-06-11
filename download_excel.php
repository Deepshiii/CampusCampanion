

<?php
// download_excel.php
session_start();

if (!isset($_SESSION['reportData'])) {
    echo "No report data available.";
    exit;
}

$reportData = $_SESSION['reportData'];
unset($_SESSION['reportData']); 

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=admission_report.xls");
header("Pragma: no-cache");
header("Expires: 0");

$flag = false;
foreach ($reportData as $row) {
    if (!$flag) {
        // Display column headers
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
}
exit;
?>
