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
    <style>
        .sidebar-menu .reports{
        background-color:#009999;
    }
    </style>
    <?php include('../head_css.php'); ?>
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
                      <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>
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
                                <p>Reports</p>
                                <?php
                                if($_SESSION['role'] == "admin"){
                                    echo '
                                <div class="col-sm-4" style="">
                                    <a href="sales" title="Lease items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"><img src="../../images/icons/folder_open.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;"> Sales report</span>   
                                        </div>
                                    </div>
                                    </a>
                                </div>'; } ?>
                                <div class="col-sm-4" style="">
                                    <a href="ai" title="Lease items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"><img src="../../images/icons/avv.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;"> Available items</span>   
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-sm-4" style="">
                                    <a href="lai" title="Lease items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x">  <img src="../../images/icons/li.png" class="icon"> </span>
                                            
                                            <span style="color:#000;margin-left: 7px;"> Leased items</span>   
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="dicr" title="Damaged items Invoices">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"> <img src="../../images/icons/br.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;">Damaged items</span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="irr" title="Overdue Invoices">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"> <img src="../../images/icons/st.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;">Returned items report</span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <?php
                                if($_SESSION['role'] == "admin"){
                                    echo '
                                <div class="col-sm-4">
                                    <a href="rcr" title="Overdue Invoices">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"> <img src="../../images/icons/recc.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;">Reconciled Items</span>
                                        </div>
                                    </div>
                                </a>
                                </div>'; } ?>
                                <div class="col-sm-4">
                                    <a href="pr" title="Projects report">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"> <img src="../../images/icons/pr.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;">Projects Report</span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <?php
                                if($_SESSION['role'] == "admin"){
                                    echo '
                                <div class="col-sm-4">
                                    <a href="cancelled" title="Projects report">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"> <img src="../../images/icons/folder_open.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;">Cancelled Invoices</span>
                                        </div>
                                    </div>
                                </a>
                                </div>'; } ?>

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