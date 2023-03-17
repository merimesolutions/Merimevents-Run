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
                     <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    <a href="rcr-prev"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Print"></i> Print preview</a>
                </section>

                <!-- Main content -->
                <section class="content">

                <div class="box"> 
                  <div class="box-body table-responsive">  
                  <p>
                       Reconciled items 
                    </p>
                   <div class="panel-heading" >
                      <div class="row">
                          
                            <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px !important;"><i class="fa fa-list"></i></th>
                                                <th>Item</th>
                                                <th>Initial quantity</th>
                                                <th>New quantity</th>
                                                <th>Difference</th>
                                                <th>Reason</th>
                                                <th>Reconciled by</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $query  = "SELECT * FROM tblitems WHERE actual!='' ORDER BY id DESC";
                                                $result = mysqli_query($con, $query);

                                                while ($row = mysqli_fetch_array($result))
                                                                    { 
                                            $d = $row['qnty'] - $row['actual'];
                                                echo '
                                            <tr>
                                                <td>'.$c.'</td> 
                                                <td>'.ucwords($row['item_name']).'</td>
                                                <td>'.ucwords($row['actual']).'</td>   
                                                <td>'.ucwords($row['qnty']).'</td> 
                                                <td>'.$d.'</td>
                                                <td>'.ucwords($row['reason']).'</td> 
                                                <td>'.ucwords($row['reconciled_by']).'</td> 
                                                <td>'.ucwords($row['reconciled_date']).'</td> 
                                                                                        </tr>
                                                ';
                                                $c++;
                                                include "editirs.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                              </form>
                            </div>
                        </div>
                      </div>
                    </div>
            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>
                  </div>
                </div>
              </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->   
                <!-- jQuery 2.0.2 -->
        <?php 
        include "../footer.php"; ?>
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



