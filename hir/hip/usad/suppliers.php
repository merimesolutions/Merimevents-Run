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
        .sidebar-menu .suppliers{
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

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;

                    <!--a href="plr.php" target="_blank"><img src="../../images/icons/print.png" title="Print projects report" class="icon"></a-->
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#addSupplier"><i class="fa fa-plus" aria-hidden="true"></i> Add supplier</a>
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <!-- <div class="box"> -->
                        <div class="box-body table-responsive">       
                            <form method="post">
                                    <table id="table" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>Email</th>
                                                <th>Location</th>
                                                <th>Goods/ Service description</th>
                                                <th>Date registered</th>
                                                <th style="width:40px">Edit</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $task=0;
                                            $date=date("Y-m-d");
                                            $query  = "SELECT * FROM 
                                                tblsuppliers
                                                where company='".$_SESSION['company']."'
                                                ORDER BY id desc";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 

                                            echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['full_name']).'</td>
                                                <td>'.ucwords($row['contact']).'</td>  
                                                <td>'.$row['email'].'</td>
                                                <td>'.$row['contact'].'</td>
                                                <td>'.$row['description'].'</td>
                                                <td>'.$row['date'].'</td>
                                                <td><center><a data-target="#editsupplier'.$row['id'].'" data-toggle="modal"><img src="../../images/icons/doc_edit.png" title="Edit this record" class="iconb"></a></center></td>
                                               
                                                </tr>
                                                ';
                                                
                                               include "editSupplier.php";
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



