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
<!DOCTYPE html>
<html>
    <?php include('../head_css.php'); ?>
    <style type="text/css">
.panel:hover {
  background-color: lightblue;}
  .fa-stack img{
font-size: 60px;
padding: 5px;
border:1px solid #fff;
border-radius:50%;
margin-top:-7px;
margin-bottom: 0px;
background-color:#34495E;
}
.sidebar-menu .db{
        background-color:#009999;
    }
.panel{
    background-color:#009999;
    
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
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="db.php" title="Dashboard">Dashboard</a>
                </section>

                <!-- Main content -->
                <section class="content">
                    
                    <div class="row">

                        <div class="main-content">
                    <div class="wrap-content container" id="container" style="width: 100%;height: 100%;">
                        <!-- start: PAGE TITLE -->
                        
                        <!-- end: PAGE TITLE -->
                        <!-- start: BASIC EXAMPLE -->
                            <div class="container-fluid container-fullw" style="/*border-radius: 10px;background: linear-gradient(to top right, #a8e8e4 22%, #b7cad2 49%)*/">

                                <!--background-image: linear-gradient(red, yellow, green);box-shadow: 2px 0px 20px rgba(0, 0, 0, 0.8);-->
                            <div class="row">
                                <br>
                                <div class="col-sm-4" style="">
                                    <a href="ocr" title="Lease items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x">  <img src="../../images/icons/li.png" class="icon" style="width: 60px;"> </span>
                                            
                                            <span style="color:#fff;margin-left: 14px;"> Lease items </span>   
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-sm-4" style="">
                                    <a href="ilp" title="Lease items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x">  <img src="../../images/icons/print.png" class="icon" style="width: 60px;"> </span>
                                            
                                            <span style="color:#fff;margin-left: 14px;"> Lease Invoices</span>   
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="idc" title="Damaged items Invoices">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/br.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Damage Invoices</span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="overdue-penalties" title="Overdue Invoices">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/tm.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Overdue Invoices</span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="li" title="Leased Items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/leased.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Leased Items </span>
                                        <span style="color:#fff;float:right;"> <?php
                                            $query = "SELECT * FROM tblleased where company='".$_SESSION['company']."' ";
                                            $query_run = mysqli_query($con,$query);

                                            $qty= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $qty += $num['bal_qnty'];
                                            }
                                            echo number_format($qty,0);
                                        ?></span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="ai" title="Stock management">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/stock.png" class="icon" style="width: 60px;">  </span>
                                            <span style="color:#fff;margin-left: 14px;">Stock available</span>
                                       <span style="color:#fff;float:right;"> <?php
                            $company=$_SESSION['company'];
                            $query  = "SELECT SUM(qnty) AS stock FROM tblitems where company='".$company."' ";
                            $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_array($result))
                                                  { 
                            $qry  = "SELECT SUM(bal_qnty) AS sum ,SUM(damaged) AS damaged FROM tblleased where company='".$company."' ";
                            
                            $r = mysqli_query($con, $qry);
                                    while ($rows = mysqli_fetch_assoc($r))
                                                  {
                                    $d='0';                  
                                    $bal = $row['stock'] - $rows['sum'];
                                    echo $bal;
                                                  }
                                                  }
                                        ?> </span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="di" title="Damaged Items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/broken.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Damaged Items</span>
                                       <span style="color:#fff;float:right;"> <?php
                                            $query = "SELECT * FROM tblleased where damaged>'0' and comment = 'not cleared' and company='".$_SESSION['company']."' ";
                                            $query_run = mysqli_query($con,$query);

                                            $qty= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $qty += $num['damaged'];
                                            }
                                            echo number_format($qty,0);
                                        ?></span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="oic"  title="Overdue reports">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/overdue.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Overdue Report </span>
                                        <span style="color:#fff;float:right;"> <?php
                                            $date=date("Y-m-d");
                                            $q = mysqli_query($con,"SELECT * from tblleased where rdate<'".$date."' and company='".$_SESSION['company']."' ");
                                            $num_rows = mysqli_num_rows($q);
                                            echo number_format($num_rows,0);
                                        ?></span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="irr" title="Items returned report">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/returned.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Returned Items</span>
                                        <span style="color:#fff;float:right;"> <?php
                                            $query = "SELECT * FROM tblleased where company='".$_SESSION['company']."' ";
                                            $query_run = mysqli_query($con,$query);

                                            $qty= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $qty += $num['rqnty'];
                                            }
                                            echo number_format($qty,0);
                                        ?></span>    
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="ocr" title="Our customers">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/users.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Customers</h5>
                                            <span style="color:#fff;float:right;"> <?php
                                            $date=date("d-m-Y");
                                            $q = mysqli_query($con,"SELECT * from tblcustomers where company='".$_SESSION['company']."' ");
                                            $num_rows = mysqli_num_rows($q);
                                            echo number_format($num_rows,0);
                                        ?></span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="pl" title="">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/project.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">My Tasks </span>
                                            <span style="color:#fff;float:right;"> <?php
                                            $q = mysqli_query($con,"SELECT * from tblprojects where company='".$_SESSION['company']."' ");
                                            $num_rows = mysqli_num_rows($q);
                                            echo number_format($num_rows,0);
                                        ?></span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                 <div class="col-sm-4">
                                    <a href="reminder" title="Our customers">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">                <span class="fa-stack fa-2x"> <img src="../../images/icons/reminder.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Reminders </span>
                                            <span style="color:#fff;float:right;"> <?php
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
                                        ?></span>
                                           
                                        </div>
                                    </div>
                                </a>
                                </div>
                                
                                <div class="col-sm-4">
                                    <a href="events" title="Our customers">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">                <span class="fa-stack fa-2x"> <img src="../../images/icons/reminder.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Events </span>
                                            <span style="color:#fff;float:right;"> 
                                            <?php
                                            $date=date("d-m-Y");
                                            $q = mysqli_query($con,"SELECT * from tblevents where company='".$_SESSION['company']."' ");
                                            $num_rows = mysqli_num_rows($q);
                                            echo number_format($num_rows,0);
                                        ?>
                                            </span>
                                           
                                        </div>
                                    </div>
                                </a>
                                </div>
                                
            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <!--?php include "deletefunction.php"; ?-->


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
<script>
$(document).ready(function(){
// updating the view with reminder using ajax
function load_unseen_reminder(view = '')
{
 $.ajax({
  url:"fetch.php",
  method:"POST",
  data:{view:view},
  dataType:"json",
  success:function(data)
  {
   $('.dropdown-menu').html(data.reminder);
   if(data.unseen_reminder > 0)
   {
    $('.count').html(data.unseen_reminder);
   }
  }
 });
}
load_unseen_reminder();
// submit form and get new records
$('#comment_form').on('submit', function(event){
 event.preventDefault();
 if($('#subject').val() != '' && $('#comment').val() != '')
 {
  var form_data = $(this).serialize();
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {
    $('#comment_form')[0].reset();
    load_unseen_reminder();
   }
  });
 }
 else
 {
  alert("Both Fields are Required");
 }
});
// load new reminder
$(document).on('click', '.dropdown-toggle', function(){
 $('.count').html('');
 load_unseen_reminders('yes');
});
setInterval(function(){
 load_unseen_reminder();;
}, 5000);
});
</script>
    </body>
</html>