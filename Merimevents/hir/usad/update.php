<?php
$con = mysqli_connect('localhost','merimeve_event','user@event','merimeve_event') or die(mysqli_error());
	if(isset($_POST['update']))
	{
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['register'];
	    $lease      = $_POST['lease'];
	    $return     = $_POST['return'];
	    $inventory  = $_POST['inventory'];
	    $penalty    = $_POST['penalty'];
	    $invoice    = $_POST['invoice'];
	    $report     = $_POST['report'];
	    $project    = $_POST['project'];
	    $user       = $_POST['user'];

	       $query = mysqli_query($con,"UPDATE tblroles SET register = '".$register."',lease = '".$lease."',return= '".$return."',inventory = '".$inventory."',penalty = '".$penalty."',invoice = '".$invoice."',report = '".$report."',project = '".$project."',user = '".$user."' where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successfully.");';
            echo 'window.location = "setting.php";';
            echo '</script>';
            exit;
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>