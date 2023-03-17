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
//======================================//




 $sqlo=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
 if($sqlo){
     $number_of_rows= mysqli_num_rows($sqlo);
	 
 }
     if($number_of_rows < 1){
         echo '<script>alert("Add a Quotation!");window.location="quotation_type?id='."$event_id".'";</script>';
     
 }
 




//=========================================//
$swei =mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event_id'");
if($swei){
    while($row =mysqli_fetch_assoc($swei)){
        $ename=$row['event_name'];
        $custname=$row['customer_name'];
    }
}
 //add Tasks Modal guy
 if(isset($_POST['btn_add_event_task'])){
     $employee_id =$_POST['employee_id'];
     $task_name=$_POST['task_name'];
     $task_role=$_POST['task_role'];
     $start_date =$_POST['start_date'];
     $end_date=$_POST['dead_line'];
     $event_name=$_POST['event_name'];
     $event_id=$_POST['event_id'];
    
     
     //GET employee id and validate employee name
     $smp =mysqli_query($con, "SELECT * FROM tblusers WHERE id='$employee_id' AND company='$compp'");
    
     if($smp){
         $no_no =mysqli_num_rows($smp);
         if($no_no == 0){
             $name_err ="There is no staff member by that name";
         }
         while($er =mysqli_fetch_assoc($smp)){
             $employee_name =$er['full_name'];
         }
     }
     //check if the task already exists
     $sql000=mysqli_query($con,"SELECT * FROM tbltasks WHERE task_name='$task_name' AND project='Event' AND event_id='$event_id' AND employee_id='$employee_id' ");
     if($sql000){
         $number = mysqli_num_rows($sql000);
              if($number > 0){
         $err_of = "This task record already exists";
      
     }

     }  
     //----------------//
     if((empty($name_err)) && (empty($err_of))){
         $squery =mysqli_query($con,"INSERT INTO tbltasks(task_name,description,project,company,event_name,event_id,employee_name,employee_id,task_role,start_date,end_date,task_progress) VALUES ('$task_name','NILL','Event','$compp','$event_name','$event_id','$employee_name','$employee_id','$task_role','$start_date','$end_date',0)");
         if($squery){
             echo '<script>alert("Task Assigned successfully");window.location="view_event?id='."$event_id".'";</script>';
         }else{
             $errx =mysqli_error($con);
             echo'<script>alert("'."$errx".' ");window.location="events";</script>';
         }
     
     
     }
         if(!empty($name_err)){
            echo'<script>alert("'."$name_err".' ");window.location="events";</script>';  
          
         }
         if(!empty($err_of)){
       echo'<script>alert("'."$err_of".' ");window.location="events";</script>';  
         }
         
    
 
     }
 
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php include('../head_css.php'); ?>
<style type="text/css">
	.panel:hover {
		background-color: lightblue;
	}

	.sidebar-menu .events {
		background-color: #009999;
	}

</style>

