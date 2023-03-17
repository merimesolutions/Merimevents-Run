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
    .icon {
        width: 30px;
        padding-right: 10px;
    }

    .iconb {
        width: 30px;
        padding-right: 10px;
    }

    .icon:hover {
        transition: 0.3s;
        /*box-shadow: 2px 0px 20px rgba(0, 0, 0, 0.8);*/
    }

    .sidebar-menu .pl {
        background-color: #009999;
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
        <!--get roles in the files-->
        <?php include("getroles.php");?>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <a href="javascript:void(0)" title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left"></i> Back</a>&nbsp;&nbsp;&nbsp;

                <!--a href="plr.php" target="_blank"><img src="../../images/icons/print.png" title="Print projects report" class="icon"></a-->
                <?php if($my_add_mytask==1){?>
                <a class="" data-toggle="modal" data-target="#addProject"><i class="fa fa-plus" aria-hidden="true"></i> Add My-task</a>
                <?php }?>
            </section>

            <!-- Main content -->
            <section class="content" style="width: 100%;height: 100%;">

                <div class="box">
                    <div class="box-body table-responsive">
                        <form method="post">
                            <table id="table" class="table  table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                        <th>My-Tasks</th>
                                        <th>Started</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <?php if($my_edit==1){
                                                // echo '<th style="width:40px">Edit</th>';
                                                }
                                                if($my_view ==1){
                                                echo '<th style="width:40px">View</th>';
                                                }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $c=1;
                                            $task=0;
                                            $date=date("Y-m-d");
  

           $query  = "SELECT * FROM tblprojects
WHERE EXISTS (SELECT * FROM tasks WHERE tblprojects.id = tasks.project_id and tasks.user = '".$_SESSION['userid']."' )";
                                            $result = mysqli_query($con, $query);
                                            // echo mysqli_num_rows($result);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 

                                         
                                            
                                            echo '
                                            <tr>
                                                <td><a href="ts.php?proj='.$row['id'].'">'.$c++.'</a></td> 
                                                <td><a href="ts.php?proj='.$row['id'].'">'.ucwords($row['project']).'</a></td>
                                                <td><a href="ts.php?proj='.$row['id'].'">'.ucwords($row['started']).'</a></td>  
                                                <td><a href="ts.php?proj='.$row['id'].'">'.$row['deadline'].'</a></td>
                                                <td><a href="ts.php?proj='.$row['id'].'">'.ucwords($row['status']).'</a></td>';
                                                if($my_edit==1){
                                                // echo '<td><center><a data-target="#editPls'.$row['id'].'" data-toggle="modal"><img src="../../images/icons/doc_edit.png" title="Edit this record" class="iconb"></a></center></td>';
                                                }if($my_view ==1){
                                                echo '<td><center><a href="ts.php?proj='.$row['id'].'"><img src="../../images/icons/eye.png" title="Edit this record" class="iconb"></a></center></td>';
                                                }                               
                                                echo '</tr>
                                                ';
                                                
                                                include "editPls.php";
                                         
                                    }
                                            ?>
                                </tbody>
                            </table>

                            <!------------------------------------------------------------Table of Events--------------------------------------------------------------------------->
                            <?php
                            $empid=$_SESSION['userid'];
                    //Confirm if there are any event assigments for this user account
                     $sde=mysqli_query($con,"SELECT * FROM tasks WHERE project='Event' AND user='$empid'");
                    if($sde){
                        $no_events=mysqli_num_rows($sde);
                        if($no_events > 0){
                     
                       
                            echo '<h4 class="text-center text-info" style="font-family:fangsong!important;"> <strong>Events Assignments</strong></h4>';
                        
                            ?>
                            <table id="datatable" class="table  table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                        <th>Event Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <?php
                                                if($my_view ==1){
                                                echo '<th style="width:40px">View</th>';
                                                }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                             $c=1;
                            while($rowy = mysqli_fetch_assoc($sde)){
                                $eventz_id =$rowy['event_id'];
                                           
                            }
//                                            $task=0;
   // $date=date("Y-m-d");
                                //Get event details such as name a
                                
                                $sqq=mysqli_query($con,"SELECT * FROM tblevents WHERE id='$eventz_id'");
                                while($roz = mysqli_fetch_array($sqq)){
                                    $event_id=$roz['id'];
                                    
                                    //get status
                                
                            
                            ?>

                                    <tr>
                                        <td><a href="tss2.php?proj=<?php echo $event_id; ?>"><?php echo $c++; ?></a></td>
                                        <td><a href="tss2.php?proj=<?php echo $event_id; ?>"><?php echo $roz['event_name']; ?></a></td>
                                        <td><a href="tss2.php?proj=<?php echo $event_id; ?>"><?php echo $roz['start_date']; ?></a></td>
                                        <td><a href="tss2.php?proj=<?php echo $event_id; ?>"><?php echo $roz['end_date' ]; ?></a></td>
                                        <td><a href="tss2.php?proj=<?php echo $event_id; ?>"></a>In progress</td>
                                        <?php
                                                if($my_view ==1){
                                                echo '<td><center><a href="tss2.php?proj='.$event_id.'"><img src="../../images/icons/eye.png" title="Edit this record" class="iconb"></a></center></td>';
                                                }                               
                                              ?>
                                    </tr>

                                    <?php }?>





                                </tbody>
                            </table>
                            <?php }}?>
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
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, 5]
                }],
                "aaSorting": []
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                responsive: true
            });

            new $.fn.dataTable.FixedHeader(table);
        });

    </script>
</body>

</html>