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
$swei =mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event_id'");
if($swei){
    while($row =mysqli_fetch_assoc($swei)){
        $ename=$row['event_name'];
        $custname=$row['customer_name'];
    }
}
 //add Tasks Modal guy
 if(isset($_POST['btn_add_event_task'])){
     $employee_name =$_POST['employee_name'];
     $task_name=$_POST['task_name'];
     $task_role=$_POST['task_role'];
     $start_date =$_POST['start_date'];
     $end_date=$_POST['dead_line'];
     $event_name=$_POST['event_name'];
     $event_id=$_POST['event_id'];
    
     
     //GET employee id and validate employee name
     $smp =mysqli_query($con, "SELECT * FROM tblusers WHERE full_name='$employee_name' AND company='$compp'");
    
     if($smp){
         $no_no =mysqli_num_rows($smp);
         if($no_no == 0){
             $name_err ="There is no staff member by that name";
         }
         while($er =mysqli_fetch_assoc($smp)){
             $employee_id =$er['id'];
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
             echo '<script>alert("Task Assigned successfully")window.location="events.php";</script>';
         }else{
             $errx =mysqli_error($con);
             echo'<script>alert("'."$errx".' ");window.location="events.php";</script>';
         }
     
     
     }
         if(!empty($name_err)){
            echo'<script>alert("'."$name_err".' ");window.location="events.php";</script>';  
          
         }
         if(!empty($err_of)){
       echo'<script>alert("'."$err_of".' ");window.location="events.php";</script>';  
         }
         
    
 
     }
 
?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <?php include('../head_css.php'); ?>
    <style type="text/css">
