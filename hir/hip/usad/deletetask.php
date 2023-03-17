<?php
session_start();
$compp=$_SESSION['company'];
include "../connection.php";
echo $task_id=$_GET['id'];
$squery=mysqli_query($con,"SELECT * FROM tbltasks WHERE id='$task_id'");
while($row = mysqli_fetch_array($squery)){
    $event_id =$row['event_id'];
}
$sl = mysli_query($con,"SELECT * FROM tblprojects WHERE id ='$task_id'");
  if(mysqli_num_rows($sl>0)){
      $row = mysqli_fetch_assoc($sl);
         $projectname = $row['project'];    
  
            $sql=mysqli_query($con,"DELETE FROM tbltasks WHERE project='$projectname'");
             
            $sql2 = mysqli_query($con,"DELETE FROM `tblongoing_tasks` WHERE proj='$task_id'");
            $sql3 = mysqli_query($con,"DELETE FROM `tblprojects` WHERE id='$task_id'");
            if($sql && $sql2 && $sql3 ){
                echo'<script>alert("Task successfully Deleted");window.location="view_event.php?id='."$event_id".'"</script>';
            }else{
                $error=mysqli_error($con);
         echo'<script>alert("An error occured during deleting : '."$error".'");window.location="view_event.php?id='."$event_id".'"</script>';
            }
      
  }
?>
