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
            $txtPrice = $_POST['txtPrice'];
            $txtCategory = $_POST['txtCategory'];
            $txtBatch = $_POST['txtBatch'];
            $txtSupplier = $_POST['txtSupplier'];
			$supplierName =$_POST['supplierName'];
            $txtReceipt = $_POST['txtReceipt'];
            $served_by=$_SESSION['username'];
            $date=date("Y-m-d");
            $company=$_SESSION['company'];


                foreach($txtItem_name as $key => $value){
                    $save = "INSERT INTO tblitems(item_name,qnty,category,bno,added_by,added_date,company,supplier,receipt,lease_charges)VALUES('".$value."','".$txtQnty[$key]."','".$txtCategory[$key]."','".$txtBatch[$key]."','".$served_by."','".$date."','".$company."','".$supplierName[$key]."','".$txtReceipt[$key]."','".$txtPrice[$key]."' )";
                    $query = mysqli_query($connn, $save);
                
                if($query == true){
                   echo '<script type="text/javascript">'; 
                    echo 'alert("Item added successfully.");'; 
                    echo 'window.location = "ani.php";';
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
<style>
	.sidebar-menu .inventory {
		background-color: #009999;
	}

</style>
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
			<section class="content-header">
				<a href="javascript:void(0)" title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left"></i> Back</a>&nbsp;&nbsp;&nbsp;

				<a href="ai.php"><i class="fa fa-folder-open" aria-hidden="true" title="Available stock"></i> Available Stock</a>

			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- <div class="box"> -->

						<div class="box-body table-responsive">
							<p style="margin-bottom:10px;">Add new stock</p>
							<div class="panel panel-default"><br>
								<form method="post" class="insert=form" id="insert_form" action="">
									<!--div class="panel-heading" >
                                    
                                </div-->
									<!-- /.box-header -->
									<div class="box-body table-responsive">

										<table class="table table-striped" id="table_field">
											<tr>
												<th>Item Code</th>
												<th>Item Name</th>
												<th>Quantity</th>
												<th>Leasing price</th>
												<th>Supplier <br> <span class="mt-3 small"><a class="btn btn-info btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#addSupplier"><i class="fas fa-plus"></i> Add Supplier</a></span></th>
												<th>Receipt No.</th>
												<th>Description</th>
												<th style="width: 20px"></th>
											</tr>
											<tr>
												<td><input type="text" name="txtBatch[]" class="form-control" required></td>
												<td><input type="text" name="txtItem_name[]" class="form-control" required></td>
												<td><input type="text" name="txtQnty[]" class="form-control" required></td>
												<td><input type="text" name="txtPrice[]" class="form-control" required></td>
												<td>
													<select name="txtSupplier[]" class="form-control input-sm">
														<option value="" disabled selected>..Select..</option>
														<?php
                                                $a = mysqli_query($con,"SELECT * from tblsuppliers where company='".$_SESSION['company']."' ");
                                                  while($row=mysqli_fetch_array($a)){
													  $fullname =$row['full_name'];
                                                      echo '<option value="'.$row['id'].'">'.ucwords($row['full_name']).'</option>';
                                                                  }    
                                                    ?>

													</select>
													<input type="hidden" name="supplierName[]" value="<?php echo $fullname; ?>">



												</td>
												<td><input type="text" name="txtReceipt[]" class="form-control"></td>
												<td><input type="text" name="txtCategory[]" class="form-control"></td>
												<td><input type="button" name="add" id="add" value="+" class="btn btn-info"></td>
											</tr>
										</table>
									</div>
									<center><button type="submit" class="btn btn-success" name="save" id="save" title="Save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>&nbsp;&nbsp;&nbsp;
										<button type="reset" class="btn btn-default" title="Reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
									</center><br>
								</form>
							</div>
						</div>
					<!-- </div> -->
					<?php include "../notification.php"; ?>

					<?php include "../addModal.php"; ?>

					<?php include "../addfunction.php"; ?>

				</div> <!-- /.row -->
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
				"aoColumnDefs": [{
					"bSortable": false,
					"aTargets": [0, 5]
				}],
				"aaSorting": []
			});
		});

	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			var html = '<tr><td><input type="text" name="txtBatch[]" class="form-control" required></td><td><input type="text" name="txtItem_name[]" class="form-control" required></td><td><input type="text" name="txtQnty[]" class="form-control" required></td><td><input type="text" name="txtPrice[]" class="form-control" required></td><td><select name="textSupplier[]" class="form-control input-sm" ><option value="" disabled selected>..Select..</option><?php $as = mysqli_query($con,"SELECT * from tblsuppliers where company='".$_SESSION['company']."' "); while($rowz=mysqli_fetch_array($as)){ $fullername=$rowz['full_name']; echo '<option value="'.$rowz['id'].'">'.ucwords($rowz['full_name']).'</option>';  }?></select><input type="hidden" name="supplierName[]" value="<?php echo $fullername; ?>"></td><td><input type="text" name="txtReceipt[]" class="form-control"></td><td><input type="text" name="txtCategory[]" class="form-control"></td><td><input type="button" name="remove" id="remove" value="x" class="btn btn-danger"></tr>';

			var x = 1;

			$("#add").click(function() {
				$("#table_field").append(html);
			});
			$("#table_field").on('click', '#remove', function() {
				$(this).closest('tr').remove();
			});

		});

	</script>
</body>

</html>
