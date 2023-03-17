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
        .sidebar-menu .reports{
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
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                   <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;  
                    
                    <a href="diEx.php" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to Excel</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="dicr-prev" target="_parent"><i class="fa fa-print" aria-hidden="true"></i> Print preview</a>
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">  
                        <p>Damaged items & payments</p>          
                            <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;">No.</th>
                                                <th>Client</th>
                                                <th>ID</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Charges for @ </th>
                                                <th>Charged (Ksh.)</th>
                                                <th>Paid (Ksh.)</th>
                                                <th>Balance (Ksh.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                             $s = $_SESSION['company'];
                            $q  = "SELECT * FROM tblcustomers where company = '".$_SESSION['company']."'";
                        $r = mysqli_query($con, $q);
                            while ($rows = mysqli_fetch_array($r))
                                                  { 
                                $cc=$rows['identity'];
                        $query  = "SELECT * FROM tblleased where damaged !='NULL' and comment = 'not cleared' and client= '$cc' ";
                        $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result))
                                                  { 
                                $cb=$row['client'];
                                $z=$row['item_name_id'];
                                $d=$row['damaged'];
                                
                        $qu = "SELECT * FROM tblitems where id ='$z'";
                        $res= mysqli_query($con, $qu);
                            while ($rowss = mysqli_fetch_array($res))
                                                  {
                                       $dmg=$rowss['damage_charges'];           $charges=($dmg*$d);    
                        $q = "SELECT * FROM tblcleared where item_name_id_clear ='".$z."' and client='".$cb."' ";
                                            $query_run = mysqli_query($con,$q);

                                            $paid= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $paid += $num['payment'];

                                        
                                                  }
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($rows['fname']).' '.ucwords($rows['mname']).' '.ucwords($rows['lname']).'</td>
                                                <td>'.$cc.'</td>
                                                <td>'.ucwords($rowss['item_name']).'</td>  
                                                <td>'.$row['damaged'].'</td> 
                                                <td>'.$rowss['damage_charges'].'</td>
                                                <td>'.$charges.'</td>
                                                <td>'.$paid.'</td>
                                                <td>'.($charges - $paid).'</td>
                                                                                 
                                                </tr>
                                                ';
                                                  }
                                                  }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    </form>

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



