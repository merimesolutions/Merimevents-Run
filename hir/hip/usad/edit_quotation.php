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
 $compp=$_SESSION['company'];
 include "../connection.php";
$event_id=$_GET['id'];
$remyma=mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id' AND quotation_status=1");
if($remyma){
    $numberma =mysqli_num_rows($remyma);
}
// if($numberma > 0){
//     echo '<script>alert("This Quotation has already been approved and can therefore not be edited");window.location="view_event.php?id='."$event_id".'"</script>';
// }
$swei =mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event_id'");
if($swei){
    while($row =mysqli_fetch_assoc($swei)){
        $ename=$row['event_name'];
        $custname=$row['customer_name'];
    }
}
?>
<?php
  if(isset($_POST['s_button']))
  {
      $txt_id = $_POST['txt_hidden'];
      $description = $_POST['description'];
      $quantity = $_POST['quantity'];
      $price = $_POST['price'];
      $days = $_POST['days'];
      $total = $quantity*$price*$days;


      $c_txt_id = $_POST['c_txt_hidden'];
      $c_description = $_POST['c_description'];
      $c_quantity = $_POST['c_quantity'];
      $c_price = $_POST['c_price'];
      $c_total = $c_quantity*$c_price;


         $query = mysqli_query($con,"UPDATE event_quotation SET event_description = '".$description."',event_quantity = '".$quantity."',event_single_price= '".$price."',event_days = '".$days."',total_items = '".$total."' where id = '".$txt_id."' ");

         $qry = mysqli_query($con,"UPDATE additional_costs SET cost_description = '".$c_description."',cost_quantity = '".$c_quantity."',costperunit= '".$c_price."',total_price = '".$c_total."',cost_price = '".$c_total."' where id = '".$c_txt_id."' ");
      

      if($qry == true){
          echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
            exit;
      }

    if(mysqli_error($con)){
      echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
    }
  }
