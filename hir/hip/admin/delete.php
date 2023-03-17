<?php
include '../connection.php';
  session_start();
if (!isset($_SESSION['userid'])){
    require "../redirect.php";
}else{
    $now=time();
    if ($now > $_SESSION['expire']){
        session_destroy();
        require "../redirect.php"; 
    }else{        
    }
}

if(isset($_POST['btn_deldemo'])){
    $idd=$_GET['id'];
    $qdel= mysqli_query($con, "DELETE FROM tbldemo WHERE id=$idd");
    if ($qdel){
        echo'<script>alert("Demo succesfully Deleted");window.location="demo.php"</script>';
    }
    else{
        $errom =mysqli_error($con);
        echo '<script>alert("'."$errom".' ");window.location="demo.php";</script>';
    }
}


?>