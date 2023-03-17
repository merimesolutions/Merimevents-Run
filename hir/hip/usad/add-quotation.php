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
//Get event name
$rdx=mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event_id'");
while($som =mysqli_fetch_array($rdx)){
		 $event_namex =$som['event_name'];
	 }


 $sql=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
 if($sql){
     $number_of_rows= mysqli_num_rows($sql);
	 
 }
     if($number_of_rows > 0){
         echo '<script>window.location="view_event.php?id='."$event_id".'";</script>';
     
 }
if(isset($_POST['submitformz'])){
	$creation_date = $_POST['l_date'];
	$expiration_date =$_POST['expiration_date'];
	$quot_status =$_POST['quotation_status'];
	$queryy=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
if($queryy){
	$no_rowsz=mysqli_num_rows($queryy);
	if($no_rowsz < 1){
		echo '<script>alert("Select items from Inventory!");window.location="add-quotation?id='."$event_id".'";</script>';
	}else{
	$sqll=mysqli_query($con,"UPDATE event_quotation SET creation_date='$creation_date' AND expiry_date='$expiration_date' AND quotation_status='$quot_status' WHERE event_id='$event_id' ");
	if($sqll){
		echo '<script>window.location="view_event?id='."$event_id".' ";</script>';
	}else{
		$resno =mysqli_error($con);
		echo '<script>alert("Error: '."$resno".'");</script>';
	}	
	}

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

				<a href="ani.php" title="Add Items "><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Add Item(s) </a>&nbsp;&nbsp;&nbsp;

			</section>

			<!-- Main content -->

			<section class="content">
				<div class="row">
					<p id="msg" style="color: red; font-weight: bold;"></p>
					<!-- left column -->
					<div class="box">
						<div class="box-body">




							<div id="customer_details"></div>

							<div class="row">

								<form method="post">
									<div class="row">
										<div class="col-lg-12" style="margin-bottom:40px!important;">
											<center>
												<u>
													<h3 style="font-family:fangsong!important;" class="text-primary"><strong>Create quotation for <?php echo $event_namex; ?></strong></h3>
												</u>
												<h5 class="text-center"><strong><em>(Items from the inventory + Additional costs if need be)</em></strong></h5>
											</center>
										</div>


									</div>


									<!-- <h4>Select item below:</h4> -->
									<div class="col-lg-10">

										<label>Select items from inventory:</label>

										<select name="users" onchange="showUser(this.value)" class="form-control input-sm" style="background: linear-gradient(to right, #00ffff 0%, #66ccff 100%);">
											<option value="" style="font-family:fangsong!important;">Click here to select item</option>
											<?php
                                      $a = mysqli_query($con,"SELECT * from tblitems where qnty>0 and company='".$_SESSION['company']."' order by item_name");
                                        while($row=mysqli_fetch_array($a)){
                                            echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).'</option>';
                                                                                            }    
                                          ?>
										</select>

									</div>
									<!--Hidden SaveQuotation Input-->
									<input type="submit" id="submitB" class="hidden">
								</form>
								<div class="col-lg-2">
									<label>&nbsp;</label>
									<button class="btn" onclick="myFunction()"><i class="fa fa-plus"></i> Add other costs</button>
								</div>
							</div>
							<br>
							<div id="txtHint"></div>
							<br><br>

							<!-- additional items -->
							<div id="myAdd">
								<form id="insert" method="post">
									<table class="table table-striped" id="table_field2">
										<tr>
											<th>Additional Item/Service</th>
											<th>Description</th>
											<th>Quantity</th>
											<th>Unit Price</th>
											<th colspan="2">Supplier</th>

										</tr>
										<tr>
											<td><input type="hidden" name="event_id" class="form-control" value="<?php echo $_GET['id'];?>">
												<input type="text" name="costName[]" class="form-control" required>
											</td>
											<td><input type="text" name="costDescription[]" value="Nill" class="form-control"></td>
											<td><input type="number" name="costQuantity[]" class="form-control" required></td>
											<td><input type="number" name="costPrice[]" class="form-control" required></td>
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
											<td style="width: 10px"><input type="button" name="add" id="add2" value="+" class="btn btn-warning"></td>
										</tr>
									</table>
									<center><button type="submit" title="Lease item" class="btn btn-success btn-sm" style="margin-top:10px;margin-left:20px; width:150px;" id="showData"> Save</button> </center>
								</form>
							</div>
							<!-- end of additional items -->
							<br><br><br>
							<div id="table-container"></div>
						</div>

					</div>

				</div>


				<!---------------------------------------------------------------------------->
				<!--				<center><label for="submitB" id="submitBtn">Save and View Quotation</label></center>-->
				<!--				<center><a href="view_event?id=<?php echo $event_id; ?>" class="btn btn-primary btn-sm">Save and View Quotation</a></center>-->
				<form method="post" action="savequot.php">

					<div class="row" style="align-items:center!important;">
						<div style="margin-top:50px!important; margin-left:30px!important;">
							<div class="col-lg-3 col-sm-6 col-md-3 col-xl-3" style="margin-bottom:10px;">

								<label>Date of creation: <span style="color:red!important;"><strong>*</strong></span></label>
								<input type="date" name="l_date" id="l_date" class="form-control" placeholder="Date" Required>
							</div>
							<div class="col-lg-3  col-sm-6 col-md-3 col-xl-3" style="margin-bottom:10px;">

								<label>Expiry date: <span style="color:red!important;"><strong>*</strong></span></label>
								<input type="date" name="expiry_date" id="e_date" class="form-control" placeholder="Date" Required>
							</div>
							<div class="col-lg-3  col-sm-6 col-md-3 col-xl-3" style="margin-bottom:10px;">

								<label>Quotation status:</label>
								<select name="quotation_status" class="form-control" id="q_status" Required>
									<option value="" disabled selected>Select Status: </option>
									<option value="Pending" selected>Pending</option>
									<option value="Approved">Approved</option>
									<option value="Rejected">Rejected</option>


								</select>

							</div>
							<input type="hidden" name="event_id" id="event_id" value="<?php echo $event_id; ?>">
						</div>
					</div>

					<center><button type="submit" name="submitformz" class="btn btn-primary btn-sm mt-5 mb-5">Save and View Quotation</button></center>

				</form>



			</section>

		</aside>
	</div>
	<?php 
        include "../footer.php"; ?>

	<script>
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
				xmlhttp.open("GET", "get-item-quote.php?q=" + str + "&c=" + event_id, true);
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
		var refInterval = window.setInterval('update()', 400); //  seconds
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
		var refInterval = window.setInterval('update()', 400); //  seconds
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
				url: "php-script-quote.php",
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
					var refInterval = window.setInterval('update()', 400); //  seconds
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
		function SubmitFormz() {
			var l_date = $('input[name=l_date]').val();
			var e_date = $('input[name=expiry_date]').val();
			var q_status = $('input[name=quotation_status]').val();
			var event_id = $('input[name=event_id]').val();
			//			var l_date = document.getElementById('l_date').value;
			// var e_date = document.getElementById('e_date').value;
			// var q_status = document.getElementById('q_status').value;
			// var event_id = document.getElementById('event_id').value;
			var formData = {
				l_date: l_date,
				e_date: e_date,
				q_status: q_status,
				event_id =: event_id
			};
			$.ajax({
				url: "https://merimeventsrun.com/hir/hip/usad/savequote.php",
				type = "POST",
				data: formData,
				success: function(response) {

				}
			})

		}

	</script>
	<script>
		//Save Quotation
		// Form Submit Button DOM
		let submitBtn = document.getElementById('submitBtn');

		// Adding event listener to form submit button 
		submitBtn.addEventListener('click', (event) => {

			// Preventing form to submit
			event.preventDefault();

			// Fetching Form data
			let l_date = document.getElementById('l_date').value;
			let e_date = document.getElementById('e_date').value;
			let q_status = document.getElementById('q_status').value;
			let event_id = document.getElementById('event_id').value;

			// jQuery Ajax Post Request
			$.post('savequot.php', {

				// Sending Form data
				l_date: l_date,
				e_date: e_date,
				q_status: q_status,
				event_id: event_id
			}, (response) => {

				// Response from PHP back-end
				console.log(response);
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
			var html = '<tr><td><input type="hidden" name="event_id" class="form-control" value="<?php echo $_GET['id'];?>"><input type="text" name="costName[]" class="form-control" required></td><td><input type="text" name="costDescription[]" value="Nill" class="form-control"></td><td><input type="number" name="costQuantity[]" class="form-control" ></td></td><td><input type="number" name="costPrice[]" class="form-control" required></td><td><select name="costSupplier[]" class="form-control input-sm" ><option value="" disabled selected>..Select..</option> <?php $a = mysqli_query($con,"SELECT * from tblsuppliers where company='".$_SESSION['company']."' "); while($row=mysqli_fetch_array($a)){echo '<option  value="'.$row['id'].'">'.ucwords($row['full_name']).'</option>'; } ?></select> </td> <td style = "width: 10px"> <input type = "button" name = "remove" id= "remove" value = "x" class = "btn btn-danger" > </td></tr> ';
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
