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
        .sidebar-menu .penalties{
        background-color:#009999;
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
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <!-- <div class="box"> -->
                        <div class="box-body table-responsive" style="overflow-y: auto;">  
                        <p>Overdue Charges</p>          
                            <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Customer</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Deadline</th>
                                                <th>Extra days</th>
                                                <th>Charges per day</th>
                                                <th>Total</th>
                                                <th>Paid</th>
                                                <th>Balance</th>
                                                <th style="width:80px">Clearance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $c=1;
                                            $date = date("Y-m-d h:i:sa");
                                            $query  = "SELECT tblcustomers.id, tblcustomers.fname,tblcustomers.mname,tblcustomers.lname,tblcustomers.identity,tblcustomers.fcontact, tblleased.client,tblleased.item_name_id,tblleased.qnty,tblleased.qlty,tblleased.rdate,tblleased.ldate,tblleased.served_by,tblleased.status,tblleased.damaged,tblleased.item_id,tblitems.item_name,tblitems.damage_charges,tblitems.overdue_charges,tblleased.company
                                                FROM 
                                                tblcustomers 
                                                LEFT JOIN tblleased 
                                                ON tblcustomers.identity = tblleased.client 
                                                LEFT JOIN tblitems 
                                                ON tblitems.id = tblleased.item_name_id  
                                                where rdate < '".$date."' and tblleased.company='".$_SESSION['company']."' and tblleased.comment !='cleared' ";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                            $cb=$row['client'];
                                            $z=$row['item_id'];
                                            $q = "SELECT * FROM tbloverdate where itemid ='".$z."' and client='".$cb."' ";
                                            $query_run = mysqli_query($con,$q);

                                            $paid= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $paid += $num['payment'];
                                                $rdate = date('Y-m-d',strtotime($row['rdate']));
                                            }
                                            
                                            date_default_timezone_set('Africa/Nairobi');
                                            $time2 = strtotime(date("Y-m-d-m-Y h:i:sa"));
                                            $time1 = strtotime($row['rdate']);
                                            $dif   = floor( ($time2-$time1) /(60*60*24));
                                            $overdue =($row['overdue_charges'] * $dif * $row['qnty']);

                                            $bal=$overdue - $paid;

                                                    
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']).'</td>
                                                
                                        <td>'.ucwords($row['item_name']).'</td> 
                                        <td>'.$row['qnty'].'</td>
                                        <td>'.$rdate.'</td> 
                                        <td>'.floor( ($time2-$time1) /(60*60*24)).'</td>
                                        <td>'.number_format($row['overdue_charges'],2).'</td>
                                        <td>'.number_format($overdue,2).'</td>
                                        <td>'.number_format($paid,2).'</td>
                                        <td>'.number_format($bal,2).'</td>
                                        <td><button class="btn btn-primary btn-sm" data-target="#editoic'.$row['item_id'].'" data-toggle="modal" style="width:100%" title="Click to clear this record"> Clear </button></td>
                                                                                  
                                                </tr>
                                                ';
                                                
                                                include "editoic.php";
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



