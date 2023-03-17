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
    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        ob_start();
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
                    <a href="db.php" title="Go home"><i class="fa fa-home" aria-hidden="true" title="Go home"></i> Home</a>&nbsp;&nbsp;&nbsp;
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">            
                            <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Customer</th>
                                                <th>Identity</th>
                                                <th>Item name</th>
                                                <th>Qnty</th>
                                                <th>Leased date</th>
                                                <th>Returning Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                $query  = "SELECT tblcustomers.id, tblcustomers.fname,tblcustomers.mname,tblcustomers.lname,tblcustomers.identity,tblcustomers.fcontact, tblleased.client,tblleased.item_name_id,tblleased.qnty,tblleased.qlty,tblleased.rdate,tblleased.ldate,tblleased.served_by,tblleased.status,tblleased.item_id,tblitems.item_name
                                                FROM 
                                                tblcustomers 
                                                LEFT JOIN tblleased 
                                                ON tblcustomers.identity = tblleased.client 
                                                LEFT JOIN tblitems 
                                                ON tblitems.id = tblleased.item_name_id 
                                                where item_name_id != '' and tblleased.company='".$_SESSION['company']."' ";
                                        $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                            if(($row['ldate'])<($row['rdate']) && ($row['ldate'])){
                                                $status = '<p style="color:green">'.'Active'.'</p>';
                                              }
                                              if(($row['ldate'])>($row['rdate'])){
                                                $status = '<p style="color:red">'.'Overdue'.'</p>';
                                              }
                                                echo '
                                            <tr>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td> 
                                                <td>'.ucwords($row['fname']).' '.ucwords($row['lname']).' '.ucwords($row['mname']).'</td>
                                                <td>'.$row['identity'].'</td>
                                                <td>'.ucwords($row['item_name']).'</td>
                                                <td>'.$row['qnty'].'</td>
                                                <td>'.ucwords($row['ldate']).'</td>
                                                <td>'.ucwords($row['rdate']).'</td>
                                                <td>'.ucwords($status).'</td>                                    
                                                </tr>
                                                ';
                                                
                                                include "editlsd.php";
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
              $(function() {
                  $("#table").dataTable({
                     "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
                  });
              });
          </script>        
    </body>
</html>