.panel:hover {
  background-color: lightblue;}
  .sidebar-menu .events{
        background-color:#009999;
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
                 <a class="btn btn-primary btn-sm form-group" href="events.php"><i class="fas fa-arrow-up">&nbsp;Back</i></a>
                 </div>
                </section>
      <!--=======================================================================================================================-->
      <div class="container-fluid">
    <div class="row">
		<div class="col-md-12">
		    <h3 class="text-center margin-top-4 margin-bottom-5" style="color:teal; text-transform:uppercase; margin-bottom: 50px"><?php echo $custname; ?>&nbsp;<?php echo $ename; ?></h3>
		
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
                                Participants
                            </a>
                        </li>
					
						
						
					</ul>
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
                              $y =mysqli_num_rows($e);
                              if($y > 0){
                                                    
                                                    echo '<H2>Approved Quotation</h2><hr>';     
                                  
                              }else{
                                echo '
                        <a class="btn btn-success btn-sm form-group" style="margin-top:30px;margin-bottom:30px;" href="edit_quotation.php?id='.$event_id.'"><i class="fas fa-edit"></i>&nbsp;Edit Quotation</a>';
                        echo '<a class="btn btn-info btn-sm form-group" style="margin-top:30px;margin-bottom:30px;" onclick="approveConfirm('.$event_id.'); " href="javascript:void(0);" ><i class="fas fa-save"></i>&nbsp;Approve Quotation</a>';
                         echo '<a class="btn btn-danger btn-sm form-group" style="margin-top:30px;margin-bottom:30px;" onclick="deleteConfirm('.$event_id.'); " href="javascript:void(0);"><i class="fas fa-trash"></i>&nbsp;Delete Quotation</a>
                        '; 
                            }
                                                         }
                       ?>
                        </div>
                            <form method="post">
                                    <table class="table  table-striped">
                                           <h4 >Cost of Items</h4>
                                
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Item</th>
                                                <th>Item Description</th>
                                                <th>Quantity</th>
                                                <th>Price per day</th>
                                                <th>No of Days</th>
                                                <th>Total (items)</th>
                                                
                                            
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
                                                    
                                                    
                                            echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($item_name).'</td>
                                                <td>'.ucwords($row['event_description']).'</td>  
                                                <td>'.ucwords($row['event_quantity']).'</td>
                                                <td>'.ucwords($row['event_single_price']).'</td>
                                                <td>'.ucwords($row['event_days']).'</td>
                                                <td>'.ucwords($row['total_items']).'</td>  
                                              
                                                  
                                               
                                                                                  
                                                </tr>
                                                ';
                                                // include "addquote.php";
                                               
                                                
                                            }
                                             echo'
                                            <tr>
                                                <td>Total</td> 
                                              <td></td>
                                                <td></td>  
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>'.ucwords($total_items_cost).'</td>  
                                           
                                                  
                                               
                                                                                  
                                                </tr>
                                            ';
                                            
                                            ?>
                                            
                                        </tbody>
                                        </table>
                                    
                                        <table class="table  table-striped" style="margin-top:30px;">
                                        <h4 >Additional Costs</h4>
                                
                                        <thead>
                                        
                                          <tr>
                                              <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Item</th>
                                                <th>Item Description</th>
                                                <th>Quantity</th>
                                                <th>Unit price</th>
                                                <th>Total (costs)</th>
                                                
                                                
                                            
                                                <!--<th style="width:40px">Edit</th>-->
                                                <!--<th style="width:40px">View</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $d=1;
                                            $task=0;
                                            $date=date("Y-m-d");
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
                                                           
                                                        
                                            ?>
                                            <tr>
                                                <td><?php echo $d++; ?></td> 
                                                <td><?php echo $row['cost_name']; ?></td>
                                                 <td><?php echo $row['cost_description']; ?></td>
                                                  <td><?php echo $quan_quantity; ?></td>
                                                  <td><?php echo $row['costperunit']; ?></td>
                                                  <td><?php echo $total_price; ?></td>
                                                
                                                </tr>
                                              
                                                
                                                
                                          <?php   }}?>
                                           
                                            <tr>
                                                <td>Total</td> 
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo $total_add_costs; ?></td>  
                                           
                                                  
                                               
                                                                                  
                                                </tr>
                                            
                                            
                                        </tbody>
                                    </table>
                                    
                                        <table class="table  table-striped" style="margin-top:30px">
                                            <h4>Total Cost</h4>
                                 <?php
                                 $overall_total =$total_add_costs + $total_items_cost;
                                 $d=1;
                                 ?>
                                
                                        <thead>
                                        
                                          
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Total items Cost</th>
                                                <th>Total Additional Costs</th>
                                                <th>Overall Total Costs</th>
                                               
                                                
                                            
                                                <!--<th style="width:40px">Edit</th>-->
                                                <!--<th style="width:40px">View</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                          
                                                        
                                            echo '
                                            <tr>
                                                <td>'.$d++.'</td> 
                                                <td>'.ucwords($total_items_cost).'</td>
                                                <td>'.ucwords($total_add_costs).'</td>  
                                                 <td>'.ucwords($overall_total).'</td>  
                                                 
                                                  
                                               
                                                                                  
                                                </tr>
                                                ';
                                                
                                                
                                          
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    </form>

           


        

                  </div>
                  <?php }else{
                     echo '<center><a href="add_quote2.php?id='."$event_id".'" class="btn btn-lg btn-info" style="margin-top: 30px; margin-bottom:30px">Add Quotation&nbsp;<i class="fas fa-folder-plus"></i></a></center>';
                  }
}
                  ?>
                </div>
               </section><!-- /.content -->
               <!--End OF tABLE-->
						</div>
						<div class="tab-pane" id="tab_default_2">
						 <section class="content">
						    
                
                   <a role="button" data-toggle="modal" data-target="#taskass<?php  $_GET['id']; ?>" class="btn btn-success" style="margin-bottom:8px;"><i class="fas fa-plus"></i>&nbsp;Add task</a>
                        
                      <div class="box">
                        <div class="box-body table-responsive">       
                            <form method="post">
                                    <table id="table" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Task Name</th>
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
                            
                        <a class="btn btn-success btn-sm form-group" style="margin-top:10px;margin-bottom:30px;" href="print-quotation?id=<?php echo $event_id ?>" target="_blank"><i class="fas fa-print"></i>&nbsp;Print</a>
                        </div>
                            <form method="post" style="box-shadow: 5px 5px 5px 5px  #888888; padding:10px;">
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
                                                              echo '<h3><center>'.ucwords($compname).'</center></h3> ';
                                                              echo '<h4><center>'.ucwords($location).'</center></h4> ';
                                                              echo '<h5><center>'.$email.'</center></h5> ';
                                                              echo '<h5><center>'.$contact.'</center></h5> ';
                                                         }
                                                         } 
                                                         ?>
                                                     <h2><strong><center>INVOICE</center></strong></h2>   
                                    <table class="table  table">
                                           <h4 >Cost of Items</h4>
                                
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;">No</th>
                                                <th>Item</th>
                                                <th>Item Description</th>
                                                <th>Quantity</th>
                                                <th>Price/Day</th>
                                                <th>No of Days</th>
                                                <th>Total (items)</th>
                                                
                                            
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
                                                    
                                                    
                                            echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($item_name).'</td>
                                                <td>'.ucwords($row['event_description']).'</td>  
                                                <td>'.ucwords($row['event_quantity']).'</td>
                                                <td>'.ucwords($row['event_single_price']).'</td>
                                                <td>'.ucwords($row['event_days']).'</td>
                                                <td>'.number_format($row['total_items'],2).'</td>  
                                              
                                                  
                                               
                                                                                  
                                                </tr>
                                                ';
                                                // include "addquote.php";
                                               
                                                
                                            }
                                             echo'
                                            <tr>
                                                <td></td> 
                                              <td></td>
                                                <td></td>  
                                                <td></td>
                                                <td></td>
                                                <th>Total</th>
                                                <th>'.number_format($total_items_cost,2).'</th>  
                                                </tr>
                                            ';
                                            
                                            ?>
                                            
                                        </tbody>
                                        </table>
                                    
                                        <table class="table  table" style="margin-top:30px;">
                                        <h4 >Additional Costs</h4>
                                
                                        <thead>
                                        
                                          <tr>
                                                      <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Item</th>
                                                <th>Item Description</th>
                                                <th>Quantity</th>
                                                <th>Unit price</th>
                                                <th>Total (costs)</th>
                                                
                                                
                                            
                                                <!--<th style="width:40px">Edit</th>-->
                                                <!--<th style="width:40px">View</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $d=1;
                                            $task=0;
                                            $date=date("Y-m-d");
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
                                                           
                                                        
                                            ?>
                                            <tr>
                                                <td><?php echo $d++; ?></td> 
                                                <td><?php echo $row['cost_name']; ?></td>
                                                 <td><?php echo $row['cost_description']; ?></td>
                                                  <td><?php echo $quan_quantity; ?></td>
                                                  <td><?php echo $row['costperunit']; ?></td>
                                                  <td><?php echo $total_price; ?></td>
                                                
                                                </tr>
                                              
                                                
                                                
                                          <?php   }}?>
                                           
                                            <tr>
                                                <td></td> 
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <th>Total</th>
                                                <th><?php echo $total_add_costs; ?></th>  
                                                </tr>
                                            
                                        </tbody>
                                    </table>
                                    
                                        <table class="table  table" style="margin-top:30px">
                                            <h4>Total Cost</h4>
                                 <?php
                                 $overall_total =$total_add_costs + $total_items_cost;
                                 ?>
                                
                                        <tbody>
                                            <?php
                                            echo '
                                            <tr>
                                                <td>Total items Cost</td>
                                                <td>'.number_format($total_items_cost,2).'</td>
                                                </tr>
                                                <tr>
                                                <td>Total Additional Costs</td>
                                                <td>'.number_format($total_add_costs,2).'</td>
                                                </tr>
                                                <tr>
                                                <th>Overall Total Costs</th>
                                                 <th>'.number_format($overall_total,2).'</th>  
                                    
                                                </tr>
                                                ';
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    </form>

                  </div>
                  <?php }else{
                     echo '<center><a href="add_quote2.php?id='."$event_id".'" class="btn btn-lg btn-info" style="margin-top: 30px; margin-bottom:30px">Add Quotation&nbsp;<i class="fas fa-folder-plus"></i></a></center>';
                  }
}
                  ?>
                </div>
                  
                </section><!-- /.content -->
						</div>	
						
						
						
						
						<!-----Start of items Leased Out Tab---->
							<div class="tab-pane " id="tab_default_3">
						    <!---Insert Table-->
						 <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">  
                        <?php
                        $fam=mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id'");
                        if($fam){
                            $no_fam =mysqli_num_rows($fam);
                            if($no_fam == 0){
                                echo '<center><a href="add_quote2.php?id='."$event_id".'" class="btn btn-info ">Add Quotation&nbsp;<i class="fas fa-plus-square" style="margin-top:10px; margin-bottom:10px;"></i></a></center>';
                            }else{
                        
                        ?>
                        
                        
                            <form method="post">
                                    <table id="table" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
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

           


        
<?php } } ?>
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
                        $famy=mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id'");
                        if($famy){
                            $no_famy =mysqli_num_rows($famy);
                            if($no_famy == 0){
                                 echo '<center><a href="add_quote2.php?id='."$event_id".'" class="btn btn-info ">Add Quotation&nbsp;<i class="fas fa-plus-square" style="margin-top:10px; margin-bottom:10px;"></i></a></center>';
                            }else{
                        
                        ?>
                          <?php include "edit_item_status.php"; ?>
                        <a class="btn  btn-info" role="button" data-toggle="modal" data-target="#edititemstatus<?php echo $event_iddd ;?>" style="margin-top:30px; margin-bottom:30px;">Add returned item&nbsp;<i class="fas fa-plus"></i></a>
                            <form method="post">
                                    <table id="table" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
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

           


        <?php }} ?>

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
                        $famz=mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id'");
                        if($famz){
                            $no_famz=mysqli_num_rows($famz);
                            if($no_famz == 0){
                                echo '<center><a href="add_quote2.php?id='."$event_id".'" class="btn btn-info ">Add Quotation&nbsp;<i class="fas fa-plus-square" style="margin-top:10px; margin-bottom:10px;"></i></a></center>';
                            }else{
                        
                        ?>
                            <form method="post">
                                    <table id="table" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
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
                                                <td>'.$c++.'</td> 
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

           
<?php }}?>

        

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
                                                 <table class="table table-striped">
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
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Task Assignments</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <strong><h4 class="text-center font-weight-bold" style="font-family:fangsong; margin-bottom:30px!important"><?php echo $row['customer_name'];?>&nbsp;<?php echo $row['event_name']; ?></h4></strong>
             <input type="hidden" name="event_name" value="<?php echo $row['event_name'];?>"> 
            <input type="hidden" name="event_id" value="<?php echo $_GET['id'];?>">
 
            
                <div class="form-group">
                <label>Task Name</label>
                    <input name="task_name"  class="form-control input-sm" type="text" style="width:100%" value="" />
                   
                 </div> 
                  
                <div class="form-group">
 
        
                    <label>Select Employee</label>
                      <input type="text" class="form-control" name="employee_name"  list="employee" id="myInput" placeholder="Enter Staff Name" Required>
    <datalist id="employee" style="list-style:none!important;">
       <?php 
           
               
                $sp=mysqli_query($con,"SELECT * FROM tblusers WHERE company='$compp'");
                if($sp){
                  
                while ($row = mysqli_fetch_assoc($sp)){
                   
                    
            ?>
               
                <option  id="myTable" value="<?php echo $row['full_name'];
                ?>">
               
                  
                </option>
            <?php 
                }
                  
                }
                // While loop must be terminated
            ?>
        
    </datalist>
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
                        <input required name="dead_line" id="deadline" class="form-control" style="width: 100%" type="date"/>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_add_event_task" value="Save"/>
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
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>

