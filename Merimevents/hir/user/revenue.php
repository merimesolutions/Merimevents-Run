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
                    <a href="db.php" title="Go home"><i class="fa fa-home" aria-hidden="true" title="Go home"></i> Home</a> &nbsp;&nbsp;&nbsp; 
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">

                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:;">
                                        
                                        <table><tr> 

                                        <td><form action="../vehicles/pdf.php" target="_blank" method="POST"> 
                                        <div class="btn" style="background-color: lightgray">
                                        <label style="font-weight: bold;">From: </label>
                                            <input type="datetime-local" required class="input-sm" name="searchdate" id="searchdate" />
                                            
                                        <label style="font-weight: bold;">To: </label>
                                            <input type="datetime-local" required class="input-sm" name="searchdate" id="searchdate" />

                                        <button type="submit" class="btn btn-sm btn-success" name="submit"><i class="fa fa-search" aria-hidden="true"></i>  Search</button>
                                    </div></form></td>

                                        <td><div class="btn">
                                        <a href="pdf.php" target="_blank"><button class="btn btn-success btn-sm"   style="width:120px"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Print All</button>  </a>
                                        </div></td>

                                        <td><div class="btn">
                                        <a href="excel.php" target="_blank" style="padding: 8px; color: white" class="btn btn-info fa fa-file-excel-o"> Export to Excel </a></div></td>

                                    </tr></table>
                                
                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                <th>Items</th>
                                                <th>Total Revenue</th>
                                                <th>Paid Revenue</th>
                                                <th>Unpaid Revenue</th>
                                                <th style="width: 40px !important;">Option</th>             
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
                                    $items=mysqli_query($con,'select * from tblitems WHERE company="'.$_SESSION['company'].'" ');
                                       while($row = mysqli_fetch_array($items))
                                            { 
                                            $id = $row['id'];
                                            
                                         $total=mysqli_query($con,'select sum(qnty*price) as product from tblleased WHERE item_name_id= "'.$id.'" ');
                                            $ttle = mysqli_fetch_array($total);
                                            
                                        $amount=mysqli_query($con,'select sum(amount) as paid from tbltransactions ');
                                        $a = mysqli_fetch_array($amount); 
                                        
                                           $bal =   $ttle['product'];
                                          echo '
                                                <tr>
                                                    <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="" /></td>
                                                    <td>'.$row['item_name'].'</td>
                                                    <td>'.$ttle['product'].'</td>
                                                    <td>'.$a['paid'].'</td>
                                                    <td></td>
                                                    <td></td>
                                                    
                                                    
                                                </tr>
                                              ';
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

            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>