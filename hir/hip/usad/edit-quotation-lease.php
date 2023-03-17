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
$event_id=$_GET['id'];
?>

<?php
include('../connection.php');
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$db=$con;
if(isset($_POST['add_item'])){
  $quoteid = $_POST['idy'];
  $idi=$_POST['idi'];
  $quotet =$_POST['quotet'];
  $qs=$_POST['quotation_status'];
  $l_date=$_POST['l_date'];
  $c_date = $_POST['e_date'];
  $c_name = $_POST['c_name'];
  $item_name=$_POST['item_name'];
  $quantity=$_POST['quantity'];
  $up = $_POST['up'];
  $nod=$_POST['nod'];
  $des=$_POST['des'];
  $total_price = (int)$quantity * (int)$up * (int)$nod;
  $total =$total_price;

  // if(!empty($quantity) && !empty($up)){
  //   insert_data($quoteid, $quotet, $qs, $_l_date, $c_date, $item_name, $quantity,$up,
  //   $nod, $des, $total);
  // }else{
  //   echo "All fields required";
  // }

  // function legal_input($value){
  //   $value = trim($value);
  //   $value = stripslashes($value);
  //   $value = htmlspecialchars($value);
  // }

  // function insert_data($quoteid, $quotet, $qs, $l_date, $e_date, $item_name, $quantity,$up,$nod, $des, $total){
    global $db;
    $query = "INSERT INTO `tblquotation`(`identitty`, `item_name`, `description`, `no_days`, `quantity`, `unit_price`, `total_amount`, `qoutation_title`, `date_create`, `expire_date`, `quotation_status`,  `customer_name`)VALUES
    ('".$quoteid."','".$item_name."','".$des."','".$nod."', '".$quantity."', '".$up."', '".$total."',  '".$quotet."', '".$l_date."', '".$c_date."','".$qs."','".$c_name ."')";
    $execute=mysqli_query($db, $query);
    if($execute == true){
      echo "<script>alert('Item added successfully');window.location='quotation-list'</script>";
    }
    else{
      $error = mysqli_error($db);
      echo '<script>alert("An error occured during archiving : ' . "$error" . '");window.location="quotation-list"</script>';
      // echo  "<script>alert('An error occurred : ".'$error'."')</script>";
    }
  // }
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
    #myAdd{
      display: none;
    }
    </style>
    <script type="text/javascript">
