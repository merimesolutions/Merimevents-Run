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

          $mname        =$_POST['mname'];
          $lname        =$_POST['lname'];
          $gender       =$_POST['gender'];
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
          $company      =$_SESSION['company'];

  $sql_u = "SELECT * FROM tblcustomers WHERE identity = '$identity' and company='$company' ";
      $results = mysqli_query($con,$sql_u);
        if(mysqli_num_rows($results)>0){
            echo '<script type="text/javascript">'; 
                echo 'alert("The customer is already registered !!!");'; 
                echo 'window.location = "c.php";';
                echo '</script>';
    }else{

          $sql="insert into tblcustomers(fname,mname,lname,gender,code,box,town,identity,phy_address,fcontact,scontact,email,b_c_name,b_c_location,company) VALUES('$fname','$mname','$lname','$gender', '$code', '$box','$town', '$identity', '$phy_address','$fcontact','$scontact','$email','$b_c_name','$b_c_location','$company')";
                  
          if(mysqli_query($con, $sql)){
              echo '<script type="text/javascript">'; 
                echo 'alert("The customer is registered successfully.");'; 
                echo 'window.location = "ocr.php";';
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

    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
 
        <script>
$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>
        <?php include('../header.php'); ?>         
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <a href="setting.php" title="Go home"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go home"></i> Back</a>
                </section>
                                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
                              <span style="font-weight:bold;">Role: </span>
                    <?php
                        $squery = mysqli_query($con, "select * from tblroles where id='".$_GET['role']."' ");
                             while($row = mysqli_fetch_array($squery))
                                 {
                                    echo ucwords($row['role']);
                                  }
                                  
                                ?>
                <div id="exTab1" class="container table-responsive">	
                    <?php 
                    $sq = mysqli_query($con, "select * from tblstaff where company='".$_SESSION['company']."' ");
                             while($rw = mysqli_fetch_array($sq))
                                 {
                                 $package = $rw['package'];
                    ?>
                <ul class="nav nav-tabs" id="myTab">

                			<li class="nav-item ">
                             <a  href="#1a" data-toggle="tab"  class="active nav-link bg-info rounded">Dashboard</a>
                			</li>
                            <?php if($package == 1 ||  $package == 2 || $package == 3 || $package == 4){ echo '
                			<li class="nav-item ">
                			 <a href="#3a" data-toggle="tab" class="bg-info nav-link rounded">Customer</a>
                			</li>
                            '; }?>
                            <?php if($package == 2 || $package == 3){ echo '
                			<li class="nav-item ">
                			 <a href="#4a" data-toggle="tab" class="bg-info nav-link rounded">Leasing</a>
                			</li>'; }?>
                            <?php if($package == 1 ||  $package == 2 || $package == 3 || $package == 4 || $package == 5 || $package == 6){ echo '
                			<li class="nav-item ">
                			 <a href="#5a" data-toggle="tab" class="bg-info nav-link rounded">Collaborate</a>
                			</li>'; }?>
                            <?php if($package == 1 ||  $package == 2 || $package == 3){ echo '
                			<li class="nav-item ">
                			 <a href="#6a" data-toggle="tab" class="bg-info nav-link rounded">Events</a>
                			</li>'; }?>
                            <?php if($package == 2 || $package == 3){ echo '
                			<li class="nav-item "> 
                			 <a href="#7a" data-toggle="tab" class="bg-info nav-link rounded">Inventory</a>
                			</li>'; }?>
                            <?php if($package == 2 || $package == 3){ echo '
                			<li class="nav-item ">
                			 <a href="#8a" data-toggle="tab" class="bg-info nav-link rounded">Return Items</a>
                			</li>'; }?>
                            <?php if($package == 3){ echo '
                			<li class="nav-item ">
                			 <a href="#9a" data-toggle="tab" class="bg-info nav-link rounded">Penalties</a>
                			</li>'; }?>
                            <?php if($package == 1 ||  $package == 2 || $package == 3){ echo '
                			<li class="nav-item ">
                			 <a href="#10a" data-toggle="tab" class="bg-info nav-link rounded">Invoices</a>
                			</li>'; }?>
                            <?php if($package == 1 ||  $package == 2 || $package == 3 || $package == 4 || $package == 5 || $package == 6){ echo '
                			<li class="nav-item ">
                			 <a href="#11a" data-toggle="tab" class="bg-info nav-link rounded">Reports</a>
                			</li>'; }?>
                            <?php if($package == 1 ||  $package == 2 || $package == 3 || $package == 4 || $package == 5 || $package == 6){ echo '
                			<li class="nav-item ">
                			 <a href="#12a" data-toggle="tab" class="bg-info nav-link rounded">User Accounts</a>
                			</li>'; }?>
                            <?php if($package == 1 ||  $package == 2 || $package == 3){ echo '
                			<li class="nav-item ">
                			 <a href="#13a" data-toggle="tab" class="bg-info nav-link rounded">Settings</a>
                			</li>'; }?>
                
                		</ul>
                    <?php } ?>
                <hr>
                <?php
                 $squery = mysqli_query($con, "select * from tblroles where company='".$_SESSION['company']."' and id='".$_GET['role']."' ORDER BY id DESC");

                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                    
                                                    $r=$row['register'];
                                                
                                                    $l=$row['lease'];
                                                
                                                    $re=$row['returning'];
                                                
                                                    $i=$row['inventory'];
                                                 
                                                    $p=$row['penalty'];
                                                
                                                    $in=$row['invoice'];
                                                
                                                    $rep=$row['report'];
                    
                                                    $pr=$row['project'];
                                                    
                                                    $ev=$row['events'];
                                                
                                                    $u=$row['user'];
                                                    //end first one
                                                    $d_lease_items = $row['d_lease_items'];
                                                    $d_lease_invoice   = $row['d_lease_invoice '];
                                                    $d_damage_invoice   =  $row['d_damage_invoice '];
                                                    $d_overdue_invoice   =  $row['d_overdue_invoice '];
                                                    $d_leased_items   =  $row['d_leased_items '];
                                                    $d_stock_available   =  $row['d_stock_available '];
                                                    $d_damaged_items   =  $row['d_damaged_items '];
                                                    $d_overdue_report   =  $row['d_overdue_report '];
                                                    $d_returned_items   =  $row['d_returned_items '];
                                                    $d_customer  =  $row['d_customer'];
                                                    $d_my_tasks  =  $row['d_my_tasks'];
                                                    $d_reminder  =  $row['d_reminder'];
                                                    // end dashboard stories
                                                    $c_add_new_customer  =  $row['c_add_new_customer'];
                                                    $c_export_to_excel  =  $row['c_export_to_excel'];
                                                    $c_print  =  $row['c_print'];
                                                    $c_edit  =  $row['c_edit'];
                                                    $c_lease_items  =  $row['c_lease_items'];
                                                    //end customer
                                                    $l_add_new_customer  =  $row['l_add_new_customer'];
                                                    $l_customer_list  =  $row['l_customer_list'];
                                                    $l_invoice  =  $row['l_invoice'];
                                                    
                                                    $l_leased_items_report  =  $row['l_leased_items_report'];
                                                    $l_delete  =  $row['l_delete'];
                                                    $l_lease  =  $row['l_lease'];
                                                    //end leasing
                                                    
                                                    $my_add_mytask  =  $row['my_add_mytask'];
                                                    $my_edit  =  $row['my_edit'];
                                                    $my_view  =  $row['my_view'];
                                                    //end my task
                                                    $e_add_event  =  $row['e_add_event'];
                                                    $e_task_assigment  =  $row['e_task_assigment'];
                                                    $e_add_quotation  =  $row['e_add_quotation'];
                                                    $e_generate_invoice  =  $row['e_generate_invoice'];
                                                    $e_all_details  =  $row['e_all_details'];
                                                    // Events
                                                    $i_available_stock  =  $row['i_available_stock'];
                                                    $i_add_new_item  =  $row['i_add_new_item'];
                                                    $i_restock  =  $row['i_restock'];
                                                    $i_set_charges  =  $row['i_set_charges'];
                                                    //inventory
                                                    $r_return  =  $row['r_return'];
                                                    //return items
                                                    $p_damaged_items  =  $row['p_damaged_items'];
                                                    $p_overdue_items  =  $row['p_overdue_items'];
                                                    //penalties
                                                    $inv_leased_items  =  $row['inv_leased_items'];
                                                    $inv_damaged_items  =  $row['inv_damaged_items'];
                                                    $inv_overdue_charges  =  $row['inv_overdue_charges'];
                                                    //invoices
                                                    $r_sales_report  =  $row['r_sales_report'];
                                                    $r_available_items  =  $row['r_available_items'];
                                                    $r_leased_items  =  $row['r_leased_items'];
                                                    $r_damaged_items  =  $row['r_damaged_items'];
                                                    $r_returned_items  =  $row['r_returned_items'];
                                                    $r_reconciled_items  =  $row['r_reconciled_items'];
                                                    $r_projects_report  =  $row['r_projects_report'];
                                                    $r_cancelled  =  $row['r_cancelled'];
                                                    //Reports
                                                    $u_add_user  =  $row['u_add_user'];
                                                    $u_delete  =  $row['u_delete'];
                                                    $u_edit  =  $row['u_edit'];
                                                    //User Accounts
                                                    $sr_add_role  =  $row['sr_add_role'];
                                                    $sr_edit  =  $row['sr_edit'];
                                                    $sr_privileges  =  $row['sr_privileges'];
                                                    $su_add_user  =  $row['su_add_user'];
                                                    $su_edit  =  $row['su_edit'];
                                                    $sc_edit_company  =  $row['sc_edit_company'];
                                                    $sc_edit_payment  =  $row['sc_edit_payment'];
                                                    //End Settings
                                                    //Available stock
                                                    $av_restock  =  $row['av_restock'];
                                                    $av_set_charges  =  $row['av_set_charges'];
                                                    $av_export_to_excel  =  $row['av_export_to_excel'];
                                                    $av_print  =  $row['av_print'];
                                                    $av_add_stock  =  $row['av_add_stock'];
                                                    $av_reconcile  =  $row['av_reconcile'];
                                                    //Add new items to stock
                                                    $an_available_stock  =  $row['an_available_stock'];
                                                    //Restock Items
                                                    $ri_print  =  $row['ri_print'];
                                                    $ri_add  =  $row['ri_add'];
                                                    //Set charges
                                                    $sc_available_stock  =  $row['sc_available_stock'];
                                                    $sc_edit  =  $row['sc_edit'];
                                                    //Damaged Items
                                                    $di_export_to_excel  =  $row['di_export_to_excel'];
                                                    $di_clear  =  $row['di_clear'];
                                                    //start Overdue Items
                                                    $oi_clear  =  $row['oi_clear'];
                                                    //Leased items invoices
                                                    $li_receipt  =  $row['li_receipt'];
                                                    $li_generate  =  $row['li_generate'];
                                                    $li_pay  =  $row['li_pay'];
                                                    $li_cancel =  $row['li_cancel'];
                                                    //damaged Items Invoices
                                                    $di_print  =  $row['di_print'];
                                                    //Overdue Charges Invoices
                                                    $oc_receipt  =  $row['oc_receipt'];
                                                    $oc_preview  =  $row['oc_preview'];
            //connect with db
     $con =  mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die("connection failed" . mysqli_error());    
                                                    
                                                    ?>
			<div class="tab-content clearfix">
			  <div class="tab-pane active" id="1a">
          
                <div class="box-body table-responsive" style="overflow-y: auto;">
                                   <form method="post">
                                    <?php

	if(isset($_POST['update']))
	   {
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['register'];
	    $lease      = $_POST['lease'];
	    $return     = $_POST['return'];
	    $inventory  = $_POST['inventory'];
	    $penalty    = $_POST['penalty'];
	    $invoice    = $_POST['invoice'];
	    $report     = $_POST['report'];
	    $project    = $_POST['project'];
	    $events    = $_POST['event'];
	    $user       = $_POST['user'];
 
	       $query = mysqli_query($con,"UPDATE tblroles SET register = '".$register."',lease = '".$lease."',returning = '".$return."',inventory = '".$inventory."',penalty = '".$penalty."',invoice = '".$invoice."',report = '".$report."',project = '".$project."',user = '".$user."',events = '".$events."',d_lease_items='".$lease."',d_lease_invoice='".$lease."',d_damage_invoice='".$invoice."',d_overdue_invoice='".$invoice."' ,d_leased_items='".$lease."',d_stock_available='".$inventory."',d_damaged_items='".$inventory."',d_overdue_report='".$report."',d_returned_items='".$return."', d_customer='".$register."',d_my_tasks='".$project."' where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }

		if(mysqli_error($con)){
            // echo mysqli_error($con);
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
           // echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                            $sq = mysqli_query($con, "select * from tblstaff where company='".$_SESSION['company']."' ");
                             while($rw = mysqli_fetch_array($sq))
                                 {
                                 $package = $rw['package'];
                                                if($package == 1 ||  $package == 2 || $package == 3){
                                                
                                                echo '
                                                    <tr>
                                                <td>Customer Registration</td>
                                                
                                                <td>  <input type="checkbox" id="toggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="registers"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="register" id="register" value="'.$r.'"></td>
                                                      
                                                </tr>';
                                            }
                                               if($package == 2 || $package == 3){
                                                echo '
                                                <tr>
                                                <td>Leasing Items</td>
                                                 
                                                <td> <input type="checkbox" id="leases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="leases" data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="lease" id="lease" value="'.$l.'"></td>
                                                 
                                                </tr>';
                                            }
                                                if($package == 2 || $package == 3){
                                                echo '
                                                <tr>
                                                <td>Returning Items</td>
                                                 
                                                <td> <input type="checkbox" id="returns" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="return" id="return" value="'.$re.'"></td>
                                               
                                                </tr>';
                                            }
                                                if($package == 2 || $package == 3){
                                                echo '
                                                <tr>
                                                <td>Inventory management</td>
                                                 
                                                <td><input type="checkbox" id="inventories" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="inventory" id="inventory" value="'.$i.'"></td>
                                                 
                                                </tr>';
                                            }
                                                if($package == 3){
                                                echo '
                                                <tr>
                                                <td>Penalties</td>
                                                
                                                <td><input type="checkbox" id="penalties" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="penalty" id="penalty" value="'.$p.'"></td>
                                                
                                                </tr>';
                                            }
                                                if($package == 1 ||  $package == 2 || $package == 3){
                                                echo '
                                                <tr>
                                                <td>Invoices</td>
                                                 
                                                <td><input type="checkbox" id="invoices" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="invoice" id="invoice" value="'.$in.'"></td>
                                                 
                                                </tr>';
                                            }
                                                if($package == 1 ||  $package == 2 || $package == 3 || $package == 4 || $package == 5 || $package == 6){
                                                echo '
                                                <tr>
                                                <td>Printing reports</td>
                                                
                                                <td><input type="checkbox" id="reports" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="report" id="report" value="'.$rep.'"></td>
                                                 
                                                </tr>';
                                            }
                                                if($package == 1 ||  $package == 2 || $package == 3 || $package == 4 || $package == 5 || $package == 6){
                                                echo '
                                                <tr>
                                                <td>Collaborate</td>
                                                
                                                <td><input type="checkbox" id="projects" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="project" id="project" value="'.$pr.'"></td>
                                                
                                                </tr>';
                                            }
                                                if($package == 1 ||  $package == 2 || $package == 3){
                                                echo '
                                                <tr>
                                                <td>Events</td>
                                                
                                                <td><input type="checkbox" id="events" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="event" id="event" value="'.$ev.'"></td>
                                                
                                                </tr>';
                                            }
                                                if($package == 1 ||  $package == 2 || $package == 3 || $package == 4 || $package == 5 || $package == 6){
                                                echo '
                                                <tr>
                                                <td>Add user accounts</td>
                                                 
                                                <td><input type="checkbox" id="users" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="user" id="user" value="'.$u.'"></td>
                                                
                                                </tr>
                                           
                                                ';
                                            }
                                            }
                                                include "editRole.php";
                                           
                                            ?>
                                             <script>
                                                var r ="<?php echo $r;?>";
                                                var l = "<?php echo $l;?>";
                                                var re = "<?php echo $re;?>";
                                                var i =  "<?php echo $i;?>";
                                                var p = "<?php echo $p;?>";
                                                var invoice = "<?php echo $in;?>";
                                                var rep = "<?php echo $rep;?>";
                                                var pr  = "<?php echo $pr;?>";
                                                var ev  = "<?php echo $ev;?>";
                                                var u = "<?php echo $u;?>";
                                                if( r =='1'){
                                                    $('#toggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#toggle-demo').bootstrapToggle('off')
                                                }
                                                if( l =='1'){
                                                    $('#leases').bootstrapToggle('on');
                                                }else{
                                                    $('#leases').bootstrapToggle('off')
                                                }
                                                if( re =='1'){
                                                    $('#returns').bootstrapToggle('on');
                                                }else{
                                                    $('#returns').bootstrapToggle('off')
                                                }
                                                //----------
                                                   if( i =='1'){
                                                    $('#inventories').bootstrapToggle('on');
                                                }else{
                                                    $('#inventories').bootstrapToggle('off')
                                                }
                                                //--------------
                                                   if( p =='1'){
                                                    $('#penalties').bootstrapToggle('on');
                                                }else{
                                                    $('#penalties').bootstrapToggle('off')
                                                }
                                                //---------
                                                 if( ev =='1'){
                                                    $('#events').bootstrapToggle('on');
                                                }else{
                                                    $('#events').bootstrapToggle('off')
                                                }
                                                //---------
                                                   if( invoice =='1'){
                                                    $('#invoices').bootstrapToggle('on');
                                                }else{
                                                    $('#invoices').bootstrapToggle('off')
                                                }
                                                 //---------
                                                   if( rep =='1'){
                                                    $('#reports').bootstrapToggle('on');
                                                }else{
                                                    $('#reports').bootstrapToggle('off')
                                                }
                                                 //---------
                                                   if( pr =='1'){
                                                    $('#projects').bootstrapToggle('on');
                                                }else{
                                                    $('#projects').bootstrapToggle('off')
                                                }
                                                 //---------
                                                   if( u =='1'){
                                                    $('#users').bootstrapToggle('on');
                                                }else{
                                                    $('#users').bootstrapToggle('off')
                                                }
                                                //--------------------------
                                                 $('#toggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#register').val('1');
                                                    }else{
                                                        $('#register').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#leases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#lease').val('1');
                                                    }else{
                                                        $('#lease').val('0');
                                                    }
                                                });
                                                $('#returns').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#return').val('1');
                                                    }else{
                                                        $('#return').val('0');
                                                    }
                                                });
                                                $('#inventories').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#inventory').val('1');
                                                    }else{
                                                        $('#inventory').val('0');
                                                    }
                                                });
                                                $('#penalties').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#penalty').val('1');
                                                    }else{
                                                        $('#penalty').val('0');
                                                    }
                                                });
                                                $('#invoices').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#invoice').val('1');
                                                    }else{
                                                        $('#invoice').val('0');
                                                    }
                                                });
                                                $('#reports').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#report').val('1');
                                                    }else{
                                                        $('#report').val('0');
                                                    }
                                                });
                                                $('#projects').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#project').val('1');
                                                    }else{
                                                        $('#project').val('0');
                                                    }
                                                });
                                                $('#events').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#event').val('1');
                                                    }else{
                                                        $('#event').val('0');
                                                    }
                                                });
                                                $('#users').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#user').val('1');
                                                    }else{
                                                        $('#user').val('0');
                                                    }
                                                });
                                                
                                                
                                                
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>

                                    </form>
                                   <!---->
                                </div><!-- /.box-body -->


          
				</div>
				<!--End Dashboard stories =+++++++++++++++++++++++++++++++++++-->
 	
				
        <div class="tab-pane" id="3a">
          <div class="box-body table-responsive" style="overflow-y: auto;" >
                          <form method="post">
                                    <?php

	if(isset($_POST['customer_update']))
	   {
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['cregister'];
	    $lease      = $_POST['clease'];
	    $return     = $_POST['creturn'];
	    $inventory  = $_POST['cinventory'];
	    $penalty    = $_POST['cpenalty'];
	    
 
	    $q = mysqli_query($con,"UPDATE tblroles SET c_add_new_customer	 = '".$register."',c_export_to_excel = '".$lease."',c_print = '".$return."',c_edit = '".$inventory."',c_lease_items = '".$penalty."' where id = '".$txt_id."' ");
     
	    

	    if($q == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			// echo '<script type="text/javascript">'; 
   //          echo 'alert("No changes made.");'; 
   //         // echo 'window.location = "setting.php";';
   //          echo '</script>';
            echo "Failed ".mysqli_error($con);
		}
	}
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="customer_update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                            
                                                
                                                echo '
                                             
                                                    <tr>
                                                <td>Add new customer</td>
                                                
                                                
                                                <td>  <input  type="checkbox" id="ctoggle-demo" data-toggle="toggle" data-on="Enable" style="width:100px !important;" data-off="Disable"  name="cregisters"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="cregister" id="cregister" value="'.$c_add_new_customer.'">
                                            
                                                </td>
                                                      
                                                </tr>
                                                
                                                <tr>
                                                <td>Export to excel</td>
                                                 
                                                <td> <input type="checkbox" id="cleases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="cleases" data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="clease" id="clease" value="'.$c_export_to_excel.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Print </td>
                                                 
                                                <td> <input type="checkbox" id="creturns" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="creturn" id="creturn" value="'.$c_print.'"></td>
                                               
                                                </tr>
                                                
                                                <tr>
                                                <td>Edit</td>
                                                 
                                                <td><input type="checkbox" id="cinventories" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="cinventory" id="cinventory" value="'.$c_edit.'"></td>
                                                 
                                                </tr>
                                                 <tr>
                                                <td>Leaese items</td>
                                                
                                                <td><input type="checkbox" id="cpenalties" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="cpenalty" id="cpenalty" value="'. $c_lease_items.'"></td>
                                                
                                                </tr>
                                                
                                                 
                                                ';
                                               
                                           
                                            ?>
                                             <script>
                                                var r ="<?php echo $c_add_new_customer;?>";
                                                var l = "<?php echo $c_export_to_excel;?>";
                                                var re = "<?php echo $c_print;?>";
                                                var i =  "<?php echo $c_edit;?>";
                                                var p = "<?php echo $c_lease_items;?>";
                                                
                                                if( r =='1'){
                                                    $('#ctoggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#ctoggle-demo').bootstrapToggle('off')
                                                }
                                                if( l =='1'){
                                                    $('#cleases').bootstrapToggle('on');
                                                }else{
                                                    $('#cleases').bootstrapToggle('off')
                                                }
                                                if( re =='1'){
                                                    $('#creturns').bootstrapToggle('on');
                                                }else{
                                                    $('#creturns').bootstrapToggle('off')
                                                }
                                                //----------
                                                   if( i =='1'){
                                                    $('#cinventories').bootstrapToggle('on');
                                                }else{
                                                    $('#cinventories').bootstrapToggle('off')
                                                }
                                                //--------------
                                                   if( p =='1'){
                                                    $('#cpenalties').bootstrapToggle('on');
                                                }else{
                                                    $('#cpenalties').bootstrapToggle('off')
                                                }
                                                //---------
                                            
                                                //--------------------------
                                                 $('#ctoggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#cregister').val('1');
                                                    }else{
                                                        $('#cregister').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#cleases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#clease').val('1');
                                                    }else{
                                                        $('#clease').val('0');
                                                    }
                                                });
                                                $('#creturns').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#creturn').val('1');
                                                    }else{
                                                        $('#creturn').val('0');
                                                    }
                                                });
                                                $('#cinventories').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#cinventory').val('1');
                                                    }else{
                                                        $('#cinventory').val('0');
                                                    }
                                                });
                                                $('#cpenalties').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#cpenalty').val('1');
                                                    }else{
                                                        $('#cpenalty').val('0');
                                                    }
                                                });
                                                
                                                
                                                
                                            </script>
                                        </tbody>
                                    </table>
                                    

                                    </form>
                                   <!---->                 
                                    
                                    

                                    
             </div>
		</div>
				<!--end of Customers+++++++++++++++++++++++++++++++++++++++++++-->
				
				
		<div class="tab-pane" id="4a">
          <div class="box-body table-responsive" style="" >
                   <form method="post">
                                    <?php

	if(isset($_POST['lease_update']))
	   {
	       
	       
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['lregister'];
	    $lease      = $_POST['llease'];
	    $return     = $_POST['lreturn'];
	    $inventory  = $_POST['linventory'];
	    $penalty    = $_POST['lpenalty'];
	    $invoice    = $_POST['linvoice'];
 
 
	       $query = mysqli_query($con,"UPDATE tblroles SET l_add_new_customer = '".$register."',l_customer_list = '".$lease."',l_invoice = '".$return."',l_leased_items_report = '".$inventory."',l_delete = '".$penalty."',l_lease = '".$invoice."' where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.history.back();';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            // echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="lease_update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                           
                                                
                                                
                                                echo '
                                                    <tr>
                                                <td>Add new customer</td>
                                                
                                                <td>  <input type="checkbox" id="ltoggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="lregisters"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="lregister" id="lregister" value="'.$l_add_new_customer.'"></td>
                                                      
                                                </tr>
                                                
                                                <tr>
                                                <td>Customer List</td>
                                                 
                                                <td> <input type="checkbox" id="lleases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="lleases" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="llease" id="llease" value="'.$l_customer_list.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Invoices</td>
                                                 
                                                <td> <input type="checkbox" id="lreturns" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="lreturn" id="lreturn" value="'.$l_invoice.'"></td>
                                               
                                                </tr>
                                                
                                                <tr>
                                                <td>Leased items report</td>
                                                 
                                                <td><input type="checkbox" id="linventories" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="linventory" id="linventory" value="'.$l_leased_items_report.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Delete</td>
                                                
                                                <td><input type="checkbox" id="lpenalties" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="lpenalty" id="lpenalty" value="'.$l_delete.'"></td>
                                                
                                                </tr>
                                                
                                                <tr>
                                                <td>Lease Items</td>
                                                 
                                                <td><input type="checkbox" id="linvoices" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="linvoice" id="linvoice" value="'.$l_lease.'"></td>
                                                 
                                                </tr>
                                                
                                                
                                                ';
                                     
                                            ?>
                                             <script>
                                             
                                                var r ="<?php echo  $l_add_new_customer;?>";
                                                var l = "<?php echo $l_customer_list;?>";
                                                var re = "<?php echo $l_invoice;?>";
                                                var i =  "<?php echo $l_leased_items_report;?>";
                                                var p = "<?php echo $l_delete;?>";
                                                var invoice = "<?php echo $l_lease;?>";
                                                
                                                if( r =='1'){
                                                    $('#ltoggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#ltoggle-demo').bootstrapToggle('off')
                                                }
                                                if( l =='1'){
                                                    $('#lleases').bootstrapToggle('on');
                                                }else{
                                                    $('#lleases').bootstrapToggle('off')
                                                }
                                                if( re =='1'){
                                                    $('#lreturns').bootstrapToggle('on');
                                                }else{
                                                    $('#lreturns').bootstrapToggle('off')
                                                }
                                                //----------
                                                   if( i =='1'){
                                                    $('#linventories').bootstrapToggle('on');
                                                }else{
                                                    $('#linventories').bootstrapToggle('off')
                                                }
                                                //--------------
                                                   if( p =='1'){
                                                    $('#lpenalties').bootstrapToggle('on');
                                                }else{
                                                    $('#lpenalties').bootstrapToggle('off')
                                                }
                                                //---------
                                                 if( ev =='1'){
                                                    $('#levents').bootstrapToggle('on');
                                                }else{
                                                    $('#levents').bootstrapToggle('off')
                                                }
                                                //---------
                                                   if( invoice =='1'){
                                                    $('#linvoices').bootstrapToggle('on');
                                                }else{
                                                    $('#linvoices').bootstrapToggle('off')
                                                }
                                                 //---------
                                                   
                                                //--------------------------
                                                 $('#ltoggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#lregister').val('1');
                                                    }else{
                                                        $('#lregister').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#lleases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#llease').val('1');
                                                    }else{
                                                        $('#llease').val('0');
                                                    }
                                                });
                                                $('#lreturns').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#lreturn').val('1');
                                                    }else{
                                                        $('#lreturn').val('0');
                                                    }
                                                });
                                                $('#linventories').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#linventory').val('1');
                                                    }else{
                                                        $('#linventory').val('0');
                                                    }
                                                });
                                                $('#lpenalties').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#lpenalty').val('1');
                                                    }else{
                                                        $('#lpenalty').val('0');
                                                    }
                                                });
                                                $('#linvoices').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#linvoice').val('1');
                                                    }else{
                                                        $('#linvoice').val('0');
                                                    }
                                                });
                      
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                     

                                    </form>
                                    <!--end lease items-->
                                </div>
                        
				</div>
				<!--end leasing-->
				<div class="tab-pane" id="5a">
          <div class="box-body table-responsive" style="" >
    <form method="post">
                                    <?php

	if(isset($_POST['my_task_update']))
	   {
	       
	       
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['myregister'];
	    $lease      = $_POST['mylease'];
	    $return     = $_POST['myreturn'];
	  
 
 
	       $query = mysqli_query($con,"UPDATE tblroles SET my_add_mytask = '".$register."',my_edit = '".$lease."',my_view = '".$return."'  where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.history.back();';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            // echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="my_task_update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                           
                                                
                                                
                                                echo '
                                                    <tr>
                                                <td>Add Task</td>
                                                
                                                <td>  <input type="checkbox" id="mytoggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="myregisters"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="myregister" id="myregister" value="'.$my_add_mytask.'"></td>
                                                      
                                                </tr>
                                                
                                                <tr>
                                                <td>Edit</td>
                                                 
                                                <td> <input type="checkbox" id="myleases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="lleases" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="mylease" id="mylease" value="'.$my_edit.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>View</td>
                                                 
                                                <td> <input type="checkbox" id="myreturns" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="myreturn" id="myreturn" value="'.$my_view.'"></td>
                                               
                                                </tr>
                                                
                                                
                                                
                                                 
                                                ';
                                     
                                            ?>
                                             <script>
                                             
                                                var r ="<?php echo  $my_add_mytask;?>";
                                                var l = "<?php echo $my_edit;?>";
                                                var re = "<?php echo $my_view;?>";
                                                
                                                
                                                if( r =='1'){
                                                    $('#mytoggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#mytoggle-demo').bootstrapToggle('off')
                                                }
                                                if( l =='1'){
                                                    $('#myleases').bootstrapToggle('on');
                                                }else{
                                                    $('#myleases').bootstrapToggle('off')
                                                }
                                                if( re =='1'){
                                                    $('#myreturns').bootstrapToggle('on');
                                                }else{
                                                    $('#myreturns').bootstrapToggle('off')
                                                }
                                                 
                                                 //---------
                                                   
                                                //--------------------------
                                                 $('#mytoggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#myregister').val('1');
                                                    }else{
                                                        $('#myregister').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#myleases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#mylease').val('1');
                                                    }else{
                                                        $('#mylease').val('0');
                                                    }
                                                });
                                                $('#myreturns').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#myreturn').val('1');
                                                    }else{
                                                        $('#myreturn').val('0');
                                                    }
                                                });
                                                
                      
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                     

                                    </form>
                                    <!--end Tasks area-->
      
                                </div>
                        
				</div>
				<!--end tasks-->
				<div class="tab-pane" id="6a">
          <div class="box-body table-responsive" style="" >
    
                               <form method="post">
                                    <?php

	if(isset($_POST['events_update']))
	   {
	       
	       
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['eregister'];
	    $lease      = $_POST['elease'];
	    $return     = $_POST['ereturn'];
	    $inventory  = $_POST['einventory'];
	    $penalty    = $_POST['epenalty'];
 
 
	       $query = mysqli_query($con,"UPDATE tblroles SET e_add_event = '".$register."',e_task_assigment = '".$lease."',e_add_quotation = '".$return."',e_generate_invoice = '".$inventory."',e_all_details = '".$penalty."' where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.history.back();';
            echo '</script>';
	    }

		if(mysqli_error($con)){
		   // echo mysqli_error($con);
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            // echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="events_update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                           
                                                
                                                
                                                echo '
                                                    <tr>
                                                <td>Add Event</td>
                                                
                                                <td>  <input type="checkbox" id="etoggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="eregisters"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="eregister" id="eregister" value="'.$e_add_event.'"></td>
                                                      
                                                </tr>
                                                
                                                <tr>
                                                <td>Task Assignment</td>
                                                 
                                                <td> <input type="checkbox" id="eleases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="eleases" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="elease" id="elease" value="'.$e_task_assigment.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Add Quatation</td>
                                                 
                                                <td> <input type="checkbox" id="ereturns" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="ereturn" id="ereturn" value="'.$e_add_quotation.'"></td>
                                               
                                                </tr>
                                                
                                                <tr>
                                                <td>Generate Invoice</td>
                                                 
                                                <td><input type="checkbox" id="einventories" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="einventory" id="einventory" value="'.$e_generate_invoice.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>All details</td>
                                                
                                                <td><input type="checkbox" id="epenalties" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="epenalty" id="epenalty" value="'.$e_all_details.'"></td>
                                                
                                                </tr>
                                        
                                                ';
                                          
                                            ?>
                                             <script>
                                             
                                                var r ="<?php echo  $e_add_event;?>";
                                                var l = "<?php echo $e_task_assigment;?>";
                                                var re = "<?php echo $e_add_quotation;?>";
                                                var i =  "<?php echo $e_generate_invoice;?>";
                                                var p = "<?php echo $e_all_details; ?>";
                                                
                                                
                                                if( r =='1'){
                                                    $('#etoggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#etoggle-demo').bootstrapToggle('off')
                                                }
                                                if( l =='1'){
                                                    $('#eleases').bootstrapToggle('on');
                                                }else{
                                                    $('#eleases').bootstrapToggle('off')
                                                }
                                                if( re =='1'){
                                                    $('#ereturns').bootstrapToggle('on');
                                                }else{
                                                    $('#ereturns').bootstrapToggle('off')
                                                }
                                                //----------
                                                   if( i =='1'){
                                                    $('#einventories').bootstrapToggle('on');
                                                }else{
                                                    $('#einventories').bootstrapToggle('off')
                                                }
                                                //--------------
                                                   if( p =='1'){
                                                    $('#epenalties').bootstrapToggle('on');
                                                }else{
                                                    $('#epenalties').bootstrapToggle('off')
                                                }
                                               
                                                //--------------------------
                                                 $('#etoggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#eregister').val('1');
                                                    }else{
                                                        $('#eregister').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#eleases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#elease').val('1');
                                                    }else{
                                                        $('#elease').val('0');
                                                    }
                                                });
                                                $('#ereturns').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#ereturn').val('1');
                                                    }else{
                                                        $('#ereturn').val('0');
                                                    }
                                                });
                                                $('#einventories').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#einventory').val('1');
                                                    }else{
                                                        $('#einventory').val('0');
                                                    }
                                                });
                                                $('#epenalties').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#epenalty').val('1');
                                                    }else{
                                                        $('#epenalty').val('0');
                                                    }
                                                });
                                               
                      
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                     

                                    </form>
                                    <!--end Events -->
      
                                </div>
                        
				</div>
				<!--end events-->
				<div class="tab-pane" id="7a">
          <div class="box-body table-responsive" style="" >
    
                              <form method="post">
                                    <?php

	if(isset($_POST['inventory_update']))
	   {
	       
	       
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['iregister'];
	    $lease      = $_POST['ilease'];
	    $return     = $_POST['ireturn'];
	    $inventory  = $_POST['iinventory'];
	    $penalty    = $_POST['ipenalty'];
	    //availab
	    
 
 
	       $query = mysqli_query($con,"UPDATE tblroles SET i_available_stock = '".$register."',i_add_new_item = '".$lease."',i_restock = '".$return."',i_set_charges = '".$inventory."'  where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.history.back();';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            // echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="inventory_update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                           
                                                
                                                
                                                echo '
                                                    <tr>
                                                <td>Available Stock</td>
                                                
                                                <td>  <input type="checkbox" id="itoggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="iregisters"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="iregister" id="iregister" value="'.$i_available_stock.'"></td>
                                                      
                                                </tr>
                                                
                                                <tr>
                                                <td>Add new item(s) to stock</td>
                                                 
                                                <td> <input type="checkbox" id="ileases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="ileases" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="ilease" id="ilease" value="'.$i_add_new_item.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Restock</td>
                                                 
                                                <td> <input type="checkbox" id="ireturns" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="ireturn" id="ireturn" value="'.$i_restock.'"></td>
                                               
                                                </tr>
                                                
                                                <tr>
                                                <td>Set Charges</td>
                                                 
                                                <td><input type="checkbox" id="iinventories" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="iinventory" id="iinventory" value="'.$i_set_charges.'"></td>
                                                 
                                                </tr>
                                                
                                                 
                                                
                                                
                                                ';
                                     
                                            ?>
                                             <script>
                                             
                                                var r ="<?php echo  $i_available_stock;?>";
                                                var l = "<?php echo $i_add_new_item;?>";
                                                var re = "<?php echo $i_restock;?>";
                                                var i =  "<?php echo $i_set_charges;?>";
                                                
                                                
                                                if( r =='1'){
                                                    $('#itoggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#itoggle-demo').bootstrapToggle('off')
                                                }
                                                if( l =='1'){
                                                    $('#ileases').bootstrapToggle('on');
                                                }else{
                                                    $('#ileases').bootstrapToggle('off')
                                                }
                                                if( re =='1'){
                                                    $('#ireturns').bootstrapToggle('on');
                                                }else{
                                                    $('#ireturns').bootstrapToggle('off')
                                                }
                                                //----------
                                                   if( i =='1'){
                                                    $('#iinventories').bootstrapToggle('on');
                                                }else{
                                                    $('#iinventories').bootstrapToggle('off')
                                                }
                                                //--------------
                                                
                                                   
                                                //--------------------------
                                                 $('#itoggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#iregister').val('1');
                                                    }else{
                                                        $('#iregister').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#ileases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#ilease').val('1');
                                                    }else{
                                                        $('#ilease').val('0');
                                                    }
                                                });
                                                $('#ireturns').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#ireturn').val('1');
                                                    }else{
                                                        $('#ireturn').val('0');
                                                    }
                                                });
                                                $('#iinventories').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#iinventory').val('1');
                                                    }else{
                                                        $('#iinventory').val('0');
                                                    }
                                                });
                                                 
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                     

                                    </form>
                                    <!--end Inventory  -->
       
                                </div>
                        
				</div>
				<!--inventory-->
				<div class="tab-pane" id="8a">
          <div class="box-body table-responsive" style="" >
    
                             <form method="post">
                                    <?php

	if(isset($_POST['return_update']))
	   {
	       
	       
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['rregister'];
	  
 
 
	       $query = mysqli_query($con,"UPDATE tblroles SET r_return = '".$register."'  where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.history.back();';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            // echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="return_update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                           
                                                
                                                
                                                echo '
                                                    <tr>
                                                <td>Return Items</td>
                                                
                                                <td>  <input type="checkbox" id="rtoggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="rregisters"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="rregister" id="rregister" value="'.$r_return.'"></td>
                                                      
                                                </tr>
                                                
                                                ';
                                     
                                            ?>
                                             <script>
                                             
                                                var r ="<?php echo  $r_return?>";
                                                
                                                
                                                if( r =='1'){
                                                    $('#rtoggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#rtoggle-demo').bootstrapToggle('off')
                                                }
                                               
                                                   
                                                //--------------------------
                                                 $('#rtoggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#rregister').val('1');
                                                    }else{
                                                        $('#rregister').val('0');
                                                    }
                                                });
                                               
                                                
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                     

                                    </form>
                                    <!--end returned items-->
     
                                </div>
                        
				</div>
				<!--end return items-->
				<div class="tab-pane" id="9a">
          <div class="box-body table-responsive" style="" >
    
                              <form method="post">
                                    <?php

	if(isset($_POST['penalties_update']))
	   {
	       
	       
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['pregister'];
	    $lease      = $_POST['please'];
	 
 
 
	       $query = mysqli_query($con,"UPDATE tblroles SET p_damaged_items = '".$register."',p_overdue_items = '".$lease."'  where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.history.back();';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            // echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="penalties_update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                           
                                                
                                                
                                                echo '
                                                    <tr>
                                                <td>Damaged Items</td>
                                                
                                                <td>  <input type="checkbox" id="ptoggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="pregisters"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="pregister" id="pregister" value="'. $p_damaged_items .'"></td>
                                                      
                                                </tr>
                                                
                                                <tr>
                                                <td>Overdue Items</td>
                                                 
                                                <td> <input type="checkbox" id="pleases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="pleases" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="please" id="please" value="'.$p_overdue_items.'"></td>
                                                 
                                                </tr>
                                                 
                                                ';
                                     
                                            ?>
                                             <script>
                                             
                                                var r ="<?php echo  $p_damaged_items;?>";
                                                var l = "<?php echo $p_overdue_items;?>";
                                               
                                                
                                                if( r =='1'){
                                                    $('#ptoggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#ptoggle-demo').bootstrapToggle('off')
                                                }
                                                if( l =='1'){
                                                    $('#pleases').bootstrapToggle('on');
                                                }else{
                                                    $('#pleases').bootstrapToggle('off')
                                                }
                                                 
                                                 //---------
                                                   
                                                //--------------------------
                                                 $('#ptoggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#pregister').val('1');
                                                    }else{
                                                        $('#pregister').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#pleases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#please').val('1');
                                                    }else{
                                                        $('#please').val('0');
                                                    }
                                                });
                                                
                      
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                     

                                    </form>
                                    <!--end penalties  -->
  
                                </div>
                        
				</div>
				<!--End penalties-->
				<div class="tab-pane" id="10a">
          <div class="box-body table-responsive" style="" >
     <form method="post">
                                    <?php

	if(isset($_POST['invoice_update']))
	   {
	       
	       
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['invregister'];
	    $lease      = $_POST['invlease'];
	    $return     = $_POST['invreturn'];
 
 
 
	       $query = mysqli_query($con,"UPDATE tblroles SET inv_leased_items = '".$register."',inv_damaged_items = '".$lease."',inv_overdue_charges = '".$return."' where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.history.back();';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            // echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="invoice_update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                           
                                                
                                                
                                                echo '
                                                    <tr>
                                                <td>Leased items invoices</td>
                                                
                                                <td>  <input type="checkbox" id="invtoggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="invregisters"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="invregister" id="invregister" value="'.$inv_leased_items.'"></td>
                                                      
                                                </tr>
                                                
                                                <tr>
                                                <td>Damaged items invoices</td>
                                                 
                                                <td> <input type="checkbox" id="invleases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="invleases" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="invlease" id="invlease" value="'.$inv_damaged_items.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Overdue charges invoices</td>
                                                 
                                                <td> <input type="checkbox" id="invreturns" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="invreturn" id="invreturn" value="'.$inv_overdue_charges.'"></td>
                                               
                                                </tr>
                                                
                                                 
                                                
                                                ';
                                     
                                            ?>
                                             <script>
                                             
                                                var r ="<?php echo  $inv_leased_items;?>";
                                                var l = "<?php echo $inv_damaged_items;?>";
                                                var re = "<?php echo $inv_overdue_charges;?>";
                                            
                                                
                                                if( r =='1'){
                                                    $('#invtoggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#invtoggle-demo').bootstrapToggle('off')
                                                }
                                                if( l =='1'){
                                                    $('#invleases').bootstrapToggle('on');
                                                }else{
                                                    $('#invleases').bootstrapToggle('off')
                                                }
                                                if( re =='1'){
                                                    $('#invreturns').bootstrapToggle('on');
                                                }else{
                                                    $('#invreturns').bootstrapToggle('off')
                                                }
                                                //----------
                                                   
                                                   
                                                //--------------------------
                                                 $('#invtoggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#invregister').val('1');
                                                    }else{
                                                        $('#invregister').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#invleases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#invlease').val('1');
                                                    }else{
                                                        $('#invlease').val('0');
                                                    }
                                                });
                                                $('#invreturns').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#invreturn').val('1');
                                                    }else{
                                                        $('#invreturn').val('0');
                                                    }
                                                });
                                                
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                     

                                    </form>       
                                </div>
                        
				</div>
				<!--end invoices-->
				<div class="tab-pane" id="11a">
          <div class="box-body table-responsive" style="" >
    
                              <form method="post">
                                    <?php

	if(isset($_POST['reports_update']))
	   {
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['r_register'];
	    $lease      = $_POST['r_lease'];
	    $return     = $_POST['r_return'];
	    $inventory  = $_POST['r_inventory'];
	    $penalty    = $_POST['r_penalty'];
	    $invoice    = $_POST['r_invoice'];
	    $report     = $_POST['r_report'];
	    $project    = $_POST['r_project'];
	   
 
	       $query = mysqli_query($con,"UPDATE tblroles SET r_sales_report = '".$register."',r_available_items = '".$lease."',r_leased_items = '".$return."',r_damaged_items = '".$inventory."',r_returned_items = '".$penalty."',r_reconciled_items = '".$invoice."',r_projects_report = '".$report."',r_cancelled = '".$project."' where id = '".$txt_id."' ");
	    

	    if($query == true){
  
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.history.back();';
            echo '</script>';
	    }

		if(mysqli_error($con)){

			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
           // echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="reports_update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                           
                                                
                        $sq = mysqli_query($con, "select * from tblstaff where company='".$_SESSION['company']."' ");
                             while($rw = mysqli_fetch_array($sq))
                                 {
                                 $package = $rw['package'];
                                                if($package == 1 ||  $package == 2 || $package == 3){  
                                                echo '
                                                    <tr>
                                                <td>Sales report</td>
                                                
                                                <td>  <input type="checkbox" id="r_toggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="r_registers"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="r_register" id="r_register" value="'.$r_sales_report.'"></td>
                                                      
                                                </tr>';
                                            }
                                            if($package == 2 || $package == 3){  
                                                echo '    
                                                <tr>
                                                <td>Available Items</td>
                                                 
                                                <td> <input type="checkbox" id="r_leases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="r_leases" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="r_lease" id="r_lease" value="'.$r_available_items.'"></td>
                                                 
                                                </tr>';
                                            }
                                               if($package == 2 || $package == 3){  
                                                echo ' 
                                                <tr>
                                                <td>Leased Items</td>
                                                 
                                                <td> <input type="checkbox" id="r_returns" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="r_return" id="r_return" value="'.$r_leased_items.'"></td>
                                               
                                                </tr>';
                                            }
                                              if($package == 2 || $package == 3){  
                                                echo '  
                                                <tr>
                                                <td>Damaged Items</td>
                                                 
                                                <td><input type="checkbox" id="r_inventories" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="r_inventory" id="r_inventory" value="'.$r_damaged_items.'"></td>
                                                 
                                                </tr>';
                                            }
                                               if($package == 2 || $package == 3){  
                                                echo ' 
                                                <tr>
                                                <td>Returned items report</td>
                                                
                                                <td><input type="checkbox" id="r_penalties" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="r_penalty" id="r_penalty" value="'.$r_returned_items.'"></td>
                                                
                                                </tr>';
                                            }
                                             if($package == 2 || $package == 3){  
                                                echo '    
                                                <tr>
                                                <td>Reconciled report</td>
                                                 
                                                <td><input type="checkbox" id="r_invoices" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="r_invoice" id="r_invoice" value="'. $r_reconciled_items.'"></td>
                                                 
                                                </tr>';
                                            }
                                              if($package == 1 || $package == 2 || $package == 3 || $package == 4 || $package == 5 || $package == 6){  
                                                echo '  
                                                <tr>
                                                <td>Project reports</td>
                                                
                                                <td><input type="checkbox" id="r_reports" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="r_report" id="r_report" value="'.$r_projects_report.'"></td>
                                                 
                                                </tr>';
                                            }
                                              if($package == 1 || $package == 2 || $package == 3){  
                                                echo '  
                                                <tr>
                                                <td>Cancelled </td>
                                                
                                                <td><input type="checkbox" id="r_projects" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="r_project" id="r_project" value="'.$r_cancelled.'"></td>
                                                
                                                </tr>
                                               ';
                                            }}
                                               
                                           
                                            ?>
                                             <script>
                                                var r ="<?php echo $r_sales_report;?>";
                                                var l = "<?php echo $r_available_items;?>";
                                                var re = "<?php echo  $r_leased_items;?>";
                                                var i =  "<?php echo  $r_damaged_items;?>";
                                                var p = "<?php echo    $r_returned_items;?>";
                                                var invoice = "<?php echo $r_reconciled_items;?>";
                                                var rep = "<?php echo $r_projects_report;?>";
                                                var pr  = "<?php echo $r_cancelled;?>";
                                               
                                                if( r =='1'){
                                                    $('#r_toggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#r_toggle-demo').bootstrapToggle('off')
                                                }
                                                if( l =='1'){
                                                    $('#r_leases').bootstrapToggle('on');
                                                }else{
                                                    $('#r_leases').bootstrapToggle('off')
                                                }
                                                if( re =='1'){
                                                    $('#r_returns').bootstrapToggle('on');
                                                }else{
                                                    $('#r_returns').bootstrapToggle('off')
                                                }
                                                //----------
                                                   if( i =='1'){
                                                    $('#r_inventories').bootstrapToggle('on');
                                                }else{
                                                    $('#r_inventories').bootstrapToggle('off')
                                                }
                                                //--------------
                                                   if( p =='1'){
                                                    $('#r_penalties').bootstrapToggle('on');
                                                }else{
                                                    $('#r_penalties').bootstrapToggle('off')
                                                }
                                              
                                                //---------
                                                   if( invoice =='1'){
                                                    $('#r_invoices').bootstrapToggle('on');
                                                }else{
                                                    $('#r_invoices').bootstrapToggle('off')
                                                }
                                                 //---------
                                                   if( rep =='1'){
                                                    $('#r_reports').bootstrapToggle('on');
                                                }else{
                                                    $('#r_reports').bootstrapToggle('off')
                                                }
                                                  //---------
                                                 if( pr =='1'){
                                                    $('#r_projects').bootstrapToggle('on');
                                                }else{
                                                    $('#r_projects').bootstrapToggle('off')
                                                }

                                             
                                                //--------------------------
                                                 $('#r_toggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#r_register').val('1');
                                                    }else{
                                                        $('#r_register').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#r_leases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#r_lease').val('1');
                                                    }else{
                                                        $('#r_lease').val('0');
                                                    }
                                                });
                                                $('#r_returns').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#r_return').val('1');
                                                    }else{
                                                        $('#r_return').val('0');
                                                    }
                                                });
                                                $('#r_inventories').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#r_inventory').val('1');
                                                    }else{
                                                        $('#r_inventory').val('0');
                                                    }
                                                });
                                                $('#r_penalties').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#r_penalty').val('1');
                                                    }else{
                                                        $('#r_penalty').val('0');
                                                    }
                                                });
                                                 $('#r_invoices').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#r_invoice').val('1');
                                                    }else{
                                                        $('#r_invoice').val('0');
                                                    }
                                                });
                                                $('#r_projects').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#r_project').val('1');
                                                    }else{
                                                        $('#r_project').val('0');
                                                    }
                                                });
                                                $('#r_reports').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#r_report').val('1');
                                                    }else{
                                                        $('#r_report').val('0');
                                                    }
                                                });
                                                $('#r_projects').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#r_project').val('1');
                                                    }else{
                                                        $('#r_project').val('0');
                                                    }
                                                });
                                           
                                                
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                     

                                    </form>      
                                </div>
                        
				</div>
				<!--end report-->
				<div class="tab-pane" id="12a">
          <div class="box-body table-responsive" style="" >
    
                          <form method="post">
                                    <?php

	if(isset($_POST['u_lease_update']))
	   {
	       
	       
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['uregister'];
	    $lease      = $_POST['ulease'];
	    $return     = $_POST['ureturn'];
	   
 
	       $query = mysqli_query($con,"UPDATE tblroles SET u_add_user = '".$register."',u_delete = '".$lease."',u_edit = '".$return."' where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.history.back();';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 

            // echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="u_lease_update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                           
                                         
                                                echo '
                                                    <tr>
                                                <td>Add user</td>
                                                
                                                <td>  <input type="checkbox" id="utoggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="uregisters"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="uregister" id="uregister" value="'.$u_add_user.'"></td>
                                                      
                                                </tr>
                                                
                                                <tr>
                                                <td>Delete </td>
                                                 
                                                <td> <input type="checkbox" id="uleases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="uleases" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="ulease" id="ulease" value="'.$u_delete.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Edit</td>
                                                 
                                                <td> <input type="checkbox" id="ureturns" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="ureturn" id="ureturn" value="'.$u_edit.'"></td>
                                               
                                                </tr>
                                    
                                                ';
                                     
                                            ?>
                                             <script>
                                             
                                                var u_add_user ="<?php echo  $u_add_user;?>";
                                                var u_delete = "<?php echo $u_delete;?>";
                                                var u_edit = "<?php echo $u_edit;?>";
                                                
                                                
                                                if( u_add_user =='1'){
                                                    $('#utoggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#utoggle-demo').bootstrapToggle('off')
                                                }
                                                if( u_delete =='1'){
                                                    $('#uleases').bootstrapToggle('on');
                                                }else{
                                                    $('#uleases').bootstrapToggle('off')
                                                }
                                                if( u_edit =='1'){
                                                    $('#ureturns').bootstrapToggle('on');
                                                }else{
                                                    $('#ureturns').bootstrapToggle('off')
                                                }
                                                //----------
                                                 
                                                //--------------------------
                                                 $('#utoggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#uregister').val('1');
                                                    }else{
                                                        $('#uregister').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#uleases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#ulease').val('1');
                                                    }else{
                                                        $('#ulease').val('0');
                                                    }
                                                });
                                                $('#ureturns').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#ureturn').val('1');
                                                    }else{
                                                        $('#ureturn').val('0');
                                                    }
                                                });
                                                
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                     

                                    </form>             
                                </div>
                        
				</div>
				<!--user accounts-->
				                
        <div class="tab-pane" id="13a">
          <div class="box-body table-responsive" style="" >
                   <form method="post">
                                    <?php

    if(isset($_POST['srlease_update']))
       {
           
           
        $txt_id     = $_GET['role'];
        $register   = $_POST['srregister'];
        $lease      = $_POST['srlease'];
        $return     = $_POST['srreturn'];
        $inventory  = $_POST['srinventory'];
        $penalty    = $_POST['srpenalty'];
        $invoice    = $_POST['srinvoice'];
        $srlinvoice    = $_POST['srlinvoice'];
 
 
           $query = mysqli_query($con,"UPDATE tblroles SET sr_add_role = '".$register."',sr_edit = '".$lease."',sr_privileges = '".$return."',su_add_user = '".$inventory."',su_edit = '".$penalty."',sc_edit_company = '".$invoice."',sc_edit_payment = '".$srlinvoice."' where id = '".$txt_id."' ");
        

        if($query == true){
            echo '<script type="text/javascript">'; 
            echo 'alert("Updated successufully.");'; 
            echo 'window.history.back();';
            echo '</script>';
        }

        if(mysqli_error($con)){
            echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            // echo 'window.location = "setting.php";';
            echo '</script>';
        }
    }
