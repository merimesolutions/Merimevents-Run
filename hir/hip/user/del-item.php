<?php
  session_start();
if (!isset($_SESSION['userid'])){
    require "../redirect.php";
    
}?>
<?php
require "../connection.php"; 
 if(isset($_POST['del_button'])){
 $compp=$_SESSION['company'];
 $id=$_GET['del'];

   echo $sql=mysqli_query($con,"DELETE FROM additional_costs where id ='$id' ");
     if($sql){
         echo'<script>alert("Item succesfully Deleted");window.location="edit_quotation.php?id='.$_GET['id'].'"; </script>';
     }else{
         echo $errom =mysqli_error($con);
         echo '<script>alert("'."$errom".' ");window.location="edit_quotation.php?id='.$event_id.'";</script>';
     }
 }
}
 ?>