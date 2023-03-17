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

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    
<!-- 
                    <a data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" aria-hidden="true" title="Delete selected item"></i> Delete</a> -->
                  
                </section>
            
                <!-- Main content -->
                <section class="content">
                          <a class="btn btn-success" href="add-quotation-lease" title="Create quotation"><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Create quotation </a>&nbsp;&nbsp;&nbsp;
                    <div class="row">
                        <div class="box">

                        <!-- left column -->
                                <div class="box-body table-responsive">
                                <form method="post">

                            <table id="table" class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>S.N</th>
                                        <th>Qoutation title</th>
                                        <th>Quotation id</th>
                                        <th>Date created</th>
                                        <!--<th>Created by</th> -->
                                        <!-- <th style="width:80px !important;">View</th> -->

                                        <th style="width:80px !important;">Edit</th>
                                        <th style="width:80px !important;">Delete</th>
                                        <th style="width:80px !important;">Generate</th>
                                        <th style="width:80px !important;">Print</th>
                                    </tr>
                                    </thead>
                                   <tbody>
                               <?php
                               $sn = 1;
                               
                               $squery = mysqli_query($con, "SELECT distinct identitty,qoutation_title FROM tblquotation ");
                               while($data = mysqli_fetch_array($squery))                                
                              {
                             echo '<tr>
                                      <td>'.$sn++.'</td>
                                      <td>'.ucwords($data['qoutation_title']).'</td>
                                      <td>'.$data['identitty'].'</td>
                                      <td>'.$data['date_create'].'</td>
                                      <!--td>'.ucwords($data['create_by']).'</td-->
                                     <!--td><a class="" style="cursor: pointer;" onclick="myDel('.$data['item_id'].')"><i class="fa fa-edit"> </i> Edit</a></td-->
                                     <td>
                                      <a class="btn btn-primary btn-sm form-group" style="" href="generate-invoice?id='.$data['identitty'].' " target="_blank"><i class="fas fa-edit"></i>&nbsp;Generate</a></td>
                                      <td>
                                      <td>
                                      <a class="btn btn-primary btn-sm form-group" style="" href="generate-invoice?id='.$data['identitty'].' " target="_blank"><i class="fas fa-delete"></i>&nbsp;Generate</a></td>
                                      <td>
                                     <td>
                                      <a class="btn btn-primary btn-sm form-group" style="" href="generate-invoice?id='.$data['identitty'].' " target="_blank"><i class="fas fa-download"></i>&nbsp;Generate</a></td>
                                      <td>
                                      <a class="btn btn-success btn-sm form-group" style="" href="print-quotation-lease?id='.$data['identitty'].' " target="_blank"><i class="fas fa-print"></i>&nbsp;Print</a></td>
                               </tr>';
                                   
                             
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