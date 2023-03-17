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
        .sidebar-menu .invoices{
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
            <?php include('getroles.php');?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                
                <section class="content-header">
                       <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                </section>

                <!-- Main content -->
                <section class="content">
                    
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding-left:10px;">
                                        
                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <form method="post">
                                    <p>Items damaged invoices</p>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <!--th style="width: 20px !important;"><input type="checkbox" name="chk_delacc[]" class="cbxMain" onchange="checkMain(this)" /></th-->
                                                <th style="width: 15px !important;"><i class="fa fa-list"></i></th>
                                                <th style="width: 100px !important;">Customer ID</th>
                                                <th style="width: 300px !important;">Full Name </th>
                                                <?php if($di_print==1){?>
                                                <th style="width: 20px !important;">Print</th>
                                                <?php }?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                                $query = mysqli_query($con, "select distinct client from tblleased where damaged>'0' and comment='not cleared' and company = '".$_SESSION['company']."' ");
                                                while($row = mysqli_fetch_array($query))
                                            {
                                                $r=$row['client'];
                                                $c = mysqli_query($con, "select * from tblcustomers where identity='".$r."' ");
                                                while($data = mysqli_fetch_array($c))
                                            {
                                                $fname=$data['fname'];
                                                $mname=$data['mname'];
                                                $lname=$data['lname'];
                                                echo '
                                            <tr>
                                                <!--td><input type="checkbox" name="chk_delacc[]" class="chk_delete" value="" /></td--> 
                                                <td><a href=idcr.php?cl='.$row['client'].' target="_blank"><img src="../../images/icons/folder_open.png" class="iconb"title="Print invoice: '.$row['client'].'"></a></td>
                                                <td><a href=idcr.php?cl='.$row['client'].' target="_blank">'.$row['client'].'</a></td> 
                                                <td><a href=idcr.php?cl='.$row['client'].' target="_blank">'.ucwords($data['fname']).' '.ucwords($data['mname']).' '.ucwords($data['lname']).'</a></td>';
                                                if($di_print==1){
                                                    echo '  <td><center><a href=idcr.php?cl='.$row['client'].' target="_blank"><img src="../../images/icons/print.png" title="Print invoice: '.$row['client'].'" class="iconb"></a></center></td> ';
                                                }
                                                 echo '                         
                                                </tr>
                                                ';
                                                
                                                //include "editaccl.php";
                                            }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>

                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
                </form>
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