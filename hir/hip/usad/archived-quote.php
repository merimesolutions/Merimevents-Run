<?php
include
    session_start();
if (!isset($_SESSION['userid'])) {
    require "../redirect.php";
}
else {
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_destroy();
        require "../redirect.php";
    }
    else {
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
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                     <a href="quotation-list.php" title="Go home"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go home"></i> Back</a>&nbsp;&nbsp;
                     <!-- <a class=""  href="archived-demo"  title="Archived demo" style="margin-bottom:5px;"><i class="fa fa-archive" ></i> Archived Demo</a>   -->
                     <!-- <a class=""  href="demo"  title="Archived demos" style="margin-bottom:5px;"><i class="fa fa-tasks" ></i> Active demos</a>   -->
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
                           
                            <form action="edquote.php" method="post" novalidate>
                            <div class="dropdown " style="position:absolute; right:40px; top:60px; z-index:1;">
        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float:right; padding: 2px 20px; margin-bottom:10px;">
        Action
        </button>
    
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="padding:10px;">
            <input type="submit" name="restore_quote"  class="dropdown-item " style="background-color:transparent ; border:none;" value="Restore quote">
            <input type="submit" name="delete_quote"  class="dropdown-item " id="deleteDB" style="margin-top:10px !important;background-color:transparent; border:none;" value="Delete quote" >

        </div>
    </div>
    
    <table id="table" class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th style="width: 20px !important;"><input type="checkbox" name="chk_quote[]" class="cbxMain" onchange="checkMain(this)" />
                                            <th>S.N</th>
                                            <th>Quotation ID</th>
                                            <th>Quotation title</th>
                                            <th>Date created</th>
                                            <th style="width:80px !important;">Edit</th>
                                       
                                            <th style="width:80px !important;">Generate</th>
                                            <th style="width:80px !important;">Print</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                             <!--td><a class="" style="cursor: pointer;" onclick="myDel('.$data['item_id'].')"><i class="fa fa-edit"> </i> Edit</a></td-->
                               <?php
                               $sn = 1;
                               $c= $_SESSION['company'];
                            //    $id1=$_GET['id'];
                            //    $squery1 = mysqli_query($con, "SELECT * from tblquotation WHERE company='".$_SESSION['company']."' ORDER BY id DESC");
                               $squery1 = mysqli_query($con, "SELECT * FROM tblquotation where tblquotation.dell = 1 ");
                               // $squery1 = mysqli_query($con, "SELECT * FROM tblquotation order by id ");
                            // echo $squery1;
                            $og =mysqli_num_rows($squery1);
                           
                               if($og>0){
                                    while($data = mysqli_fetch_assoc($squery1))                                
                                //    foreach($squery as $data)
                                    {
                                        // print_r($data);
                                        $idd=$data['id'];
                                        $idee= $data['identitty'];
                                        $qtt = $data['qoutation_title'];
                                        $dae=$data['date_create'];
                                        $it=$data['item_name'];
                                        $nd=$data['no_days'];
                                        $qnt=$data['quantity'];
                                        $unt=$data['unit_price'];
                                        $tamt=$data['total_amount'];
                        
                                    echo '<tr>
                                        <td>
                                        <input type="hidden" value="'.$data['id'].'" name="identiti" id="hidden_id">           
                                        <input type="hidden" value="'.$data['identitty'].'" name="iddde" id="hidden_id">                                                                                
                                        <input type="checkbox" name="chk_quote[]" class="chk_quote" value="'.$idd.'" /></td> 
                                            <td>'.$sn++.'</td>
                                            <td>'.$idee.'</td>
                                            <td>'.$qtt.'</td>
                                            <td>'.$dae.'</td>
                                            <td><center><a class="float-left" role="button" data-toggle="modal" data-target="#editQuote'.$idd.'"><i class="nav-icon fas fa-edit"> </i> Edit</a></center></td>
                                            <td><input type="submit" value="Generate Invoice" target="_blank" name="invoice" style="background-color:#1E90FF; color:white;border-radius:1px solid;" onclick="location.href="generate-invoice?id='.$idee.'";" /></td>
                                            <td>
                                            <a class="btn btn-success btn-sm form-group" style="" href="print-quotation-lease?id='.$idee.' " target="_blank"><i class="fas fa-print"></i>&nbsp;Print</a></td>
                                    </tr>';
                                   
                               
                                   
                                }}
?>

<!-- <td><a class="btn btn-primary btn-sm form-group" style="" href="generate-invoice?id='.$idee.' " target="_blank"><i class="fas fa-download"></i>&nbsp;Generate Invoice</a></td> -->
                                            
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