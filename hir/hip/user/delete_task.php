<?php
session_start();
$compp=$_SESSION['company'];
include "../connection.php";
$task_id=$_GET['id'];
$squery=mysqli_query($con,"SELECT * FROM tbltasks WHERE id='$task_id'");
while($row = mysqli_fetch_array($squery)){
    $event_id =$row['event_id'];
}
$sql=mysqli_query($con,"DELETE FROM tbltasks WHERE id='$task_id'");
if($sql){
    echo'<script>alert("Task successfully Deleted");window.location="view_event.php?id='."$event_id".'"</script>';
}else{
    $error=mysqli_error($con);
        echo'<script>alert("An error occured during deleting : '."$error".'");window.location="view_event.php?id='."$event_id".'"</script>';
}
?>
