<?php
  session_start();
//   ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
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
.sidebar-menu .reports{
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
                    <a href="revenue-report?start=<?php echo $_GET['start']; ?>&end=<?php echo $_GET['end']; ?>" target="_blank" ><i class="fa fa-print" aria-hidden="true" title="Print"></i> Print</a>
                </section>
                <form method="post">

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                                  
                                <div class="box-body table-responsive" style="background:#fff;margin:20px;box-shadow: 5px 5px 5px 5px  #888888;padding:15px 10px;">
                                    
                                    
                                    <?php
                                       $company =$_SESSION['company'];
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
                                    ?>
                                     <h4><strong><center>Revenue report from <i style="color:green;"><?php echo $_GET['start'];?></i> to <i style="color:green;"><?php echo $_GET['end']; ?></i></center></strong></h4> 
                                 <?php 
                                 $select_report_type = $_GET['select_report_type'];
                                   switch ($select_report_type){
                                    case 'generalsales':
                                 ?>   
                                    <table id="table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 15px !important;">No.</th>
                                                <th>Item Name</th>
                                                <th>Date Invoiced</th>
                                                <th>Invoice Number</th>
                                                <th style="text-align: right;">Total amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
                                                   $c=1;

$stmt = $conn->query('select * from tblleased WHERE company = "'.$_SESSION['company'].'" AND (ldate BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") and ((cdate BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") or cdate IS NULL) ');
        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $invoice = $row->invoice;
    $items=$conn->query('select * from tblitems WHERE id = "'.$row->item_name_id.'" ');
    while($i = $items->fetch(PDO::FETCH_OBJ)){
        $item = $i->item_name;
    $amount=$conn->query('select sum(amount) as paid from tbltransactions WHERE invoice = "'.$row->invoice.'" and (date_paid BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") ');
    while($a = $amount->fetch(PDO::FETCH_OBJ)){
      $ldate = date('Y-m-d',strtotime($row->ldate));
                                                echo '
                                            
                                            <tr> 
                                                <td>'.$c++.'</td>
                                                <td>'.ucwords($item).'</td> 
                                                <td>'.$ldate.'</td>
                                                <td>'.$row->invoice.'</td> 
                                                <td style="text-align: right;">'.number_format($row->total_cost,2).'</td>
                                                </tr>
                                                
                                                ';
                                                
                                                //include "editpay.php";
    }  
}
            }
            
    
                                            ?>
                                            <tr>
                                                <th colspan="7"></th>
                                            </tr>
                                             <?php
$total=$conn->query('select SUM(total_cost) AS product from tblleased WHERE company = "'.$_SESSION['company'].'" AND (ldate BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") and ((cdate BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") or cdate IS NULL) ');
    while($rows = $total->fetch(PDO::FETCH_OBJ)){
        
$amount=$conn->query('select sum(amount) as paid from tbltransactions WHERE company = "'.$_SESSION['company'].'" and (date_paid BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") and (date_paid BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") ');
    while($a = $amount->fetch(PDO::FETCH_OBJ)){
      $ldate = date('Y-m-d',strtotime($rows->ldate));
    
                                 ?>   
                              <tr>
                                  <th colspan="4" style="text-align: right;">Grand Total</th>
                                  <th style="text-align: right;"><?php echo number_format($rows->product,2); ?></th>
                              </tr>
                              <tr>
                                  <th colspan="4" style="text-align: right;">Amount Paid</th>
                                  <th style="text-align: right;"><?php echo number_format($a->paid,2); ?></th>
                              </tr>
                              <tr>
                                  <th colspan="4" style="text-align: right;">Balance</th>
                                  <th style="text-align: right;"><?php echo number_format(($rows->product)-$a->paid,2); ?></th>
                              </tr>

 <?php }  }
 ?>
                                        </tbody>
                                        
                                    </table>
                                    <?php 
                                      break;
                                      case 'damagedsales':
                               
                                            $c=1;
                           
                              ?>
                         <table id="table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 15px !important;">No.</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Date Invoiced</th>
                                                <th>Invoice Number</th>
                                                <th style="text-align: right;">Total amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
                                                   $c=1;

$stmt = $conn->query("SELECT * FROM tblleased where damaged IS NOT NULL and  company = '".$_SESSION['company']."'  ");
        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $invoice = $row->invoice;
        $damages= $row->damaged;
    $items=$conn->query('select * from tblitems WHERE id = "'.$row->item_name_id.'" ');
    while($i = $items->fetch(PDO::FETCH_OBJ)){
        $item = $i->item_name;
    $amount=$conn->query('select sum(amount) as paid from tbltransactions WHERE invoice = "'.$row->invoice.'"  and random = "'.$row->random.'" ');
    while($a = $amount->fetch(PDO::FETCH_OBJ)){
      $ldate = date('Y-m-d',strtotime($row->ldate));
                                                echo '
                                            
                                            <tr> 
                                                <td>'.$c++.'</td>
                                                <td>'.ucwords($item).'</td> 
                                                <td>'.$damages.'</td> 
                                                <td>'.$ldate.'</td>
                                                <td>'.$row->invoice.'</td> 
                                                <td style="text-align: right;">'.number_format($row->total_cost,2).'</td>
                                                </tr>
                                                
                                                ';
                                                
                                                //include "editpay.php";
    }  
}
            }
            
    
                                            ?>
                                            <tr>
                                                <th colspan="7"></th>
                                            </tr>
                                             <?php
