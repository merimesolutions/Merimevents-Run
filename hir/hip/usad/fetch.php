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
    include("../connection.php");
        $date = date('Y-m-d');
         $dt2=date('Y-m-d', strtotime('+3 days'));
         $query = mysqli_query($con, "select count(user) as uu from tblreminder where user = '".$_SESSION['userid']."' AND scheduled_date BETWEEN  '".$date."' AND '".$dt2."' ");
         while($row = mysqli_fetch_array($query)){
           /* $time2 = strtotime($row['scheduled_date']);
                $time1 = strtotime(date("Y-m-d"));
                echo $d   = floor( ($time2-$time1) /(60*60*24));  
         if($d>=1){*/
                echo $row['uu'];
                
                
               
    }
    ?>
</table>