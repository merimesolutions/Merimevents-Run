<!--Delete active account -->
<?php
	// if(isset($_POST['btn_active']))
	// {
	//     if(isset($_POST['chk_delactive']))
	//     {
	//         foreach($_POST['chk_delactive'] as $value)
	//         {
	//             $delete_query = mysqli_query($con,"DELETE from tblstaff where id = '$value' ") or die('Error: ' . mysqli_error($con));
	                    
	//             if($delete_query == true)
	//             {
	//                 $_SESSION['delete'] = 1;
	//                 header("location: ".$_SERVER['REQUEST_URI']);
	//             }
	//         }
	//     }
	// }

	
?>
<?php
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
                }else{
                    $error=mysqli_error($con);
                        echo'<script>alert("An error occured during archiving : '."$error".'");window.location="demo?id='."$event".'"</script>';
        }
      }
    }
// 	else{
//        echo "<script>alert('No demo selected')</script>"; 
//     }
}

?>
<?php
include "../connection.php";
if(isset($_POST['delete']) == 'deleteDB'){
   $ids_del = isset($_POST['demos']) ? $_POST['demos'] : '';
	if($ids_del){
		$idss_del=implode(',', $ids_del);
		// echo "<script>alert('About to be deleted')</script>";
		//  foreach($_POST['demo'] as $demo){
		// 		$squery=mysqli_query($con,"SELECT * FROM tbldemo WHERE id='$demo'");
		// 		while($row = mysqli_fetch_array($squery)){
		// 			$demo =$row['id'];
		// 		}
			   
				$sql=mysqli_query($con,"DELETE FROM tbldemo WHERE id IN ($idss_del)");
				if($sql){
					echo'<script>alert("Demo successfully deleted");window.location="demo.php"</script>';
				}else{
					$error=mysqli_error($con);
						echo'<script>alert("An error occured during deleting : '."$error".'");window.location="demo.php?id='."$idss_del".'"</script>';
		// }
	  }
	}
	// else{
	//    echo "<script>alert('No demo selected')</script>"; 
	// }
}

?>