function myFunction() {
  var x = document.getElementById("myAdd");
  if (x.style.display === "none") {
       
    x.style.display = "block";
    var quoteid = document.getElementById('quoteid').value;
     var quotet= document.getElementById('quotet').value;
     document.forms['insert']['quoteido'].value = quoteid;
     document.forms['insert']['quoteto'].value = quotet;
  } else {
    x.style.display = "none";
  }
}
    </script>

    <?php include('../head_css.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

<script>
$(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>

    <body class="skin-black">
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
    <?php
                function RandomID($length) {
                    $keys = array_merge(range(111,999));
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
                    <!-- <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp; -->
                    <a  href="quotation-list.php"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    <!-- <a href="more-items.php" title="Add Items "><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Add Item(s) </a>&nbsp;&nbsp;&nbsp; -->
                    <a class="float-left" role="button" data-toggle="modal" data-target="#myItem"><i class="fa fa-plus"></i> Add Item</a>&nbsp;&nbsp;&nbsp;
				
                  </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <p id="msg" style="color: red; font-weight: bold;"></p>
                        <!-- left column -->
                            <div class="box">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                          <h3>Create quotation</h3>
                                        </div>
                                    </div>    
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <?php
                                      ini_set('display_errors', 1); 
                                      ini_set('display_startup_errors', 1); 
                                      error_reporting(E_ALL);
                                      $iddd=$_GET['id'];
                                      $squery1 = mysqli_query($con, "SELECT * FROM tblquotation WHERE identitty=$iddd order by id DESC");
                                     
                                    $dkl = mysqli_fetch_array($squery1);  
                                          
                                           $idl=$dkl['id'] ;
                                              $idenl=$dkl['identitty'];
                                              $qtlel=$dkl['qoutation_title'];
                                              // $ldate = date('Y-M-d', strtotime($dkl['date_create']));
                                              $ldate=$dkl['date_create'];
                                            // $expdate = date('Y-M-d', strtotime($dkl['expire_date']));
                                              $expdate=$dkl['expire_date'];
                                              $dtll=$dkl['quotation_status'];
                                      echo 
                                      '<form method="post" action="edquote.php"> 
                                      <div class="row">
                                          <div class="col-lg-3">
                                              <label>Quotation ID</label>
                                              <input type="hidden" value="'.$idl.'" name="hidden_id" id="hidden_id"/>
                                              <input type="text" name="quoteid" id="quoteid" class="form-control" value="'.$idenl.'" readonly/> 
                                          </div>
                                          <div class="col-lg-3">
                                              <label>Quotation title</label>
                                              <input type="text" name="quotet" id="quotet" class="form-control"  value="'.$qtlel .'" readonly/>
                                          </div>
                                          <div class="col-lg-2">
                                              <label>Date</label>
                                              <input required name="l_date" id="l_date" class="form-control" style="width: 100%" type="date" value="'.$ldate.'"/>

                                          </div>
                                          <div class="col-lg-2">
                                              <label>Expiry Date</label>
                                              <input required name="e_date" id="e_date" class="form-control" style="width: 100%" type="date" value="'.$expdate .'"/>
                                              
                                          </div>
                                          <div class="col-lg-2">
                                            <label>Quotation status</label>
                                              <select name="q_status" class="form-control" id="quotation_status" Required>
                                                  <option value="'.$dtll.'" selected>'.$dtll.'</option>
                                                  <option value="Pending">Pending</option>
                                                  <option value="Approved">Approved</option>
                                                  <option value="Rejected">Rejected</option>
                                              </select>
                                          </div>
                                          <center><div class="row mt-5 mb-5">
                                          <div class="col-lg-12  mt-5 mb-5">
                                          <input type="submit" class="btn btn-primary btn-sm text-center" name="edit_reals" value="Save"/>
                                          <input type="submit" class="btn btn-primary btn-sm text-center" name="del_real" value="Delete Item"/>
                                          </div>
                                          </div></center>
                                  </div>
                                  </form>';

                                  echo '<table id="tab" class="table table-striped">
                                  <thead>
                                      <tr>
                                      <th style="width: 20px !important;"><input type="checkbox" name="chk_quote[]" class="cbxMain" onchange="checkMain(this)" />
                                  
                                          <th>Item Name</th>
                                          <th>No of days</th>
                                          <th>Quantity</th>
                                          <th>Unit price</th>
                                          <th style="width:80px !important;"><center>Edit</center></th>
                                      </tr>
                                  </thead>
                                 <tbody>';
                                 $squery23 = mysqli_query($con, "SELECT * FROM tblquotation WHERE identitty=$iddd order by id DESC");
                                  $og =mysqli_num_rows($squery23);
                                  // $og;
                                      if($og>0){
                                        while($data = mysqli_fetch_assoc($squery23))     
                                          {
                                              $iden=$data['identitty'];
                                              $qtle=$data['qoutation_title'];
                                              // $ldate = date('Y-M-d', strtotime($data['date_create']));
                                              $ldate=$data['date_create'];
                                            // $expdate = date('Y-M-d', strtotime($data['expire_date']));
                                              $expdate=$data['expire_date'];
                                              $iin=$data['item_name'];
                                              $qn1=$data['quantity'];
                                              $nd=$data['no_days'];
                                              $up=$data['unit_price'];
                                              $ta=$data['total_amount'];
                                            
                                        echo' 
                                        <tr>
                                        <td>
                                          <input type="hidden" value="'.$data['id'].'" name="identiti" id="hidden_id">           
                                          <input type="hidden" value="'.$data['identitty'].'" name="iddde" id="hidden_id"> </td> 
                                         
                                            <td>'.$iin.'</td>
                                            <td>'.$nd.'</td>
                                            <td>'.$qn1.'</td>
                                            <td>'.$up.'</td>
                                            <td><center><a class="float-left" role="button" data-toggle="modal" data-target="#edit-quote'.$data['id'].'"><i class="nav-icon fas fa-edit"> </i> Edit</a></center></td>
                                                
                                                        
                        </tr>';
                        include "edit-quote.php";
                      }}
                                              ?>
                                              <!-- <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/> -->
                                              <!-- <div class="col-lg-6" >
                                                      <label>Total amount </label>
                                                      <input name="tamt" id="" class="form-control input-sm" type="text" rows="4" value="' . $ta . '" />
                                                  </div> -->
                                          </tbody>
                                          </table>
                                </div>
                              </div>
                                  
                            <!-- <center><div><button class="btn btn-primary"onclick="showUser()">Add Items To Quotation</button></div></center> -->
                                  <!-- additional items -->

                                  <br>
                                  <div id="txtHint"></div>
                                  <br><br>

                                  <div class="row">
                                    <div class="col-lg-12">
                                      <?php
                                      $iddd=$_GET['id'];
                                      $squery1 = mysqli_query($con, "SELECT * FROM tblquotation WHERE identitty=$iddd order by id DESC");
                                     
                                    $dkl = mysqli_fetch_assoc($squery1);  
                                          
                                           $idl=$dkl['id'] ;
                                              $idenl=$dkl['identitty'];
                                              $qtlel=$dkl['qoutation_title'];
                                              // $ldate = date('Y-M-d', strtotime($dkl['date_create']));
                                              $ldate=$dkl['date_create'];
                                            // $expdate = date('Y-M-d', strtotime($dkl['expire_date']));
                                              $expdate=$dkl['expire_date'];
                                              $dtll=$dkl['quotation_status'];
                                      
?>
</div>
                    </div>
                                  
                                  <div id="myAdd">
                                  <form id="insert" method="post">
                                  <table class="table table-striped" id="table_field2">
                                        <tr>
                                            <th>Additional Item/Service</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th colspan="2">Supplier</th>
                                           
                                            </tr>
                                            <tr>
                                            <td>
                                              <input type="hidden" name="quoteido">
                                              <input type="hidden" name="quoteto">
                                              <input type="text" name="costName[]" class="form-control" required></td>
                                            <td><input type="text" name="costDescription[]" value="Nill" class="form-control" ></td>
                                            <td><input type="number" name="costQuantity[]" class="form-control" required></td>
                                            <td><input type="number" name="costPrice[]" class="form-control" required></td>
                                            <td>
                                              <select name="costSupplier[]" class="form-control input-sm" >
                                              <option value="" disabled selected>..Select..</option>
                                              <?php
                                                $a = mysqli_query($con,"SELECT * from tblsuppliers where company='".$_SESSION['company']."' ");
                                                  while($row=mysqli_fetch_array($a)){
                                                      echo '<option value="'.$row['id'].'">'.ucwords($row['full_name']).'</option>';
                                                                  }    
                                                    ?>
                                              </select>
                                              </td>
                                             <td style="width: 10px"><input type="button" name="add" id="add2" value="+" class="btn btn-warning"></td>
                                             </tr>
                                             </table>
                                             <center><button type="submit" title="Lease item" class="btn btn-success btn-sm" style="margin-top:10px;margin-left:20px; width:150px;" id="showData">  Save</button> </center>
                                           </form>
                                           </div>
                                    <!-- end of additional items -->
                                    <br><br><br>
                                  <div id="table-container"></div>
                                </div>
                              </div>
                            </div>
                          </section>
                        </aside>
                      </div>

<!-- Adding Items Modal -->
<form method="post">
		<div class="modal fade" id="myItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" style="color:teal; font-weight:bold;">
							<center>Add Item</center>
						</h4>
<!--             
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
						<button type="button" class="close" data-dismiss="modal"                                                                             al" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form">
           <?php
           
            $squery23 = mysqli_query($con, "SELECT * FROM tblquotation WHERE identitty=$iddd order by id DESC");
                                  // $og =mysqli_num_rows($squery23);
               $data = mysqli_fetch_assoc($squery23);     
                                          
                                              $iden=$data['identitty'];
                                              $qtle=$data['id'];?>
                                               <?php
                                      $a = mysqli_query($con,"SELECT * from tblitems where qnty>0 ORDER BY item_name");
                                        $row=mysqli_fetch_array($a);
                                        $idd=$row['id'];
                                            $nin= $row['item_name'];
                                            $nlc=$row['lease_charges']
                                                                                            
                                          ?>
              <input type="text" value="<?php echo $data['id']?>" name="idi" id="hidden_id">           
              <input type="text" value="<?php echo $data['identitty']?>" name="idy" id="hidden_id"> </td> 
              <input type='text' name='quotet' class='form-control' value='<?php echo $data['qoutation_title']?>'>
              <input type='text' name='l_date' class='form-control' value='<?php echo $data['date_create']?>'>
              <input type='text' name='e_date' class='form-control' value='<?php echo $data['expire_date']?>'>
              <input type='text' name='quotation_status' class='form-control' value='<?php echo $data['quotation_status']?>'>
              <input type='text' name='c_name' class='form-control' value='<?php echo $data['customer_name']?>'>
              <label style="margin-top: 20px;">Item Name</label>
              <select name="item_name" class="form-control input-sm" >
                <option value="" disabled selected>..Select..</option>
                  <?php
                    $a = mysqli_query($con,"SELECT * from tblitems where qnty>0 and company='".$_SESSION['company']."' ORDER BY item_name");
                    while($row=mysqli_fetch_array($a)){
                      echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).'</option>';
                    }
                  ?>
              </select>
							<br>
              <label style="margin-top: 20px;">Quantity</label>
								<input type="number" class="form-control bg-white border-left-0 " name="quantity" min='1' placeholder="0" Required>
							<br>
              <label style="margin-top: 20px;">Unit Price</label>
                <input type="number" class="form-control bg-white border-left-0 " name="up" min="1" value="<?php echo $nlc?>" Required>
              <br>
              <label style="margin-top: 20px;">No of days</label>
									<input type="number" class="form-control bg-white border-left-0 " name="nod" min='1' placeholder="" Required>
							<br>
              <label style="margin-top: 20px;">Description</label>
							<input type="text" class="form-control bg-white border-left-0 " name="des" min='1' placeholder="" Required>
							<br>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="add_item" class="btn btn-success">Submit</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</form>


<!-- End of adding items modal -->


<?php 
  include "../footer.php"; ?>

<script>
//get data
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
     var event_id ='<?php echo $_GET["id"];?>';
     var quoteid = document.getElementById('quoteid').value;
     var quotet= document.getElementById('quotet').value;
     var l_date= document.getElementById('l_date').value;
     var e_date= document.getElementById('e_date').value;
     var quotation_status= document.getElementById('quotation_status').value;
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","more-items?q="+str+"&c="+event_id+"&quoteid="+quoteid+"&quotet="+quotet+"&l_date="+l_date+"&e_date="+e_date+"&quotation_status="+quotation_status,true);
    xmlhttp.send();
  }
} 
</script>
</body>
</html>