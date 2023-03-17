<?php
session_start();
$compp=$_SESSION['company'];
include "../connection.php";
if(isset($_POST['delete_project'])){
    if(!empty($_POST['projects'])){
        $squery=mysqli_query($con,"SELECT * FROM tbltasks WHERE id='$task'");
        while($row = mysqli_fetch_array($squery)){
            $event_id =$row['event_id'];
        }
        $sql=mysqli_query($con,"DELETE FROM tbltasks WHERE id='$task'");
        $sql2=mysqli_query($con,"DELETE FROM tblongoing_tasks WHERE proj='$project'");
        if($sql){
            echo'<script>alert("Task successfully Deleted");window.location="pl.php?id='."$event_id".'"</script>';
        }else{
            $error=mysqli_error($con);
                echo'<script>alert("An error occured during deleting : '."$error".'");window.location="tsview.php?id='."$project".'"</script>';
        }
    }
}
?>
