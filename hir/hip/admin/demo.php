<?php
include
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
                     <a class=""  href="archived-demo"  title="Archived demo" style="margin-bottom:5px;"><i class="fa fa-archive" ></i> Archived demo</a>  

<!-- <form method="post">
    <div class="dropdown" style=" position: absolute;
  right: 10px;
  top: 5px;
  z-index: 1;">
        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float:right; padding: 2px 20px; margin-bottom:10px;">
        Action
        </button>
    
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="padding:10px;">
            <input type="submit" name="archive_demo"  class="dropdown-item " style="background-color:transparent ; border:none;" value="Archive demo">
            <input type="submit" name="delete"  class="dropdown-item " id="deleteDB" style="margin-top:10px !important;background-color:transparent; border:none;" value="Delete Demo" >
        </div>
    </div> 
    </form> -->
                </section>
                

                <!-- Main content -->
                <section class="content">
                    <div class="wrap-content container" id="container" style="width: 100%;height: 100%;">
                    <div class="row">
                        <div class="box-body table-responsive">
                            <p>Active accounts</p>
                            <form action="deletefunction.php" method="post" novalidate>
                            <div class="dropdown " style="position:absolute;
  right: 10px;
  top:100px;
  z-index: 1;">
        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float:right; padding: 2px 20px; margin-bottom:10px;">
        Action
        </button>
    
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="padding:10px;">
            <input type="submit" name="archive_demo"  class="dropdown-item " style="background-color:transparent ; border:none;" value="Archive demo">
            <input type="submit" name="delete"  class="dropdown-item " id="deleteDB" style="margin-top:10px !important;background-color:transparent; border:none;" value="Delete Demo" >

        </div>
    </div>
    
                                <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:10px;"><i class="fa fa-list"></th>
                            
                                                <th>Full Name</th>
                                                <th>Contact</th>
                                                <th>Email</th>
                                                <th>Company name</th>
                                                <th>Location</th>
                                                <th>Date</th>
                                                <th>Comment</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "SELECT * from tbldemo WHERE (del=0 or del IS NULL)");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                $id1= $row['id'];
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
                                          
                                        <td><input type="checkbox" name="demos[]" value="'.$id1.'"></td>
                                        <td>'.ucwords($row['full_name']).'</td>
                                        
                                        <td>'.$row['phone_number'].'</td>
                                        <td>'.$row['email'].'</td>
                                        <td>'.$row['company'].'</td>
                                        <td>'.$row['location'].'</td>
                                        <td>'.$row['date'].'</td>
                                        <td>'.$row['comment'].'</td>                              
                                                </tr>
                                                ';
                                                include "edit.php";
                                               
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                            </form>
                                    <?php include "../deleteModal.php"; 
                                    //   include "deletefunction.php";?>
                                    
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