<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>
  <form id="userForm" method="post">
<table class="table table-striped">
<?php
$q = intval($_GET['q']); 
 
 $client = $_GET['c'];
// if(empty($client)){
//   $client = intval($_GET['cl']); 
// }



$con =  mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die("connection failed" . mysqli_error()); 

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM tblitems WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<th>Item name</th>";
  echo "<td colspan='3'>" . ucwords($row['item_name']) . "</td>";
  echo "<th>Available stock</th>";
  echo "<td colspan='5'>" .$row['qnty'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<th>Quantity</th>";
  echo "<td><input type='number' min='1' name='txtQnty' class='form-control' required style='background-color:#b3ffcc;' placeholder='0'></td>";
  echo "<th>Unit price per day</th>";
  echo "<td><input type='text' name='txtPrice' value='" .$row['lease_charges'] . "' class='form-control' required></td>";
  echo "<th>Description</th>";
  echo "<td><input type='text' name='txtDescription' class='form-control'></td>";
  echo "<th>Return date</th>";
  echo "<td><input type='date' name='txtRdate' class='form-control' required>
  <input type='hidden' name='txtItem_name' class='form-control' value='" . $row['id'] . "'>
  <input type='hidden' name='client' class='form-control' value='".$client."'></td>";
  echo "<td><button type='submit' class='btn btn-primary' name='save' id='showData'>Save</button></td>";
  echo "</tr>";
}
mysqli_close($con);
?>
</table>
</form>
</body>
</html>