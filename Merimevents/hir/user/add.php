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
<!DOCTYPE html>
<html>
    <style type="text/css">
        .icon{
            width: 30px;
            padding-right: 10px;
        }
        .iconb{
            width: 30px;
            padding-right: 10px;
        }
        .icon:hover{
            transition: 0.3s;
            /*box-shadow: 2px 0px 20px rgba(0, 0, 0, 0.8);*/
        }
        button .save{
           background-color:green;
        }
        .button{
            width: 40px;
        }
        .top-wrapper{
           /* background-color: black;
            padding: 0 5px 5px 5px;
            border-radius: 5px;*/
        }
        .sidebar-menu .active{
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
                    <a href="ocr.php" title="Go home"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go home"></i> Back</a>&nbsp;&nbsp;&nbsp;
                    
                    <a href="ani.php" title="Add Items "><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Add Item(s) </a>&nbsp;&nbsp;&nbsp;
         
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">

                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <div class="top-wrapper">
                                                                <?php
                                                                
                                $search = $_GET['client'];
                                if($search){
                                  $sql=mysqli_query($con,"select * from tblcustomers where identity='".$search."' and company='".$_SESSION['company']."' ");
                                  while ($row=mysqli_fetch_array($sql)) {
                              ?>
                              <table class="table table-striped">
                                <tr>
                                  <th scope>Customer Name</th>
                                  <th scope>National ID No.</th>
                                  <th scope>Gender</th>
                                  <th>Contact</th>
                                </tr>
                                <tr style="background-color:#EBF5FB;">
                                  <td><?php  echo ucwords($row['fname']).' '.ucwords($row['lname']).' '.ucwords($row['mname']);?></td>
                                  <td><?php  echo $row['identity'];?></td>
                                  <td><?php  echo $row['gender'];?></td>  
                                  <td><?php  echo ucwords($row['fcontact']).'  '.ucwords($row['scontact']);?></td>
                                </tr>               
                            <?php }echo '</table>';
                                }else{  ?> 
  <div class="form-group"> 
  <div class="row">
      <div class="col-lg-4">
   <div class="input-group mb-2">
       
        <span class="input-group-addon bg-white border-right-0 px-4"><i class="fa fa-user"></i></span>   
       
    <input type="text" class="form-control" name="customer_name" value=""  list="cust" id="data1"  onchange="get_data()" placeholder="Enter Customer Name" Required>
     
     <datalist id="cust"  style="list-style:none!important;">
       <?php 
           
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                $sp=mysqli_query($con,"SELECT * FROM tblcustomers WHERE company='".$_SESSION['company']."'");
                if($sp){
                  
                while ($row = mysqli_fetch_assoc($sp)){
                    
                    
            ?>
               
                <option   data-value="<?php echo $_GET['client'] = $row['identity'];?>"   value="<?php echo $row['fname'].' '.$row['mname'].' '.$row['lname'];?>">
               
                  
                </option>
            <?php 
                }
                  
                }
                 
            ?>
        
    </datalist>
      </div>
        <button class="btn btn-sm btn-primary" role="button" data-toggle="modal" data-target="#addCust" style="margin-top:20px;">Add New Customer <i class="fa fa-user-plus"></i></button> 
     </div>
    </div>
    </div>
                            <?php }?>
                          
                          </div>
                          <br>

                          <p  style="font-size:12px;">
                                     Lease Item(s)
                                  </p>
                                <form method="post" class="insert=form" id="insert_form" action="">
                                    <table class="table table-striped" id="table_field">
                                        <tr>
                                            <th style="width: 200px">Item Name</th>
                                            <th>Quantity</th>
                                            <th>Price (for @ per day)</th>
                                            <th>Description</th>
                                            <th>Return date</th>
                                            <!--<th>Pick date</th>-->
                                            <th style="width: 10px"></th>
                                        </tr>

                                        <?php
                                        $connn = mysqli_connect("localhost","merimeve_event","user@event","merimeve_event");

                                        if(isset($_POST['save'])){
                                        $txtItem_name = $_POST['txtItem_name'];
                                        $txtQnty = $_POST['txtQnty'];
                                        $txtbal_Qnty = $_POST['txtQnty'];
                                        $txtbal_Price= $_POST['txtPrice'];
                                        $txtRdate = $_POST['txtRdate'];
                                        $today = date("Y-m-d");
                                        $txtDescription = $_POST['txtDescription'];
                                        $served_by=$_SESSION['username'];
                                        $comment="not cleared";
                                        $date=date("Y-m-d");
                                        $time=date("h:i:sa");
                                        $random =date("Y-m-dh:i:sa");
                                      
                                             $member = $_POST['id_yake'];
                                         
                                        $invoice = $_POST['invoice'];
                                        $cancellation = "active";
                                        $company=$_SESSION['company'];
   
                                            foreach($txtItem_name as $key => $value){
                                         $save = "INSERT INTO tblleased(item_name_id, qnty, qlty, rdate, ldate, served_by, client, bal_qnty, price,comment,lease_time,random,invoice, company,cancellation)VALUES('".$value."','".$txtQnty[$key]."','".$txtDescription[$key]."','".$txtRdate[$key]."','$today','".$served_by."','".$member."','".$txtQnty[$key]."','".$txtbal_Price[$key]."','".$comment."','".$time."','".$random."','".$invoice."','".$company."','".$cancellation."')";
                                                $query = mysqli_query($connn, $save);
                                            
                                            if($query == true){
                                        echo '<script type="text/javascript">'; 
                                        echo 'alert("Record saved successfully.");';
                                        echo 'window.location = "ilp.php";';
                                        echo '</script>';
                                                }
                                            }
                                        }
                                        ?>

                                        <tr>
                                            <td><select name="txtItem_name[]" id="txtItem_name[]" type="text"  class="form-control input-sm">
                                                <option value="" selected disabled>Select item</option>
                                                      <?php
                                                        $a = mysqli_query($con,"SELECT * from tblitems where company='".$_SESSION['company']."' order by item_name");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).'</option>';
                                                          }    
                                                      ?>
                                                </select></td>
                                                <input type="hidden" id="id_yake" name="id_yake" class="form-control" value="<?php echo $_GET['client'];?>"  >
                                            <td><input type="text" name="txtQnty[]" class="form-control" required></td>
                                            <td><input type="text" name="txtPrice[]" class="form-control" required></td>
                                            <td><textarea name="txtDescription[]" class="form-control" required=""></textarea></td>
                                            <td><input type="date" name="txtRdate[]" class="form-control" required></td>
                                            <!--<td><input type="datetime-local" name="txtPdate[]" class="form-control" required></td>-->
                                            <td><input type="button" name="add" id="add" value="+" class="btn btn-info"></td>
                                        </tr>
                                    </table><br>
                                    <input type="hidden" name="invoice" value="<?php echo RandomString(7); ?>"/>
                                    
                                    <center><button type="submit" class="btn btn-success" name="save" id="save" title="Save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>&nbsp;&nbsp;&nbsp;
                                        <button type="reset" class="btn btn-default" title="Reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button></center>
        
                                    </form>
                                </div><!-- /.box-body -->

                            </div><!-- /.box -->
            <!--?php include "../notification.php"; ?-->
            <!--?php include "../addModal.php"; ?-->
            <!--?php include "../addfunction.php"; ?-->
            <!--?php include "editfunction.php"; ?-->
            <!--?php include "deletefunction.php"; ?-->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
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
function get_data(){
    
   var shownVal = document.getElementById("data1").value;
   var value2send = document.querySelector("#cust option[value='"+shownVal+"']").dataset.value;
    var id = document.getElementById('id_yake').value= value2send;
  
}
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    <script type="text/javascript">
        $(document).ready(function(){
            var html = '<tr><td><select name="txtItem_name[]" id="txtItem_name[]" type="text"  class="form-control input-sm"><option value="" selected disabled>Select item</option><?php
                                                      $date=date("Y-m-d");
                                                        $a = mysqli_query($con,"SELECT * from tblitems where company='".$_SESSION['company']."' order by item_name");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).'</option>';
                                                          }    
                                                      ?>
                                                </select></td><td><input type="text" name="txtQnty[]" class="form-control" required></td></td><td><input type="text" name="txtPrice[]" class="form-control" required></td><td><textarea name="txtDescription[]" class="form-control" required=""></textarea></td></td><td><input type="date" name="txtRdate[]" class="form-control" required></td><td><input type="datetime-local" name="txtPdate[]" class="form-control" required></td><td><input type="button" name="remove" id="remove" value="x" class="btn btn-danger"></td></tr>';

            var x = 1;

            $("#add").click(function(){
                $("#table_field").append(html);
            }); 
            $("#table_field").on('click','#remove',function(){
                $(this).closest('tr').remove();
            }); 

        });
    </script>
    </body>
</html>