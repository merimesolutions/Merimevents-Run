<?php
		include('../connection.php');
	    $txt_id = $_POST['id'];
	    $query = mysqli_query($con,"DELETE FROM todo where id ='$txt_id' ");
	    
?>