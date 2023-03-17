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
        .sidebar-menu .ocr{
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
               <!--get roles in the files-->
            <?php include("getroles.php");?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    <?php if($l_add_new_customer==1){?>
                    <a href="c" title="Add new customers"><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Add new customers</a>&nbsp;&nbsp;&nbsp;
                     <?php } if($l_customer_list==1){?>
                    <a href="cl" title="Customers list"><i class="fa fa-list" aria-hidden="true" title="Customers list"></i> Customers list</a>&nbsp;&nbsp;&nbsp;
                    <?php }if($l_invoice==1){?>
                    <a href="ilp" title="Invoices"><i class="fa fa-folder-open" aria-hidden="true" title="Go home"></i> Invoices </a>&nbsp;&nbsp;&nbsp;
                     <?php } if($l_leased_items_report){?>
                    <a href="lai" title="Leased Items report "><i class="fa fa-folder-open" aria-hidden="true" title="Go home"></i> Leased Items report </a>&nbsp;&nbsp;&nbsp;
                      <?php } if($l_delete){?>
                    <a data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" aria-hidden="true" title="Delete selected item"></i> Delete</a>
                     <?php }?>
                </section>
                <?php if($l_lease ==1){?>
                <a href="add.php" title="Lease item" class="btn btn-info btn-sm" style="margin-top:10px;margin-left:20px;">  Lease Items</a>
                <?php }?>
                <!-- Main content -->
                <section class="content">
                           <!---->
                    <div class="row">

                        <!-- left column -->
                                <div class="box-body table-responsive">
                                <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" />
                                                <th style="width: 100px !important;">ID N<sub>o</sub></th>
                                                <th>Customer Name</th>
                                                <!--<th>Gender</th>-->
                                                <th>Business / Company</th>
                                                <th>Contact</th>
                                                <?php if($l_lease==1){
                                                echo '<th style="width: 20px !important;">Lease</th>';
                                                }?>
                                                <!--th style="width: 20px !important;">Print</th-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                          
                                            $squery = mysqli_query($con, "select * from tblcustomers where company='".$_SESSION['company']."' ORDER BY id DESC");
                                            
                                            while($row = mysqli_fetch_array($squery))
                                            { 
                    
                                                //<td><a href=add?client='.$row['identity'].' target="_parent">'.ucwords($row['gender']).'</a></td>
                                                echo '
                                            <tr>
                                                <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td> 
                                                <td><a href=add?client='.$row['identity'].' target="_parent">'.$row['identity'].'</a></td>
                                                <td><a href=add?client='.$row['identity'].' target="_parent">'.ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']).'</a></td>
                                                
                                                <td><a href=add?client='.$row['identity'].' target="_parent">'.ucwords($row['b_c_name']).'</a></td>   
                                                <td><a href=add?client='.$row['identity'].' target="_parent">'.ucwords($row['fcontact']).'</a></td> ';
                                                if($l_lease==1){
                                                echo '<td><a class="btn btn-info" href=add?client='.$row['identity'].' target="_parent">Lease</a></td>';
                                                }
                                                echo '
                                                <!--td><center><a href=../reports/ocrr?cus='.$row['id'].' target="_blank"><img src="../../images/icons/printer.png" title="Print this record" class="iconb"></a></center></td-->                                 
                                                </tr>
                                                
                                                ';
                                               
                                                
                                                include "editModal.php";
                                            }
                                            
                                        
                                             
                                               
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

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