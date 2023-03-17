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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include('../head_css.php'); ?>
    <style type="text/css">
        .icon{
            width: 45px;
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
        .scrollable {
    height: 500px; /* or any value */
    overflow-y: auto;
}
a{text-decoration:none;color:#000;}
#myList{
     display: inline-block;
}
.sidebar-menu .invoices{
        background-color:#009999;
    }
    </style>
    <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
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
                    <a href="ocr.php" title="Lease item"><i class="fa fa-refresh" aria-hidden="true" title="Lease item"></i> Lease items</a>
                </section>
                <form method="post">

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="box-body table-responsive">                                    
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>                                        
                                        <th style="width: 15px !important;"><i class="fa fa-list"></i></th>
                                        <th style="width: 100px !important;">Invoice</th>
                                        <th>Date</th>
                                        <th>Expiry Date</th>
                                        <!-- <th>Customer ID</th> -->
                                        <th>Full Name </th>
                                                <!--th style="text-align:right;">Amount</th>
                                                <th style="text-align:right;">Balance</th-->
                                        <th style="text-align:center;">Status </th>
                                        <th style="text-align:center;">Receipts</th>
                                        <th><center>Preview</center></th>
                                        <th style="width: 40px !important;text-align:center;">Pay</th>
                                        <th style="width: 40px !important;text-align:center;">Edit</th>
                                        <th style="width: 40px !important;text-align:center;">Cancel </th>                                                
                                    </tr>
                                </thead>
                                <tbody>
                                               <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "SELECT distinct random,invoice from tblleased where company='".$_SESSION['company']."' and cancellation ='active' group by item_id ");
                                            while($rows = mysqli_fetch_array($squery))
                                            { 
                                         $query = mysqli_query($con, "SELECT * FROM tblleased where random='".$rows['random']."' limit 1");
                                            while($row = mysqli_fetch_array($query))
                                            {
                                                $random =$row['random'];
                                                $invoice =$row['invoice'];
                                                $r=$row['client'];
                                                $c = mysqli_query($con, "SELECT * FROM tblcustomers where identity='".$r."' ");
                                                while($data = mysqli_fetch_array($c))
                                            {
                                                $fname=$data['fname'];
                                                $mname=$data['mname'];
                                                $lname=$data['lname'];
                                            }
                                            
                                            $swali = mysqli_query($con,"SELECT item_id,item_name_id, qnty, price,total_cost,amount, ldate,rdate, random from tblleased where random = '$random'");
                                            $items_id_things = mysqli_fetch_assoc($swali);
                                            $pesa= 0;
                                             $item_id = $items_id_things['item_name_id'];
                                             $i_id = $items_id_things['item_id'];
                                            $total_cost =$items_id_things['total_cost'];
                                            $amount =$items_id_things['price'];
                                            $qnty=$items_id_things['qnty'];
                                            $ldate = $items_id_things['ldate'];
                                            $expdate=$items_id_things['rdate'];
                                            $rr=  $items_id_things['random'];
                                            $money_q = mysqli_query($con,"SELECT * FROM tblitems where id = '$item_id '");
                                            $x = mysqli_fetch_assoc($money_q);
                                            $itemn=$x['item_name'];
                                            // // $total=mysqli_query($con,'select amount  from tblleased WHERE random = "'.$random.'" ');
                                            // $counter = mysqli_num_rows($total);
                                            // $ttle = mysqli_fetch_array($total);
                                            
                                         $bal = $total_cost - $amount; 
                                          if(empty($amount)){ 
                                    $status = '<span
                                          style="color:red;">' ."Not
                                          Paid". '</span>'; }
                                          if($amount == $total_cost){ 
                                            $status = '<span
                                          style="color:green;">' ."Fully
                                          paid". '</span>'; } 
                                          if(
                                          ($bal>0 ) && ($bal<$total_cost))
                                          { $status = '<span
                                          style="color:brown;">' ."Partially
                                          Paid". '</span>'; }
                                          if($bal<0 )
                                          { $status = '<span
                                          style="color:warning;">' ."Over
                                          paid". '</span>'; }//____________________________________________________________________
                                          echo '
                                            
                                            <tr> 
                                                <td><a href=ilp-prev?tm='.$invoice.' ><img src="../../images/icons/folder_open.png" class="iconb"title="Print invoice: '.$row['invoice'].'"></a></td>
                                                <td><a href=ilp-prev-inv?tm='.$invoice.' ">'.$row['invoice'].'</a></td> 
                                                <td><a href=ilp-prev-inv?tm='.$invoice.' >'.$row['ldate'].'</a></td>
                                                <td><a href=ilp-prev-inv?tm='.$invoice.' >'.$row['rdate'].'</a></td>
                                               
                                                <td><a href=ilp-prev?tm='.$invoice.' >'.ucwords($fname).' '.ucwords($lname).' '.ucwords($mname).'</a></td>
                                                <td style="text-align:center;font-weight:bold;"><a href=ilp-prev-inv?tm='.$invoice.' >'.$status.' </a></td>
                                                
                                                <td><center><a href="transactions?tjk78wenm4yuwernmnmzxcyunmnmztye7834nm434nm43rf//578nmsdjn//sdfjkmerime='.$row['random'].'"><img src="../../images/icons/eye.png" title="Preview invoice" class="iconb"></a></center></td>
                                                <td><center><a  href="ilp-prev-inv?tm='.$invoice.'" target="_parent" class="form-control btn-success"><i class="fas fa-file-invoice"></i></a></center></td> 
                                                <td><a class="form-control btn btn-info" data-target="#editpay'.$row['invoice'].'" data-toggle="modal"><small>Pay</small></a></td>  
                                                <td><center><a class="form-control" data-target="#editq'.$row['invoice'].'" data-toggle="modal"><i class="nav-icon fas fa-edit"> </a></center></td>  
                                                <td><a class="form-control btn btn-danger" href="invoice-cancellation?invoice='.$row['invoice'].'"><small>Cancel</small></a></td>                           
                                                </tr>
                                                ';
                                                 // include "editq.php";
                                                 include "editpay.php";
                                            }
                                            // include "editq.php";
                                            }
                                            ?>
                                </tbody>
                            </table>
                        </div>                                   
                    <script>
                        function myFunction() {
                          var input, filter, img, tr, td, i, txtValue;
                          input = document.getElementById("myInput");
                          filter = input.value.toUpperCase();
                          table = document.getElementById("myTable");
                          tr = table.getElementsByTagName("tr");
                          for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[0];
                            if (td) {
                              txtValue = td.textContent || td.innerText;
                              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                              } else {
                                tr[i].style.display = "none";
                              }
                            }       
                          }
                        }
                    </script>
                </div><!-- /.box-body -->
                <section>
                <a href="quotation-list.php" title="Lease item"><i class="fa fa-refresh" aria-hidden="true" title="Lease item"></i> Quotation items</a>
               
                </section>
                 <div class="row">
                        <div class="box-body table-responsive">                                    
                            <table id="table" class="table table-striped"> 
                                <thead>
                                    <tr>                                        
                                        <th style="width: 15px !important;"><i class="fa fa-list"></i></th>
                                         <!-- <th style="width: 100px !important;">Invoice</th> -->
                                        <th>Quotation ID</th>
                                        <th>Quotation Title</th>
                                        <th>Customer Name</th>
                                        <th>Date Created</th>
                                        <th>Expiry Date</th>
                                        <!-- <th style="text-align:right;">Amount</th> -->
                                        <!-- <th style="text-align:right;">Balance</th> -->
                                         <!-- <th style="text-align:center;">Status </th> -->
                                        <th style="text-align:center;">Receipts</th>
                                        <th><center>Preview</center></th>
                                        <th style="width: 40px !important;text-align:center;">Pay</th>
                                        <th style="width: 40px !important;text-align:center;">Cancel </th>                                                 
                                    </tr>
                                </thead> 
                                               <?php
                                            $c=1;
                                            $sess=$_SESSION['company']; 
                                            $squery2 = mysqli_query($con, "SELECT DISTINCT identitty, qoutation_title, date_create, expire_date, customer_name from tblquotation where inv = 1 and company='".$sess."' ");
                                            while($rows2 = mysqli_fetch_array($squery2))
                                            { 
                                      
                                                $quotid =$rows2['identitty'];
                                                $quottle =$rows2['qoutation_title']; 
                                                $datte=$rows2['date_create'];
                                                $exp=$rows2['expire_date'];
                                                $cn=$rows2['customer_name'];
                                            
                                            $swali2 = mysqli_query($con,"SELECT item_name,description, no_days, quantity, unit_price, total_amount, customer_name from tblquotation where inv=1 and company='".$_SESSION['company']."'");
                                            $items_id_things = mysqli_fetch_assoc($swali2);
                                            $pesa= 0;
                                             $itemname = $items_id_things['item_name'];
                                             $descc = $items_id_things['description'];
                                             $dayss=$items_id_things['no_days'];
                                             $quant=$items_id_things['quantity'];
                                             $unit =$items_id_things['unit_price'];
                                            $total_amt =$items_id_things['total_amount'];
                                            // $cn =$items_id_things['customer_name'];
                                          echo '
                                            <tr>           
                                            <td><a href=ilp-prev?tm='.$invoice.' ><img src="../../images/icons/folder_open.png" class="iconb"title="Print invoice: '.$row['invoice'].'"></a></td>
                                                                                                                                   
                                                <td><a href=ilp-prev?tm='.$invoice.' ">'.$quotid.'</a></td> 
                                                <td><a href=ilp-prev?tm='.$invoice.' >'.$quottle.'</a></td>
                                                <td><a href=ilp-prev?tm='.$invoice.' >'.$cn.'</a></td>
                                                <td><a href=ilp-prev?tm='.$invoice.' >'.$datte.'</a></td> 
                                                <td><a href=ilp-prev?tm='.$invoice.' >'.$exp.'</a></td> 
                                                <td><center><a href="transactions_quote?id='.$rows2['identitty'].'"><img src="../../images/icons/eye.png" title="Preview invoice" class="iconb"></a></center></td>
                                                 <td><center><a  href="ilp-prev?id='.$rows2['identitty'].'" target="_parent" class="form-control btn-success"><i class="fas fa-file-invoice"></i></a></center></td> 
                                                 <td><a class="form-control btn btn-info" data-target="#editpay'.$row['invoice'].'" data-toggle="modal"><small>Pay</small></a></td>  
                                                 <td><a class="form-control btn btn-danger" href="invoice-cancellation?invoice='.$row['invoice'].'"><small>Cancel</small></a></td>                           
                                             </tr>';
                                                
                                                include "editpay.php";
                                             }
                                            ?>
                                </tbody>
                         </table>
                        </div>   
            </div> 

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


                       <!-- /.row -->
                                                    
                </section><!-- /.content -->
                </form>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
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
    </body>
</html>