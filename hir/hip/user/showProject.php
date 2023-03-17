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
$qw = $_GET['q'];
include "../connection.php";

?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css">
<!-- <div class="box"> -->
                        <!-- <div class="box-body table-responsive">        -->
                            <form method="post">
                                    <table id="table example" class="table display  table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px !important;"><i class="fa fa-list"></i></th>
                                                <th>Projects</th>
                                                <th>Started</th>
                                                <th>Deadline</th>
                                                <th>Status</th>
                                                <th>Tasks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$c = 1;
$task = 0;
$date = date("Y-m-d");
switch ($qw) {
    case 0:
        $query = "SELECT tblprojects.id, tblprojects.project,tblprojects.description, tblprojects.deadline,tblprojects.started,tblprojects.status,tblongoing_tasks.id, tblongoing_tasks.task,tblongoing_tasks.user,tblongoing_tasks.deadline,tblongoing_tasks.date_assigned,tblongoing_tasks.percentage,tblongoing_tasks.proj,tblusers.full_name
         FROM tblprojects
         LEFT JOIN tblongoing_tasks
         ON tblprojects.id = tblongoing_tasks.proj
         LEFT JOIN tblusers 
         ON tblusers.id = tblongoing_tasks.user
         where tblprojects.company='" . $_SESSION['company'] . "'  
          AND tblongoing_tasks.user LIKE '%_%'
        ";
        break;
    case 1:
        $query = "SELECT tblprojects.id, tblprojects.project,tblprojects.description, tblprojects.deadline,tblprojects.started,tblprojects.status,tblongoing_tasks.id, tblongoing_tasks.task,tblongoing_tasks.user,tblongoing_tasks.deadline,tblongoing_tasks.date_assigned,tblongoing_tasks.percentage,tblongoing_tasks.proj,tblusers.full_name
                     FROM tblprojects
                     LEFT JOIN tblongoing_tasks
                     ON tblprojects.id = tblongoing_tasks.proj
                      LEFT JOIN tblusers 
                    ON tblusers.id = tblongoing_tasks.user
                     where tblprojects.company='".$_SESSION['company']."'
                     AND len(tblongoing_tasks.user) > 1)   

                     ";
        break;
    case 2:
      $query = "SELECT tblprojects.id, tblprojects.project,tblprojects.description, tblprojects.deadline,tblprojects.started,tblprojects.status,tblongoing_tasks.id, tblongoing_tasks.task,tblongoing_tasks.user,tblongoing_tasks.deadline,tblongoing_tasks.date_assigned,tblongoing_tasks.percentage,tblongoing_tasks.proj,tblusers.full_name
                                 FROM tblprojects
                                 LEFT JOIN tblongoing_tasks
                                 ON tblprojects.id = tblongoing_tasks.proj
                                  LEFT JOIN tblusers 
                              ON tblusers.id = tblongoing_tasks.user
                                 where tblprojects.company='" . $_SESSION['company'] . "' 
                                 AND tblongoing_tasks.percentage=100   
                            ";
        break;
    case 3:
      $query = "SELECT tblprojects.id, tblprojects.project,tblprojects.description, tblprojects.deadline,tblprojects.started,tblprojects.status,tblongoing_tasks.id, tblongoing_tasks.task,tblongoing_tasks.user,tblongoing_tasks.deadline,tblongoing_tasks.date_assigned,tblongoing_tasks.percentage,tblongoing_tasks.proj,tblusers.full_name
                                             FROM tblprojects
                                             LEFT JOIN tblongoing_tasks
                                             ON tblprojects.id = tblongoing_tasks.proj
                                              LEFT JOIN tblusers 
                                            ON tblusers.id = tblongoing_tasks.user
                                             where tblprojects.company='" . $_SESSION['company'] . "'
                                             AND tblongoing_tasks.percentage<100   
                                ";
        break;
}
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {


    echo '
                                            <tr>
                                                <td style="vertical-align: text-top;">' . $c++ . '</td> 
                                                <td style="vertical-align: text-top;">' . ucwords($row['project']) . '</td>
                                                <td style="vertical-align: text-top;">' . ucwords($row['started']) . '</td>  
                                                <td style="vertical-align: text-top;">' . $row['deadline'] . '</td>
                                                <td style="vertical-align: text-top;">' . ucwords($row['status']) . '</td> 
                                                <td>
                                                
                                        <table class="table table-bordered">
                                        <tr>
                                        <th><small>Task</small></th>
                                        <th><small>Assigned date</small></th>
                                        <th><small>Deadline</small></th>
                                        <th><small>Person in Charge</small></th>
                                        <th><small>Status</small></th>
                                        </tr>';


    $per = $row['percentage'];
    $d = $row['deadline'];
    if ($per < 100) {
        $status = '<p style="color: red">' . "Incomplete" . '</p>';
    }
    elseif ($per >= 100) {
        $status = '<p style="color: green">' . "Completed" . '</p>';
    }
    echo '
                                                <tr>
                                                <td><small>' . ucwords($row['task']) . '</small></td>
                                                <td><small>' . ucwords($row['date_assigned']) . '</small></td>
                                                <td><small>' . $row['deadline'] . '</small></td>
                                               <td><small>';
                                                $users = explode(',' ,$row['user']); 
                                                foreach($users as $user){
                                                $getus = mysqli_query($con,"SELECT full_name FROM tblusers WHERE id ='$user'");
                                                while($us = mysqli_fetch_assoc($getus)):
                                                    echo $us['full_name'].'<br>';
                                                endwhile;
                                               }

                                                ?>

                                                <?php 
                                            echo '</small></td>
                                                <td><small>' . $status . ' </small></td> 
                                                </tr>';

                                             echo '
                                                </table>
                                                </td>
                                                
                                                                                  
                                                </tr>
                                                ';

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

                  <!-- </div> -->
                <!-- </div> -->
                <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
<script>
    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example thead tr')
        .clone(true)
        .addClass('filters');
        // .appendTo('#example thead');
 
    var table = $('#example').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    
                });
        },
    });
});
</script>