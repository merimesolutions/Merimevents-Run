<?php
		$con = mysqli_connect("localhost","merimeve_event","user@event","merimeve_event");
	    $txt_id = $_POST['id'];
	    $query = mysqli_query($con,"DELETE FROM tblps where id ='$txt_id' ");
?>