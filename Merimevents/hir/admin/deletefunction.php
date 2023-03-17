<!--Delete active account -->
<?php
	if(isset($_POST['btn_active']))
	{
	    if(isset($_POST['chk_delactive']))
	    {
	        foreach($_POST['chk_delactive'] as $value)
	        {
	            $delete_query = mysqli_query($con,"DELETE from tblstaff where id = '$value' ") or die('Error: ' . mysqli_error($con));
	                    
	            if($delete_query == true)
	            {
	                $_SESSION['delete'] = 1;
	                header("location: ".$_SERVER['REQUEST_URI']);
	            }
	        }
	    }
	}
?>