$total=$conn->query('select SUM(total_cost) AS product from tblleased WHERE company = "'.$_SESSION['company'].'" and damaged IS NOT NULL ');
    while($rows = $total->fetch(PDO::FETCH_OBJ)){
        
$amount=$conn->query('select sum(amount) as paid from tbltransactions WHERE company = "'.$_SESSION['company'].'"  and random = "'.$rows->random.'"   ');
    while($a = $amount->fetch(PDO::FETCH_OBJ)){
      $ldate = date('Y-m-d',strtotime($rows->ldate));
    
                                 ?>   
                              <tr>
                                  <th colspan="5" style="text-align: right;">Grand Total</th>
                                  <th style="text-align: right;"><?php echo number_format($rows->product,2); ?></th>
                              </tr>
                              <tr>
                                  <th colspan="5" style="text-align: right;">Amount Paid</th>
                                  <th style="text-align: right;"><?php echo number_format($a->paid,2); ?></th>
                              </tr>
                              <tr>
                                  <th colspan="5" style="text-align: right;">Balance</th>
                                  <th style="text-align: right;"><?php echo number_format(($rows->product)-$a->paid,2); ?></th>
                              </tr>

 <?php }  }
 ?>
                                        </tbody>
                                        
                                    </table>
                                     <?php
                                      break;
                                      case 'leasedsales':
                                      ?>
                                               <table id="table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 15px !important;">No.</th>
                                                <th>Item Name</th>
                                                <th>Date Invoiced</th>
                                                <th>Invoice Number</th>
                                                <th style="text-align: right;">Total amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
                                                   $c=1;

$stmt = $conn->query('select * from tblleased WHERE company = "'.$_SESSION['company'].'" AND (ldate BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") and ((cdate BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") or cdate IS NULL) ');
        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $invoice = $row->invoice;
    $items=$conn->query('select * from tblitems WHERE id = "'.$row->item_name_id.'" ');
    while($i = $items->fetch(PDO::FETCH_OBJ)){
        $item = $i->item_name;
    $amount=$conn->query('select sum(amount) as paid from tbltransactions WHERE invoice = "'.$row->invoice.'" and (date_paid BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") ');
    while($a = $amount->fetch(PDO::FETCH_OBJ)){
      $ldate = date('Y-m-d',strtotime($row->ldate));
                                                echo '
                                            
                                            <tr> 
                                                <td>'.$c++.'</td>
                                                <td>'.ucwords($item).'</td> 
                                                <td>'.$ldate.'</td>
                                                <td>'.$row->invoice.'</td> 
                                                <td style="text-align: right;">'.number_format($row->total_cost,2).'</td>
                                                </tr>
                                                
                                                ';
                                                
                                                //include "editpay.php";
    }  
}
            }
            
    
                                            ?>
                                            <tr>
                                                <th colspan="7"></th>
                                            </tr>
                                             <?php
$total=$conn->query('select SUM(total_cost) AS product from tblleased WHERE company = "'.$_SESSION['company'].'" AND (ldate BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") and ((cdate BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") or cdate IS NULL) ');
    while($rows = $total->fetch(PDO::FETCH_OBJ)){
        
$amount=$conn->query('select sum(amount) as paid from tbltransactions WHERE company = "'.$_SESSION['company'].'" and (date_paid BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") and (date_paid BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") ');
    while($a = $amount->fetch(PDO::FETCH_OBJ)){
      $ldate = date('Y-m-d',strtotime($rows->ldate));
    
                                 ?>   
                              <tr>
                                  <th colspan="4" style="text-align: right;">Grand Total</th>
                                  <th style="text-align: right;"><?php echo number_format($rows->product,2); ?></th>
                              </tr>
                              <tr>
                                  <th colspan="4" style="text-align: right;">Amount Paid</th>
                                  <th style="text-align: right;"><?php echo number_format($a->paid,2); ?></th>
                              </tr>
                              <tr>
                                  <th colspan="4" style="text-align: right;">Balance</th>
                                  <th style="text-align: right;"><?php echo number_format(($rows->product)-$a->paid,2); ?></th>
                              </tr>

 <?php }  }
 ?>
                                        </tbody>
                                        
                                    </table>
                                      <?php
                                      break;
                                  }
                                      ?>
                                 
                                         
                                    
                                    
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
                            </div><!-- /.box -->

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


                    </div>   <!-- /.row -->
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

</script>
    </body>
</html>