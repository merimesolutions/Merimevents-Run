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
                    <?php
                    $qq = "SELECT * FROM tblleased where company='".$_SESSION['company']."' ";
                        $query_run = mysqli_query($con,$qq);

                        $leaseditems= 0;
                        while ($num = mysqli_fetch_assoc ($query_run)) {
                            $leaseditems += $num['bal_qnty'];
                        } 


                        $company=$_SESSION['company'];
                    $e  = "SELECT SUM(qnty) AS stock FROM tblitems where company='".$company."' ";
                    $result = mysqli_query($con, $e);
                        while ($row = mysqli_fetch_array($result))
                                          { 
                    $ry  = "SELECT SUM(bal_qnty) AS sum ,SUM(damaged) AS damaged FROM tblleased where company='".$company."' ";
                    
                    $r = mysqli_query($con, $ry);
                            while ($rows = mysqli_fetch_assoc($r))
                                          {
                            $d='0';                  
                            $bal = $row['stock'] - $rows['sum'];
                            
                                          }
                                          }


                        $qy = "SELECT * FROM tblleased where damaged>'0' and comment = 'not cleared' and company='".$_SESSION['company']."' ";
                        $query_run = mysqli_query($con,$qy);

                        $damageditems= 0;
                        while ($num = mysqli_fetch_assoc ($query_run)) {
                            $damageditems += $num['damaged'];
                        }



                        $date=date("Y-m-d");
                        $q = mysqli_query($con,"SELECT * from tblleased where rdate<'".$date."' and company='".$_SESSION['company']."' ");
                        $overduereports = mysqli_num_rows($q);
                                            
                                       
                     
                        $qry = "SELECT * FROM tblleased where company='".$_SESSION['company']."' ";
                        $query_run = mysqli_query($con,$qry);

                        $returneditems= 0;
                        while ($num = mysqli_fetch_assoc ($query_run)) {
                        $returneditems += $num['rqnty'];
                        }


                        $cus = mysqli_query($con,"SELECT * from tblcustomers where company='".$_SESSION['company']."' ");
                        $customer = mysqli_num_rows($cus);
                                       
                       
                        $task = mysqli_query($con,"SELECT * from tblprojects where company='".$_SESSION['company']."' ");
                        $mytasks = mysqli_num_rows($task);
                    
                        
                        $dat = date('Y-m-d');
                        $dt2=date('Y-m-d', strtotime('+3 days'));
                        $qery = mysqli_query($con, "select count(user) as uu from tblreminder where user = '".$_SESSION['userid']."' AND scheduled_date BETWEEN  '".$dat."' AND '".$dt2."' ");
                         while($row = mysqli_fetch_array($qery)){
                         
                                $rem = $row['uu'];
                            }

                                            
                        $qqq = mysqli_query($con,"SELECT * from tblevents where company='".$_SESSION['company']."' ");
                        $eve = mysqli_num_rows($qqq);


                        

                        $compzz=$_SESSION['company'];
                        $cust_person=$_SESSION['userid'];
                        $todoo = mysqli_query($con,"SELECT * from todo where user= '".$_SESSION['userid']."' and status = 0 ");
                        $tdd = mysqli_num_rows($todoo); 

                        $sdo=mysqli_query($con,"SELECT * FROM customer_comments WHERE (company='$compzz' AND followup_userid ='$cust_person' OR customer_person ='$cust_person') AND customer_progress !='Completed' ");
                        $tddd = mysqli_num_rows($sdo);
                        $td = $tdd + $tddd;
              
                                                 
                                $todo= '<div class="col-sm-4">
                                    <a href="todo" title="To do list">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">                <span class="fa-stack fa-2x"> <img src="../../images/icons/document.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">To do list </span>
                                            <span style="color:#fff;float:right;background-color:red;" class="badge"> '.number_format($td,0).'</span>
                                           
                                        </div>
                                    </div>
                                </a>
                                </div>';     
                                       
                                    $lease_items = '<div class="col-sm-4" style="">
                                    <a href="ocr" title="Lease items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x">  <img src="../../images/icons/li.png" class="icon" style="width: 60px;"> </span>
                                            
                                            <span style="color:#fff;margin-left: 14px;"> Lease items </span>   
                                        </div>
                                    </div>
                                    </a>
                                </div>';
       
                                $invoices = '<div class="col-sm-4">
                                    <a href="invoices" title="Overdue Invoices">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/tm.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Invoices</span>
                                        </div>
                                    </div>
                                </a>
                                </div>'; 

                                

                                $leased_items = '<div class="col-sm-4">
                                    <a href="li" title="Leased Items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/leased.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Leased Items </span>
                                        <span style="color:#fff;float:right;">'.number_format($leaseditems,0).
                                        '</span>
                                        </div>
                                    </div>
                                </a>
                                </div>';

                                $stock_available = '
                                <div class="col-sm-4">
                                    <a href="ai" title="Stock management">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/stock.png" class="icon" style="width: 60px;">  </span>
                                            <span style="color:#fff;margin-left: 14px;">Stock available</span>
                                       <span style="color:#fff;float:right;">'.$bal.' </span>
                                        </div>
                                    </div>
                                </a>
                                </div>';

                                $damaged_items = '<div class="col-sm-4">
                                    <a href="di" title="Damaged Items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/broken.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Damaged Items</span>
                                       <span style="color:#fff;float:right;">'.number_format($damageditems,0).'</span>
                                        </div>
                                    </div>
                                </a>
                                </div>';

                                $reports = '
                                <div class="col-sm-4">
                                    <a href="reports"  title="Overdue reports">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/reports.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;"> Reports </span>
                                        <span style="color:#fff;float:right;"></span>
                                        </div>
                                    </div>
                                </a>
                                </div>';

                                $returned_items = '<div class="col-sm-4">
                                    <a href="irr" title="Items returned report">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/returned.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Returned Items</span>
                                        <span style="color:#fff;float:right;"> '.number_format($returneditems,0).' </span>    
                                        </div>
                                    </div>
                                </a>
                                </div>';

                                $customers = ' <div class="col-sm-4">
                                    <a href="cl" title="Our customers">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/users.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Customers</h5>
                                            <span style="color:#fff;float:right;"> '.number_format($customer,0).' </span>
                                        </div>
                                    </div>
                                </a>
                                </div>';

                                $my_tasks = '<div class="col-sm-4">
                                    <a href="pl" title="My Tasks">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/project.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">My Tasks </span>
                                            <span style="color:#fff;float:right;"> '.number_format($mytasks,0).'</span>
                                        </div>
                                    </div>
                                </a>
                                </div>';

                                $events = '<div class="col-sm-4">
                                    <a href="events" title="Events">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">                <span class="fa-stack fa-2x"> <img src="../../images/icons/reminder.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;">Events </span>
                                            <span style="color:#fff;float:right;"> 
                                            '.number_format($eve,0).'
                                            </span>
                                           
                                        </div>
                                    </div>
                                </a>
                                </div>';
                                 $settings = '
                                <div class="col-sm-4">
                                    <a href="setting"  title="System Settings">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <img src="../../images/icons/settings.png" class="icon" style="width: 60px;"> </span>
                                            <span style="color:#fff;margin-left: 14px;"> Settings </span>
                                        <span style="color:#fff;float:right;"></span>
                                        </div>
                                    </div>
                                </a>
                                </div>';

                                 ?> 



                             
                            <div class="row">
                                <br>
                <?php
                 $admin = mysqli_query($con,"SELECT * from tblstaff where id =' ".$_SESSION['userid']."' ");
                    while($row = mysqli_fetch_array($admin)){
                        $package=$row['package'];
                        if($package==1){
                            echo $todo;
                            echo $lease_items;
                            echo $leased_items;
                            echo $invoices;
                            echo $stock_available;
                            echo $damaged_items;
                            echo $reports;
                            echo $returned_items;
                            echo $my_tasks ;
                            echo $reminder;
                            echo $customers;
                            echo $settings;
                                  }
                        if($package==2){
                            echo $todo;
                            echo $lease_items;
                            echo $leased_items;
                            echo $invoices;
                            echo $stock_available;
                            echo $damaged_items;
                            echo $reports;
                            echo $returned_items;
                            echo $my_tasks ;
                            echo $customers;
                            echo $settings;
                                  }
                        if($package==3){
                            echo $todo;
                            echo $lease_items;
                            echo $leased_items;
                            echo $invoices;
                            echo $stock_available;
                            echo $damaged_items;
                            echo $reports;
                            echo $returned_items;
                            echo $my_tasks ;
                            echo $events;
                            echo $customers;
                            echo $settings;
                                  }
                        if($package==4){ 
                            echo $todo;                        
                            echo $customers;
                            echo $my_tasks ;
                            echo $settings;
                            
                                  }
                                    }
                                ?>
                                
                                 
                                
                                
                                
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