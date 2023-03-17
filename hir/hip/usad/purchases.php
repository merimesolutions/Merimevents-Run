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
                     <a href="newitems" style="position:absolute; right: 115px;"><i class="fa fa-pen" aria-hidden="true"></i> New Items Reports  </a>
                     <a href="restocks"  style="position:absolute; right: 25px;"><i class="fa fa-book" aria-hidden="true"></i> Restocking  </a>
                     <!-- <select class="form-select" aria-label="Default select example" style="position: absolute;right: 205px;" id="projects" onchange="showPayment2(this.value)">
                        <option selected disabled>Neew Items Reports</option>
                        <option value="6">General</option>
                        <option value="7">Itemized</option>
                        <option value="2">Damaged Items</option>
                        <option value="8">Overdue</option> -->
                    <!-- </select> -->
                     
                     <!-- <select class="form-select" aria-label="Default select example" style="position: absolute;right: 15px;" id="projects" onchange="showPayment1(this.value)">
                        <option selected disabled>Restocking Reports</option>
                        <option value="0">Leased Items</option>
                        <option value="1">Events</option> -->
                        <!-- <option value="2">Damaged Items</option> -->
                        <!-- <option value="3">Overdue</option>
                    </select> -->
                </section>

                <section class="content" style="width: 100%;height: 100%;">
                    <div class="box" id="txtHint1"></div>
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
function showPayment2(str) {
                if (str == "") {
                    document.getElementById("txtHint1").innerHTML = "";
                    return;
                }
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    document.getElementById("txtHint1").innerHTML = this.responseText;
                }
                xhttp.open("GET", "showBal.php?q="+str);
                xhttp.send();
}
          </script>        
    </body>
</html>



