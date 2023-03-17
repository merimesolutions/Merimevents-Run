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
	.icon {
		width: 30px;
		padding-right: 10px;
	}

	.iconb {
		width: 30px;
		padding-right: 10px;
	}

	.icon:hover {
		transition: 0.3s;
		/*box-shadow: 2px 0px 20px rgba(0, 0, 0, 0.8);*/
	}

	.sidebar-menu .cl {
		background-color: #009999;
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
				<a href="javascript:void(0)" title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go Back"></i> Back</a>&nbsp;&nbsp;&nbsp;

				<a href="c" title="Add new customers"><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Add new customers</a>&nbsp;&nbsp;&nbsp;

				<a href="cuEx" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to Excel</a>&nbsp;&nbsp;&nbsp;
				<a href="clprev" title=""><i class="fa fa-print" aria-hidden="true" title="Lease item"></i> Print preview</a>

			</section>
			<!-- Main content -->
			<section class="content">
				<a href="add-item" title="Lease item" class="btn btn-info btn-sm" style="margin-bottom:10px;"> Lease Items</a>
				<div class="row">
					<div class="box">
						<!-- left column -->
						<div class="box-body table-responsive">
							<p>Registered Customers</p>
							<form method="post">
								<?php echo $msger; ?>
								<table id="table" class="table table-striped">
									<thead>
										<tr>
											<th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" />
											<th style="width: 100px !important;">ID N<sub>o</sub></th>
											<th>Customer Name</th>
											<!--<th>Gender</th>-->
											<!--th>Business / Company</th-->
											<th>Contact</th>

											<th>View / Edit Customer</th>
											<th>Delete</th>
											<!--th style="width: 20px !important;">Print</th-->
										</tr>
									</thead>
									<tbody>
										<?php
                                            $c=1;
                                            $squery = mysqli_query($con, "select * from tblcustomers where company='".$_SESSION['company']."' ORDER BY id DESC");
                                            while($row = mysqli_fetch_array($squery))
                                            {  
												$customer_id = $row['id'];
                                                //<td>'.ucwords($row['gender']).'</td>
                                                echo '
                                            <tr>
                                                <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td> 
                                                <td>'.$row['identity'].'</td>
                                                <td>'.ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']).'</td>
                                               
                                                <!--td>'.ucwords($row['b_c_name']).'</td-->   
                                                <td>'.ucwords($row['fcontact']).'</td> 
												
                                      
                                                <td><a data-target="#editModal'.$row['id'].'" data-toggle="modal"><img src="../../images/icons/edit.png" title="Edit this record" class="iconb"></a></td> 
                                                <!--td><center><a href=../reports/ocrr?cus='.$row['id'].' target="_blank"><img src="../../images/icons/printer.png" title="Print this record" class="iconb"></a></center></td-->  
												
												
												
                                                ';?>
										<td><a onclick="return confirm('Are you sure you want to delete this customer?')" class="btn btn-danger" href="delete_customer.php?id=<?php echo $customer_id; ?>"><i class="fas fa-trash"></i></a></td>
										<?php
												
												
											
											
                                               '</tr>';
                                              	
                                              
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

					<!--?php include " ../addfunction.php"; ?-->
					<?php include "editfunction.php"; ?>
					<?php include "deletefunction.php"; ?>


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
					"aTargets": [0, 2]
				}],
				"aaSorting": []
			});
		});

	</script>
</body>

</html>
