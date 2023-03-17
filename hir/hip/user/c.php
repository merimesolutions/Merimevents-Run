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
      $msg="";
      $con = mysqli_connect('localhost','merimeve_event','user@event','merimeve_event') or die(mysqli_error());
      //if submit button is pressed
      if (isset($_POST['btn_login'])){

          $fname        =$_POST['fname'];
          $mname        =$_POST['mname'];
          $lname        =$_POST['lname'];
          $gender       ="NA";
          $code         =$_POST['code']; 
          $box          =$_POST['box'];
          $town         =$_POST['town'];
          $identity     =$_POST['identity'];
          $phy_address  =$_POST['phy_address'];
          $fcontact     =$_POST['fcontact'];
          $scontact     =$_POST['scontact'];
          $email        =$_POST['email'];
          $b_c_name     =$_POST['b_c_name'];
          $b_c_location =$_POST['b_c_location'];
          $reg_date     =date("Y-m-d");
          $reg_time     =date("h:i:sa");
          $customer_name =$_POST['fname'].' '.$_POST['mname'].' '.$_POST['lname'];
          $company      =$_SESSION['company'];
          $customer = $_POST['customer'];
          $userName = $_POST['userName'];
            if(!empty($userName)){
               $user_name = implode(',', $userName);
             }
		  $customer_website =$_POST['customer_website'];
		  $add_info =$_POST['add_info'];
		  $customer_industry=$_POST['customer_industry'];

  $sql_u = "SELECT * FROM tblcustomers WHERE identity = '$identity' and company='$company' ";
      $results = mysqli_query($con,$sql_u);
        if(mysqli_num_rows($results)>0){
            echo '<script type="text/javascript">'; 
                echo 'alert("The customer is already registered !!!");'; 
                echo 'window.location = "c.php";';
                echo '</script>';
    }else{

          $sql="insert into tblcustomers(fname,mname,lname,gender,code,box,town,identity,phy_address,fcontact,scontact,email,b_c_name,b_c_location,company,customer_name,state,customer_website,customer_industry,add_info,interested_in) VALUES('$fname','$mname','$lname','$gender', '$code', '$box','$town', '$identity', '$phy_address','$fcontact','$scontact','$email','$b_c_name','$b_c_location','$company','$customer_name','$customer','$customer_website','$customer_industry','$add_info','$user_name')";
                  
          if(mysqli_query($con, $sql)){
              echo '<script type="text/javascript">'; 
                echo 'alert("The customer has been registered successfully.");'; 
                echo 'window.location = "cl.php";';
                echo '</script>';
          } else {
            echo '<script type="text/javascript">'; 
            echo 'alert("Error occured during submission.");'; 
            //echo 'window.location = "c.php";';
            echo '</script>';
          }

          mysqli_close($con);
        }
    }
      ?>
