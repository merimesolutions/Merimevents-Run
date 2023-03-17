<?php 
if(isset($_GET['id']) && !empty($_GET['id']))
{
    $id = $_GET['id'];
    include "../connection.php";

    $reply = "1";

    // $update = "UPDATE faq SET reply = '".$reply."' WHERE task = '".$id."'";

    $query = mysqli_query($con,"UPDATE faq SET reply = '".$reply ."' where task = '".$id."' ");
      
}
?>