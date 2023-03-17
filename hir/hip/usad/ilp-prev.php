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
                    <a href="ocr.php" title="Lease item"><i class="fa fa-refresh" aria-hidden="true" title="Lease item"></i> Lease items</a>&nbsp;&nbsp;&nbsp;
                    <a href="ilpr?tm=<?php echo $_GET['id']; ?>" target="_blank" ><i class="fa fa-print" aria-hidden="true" title="Print"></i> Print</a>
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
                                                            //   if($r['profile_img'] != ''){
                                                                $p= $r['profile_img'];
                                                                $image='../logos/'.$p;
                                                            //   }
                                                            //   else{
                                                            //       $p="logo.png";
                                                            //   }
                                                            header ("Content-type: image/jpeg");       
                                                            // echo '<center><img height="120" width="120" src="../logos/logo.png" ></center>'; 
                                                            //   echo'<img src="data:image;base64,'.$r['profile_img'].'">';
                                                      
                                                            // src="'.$image.'" 
                                                            echo '<center><img src="'.$image.'"  alt="Profile Photo" class="img-fluid " style="width:120px;"></center>';
                                                              echo '<h3><center>'.ucwords($compname).'</center></h3> ';
                                                              echo '<h4><center>'.ucwords($location).'</center></h4> ';
                                                              echo '<h5><center>'.$email.'</center></h5> ';
                                                              echo '<h5><center>'.$contact.'</center></h5> ';
                                                         }
                                    ?>
                                     <h2><strong><center>Lease Invoice</center></strong></h2> 
                                    
                                    <table id="table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 15px !important;">No.</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Price per item</th>
                                                <th>Days </th>
                                                <th style="text-align: right;">Total amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
                                            $c=1;
                                            $i=$_GET['id'];
                                               
                                            $stmt = mysqli_query($con,"SELECT * FROM tblquotation WHERE identitty=$i order by id DESC");
                                            $rows11 = mysqli_fetch_assoc($stmt);
                                            // {
                                            //   $y =$_GET['tjk78wenm4yuwernmnmzxcyunmnmztye7834nm434nm43rf//578nmsdjn//sdfjkmerime'];  
                                            $y=$_GET['quote'];
                                           $idd=$rows11['identitty'];
                                            $itt=$rows11['item_name'];
                                            $q=$rows11['quantity'];
                                            $ta=$rows11['total_amount'];
                                            $dc=$rows11['date_create'];
                                            $ed=$rows11['expire_date'];
                                            $cb=$rows11['create_by'];
                                            $up=$rows11['unit_price'];
 
            //     date_default_timezone_set('Africa/Nairobi');
                                            $time2 = strtotime($dc);
                                            $time1 = strtotime($ed);
                                            $dif   = floor( ($time1-$time2) /(60*60*24));
                                                echo '
                                            
                                            <tr> 
                                                <td>'.$c++.'</td>
                                                <td>'.$itt.'</td> 
                                                <td>'.$q.'</td>
                                                <td>'.$up.'</td> 
                                                <td>'.$dif.'</td>
                                                <td style="text-align: right;">'.number_format(($up*$q*$dif)).'</td>
                                                </tr>
                                                
                                                ';
                                                
                                                //include "editpay.php";
        //     }
        // }
    
                                            ?>
                                            <tr>
                                                <th colspan="7"></th>
                                            </tr>
                                             <?php
// SELECT * FROM tblquotation WHERE identitty=$i order by id DESC
                  $i=$_GET['id'];
                                 $total=mysqli_query($con,'SELECT total_amount from tblquotation WHERE identitty='.$i.' order by id DESC');
    $ttle = mysqli_fetch_array($total);
    
                                 ?>   
                              <tr>
                                  <th colspan="5" style="text-align: right;">Total Cost</th>
                                  <th style="text-align: right;"><?php echo $ttle['total_amount'] ?></th>
                              </tr>
                              <?php
                              $amount=mysqli_query($con,'select sum(amount) as paid from tbltransactions WHERE invoice = "'.$_GET['id'].'" ');
    $a = mysqli_fetch_array($amount);
    $vats=($ttle['product']) * 0.16;
    $tots=$vats + $a['paid'];
    ?>
                              <tr>
                                  <th colspan="5" style="text-align: right;">Amount Paid</th>
                                  <th style="text-align: right;"><?php echo number_format($a['paid'],2); ?></th>
                              </tr>
                              <tr>
                                  <th colspan="5" style="text-align: right;">VAT 16%</th>
                                  <th style="text-align: right;"><?php echo number_format($vats,2); ?></th>
                              </tr>
                              <tr>
                                  <th colspan="5" style="text-align: right;">Balance</th>
                                  <th style="text-align: right;"><?php echo number_format(($ttle['product'])-$a['paid'],2); ?></th>
                              </tr>
 
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