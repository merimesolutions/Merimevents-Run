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
  .sidebar-menu .invoices{
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
                        <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp; 
                        <a class="" style="margin-top:10px;margin-bottom:30px;" href="print-quotation?id=<?php echo $event_id ?>" target="_blank"><i class="fas fa-print"></i>&nbsp;Print</a>
                </section>
      <!--=======================================================================================================================-->
      <div class="container-fluid">
    <div class="row">
		<div class="col-md-12">

					<div class="box">
						<div class="tab-pane active" id="quotation">
						 <section class="content">
                       <div class="">
                          <?php
                          
                          $sele =mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
                        
                          if($sele){
                              $numz =mysqli_num_rows($sele);
                              if($numz > 0){
                              ?>
                          
                        <div class="box-body table-responsive"> 
                        <div class="form-row">
                            
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
                                                     <h2><strong><center>INVOICE - INV<?php echo $event_id; ?></center></strong></h2>   
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

        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
function goBack() {
           window.history.back();
           }
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
   

	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    </body>
</html>