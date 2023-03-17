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
    include "../connection.php";
$event_id=$_GET['id'];

 // $sql=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
 // if($sql){
 //     $number_of_rows= mysqli_num_rows($sql);
 // }
 //     if($number_of_rows > 0){
 //         echo '<script>window.location="view_event.php?id='."$event_id".'";</script>';
     
 // }
if(isset($_POST['submit_add'])){
	 
        //Additional Costs
        $creation_date=$_POST['l_date'];
	    $expiry_date=$_POST['expiry_date'];
	    $quotation_status=$_POST['quotation_status'];
        $cost_name =$_POST['costName'];
        $cost_description=$_POST['costDescription'];
        $cost_unit_price=$_POST['costPrice'];
        $company=$_SESSION['company'];
//		$fmer=mysqli_query($con,"INSERT INTO event_quotation (event_id,quotation_type,quotation_status,creation_date,expiry_date) VALUES ('$event_id','Internal','$quotation_status','$creation_date','$expiry_date')");
//	   if(!$fmer){
//		 $errorzz=mysqli_error($con);
//					echo'<script>alert("Error: '."$errorzz".'");</script>';
//	   }

        foreach($cost_name as $key2 => $value2){
            if(!empty($_POST['costQuantity'][$key2])){
             $cost_quantity=$_POST['costQuantity'];
             $supplier=$_POST['costSupplier'];
              $total_price =(int)$cost_quantity[$key2] * (int)$cost_unit_price[$key2];
              $total=$total_price;
              }elseif(empty($_POST['costQuantity'][$key2])){
             
              $total_price = 1 * (int)$cost_unit_price[$key2];
              $total=$total_price;
              }
		
                $sqme =mysqli_query($con,"INSERT INTO additional_costs(event_id,cost_name,cost_description,cost_quantity,cost_price,company,costperunit,total_price,supplier,quotation_type,quotation_status,creation_date,expiry_date) VALUES ('$event_id','$value2','$cost_description[$key2]','$cost_quantity[$key2]','$total_price','$company','$cost_unit_price[$key2]','$total','$supplier[$key2]','External','$quotation_status','$creation_date','$expiry_date')");
                
                if(!$sqme){
                    $error=mysqli_error($con);
					echo'<script>alert("Error: '."$error".'");</script>';
				}
            }
            if($sqme && $fmer ){
                 echo'<script>window.location="add_editevent_quotation?id='."$event_id".'";</script>';
             }
}
  ?>
<!--?php
  if(isset($_POST['generate']))
  { 
    $client = $_GET['client'];
      $invoice = $_POST['invoice'] ;

      $query = mysqli_query($con,"UPDATE tblleased SET invoice = '".$invoice."',random = '".$invoice."'  where client = '".$client."' and invoice IS NULL ");
      
      if($query == true){
          echo '<script type="text/javascript">'; 
            echo 'alert("Invoice generated successfully.");'; 
            echo 'window.location = "ilp.php";';
            echo '</script>';
      }
    if(mysqli_error($con)){
      echo '<script type="text/javascript">'; 
            echo 'alert("Error occured.");'; 
            echo 'window.location = "add-item.php";';
            echo '</script>';
    }
  }
?-->

<!DOCTYPE html>
<html>

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

	button .save {
		background-color: green;
	}

	.button {
		width: 40px;
	}

	.top-wrapper {
		/* background-color: black;
            padding: 0 5px 5px 5px;
            border-radius: 5px;*/
	}

	.sidebar-menu .active {
		background-color: #009999;
	}

	#myAdd {
		display: none;
	}

</style>
<script type="text/javascript">
	function myFunction() {
		var x = document.getElementById("myAdd");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}

</script>

