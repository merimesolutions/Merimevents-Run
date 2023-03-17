<?php
		include('../connection.php');
	    $txt_id = $_POST['id'];
	    $q = 0;
	    $query = mysqli_query($con,"UPDATE tblprojects SET del = '".$q."' where id = '".$txt_id."' ");
?>