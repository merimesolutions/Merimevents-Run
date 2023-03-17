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
                     <!-- <a href="pr-prev"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Print preview</a> -->
                     <!-- <a href="view-projects"><i class="fa fa-eye" aria-hidden="true"></i> Reports per project</a> -->
                     
                    

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box" id="txtHint">
                        <div class="box-body table-responsive">       
                            <form method="post">
                                    <table id="table" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px !important;"><i class="fa fa-list"></i></th>
                                                <th>Project Name</th>
                                                <th>Project description</th>
                                                <th>Date started</th>
                                                <th>Project deadline</th>
                                                <th>Status</th>
                                                <th>Company</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ans">
                                            <?php
$c = 1;
$task = 0;
$date = date("Y-m-d");
// $query  = "SELECT tblprojects.id, tblprojects.project,tblprojects.description, tblprojects.deadline,tblprojects.started,tblprojects.status
//     FROM 
//     tblprojects
//     where company='".$_SESSION['company']."'
//     ORDER BY id desc";
$query2 = "SELECT tblprojects.id, tblprojects.project,tblprojects.description, tblprojects.deadline,tblprojects.started,tblprojects.status, tblprojects.company
                                                FROM 
                                                tblprojects
                                                -- where company='" . $_SESSION['company'] . "'
                                                ORDER BY id desc";
$rr = mysqli_query($con, $query2);
while ($rows1 = mysqli_fetch_Array($rr)) {
    // $project =
    //     $query = "SELECT * FROM tblongoing_tasks where proj = '" . $_GET['proj'] . "' ORDER BY percentage";
    // $result = mysqli_query($con, $query);
    // while ($row = mysqli_fetch_array($result)) {
    //     $ids = $row['user'];
    //     $id_users = explode(',', $ids);
    //     $name = '';
    //     foreach ($id_users as $id_user) {
    //         $get_users = mysqli_query($con, "SELECT * FROM tblusers where id='" . $id_user . "'");
    //         while ($users = mysqli_fetch_assoc($get_users)) {
    //             $name .= $users['full_name'] . '<br>';
    //         }
    //     }
    //     $qy = "SELECT * FROM tblusers where id = '" . $row['user'] . "'";
    //     $res = mysqli_query($con, $qy);
    //     while ($rows = mysqli_fetch_Array($res)) {
    //         $per = $row['percentage'];
    //         $d = $row['deadline'];
    //         $task = $row['task'];
    //         if (($per >= 99) && ($per <= 100)) {
    //             $status = '<p style="color: #008000">' . "Completed" . '</p>';
    //         }
    //         elseif (($per >= 75) && ($per <= 98)) {
    //             $status = '<p style="color:#ff6600;">' . "Almost done" . '</p>';
    //         }
    //         elseif (($per >= 50) && ($per <= 74)) {
    //             $status = '<p style="color: #66cc99">' . "Halfway done" . '</p>';
    //         }
    //         elseif (($per >= 1) && ($per <= 49)) {
    //             $status = '<p style="color: #ff6666">' . "In progress" . '</p>';
    //         }
    //         else {
    //             $status = '<p style="color: red">' . "Not started" . '</p>';
    //         }
    //         if ($date > $row["deadline"]) {
    //             if ($per != 100) {
    //                 $g = '<td style="color:red">' . $row["deadline"] . '</td>';
    //             }
    //             else {
    //                 $g = '<td>' . $row["deadline"] . '</td>';
    //             }
    //         }
    //         else {
    //             $g = '<td>' . $row["deadline"] . '</td>';
    //         }
    //     }

    // }
    echo '
                                            <tr>
                                                <td style="vertical-align: text-top;">' . $c++ . '</td> 
                                                <td style="vertical-align: text-top;">' . ucwords($rows1['project']) . '</td>
                                                <td style="vertical-align: text-top;">' . ucwords($rows1['description']) . '</td>
                                                <td style="vertical-align: text-top;">' . ucwords($rows1['started']) . '</td>
                                                <td style="vertical-align: text-top;">' . ucwords($rows1['deadline']) . '</td> 
                                                <td style="vertical-align: text-top;">' . ucwords($rows1['status']) . '</td>
                                                <td style="vertical-align: text-top;">' . ucwords($rows1['company']) . '</td>
                                            </tr>';
    
                                                

    include "editPls.php";

}
?>
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    </form>
                                

             <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>

                  </div>
                </div>
               </section><!-- /.content -->
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
              function showCustomer(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("txtHint").innerHTML = this.responseText;
  }
  xhttp.open("GET", "showProject.php?q="+str);
  xhttp.send();
}
          </script>        
    </body>
</html>



