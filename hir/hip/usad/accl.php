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
   .sidebar-menu .accl{
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
                <br>
                
                <section class="content-header"  >
                    &nbsp; <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    
                    <a href="acc.php" title="Go home"><i class="fa fa-plus" aria-hidden="true" title="Add new account"></i> Add User</a>&nbsp;&nbsp;

                    <a data-toggle="modal" data-target="#deleteAcccc" title="Delete"><i class="fa fa-trash" aria-hidden="true" title="Add new account"></i> Delete</a>
                    
                       
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- <div class="row"> -->

                        <!-- left column -->
                            <!-- <div class="box"> -->
                                <form method="post">
                                <div class="box-body table-responsive">
                                    <label>User Accounts</label>
                                    <table id="table" class="table table-borderedless table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delacccc[]" class="cbxMain" onchange="checkMain(this)" />
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th style="width: 20px !important;">Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "select * from tblusers where company='".$_SESSION['company']."' ORDER BY id DESC");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                           $r=$row['role'];
                                           $sq = mysqli_query($con, "select * from tblroles where id='".$r."' ORDER BY id DESC");
                                            while($rows = mysqli_fetch_array($sq))
                                            {     
                                               $role =  $rows['role'];
                                            }
                                                echo '
                                            <tr>
                                        <td><input type="checkbox" name="chk_delacccc[]" class="chk_delete" value="'.$row['id'].'" /></td> 
                                        <td>'.ucwords($row['full_name']).'</td>
                                        <td>'.$row['username'].'</td>
                                        <td>'.ucwords($role).'</td>
                                        <td><center><a href=editacc.php?id='.$row['id'].'><img src="../../images/icons/doc_edit.png" title="" class="iconb"></a></center></td>                              
                                                </tr>
                                                ';
                                                
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>

                                    </form>
                                <!-- </div>/.box-body -->
                            <!-- </div>/.box -->

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
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>