<script type="text/javascript">
function approveConfirm(id){
var r = confirm("Are you sure you want to approve this quotation? This action makes the quotation uneditable and generates an invoice.");
  if (r == true) {
    window.location = "approve_quotation.php?id="+id;
  } 
}
</script>

<script type="text/javascript">
function deleteConfirm(id){
var r = confirm("Are you sure you want to Delete this quotation?");
  if (r == true) {
    window.location = "delete_quotation.php?id="+id;
  } 
}
</script>

<script>
$(document).ready(function(){
// updating the view with reminder using ajax
function load_unseen_reminder(view = '')
{
 $.ajax({
  url:"fetch.php",
  method:"POST",
  data:{view:view},
  dataType:"json",
  success:function(data)
  {
   $('.dropdown-menu').html(data.reminder);
   if(data.unseen_reminder > 0)
   {
    $('.count').html(data.unseen_reminder);
   }
  }
 });
}
load_unseen_reminder();
// submit form and get new records
$('#comment_form').on('submit', function(event){
 event.preventDefault();
 if($('#subject').val() != '' && $('#comment').val() != '')
 {
  var form_data = $(this).serialize();
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {
    $('#comment_form')[0].reset();
    load_unseen_reminder();
   }
  });
 }
 else
 {
  alert("Both Fields are Required");
 }
});
// load new reminder
$(document).on('click', '.dropdown-toggle', function(){
 $('.count').html('');
 load_unseen_reminders('yes');
});
setInterval(function(){
 load_unseen_reminder();;
}, 5000);
});
</script>
	<script>
$(document).ready(function(){
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