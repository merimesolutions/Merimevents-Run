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
                    <a href="ani.php" title="Add Items "><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Add Item(s) </a>&nbsp;&nbsp;&nbsp;
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
                                      $iddd=$_GET['id'];
                                      $squery1 = mysqli_query($con, "SELECT id,item_name, qoutation_title, identitty, date_create, total_amount, unit_price, no_days, expire_date,quantity,quotation_status FROM tblquotation WHERE identitty=$iddd order by id DESC");
                                     
                                    $dkl = mysqli_fetch_assoc($squery1);  
                                          
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
                                  $og =mysqli_num_rows($squery1);
                                      if($og>0){
                                        while($data = mysqli_fetch_assoc($squery1))     
                                          {
                                          //  $idn=$data['id'] .'</br>.';
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
                                  <br>
                                  <div id="txtHint"></div>
                                  <br><br>

                                  <!-- additional items -->
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
<?php 
  include "../footer.php"; ?>


</body>
</html>