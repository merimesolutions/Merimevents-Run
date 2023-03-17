<?php
		include('../connection.php');
	    $txt_id = $_POST['id'];
	    $r=1;
	    $query = mysqli_query($con,"UPDATE singlefaq SET reply = '$r' where user = '$txt_id' ");
?>