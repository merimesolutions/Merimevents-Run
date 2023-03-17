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
    <style>.sidebar-menu .inventory{
        background-color:#009999;
    }</style>
    <?php include('../head_css.php'); ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>
        <?php include('getroles.php');?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                       
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
                               
                                <p>Inventory</p>
                                 <?php  if($i_available_stock==1){?>
                                <div class="col-sm-4">
                                    <a href="ai" title="Damaged items Invoices">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"> <img src="../../images/icons/avv.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;">Available stock</span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <?php } if($i_add_new_item==1){?>
                                <div class="col-sm-4" style="">
                                    <a href="ani" title="Lease items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"><img src="../../images/icons/addd.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;"> Add new item(s) to stock</span>   
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <?php } if($i_restock==1){?>
                                <div class="col-sm-4" style="">
                                    <a href="rei" title="Lease items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x">  <img src="../../images/icons/restock.png" class="icon"> </span>
                                            
                                            <span style="color:#000;margin-left: 7px;"> Restock items</span>   
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                   <?php } if($i_set_charges==1){?>
                                <div class="col-sm-4">
                                    <a href="dic" title="Overdue Invoices">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"> <img src="../../images/icons/cal.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;">Set charges</span>
                                         <!--?php
                                    $qry  = "SELECT SUM(bal_qnty) AS sum ,SUM(damaged) AS damaged FROM tblleased where company='".$company."' ";
                            
                            $r = mysqli_query($con, $qry);
                                    while ($rows = mysqli_fetch_assoc($r))
                                                  {
                                                
                                        if($squery){
                                            echo '<small class="badge pull-right bg-red"><i class="fa fa-times"></i> Set all charges</small>';
                                            
                                        }
                                        if(!$squery){
                                            echo '<small class="badge pull-right bg-green"><i class="fa fa-check"></i> All</small>';
                                        }   
                                            }
                                            
                                            ?-->
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <?php } ?>

                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->   
                <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
function goBack() {
           window.history.back();
           }
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>