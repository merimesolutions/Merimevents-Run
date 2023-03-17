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
        .sidebar-menu .cl{
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
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" aria-hidden="true" title="Go Back"></i> Back</a>&nbsp;&nbsp;&nbsp;
 
                    <a href="cuEx" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to Excel</a>&nbsp;&nbsp;&nbsp;
                    <a href="cupr" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                </section>
                <!-- Main content -->
                <section class="content" >
                
                    <div class="row">
                        <!-- left column -->
                                <div class="box-body table-responsive" style="background:#fff;margin:20px;box-shadow: 5px 5px 5px 5px  #888888;padding:15px 10px;">
                                    
                                    
                                    <?php
                                       $company =$_SESSION['company'];
                                       $c =mysqli_query($con,"SELECT * FROM tblstaff WHERE company='$company'");
                                                         while($r =mysqli_fetch_assoc($c)){
                                                              $compname=$r['companyname'];
                                                              $location=$r['location'];
                                                              $email=$r['email'];
                                                              $contact=$r['contact'];
                                                              if($r['profile_img'] != ''){
                                                                $p= $r['profile_img'];
                                                              }
                                                              else{
                                                                  $p="logo.png";
                                                              }
                                                            echo '<center><img src="../logos/chat_128.png"></center>'; 
                                                              echo '<h3><center>'.ucwords($compname).'</center></h3> ';
                                                              echo '<h4><center>'.ucwords($location).'</center></h4> ';
                                                              echo '<h5><center>'.$email.'</center></h5> ';
                                                              echo '<h5><center>'.$contact.'</center></h5> ';
                                                         }
                                    ?>
                                     <h2><strong><center>OUR CUSTOMERS</center></strong></h2> 
                                <form method="post">
                                    <table id="table" class="table ">
                                        <thead>
                                            <tr>
                                                <th>  No </th> 
                                                <th style="width: 100px !important;">ID NO</th>
                                                <th>Customer Name</th>
                                                <!--<th>Gender</th>-->
                                                <th>Business / Company</th>
                                                <th>Contact</th>
                                                
                                                <!--th style="width: 20px !important;">Print</th-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "SELECT * FROM tblcustomers where company='".$_SESSION['company']."' ORDER BY id DESC");
                                            
                                            while($row = mysqli_fetch_array($squery))
                                            {  
                                                //<td>'.ucwords($row['gender']).'</td>
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.$row['identity'].'</td>
                                                <td>'.ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']).'</td>
                                               
                                                <td>'.ucwords($row['b_c_name']).'</td>   
                                                <td>'.ucwords($row['fcontact']).'</td> 
                                        
                                                 
                                                <!--td><center><a href=../reports/ocrr?cus='.$row['id'].' target="_blank"><img src="../../images/icons/printer.png" title="Print this record" class="iconb"></a></center></td-->                                 
                                                </tr>
                                                ';
                                                
                                                include "editModal.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

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
function goBack() {
  window.history.back();
}
    // $(function() {
    //     $("#table").dataTable({
    //       "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
    //     });
    // });
</script>
    </body>
</html>