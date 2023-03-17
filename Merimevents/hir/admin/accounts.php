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

.edit:hover {
    color: orange;font-weight:bold;cursor: progress;
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
            <?php include('../admin-side-bar.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                     <a href="dashboard.php" title="Go home"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go home"></i> Back</a>&nbsp;&nbsp;
                    
                    <!--a href="#" title="Go home"><i class="fa fa-plus" aria-hidden="true" title="Add new account"></i> Add Account</a-->&nbsp;&nbsp;

                    <!--a data-toggle="modal" data-target="#delactive" title="Delete"><i class="fa fa-trash" aria-hidden="true" title="Add new account"></i> Delete</a-->
                </section>
                

                <!-- Main content -->
                <section class="content">
                    <div class="wrap-content container" id="container" style="width: 100%;height: 100%;">
                    <div class="row">

                                <div class="box-body table-responsive">
                                    <p>Active accounts</p>
                                   <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:10px;"><i class="fa fa-list"></th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Company name</th>
                                                <th>Package</th>
                                                <th>Users</th>
                                                <th>Status</th>
                                                <th style="width: 20px !important;">Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "SELECT * from tblstaff where status='active' OR status='inactive' ORDER BY id DESC");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                $company = $row['company'];
                                                $package ='';
                                                $pp ='';
                                                $p = $row['package'];
                                                if(($p)==3){
                                                    $package = '<p style="color:orange;font-weight:bold;">'."Gold".'</p>';
                                                    $pp = "Gold";
                                                }
                                                elseif(($p)==2){
                                                    $package = '<p style="color:maroon;font-weight:bold;">'."Silver".'</p>';
                                                    $pp = "Silver";
                                                }else{
                                                    $package = '<p style="color:green;font-weight:bold;">'."Bronze".'</p>';
                                                    $pp = "Bronze";
                                                }
                                                $ccc = mysqli_query($con,"SELECT * from tblusers where company='$company' ");
                                                $ws = mysqli_num_rows($ccc);
                                                $n = number_format($ws,0);
                                                echo '
                                            <tr>
                                        <td><i class="fa fa-check"></td>
                                        <td>'.ucwords($row['full_name']).'</td>
                                        <td>'.$row['email'].'</td>
                                        <td>'.$row['contact'].'</td>
                                        <td>'.$row['companyname'].'</td>
                                        <td>'.$package.'</td>
                                        <td>'.$n.'</td>
                                        <td style="color:darkgreen;font-weight:bold;">'.ucwords($row['status']).'</td>
                                        <td><center><a class="edit" data-target="#edit'.$row['id'].'" data-toggle="modal" > Edit</a></center></td>                              
                                                </tr>
                                                ';
                                                include "edit.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php include "../deleteModal.php"; ?>
                                    
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

                    </div>
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>