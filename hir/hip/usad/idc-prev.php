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
                   
                    <a href="idcr.php?cl=<?php echo $_GET['cl'];?>" target="_blank" ><i class="fa fa-print" aria-hidden="true" title="Print"></i> Print</a>
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
                                                            //   }
                                                            //   else{
                                                            //       $p="logo.png";
                                                            //   }
                                                            header ("Content-type: image/jpeg");       
                                                            echo '<center><img height="120" width="120" src="../logos/logo.png" ></center>'; 
                                                            //   echo'<img src="data:image;base64,'.$r['profile_img'].'">';
                                                              echo '<h3><center>'.ucwords($compname).'</center></h3> ';
                                                              echo '<h4><center>'.ucwords($location).'</center></h4> ';
                                                              echo '<h5><center>'.$email.'</center></h5> ';
                                                              echo '<h5><center>'.$contact.'</center></h5> ';
                                                         }
                                    ?>
                                     <h2><strong><center>Damaged Items Invoice</center></strong></h2> 
                                    
                                    <table id="table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 15px !important;">No.</th>
                                                <th>Item Name</th>
                                                <th>Charges</th>
                                                <th style="text-align: right;">Total Amount </th>
                                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
                                            $c=1;
        $query  = "SELECT tblcustomers.id, tblcustomers.fname,tblcustomers.mname,tblcustomers.lname,tblcustomers.identity,tblcustomers.fcontact, tblleased.client,tblleased.item_name_id,tblleased.qnty,tblleased.qlty,tblleased.rdate,tblleased.ldate,tblleased.served_by,tblleased.status,tblleased.damaged,tblleased.item_id,tblitems.item_name,tblitems.damage_charges
                    FROM 
                    tblcustomers 
                    LEFT JOIN tblleased 
                    ON tblcustomers.identity = tblleased.client 
                    LEFT JOIN tblitems 
                    ON tblitems.id = tblleased.item_name_id  
                    where damaged>'0' and comment = 'not cleared' and client='".$_GET['cl']."' ";
                $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result))
                      {  $cb=$row['client'];
                $z=$row['item_name_id'];
                $q = "SELECT * FROM tblcleared where item_name_id_clear ='".$z."' and client='".$_GET['cl']."' ";
                $query_run = mysqli_query($con,$q);

                $paid= 0;
                while ($num = mysqli_fetch_assoc ($query_run)) {
                    $paid += $num['payment'];
                }
                        $dmg=$row['damage_charges'];
                        $d=$row['damaged'];
                        $charges=($dmg*$d);
                        $bal=$charges-$paid;

                date_default_timezone_set('Africa/Nairobi');
                                        
                                                echo '
                                            
                                            <tr> 
                                                <td>'.$c++.'</td>
                                                <td>'.$row['damaged'].' '.ucwords($row['item_name']).'</td> 
                                               
                                                <td>'.$row['damage_charges'].'</td> 
                                              
                                                <td style="text-align: right;">'.number_format($charges).'</td>
                                                </tr>
                                                
                                                ';

            }
        
    
                                            ?>
                                            <tr>
                                                <th colspan="3"></th>
                                            </tr>
                                             <?php

                               $total=mysqli_query($con,'select sum(qnty*price) as product from tblleased WHERE client = "'.$_GET['cl'].'" ');
    $ttle = mysqli_fetch_array($total);
    
                                 ?>   
                              <tr>
                                  <th colspan="3" style="text-align: right;">Total Cost</th>
                                  <th style="text-align: right;"><?php echo number_format($charges);?></th>
                              </tr>
                              <?php
    //                           $amount=mysqli_query($con,'select sum(amount) as paid from tbltransactions WHERE invoice = "'.$_GET['tm'].'" ');
    // $a = mysqli_fetch_array($amount);
    // $vats=($ttle['product']) * 0.16;
    // $tots=$vats + $a['paid'];
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