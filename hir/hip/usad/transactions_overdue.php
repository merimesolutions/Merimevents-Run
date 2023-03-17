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
                    <a  href="idc.php"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    <a href="ocr.php" title="Lease item"><i class="fa fa-refresh" aria-hidden="true" title="Lease item"></i> Lease items</a>&nbsp;&nbsp;&nbsp;
                    <?php
                    $dy = mysqli_query($con, "select distinct invoice,random from tbltransactions where random ='".$_GET['tjk78wenm4yuwernmnmzxcyunmnmztye7834nm434nm43rf//578nmsdjn//sdfjkmerime']."' ");
                                                while($row = mysqli_fetch_array($dy))
                                            {
                                            $get = $row['random'];
                    ?>
                    <a href="trnsr.php?tjk78wenm4yuwernmnmzxcyunmnmztye7834nm434nm43rf//578nmsdjn//sdfjkmerime=<?php echo $get; ?>" target="_blank" title="Lease item"><i class="fa fa-print" aria-hidden="true" title="Print"></i> Payment Receipt</a>
                    <?php } ?>
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
                                                <!-- <th>Date</th> -->
                                                <th>Item_id</th>
                                                <th>Item</th>
                                                <th>Cleared by</th>
                                                <th>Date</th>
                                                <th>Print</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
                                            $c=1;
                                    // $c = mysqli_query($con, "SELECT * FROM tbltransactions WHERE random ='".$_GET['dmg']."' ORDER BY id desc");
                                    //             while($row = mysqli_fetch_array($c))
                                    //         {
                                                $squery = mysqli_query($con, "SELECT itemid,item,cleared_by,date_cleared from tbloverdate WHERE company='".$_SESSION['company']."'  ");
                                            while($rows = mysqli_fetch_array($squery))
                                            {
                                            //   $y =$_GET['tjk78wenm4yuwernmnmzxcyunmnmztye7834nm434nm43rf//578nmsdjn//sdfjkmerime'];  
                                            $y=$_GET['overdue'];
                                            
                                                echo '
                                            
                                            <tr> 
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                
                                                <td><a href="payment-receipt.php?receipt='.$row['id'].'" target="_blank" title="Print Receipt"> '.$rows['itemid'].' </a></td>
                                                <td><a href="payment-receipt.php?receipt='.$row['id'].'" target="_blank" title="Print Receipt"> '.$rows['item'].' </a></td> 
                                                
                                                <td><a href="payment-receipt.php?receipt='.$row['id'].'" target="_blank" title="Print Receipt"> '.$rows['cleared_by'].' </a></td> 
                                                
                                                <td><a href="payment-receipt.php?receipt='.$row['id'].'" target="_blank" title="Print Receipt"> '.ucwords($rows['date_cleared']).' </a></td> 
                                                <td><a href="payment-receipt.php?receipt='.$row['id'].'" target="_blank" title="Print Receipt"><i class="fa fa-print" aria-hidden="true" title="Print"></i> Print Receipt</a></td>                             
                                                </tr>
                                                
                                                ';
                                                
                                                //include "editpay.php";
                                            
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
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>