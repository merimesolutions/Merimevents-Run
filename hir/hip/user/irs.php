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
      /*.top-wrapper{
            background-color: black;
            padding: 0 5px 5px 5px;
            border-radius: 5px;*/
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
                <section class="content-header">
                    <a href="ir.php" title="Go home"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go home"></i> Back</a>
                    <!--  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;-->
                    <!-- <a href="irlEx.php" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to Excel</a>-->
                    
                    <!--&nbsp;&nbsp;&nbsp;-->

                    <!--<a href="irlpr.php" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Print</a>-->
                    
                </section>

                <!-- Main content -->
                <section class="content">

                <div class="box"> 
                     <div class="container-fluid container-fullw bg-white">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="top-wrapper">
                <?php
                  $searchcrno = $_GET['cjk7834nnsdf72nmmnsdf47//4-43reiosdjhjsd8c8989xcv'];
                  $company      =$_SESSION['company'];
                    $ret=mysqli_query($con,"select * from tblcustomers where identity='".$searchcrno."' and company = '".$company."' ");
                      $cnt=1;
                    while ($row=mysqli_fetch_array($ret)) {
                ?>
                <table class="table table-striped">
                                <tr>
                                  <th scope>Customer Name</th>
                                  <th scope>National ID No.</th>
                                  <!--<th scope>Gender</th>-->
                                  <th>Contact</th>
                                </tr>
                                <tr style="background-color:#EBF5FB;">
                                  <td><?php  echo ucwords($row['fname']).' '.ucwords($row['lname']).' '.ucwords($row['mname']);?></td>
                                  <td><?php  echo $row['identity'];?></td>
                                   
                                  <td><?php  echo ucwords($row['fcontact']).'  '.ucwords($row['scontact']);?></td>
                                </tr>               
                            <?php }
                            ?>
                          </table>
                        </div>
                    <br>
                          
                            <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px !important;"><i class="fa fa-list"></i></th>
                                                <th>Item</th>
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
                                        $search = $_GET['cjk7834nnsdf72nmmnsdf47//4-43reiosdjhjsd8c8989xcv'];
                                        $company=$_SESSION['company'];
                                        $query  = "SELECT tblitems.id, tblitems.item_name,tblleased.qnty,tblleased.qlty,tblleased.ldate,tblleased.rdate, tblleased.served_by,tblleased.item_name_id,tblleased.item_id,tblleased.bal_qnty,tblleased.damaged,tblleased.company
                                        FROM 
                                            tblitems 
                                        LEFT JOIN tblleased 
                                        ON tblitems.id = tblleased.item_name_id 
                                        WHERE client='".$search."' and bal_qnty !='0' ORDER BY id DESC";
                                                $result = mysqli_query($con, $query);

                                                while ($row = mysqli_fetch_array($result))
                                                                    { 
                                              if(($row['ldate'])<($row['rdate'])){
                                                $status = '<p style="color:green">'.'Active'.'</p>';
                                              }
                                              if(($row['ldate'])>($row['rdate'])){
                                                $status = '<p style="color:red">'.'Overdue'.'</p>';
                                              }

                                                echo '
                                            <tr>
                                                <td><img src="../../images/icons/pointer.png" class="pointer"></td> 
                                                <td>'.ucwords($row['item_name']).'</td>
                                                <td>'.ucwords($row['ldate']).'</td>   
                                                <td>'.ucwords($row['rdate']).'</td> 
                                                <td>'.number_format($row['bal_qnty'],0).'</td>
                                                <td>'.number_format($row['damaged'],0).'</td> 
                                                <td>'.ucwords($status).'</td>
                                                <td><center><a data-target="#editirs'.$row['item_id'].'" data-toggle="modal"><img src="../../images/icons/returning.png" title="Returning action" class="iconb"></a></center></td> 
                                                                                
                                                </tr>
                                                ';
                                                
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
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>



