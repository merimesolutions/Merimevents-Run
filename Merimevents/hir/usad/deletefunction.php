<?php
	if(isset($_POST['btn_delete']))
	{
	    if(isset($_POST['chk_delete']))
	    {
	        foreach($_POST['chk_delete'] as $value)
	        {
	            $delete_query = mysqli_query($con,"DELETE from tblcustomers where id = '$value' ") or die('Error: ' . mysqli_error($con));
	                    
	            if($delete_query == true)
	            {
	                $_SESSION['delete'] = 1;
	                header("location: ".$_SERVER['REQUEST_URI']);
	            }
	        }
	    }
	}
?>

<!--Delete account profile -->
<?php
	if(isset($_POST['btn_acc']))
	{
	    if(isset($_POST['chk_delacc']))
	    {
	        foreach($_POST['chk_delacc'] as $value)
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
<!--Delete a project-->
<?php
if(isset($_POST['delete_project'])){
   
    if(!empty($_POST['projects'])){
        echo "<script>alert('About to be deleted')</script>";
         foreach($_POST['projects'] as $project){
                $squery=mysqli_query($con,"SELECT * FROM tblprojects WHERE id='$project'");
                while($row = mysqli_fetch_array($squery)){
                    $project =$row['id'];
                }
               
                $sql=mysqli_query($con,"DELETE FROM tblprojects WHERE id ='$project'");
                 $sql2=mysqli_query($con,"DELETE FROM tblongoing_tasks WHERE proj ='$project'");
                if($sql){
                    echo'<script>alert("Project successfully deleted");window.location="pl.php"</script>';
                }else{
                    $error=mysqli_error($con);
                        echo'<script>alert("An error occured during deleting : '."$error".'");window.location="pl.php?id='."$project".'"</script>';
        }
      }
    }else{
       echo "<script>alert('No projected selected')</script>"; 
    }
}

?>
<!--Delete a Task-->
<?php
if(isset($_POST['delete_task'])){
   
    if(!empty($_POST['tasks'])){
        echo "<script>alert('About to delete a task !')</script>";
         foreach($_POST['tasks'] as $task){
                $squery=mysqli_query($con,"SELECT * FROM tblprojects WHERE id='$project'");
                while($row = mysqli_fetch_array($squery)){
                    $task =$row['id'];
                }
               
                $sql=mysqli_query($con," DELETE FROM tbltasks WHERE  task_name = '$task'");
                 $sql2 =mysqli_query($con," DELETE FROM tblongoing_tasks WHERE  task = '$task'");
                
                if($sql){
                    echo'<script>alert("Project successfully deleted");window.location="pl.php"</script>';
                }else{
                    $error=mysqli_error($con);
                        echo'<script>alert("An error occured during deleting : '."$error".'");window.history.back();</script>';
        }
      }
    }else{
       echo "<script>alert('No task selected')</script>"; 
    }
}

?>