if(isset($_POST['edit_details'])){
	$creation=$_POST['l_date'];
	$expiry=$_POST['expiry_date'];
	$status=$_POST['quotation_status'];
	$upds =mysqli_query($con,"UPDATE event_quotation SET creation_date='$creation', expiry_date='$expiry', quotation_status='$status' WHERE event_id=
	'$event_id'");
	if($upds){
		echo'<script>window.location="edit_quotation?id='."$event_id".'";</script>';
	}
}
?>
<?php
include "../connection.php";
 if(isset($_POST['del_button'])){
 $id=$_POST['del'];
$delete_query = mysqli_query($con,"DELETE from additional_costs where id = '$id' ") or die('Error: ' . mysqli_error($con));
     if($delete_query == true)
              {
                  $_SESSION['delete'] = 1;
                  header("location: ".$_SERVER['REQUEST_URI']);
              }else{
         echo $errom =mysqli_error($con);
         echo '<script>alert("'."$errom".' ");window.location="edit_quotation.php?id='.$event_id.'";</script>';
     }
 }
 if(isset($_POST['del_but'])){
 $idd=$_POST['delete'];
$delete_qry = mysqli_query($con,"DELETE from event_quotation where id = '$idd' ") or die('Error: ' . mysqli_error($con));
     if($delete_qry == true)
              {
                  $_SESSION['delete'] = 1;
                  header("location: ".$_SERVER['REQUEST_URI']);
              }else{
         echo $errom =mysqli_error($con);
         echo '<script>alert("'."$errom".' ");window.location="edit_quotation.php?id='.$event_id.'";</script>';
     }
 }
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--Editable Table CDN-->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<!-------------------------------------------->
<?php include('../head_css.php'); ?>
<style type="text/css">
	.panel:hover {
		background-color: lightblue;

</style>

<body class="skin-black">
	<!-- header logo: style can be found in header.less -->

	<?php include('../header.php'); ?>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<?php include('../sidebar-left.php'); ?>
		<aside class="right-side">
			<section class="content-header">
				<a href="javascript:void(0)" title="Go Back" onclick="goBackk()"><i class="fa fa-angle-double-left"></i> Back</a>&nbsp;&nbsp;&nbsp;
				<!--						<a href="ani.php" title="Add Items "><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Add 
						<!----Item(s) </a>&nbsp;&nbsp;&nbsp;-->

				<a href="view_event?id=<?php echo $event_id; ?>" title="Add new customers"><i class="fas fa-eye" aria-hidden="true" title="Go home"></i>View Quotation</a>&nbsp;&nbsp;&nbsp;

				<a href="add_editevent_quotation?id=<?php echo $event_id; ?>" target="_blank"><i class="fas fa-plus" aria-hidden="true"></i>Add items</a>&nbsp;&nbsp;&nbsp;


			</section>
			<!--=======================================================================================================================-->
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<?php
									$des=mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event_id'");
									while($mes =mysqli_fetch_array($des)){
										$event_namee =$mes['event_name'];
										$cusst_name =$mes['customer_name'];
									}
									?>

						<center>
							<h3 style="font-family:fangsong;"><strong><u><span class="text-info">Event Name: </span><?php echo $event_namee; ?>
									</u></strong> </h3>
							<h3 style="font-family:fangsong;" class="mt-4"><strong><span class="text-info">Customer Name: </span><?php echo $cusst_name; ?>
								</strong> </h3>
						</center>

						<div class="box-body table-responsive">
							<?php
								  $yer=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id' ");
								  while($vila = mysqli_fetch_array($yer)){
									  $cdate =$vila['creation_date'];
									  $edate=$vila['expiry_date'];
									  $qstat=$vila['quotation_status'];
									  $qtype=$vila['quotation_type'];
									  
								  }
								  ?>
							<div class="row">
								<form action="" method="post">
									<div style="margin-top:50px!important; margin-left:30px!important;">
										<div class="col-lg-3 col-sm-6 col-md-3 col-xl-3" style="margin-bottom:10px;">

											<label>Date of quotation creation: </label>
											<input type="text" name="l_date" class="form-control" value="<?php echo $cdate; ?>" onfocus="(this.type='date')">
										</div>
										<div class="col-lg-3  col-sm-6 col-md-3 col-xl-3" style="margin-bottom:10px;">

											<label>Expiry date: </label>
											<input type="text" name="expiry_date" class="form-control" value="<?php echo $edate; ?>" onfocus="(this.type='date')">
										</div>
										<div class="col-lg-3  col-sm-6 col-md-3 col-xl-3" style="margin-bottom:10px;">

											<label>Quotation status:</label>
											<?php
														$vam=explode(',',$qstat);
														?>


											<select name="quotation_status" class="form-control" id="q_status">
												<option value="" disabled selected>Select Status: </option>
												<option value="Pending" <?php echo (in_array("Pending", $vam)?'selected':''); ?>>Pending</option>
												<option value="Approved" <?php echo (in_array("Approved", $vam)?'selected':''); ?>>Approved</option>
												<option value="Rejected" <?php echo (in_array("Rejected", $vam)?'selected':''); ?>>Rejected</option>


											</select>


										</div>
										<input type="hidden" name="event_id" id="event_id" value="<?php echo $event_id; ?>">
										<div class="col-lg-3  col-sm-6 col-md-3 col-xl-3" style="margin-bottom:10px;">
											<label>Update:</label>

											<button type="submit" class="btn btn-sm btn-info form-control" name="edit_details"> Edit</button>
										</div>
									</div>
								</form>
							</div>

							<form method="post">
								<table class="table  table-striped">
									<span><a href="add_editevent_quotation.php?id=<?php echo $event_id; ?>" style="margin-top:50px!important;" class="btn btn-info btn-sm">Add more items</a></span>

									<thead>
										<tr>
											<th style="width: 20px !important;"><i class="fa fa-list"></i></th>
											<th>Item</th>
											<th>Item Description</th>
											<th>Quantity</th>
											<th>Price/Day</th>
											<th>No of Days</th>
											<th>Total (items)</th>
											<th>Delete</th>


											<!--<th style="width:40px">Edit</th>-->
											<!--<th style="width:40px">View</th>-->
										</tr>
									</thead>
									<tbody>
										<?php
                                            $c=1;
                                            $task=0;
                                            $date=date("Y-m-d");
                                            $sqwe =mysqli_query($con,"SELECT SUM(total_items) AS total FROM event_quotation WHERE event_id='$event_id'");
                                                         while($remmy =mysqli_fetch_assoc($sqwe)){
                                                              $total_items_cost=$remmy['total'];
                                                         }
                                            $query  = "SELECT * FROM event_quotation WHERE event_id='$event_id'";
                                            $result = mysqli_query($con, $query);
                                                while ($rowz = mysqli_fetch_array($result))
                                                  { 
                                                    //   $event_id = $row['id'];
                                                    //   $event_name=$row['event_name'];
                                                    //   $cust_name=$row['customer_name'];
                                                    $total_items =$rowz['total_items'];
                                                    $quote_item=$rowz['id'];
                                                    $item_id =$rowz['event_item'];
                                                    $sqq =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$item_id'");
                                                    while($data = mysqli_fetch_array($sqq)){
                                                        $item_name = $data['item_name'];
                                                    }
                                               

                                                  
                                           ?>
										<tr>
											<td><?php echo $c++;?></td>
											<td><input name="txt_hidden" type="hidden" class="form-control" value="<?php echo $quote_item;?>">
												<input type="text" class="form-control" value="<?php echo $item_name;?>" readonly>
											</td>

											<td><input name="description" type="text" class="form-control" value="<?php echo $rowz['event_description'];?>"></td>
											<td><input name="quantity" type="text" class="form-control" value="<?php echo $rowz['event_quantity']; ?>"></td>
											<td><input name="price" type="text" class="form-control" value="<?php echo $rowz['event_single_price']; ?>"></td>
											<td><input name="days" type="text" class="form-control" value="<?php echo $rowz['event_days']; ?>"></td>
											<td><input style="text-align: right;" type="text" class="form-control" value="<?php echo number_format($rowz['total_items'],1);?>" readonly></td>

											<td>
												<form method="post" action="">
													<input type="hidden" name="delete" value="<?php echo $quote_item; ?>" />
													<button name="del_but" id="del_but" type="submit" class="btn btn-danger">Delete</button>
												</form>
											</td>

										</tr>
										<?php 
                                            }
                                              $sqw =mysqli_query($con,"SELECT SUM(cost_price) AS total FROM additional_costs WHERE event_id='$event_id'");
                                                         while($remmy =mysqli_fetch_assoc($sqw)){
                                                              $total_add_costs=$remmy['total'];
                                                         }
                                        
                                                     $rem=mysqli_query($con,"SELECT * FROM additional_costs WHERE event_id='$event_id'");
                                                     if($rem){
                                                        
                                                         
                                                         while($roml =mysqli_fetch_assoc($rem)){
                                                          $quote_i=$roml['id'];
                                                            $cost_name=$roml['cost_name'];
                                                            $cost_price=$roml['cost_price']; 
                                                            $overall_total =$total_add_costs + $total_items_cost;
                                                             ?>
										<tr>
											<td><?php echo $c++; ?></td>
											<td><input name="c_txt_hidden" type="hidden" class="form-control" value="<?php echo $quote_i;?>">
												<input type="text" class="form-control" name="cost_name" value="<?php echo $cost_name;?>" readonly>
											</td>

											<td><input name="c_description" type="text" class="form-control" value="<?php echo $roml['cost_description'];?>"></td>

											<td><input name="c_quantity" type="text" class="form-control" value="<?php echo $roml['cost_quantity'];?>"></td>

											<td><input name="c_price" type="text" class="form-control" value="<?php echo $roml['costperunit'];?>"></td>

											<td><input type="text" class="form-control" value="-"></td>

											<td><input style="text-align: right;" type="text" class="form-control" name="cost_price" value="<?php echo number_format($cost_price,1); ?>" readonly></td>


											<td>
												<form method="post" action="">
													<input type="hidden" name="del" value="<?php echo $quote_i; ?>" />
													<button name="del_button" id="del_button" type="submit" class="btn btn-danger">Delete</button>
												</form>
											</td>

										</tr>


										<?php }}?>


										<tr>
											<td>Total</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td><input style="text-align: right;" type="text" class="form-control" value="<?php echo number_format($overall_total,1); ?>" readonly></td>

											<td><button type="submit" name="s_button" class="btn btn-info">Save</button></td>
										</tr>




									</tbody>
								</table>


								<!--?php include "../deleteModal.php"; ?-->

							</form>





							<?php include "../notification.php"; ?>



						</div>
					</div>
				</div>
			</div>
			<!--End of container fluid-->
		</aside>
	</div>
	<?php include "../footer.php"; ?>
	<script type="text/javascript">
		function goBackk() {
			window.history.back();
		}

	</script>
</body>
