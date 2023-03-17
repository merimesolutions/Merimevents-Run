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
<?php
    $connn = mysqli_connect("localhost","merimeve_event","user@event","merimeve_event");

        if(isset($_POST['save'])){
            $txtItem_name = $_POST['txtItem_name'];
            $txtQnty = $_POST['txtQnty'];
            //$txtQlty = $_POST['txtQlty'];
            $txtCategory = $_POST['txtCategory'];
            $txtBatch = $_POST['txtBatch'];
            $txtSupplier = $_POST['txtSupplier'];
            $txtReceipt = $_POST['txtReceipt'];
            $served_by=$_SESSION['username'];
            $date=date("Y-m-d");
            $company=$_SESSION['company'];


                foreach($txtItem_name as $key => $value){
                    $save = "INSERT INTO tblitems(item_name,qnty,category,bno,added_by,added_date,company,supplier,receipt)VALUES('".$value."','".$txtQnty[$key]."','".$txtCategory[$key]."','".$txtBatch[$key]."','".$served_by."','".$date."','".$company."','".$txtSupplier[$key]."','".$txtReceipt[$key]."' )";
                    $query = mysqli_query($connn, $save);
                
                if($query == true){
                   echo '<script type="text/javascript">'; 
                    echo 'alert("Item added successfully.");'; 
                    echo 'window.location = "ai.php";';
                    echo '</script>';
                    }else{
                     echo '<script type="text/javascript">'; 
                    echo 'alert("NOT added. ITEM CODE field must be unique.");'; 
                    echo 'window.location = "ani.php";';
                    echo '</script>';   
                    }
                }
            }
     ?>
<!DOCTYPE html>
<html>
<style>.sidebar-menu .inventory{
        background-color:#009999;
    }</style>
    <?php include('../head_css.php'); ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>
        <?php include('getroles.php');?>
      
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                     <?php if($an_available_stock==1){?>
                    <a href="ai.php"><i class="fa fa-folder-open" aria-hidden="true" title="Available stock"></i> Available Stock</a>
                    <?php }?>

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="box">

                            <div class="box-body table-responsive"> 
                            <p style="margin-bottom:10px;">Add new stock</p>          
                            <div class="panel panel-default"><br>
                            <form method="post" class="insert=form" id="insert_form" action="">
                                <!--div class="panel-heading" >
                                    
                                </div--><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                  
                                    <table class="table table-striped" id="table_field">
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Supplier</th>
                                            <th>Receipt No.</th>
                                            <th>Description</th>
                                            <th style="width: 20px"></th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="txtBatch[]" class="form-control"></td>
                                            <td><input type="text" name="txtItem_name[]" class="form-control" required></td>
                                            <td><input type="text" name="txtQnty[]" class="form-control" required></td>
                                            <td><input type="text" name="txtSupplier[]" class="form-control"></td>
                                            <td><input type="text" name="txtReceipt[]" class="form-control"></td>
                                            <td><input type="text" name="txtCategory[]" class="form-control"></td>
                                            <td><input type="button" name="add" id="add" value="+" class="btn btn-info"></td>
                                        </tr>
                                    </table>
                                 </div>
                                 <center><button type="submit" class="btn btn-success" name="save" id="save"  title="Save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>&nbsp;&nbsp;&nbsp;
                <button type="reset" class="btn btn-default" title="Reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button></center><br>
                                 </form>
                             </div>
                         </div>
                    </div>
            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <?php include "../addfunction.php"; ?>
                    </div>  
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
                     "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
                  });
              });
          </script> 
 <script type="text/javascript">
        $(document).ready(function(){
            var html = '<tr><td><input type="text" name="txtBatch[]" class="form-control"></td><td><input type="text" name="txtItem_name[]" class="form-control" required></td><td><input type="text" name="txtQnty[]" class="form-control" required></td><td><input type="text" name="txtSupplier[]" class="form-control"></td><td><input type="text" name="txtReceipt[]" class="form-control"></td><td><input type="text" name="txtCategory[]" class="form-control"></td><td><input type="button" name="remove" id="remove" value="x" class="btn btn-danger"></tr>';

            var x = 1;

            $("#add").click(function(){
                $("#table_field").append(html);
            }); 
            $("#table_field").on('click','#remove',function(){
                $(this).closest('tr').remove();
            }); 

        });
    </script>
    </body>
</html>