<!DOCTYPE html>
<html>
<?php include('../head_css.php'); ?>
<style type="text/css">
	a {
		color: #000;
	}

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

	button {
		background-color: transparent;
		border-style: none;
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
			<form role="form" method="post" enctype="multipart/form-data">
				<br>
				<section class="content-header">
					&nbsp;&nbsp; <a href="javascript:void(0)" title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left"></i> Back</a>&nbsp;&nbsp;&nbsp;

					<a href="cl.php" title="Customers list"><i class="fa fa-list" aria-hidden="true" title="Customers list"></i> Customers list</a>

				</section>

				<!-- Main content -->
				<section class="content">

					<!-- left column -->
					<div class="row">
						<div class="box-body table-responsive">
							<!--div class="panel-heading"> 
                        </div-->
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-default" style="">

									<table class="table table-striped">
										<tr>
											<td colspan="3">
												Please fill in the form below. All the fields with <span style="color: red">*</span> are mandatory.
											</td>
										</tr>
										<tr>
											<th>
												<p>First Name <span style="color: red">*</span></p>
											</th>
											<th>
												<p>Middle Name</p>
											</th>
											<th>
												<p>Last Name <span style="color: red">*</span></p>
											</th>
										</tr>
										<tr>
											<td>
												<input type="text" class="form-control" style="width:100%" name="fname" required placeholder="Enter First Name" autocomplete="off" title="Enter First Name">
											</td>
											<td>
												<input type="text" class="form-control" style="width:100%" name="mname" placeholder="Enter Middle Name" autocomplete="off" title="Enter Middle Name">
											</td>
											<td>
												<input type="text" class="form-control" style="width:100%" name="lname" required placeholder="Enter Last Name" autocomplete="off" title="Last First Name">
											</td>
										</tr>
									</table>
									<table class="table table-striped">
										<tr>
											<th style="width: 30%" colspan="1">
												<!--<p>Gender <span style="color: red">*</span></p>-->

												<p>Postal Code</p>
											</th>
											<th>
												<p>Post office box (P.O box)</p>
											</th>
											<th>
												<p>Town<span style="color: red">*</span></p>
											</th>
										</tr>
										<tr>
											<!--<td>-->
											<!--    <select class="form-control" style="width:100%" name="gender" required title="Gender">-->
											<!--        <option disabled="true" selected> Select Gender</option>-->
											<!--        <option value="Male">Male</option>-->
											<!--        <option value="Female">Female</option>-->
											<!--    </select>-->
											<!--</td>-->
											<td colspan="1">
												<input type="text" class="form-control" style="width:100%" name="code" placeholder="Enter Postal code" autocomplete="off" title="Postal code" pattern="[0-9]+">
											</td>
											<td>
												<input type="text" class="form-control" style="width:100%" name="box" placeholder="Enter Box number" autocomplete="off" title="Box numbe" pattern="[0-9]+">
											</td>
											<td>
												<input type="text" class="form-control" style="width:100%" name="town" required placeholder="Enter Physical Address" autocomplete="off" title="Physical Address">
											</td>
										</tr>
									</table>
									<table class="table table-striped">
										<tr>
											<th style="width: 42%">
												<p>National Identification Number / Passport No. <span style="color: red">*</span></p>
											</th>
											<th>
												<p>Physical Address</p>
											</th>
										</tr>
										<tr>
											<td>
												<input type="text" class="form-control" style="width:100%" name="identity" required placeholder="Enter National Identification Number" autocomplete="off" title="National Identification Number" pattern="[0-9]+">
											</td>
											<td>
												<input type="text" class="form-control" style="width:100%" name="phy_address" placeholder="Enter Physical Address" autocomplete="off" title="Physical Address">
											</td>
										</tr>
									</table>
									<table class="table table-striped">
										<tr>
											<th style="width: 30%">
												<p>1<sup>st</sup> Contact number <span style="color: red">*</span></p>
											</th>
											<th>
												<p>2<sup>nd</sup> Contact number <span style="color: red"></span></p>
											</th>
											<th>
												<p>Email address <span style="color: red">*</span></p>
											</th>
										</tr>
										<tr>
											<td>
												<input type="text" class="form-control" style="width:100%" name="fcontact" required placeholder="Enter first contact number" autocomplete="off" title="Enter first contact number" maxlength="12" pattern="[0-9]+">
											</td>
											<td>
												<input type="text" class="form-control" style="width:100%" name="scontact" placeholder="Enter second contact number" autocomplete="off" title="Enter second contact number" maxlength="12" pattern="[0-9]+">
											</td>
											<td>
												<input type="email" class="form-control" style="width:100%" name="email" placeholder="Enter Email Address" autocomplete="off" title="Email Address" Required>
											</td>
										</tr>
									</table>
									<table class="table table-striped">
										<tr>
											<th style="width:">
												<p>Business / Company name</p>
											</th>
											<th colspan="2">
												<p> Business / company location </p>
											</th>
										</tr>
										<tr>
											<td>
												<input type="text" class="form-control" style="width:100%" name="b_c_name" placeholder="Enter Business / Company name" autocomplete="off" title="Enter Business / Company name">
											</td>

											<td colspan="2">
												<input type="text" class="form-control" style="width:100%" name="b_c_location" placeholder="Enter Business / company location" autocomplete="off" title="Business location">
											</td>
										</tr>
										<tr>

											<th>Business website(Url)</th>
											<th>Customer Type</th>

											<th>Product of interest (for lead)</th>

										</tr>
										<tr>
											<td><input type="url" name="customer_website" class="form-control" placeholder="Enter URL"></td>
											<td>
												<select class="form-control" id="exampleFormControlSelect1" required name="customer">
													<option selected disabled>Select Customer type</option>
													<option value="1">Client</option>
													<option value="0">Lead</option>
												</select>
											</td>
											<td>
												<div class="dropdown">
													<button class="btn btn-sm btn-default dropdown-toggle form-control" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
														Select products
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1" style="padding:5px;">

														 <?php
                                                        $a = mysqli_query($con,"SELECT * from tblps where company='".$_SESSION['company']."' ");
                                                   
                                                          while($row=mysqli_fetch_array($a)){
                                                            
                                                            echo '<input type="checkbox" name="userName[]" class="form-control" value="'.$row['ps'].'"> &nbsp;'.ucwords($row['ps']) .'<br>';
                                                            
                                                       
                                                          }    
                                                      ?>

													</ul>
												</div>
											</td>

										</tr>

										<tr>
											<th>What does the customer do?( Industry)</th>



											<th colspan="2">Additional Information</th>
										</tr>
										<tr>
											<td>
												<div class="form-group"><textarea name="customer_industry" class="form-control" rows="4"></textarea></div>
											</td>

											<td colspan="2">
												<div class="form-group">
													<textarea name="add_info" class="form-control" rows="4"></textarea>
												</div>
											</td>
										</tr>

									</table>
								</div>

							</div>
						</div>



					</div>

					<center><button type="submit" class="btn btn-success" name="btn_login" id="btn_login" title="Save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>&nbsp;&nbsp;&nbsp;
						<button type="reset" class="btn btn-default" title="Reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
					</center>
				</section>


			</form>
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
	<!-- jQuery 2.0.2 -->
	<?php 
        include "../footer.php"; ?>
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
</body>

</html>
