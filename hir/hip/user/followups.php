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
$compzz=$_SESSION['company'];

$cust_person=$_SESSION['userid'];
//Working with Urgency
//get today's date
$todate=date('Y-m-d');
//day itself
$years_today=date('Y',strtotime($todate));
$months_today=date('m',strtotime($todate));
$days_today=date('d',strtotime($todate));
$display_deadline='';
if(isset($_POST['submit_comment'])){
$cust_id=$_POST['customer_ids'];
$cust_comment =mysqli_real_escape_string($con,$_POST['comment']);

$cust_followup=$_POST['follow_up'];
$todate=date('Y-m-d');
$cust_prefdate=$_POST['spec_date'];
$additional=mysqli_real_escape_string($con,$_POST['additional']);
$progresz='Not Started';
$demo_date=$_POST['demo_date'];
 $followup_deets=$_POST['followup_user'];
	  $deets =explode(',',$followup_deets);
                   $followup_userid = $deets[0];
                   $followup_userole =$deets[1];
	//Name of person in charge of followup
	//Admin
	if($followup_userole == 'Admin'){
		$follo=mysqli_query($con,"SELECT * FROM tblstaff WHERE id='$followup_userid'");
		while($tog = mysqli_fetch_array($follo)){
			$followup_user = $tog['full_name'];
		}
	}
   //Regular User
	if($followup_userole == 'User'){
		$follo=mysqli_query($con,"SELECT * FROM tblusers WHERE id='$followup_userid'");
		while($tog = mysqli_fetch_array($follo)){
			$followup_user = $tog['full_name'];
		}
	}
	

	

	

$redd=mysqli_query($con,"INSERT INTO customer_comments(customer_comment,customer_person,customer_followup,customer_date,customer_prefdate,customer_id,customer_additional,customer_progress,company,role,demo_date,followup_user,followup_userid,followup_userole) VALUES ('$cust_comment','$cust_person','$cust_followup','$todate','$cust_prefdate','$cust_id','$additional','$progresz','$compzz','user','$demo_date','$followup_user','$followup_userid','$followup_userole')");
if($redd){
echo'<script>alert("Comment Added succesfully!!");window.location="followups.php?id='."$cust_id".'"</script>';

}else{
$error=mysqli_error($con);
echo'<script>alert(" '."$error".'");window.location="followups.php?id='."$cust_id".'"</script>';
}

}
	//DELETE COMMENTS
	
	    if(isset($_POST['delete']))
	    {
			
			if(empty($_POST['chk_delete'])){
				echo'<script>alert("Select Comment(s) to delete!");window.location="followups.php"</script>';
			}
	        foreach($_POST['chk_delete'] as $value)
	        {
	            $deletee = mysqli_query($con,"DELETE from customer_comments where id = '$value' ");
					if(!$deletee){
						$era=mysqli_error($con);
						echo '<script>alert("Error: '."$era".'");</script>';
					}
	                    
	            elseif($deletee == true)
	            {
	                $_SESSION['delete'] = 1;
	                header("location: ".$_SERVER['REQUEST_URI']);
	            }
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

	.sidebar-menu .follow {
		background-color: #009999;
	}

	/* define variables for the primary colors */
	$primary_1: #ff9999;
	$primary_2: #b2ad7f;
	$primary_3: #878f99;

	/* use the variables */
	.main-container {
		/*padding: 100px;*/
		background-color: $primary_1;
		/*border-top-left-radius: 50px;*/
	}

	.forma {


		height: auto;
		/*background:red;*/
		padding: 20px;
		/*position: absolute;*/
		overflow: hidden;
		/*adding overflow hidden*/
	}

	.forma:before {
		content: ‘’;
		/*
		width: 300px;
		height: 400px;
*/
		background: inherit;
		position: absolute;
		left: -25px;
		/*giving minus -25px left position*/
		right: 0;
		top: -25px;
		/*giving minus -25px top position */
		bottom: 0;
		box-shadow: inset 0 0 0 200px rgba(255, 255, 255, 0.3);
		filter: blur(10px);
	}

	.main .input-group-append {
		display: flex;
	}

	.main .btn {
		position: relative;
		z-index: 2;
	}


	.container {
		background-color: #F0DB4F;
		padding: 1rem;
		border-radius: .5rem;
		width: 700px;
		max-width: 90%;
	}

	.timer {
		position: absolute;
		top: 2rem;

		color: #F0DB4F;
		font-weight: bold;
	}

	.quote-display {
		margin-bottom: 1rem;
		margin-left: calc(1rem + 2px);
		margin-right: calc(1rem + 2px);
	}

	.quote-input {
		background-color: transparent;
		color: black;
		border: 2px solid #A1922E;
		outline: none;
		width: 100%;
		height: 8rem;
		margin: auto;
		resize: none;
		padding: .5rem 1rem;

		border-radius: .5rem;
	}

	.quote-input:focus {
		border-color: black;
	}

	.comos {
		/*		display: inline-block;*/
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		max-width: 10ch;
	}

</style>

<body class="skin-black">
	<!-- header logo: style can be found in header.less -->

	<?php include('../header.php'); ?>

	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<?php include('../sidebar-left.php'); ?>

		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->

			<section class="content-header" style="border-style:;border:1px solid #dedede;">
				<div class="row" margin-bottom:30px!important;>
					<a href="javascript:void(0)" title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left"></i> Back</a>&nbsp;&nbsp;&nbsp;
					<a class="btn btn-info btn-sm" href="" data-toggle="modal" data-target="#flipFlop" style="font-size:15px; font-family:fangsong; ">Add Followup Comment +</a>
					<div class="col-lg-3 col-xl-3 col-md-3" style="float:right!important;">
						<select class="customselect form-control" aria-label="Default select example">
							<option selected disabled>Filter Records</option>
							<option value="0">All Followups</option>
							<option value="1">Urgency</option>
							<option value="2">My followups</option>
							<option value="3">Others' Followups</option>

						</select>

					</div>
				</div>




			</section>
			<!--Add Comment Modal-->


			<!-- The modal -->
			<div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form method="post" action="">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true" style="color:red!important; font-weight:900">&times;</span>
								</button>
								<div class="pull-left image">
									<img src="../../images/icons/edit.png" class="img-circle" alt="User Image" style="width:35px" />
								</div>
								<h4 class="modal-title text-center text-info" style="font-family:fangsong!important;" id="modalLabel"><strong>Add comments </strong></h4>
							</div>
							<div class="modal-body" style="height:450px; overflow:auto;">
								<label class="mb-4">Select Customer</label>
								<div class="form-group">
									<select name="customer_ids" class="form-control">
										<option disabled selected>All Customers</option>
										<?php
									$selecta=mysqli_query($con,"SELECT * FROM tblcustomers WHERE company='$compzz'");
									while($compy = mysqli_fetch_array($selecta)){?>
										<option value="<?php echo $compy['id']; ?>"><?php echo $compy['fname']; ?> <?php echo $compy['mnmae']; ?> <?php echo $compy['lname']; ?></option>
										<?php } ?>
									</select>
								</div>
								<label class="mb-4">Add comment</label>
								<div class=" form-group ">
									<textarea class="form-control" name="comment" rows="4" required>

                                         </textarea>
								</div>


								<label class="mb-4">Select /Enter Follow up Action</label>
								<div class="form-group">

									<input type="text" class="form-control bg-white border-left-0 customselect" name="follow_up" value="" list="agentss" placeholder="Enter/ Select follow up Action" Required>
									<datalist id="agentss" style="list-style:none!important; background-color:white!important;">
										<?php
										$swd=mysqli_query($con,"SELECT * FROM followups WHERE user='".$_SESSION['company']."'");
										while($roff =mysqli_fetch_array($swd)){ ?>
										<option value="<?php echo $roff['followup_detail']; ?>"><?php echo $roff['followup_detail']; ?>
										</option>
										<?php } ?>





									</datalist>
								</div>
								<div class="showcontent1" style="display:none;">
									<label>Enter Preffered date for the demo</label>
									<div class="form-group">
										<input type="date" class="form-control bg-white" name="demo_date">
									</div>
								</div>
								<div class="showcontent">
									<label>Enter Prefered date for followup</label>
									<div class="form-group">
										<input type="date" class="form-control bg-white" name="spec_date">
									</div>
								</div>
								<label class="mb-4 mt-4">Enter Additional Followup Information</label>
								<div class="form-group">
									<textarea class="form-control" rows="4" name="additional">

									</textarea>
								</div>
								<label class="mb-4 mt-5">Who is responsible for followup?</label>
								<select name="followup_user" class="form-control" required>
									<option disabled selected> Select </option>
									<?php 
									
									$wham =mysqli_query($con,"SELECT * FROM tblusers WHERE company='".$_SESSION['company']."' ");
									while($whamy = mysqli_fetch_array($wham)){ ?>
									<option value="<?php echo $whamy['id']; ?>,User"><?php echo $whamy['full_name']; ?></option>

									<?php }
								
									$bang=mysqli_query($con,"SELECT * FROM tblstaff WHERE company='".$_SESSION['company']."' ");
									
									while($ban = mysqli_fetch_array($bang)){ ?>
									<option value="<?php echo $ban['full_name']; ?>,Admin"><?php echo $ban['full_name']; ?></option>

									<?php } ?>
								</select>


							</div>

							<div class="modal-footer">
								<button type="submit" name="submit_comment" class="btn btn-primary">save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!--End of Add comment Modal-->

			<!--==== View comment Modal  New--------->

			<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" id="myyModal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header" style="">
							<a type="button" href="followups.php" class="close" aria-hidden="true">&times;</a>
							<div class="pull-left image">
								<img src="../../images/icons/edit.png" class="img-circle" alt="User Image" style="width:35px" />
							</div>

						</div>
						<div class="modal-body" style="overflow:auto; height:500px">
							<div class="row">
								<div class="result" id="txtHint"></div>
							</div>
						</div>

						<div class="modal-footer">
							<a href="followups.php" class="btn btn-danger">Close</a>

						</div>
					</div>
				</div>
			</div>
			<section class="content">


				<div class="row">

					<!-- left column -->
					<div class="box-body table-responsive">
						<form method="post">
							<button type="submit" onclick="return confirm('Are you sure you want to delete comments?')" name="delete" style="margin-top:10px!important; margin-bottom:10px!important; float:right;" class="btn btn-danger btn-sm ">Delete comments <i class="fas fa-trash"></i></button>
							<h4 class="all text-center text-info mb-4" style="font-family:fangsong!important; "><strong> All Followup Comments</strong> </h4>
							<h4 class="urgent text-center text-info mb-4" style="font-family:fangsong!important; display:none;"><strong>Followups ordered by Urgency(deadlines)</strong> </h4>
							<h4 class="my text-center text-info mb-4" style="font-family:fangsong!important; display:none;"><strong> My Followups</strong> </h4>
							<h4 class="others text-center text-info mb-4" style="font-family:fangsong!important; display:none;"><strong> Others' Followups</strong> </h4>



							<table id="table" class="table table-striped">

								<thead>
									<tr>
										<th></th>
										<th></th>
										<th>Customer</th>
										<th>Comment</th>
										<th>Followup Action</th>
										<th>Progress</th>
										<th>Deadline</th>
										<th>Followup Assignment</th>
										<th>View</th>
										<th>Update</th>

										<!-- <th>Edit</th> -->
										<!--														<th style="width:20px !important;">Delete</th>-->
										<!--th style="width: 20px !important;">Print</th-->
									</tr>
								</thead>
								<!----Display All Followups-->


								<tbody class="showcontent1">

									<?php
									$b=1;
							$sdo=mysqli_query($con,"SELECT * FROM customer_comments WHERE (company='$compzz' AND followup_userid ='$cust_person' ) || (company= '$compzz' AND customer_person ='$cust_person') ORDER BY id ASC");
							while($romm =mysqli_fetch_array($sdo)){
								$cutt_person=$romm['customer_person'];
								$cust_id=$romm['customer_id'];
								$cimment=$romm['customer_comment'];
								$percent=$romm['progress_percent'];
								$personaz=$romm['followup_user'];
								$deadlinez =$romm['customer_prefdate'];
								$sd=mysqli_query($con,"SELECT * FROM tblstaff WHERE id='$cutt_person'");
								while($ray =mysqli_fetch_array($sd)){
									$mname=$ray['full_name'];
									
								}
								//GET CUSTOMER NAME
								
								$nombre =mysqli_query($con,"SELECT * FROM tblcustomers WHERE id='$cust_id'");
								while($uno =mysqli_fetch_array($nombre)){
									$ff=$uno['fname'];
									$mm=$uno['mname'];
									$ll=$uno['lname'];
								}
								//PROGRESS
								if(!empty($romm['customer_progress'])){
								if(($romm['customer_progress']) == 'Not Started'){
									$dis= '<span class="text-danger" style="font-family:fangsong; font-size: 15px!important;"><strong>Not started</strong></span>';
								}
								if(($romm['customer_progress']) == 'In Progress'){
									$dis= '<span  style="font-family:fangsong; color:#ffb000; font-size: 15px!important;"><strong>In Progress</strong></span><span class="text-dark" style="font-family:fangsong !important;"><em>('."$percent".' %)</em></span>';
								}
								if(($romm['customer_progress']) == 'Completed'){
									$dis= '<span class="text-success" style="font-family:fangsong; font-size: 15px!important;"><strong>Completed</strong></span>';
								}}else{
									$dis= '<span class="text-danger" style="font-family:fangsong; font-size: 15px!important;"><strong>Not started</strong></span>';
								}
							   //FOLLOWUP ASSIGNMENTS
								//Checking if it's an assigned task or not
										if(($romm['followup_userid'] == $cust_person) && ($romm['customer_person']!== $cust_person)){
									$taskitz ='<span class="text-success" style="font-family:fangsong; font-size:15px!important;"><strong>Assigned Followup</strong></span>';
								}
								if(($romm['followup_userid'] !== $cust_person) && ($romm['customer_person'] == $cust_person ) && (!empty($romm['followup_userid']))){
								$taskitz ='<span style="color:#FFA500; font-family:fangsong!important; font-size:15px!important;"><strong>'."$personaz".'  Followup </strong></span>';
								}elseif(($romm['customer_person'] ==$cust_person) && ($romm['followup_userid'] == $cust_person) || empty($romm['followup_userid'])){
									$taskitz ='<span style="color:#FF7518; font-family:fangsong!important; font-size:15px!important;"><strong>My Followup </strong></span>';
								}
								//DEADLINES
								if(!empty($deadlinez)){
									

                               $days_deadline=date('d',strtotime($deadlinez));
                               $months_deadline=date('m',strtotime($deadlinez));
                               $years_deadline=date('Y',strtotime($deadlinez));
									if(($months_deadline == $months_today )&& ($years_deadline == $years_today)){
									$day_diff =$days_today -$days_deadline;
								
//	                       
                           //if it's a diffrence of 2days deadline=color red
		                       if($day_diff <= 1){
			                   $display_deadline ='<span style="font-family:fangsong; font-size:15px; color:red;"><strong>'."$deadlinez".'</strong></span>';
		                        }
//                             //5 days Amber
		                    elseif(($day_diff <= 5) && ($day_diff >= 3)){
			                   $display_deadline ='<span style="font-family:fangsong; font-size:15px; color:#C76A00;"><strong>'."$deadlinez".'</strong></span>';
		                      }
//
//                             //else green
		                     else{
			               $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-success"><strong>'."$deadlinez".'</strong></span>';
		                       }
								}else{
										 $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-dark"><strong>'."$deadlinez".'</strong></span>';
									}
								}
								

	                       
//
									
							
							
								?>
									<tr>
										<td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="<?php echo $romm['id']; ?>" /></td>
										<td><?php echo $b++; ?></td>
										<td><?php echo $ff; ?> <?php echo $mm; ?> <?php echo $ll; ?></td>

										<td class="comos"><?php echo($romm['customer_comment']);?></td>
										<td class="comos"><?php echo $romm['customer_followup']; ?></td>
										<td><?php echo $dis; ?></td>
										<td><?php echo $display_deadline; ?></td>
										<td><?php echo $taskitz; ?></td>
										<td><a id="<?php echo $romm['id']; ?>" class="edit_status" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">



												<img src="https://merimevents-run.com/hir/images/icons/eye.png" class="iconb"></a></td>
										<td>
											<a id="<?php echo $romm['id']; ?>" class="edit_offer" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">




												<img src="https://merimevents-run.com/hir/images/icons/edit.png" class="iconb"></a>
										</td>




									</tr>

									<?php } ?>
								</tbody>

								<!-- Displayby Urgency----->

								<tbody class="showcontent2" style="display:none;">

									<?php
									$b=1;
							$sdo1=mysqli_query($con,"SELECT * FROM customer_comments WHERE (company='$compzz' AND followup_userid ='$cust_person' ) || (company= '$compzz' AND customer_person ='$cust_person') AND customer_progress !='Complete' ORDER BY customer_prefdate DESC");
							while($romm =mysqli_fetch_array($sdo1)){
								$cutt_person=$romm['customer_person'];
								$cust_id=$romm['customer_id'];
								$cimment=$romm['customer_comment'];
								$percent=$romm['progress_percent'];
								$personaz=$romm['followup_user'];
								$deadlinez=$romm['customer_prefdate'];
								$sd=mysqli_query($con,"SELECT * FROM tblstaff WHERE id='$cutt_person'");
								while($ray =mysqli_fetch_array($sd)){
									$mname=$ray['full_name'];
									
								}
								//GET CUSTOMER NAME
								
								$nombre =mysqli_query($con,"SELECT * FROM tblcustomers WHERE id='$cust_id'");
								while($uno =mysqli_fetch_array($nombre)){
									$ff=$uno['fname'];
									$mm=$uno['mname'];
									$ll=$uno['lname'];
								}
								//PROGRESS
								if(!empty($romm['customer_progress'])){
								if(($romm['customer_progress']) == 'Not Started'){
									$dis= '<span class="text-danger" style="font-family:fangsong; font-size: 15px!important;"><strong>Not started</strong></span>';
								}
								if(($romm['customer_progress']) == 'In Progress'){
									$dis= '<span  style="font-family:fangsong; color:#ffb000; font-size: 15px!important;"><strong>In Progress</strong></span><span class="text-dark" style="font-family:fangsong !important;"><em>('."$percent".' %)</em></span>';
								}
								if(($romm['customer_progress']) == 'Completed'){
									$dis= '<span class="text-success" style="font-family:fangsong; font-size: 15px!important;"><strong>Completed</strong></span>';
								}}else{
									$dis= '<span class="text-danger" style="font-family:fangsong; font-size: 15px!important;"><strong>Not started</strong></span>';
								}
							   //FOLLOWUP ASSIGNMENTS
								//Checking if it's an assigned task or not
										if(($romm['followup_userid'] == $cust_person) && ($romm['customer_person']!== $cust_person)){
									$taskitz ='<span class="text-success" style="font-family:fangsong; font-size:15px!important;"><strong>Assigned Followup</strong></span>';
								}
								if(($romm['followup_userid'] !== $cust_person) && ($romm['customer_person'] == $cust_person ) && (!empty($romm['followup_userid']))){
								$taskitz ='<span style="color:#FFA500; font-family:fangsong!important; font-size:15px!important;"><strong>'."$personaz".'  Followup </strong></span>';
								}elseif(($romm['customer_person'] ==$cust_person) && ($romm['followup_userid'] == $cust_person) || empty($romm['followup_userid'])){
									$taskitz ='<span style="color:#FF7518; font-family:fangsong!important; font-size:15px!important;"><strong>My Followup </strong></span>';
								}
									//DEADLINES
								if(!empty($deadlinez)){
									

                               $days_deadline=date('d',strtotime($deadlinez));
                               $months_deadline=date('m',strtotime($deadlinez));
                               $years_deadline=date('Y',strtotime($deadlinez));
									if(($months_deadline == $months_today )&& ($years_deadline == $years_today)){
									$day_diff =$days_today -$days_deadline;
										
//	                       
                           //if it's a diffrence of 2days deadline=color red
		                       if($day_diff <= 1){
			                   $display_deadline ='<span style="font-family:fangsong; font-size:15px; color:red;"><strong>'."$deadlinez".'</strong></span>';
		                        }
//                             //5 days Amber
		                      elseif(($day_diff <= 5) && ($day_diff >= 3)){
			                   $display_deadline ='<span style="font-family:fangsong; font-size:15px; color:#C76A00;"><strong>'."$deadlinez".'</strong></span>';
		                      }
//
//                             //else green
		                     else{
			               $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-dark"><strong>'."$deadlinez".'</strong></span>';
		                       }
								}else{
										 $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-success"><strong>'."$deadlinez".'</strong></span>';
									}
								}
								

	                       
//
												
								?>
									<tr>
										<td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="<?php echo $romm['id']; ?>" /></td>
										<td><?php echo $b++; ?></td>
										<td><?php echo $ff; ?> <?php echo $mm; ?> <?php echo $ll; ?></td>

										<td class="comos"><?php echo($romm['customer_comment']);?></td>
										<td class="comos"><?php echo $romm['customer_followup']; ?></td>
										<td><?php echo $dis; ?></td>
										<td><?php echo $display_deadline; ?></td>
										<td><?php echo $taskitz; ?></td>
										<td><a id="<?php echo $romm['id']; ?>" class="edit_status" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">



												<img src="https://merimevents-run.com/hir/images/icons/eye.png" class="iconb"></a></td>
										<td>
											<a id="<?php echo $romm['id']; ?>" class="edit_offer" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">




												<img src="https://merimevents-run.com/hir/images/icons/edit.png" class="iconb"></a>
										</td>




									</tr>

									<?php } ?>
								</tbody>

								<!------------Display My Followups (only)----------------->

								<tbody class="showcontent3" style="display:none">

									<?php
									$b=1;
									
							$sdo2=mysqli_query($con,"SELECT * FROM customer_comments WHERE( company='$compzz' AND followup_userid='$cust_person' AND customer_person='$cust_person') OR (company ='$compzz' AND followup_userid='$cust_person' AND customer_person!='$cust_person')");
							while($romm =mysqli_fetch_array($sdo2)){
								$cutt_person=$romm['customer_person'];
								$cust_id=$romm['customer_id'];
								$cimment=$romm['customer_comment'];
								$percent=$romm['progress_percent'];
								$personaz=$romm['followup_user'];
								$deadlinez=$romm['customer_prefdate'];
								$sd=mysqli_query($con,"SELECT * FROM tblstaff WHERE id='$cutt_person'");
								while($ray =mysqli_fetch_array($sd)){
									$mname=$ray['full_name'];
									
								}
								//GET CUSTOMER NAME
								
								$nombre =mysqli_query($con,"SELECT * FROM tblcustomers WHERE id='$cust_id'");
								while($uno =mysqli_fetch_array($nombre)){
									$ff=$uno['fname'];
									$mm=$uno['mname'];
									$ll=$uno['lname'];
								}
								//PROGRESS
								if(!empty($romm['customer_progress'])){
								if(($romm['customer_progress']) == 'Not Started'){
									$dis= '<span class="text-danger" style="font-family:fangsong; font-size: 15px!important;"><strong>Not started</strong></span>';
								}
								if(($romm['customer_progress']) == 'In Progress'){
									$dis= '<span  style="font-family:fangsong; color:#ffb000; font-size: 15px!important;"><strong>In Progress</strong></span><span class="text-dark" style="font-family:fangsong !important;"><em>('."$percent".' %)</em></span>';
								}
								if(($romm['customer_progress']) == 'Completed'){
									$dis= '<span class="text-success" style="font-family:fangsong; font-size: 15px!important;"><strong>Completed</strong></span>';
								}}else{
									$dis= '<span class="text-danger" style="font-family:fangsong; font-size: 15px!important;"><strong>Not started</strong></span>';
								}
							   //FOLLOWUP ASSIGNMENTS
								//Checking if it's an assigned task or not
										if(($romm['followup_userid'] == $cust_person) && ($romm['customer_person']!== $cust_person)){
									$taskitz ='<span class="text-success" style="font-family:fangsong; font-size:15px!important;"><strong>Assigned Followup</strong></span>';
								}
								if(($romm['followup_userid'] !== $cust_person) && ($romm['customer_person'] == $cust_person ) && (!empty($romm['followup_userid']))){
								$taskitz ='<span style="color:#FFA500; font-family:fangsong!important; font-size:15px!important;"><strong>'."$personaz".'  Followup </strong></span>';
								}elseif(($romm['customer_person'] ==$cust_person) && ($romm['followup_userid'] == $cust_person) || empty($romm['followup_userid'])){
									$taskitz ='<span style="color:#FF7518; font-family:fangsong!important; font-size:15px!important;"><strong>My Followup </strong></span>';
								}
						//DEADLINES
								if(!empty($deadlinez)){
									

                               $days_deadline=date('d',strtotime($deadlinez));
                               $months_deadline=date('m',strtotime($deadlinez));
                               $years_deadline=date('Y',strtotime($deadlinez));
									if(($months_deadline == $months_today )&& ($years_deadline == $years_today)){
									$day_diff =$days_today -$days_deadline;
								
//	                       
                           //if it's a diffrence of 2days deadline=color red
		                       if($day_diff <= 1){
			                   $display_deadline ='<span style="font-family:fangsong; font-size:15px; color:red;"><strong>'."$deadlinez".'</strong></span>';
		                        }
//                             //5 days Amber
		                   elseif(($day_diff <= 5) && ($day_diff >= 3)){
			                   $display_deadline ='<span style="font-family:fangsong; font-size:15px; color:#C76A00;"><strong>'."$deadlinez".'</strong></span>';
		                      }
//
//                             //else green
		                     else{
			               $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-dark"><strong>'."$deadlinez".'</strong></span>';
		                       }
								}else{
										 $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-success"><strong>'."$deadlinez".'</strong></span>';
									}
								}
								

	                       
//
								?>
									<tr>
										<td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="<?php echo $romm['id']; ?>" /></td>
										<td><?php echo $b++; ?></td>
										<td><?php echo $ff; ?> <?php echo $mm; ?> <?php echo $ll; ?></td>

										<td class="comos"><?php echo($romm['customer_comment']);?></td>
										<td class="comos"><?php echo $romm['customer_followup']; ?></td>
										<td><?php echo $dis; ?></td>
										<td><?php echo $display_deadline; ?></td>
										<td><?php echo $taskitz; ?></td>
										<td><a id="<?php echo $romm['id']; ?>" class="edit_status" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">



												<img src="https://merimevents-run.com/hir/images/icons/eye.png" class="iconb"></a></td>
										<td>
											<a id="<?php echo $romm['id']; ?>" class="edit_offer" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">




												<img src="https://merimevents-run.com/hir/images/icons/edit.png" class="iconb"></a>
										</td>




									</tr>

									<?php } ?>
								</tbody>

								<!-------------Display Other User's Followups---------------->

								<tbody class="showcontent4" style="display:none;">

									<?php
									$p=1;
							$sdo3=mysqli_query($con,"SELECT * FROM customer_comments WHERE company='$compzz' AND followup_userid !='$cust_person' AND customer_person='$cust_person'");
							while($romm =mysqli_fetch_array($sdo3)){
								$cutt_person=$romm['customer_person'];
								$cust_id=$romm['customer_id'];
								$cimment=$romm['customer_comment'];
								$percent=$romm['progress_percent'];
								$personaz=$romm['followup_user'];
								$deadlinez=$romm['customer_prefdate'];
								$sd=mysqli_query($con,"SELECT * FROM tblstaff WHERE id='$cutt_person'");
								while($ray =mysqli_fetch_array($sd)){
									$mname=$ray['full_name'];
									
								}
								//GET CUSTOMER NAME
								
								$nombre =mysqli_query($con,"SELECT * FROM tblcustomers WHERE id='$cust_id'");
								while($uno =mysqli_fetch_array($nombre)){
									$ff=$uno['fname'];
									$mm=$uno['mname'];
									$ll=$uno['lname'];
								}
								//PROGRESS
								if(!empty($romm['customer_progress'])){
								if(($romm['customer_progress']) == 'Not Started'){
									$dis= '<span class="text-danger" style="font-family:fangsong; font-size: 15px!important;"><strong>Not started</strong></span>';
								}
								if(($romm['customer_progress']) == 'In Progress'){
									$dis= '<span  style="font-family:fangsong; color:#ffb000; font-size: 15px!important;"><strong>In Progress</strong></span><span class="text-dark" style="font-family:fangsong !important;"><em>('."$percent".' %)</em></span>';
								}
								if(($romm['customer_progress']) == 'Completed'){
									$dis= '<span class="text-success" style="font-family:fangsong; font-size: 15px!important;"><strong>Completed</strong></span>';
								}}else{
									$dis= '<span class="text-danger" style="font-family:fangsong; font-size: 15px!important;"><strong>Not started</strong></span>';
								}
							   //FOLLOWUP ASSIGNMENTS
								//Checking if it's an assigned task or not
										if(($romm['followup_userid'] == $cust_person) && ($romm['customer_person']!== $cust_person)){
									$taskitz ='<span class="text-success" style="font-family:fangsong; font-size:15px!important;"><strong>Assigned Followup</strong></span>';
								}
								if(($romm['followup_userid'] !== $cust_person) && ($romm['customer_person'] == $cust_person ) && (!empty($romm['followup_userid']))){
								$taskitz ='<span style="color:#FFA500; font-family:fangsong!important; font-size:15px!important;"><strong>'."$personaz".'  Followup </strong></span>';
								}elseif(($romm['customer_person'] ==$cust_person) && ($romm['followup_userid'] == $cust_person) || empty($romm['followup_userid'])){
									$taskitz ='<span style="color:#FF7518; font-family:fangsong!important; font-size:15px!important;"><strong>My Followup </strong></span>';
								}
									//DEADLINES
								if(!empty($deadlinez)){
									

                               $days_deadline=date('d',strtotime($deadlinez));
                               $months_deadline=date('m',strtotime($deadlinez));
                               $years_deadline=date('Y',strtotime($deadlinez));
									if(($months_deadline == $months_today )&& ($years_deadline == $years_today)){
									$day_diff =$days_today -$days_deadline;
								
//	                       
                           //if it's a diffrence of 2days deadline=color red
		                       if($day_diff <= 1){
			                   $display_deadline ='<span style="font-family:fangsong; font-size:15px; color:red;"><strong>'."$deadlinez".'</strong></span>';
		                        }
//                             //5 days Amber
		                   elseif(($day_diff <= 5) && ($day_diff >= 3)){
			                   $display_deadline ='<span style="font-family:fangsong; font-size:15px; color:#C76A00;"><strong>'."$deadlinez".'</strong></span>';
		                      }
//
//                             //else green
		                     else{
			               $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-dark"><strong>'."$deadlinez".'</strong></span>';
		                       }
								}else{
										 $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-success"><strong>'."$deadlinez".'</strong></span>';
									}
								}
								

	                       
//							
							
								?>
									<tr>
										<td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="<?php echo $romm['id']; ?>" /></td>
										<td><?php echo $p++; ?></td>
										<td><?php echo $ff; ?> <?php echo $mm; ?> <?php echo $ll; ?></td>

										<td class="comos"><?php echo($romm['customer_comment']);?></td>
										<td class="comos"><?php echo $romm['customer_followup']; ?></td>
										<td><?php echo $dis; ?></td>
										<td><?php echo $display_deadline; ?></td>
										<td><?php echo $taskitz; ?></td>
										<td><a id="<?php echo $romm['id']; ?>" class="edit_status" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">



												<img src="https://merimevents-run.com/hir/images/icons/eye.png" class="iconb"></a></td>
										<td>
											<a id="<?php echo $romm['id']; ?>" class="edit_offer" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">




												<img src="https://merimevents-run.com/hir/images/icons/edit.png" class="iconb"></a>
										</td>




									</tr>

									<?php } ?>
								</tbody>




								<!------------------------------------------------------->


							</table>



						</form>
					</div><!-- /.box-body -->
				</div><!-- /.box -->




			</section><!-- /.content -->
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
	<!-- jQuery 2.0.2 -->
	<?php include "../footer.php"; ?>
	<script>
		$('.customselect').change(function() {

			if (($(this).val() == '1')) {
				$('.showcontent2').show();
				$('.urgent').show();
				$('.all').hide();
				$('.my').hide();
				$('.others').hide();
				$('.showcontent1').hide();
				$('.showcontent3').hide();
				$('.showcontent4').hide();


			}
			if (($(this).val() == '2')) {
				$('.showcontent3').show();
				$('.my').show();
				$('.all').hide();
				$('.urgent').hide();
				$('.others').hide();
				$('.showcontent1').hide();
				$('.showcontent2').hide();
				$('.showcontent4').hide();


			}
			if (($(this).val() == '3')) {
				$('.showcontent4').show();
				$('.others').show();
				$('.all').hide();
				$('.my').hide();
				$('.urgent').hide();
				$('.showcontent1').hide();
				$('.showcontent2').hide();
				$('.showcontent3').hide();


			}
			if (($(this).val() == '0')) {
				$('.showcontent1').show();
				$('.all').show();
				$('.urgent').hide();
				$('.my').hide();
				$('.others').hide();
				$('.showcontent2').hide();
				$('.showcontent3').hide();
				$('.showcontent4').hide();


			}
		});

	</script>
	<script>
		$(document).ready(function() {
			$('.edit_status').click(function(e) {
				e.preventDefault();
				var del = $(this).attr('id');
				$.ajax({
					type: "POST",
					url: "../commentModal.php",
					data: {
						clear: del
					},
					success: function(data) {
						$('.result').html(data);

					}

				});
			});
		});

	</script>
	<script>
		$(document).ready(function() {
			$('.edit_offer').click(function(e) {
				e.preventDefault();
				var del = $(this).attr('id');
				$.ajax({
					type: "POST",
					url: "../updateComment.php",
					data: {
						clear: del
					},
					success: function(data) {
						$('.result').html(data);

					}
				});
			});
		});

	</script>

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
