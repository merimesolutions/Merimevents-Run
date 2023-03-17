<?php
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
?>
<?php
//Database connection
include "../connection.php"; 
 
//insert into database
if(!empty($_POST)) {
 $task = $_POST['task'];
 $task_discr = $_POST['task_discr'];
 $company    =$_SESSION['company'];

 mysqli_query($con, "insert into tbltasks (task_name, description,company) values ('$task', '$task_discr','$company')"); 
 
 echo $task_name;
}
?>