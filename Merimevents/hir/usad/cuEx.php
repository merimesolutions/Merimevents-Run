<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
// Defines the name of the export file 
header("Content-Disposition: attachment; filename=customer-report.xls");
// Add data table
include 'customersheet.php';
?>