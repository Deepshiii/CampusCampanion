

<?php

session_start();

if (!isset($_SESSION['paymentReportData'])) {
    echo "No report data available.";
    exit;
}

$reportData = $_SESSION['paymentReportData'];
unset($_SESSION['paymentReportData']); 

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=admission_payment_report.xls");
header("Pragma: no-cache");
header("Expires: 0");

$flag = false;
foreach ($reportData as $row) {
    if (!$flag) {
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
}
exit;
?>
