<?php
		include('../connection.php');
	    $txt_id = $_POST['id'];
	    $q = 1;
	    $query = mysqli_query($con,"UPDATE tblevents SET del = '".$q."' where id = '".$txt_id."' ");
?>