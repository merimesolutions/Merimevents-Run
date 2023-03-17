<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
// Defines the name of the export file 
header("Content-Disposition: attachment; filename=leased-items.xls");
// Add data table
include 'leasedworksheet.php';
?>