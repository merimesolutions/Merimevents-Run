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
    <style>
        .sidebar-menu .setting{
        background-color:#009999;
    }
    </style>
    <?php include('../head_css.php'); ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>         
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>
            <!--Get roles-->
            <?php include('getroles.php');?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                 <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
                <div id="exTab1" class="container">	
                <ul  class="nav nav-pills">
                			<li class="active">
                             <a  href="#1a" data-toggle="tab" class="bg-info rounded">Roles</a>
                			</li>
                			<li>
                			 <a href="#3a" data-toggle="tab" class="bg-info rounded">User Accounts</a>
                			</li>
                			<li>
                			 <a href="#4a" data-toggle="tab" class="bg-info rounded">Company Details</a>
                			</li>
                
                		</ul>
                <hr>
			<div class="tab-content clearfix">
			  <div class="tab-pane active" id="1a">
          
                <div class="box-body table-responsive" style="overflow-y: auto;">
                    <?php if($sr_add_role==1){?>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addrole"><i class="fa fa-plus" aria-hidden="true"></i> Add role </button><br><br>
                       <?php }?>
                                <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;">No. </th>
                                                <th>Roles registered</th>
                                                <?php if($sr_edit==1){
                                                    echo '<th>Edit</th>';
                                                }
                                                if($sr_privileges==1){
                                                ?>
                                                
                                                <th>Privileges</th>
                                                <?php }?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "select * from tblroles where company='".$_SESSION['company']."' ORDER BY id DESC");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                echo '
                                            <tr>
                                                <td>'.$c.'</td> 
                                                <td>'.ucwords($row['role']).'</td>';
                                                if($sr_edit==1){
                                                    echo '
                                                <td><a data-target="#editRole'.$row['id'].'" data-toggle="modal"><img src="../../images/icons/edit.png" title="Edit this record" class="iconb"></a></td>';
                                                }if($sr_privileges==1){
                                                    echo ' <td><a href=privileges?role='.$row['id'].'><img src="../../images/icons/doc_edit.png" title="" class="iconb"></a> 
                                                </td>';
                                                }
                                                echo '
                                                </tr>
                                                ';
                                                $c++;
                                                include "editRole.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>

                                    </form>
                                </div><!-- /.box-body -->


          
				</div>
				
				
				
				
				
				
        <div class="tab-pane" id="3a">
          <div class="box-body table-responsive" style="overflow-y: auto;" >
              <?php if($su_add_user==1){?>
                                    <a class="btn btn-primary btn-sm" href="acc.php" title="Go home"><i class="fa fa-plus" aria-hidden="true" title="Add new account"></i> Add User</a>
                                    <?php }?>
                                    <br><br>
                                    
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <?php if($su_edit==1){
                                                    echo ' <th>Edit</th>';
                                                }
                                                ?>
                                               
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "select * from tblusers where company='".$_SESSION['company']."' ORDER BY id DESC");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                           $r=$row['role'];
                                           $sq = mysqli_query($con, "select * from tblroles where id='".$r."' ORDER BY id DESC");
                                            while($rows = mysqli_fetch_array($sq))
                                            {     
                                               $role =  $rows['role'];
                                            }
                                                echo '
                                            <tr>
                                        <td>'.$c.'</td> 
                                        <td>'.ucwords($row['full_name']).'</td>
                                        <td>'.$row['username'].'</td>
                                        <td>'.ucwords($role).'</td>';
                                        if($su_edit==1){
                                          echo '<td><a href=editacc?id='.$row['id'].'><img src="../../images/icons/doc_edit.png" title="" class="iconb"></a></td>  
                                        <td></td>';   
                                        }
                                           echo '
                                                </tr>
                                                ';
                                                $c++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>

                                    
                                </div>
				</div>
				
				
				
		<div class="tab-pane" id="4a">
          <div class="box-body table-responsive" style="" >
              <?php if($sc_edit_company==1){?>
              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editcompany"><i class="fa fa-plus" aria-hidden="true"></i> Edit company details </button>
              <?php } ?>
                               <form method="post">     
                                    <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "select * from tblstaff where id='".$_SESSION['userid']."' ORDER BY id DESC");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                ?>
                                    <table id="table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td colspan="2"></td></tr>
                                                </tr>
                                                <tr>
                                                <td>Company Name</td>
                                                <td><?php echo ucwords($row['companyname']) ?></td>
                                                </tr>
                                                <tr>
                                                <td>Location</td>
                                                <td><?php echo ucwords($row['location']) ?></td>
                                                </tr>
                                                <tr>
                                                <td>Contact</td>
                                                <td><?php echo ucwords($row['contact']) ?></td>
                                                </tr>
                                                <tr>
                                                <td>Email address</td>
                                                <td><?php echo $row['email'] ?></td>
                                                </tr>
                                                <tr>
                                                <td>Tax settings(VAT)</td>
                                                <td>
                                               <?php echo $row['vat'];?>
                                                </td>
                                                </tr>
                                        </thead>
                                    </table>
                                    <?php } ?>
                                   </form>
                                   <?php if($sc_edit_payment==1){?>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editpayment"><i class="fa fa-plus" aria-hidden="true"></i> Edit payment details </button>
                        <?php }?>
                        <br>
                        
                               <form method="post">     
                                    <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "select * from tblstaff where id='".$_SESSION['userid']."' ORDER BY id DESC");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                ?>
                                    <table id="table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Bank Account</th>
                                                <th colspan="2">Mpesa</th></tr>
                                                </tr>
                                                <tr>
                                                <td>Bank Name:</td>
                                                <td><?php echo ucwords($row['bank_name']) ?></td>
                                                <td>Mpesa Pay Bill Business Number:</td>
                                                <td><?php echo ucwords($row['paybill']) ?></td>
                                                </tr>
                                                <tr>
                                                <td>Branch:</td>
                                                <td><?php echo ucwords($row['branch']) ?></td>
                                                <td>Account Number:</td>
                                                <td><?php echo ucwords($row['business_no']) ?></td>
                                                </tr>
                                                <tr>
                                                <td>Account Number:</td>
                                                <td><?php echo ucwords($row['acc_no']) ?></td>
                                                <td colspan="2"></td>
                                                </tr>
                                                <tr>
                                                <td>Account Name:</td>
                                                <td><?php echo ucwords($row['account_name']) ?></td>
                                                <td>Mpesa Till Number:</td>
                                                <td><?php echo ucwords($row['till_no']) ?></td>
                                                </tr>
                                    
                                        </thead>
                                    </table>
                                    <?php } ?>
                                    
                                   </form>
                                   <?php
include("../connection.php");

if(isset($_POST['but_upload'])){
 
  $name = $_FILES['file']['name'];
  $target_dir = "../logos/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
     // Upload file
     if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){
        // Insert record
       $company= $_SESSION['company'];
       $query = "UPDATE tblstaff SET profile_img = '".$name."' WHERE company = '$company' ";
       mysqli_query($con,$query);
       
       if($query == true){
	        echo '<script type="text/javascript">'; 
            echo 'alert("Logo uploaded successfully.");'; 
            echo 'window.location = "setting.php";';
            echo '</script>';
       }
    }
    
  }
 
}
?>
    <form method="post" action="" enctype='multipart/form-data'>
        <label for="formFileSm" class="form-label">Upload Company logo</label>
                        <input required class="form-control form-control-sm" id="formFileSm" type="file" name="file" /><br>
                        <button type="submit" name="but_upload" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
    </form>
                                    
                                </div>
                        
				</div>
			<!--?php include "../notification.php"; ?-->
            <?php include "../addModal.php"; ?>
            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>
		
                </div>

               </section><!-- /.content -->
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
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>



