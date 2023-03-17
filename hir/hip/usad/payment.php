<?php
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
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https:ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    </head>
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
        .sidebar-menu .reports{
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
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                     <a href="pr-prev"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Print preview  </a>
                     <!-- <a href="view-projects"><i class="fa fa-eye" aria-hidden="true"></i> Reports per project  </a> -->
               
                     <select class="form-select" aria-label="Default select example" style="position: absolute;right: 15px;" id="projects" onchange="showPayment1(this.value)">
                        <option selected disabled>Balance Reports</option>
                        <option value="0">General Reports</option>
                        <option value="1">Event  Reports</option>
                        <option value="2">Overdue Reports</option>
                        <option value="3">Damaged Reports</option>
                        <option value="4">Lease Reports</option>
                    </select>
              <!--        
                     <select class="form-select" aria-label="Default select example" style="position: absolute;right: 15px;" id="projects" onchange="showPayment1(this.value)">
                        <option selected disabled>Sales Reports</option>
                        <option value="3">Leased Items</option>
                        <option value="4">Events</option> -->
                        <!-- <option value="2">Damaged Items</option> -->
                       <!--  <option value="5">Overdue</option>
                    </select> -->
                </section>

                <section class="content" style="width: 100%;height: 100%;">
                    <div class="box"  id="txtHint1">
                        <?php
                    $query = mysqli_query($con,"SELECT tblleased.qnty,tblleased.rqnty,tblleased.bal_qnty,tblleased.price,tblleased.total_cost,tblleased.amount,tblleased.rdate,tblleased.ldate,tblitems.item_name,tblleased.item_id 
                            FROM tblleased
                            LEFT JOIN tblitems 
                            ON  tblleased.item_name_id = tblitems.id WHERE  tblleased.company='" . $_SESSION['company'] . "'  ");
                            echo ' 
                                    <div class="box-body table-responsive">       
                                        <form method="post">
                                            <table id="table" class="table  table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Item Id</th>
                                                        <th>Item name</th>
                                                        <th>Quantity</th>
                                                        <th>Returned quantity</th>
                                                        <th>Balance quantity</th>
                                                        <th>Price</th>
                                                        <th>Total cost</th>
                                                        <th>Amount</th>
                                                        <th>Return date</th>
                                                        <th>Leased date</th>
                                                    </tr>       
                                                </thead>';
                            while($rez= mysqli_fetch_assoc($query) ){
                                echo '
                                
                                                <tbody>
                                                    <tr>
                                                        <td>' . ucwords($rez['item_id']) . '</td>
                                                        <td>' . ucwords($rez['item_name']) . '</td>
                                                        <td>' . ucwords($rez['qnty']) . '</td>
                                                        <td>' . ucwords($rez['rqnty']) . '</td>
                                                        <td>' . ucwords($rez['bal_qnty']) . '</td>
                                                        <td>' . ucwords($rez['price']) . '</td>
                                                        <td>' . ucwords($rez['total_cost']) . '</td>
                                                        <td>' . ucwords($rez['amount']) . '</td>
                                                          <td>' . ucwords($rez['rdate']) . '</td>
                                                        <td>' . ucwords($rez['ldate']) . '</td>
                                                    </tr>
                                                </tbody>';
                                            
                            }
                           
                            echo '
                            </table>
                                        </form>
                                    </div>
                                 ';
                                ?>
                    </div>
                </section>

                <!-- Main content -->
                <?php include "../notification.php"; ?>

                <?php include "../addModal.php"; ?>

                <?php include "../addfunction.php"; ?>
                <?php include "editfunction.php"; ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->   
                <!-- jQuery 2.0.2 -->
        <?php
            include "../footer.php"; ?>
            <script type="text/javascript">
                function goBack() {
                window.history.back();
                }
                    $(function() {
                  $("#table").dataTable({
                     "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
                  });
              });
              function showPayment1(str) {
                if (str == "") {
                    document.getElementById("txtHint1").innerHTML = "";
                    return;
                }
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    document.getElementById("txtHint1").innerHTML = this.responseText;
                }
                xhttp.open("GET", "showPayment.php?q="+str);
                xhttp.send();
}
          </script>        
    </body>
</html>



