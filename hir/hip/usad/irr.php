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
    <style>.sidebar-menu .reports{
        background-color:#009999;
    }</style>
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
                </section>

                <!-- Main content -->
                <section class="content">

                <div class="box"> 
                  <div class="box-body table-responsive">            
                   <div class="panel-heading" >
                      <div class="row">
                          <p>
                       Returned items 
                    </p>
                            <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px !important;"><i class="fa fa-list"></i></th>  
                                                <th>Customer</th>
                                                <th>Item</th>
                                                <th>Leased Date</th>
                                                <th>Return Date</th>
                                                <th>Remaining</th>
                                                <th>Damaged</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $query  = "SELECT tblitems.id, tblitems.item_name,tblleased.qnty,tblleased.qlty,tblleased.ldate,tblleased.rdate, tblleased.served_by,tblleased.item_name_id,tblleased.item_id,tblleased.bal_qnty,tblleased.damaged,tblleased.client
                                                FROM 
                                                tblitems 
                                                LEFT JOIN tblleased 
                                                ON tblitems.id = tblleased.item_name_id 
                                                WHERE rqnty !='0' and tblitems.company='".$_SESSION['company']."' ORDER BY id DESC";
                                                $result = mysqli_query($con, $query);

                                                while ($row = mysqli_fetch_array($result))
                                                                    { 
                                              if(($row['ldate'])<($row['rdate'])){
                                                $status = '<p style="color:green">'.'Active'.'</p>';
                                              }
                                              if(($row['ldate'])>($row['rdate'])){
                                                $status = '<p style="color:red">'.'Overdue'.'</p>';
                                              }
                                            $client=$row['client'] ; 
                                        $q = "SELECT * FROM tblcustomers where identity='".$client."' ";
                                            $query_run = mysqli_query($con,$q);
                                            while ($rows = mysqli_fetch_array($query_run)) {
                                                $f= $rows['fname'];
                                                $m= $rows['mname'];
                                                $l= $rows['lname'];

                                                echo '
                                            <tr>
                                                <td>'.$c.'</td> 
                                                <td>'.ucwords($f).' '.ucwords($m).' '.ucwords($l).'</td>
                                                <td>'.ucwords($row['item_name']).'</td>
                                                <td>'.ucwords($row['ldate']).'</td>   
                                                <td>'.ucwords($row['rdate']).'</td> 
                                                <td>'.number_format($row['bal_qnty'],0).'</td>
                                                <td>'.number_format($row['damaged'],0).'</td> 
                                                <td>'.ucwords($status).'</td>
                                                                                        </tr>
                                                ';
                                                $c++;
                                                include "editirs.php";
                                            }
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



