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
    <style>.sidebar-menu .ir{
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
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp; |  Returned Items
                </section>

                <!-- Main content -->
                <section class="content">
           
                  <!--<div class="box-body table-responsive">            -->
                  <!-- <div class="panel-heading" >-->
                  <!--   <div class="container-fluid container-fullw bg-white">-->
                  <!--    <div class="row">-->
                  <!--      <div class="col-md-6">-->
                  <!--      <form action="irl.php" target="_parent" method="GET">-->
                  <!--      <P>SEARCH: Identity / Passport / Name / Contact No. / Email / Company</p>-->
                  <!--      <input type="text" required class="form-control" name="search//dcsnmm895jk4xcjk89wnm-euiuirsdkl478895nuieryu" id="search//dcsnmm895jk4xcjk89wnm-euiuirsdkl478895nuieryu" placeholder="Search..." style="width:85%;overflow: flex; margin-bottom:5px; float:left" />        -->
                  <!--      <button type="submit" class="form-control btn btn-sm btn-success" name="" style="width:15%; float:right;"><i class="fa fa-search" aria-hidden="true"></i></button>-->
                  <!--  </form>              -->
      
                  <!--          </div>-->
                  <!--        </div>-->
                         
                         
                  <!--      </div>-->
                  <!--    </div>-->
                  <!--  </div>-->
                      <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px !important;"><i class="fa fa-list"></i></th>
                                                <th>Invoice Number</th>
                                                <th>Item</th>
                                                
                                                <th>Customer Name</th>
                                                <th>Leased Date</th>
                                                <th>Return Date</th>
                                                <th>Remaining</th>
                                                <th>Damaged</th>
                                                <th>Status</th>
                                                <th style="background-color: teal;color: #fff;text-align: center;" >Return</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                      
                                         <?php
                                        $c=1;
                                        $company=$_SESSION['company'];
                                         $query  = "SELECT tblitems.id,tblleased.invoice, tblitems.item_name,tblcustomers.customer_name,tblleased.qnty,tblleased.qlty,tblleased.ldate,tblleased.rdate, tblleased.served_by,tblleased.item_name_id,tblleased.item_id,tblleased.bal_qnty,tblleased.damaged,tblleased.company
                                        FROM 
                                        tblitems 
                                        LEFT JOIN tblleased 
                                        ON tblitems.id = tblleased.item_name_id
                                        LEFT JOIN tblcustomers 
                                        ON tblcustomers.identity = tblleased.client 
                                        where tblleased.company = '$company'
                                          ORDER BY id DESC";
                                         
                                                $result = mysqli_query($con, $query);
                                                

                                                while ($row = mysqli_fetch_array($result))
                                                                    { 
                                              if(($row['ldate'])<($row['rdate'])){
                                                $status = '<p style="color:green">'.'Active'.'</p>';
                                              }
                                              if(($row['ldate'])>($row['rdate'])){
                                                $status = '<p style="color:red">'.'Overdue'.'</p>';
                                              }
                                              
                                               $ldate = date('Y-m-d',strtotime(ucwords($row['ldate'])));
                                                $rdate = date('Y-m-d',strtotime(ucwords($row['rdate'])));
                                                echo '
                                            <tr>
                                                <td><img src="../../images/icons/pointer.png" class="pointer"></td> 
                                                 <td>'.$row['invoice'].'</td>
                                                <td>'.ucwords($row['item_name']).'</td>
                                               
                                                <td>'.ucwords($row['customer_name']).'</td>
                                                <td>'.$ldate.'</td>   
                                                <td>'.$rdate.'</td> 
                                                <td>'.number_format($row['bal_qnty'],0).'</td>
                                                <td>'.number_format($row['damaged'],0).'</td> 
                                                <td>'.ucwords($status).'</td>
                                                <td><center><a  href="javascript:void(0)" data-target="#editirs'.$row['item_id'].'" data-toggle="modal"><img src="../../images/icons/returning.png" title="Returning action" class="iconb"></a></center></td> 
                                                                                
                                                </tr>
                                                ';
                                                
                                                include "editirs.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>

                              </form>
               
                  </div>
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