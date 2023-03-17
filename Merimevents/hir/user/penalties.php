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
    <style>.sidebar-menu .penalties{
        background-color:#009999;
    }</style>
    <?php include('../head_css.php'); ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>
        <!--Get roles-->
        <?php include('getroles.php');?>
      
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
                    <section class="content" style="width: 100%;height: 100%;">
                        <!-- start: PAGE TITLE -->
                        
                        <!-- end: PAGE TITLE -->
                        <!-- start: BASIC EXAMPLE -->
                            <div class="container-fluid container-fullw" style="/*border-radius: 10px;background: linear-gradient(to top right, #a8e8e4 22%, #b7cad2 49%)*/">

                                <!--background-image: linear-gradient(red, yellow, green);box-shadow: 2px 0px 20px rgba(0, 0, 0, 0.8);-->
                            <div class="row">
                               
                                <p>Penalties</p>
                                 <?php if($p_damaged_items==1){?>
                                <div class="col-sm-4" style="">
                                    <a href="di" title="Lease items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"><img src="../../images/icons/br.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;"> Damaged items</span> 
                                            <?php
                                            $query = "SELECT * FROM tblleased where damaged>'0' and comment = 'not cleared' and company='".$_SESSION['company']."' ";
                                            $query_run = mysqli_query($con,$query);

                                            $qty= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $qty += $num['damaged'];
                                            }
                                            $d= number_format($qty,0);
                                            echo '<small class="badge pull-right bg-yellow">'.$d.'</small>';
                                            ?>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <?php } if($p_overdue_items==1){?>
                                <div class="col-sm-4" style="">
                                    <a href="oic" title="Lease items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x">  <img src="../../images/icons/tm.png" class="icon"> </span>
                                            
                                            <span style="color:#000;margin-left: 7px;"> Overdue items</span> 
                                            <?php
                                        $date=date("Y-m-d");
                            $q = mysqli_query($con,"SELECT * from tblleased where rdate<'".$date."' and company='".$_SESSION['company']."' and comment !='cleared' ");
                                $num_rows = mysqli_num_rows($q);
                                            $o = number_format($num_rows,0);
                                            echo '<small class="badge pull-right bg-orange">'.$o.'</small>';
                                            ?>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <?php }?>

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