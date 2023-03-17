<?php
// $url="add-quotation-lease.php";

include "../connection.php";
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


if(isset($_POST['delete_this'])){
$quoteid = $_GET['quoteid'];
    
    $qu= mysqli_query($con, "DELETE FROM tblquotation WHERE identitty='".$quoteid."'");
    if($qu==true){
        // echo "fggg successs"; 
        // echo;
        echo'<script>alert("Deleted Successfully");window.location="add-quotation-lease.php?"</script>';
                
// header('Location: add-quotation-lease.php');
    }else{
        // $error=mysqli_error($con);
            echo 'Failed to delete';
}

}

?>