<body class="skin-black">
	<!-- header logo: style can be found in header.less -->

	<?php include('../header.php'); ?>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<?php include('../sidebar-left.php'); ?>
		<aside class="right-side">
			<section class="content-header">
				<div class="form-row">
					<a href="javascript:void(0)" title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left"></i> Back</a>&nbsp;&nbsp;&nbsp;
				</div>
			</section>
			<!--=======================================================================================================================-->
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">

						<h3 class="text-center margin-top-4 margin-bottom-5" style="font-family:fangsong;"><strong><u><span class="text-info">Event Name:</span> &nbsp;<?php echo $ename; ?></u></strong></h3>
						<h3 class="text-center mt-2" style="margin-bottom: 50px;font-family:fangsong;"><strong> <span class="text-info">Customer Name:</span> &nbsp;<?php echo $custname; ?></strong></h3>


						<div class="tabbable-panel">
							<div class="tabbable-line">
								<ul class="nav nav-tabs ">
									<li class="active">
										<a href="#tab_default_1" data-toggle="tab">
											Quotation</a>
									</li>
									<li>
										<a href="#quotation" data-toggle="tab">
											Invoice</a>
									</li>
									<li>
										<a href="#tab_default_2" data-toggle="tab">
											Tasks</a>
									</li>

									<li>
										<a href="#tab_default_3" data-toggle="tab">
											Items Leased Out</a>
									</li>
									<li>
										<a href="#tab_default_4" data-toggle="tab">
											Returned Items</a>
									</li>
									<li>
										<a href="#tab_default_6" data-toggle="tab">
											Damaged Items</a>
									</li>
									<li>
										<a href="#tab_default_7" data-toggle="tab">
											Participants </a>
									</li>



								</ul>
								<?php
								  $yer=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id' ");
								  while($vila = mysqli_fetch_array($yer)){
									  $cdate =$vila['creation_date'];
									  $edate=$vila['expiry_date'];
									  $qstat=$vila['quotation_status'];
									  $qtype=$vila['quotation_type'];
									  
								  }
								  ?>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_default_1">
										<!---Insert Table-->
										<section class="content" style="width: 100%;height: 100%;">

											<div class="box">
												<?php
                          
                          $sele =mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
                        
                          if($sele){
                              $numz =mysqli_num_rows($sele);
                              if($numz > 0){
                              ?>

												<div class="box-body table-responsive">
													<div class="form-row">

														<?php
                            $e =mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id'");
                        
                          if($e){
//							 
                              $y =mysqli_num_rows($e);
							  
                              if($y > 0){
                                                    
                                                if($qtype=='Internal'){
                                                    echo '<a class="btn btn-info btn-sm form-group" style="margin-top:30px;margin-bottom:30px;" href="edit_quotation?id='.$event_id.'"><i class="fas fa-edit"></i>&nbsp;Edit Quotation</a>&nbsp;&nbsp;&nbsp;';}elseif($qtype=='External'){
												 echo '<a class="btn btn-info btn-sm form-group" style="margin-top:30px;margin-bottom:30px;" href="edit_quotation_ex?id='.$event_id.'"><i class="fas fa-edit"></i>&nbsp;Edit Quotation</a>&nbsp;&nbsp;&nbsp;';
												}
                                    echo '<a href="#quotation" data-toggle="tab" class="btn btn-success btn-sm form-group" style="margin-top:30px;margin-bottom:30px;float:center;" ><i class="fas fa-file-invoice"></i>&nbsp;Generate invoice</a>&nbsp;&nbsp;&nbsp;';
                                    echo '<a href="print-quotation?id='.$event_id.'" target="_blank" class="btn btn-primary btn-sm form-group" style="margin-top:30px;margin-bottom:30px;float:center;" ><i class="fas fa-print"></i>&nbsp;Print quotation</a>';
                                  echo '<a class="btn btn-danger btn-sm form-group" style="margin-top:30px;margin-bottom:30px;float:right;" onclick="deleteConfirm('.$event_id.'); " href="javascript:void(0);"><i class="fas fa-trash"></i>&nbsp;Delete Quotation</a>
                        ';
                        
                        echo '<hr>'; 
                              }else{
                                if($qtype=='Internal'){
                                                    echo '<a class="btn btn-info btn-sm form-group" style="margin-top:30px;margin-bottom:30px;" href="edit_quotation?id='.$event_id.'"><i class="fas fa-edit"></i>&nbsp;Edit Quotation</a>&nbsp;&nbsp;&nbsp;';}elseif($qtype=='External'){
												 echo '<a class="btn btn-info btn-sm form-group" style="margin-top:30px;margin-bottom:30px;" href="edit_quotation_ex?id='.$event_id.'"><i class="fas fa-edit"></i>&nbsp;Edit Quotation</a>&nbsp;&nbsp;&nbsp;';
												}
                        echo '<a href="#quotation" data-toggle="tab" class="btn btn-success btn-sm form-group" style="margin-top:30px;margin-bottom:30px;"><i class="fas fa-save"></i>&nbsp; Generate Invoice</a>&nbsp;&nbsp;&nbsp;';
                         echo '<a class="btn btn-danger btn-sm form-group" style="margin-top:30px;margin-bottom:30px;" onclick="deleteConfirm('.$event_id.'); " href="javascript:void(0);"><i class="fas fa-trash"></i>&nbsp;Delete Quotation</a>
                        '; 
                            }
                                                         }
                       ?>
													</div>
													<form method="post">
														<div class="row">

															<?php
								  if($qtype == 'Internal'){
									 echo '<center><h3 style="fomt-family:fangsong;"><strong><u>Quotation Based on Items from the Inventory (+ Additional costs )
									</u></strong> </h3></center>';
								  }elseif($qtype == 'External'){
									   echo '<center><h3 style="fomt-family:fangsong;"><strong><u>Quotation Based soley on Items from External Vendors
									</u></strong> </h3></center>';
								  } ?>
															<div style="margin-top:50px!important; margin-left:30px!important;">
																<div class="col-lg-3 col-sm-6 col-md-3 col-xl-3" style="margin-bottom:10px;">

																	<label>Date of quotation creation: </label>
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

														<!--?php include "../deleteModal.php"; ?-->

													</form>

												</div>
												<?php }else{
                     echo '<center><a href="quotation_type?id='."$event_id".'" class="btn btn-sm btn-info" style="margin-top: 30px; margin-bottom:30px">Add Quotation&nbsp;<i class="fas fa-folder-plus"></i></a></center>';
                  }
}
                  ?>
											</div>
										</section><!-- /.content -->
										<!--End OF tABLE-->
									</div>
									<!--------------------------------------------------------------------------------------------Task assignments--------------------------->
									<div class="tab-pane" id="tab_default_2">
										<section class="content">


											<a role="button" data-toggle="modal" data-target="#taskass<?php  $_GET['id']; ?>" class="btn btn-success btn-sm" style="margin-bottom:8px;"><i class="fas fa-plus"></i>&nbsp;Add task</a>

											<div class="box">
												<div class="box-body table-responsive">
													<form method="post">
														<table id="table" class="table  table-striped">
															<thead>
																<tr>
																	<th style="width: 20px !important;">No.</th>
																	<th>Task Description</th>
																	<th>Assigned To</th>
																	<th>Start Date</th>
																	<th>End Date</th>
																	<th>Progress</th>

																	<th>Edit Task</th>
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
                                            $query  = "SELECT * FROM tbltasks  WHERE company='$compp' AND event_id='$event_id'";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                     $task_id=$row['id'];
		
                                            echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['task_name']).'</td>
                                                <td>'.ucwords($row['employee_name']).'</td>  
                                                <td>'.$row['start_date'].'</td>
                                                <td>'.ucwords($row['end_date']).'</td>
                                                <td>'.$row['task_progress'].'%</td>
                                               
                                                 <td><center><a role="button" data-toggle="modal" data-target="#editask'.$task_id.'"class="btn btn-success"><i class="fas fa-edit"></i></a></center></td>
                                                <td><center><a onclick="return confirm(\'Are you sure you want to delete this task?\')" href="delete_task.php?id='."$task_id".'" class="btn btn-danger" ><i class="fas fa-trash"></i></a></center></td>
                                              
                                                </tr>
                                                ';
                                                // include "addquote.php";
                                                include "eventModals.php";
                                                
                                            }
                                            ?>
															</tbody>
														</table>

														<!--?php include "../deleteModal.php"; ?-->

													</form>






												</div>
											</div>
										</section><!-- /.content -->
									</div>
									<!--------------------------------------------------------------------------------Invoice pane----------------------------------------------------------------------------->

									<div class="tab-pane" id="quotation">
										<section class="content">
											<div class="box">
												<?php
                          
                          $sele =mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
                        
                          if($sele){
                              $numz =mysqli_num_rows($sele);
                              if($numz > 0){
                              ?>

												<div class="box-body table-responsive">
													<div class="form-row">

														<a class="btn btn-success btn-sm form-group" style="margin-top:10px;margin-bottom:30px;" href="print-invoice?id=<?php echo $event_id ?>" target="_blank"><i class="fas fa-print"></i>&nbsp;Print</a>
														<!---Check if Invoice has been paid or not-->
														<?php
														$rook=mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id'");
													
															$no_rook =mysqli_num_rows($rook);
														
														
															if($no_rook == 0){?>
														<!--if not paid, give option to pay for the invoice-->

														<a class="btn btn-info btn-sm form-group" style="margin-top:10px;margin-bottom:30px;" href="lease-invoice?id=<?php echo $event_id ?>" target="_blank">Pay <i class="fas fa-file-invoice"></i></a>
														<?php }else{ ?>

														<!--If paid, display invoice status as paid-->
														<a class="btn btn-info btn-sm form-group" style="margin-top:10px;margin-bottom:30px;" target="_blank" disabled><strong><span style="color:#fefefe!important;">Status : Paid <i class="fas fa-check-double" style="color: green!important"></i></span></strong></a>

														<?php } ?>



													</div>
													<form method="post" style="box-shadow: 5px 5px 5px 5px  #888888; padding:10px;">
														<div class="row" style="margin-bottom:20px!important;">
															<div class="col-lg-2 col-md-2 col-sm-2">
																<?php
															   $img=mysqli_query($con,'select * from tblstaff WHERE company = "'.$_SESSION['company'].'"  ');
        $image = mysqli_fetch_array($img);
        if($image['profile_img']!=''){
            $i = $image['profile_img'];
        }else{
           $i = "8f64ad76980a7e3b35d084a6d67c96c5.jpg"; 
        }
								  
								  ?>
																<img height="120" width="120" src="../logos/<?php echo $i; ?>">

															</div>
															<div class="col-lg-10 col-md-10 col-sm-10">
																<?php
                                            $e =mysqli_query($con,"SELECT distinct event_id, company FROM event_quotation WHERE event_id='$event_id'");
                                                         while($comp =mysqli_fetch_assoc($e)){
                                                              $company=$comp['company'];
                                            $c =mysqli_query($con,"SELECT * FROM tblstaff WHERE company='$company'");
                                                         while($r =mysqli_fetch_assoc($c)){
                                                              $compname=$r['companyname'];
                                                              $location=$r['location'];
                                                              $email=$r['email'];
                                                              $contact=$r['contact'];
                                                              echo '<h3 style="font-family:fangsong!important;"><strong><center>'.ucwords($compname).'</center></strong></h3> ';
                                                              echo '<h4 style="font-family:fangsong!important;"><strong><center>'.ucwords($location).'</center></strong></h4> ';
                                                              echo '<h4 style="font-family:fangsong!important;"><strong><center>'.$email.'</center></strong></h4> ';
                                                              echo '<h4 style="font-family:fangsong!important;"><strong><center>'.$contact.'</center></strong></h4> ';
                                                         }
                                                         }
                                                         ?>
																<h2><strong>
																		<center><u>INVOICE - INV<?php echo $event_id; ?></u></center>
																	</strong></h2>
															</div>
														</div>
														<table class="table  table-bordered">


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

														<!--?php include "../deleteModal.php"; ?-->

													</form>

												</div>
												<?php }else{
                     echo '<center><a href="quotation_type?id='."$event_id".'" class="btn btn-sm btn-info" style="margin-top: 30px; margin-bottom:30px">Add Quotation&nbsp;<i class="fas fa-folder-plus"></i></a></center>';
                  }
}
                  ?>
											</div>

										</section><!-- /.content -->
									</div>




									<!------------------------------------------------------------------------------------------------Start of items Leased Out Tab---->
									<div class="tab-pane " id="tab_default_3">
										<!---Insert Table-->
										<section class="content" style="width: 100%;height: 100%;">

											<div class="box">
												<div class="box-body table-responsive">
													<?php
													
													$sede=mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id'");
													$no_sede=mysqli_num_rows($sede);
													if($no_sede > 0){?>




													<form method="post">
														<table id="table" class="table  table-striped">
															<thead>
																<tr>
																	<th style="width: 20px !important;">No.</th>
																	<th>Item Name</th>
																	<th>Quantity</th>
																	<th>Event Start Date</th>
																	<th>Event End Date</th>
																	<th>Expected Return Date</th>
																	<th>Return Status</th>


																	<!--<th style="width:40px">Edit</th>-->
																	<!--<th style="width:40px">View</th>-->
																</tr>
															</thead>
															<tbody>
																<?php
                                            $c=1;
                                            $task=0;
                                            $date=date("Y-m-d");
                                            $query  = "SELECT * FROM event_quotation WHERE company='$compp' AND event_id='$event_id'";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                      $eventt_id = $row['id'];
                                                      $event_name=$row['event_name'];
                                                      $cust_name=$row['customer_name'];
                                                      $event_item_id =$row['event_item'];
                                                      $return_status=$row['return_status'];
                                                      if(empty($return_status)){
                                                          $retunn ='<span class="text-danger" style="font-family:fangsong; font-weight:600;">PENDING</span>';
                                                      }elseif($return_status =='returned'){
                                                          $retunn='<span class="text-success" style="font-family:fangsong; font-weight: 600;">RETURNED</span>';
                                                      }
                                                    $sqq60 =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$event_item_id'");
                                                    while($data40 = mysqli_fetch_array($sqq60)){
                                                        $item_namey = $data40['item_name'];
                                                    }
                                                      $sqwe =mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event_id'");
                                                      if($sqwe){
                                                          while($dat = mysqli_fetch_assoc($sqwe)){
                                                              $startt_date =$dat['start_date'];
                                                              $endd_date =$dat['end_date'];
                                                          }
                                                      }

                                          ?>
																<tr>
																	<td><?php echo $c++; ?></td>
																	<td><?php echo $item_namey; ?></td>
																	<td><?php echo $row['event_quantity']; ?></td>
																	<td><?php echo $startt_date; ?></td>
																	<td><?php echo $endd_date; ?></td>
																	<td><?php echo $endd_date; ?></td>
																	<td><?php echo $retunn; ?></td>



																</tr>




																<?php  }
                                            ?>
															</tbody>
														</table>

														<!--?php include "../deleteModal.php"; ?-->

													</form>
													<?php }else{ 
														if($qtype=='Internal'){
													?>

													<h4 style="font-family:fangsong!important;" class="text-center"><em>The quotation has to be approved before any items are leased out</em></h4>
													<?php }if($qtype =='External'){ ?>
													<h4 style="font-family:fangsong!important;" class="text-center"><em>The quotation has to be approved so that the items needed for the event are acquired</em></h4>
													<?php } ?>
													<center><a class="btn btn-sm btn-info" href="approve_quotation?id=<?php echo $event_id; ?>">Approve Quotation </a></center>


													<?php } ?>






												</div>
											</div>
										</section><!-- /.content -->
										<!--End OF tABLE-->
									</div>
									<!------------>
									<!--------Start Returned Items Tab--------------------------->

									<div class="tab-pane " id="tab_default_4">
										<?php $event_iddd = $_GET['id'] ;?>
										<!---Insert Table-->
										<section class="content" style="width: 100%;height: 100%;">

											<div class="box">


												<div class="box-body table-responsive">
													<?php
													
													$sed=mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id'");
													$no_sed=mysqli_num_rows($sed);
													if($no_sed > 0){?>


													<?php include "edit_item_status.php"; ?>
													<a class="btn  btn-info btn-sm" role="button" data-toggle="modal" data-target="#edititemstatus<?php echo $event_iddd ;?>" style="margin-top:30px; margin-bottom:30px;">Add returned item&nbsp;<i class="fas fa-plus"></i></a>
													<form method="post">
														<table id="table" class="table  table-striped">
															<thead>
																<tr>
																	<th style="width: 20px !important;">No.</th>
																	<th>Item Name</th>
																	<th>Quantity Leased</th>
																	<th>Quantity in Good Condition</th>
																	<th>Quantity Damaged</th>
																	<th>Return Date</th>
																	<th>Status</th>

																	<!--<th style="width:40px">Edit</th>-->
																	<!--<th style="width:40px">View</th>-->
																</tr>
															</thead>
															<tbody>
																<?php
                                            $c=1;
                                            $task=0;
                                            $date=date("Y-m-d");
                                            $queryy  = "SELECT * FROM event_items WHERE company='$compp' AND event_id='$event_iddd'";
                                            $result = mysqli_query($con, $queryy);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                     $item_name3 =$row['event_item'];
                                                     $damage_stat =$row['damage_status'];
                                                     if($damage_stat =='damaged'){
                                                         $sed ='<span class="text-danger" style="text-transform:uppercase;font-family:fangsong; font-weight:600;">NOT CLEARED</span>';
                                                     }
                                                      elseif($damage_stat =='notdamaged'){
                                                         $sed ='<span class="text-success" style="text-transform:uppercase; font-family:fangsong font-weight:600;">CLEARED</span>';
                                                     }
                                                    
                                                    $sqq67 =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$item_name3' AND company='$compp'");
                                                    while($data409 = mysqli_fetch_array($sqq67)){
                                                        $itemmy_namez = $data409['item_name'];
                                                    }
                                                      

                                            echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($itemmy_namez).'</td>
                                                <td>'.ucwords($row['original_quantity']).'</td> 
                                                <td>'.ucwords($row['good_condition']).'</td> 
                                                <td>'.ucwords($row['damage_quantity']).'</td> 
                                               <td>'.ucwords($row['return_date']).'</td>  
                                                <td>'.ucwords($sed).'</td> 
                                               
                                                                                  
                                                </tr>
                                                ';
                                              
                                               
                                                
                                            }
                                            ?>
															</tbody>
														</table>

														<!--?php include "../deleteModal.php"; ?-->

													</form>



													<?php }else{ 
														if($qtype=='Internal'){
													?>

													<h4 style="font-family:fangsong!important;" class="text-center"><em>The quotation has to be approved before any items are leased out</em></h4>
													<?php }if($qtype =='External'){ ?>
													<h4 style="font-family:fangsong!important;" class="text-center"><em>The quotation has to be approved so that the items needed for the event are acquired</em></h4>
													<?php } ?>
													<center><a class="btn btn-sm btn-info" href="approve_quotation?id=<?php echo $event_id; ?>">Approve Quotation </a></center>

													<?php  } ?>

												</div>
											</div>
										</section><!-- /.content -->
										<!--End OF tABLE-->
									</div>
									<!---->


									<!--------Start Damaged  Items Tab--------------------------->

									<div class="tab-pane " id="tab_default_6">
										<!---Insert Table-->
										<section class="content" style="width: 100%;height: 100%;">

											<div class="box">


												<div class="box-body table-responsive">
													<?php
														$reok=mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id'");
													
															$no_reok =mysqli_num_rows($reok);
														
														
															if($no_reok > 0){?>

													<form method="post">
														<table id="table" class="table  table-striped">
															<thead>
																<tr>

																	<th>Item Name</th>
																	<th>Quantity Damaged </th>


																	<!--<th style="width:40px">Edit</th>-->
																	<!--<th style="width:40px">View</th>-->
																</tr>
															</thead>
															<tbody>
																<?php
                                            $c=1;
                                            $task=0;
                                            $date=date("Y-m-d");
                                            $queryy  = "SELECT * FROM event_items WHERE company='$compp' AND event_id='$event_id' AND damage_status='damaged'";
                                            $result = mysqli_query($con, $queryy);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                      
                                                     $itemm_id =$row['event_item'];
                                                    $sqq670 =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$itemm_id'");
                                                    while($data4 = mysqli_fetch_array($sqq670)){
                                                        $itemmy_name = $data4['item_name'];
                                                    }
                                                      

                                            echo '
                                            <tr>
                                                
                                                <td>'.ucwords($itemmy_name).'</td>
                                                <td>'.ucwords($row['damage_quantity']).'</td> 
                                                
                                               
                                                                                  
                                                </tr>
                                                ';
                                              
                                               
                                                
                                            }
                                            ?>
															</tbody>
														</table>

														<!--?php include "../deleteModal.php"; ?-->

													</form>


													<?php }else{ 
														if($qtype=='Internal'){
													?>

													<h4 style="font-family:fangsong!important;" class="text-center"><em>The quotation has to be approved before any items are leased out</em></h4>
													<?php }if($qtype =='External'){ ?>
													<h4 style="font-family:fangsong!important;" class="text-center"><em>The quotation has to be approved so that the items needed for the event are acquired</em></h4>
													<?php } ?>
													<center><a class="btn btn-sm btn-info" href="approve_quotation?id=<?php echo $event_id; ?>">Approve Quotation </a></center>


													<?php } ?>



												</div>
											</div>
										</section><!-- /.content -->
										<!--End OF tABLE-->
									</div>
									<!--------Start Participants Tab--------------------------->

									<div class="tab-pane " id="tab_default_7">
										<!---Insert Table-->
										<section class="content" style="width: 100%;height: 100%;">

											<div class="box">


												<div class="box-body table-responsive">
													<table class="table">
														<thead>
															<th width="15px">#</th>
															<th>Name</th>
														</thead>
														<tbody>
															<?php
                                                   $date=date("Y-m-d");
                                            $quer_ts  = "SELECT * FROM tbltasks  WHERE company='$compp' AND event_id='$event_id'";
                                            $result_s = mysqli_query($con, $quer_ts);
                                            $k =1;
                                                while ($row_s = mysqli_fetch_array($result_s))
                                                  { 
                                                   
                                                
                                                    echo '<tr>
                                                    <td>'.$k++.'</td>
                                                     <td>'.ucwords($row_s['employee_name']).'</td>                                              </tr>';
                                                  }
                                                  ?>
														</tbody>

													</table>


												</div>
											</div>
										</section><!-- /.content -->
										<!--End OF tABLE-->
									</div>

									<!--  -->




								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!--=========================================================================================================================-->



		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
	<!--Task Modal-->
	<div id="taskass<?php echo $row['id'];?>" class="modal fade">
		<form method="post" action="" enctype="multipart/form-data">
			<div class="modal-dialog modal-sm" style="width:400px !important;">
				<div class="modal-content">
					<div class="modal-header" style="">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<div class="pull-left image">
							<img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px" />
						</div>
						<h4 class="modal-title">
							<center>Task Assignments</center>
						</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<strong>
									<h4 class="text-center font-weight-bold" style="font-family:fangsong; margin-bottom:30px!important"><?php echo $row['customer_name'];?>&nbsp;<?php echo $row['event_name']; ?></h4>
								</strong>
								<input type="hidden" name="event_name" value="<?php echo $row['event_name'];?>">
								<input type="hidden" name="event_id" value="<?php echo $_GET['id'];?>">


								<div class="form-group">
									<label>Task Description</label>
									<textarea name="task_name" rows="3" class="form-control"></textarea>

								</div>

								<div class="form-group">


									<label>Select Employee</label>
									<select name="employee_id" class="form-control">
										<option disabled selected>Employees:</option>
										<?php 

                $sp=mysqli_query($con,"SELECT * FROM tblusers WHERE company='$compp'");
                if($sp){
                  
                while ($row = mysqli_fetch_assoc($sp)){
                   
                    
            ?>
										<option value="<?php echo $row['id']; ?>"><?php echo $row['full_name'];?></option>
										<?php }} ?>
									</select>

								</div>
								<div class="form-group">
									<label>Role</label>
									<select class="form-control" name="task_role">
										<option disabled selected>Select Role</option>
										<option value="event_leader">Event Leader</option>
										<option value="other">Other</option>
									</select>
								</div>
								<div class="form-group">
									<label>Start Date</label>
									<input required name="start_date" id="started" class="form-control" style="width: 100%" type="date" />
								</div>


								<div class="form-group">
									<label>Deadline</label>
									<input required name="dead_line" id="deadline" class="form-control" style="width: 100%" type="date" />
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel" />
							<input type="submit" class="btn btn-primary btn-sm" name="btn_add_event_task" value="Save" />
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!------------------------------------------Edit Task Modal------------------->


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

	<script type="text/javascript">
		function approveConfirm(id) {
			var r = confirm("You are about to generate invoice. This action will automatically approve this quotation.");
			if (r == true) {
				window.location = "approve_quotation.php?id=" + id;
			}
		}

	</script>

	<script type="text/javascript">
		function deleteConfirm(id) {
			var r = confirm("Are you sure you want to Delete this quotation?");
			if (r == true) {
				window.location = "delete_quotation.php?id=" + id;
			}
		}

	</script>

	<script>
		$(document).ready(function() {
			// updating the view with reminder using ajax
			function load_unseen_reminder(view = '') {
				$.ajax({
					url: "fetch.php",
					method: "POST",
					data: {
						view: view
					},
					dataType: "json",
					success: function(data) {
						$('.dropdown-menu').html(data.reminder);
						if (data.unseen_reminder > 0) {
							$('.count').html(data.unseen_reminder);
						}
					}
				});
			}
			load_unseen_reminder();
			// submit form and get new records
			$('#comment_form').on('submit', function(event) {
				event.preventDefault();
				if ($('#subject').val() != '' && $('#comment').val() != '') {
					var form_data = $(this).serialize();
					$.ajax({
						url: "insert.php",
						method: "POST",
						data: form_data,
						success: function(data) {
							$('#comment_form')[0].reset();
							load_unseen_reminder();
						}
					});
				} else {
					alert("Both Fields are Required");
				}
			});
			// load new reminder
			$(document).on('click', '.dropdown-toggle', function() {
				$('.count').html('');
				load_unseen_reminders('yes');
			});
			setInterval(function() {
				load_unseen_reminder();;
			}, 5000);
		});

	</script>
	<script>
		$(document).ready(function() {
			$("#myInput").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#myTable ").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
		//  $(document).ready(function () {
		//       $('select').selectize({
		//           sortField: 'text'
		//       });
		//   });

	</script>
	<script>
		$('.custom_select').change(function() {
					if (($(this).val() == 'damaged') {
							$('.showcontent1').show();

						} else {

							$('.showcontent1').hide();
						}
					});

	</script>


	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
</body>

</html>
