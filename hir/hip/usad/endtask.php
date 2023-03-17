<?php
		include('../connection.php');
	    $txt_id = $_POST['id'];
	    $q = 1;
	    $query = mysqli_query($con,"UPDATE todo SET status = '".$q."' where id = '".$txt_id."' ");
?>