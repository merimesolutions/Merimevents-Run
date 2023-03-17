<?php
session_start();
$id = $_GET['id'];
include "../connection.php";
if(isset($_GET['id'])){
        $sql=mysqli_query($con,"DELETE FROM tblquotation WHERE id='$id'");
        // $sql2=mysqli_query($con,"DELETE FROM tblongoing_tasks WHERE proj='$project'");
        if($sql){
            echo'<script>
            alert("Task successfully Deleted");
            window.location="quotation-list.php"
            </script>';
        }else{
            $error=mysqli_error($con);
                echo'<script>
                alert("An error occured during deleting : '."$error".'");
                window.location="quotation-list.php"</script>';
        }
    
}
?>
