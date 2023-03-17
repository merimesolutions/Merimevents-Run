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
    // if($con){
    //     echo "connected";
    // }else{
    //     echo "maembe";
    // }
if (isset($_POST['submit'])){
    
    $Event=($_POST['Event']);
    $ScheduledDate=($_POST['ScheduledDate']);
     $ScheduledTime =($_POST['ScheduledTime']);
    $user =$_SESSION['userid'];
    $query=mysqli_query($con, "INSERT INTO tblreminder(event,scheduled_date,scheduled_time,user) VALUES('$Event','$ScheduledDate','$ScheduledTime','$user')");
    
    
   /*header('location:db.php');*/

    
    
}

?>
<html>
    <?php include('../head_css.php'); ?>
    <style type="text/css">
        .icon{
            width: 30px;
            padding-right: 10px;
        }
        .iconb{
            width: 30px;
            padding-right: 10px;
        }
        .icon:hover{
            transition: 0.3s;
            /*box-shadow: 2px 0px 20px rgba(0, 0, 0, 0.8);*/
        }
    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>
         
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a href="db.php" title="Go home"><i class="fa fa-home" aria-hidden="true" title="Go home"></i> Home</a> &nbsp;&nbsp;&nbsp;

                    <!--a href="plr.php" target="_blank"><img src="../../images/icons/print.png" title="Print projects report" class="icon"></a-->
                    </section>
                    <section class="content">
   
                      <div class="box">
                              
                        <div class="box-body table-responsive"> 
<form action="" id="event_form" method="POST">
    <label>Event:</label> <textarea class="form-control" name ="Event" type="text"  placeholder="What you need to be reminded."></textarea><br>
	<label>ScheduledDate:</label> <input class="form-control" name="ScheduledDate" 
	type="date"  /><br>
	<label>ScheduledTime:</label> <input class="form-control" name="ScheduledTime" 
	type="time"  /><br>
	<input name="submit"  class="form-control btn-success"  id="post" type="submit" />	
</form> 
</div>
</div> 

</section>
</aside>
</div>


 <?php include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>

</body>
</html>