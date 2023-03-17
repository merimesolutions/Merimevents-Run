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

$customer_id=$_GET['id'];
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
	<script>
		$(document).ready(function() {
			$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
				localStorage.setItem('activeTab', $(e.target).attr('href'));
			});
			var activeTab = localStorage.getItem('activeTab');
			if (activeTab) {
				$('#myTab a[href="' + activeTab + '"]').tab('show');
			}
		});

	</script>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<?php include('../sidebar-left.php'); ?>

		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header" style="border-style:;border:1px solid #dedede;">
				<a href="javascript:void(0)" title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go Back"></i> Back</a>&nbsp;&nbsp;&nbsp;



				<!--
				<a href="cuEx" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to Excel</a>&nbsp;&nbsp;&nbsp;
				<a href="clprev" title=""><i class="fa fa-print" aria-hidden="true" title="Lease item"></i> Print preview</a>
-->

				<a href="text" style="float:right;color:green;" title=""><i class="fa fa-sms fa-2x" aria-hidden="true" title="Send Message"></i> Send Message</a>


			</section>
			<!-- Main content -->
			<!-- Main content -->
			<section class="content">
				<?php
									
								  $squery = mysqli_query($con, "select * from tblcustomers where company='".$_SESSION['company']."' and  id='$customer_id' ORDER BY id DESC");
							while($row = mysqli_fetch_array($squery)){
							 $state=$row['state'];
								if($state == 0){
									$customer ='Lead';
								}elseif($state == 1){
									$customer ='Client';
								}
									?>
				<!--				<a href="add-item?client=<?php echo $row['identity']; ?>" target="_parent" title="Lease item" class="btn btn-info btn-sm" style="margin-bottom:10px;"> Lease Items</a>&nbsp;&nbsp;&nbsp;-->
				<!--				<a href="quotation-list" title="Quotation list" class="btn btn-success btn-sm" style="margin-bottom:10px;margin-left:20px;"> Quotations</a>-->

				<div class="row m">
					<div class="box">
						<!-- left column -->
						<div class="box-body table-responsive">

							<h4 class="mb-5 mt-2 text-info text-center" style="font-family:fangsong!important; margin-bottom: 50px;"><strong>View <?php echo $row['fname']; ?> <?php echo $row['lname']; ?>'s Information (<?php echo $customer; ?>)</strong></h4>
							<div class="row">
								<div class="col-md-6">

									<input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id" />
									<div class="form-group">

										<label>First Name </label>
										<input name="fname_edit_sy" id="fname_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[a-zA-Z]+" value="<?php echo ucwords($row['fname']); ?>" readonly />
										<br>
										<label>Middle Name </label>
										<input name="mname_edit_sy" id="mname_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="<?php echo ucwords($row['mname']); ?>" readonly />
										<br>
										<label>Last Name </label>
										<input name="lname_edit_sy" id="lname_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="<?php echo ucwords($row['lname']); ?>" readonly />
										<br>
										<label>Gender </label>
										<input name="gender_edit_sy" id="gender_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="<?php echo ucwords($row['gender']); ?>" readonly />
										<br>
										<label>National ID </label>
										<input name="identity_edit_sy" id="identity_edit_sy" class="form-control input-sm" type="text" pattern="[0-9]+" style="width:100%" value="<?php echo $row['identity']; ?>" readonly />
										<br>
										<label>First Contact </label>
										<input name="fcontact_edit_sy" id="fcontact_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="<?php echo $row['fcontact']; ?>" readonly />
										<br>
										<label>Second Contact </label>
										<input name="scontact_edit_sy" id="scontact_edit_sy" class="form-control input-sm" type="text" pattern="[0-9]+" style="width:100%" maxlength="12" value="<?php echo $row['scontact']; ?>" readonly />
										<br>
										<label>Email Address </label>
										<input name="scontact_edit_sy" id="scontact_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="<?php echo $row['email']; ?>" readonly />
										<br>
										<label>Postal Code </label>
										<input name="code_edit_sy" id="code_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[0-9]+" maxlength="12" value="<?php echo $row['code']; ?>" readonly />
										<label>Box No. </label>
										<input name="box_edit_sy" id="box_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[0-9]+" value="<?php echo $row['box']; ?>" readonly />


										<br>
									</div>
								</div>

								<div class="col-md-6">
									<input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id" />
									<div class="form-group">

										<label>Town </label>
										<input name="town_edit_sy" id="town_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[a-zA-Z ]+" value="<?php echo $row['town']; ?>" readonly />

										<br>
										<label>Business / company </label>
										<input name="b_c_name_edit_sy" id="b_c_name_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="<?php echo ucwords($row['b_c_name']); ?>" readonly />

										<br>
										<label>Business / Company Location </label>
										<input name="b_c_location_edit_sy" id="b_c_location_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="<?php echo ucwords($row['b_c_location']); ?>" readonly />
										<br>
										<label>Physical Address </label>
										<div class="form-group">

											<input name="phy_address_edit_sy" id="phy_address_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z0-9 ]+" style="width:100%" value="<?php echo ucwords($row['phy_address']); ?>" readonly />
										</div>

										<br>
										<label>Business Website</label>
										<input type="text" class="form-control" value="<?php echo $row['customer_website']; ?>" readonly>
										<br>
										<label>What the Business does(Industry)</label>
										<div class="form-group">

											<textarea class="form-control" readonly><?php echo $row['customer_industry']; ?></textarea>
										</div>
										<br>
										<label>Additional Information</label>
										<div class="form-group">

											<textarea class="form-control" readonly><?php echo $row['add_info']; ?></textarea>
										</div>

									</div>
								</div>


								<div class="col-md-12">
									<input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id" />

								</div>


								<!-- </div> -->
								<!-- /.box-body -->
							</div><!-- /.box -->


						</div>
					</div>
				</div> <!-- /.row -->
				<?php } ?>
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
