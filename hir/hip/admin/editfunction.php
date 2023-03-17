<!--====edit customers records===-->
<?php
	if(isset($_POST['editButton']))
	{
		$txt_id         = $_POST['hidden_id'];
	    $full_name      = $_POST['full_name'];
	    $companyname    = $_POST['companyname'];
	    $location       = $_POST['location'];
	    $email          = $_POST['email'];
	    $contact        = $_POST['contact'];
	    $package        = $_POST['package'];
	    $status         = "active";

	    $query = mysqli_query($con,"UPDATE tblstaff SET full_name = '".$full_name."', companyname = '".$companyname."', location = '".$location."', email = '".$email."', contact = '".$contact."', status = '".$status."' where id = '".$txt_id."' ");
	    
	    if($query == true){
	        echo '<script type="text/javascript">'; 
            echo 'alert("Changes saved successfully.");'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }
		if(!$query){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");';
            echo 'window.location.href = window.location.href;';
            echo '</script>';
		}
	}
?>

