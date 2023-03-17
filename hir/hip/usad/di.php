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
    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <?php
                function RandomString($length) {
                    $keys = array_merge(range(0,9));
                        $key = "";
                        for($i=0; $i < $length; $i++) {
                        $key .= $keys[mt_rand(0, count($keys) - 1)];
                    }
                        return $key;               
                }
            ?>
         
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                      <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    <a href="diEx.php" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to Excel</a>
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <!-- <div class="box"> -->
                        <div class="box-body table-responsive" style="overflow-y: auto;">  
                        <p>Damaged items</p>          
                            <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Client Name</th>
                                                <th>Client ID</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Damage Charges (@) </th>
                                                <th>Charged</th>
                                                <th>Paid</th>
                                                <th>Balance</th>
                                                <th style="width:80px">Clearance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                        ?>
                                            <?php
                                            $c=1;
                                            $query  = "SELECT tblcustomers.id, tblcustomers.fname,tblcustomers.mname,tblcustomers.lname,tblcustomers.identity,tblcustomers.fcontact, tblleased.client,tblleased.item_name_id,tblleased.qnty,tblleased.qlty,tblleased.rdate,tblleased.ldate,tblleased.served_by,tblleased.status,tblleased.company,tblleased.damaged,tblleased.item_id,tblitems.item_name,tblitems.damage_charges
                                                FROM 
                                                tblcustomers 
                                                LEFT JOIN tblleased 
                                                ON tblcustomers.identity = tblleased.client 
                                                LEFT JOIN tblitems 
                                                ON tblitems.id = tblleased.item_name_id  
                                                where damaged !='0' and comment = 'not cleared' and tblleased.company='".$_SESSION['company']."' ";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                            $cb=$row['client'];
                        $z=$row['item_name_id'];
                            $q = "SELECT * FROM tblcleared where item_name_id_clear ='".$z."' and client='".$cb."' ";
                                            $query_run = mysqli_query($con,$q);

                                            $paid= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $paid += $num['payment'];
                                            }
                                            

                                                    $dmg=$row['damage_charges'];
                                                    $d=$row['damaged'];
                                                    $charges=($dmg*$d);
                                                    $bal=$charges-$paid;
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td>
                                            <td>'.ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']).'</td>
                                                <td>'.ucwords($row['identity']).'</td>
                                                <td>'.ucwords($row['item_name']).'</td>  
                                                <td>'.$row['damaged'].'</td> 
                                                <td>'.$row['damage_charges'].'</td>
                                                <td>'.number_format($charges,2).'</td>
                                                <td>'.number_format($paid,2).'</td>
                                                <td>'.number_format($bal,2).'</td>
                                                <td><button class="btn btn-primary btn-sm" data-target="#editDi'.$row['item_id'].'" data-toggle="modal" style="width:100%" title="Click to clear this record"> Clear </button></td>
                                                                                  
                                                </tr>
                                                ';
                                                
                                                include "editdi.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    </form>

             <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>

                  </div>
                <!-- </div> -->
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



