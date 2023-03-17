<?php 
if(isset($_GET['id']) && !empty($_GET['id']))
{
    $id = $_GET['id'];
    include "../connection.php";

    $reply = "1";

    // $update = "UPDATE singlefaq SET reply = '".$reply."' WHERE rec_id = '".$id."'";

    $query = mysqli_query($con,"UPDATE singlefaq SET reply = '".$reply ."' where rec_id = '".$id."' ");
      
}
?>