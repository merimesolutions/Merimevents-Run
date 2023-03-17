<?php
include '..connection.php';
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
    <?php include('../head_css.php'); ?>
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
        .sidebar-menu .ocr{
        background-color:#009999;
    }
    </style>
    <body class="skin-black">
        
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>
      
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    <a class=""  href="archived-quote"  title="Archived demo" style="margin-bottom:5px;"><i class="fa fa-archive" ></i> Archived quotations</a>    
                    &nbsp;&nbsp;<a class="btn btn-success" href="add-quotation-lease" title="Create quotation"><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Create quotation </a>&nbsp;&nbsp;&nbsp;
                 
                    <!-- 
                    <a data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" aria-hidden="true" title="Delete selected item"></i> Delete</a> -->
                  
                </section>
            
                <!-- Main content -->
                <section class="content">
                             <div class="row">
                        <div class="box">

                        <!-- left column -->
                                <div class="box-body table-responsive">
                                <form method="post" action="edquote.php"  novalidate>
                                <!-- <button type="submit" onclick="return confirm('Are you sure you want to delete these clients?')" name="submit_quote" style="margin-top:10px!important; float:right;  margin-bottom:10px!important" class="btn btn-danger btn-sm ">Delete selected quotation <i class="fas fa-book"></i></button><br> -->
                                <div class="dropdown " >
                                    <button class="btn btn-danger btn-sm dropdown-toggle d-flex justify-content-right align-items-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float:right; padding: 2px 20px; margin-left:892px; margin-bottom:10px;">
                                    Action
                                    </button>
        
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="padding:10px;">
                                        <input type="submit" name="archive_quote"  class="dropdown-item " style="background-color:transparent ; border:none;" value="Archive Quote">
                                        <input type="submit" name="delete_quote"  class="dropdown-item " id="deleteDB" style="margin-top:10px !important;background-color:transparent; border:none;" value="Delete Quote" >

                                    </div>
                                </div>  
                            <table id="table" class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th style="width: 20px !important;"><input type="checkbox" name="chk_quote[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                            <th>S.N</th>
                                            <th>Quotation ID</th>
                                            <!-- <th>Quotation title</th> -->
                                            <th>Customer Name</th>
                                            <th>Date created</th>
                                            <th>Expiry date</th>
                                            <th>Quotation status</th>
                                            <th style="width:50px !important;"><center>Edit</center></th>
                                       
                                            <th style="width:50px !important;"><center>Generate</center></th>
                                            <th style="width:50px !important;"><center>Print</center></th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                             <!--td><a class="" style="cursor: pointer;" onclick="myDel('.$data['item_id'].')"><i class="fa fa-edit"> </i> Edit</a></td-->
                               <?php
                               $sn = 1;
                               $c= $_SESSION['company'];
                            //    $id1=$_GET['id'];
                            //    $squer(DISTINCT  identitty) y1 = mysqli_query($con, "SELECT * from tblquotation WHERE company='".$_SESSION['company']."' ORDER BY id DESC");
                            // $squery1 = mysqli_query($con, "SELECT 
                            // id, item_name,  total_amount, unit_price, no_days, quantity, qoutation_title, date_create, expire_date, quotation_status FROM tblquotation where (dell=0 or dell=NULL) AND inv=0
                            // order by id DESC");
                             $squery1 = mysqli_query($con, "SELECT DISTINCT  identitty, qoutation_title, date_create, expire_date, quotation_status, customer_name  FROM tblquotation where (dell=0 or dell=NULL) AND inv=0 AND company = '$c' 
                        ");

                              
                            $og =mysqli_num_rows($squery1);
                           
                            //    if($og>0){
                                    while($data = mysqli_fetch_array($squery1))                                
                                //    foreach($squery as $data)
                                    {
                                        // print_r($data);
                                        $idd=$data['id'];
                                        $idee= $data['identitty'];
                                        $qtt = $data['qoutation_title'];
                                        $dae=$data['date_create'];
                                        $e_date=$data['expire_date'];
                                        $it=$data['item_name'];
                                        $nd=$data['no_days'];
                                        $qnt=$data['quantity'];
                                        $unt=$data['unit_price'];
                                        $tamt=$data['total_amount'];
                                        $q_status=$data['quotation_status'];
                                        $cn=$data['customer_name'];
                                    echo '<tr>
                                        <td>
                                        <input type="hidden" value="'.$data['id'].'" name="identiti" id="hidden_id">           
                                        <input type="hidden" value="'.$data['identitty'].'" name="iddde" id="hidden_id">                                                                                
                                        <input type="checkbox" name="chk_quote[]" class="chk_quote" value="'.$idee.'" /></td> 
                                            <td>'.$sn++.'</td>
                                            <td>'.$idee.'</td>
                                            <td>'.$cn.'</td>
                                            <td>'.$dae.'</td>
                                            <td>'.$e_date.'</td>
                                            <td>'.$q_status.'</td>
                                            
                                            <td><center><a class="form-group" style="" href="edit-quotation-lease?id='.$idee.' "  ><i class="nav-icon fas fa-edit"> </i> </a></center></td>
                                            <td><a class="btn btn-primary btn-sm form-group" target="_blank" style="" href="generate-invoice?id='.$idee.' " ><i class="fas fa-print"></i>&nbsp;Generate Invoice</a></td>
                                           
                                            <td><a class="btn btn-success btn-sm form-group" target="_blank" style="" href="print-quotation-lease?id='.$idee.' " ><i class="fas fa-print"></i>&nbsp;Print</a></td>
                                    
                        </tr>';
                                   
                                    
                                // include "editQuote.php";
                               }
                            //    <td><center><a class="float-left" role="button" data-toggle="modal" data-target="#editQuote'.$data['id'].'"><i class="nav-icon fas fa-edit"> </i> Edit</a></center></td>
                            ?>
                            </tbody>
                            </table>
                            <!--<td><a class="form-control btn btn-info" data-target="#editQuote'.$data['id'].'" data-toggle="modal"><small><i class="nav-icon fas fa-edit"> </i> Edit</small></a></td>  
                                            
                                // <td> <a class="btn btn-primary btn-sm form-group" type="submit" name="invoice" style="" target="_blank" href="generate-invoice?id='.$idee.' "  ><i class="fas fa-download"></i>&nbsp;Generate Invoice</a></td>
                                            // </td> // <td> <center><a class="form-group" style="" href="edit-quotation-lease?id='.$idd.' "  ><i class="nav-icon fas fa-edit"> </i> Edit</a></center></td>
                                        
                                // <td><input id="inp" type="submit" value="Generate Invoice" name="invoice" onclick="location.href="generate-invoice?id='.$idee.'";" /></td>
                                // <td><a class="btn btn-primary btn-sm form-group"  style="" target="_blank" href="generate-invoice?id='.$idee.' "  ><i class="fas fa-download"></i>&nbsp;Generate Invoice</a></td>
                                                     
                                // <td><a class="btn btn-primary btn-sm form-group" type="submit" name="invoice" style="" target="_blank" href="generate-invoice?id='.$idee.' "  ><i class="fas fa-download"></i>&nbsp;Generate Invoice</a></td>
                                // <a class="btn btn-primary btn-sm form-group" type="submit" name="invoice" style="" target="_blank" href="generate-invoice?id='.$idee.' "  ><i class="fas fa-download"></i>&nbsp;Generate Invoice</a></td> -->
                                
                            <!-- <td><center><a class="float-left" role="button" data-toggle="modal" data-target="#editQuote'.$idd.'"><i class="nav-icon fas fa-edit"> </i> Edit</a></center></td> -->
                                   
                                    <?php
                                    // include "editQuote.php";
                                     include "../deleteModal.php"; 
                                     include "../edquote.php"; 
                                     ?>
                                  
                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <!-- <div id="editQuote'.$data['id'].'" class="modal fade">
                            <form method="post">
                                <div class="modal-dialog modal-sm" style="width:450px !important;">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border-radius:2px;color:#000">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title"><center><strong>Edit Quotation</strong></center></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" value="<?php echo $data['id'] ?>" name="hidden_id" id="hidden_id"/>
                                                    <input type="hidden" value="<?php echo $c ?>" name="hidden_company" id="hidden_id"/>
                                                
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Item name</label>
                                                        <select name="users"  class="form-control input-sm" style="background: linear-gradient(to right, #00ffff 0%, #66ccff 100%);">
                                                            <option value=""><?php echo ucwords($data['item_name']);?></option>
                                                                    <?php
                                                                    // $a = mysqli_query($con,"SELECT * from tblitems where qnty>0 and company='$c' order by item_name");
                                                                    //     if($a){
                                                                    //         while($a = mysqli_fetch_assoc($a)){?>
                                                                                <option value="<?php echo $data["id"];
         
?>">
                    <?php echo $data["item_name"];
        // To show the category name to the user
?>
                </option>
            <?php
    // }
// }
// While loop must be terminated
?>
                                                                            }
                                                                            
                                                                            }    
                                                                    ?>
                                                        </select>
                </div>
                <div class="form-group">
                    <label>Description </label>
                    <input name="desc" id="" class="form-control input-sm" type="text" rows="4" value="<?php $data['description'] ?>" />
                </div>
                <div class="form-group">
                    <!-- <label>Number of days </label>
                    <input name="days" id="" class="form-control input-sm" type="text" rows="4" value="<?php $data['no_days'] ?>" />
                </div>
              
                
                
                <div class="form-group">
                    <label>Quantity</label>
                    <input name="quant" id="" class="form-control input-sm" type="text" rows="4" value="<?php  $data['quantity'] ?>" />
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_editquote1" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div> -->

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
    function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
     var event_id ='<?php echo $_GET["id"]; ?>';
     var quoteid = document.getElementById('quoteid').value;
     var quotet= document.getElementById('quotet').value;
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","get-item-quote-lease.php?q="+str+"&c="+event_id+"&quoteid="+quoteid+"&quotet="+quotet,true);
    xmlhttp.send();
  }
} 
  function goBack() {
  window.history.back();
}
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>