<?php
include "../connection.php";
 $delete_query = mysqli_query($con,"DELETE from tblleased where item_id = '".$_POST['rmvfile']."' ") or die('Error: ' . mysqli_error($con));
	                   
?>