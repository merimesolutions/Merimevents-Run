<?php


include "../connection.php";
$quoteid = $_GET['quoteid'];
if(isset($_POST['delete_this'])){
    $qu= mysqli_query($con, "DELETE FROM tblquotation WHERE id='".$quoteid."'");
    if($qu == true){
        // echo "fggg successs"; 
        echo'<script>alert("Details successfully deleted");window.location="add-quotation-list.php"</script>';
    }
    else{
        $error=mysqli_error($con);
            echo'<script>alert("An error occured during deleting : '."$error".'");window.location="add-quotation-list.php"</script>';
    }

}
else{
    echo'<script>alert("An error occured during deleting : '."$error".'");window.location="edit-quotation-list.php?id='."$dequote".'"</script>';   
}

?>