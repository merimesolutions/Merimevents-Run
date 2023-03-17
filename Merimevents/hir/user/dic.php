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
        .sidebar-menu .inventory{
        background-color:#009999;
    }
    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        include('getroles.php');
        ?>
        <?php include('../header.php'); ?>
      
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    <?php if($sc_available_stock==1){?>
                    <a href="ai.php" title="Available stock"><i class="fa fa-tasks" aria-hidden="true" title="Available stock"></i> Available stock</a>&nbsp;&nbsp;&nbsp;
                    <?php }?>
                       
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">

                        <!-- left column -->
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <p>Set Leasing price / Damage & Overdue charges</p>
                                <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Batch N<sub>o</sub></th>
                                                <th>Item</th>
                                                <th>description</th>
                                                <th style="">Damage charges</th>
                                                <th style="">Overdue charges (per day)</th>
                                                <?php if($sc_edit==1){?>
                                                <th style="width: 20px !important;">Edit</th>
                                                <?php }?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $c=1;
                                        $company=$_SESSION['company'];
                                        $squery = mysqli_query($con, "select * from tblitems where company='".$company."' ORDER BY id DESC");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                echo '
                                            <tr>
                                                <td><img src="../../images/icons/pointer.png" class="pointer"></td> 
                                                <td>'.$row['bno'].'</td>
                                                <td>'.ucwords($row['item_name']).'</td>
                                                <td>'.ucwords($row['qlty']).'</td>
                                                <td>'.ucwords($row['damage_charges']).'</td>   
                                                <td>'.ucwords($row['overdue_charges']).'</td> ';
                                                if($sc_edit==1){
                                                echo '<td><center><a data-target="#editdic'.$row['id'].'" data-toggle="modal"><img src="../../images/icons/doc_edit.png" title="Edit this record" class="iconb"></a></center></td>';
                                                }echo '
                                                </tr>
                                                ';
                                                
                                            include "editdic.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


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
                     "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
                  });
              });
          </script> 
    </body>
</html>