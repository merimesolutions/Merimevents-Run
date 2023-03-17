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

<!-- delete to do list -->
<?php
    if(isset($_POST['btn_deltodo']))
    {
        if(isset($_POST['chk_delete']))
        {
            foreach($_POST['chk_delete'] as $value)
            {
                $delete_query = mysqli_query($con,"DELETE from todo where id = '$value' ") or die('Error: ' . mysqli_error($con));
                        
                if($delete_query == true)
                {
                    $_SESSION['delete'] = 1;
                    echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
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

<!--Delete account profile -->
<?php
	if(isset($_POST['btn_acccc']))
	{
	    if(isset($_POST['chk_delacccc']))
	    {
	        foreach($_POST['chk_delacccc'] as $value)
	        {
	            $delete_query = mysqli_query($con,"DELETE from tblusers where id = '$value' ") or die('Error: ' . mysqli_error($con));
	                    
	            if($delete_query == true)
	            {
	                $_SESSION['delete'] = 1;
	                echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
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
       echo "<script>alert('No project selected')</script>"; 
    }
}

?>
<!--archive projects-->
<?php
if(isset($_POST['archive_project'])){
   
    if(!empty($_POST['projects'])){
        echo "<script>alert('You are about to archive selected projects')</script>";
         foreach($_POST['projects'] as $project){
                $squery=mysqli_query($con,   "SELECT * FROM tblprojects WHERE id='$project'");
                while($row = mysqli_fetch_array($squery)){
                    $project =$row['id'];
                }
               
                $sql=mysqli_query($con,"UPDATE tblprojects SET del = 1 where id = '".$project."' ");
                if($sql){
                    echo'<script>alert("Project successfully archived");window.location="pl.php"</script>';
                }else{
                    $error=mysqli_error($con);
                        echo'<script>alert("An error occured during archiving : '."$error".'");window.location="pl.php?id='."$project".'"</script>';
        }
      }
    }else{
       echo "<script>alert('No project selected')</script>"; 
    }
}

?>
<!--restore projects-->
<?php
if(isset($_POST['restore_project'])){
   
    if(!empty($_POST['projects'])){
        echo "<script>alert('You are about to restore selected projects')</script>";
         foreach($_POST['projects'] as $project){
                $squery=mysqli_query($con,   "SELECT * FROM tblprojects WHERE id='$project'");
                while($row = mysqli_fetch_array($squery)){
                    $project =$row['id'];
                }
               
                $sql=mysqli_query($con,"UPDATE tblprojects SET del = 0 where id = '".$project."' ");
                if($sql){
                    echo'<script>alert("Project successfully restored");window.location="archived-pl"</script>';
                }else{
                    $error=mysqli_error($con);
                        echo'<script>alert("An error occured during archiving : '."$error".'");window.location="archived-pl?id='."$project".'"</script>';
        }
      }
    }else{
       echo "<script>alert('No project selected')</script>"; 
    }
}

?>

<!--Delete a event-->
<?php
if(isset($_POST['delete_event'])){
   
    if(!empty($_POST['events'])){
        echo "<script>alert('About to be deleted')</script>";
         foreach($_POST['events'] as $event){
                $squery=mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event'");
                while($row = mysqli_fetch_array($squery)){
                    $event =$row['id'];
                }
               
                $sql=mysqli_query($con,"DELETE FROM tblevents WHERE id ='$event'");
                if($sql){
                    echo'<script>alert("Event successfully deleted");window.location="events"</script>';
                }else{
                    $error=mysqli_error($con);
                        echo'<script>alert("An error occured during deleting : '."$error".'");window.location="events?id='."$event".'"</script>';
        }
      }
    }else{
       echo "<script>alert('No event selected')</script>"; 
    }
}

?>
<!--archive projects-->
<?php
if(isset($_POST['archive_event'])){
   
    if(!empty($_POST['events'])){
        echo "<script>alert('You are about to archive selected events')</script>";
         foreach($_POST['events'] as $event){
                $squery=mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event'");
                while($row = mysqli_fetch_array($squery)){
                    $event =$row['id'];
                }
               
                $sql=mysqli_query($con,"UPDATE tblevents SET del = 1 where id = '".$event."' ");
                if($sql){
                    echo'<script>alert("Event successfully archived");window.location="events"</script>';
                }else{
                    $error=mysqli_error($con);
                        echo'<script>alert("An error occured during archiving : '."$error".'");window.location="events?id='."$event".'"</script>';
        }
      }
    }else{
       echo "<script>alert('No event selected')</script>"; 
    }
}

?>
<!--restore projects-->
<?php
if(isset($_POST['restore_event'])){
   
    if(!empty($_POST['events'])){
        echo "<script>alert('You are about to restore selected events')</script>";
         foreach($_POST['events'] as $event){
                $squery=mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event'");
                while($row = mysqli_fetch_array($squery)){
                    $event =$row['id'];
                }
               
                $sql=mysqli_query($con,"UPDATE tblevents SET del = 0 where id = '".$event."' ");
                if($sql){
                    echo'<script>alert("Event successfully restored");window.location="archived"</script>';
                }else{
                    $error=mysqli_error($con);
                        echo'<script>alert("An error occured during archiving : '."$error".'");window.location="archived?id='."$event".'"</script>';
        }
      }
    }else{
       echo "<script>alert('No event selected')</script>"; 
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
                    echo'<script>alert("Task successfully deleted");window.location="pl.php"</script>';
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


<!-- delete items -->
<?php
	if(isset($_POST['btn_delete']))
	{
	    if(isset($_POST['chk_delet']))
	    {
	        foreach($_POST['chk_delet'] as $value)
	        {
	            $delete_query = mysqli_query($con,"DELETE from tblitems where id = '$value' ") or die('Error: ' . mysqli_error($con));
	                    
	            if($delete_query == true)
	            {
	                $_SESSION['delete'] = 1;
	                // header("location: ".$_SERVER['REQUEST_URI']);
	                echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	            }
	        }
	    }
	}
?>