?>
                                    <button  style="" class="btn btn-primary" type="submit" name="srlease_update" id="update" title="Save">Save Changes</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                           
                                                
                                                
                                                echo '
                                                    <tr>
                                                <td>Add Role</td>
                                                
                                                <td>  <input type="checkbox" id="srtoggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="srregisters"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="srregister" id="srregister" value="'.$sr_add_role.'"></td>
                                                      
                                                </tr>
                                                
                                                <tr>
                                                <td>Edit Role </td>
                                                 
                                                <td> <input type="checkbox" id="srleases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="srleases" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="srlease" id="srlease" value="'.$sr_edit.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Privileges</td>
                                                 
                                                <td> <input type="checkbox" id="srreturns" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="srreturn" id="srreturn" value="'.$sr_privileges.'"></td>
                                               
                                                </tr>
                                                
                                                <tr>
                                                <td> Add User</td>
                                                 
                                                <td><input type="checkbox" id="srinventories" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="srinventory" id="srinventory" value="'.$su_add_user.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Edit User</td>
                                                
                                                <td><input type="checkbox" id="srpenalties" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="srpenalty" id="srpenalty" value="'.$su_edit.'"></td>
                                                
                                                </tr>
                                                
                                                <tr>
                                                <td>Edit Company Details</td>
                                                 
                                                <td><input type="checkbox" id="srinvoices" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="srinvoice" id="srinvoice" value="'.$sc_edit_company.'"></td>
                                                 
                                                </tr>
                                                 <tr>
                                                <td>Edit Payment Details</td>
                                                 
                                                <td><input type="checkbox" id="srlinvoices" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="srlinvoice" id="srlinvoice" value="'.$sc_edit_payment.'"></td>
                                                 
                                                </tr>
                                                
                                                
                                                ';
                                     
                                            ?>
                                             <script>
                                             
                                                var sr_add ="<?php echo  $sr_add_role;?>";
                                                var sr_edit = "<?php echo $sr_edit;?>";
                                                var sr_privileges = "<?php echo $sr_privileges;?>";
                                                var su_add =  "<?php echo $su_add_user;?>";
                                                var su_edit = "<?php echo $su_edit;?>";
                                                var sc_edit_company = "<?php echo $sc_edit_company;?>";
                                                var sc_edit_payment = "<?php echo $sc_edit_payment;?>";
                                                
                                                if( sr_add =='1'){
                                                    $('#srtoggle-demo').bootstrapToggle('on');
                                                }else{
                                                    $('#srtoggle-demo').bootstrapToggle('off')
                                                }
                                                if( sr_edit =='1'){
                                                    $('#srleases').bootstrapToggle('on');
                                                }else{
                                                    $('#srleases').bootstrapToggle('off')
                                                }
                                                if( sr_privileges =='1'){
                                                    $('#srreturns').bootstrapToggle('on');
                                                }else{
                                                    $('#srreturns').bootstrapToggle('off')
                                                }
                                                //----------
                                                   if( su_add =='1'){
                                                    $('#srinventories').bootstrapToggle('on');
                                                }else{
                                                    $('#srinventories').bootstrapToggle('off')
                                                }
                                                //--------------
                                                   if( su_edit =='1'){
                                                    $('#srpenalties').bootstrapToggle('on');
                                                }else{
                                                    $('#srpenalties').bootstrapToggle('off')
                                                }
                                                //---------
                                                 if( sc_edit_company =='1'){
                                                    $('#srinvoices').bootstrapToggle('on');
                                                }else{
                                                    $('#srinvoices').bootstrapToggle('off')
                                                }
                                              
                                                //---------
                                                   if( sc_edit_payment =='1'){
                                                    $('#srlinvoices').bootstrapToggle('on');
                                                }else{
                                                    $('#srlinvoices').bootstrapToggle('off')
                                                }
                                                 //---------
                                                   
                                                //--------------------------
                                                 $('#srtoggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#srregister').val('1');
                                                    }else{
                                                        $('#srregister').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#srleases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#srlease').val('1');
                                                    }else{
                                                        $('#srlease').val('0');
                                                    }
                                                });
                                                $('#srreturns').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#srreturn').val('1');
                                                    }else{
                                                        $('#srreturn').val('0');
                                                    }
                                                });
                                                $('#srinventories').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#srinventory').val('1');
                                                    }else{
                                                        $('#srinventory').val('0');
                                                    }
                                                });
                                                $('#srpenalties').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#srpenalty').val('1');
                                                    }else{
                                                        $('#srpenalty').val('0');
                                                    }
                                                });
                                                $('#srinvoices').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#srinvoice').val('1');
                                                    }else{
                                                        $('#srinvoice').val('0');
                                                    }
                                                });
                                                  $('#srlinvoices').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#srlinvoice').val('1');
                                                    }else{
                                                        $('#srlinvoice').val('0');
                                                    }
                                                });
                      
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                     

                                    </form>
                                    <!--end Settings items-->
                                </div>
                        
                </div>
                <!--end Settings-->
	 
		
                </div>
<?php }?>
               </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->  
                <!--FINISH ROLE STORY HER +++++++++++++++++++++++++++++++++++++++++++++++++-->
    
 
            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>

        
				</div>
		
        <?php 
        include "../footer.php"; ?>
 
<script type="text/javascript">
  var btn = document.getElementsByClassName('toggle');
  
//   Please style these guys
  for (let i = 0; i < btn.length; i++) {
    btn[i].style.setProperty("width", "69px", "important");
    btn[i].style.setProperty("height", "30px", "important");
  }
  

   
   
  $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>



