<!--Delete active account -->
<?php
include "../connection.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

	if(isset($_POST['delete'])){
		// $idzz=(!empty($_POST["demos"])) ? $_POST["demos"] : false; 
		if(isset($_POST['demos']) && !empty($_POST['demos'])){
			echo "<script>alert('About to be deleted')</script>";
			 foreach($_POST['demos'] as $demo){
					// $squery=mysqli_query($con,"SELECT * FROM tbldemo WHERE id='$demo'");
					// while($row = mysqli_fetch_array($squery)){
					// 	$demo =$row['id'];
					// }
				   echo $demo.'<br>';
					$sql=mysqli_query($con,"DELETE FROM tbldemo WHERE id ='$demo'");
					if($sql){
						// echo "fggg successs"; 
						echo'<script>alert("Demo successfully deleted");window.location="demo.php"</script>';
					}else{
						$error=mysqli_error($con);
							echo'<script>alert("An error occured during deleting : '."$error".'");window.location="demo.php?id='."$demo".'"</script>';
			}
		  }
		}else{
		   echo "<script>alert('No demo selected')</script>"; 
		}
	}
	
	?>

<!-- Archiving demos -->
<?php
include "../connection.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['archive_demo'])){
   
    if(!empty($_POST['demos'])){
        echo "<script>alert('You are about to archive selected events')</script>";
         foreach($_POST['demos'] as $event){
                $squery=mysqli_query($con,"SELECT * FROM tbldemo WHERE id='$event'");
                while($row = mysqli_fetch_array($squery)){
                    $event =$row['id'];
                }
               
                $sql=mysqli_query($con,"UPDATE tbldemo SET del = 1 where id = '".$event."' ");
                if($sql){
                    echo'<script>alert("Event successfully archived");window.location="demo"</script>';
                }
				else{
                    $error=mysqli_error($con);
                        echo'<script>alert("An error occured during archiving : '."$error".'");window.location="demo?id='."$event".'"</script>';
        		}
      	}
    }
}
?>

<!-- Restoring Demos -->
<?php
if(isset($_POST['restore_demo'])){
	if(!empty($_POST['demos'])){
		echo '<script>alert("You are about to restore selected demos")</script>';
		foreach($_POST['demos'] as $edemo){
			$squery=mysqli_query($con, "SELECT * FROM tbldemo WHERE id='$edemo'");
				while($row=mysqli_fetch_array($squery)){
					$edemo=$row['id'];
				}
			$sql=mysqli_query($con, "UPDATE tbldemo SET del=0 WHERE id='".$edemo."'");
			if($sql){
				echo '<script>alert("Demo successfully restored")</script>';
				$sqll=mysqli_query($con, "SELECT * FROM tbldemo WHERE del=1");
				
					$num=mysqli_num_rows($sqll);
					if($num == 0){
						// echo 'window.location="archived-demo.php"';
						header("Location: demo.php");
					}
					else{
						header("Location: archived-demo.php");;
					}
				
			}
			else{
				$error=mysqli_error($con);
            	echo'<script>alert("An error occured during archiving : '."$error".'");window.location="archived-pl?id='."$project".'"</script>';
        
			}
		}

	}
	else{
		echo "<script>alert('No demo selected')</script>"; 
	 }
}
?>