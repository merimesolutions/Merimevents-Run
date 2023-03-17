<?php
		include('../connection.php');
	    $txt_id = $_POST['id'];
	    $query = mysqli_query($con,"DELETE FROM tblevents where id ='$txt_id' ");
	    
?>