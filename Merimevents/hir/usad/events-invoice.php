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
                 <!--button class="btn btn-primary float-left" role="button" data-toggle="modal" data-target="#myModalzz">Add event</button-->
                </section>
      <!--=======================================================================================================================-->
      <div class="container-fluid">
    <div class="row">
		<div class="col-md-12">
		
						  <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">       
                            <form method="post">
                                    <table id="table" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Invoice No.</th>
                                                <th>Event Name</th>
                                                <th>Customer</th>
                                                <th>Date invoiced</th>
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
                                            $query  = "SELECT * FROM tblevents WHERE company='$compp' order by id desc";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                      $event_id = $row['id'];
                                                      $event_name=$row['event_name'];
                                                      $cust_name=$row['customer_name'];
                                            $qry  = "SELECT * FROM event_quotation WHERE event_id='$event_id' and customer_name !='' order by id desc";
                                            $res = mysqli_query($con, $qry);
                                                while ($rows = mysqli_fetch_array($res))
                                                  { 
                                            echo '
                                            <tr>
                                                <td><a href="events-invoice-prev?id='.$row['id'].'" >'.$c++.'</a></td> 
                                                <td><a href="events-invoice-prev?id='.$row['id'].'" >INV'.ucwords($row['id']).'</a></td>
                                                <td><a href="events-invoice-prev?id='.$row['id'].'" >'.ucwords($row['event_name']).'</a></td>
                                                <td><a href="events-invoice-prev?id='.$row['id'].'" >'.ucwords($rows['customer_name']).'</a></td>  
                                                <td><a href="events-invoice-prev?id='.$row['id'].'" >'.$row['start_date'].'</a></td>
                                                <td><center><a href="events-invoice-prev?id='.$row['id'].'" ><img src="../../images/icons/eye.png" title="Edit this record" class="iconb"></a></center></td>
                                                                                  
                                                </tr>
                                                ';
                                              
                                                include "eventModals.php";
                                                  }  
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
</script>

   

	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    </body>
</html>