<?php include('../head_css.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

<script>
	$(document).ready(function() {
		$('select').selectize({
			sortField: 'text'
		});
	});

</script>

<body class="skin-black">
	<?php include('../header.php'); ?>
	<?php
                function RandomString($length) {
                    $keys = array_merge(range(0,9));
                        $key = "";
                        for($i=0; $i < $length; $i++) {
                        $key .= $keys[mt_rand(0, count($keys) - 1)];
                    }
                        return $key;               
                }
            ?>

	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<?php include('../sidebar-left.php'); ?>

		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<a href="javascript:void(0)" title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left"></i> Back</a>&nbsp;&nbsp;&nbsp;


				<a href="view_event?id=<?php echo $event_id; ?>" title="Add new customers"><i class="fas fa-eye" aria-hidden="true" title="Go home"></i>View Quotation</a>&nbsp;&nbsp;&nbsp;

				<a href="edit_quotation?id=<?php echo $event_id; ?>" target="_blank"><i class="fas fa-plus" aria-hidden="true"></i>Edit items</a>&nbsp;&nbsp;&nbsp;


			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<p id="msg" style="color: red; font-weight: bold;"></p>
					<!-- left column -->
					<div class="box">
						<div class="box-body">
							<form method="post">
								<div class="row">
									<?php
								  $yer=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id' ");
								  while($vila = mysqli_fetch_array($yer)){
									  $cdate =$vila['creation_date'];
									  $edate=$vila['expiry_date'];
									  $qstat=$vila['quotation_status'];
									  $qtype=$vila['quotation_type'];
									  
								  }
								  ?>
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

									<div style="margin-top:50px!important; margin-left:30px!important;">
										<div class="col-lg-3 col-sm-6 col-md-3 col-xl-3" style="margin-bottom:10px;">

											<label>Date of creation: </label>
											<input type="text" name="l_date" class="form-control" value="<?php echo $cdate; ?>" Readonly>
										</div>
										<div class="col-lg-3  col-sm-6 col-md-3 col-xl-3" style="margin-bottom:10px;">

											<label>Expiry date: </label>
											<input type="text" name="expiry_date" class="form-control" value="<?php echo $edate; ?>" Readonly>
										</div>
										<div class="col-lg-3  col-sm-6 col-md-3 col-xl-3" style="margin-bottom:10px;">

											<label>Quotation status:</label>
											<input type="text" name="quotation_status" class="form-control" value="<?php echo $qstat; ?>" Readonly>
											<!--
																	<select name="quotation_status" class="form-control" id="q_status" Required>
																		<option value="" disabled selected>Select Status: </option>
																		<option value="Pending" selected>Pending</option>
																		<option value="Approved">Approved</option>
																		<option value="Rejected">Rejected</option>


																	</select>
-->

										</div>
										<input type="hidden" name="event_id" id="event_id" value="<?php echo $event_id; ?>">
									</div>
								</div>


								<!--?php include "../deleteModal.php"; ?-->

							</form>
							<table class="table  table-bordered">
								<center>
									<h4 style="font-family:fangsong"><u><strong>Cost of Items</strong></u></h4>
								</center>

								<thead>
									<tr>
										<th style="width: 20px !important;">No.</th>
										<th>Item</th>
										<th>Item Description</th>
										<th>Quantity</th>
										<th>Price per day</th>
										<th>No of Days</th>
										<th style="text-align:right;">Total (items)</th>
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
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                    //   $event_id = $row['id'];
                                                    //   $event_name=$row['event_name'];
                                                    //   $cust_name=$row['customer_name'];
                                                    $total_items =$row['total_items'];
                                                    $item_id =$row['event_item'];
                                                    $sqq =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$item_id'");
                                                    while($data = mysqli_fetch_array($sqq)){
                                                        $item_name = $data['item_name'];
                                                    }
                                                    
													//Only display this if it's an Internal Quotation
													if($qtype !=='External'){
                                                    
                                            echo '
											
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($item_name).'</td>
                                                <td>'.ucwords($row['event_description']).'</td>  
                                                <td>'.ucwords($row['event_quantity']).'</td>
                                                <td>'.ucwords($row['event_single_price']).'</td>
                                                <td>'.ucwords($row['event_days']).'</td>
                                                <td style="text-align:right;">'.number_format($row['total_items'],2).'</td>                                 
                                                </tr>
												
												
												
												';
                                            }}
								  //Check additional costs
								  $addi =mysqli_query($con,"SELECT * FROM additional_costs WHERE event_id ='$event_id'");
													if($addi){
														$reb = mysqli_num_rows($addi);
													}
								  if(($qtype!=='External') && ($reb > 0))
								  {
								  echo' <tr style="background-color: lightgrey;color: #000;">
                                            
                                                <td colspan="8" style="text-align: center;font-weight: bold;">Additional costs</td> 
                                               
                                                                                  
                                                </tr>';}
								  
                                        $sqw =mysqli_query($con,"SELECT SUM(total_price) AS total FROM additional_costs WHERE event_id='$event_id'");
                                                         while($remmy =mysqli_fetch_assoc($sqw)){
                                                              $total_add_costs=$remmy['total'];
                                                         }
                                        
                                                     $rem=mysqli_query($con,"SELECT * FROM additional_costs WHERE event_id='$event_id'");
                                                     if($rem){
                                                         while($row =mysqli_fetch_assoc($rem)){
                                                           
                                                             if(!empty($row['cost_quantity'])){
                                                                   $quan_quantity =$row['cost_quantity'];
                                                                   $total_price =$row['cost_price'];
                                                             }else{
                                                                 $quan_quantity="NILL";
                                                                 $total_price =$row['costperunit'];
                                                             }
                                                             
                                              
												echo'			 
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['cost_name']).'</td>
                                                <td>'.ucwords($row['cost_description']).'</td>  
                                                <td>'.$quan_quantity.'</td>
                                                <td>'.$row['costperunit'].'</td>
                                                <td>Nill</td>
                                                <td style="text-align:right;">'.number_format($total_price,2).'</td>                                 
                                                </tr>
                                                ';
                                                // include "addquote.php";
                                               
                                               
                                            }
                                            $overall_total =$total_add_costs + $total_items_cost;
                                             echo'
                                            <tr style="background-color: lightgrey;color: #000;">
                                            
                                                <td colspan="6" style="text-align: right;font-weight: bold;">Total</td> 
                                                <td colspan="2" style="text-align:right;">'.number_format( $overall_total,2).'</td>  

                                                                                  
                                                </tr>
                                            ';
                                            } 
                                            ?>

								</tbody>
							</table>

							<div class="row">
								<div class="col-lg-12">
									<center>
										<h4 style="font-family:fangsong!important;" class="text-center" style="margin-top:20px!important;"><strong><u>Add More items to the Quotation</u></strong></h4>
									</center>
								</div>
							</div>



							<div id="customer_details"></div>
							<h5 style="font-family:fangsong!important;"><strong>Select item below:</strong></h5>
							<div class="row">
								<div class="col-lg-10">
									<form method="post">

										<select name="users" onchange="showUser(this.value)" class="form-control input-sm" style="background: linear-gradient(to right, #00ffff 0%, #66ccff 100%);">

											<option value="">Click here to select item</option>
											<?php
                                      $a = mysqli_query($con,"SELECT * from tblitems where qnty>0 and company='".$_SESSION['company']."' order by item_name");
                                        while($row=mysqli_fetch_array($a)){
                                            echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).'</option>';
                                                                                            }    
                                          ?>
										</select>
										<!--Creation date,Expiry date and Quotation status-->
										<input type="hidden" name="l_date" value="<?php echo $cdate; ?>">
										<input type="hidden" name="expiry_date" value="<?php echo $edate; ?>">
										<input type="hidden" name="quotation_status" value="<?php echo $qstat; ?>">
									</form>
								</div>
								<div class="col-lg-2">
									<button class="btn btn-sm btn-info" role="button" data-toggle="modal" data-target="#myModalzz"><i class="fa fa-plus"></i> Add other costs</button>
								</div>
							</div>
							<br>
							<div id="txtHint"></div>
							<br><br>

							<!-- additional items -->

							<!----Modal to add additional costs-------->
							<div class="modal fade" id="myModalzz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" style="color:teal; font-weight:bold;">
												<center>Additional costs</center>
											</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="" method="post">
												<table class="table table-striped" id="table_field32">
													<tr>
														<th>Additional Item/Service</th>
														<th>Description</th>
														<th>Quantity</th>
														<th>Unit Price</th>
														<th colspan="2">Supplier</th>

													</tr>
													<tr>
														<td><input type="hidden" name="event_id" class="form-control" value="<?php echo $_GET['id'];?>">
															<!--Creation date,Expiry date and Quotation status-->
															<input type="hidden" name="l_date" value="<?php echo $cdate; ?>">
															<input type="hidden" name="expiry_date" value="<?php echo $edate; ?>">
															<input type="hidden" name="quotation_status" value="<?php echo $qstat; ?>">



															<!---------------------------------------------------------->
															<input type="text" name="costName[]" class="form-control" required>
														</td>
														<td><input type="text" name="costDescription[]" value="Nill" class="form-control"></td>
														<td><input type="text" name="costQuantity[]" value="1" class="form-control" required></td>
														<td><input type="text" name="costPrice[]" class="form-control" required></td>
														<td>
															<select name="costSupplier[]" class="form-control input-sm">
																<option value="" disabled selected>..Select..</option>
																<?php
                                                $a = mysqli_query($con,"SELECT * from tblsuppliers where company='".$_SESSION['company']."' ");
                                                  while($row=mysqli_fetch_array($a)){
                                                      echo '<option value="'.$row['id'].'">'.ucwords($row['full_name']).'</option>';
                                                                  }    
                                                    ?>
															</select>
														</td>
														<td style="width: 10px"><input type="button" name="add" id="add4" value="+" class="btn btn-warning"></td>
													</tr>
												</table>
												<center><button type="submit" title="Lease item" class="btn btn-success btn-sm" style="margin-top:10px;margin-left:20px; width:150px;" name="submit_add"> Save</button> </center>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!----------------------------------------------------------------------------------------------------------------------------------------->
							<!-- end of additional items -->
							<br><br><br>

							<div id="table-container"></div>
						</div>
					</div>
				</div>
			</section>
		</aside>
	</div>
	<?php 
        include "../footer.php"; ?>
	<script type="text/javascript">
		$(document).ready(function() {
			var html = '<tr><td><input type="hidden" name="event_id" class="form-control" value="<?php echo $_GET['id'];?>"><input type="text" name="costName[]" class="form-control" required></td><td><input type="text" name="costDescription[]" value="Nill" class="form-control"></td><td><input type="number" name="costQuantity[]" class="form-control" value="1" ></td></td><td><input type="number" name="costPrice[]" class="form-control" required></td><td><select name="costSupplier[]" class="form-control input-sm" ><option value="" disabled selected>..Select..</option> <?php $a = mysqli_query($con,"SELECT * from tblsuppliers where company='".$_SESSION['company']."' "); while($row=mysqli_fetch_array($a)){echo '<option  value="'.$row['id'].'">'.ucwords($row['full_name']).'</option>'; } ?></select> </td> <td style = "width: 10px"> <input type = "button" name = "remove" id= "remove" value = "x" class = "btn btn-danger" > </td></tr> ';
			var x = 1;
			$("#add4").click(function() {
				$("#table_field32").append(html);
			});
			$("#table_field32").on('click', '#remove', function() {
				$(this).closest('tr').remove();
			});

		});


		//get data
		function showUser(str) {
			if (str == "") {
				document.getElementById("txtHint").innerHTML = "";
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				var event_id = '<?php echo $_GET["id"];?>';

				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "get-item-quote-edit.php?q=" + str + "&c=" + event_id, true);
				xmlhttp.send();
			}
		}

		//additional cost
		function loadDoc() {
			var xhttp = new XMLHttpRequest();
			var event_id = '<?php echo $_GET["id"];?>';
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					document.getElementById("txtHint").innerHTML = xhttp.responseText;
				}
			};
			xhttp.open("GET", "get-additional.php?event_id=" + event_id, true);
			xhttp.send();
		}
		//back function
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
		//get the user id and put it somewhere
		function get_data() {
			var shownVal = document.getElementById("data1").value;

			var value2send = document.querySelector("#cust option[value='" + shownVal + "']").dataset.value;
			var id = document.getElementById('id_yake').value = value2send;
			alert('My name is :' + value2send);
		}
		//some crazy idea
		var event_id = '<?php echo $_GET["id"];?>';
		var refInterval = window.setInterval('update()', 200); //  seconds
		var update = function() {
			$(document).on('click', '#showData', function(e) {
				$.ajax({
					type: "GET",
					url: "showall-quote.php",
					dataType: "html",
					data: {
						'event_id': event_id
					},
					success: function(data) {
						$("#table-container").html(data);
					}
				});
			});
		}
		update()

		//additional items
		var event_id = '<?php echo $_GET["id"];?>';
		var refInterval = window.setInterval('update()', 200); //  seconds
		var update = function() {
			$(document).on('click', '#showAdd', function(e) {
				$.ajax({
					type: "GET",
					url: "showall-quote.php",
					dataType: "html",
					data: {
						'event_id': event_id
					},
					success: function(data) {
						$("#table-container").html(data);
					}
				});
			});
		}
		update()

	</script>
	<script type="text/javascript">
		$(document).on('submit', '#userForm', function(e) {
			e.preventDefault();

			$.ajax({
				method: "POST",
				url: "php-script-quote-edit.php",
				data: $(this).serialize(),
				success: function(data) {
					$('#msg').html(data);
					$('#userForm').find('input').val('')

				}
			});
		});

	</script>

	<script type="text/javascript">
		$(document).on('submit', '#insert', function(e) {
			e.preventDefault();

			$.ajax({
				method: "POST",
				url: "php-script-additional.php",
				data: $(this).serialize(),
				success: function(data) {
					$('#msg').html(data);
					document.getElementById('myAdd').style.display = 'none';
					// $('#insert').find('input').val('')


					//some crazy idea
					var event_id = '<?php echo $_GET["id"];?>';
					var refInterval = window.setInterval('update()', 200); //  seconds
					var update = function() {
						$(document).on('click', '#showData', function(e) {
							$.ajax({
								type: "GET",
								url: "showall-quote.php",
								dataType: "html",
								data: {
									'event_id': event_id
								},
								success: function(data) {
									$("#table-container").html(data);
								}
							});
						});
					}
					update()

				}
			});
		});

	</script>

	<script type="text/javascript">
		function myDel(fid) {
			var rmvfile = fid;
			if (confirm("Are you sure you want to Delete the file?") == true) {
				if (fid != '') {
					$.ajax({
						type: 'POST',
						url: 'delete_file.php',
						data: {
							rmvfile: rmvfile
						},
						success: function(msg) {
							var refInterval = window.setInterval('update()', 100); //  seconds
							var update = function() {
								$(document).on('click', '#showData', function(e) {
									$.ajax({
										type: "GET",
										url: "showall.php",
										dataType: "html",
										success: function(data) {
											$("#table-container").html(data);
										}
									});
								});
							}
							update()
						}
					});
				}
			}
		}

	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			var html = '<tr><td><input type="hidden" name="event_id" class="form-control" value="<?php echo $_GET['id'];?>"><input type="text" name="costName[]" class="form-control" required></td><td><input type="text" name="costDescription[]" value="Nill" class="form-control"></td><td><input type="text" name="costQuantity[]" class="form-control" ></td></td><td><input type="number" name="costPrice[]" class="form-control" required></td><td><select name="costSupplier[]" class="form-control input-sm" ><option value="" disabled selected>..Select..</option> <?php
                                                $a = mysqli_query($con,"SELECT * from tblsuppliers where company='".$_SESSION['company']."' ");
                                                  while($row=mysqli_fetch_array($a)){
                                                      echo '<option value="'.$row['id'].'">'.ucwords($row['full_name']).'</option>';
                                                                  }    
                                                    ?> < /
			select > < /td > < td style = "width: 10px" > < input type = "button"
			name = "remove"
			id = "remove"
			value = "x"
			class = "btn btn-danger" > < /td></tr > ';

			var x = 1;

			$("#add2").click(function() {
				$("#table_field2").append(html);
			});
			$("#table_field2").on('click', '#remove', function() {
				$(this).closest('tr').remove();
			});

		});

	</script>

</body>

</html>
