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
      /*.top-wrapper{
            background-color: black;
            padding: 0 5px 5px 5px;
            border-radius: 5px;*/
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
                <section class="content-header">
                    <a href="ir.php" title="Go home"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go home"></i> Back</a>
                   
                </section>

                <!-- Main content -->
                <section class="content">

                <div class="box"> 
                     <div class="container-fluid container-fullw bg-white">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="top-wrapper">
                        </div>
                    <br>
                          
                            <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px !important;"><i class="fa fa-list"></i></th>
                                                <th>Customer Name</th>
                                                <th>National ID No</th>
                                                <!--<th>Gender</th>-->
                                                <th>Contact</th>
                                                <th style="width: 80px !important;background-color: teal;color: #fff;text-align: center;" >Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                    $c=1;
                    $searchcrno = $_GET['search//dcsnmm895jk4xcjk89wnm-euiuirsdkl478895nuieryu'];
                    $company      =$_SESSION['company'];
                    $ret=mysqli_query($con,"select * from tblcustomers where identity='".$searchcrno."' or fname='".$searchcrno."' or lname='".$searchcrno."' or mname='".$searchcrno."' or email='".$searchcrno."' or company='".$searchcrno."' or fcontact='".$searchcrno."' or scontact='".$searchcrno."' and company = '".$company."' ");
                      $cnt=1;
                    while ($row=mysqli_fetch_array($ret)) {
    // <td><a href=irs.php?cjk7834nnsdf72nmmnsdf47//4-43reiosdjhjsd8c8989xcv='.$row['identity'].' target="_parent">'.ucwords($row['gender']).'</a></td> 
                                                echo '
                                            <tr>
                                                <td><a href=irs.php?cjk7834nnsdf72nmmnsdf47//4-43reiosdjhjsd8c8989xcv='.$row['identity'].' target="_parent"><img src="../../images/icons/pointer.png" class="pointer"></a></td> 
                                                <td><a href=irs.php?cjk7834nnsdf72nmmnsdf47//4-43reiosdjhjsd8c8989xcv='.$row['identity'].' target="_parent">'.ucwords($row['fname']).' '.ucwords($row['lname']).' '.ucwords($row['mname']).'</a></td>
                                                <td><a href=irs.php?cjk7834nnsdf72nmmnsdf47//4-43reiosdjhjsd8c8989xcv='.$row['identity'].' target="_parent">'.ucwords($row['identity']).'</a></td>   
                                               
                                                <td><a href=irs.php?cjk7834nnsdf72nmmnsdf47//4-43reiosdjhjsd8c8989xcv='.$row['identity'].' target="_parent"> '.ucwords($row['fcontact']).'  '.ucwords($row['scontact']).'</a></td>
                                                <td><center><a href=irs.php?cjk7834nnsdf72nmmnsdf47//4-43reiosdjhjsd8c8989xcv='.$row['identity'].' target="_parent" <i style="background-color:;" class="fa fa-folder" ></i> Select</center></td> 
                                                                                
                                                </tr>
                                                ';
                                                
                                                //include "editirs.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                              </form>
                            </div>
                        </div>
                      </div>
                    </div>
            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>
                  </div>
                </div>
              </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->   
                <!-- jQuery 2.0.2 -->
        <?php 
        include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>



