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
//Add Events PHP Code

if(isset($_POST['add_event'])){
    $event_name=$_POST['event_name'];
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];
    //  $customer_id=$_POST['customer_id'];
     $customer_name=$_POST['customer_name'];
    //  $resa=mysqli_query($con,"SELECT * tblcustomers WHERE customer_name ='$customer_name' AND company='$compp'");
    //  if($resa){
    //      while($rowz=mysqli_fetch_assoc($resa)){
    //          $customer_id =$rowz['id'];
    //      }
    //  }
    $sql09 =mysqli_query($con,"SELECT * FROM tblcustomers WHERE customer_name='$customer_name' AND company='$compp'");
    if($sql09){
          while($romp =mysqli_fetch_assoc($sql09)){
              $customer_id = $romp['id'];
          }
    }else{
    $connerr=mysqli_error($con);
     echo'<script>alert("'."$conerrr".'");</script>';
    }
    //check the existence of customer in the database
    // if(empty($_POST['customer_id'])){
    //     $cust_err="There is no record of customer: $customer_name in the system";
    // }
    $tk=mysqli_query($con,"SELECT * FROM tblcustomers WHERE customer_name='$customer_name' AND company='$compp'");
    if($tk){
        $number_custs =mysqli_num_rows($tk);
        if($number_custs < 1){
    $cust_err="There is no record of customer: $customer_name in the system";
}
    }

    
    // if(empty($_POST['customer_name'])){
    //     $cust_err ="There is no record of this customer:$customer_name in the system";
    // }
    //else{
    //      $customer_id=$_POST['customer_id'];
    //      $customer_name=$_POST['customer_name'];
    // }
    //check if the event already exists in the database
    $sqm=mysqli_query($con,"SELECT * FROM tblevents WHERE event_name='$event_name' AND customer_id='$customer_id' AND start_date='$start_date' AND end_date='$end_date'");
    if($sqm){
        $numm=mysqli_num_rows($sqm);
        if($numm > 0){
            $too_err="This event already exists in the database";
        }
    }
    //Insert Event if there is no error
    if(empty($cust_err) && empty($too_err)){
    $squery=mysqli_query($con,"INSERT INTO tblevents (event_name,start_date,end_date,customer_id,customer_name,company) VALUES('$event_name','$start_date','$end_date','$customer_id','$customer_name','$compp')");
    if($squery){
        echo '<script>alert("Event Added successfully");window.location="events.php"</script>';
    }else{
        $errr=mysqli_error($con);
          echo'<script>alert("'."$errr".'");</script>';
    }
}else{
   if(!empty($cust_err)){
    echo'<script>alert("'."$cust_err".'");</script>';
       
   }
   if(!empty($too_err)){
       echo'<script>alert("'."$too_err".'");</script>';
   }
    
}
}
//Comprehensive Customers
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

  $sql_u =mysqli_query($con, "SELECT * FROM tblcustomers WHERE identity = '$identity' and company='$company' ");
        if($sql_u){
            $numbb =mysqli_num_rows($sql_u);
            
        }
            if($numbb > 0){
            echo '<script>alert("This customer record already exists in the system!");window.location="events.php";</script>';
    }else{

          $sql=mysqli_query($con,"INSERT INTO tblcustomers(fname,mname,lname,gender,code,box,town,identity,phy_address,fcontact,scontact,email,b_c_name,b_c_location,company,customer_name) VALUES('$fname','$mname','$lname','$gender', '$code', '$box','$town', '$identity', '$phy_address','$fcontact','$scontact','$email','$b_c_name','$b_c_location','$company','$customer_name')");
                  
          if($sql){
                echo '<script>alert("Customer Registered succesfully");window.location="events.php";</script>';
          } else {
        
        echo '<script>alert("An error occured during submission");window.location="events.php";</script>';
          }

        
        }
          
      }
 //Simple Customer
 
 if(isset($_POST['btn_add_cutomer'])){
     $new_name =$_POST['new_cust_name'];
     $new_email=$_POST['new_cust_email'];
     $new_phone=$_POST['new_cust_phone'];
     $customer_name=$_POST['new_cust_name'];
     $identity=$_POST['identity'];
     
     $squery =mysqli_query($con,"SELECT * FROM tblcustomers WHERE customer_name='$customer_name' AND email='$email' AND (fcontact='$new_phone' || scontact='$new_phone' ");
     if($squery){
         $number_pe=mysqli_num_rows($squery);
     }
     if($number_pe > 0){
         echo '<script>alert("This customer record already exists!!");window.location="events.php";</script>';
     }else{
         $sl=mysqli_query($con,"INSERT INTO tblcustomers (fname,email,fcontact,customer_name,identity,company) VALUES ('$new_name', '$new_email', '$new_phone', '$customer_name', '$identity','$compp')");
         if($sl){
             echo'<script>alert("Customer Registered Succesfully.");window.location="events.php";</script>';
         }else{
             $errp=mysqli_error($con);
             echo'<script>alert(" '."$errp".'");window.location="events.php";</script>'; 
         }
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
                      <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                 <button class="btn btn-primary float-left" role="button" data-toggle="modal" data-target="#myModalzz">Add event</button>
                </section>
      <!--=======================================================================================================================-->
      <div class="container-fluid">
    <div class="row">
		<div class="col-md-12">
		
			<div class="tabbable-panel">
				<div class="tabbable-line">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_default_1" data-toggle="tab">
							Table View</a>
						</li>
						<li>
							<a href="#tab_default_2" data-toggle="tab">
							Card View</a>
						</li>
						
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_default_1">
						    <!---Insert Table-->
						  <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">       
                            <form method="post">
                                    <table id="table" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Event Name</th>
                                                <th>Customer</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Tasks Assignment</th>
                                                <th>Add Quotation</th>
                                                <th>Generate Invoice</th>
                                                <th>All Details</th>
                                            
                                                <!--<th style="width:40px">Edit</th>-->
                                                <!--<th style="width:40px">View</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $task=0;
                                            $date=date("Y-m-d");
                                            $query  = "SELECT * FROM tblevents WHERE company='$compp'";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                      $event_id = $row['id'];
                                                      $event_name=$row['event_name'];
                                                      $cust_name=$row['customer_name'];

                                            echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['event_name']).'</td>
                                                <td>'.ucwords($row['customer_name']).'</td>  
                                                <td>'.$row['start_date'].'</td>
                                                <td>'.ucwords($row['end_date']).'</td> 
                                                  <td><center><a data-target="#taskass'.$row['id'].'" data-toggle="modal" class="btn btn-success"><i class="fas fa-users"></i></a></center></td>
                                                  
                                                <td><center><a href="add_event_quotation.php?id='.$row['id'].' " class="btn" ><img src="../../images/icons/doc_edit.png" title="Edit this record" class="iconb"></a></center></td>
                                              
                                                <td><center><a href="print-quotation?id='.$row['id'].' " class="btn btn-info" target="_blank"><i class="fas fa-file-invoice"></i></a></center></td>
                                                <td><center><a href="view_event.php?id='.$row['id'].'" ><img src="../../images/icons/eye.png" title="Edit this record" class="iconb"></a></center></td>
                                                                                  
                                                </tr>
                                                ';
                                              
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
               <!--End OF tABLE-->
						</div>
						<div class="tab-pane" id="tab_default_2">
						 <section class="content">
                    
                    <div class="row">
                      
                <div class="main-content">
                    <div class="wrap-content container" id="container" style="width: 100%;height: 100%;">
                         <?php 
                       $sqn=mysqli_query($con,"SELECT * FROM tblevents WHERE company='$compp'");
                       if($sqn){
                           while($rom =mysqli_fetch_assoc($sqn)){
                       $e = $rom['id'];        
                        $q = mysqli_query($con,"SELECT * from tbltasks where event_id='$e' ");
                                            $all = mysqli_num_rows($q);
                        
                        $c = mysqli_query($con,"SELECT * from tbltasks where event_id='$e' and task_progress='100' ");
                                            $complete = mysqli_num_rows($c);
                       ?>
                        <div class="card-deck col-lg-3 col-xl-3 col-md-auto col-sm-12" style="background-color:#ffffff;border-radius:10px;shadow: 2px 2px;margin:10px;border: 1px solid;padding: 10px;box-shadow: 2px 4px;">
                          <div class="card">
                             <i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo ucwords($rom['start_date']); ?>
                             <span style="float:right;"><a href="view_event.php?id=<?php echo $rom['id']; ?>" class="badge badge-success" style="background-color:#ff751a;" >More information <i class="fa fa-ellipsis-v" aria-hidden="true"></i></a> </span>
                            <div class="card-body" style="clear:both;">
                              <h5 class="card-title"><strong>Event : <?php echo ucwords($rom['event_name']); ?></strong></h5>
                              <p class="card-text">Customer Name:<?php echo ucwords($rom['customer_name']);?></p>
                              
                            </div>
                            <p>Tasks done: <?php echo $complete ?>/<?php echo $all ?></p>
                            <div class="progress">
                            <?php 
                    $sn=mysqli_query($con,"SELECT event_id, SUM(task_progress) AS task FROM tbltasks WHERE event_id='".$rom['id']."'");
                       if($sn){
                           while($r =mysqli_fetch_assoc($sn)){
                 
                               $percentage = $r['task']/$all;
                               if($percentage>=80){
echo '<div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width:'.number_format($percentage,1).'%;background-color:green;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.number_format($percentage,1).'%</div>';
                        }
                        if($percentage>=50){
echo '<div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width:'.number_format($percentage,1).'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.number_format($percentage,1).'%</div>';
                        }
                        if($percentage<50 || $percentage= 0){
echo '<div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width:'.number_format($percentage,1).'%;background-color:red;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.number_format($percentage,1).'%</div>';
                        
                               }
                            
                           }  } ?>
                        </div>
                            <!--div class="card-footer">
                              <small class=""></small>
                            </div-->
                          </div>
                         </div>
                         <?php }  } ?>
                         
                        
                        </div>  
                        </div>
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
						</div>
					
						<!------------>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
     <!--=========================================================================================================================-->
        

               
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

<!---Add events Modal-->
<form method="post">
<div class="modal fade" id="myModalzz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title" style="color:teal; font-weight:bold;"><center>Add Event</center></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form">
              <label style="margin-top: 20px;">Event Name</label>
               <div class="input-group mb-2">
    <span class="input-group-addon bg-white border-right-0 px-4"><i class="fas fa-signature"></i></span>
    <input type="text" class="form-control bg-white border-left-0 " name="event_name" placeholder="Enter Event Name" Required>
  </div><br>
  <div class="input-group mb-2">
        <span class="input-group-addon bg-white border-right-0 px-4"><i class="fas fa-users"></i></span>   
      
        <input type="text" class="form-control" name="customer_name" value=""  list="cust" id="myInput" placeholder="Enter Customer Name" Required>
    <datalist id="cust" style="list-style:none!important;">
       <?php 
           
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                $sp=mysqli_query($con,"SELECT * FROM tblcustomers WHERE company='$compp'");
                if($sp){
                  
                while ($row = mysqli_fetch_assoc($sp)){
                    // $custom_id =$row['id'];
                    
            ?>
                  <!--<input type="hidden" name="customer_id" value="<?php echo $custom_id?>">-->
                <option  id="myTable" value="<?php echo $row['fname'].' '.$row['mname'].' '.$row['lname'];
            
                    // The value we usually set is the primary key
                ?>">
               
                  
                </option>
            <?php 
                }
                  
                }
                // While loop must be terminated
            ?>
        
    </datalist>
     
    </div>
    <label style="margin-top: 5px;"><button class="btn btn-sm btn-primary" role="button" data-toggle="modal" data-target="#addCust">Add New Customer <i class="fas fa-user-plus"></i></button></label>
   <br>
        <label style="margin-top: 20px;">Start Date</label>
               <div class="input-group mb-2">
    <span class="input-group-addon bg-white border-right-0 px-4"><i class="fas fa-calendar"></i></span>
    <input type="date" class="form-control bg-white border-left-0 " name="start_date" placeholder="Enter Begining Date" Required>
  </div>
    <label style="margin-top: 20px;">End Date</label>
               <div class="input-group mb-2">
    <span class="input-group-addon bg-white border-right-0 px-4"><i class="fas fa-calendar"></i></span>
    <input type="date" class="form-control bg-white border-left-0 " name="end_date" placeholder="Enter Begining Date" Required>
  </div>
         
          </div>
   
    
      </div>
      <div class="modal-footer">
          <button type="submit" name="add_event" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>


<!--End of Add events Modal-->

<!--Add Customer Modal-->

<div class="modal fade" id="addCust" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" style="width:450px !important;" >
    <div class="modal-content">
        <form method="post" action="" enctype="multipart/form-data">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="color:teal; font-weight:bold;"><center>New Customer</center></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Full Name</label>
                       <input type="text" class="form-control" name="new_cust_name" required>
                    </div>
                    <div class="form-group">
                        <label>National Identification No. / Passport</label>
                       <input type="text" class="form-control" name="identity" required>
                    </div>
                     <div class="form-group">
                        <label>Email Adress</label>
                       <input type="email" class="form-control" name="new_cust_email" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="new_cust_phone" required>
                    </div>
                  <div style="margin-bottom:10px!important;"><span class="text-warning font-weight-bold" >*<span style="color:black!important;"><em>Optional</em></span></span></div>
                    <div class="form-group">
                        <button role="button" data-toggle="modal" data-target="#AdditionalCustInfo" class="btn btn-success btn-sm">Add More Customer Details</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm"  name="btn_add_cutomer" value="Save"/>
        </div>
        </form>
        
    </div>
  </div>

</div>



<!--End of Customer Modal-->
<!--Comprehensive Customer Information Modal-->
<div class="modal fade" id="AdditionalCustInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="" enctype="multipart/form-data">
  <div class="modal-dialog modal-lg" style="width:100%!important;" >
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="color:teal; font-weight:bold;"><center> Add New Customer </center></h4>
        </div>
        <div class="modal-body">
             <div class="row"> 
                       <div class="box-body table-responsive">            
                   <!--div class="panel-heading"> 
                        </div-->
                            <div class="col-md-12 col-sm-12">
                              <div class="panel panel-default" style="">
                            
                                  <table class="table table-striped">
                                      <tr>
                                        <td colspan = "3">
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
                                            <input type="text" class="form-control" style="width:100%" name="fname"  required placeholder="Enter First Name" autocomplete="off" title="Enter First Name" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" style="width:100%" name="mname" placeholder="Enter Middle Name" autocomplete="off" title="Enter Middle Name">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" style="width:100%" name="lname"  required placeholder="Enter Last Name" autocomplete="off" title="Last First Name"required>
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
                                            <p>Box No.</p>   
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
                                            <input type="text" class="form-control" style="width:100%" name="box" placeholder="Enter Box number" autocomplete="off" title="Box number" pattern="[0-9]+">
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
                                            <input type="text" class="form-control" style="width:100%" name="identity"  required placeholder="Enter National Identification Number" autocomplete="off" title="National Identification Number"  pattern="[0-9]+" required>
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
                                            <input type="text" class="form-control" style="width:100%" name="fcontact"  required placeholder="Enter first contact number" autocomplete="off" title="Enter first contact number" maxlength="12" pattern="[0-9]+" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" style="width:100%" name="scontact"placeholder="Enter second contact number" autocomplete="off" title="Enter second contact number" maxlength="12" pattern="[0-9]+">
                                        </td>
                                        <td>
                                            <input type="email" class="form-control" style="width:100%" name="email" placeholder="Enter Email Address" autocomplete="off" title="Email Address"required>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width:">
                                            <p>Business / Company name</p>
                                        </th>
                                        <th>
                                            <p> Business / company location </p>   
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" style="width:100%" name="b_c_name" placeholder="Enter Business / Company name name" autocomplete="off" title="Enter Business / Company name">
                                        </td>

                                        <td>
                                            <input type="text" class="form-control" style="width:100%" name="b_c_location" placeholder="Enter business / company location" autocomplete="off" title="Business location">
                                        </td>
                                    </tr>
                                </table>                 
                              </div>
                          
                            </div>
                            </div>
                        
                            
                                    
                                  </div>
          

        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <button type="submit" class="btn btn-primary btn-sm"  name="btn_login" >Submit</button>
        </div>
    </div>
  </div>
  </form>
</div>


<!--End of comprehensive Customer Information Modal-->

        
        
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
<script>
function goBack() {
           window.history.back();
           }
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

   

	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    </body>
</html>