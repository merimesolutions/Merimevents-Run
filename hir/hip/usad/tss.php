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
                    <a href="pl.php" title="Go back to projects"><i class="fa fa-level-up" aria-hidden="true"></i> Projects</a>&nbsp;&nbsp;&nbsp;
                    
                    <a href="tsa.php" target="_parent" class=""><i class="fa fa-plus" aria-hidden="true"></i> Assign Tasks</a>
        
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">  
                        <h5 style="background-color: rgba(0,0,0,0.1);padding:2px;"><span style="color:#000;">Tasks List</span> </h5>        
                            <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Project</th>
                                                <th>Task</th>
                                                <th>Start</th>
                                                <th>Deadline</th>
                                                <th>Completion</th>
                                                <!--th>Person in charge</th-->
                                                <th>Status</th>
                                                <th style="width:60px;text-align: center;">Edit</th>
                                                <!--th style="width:40px">View</th-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $date=date("Y-m-d");
                                            $query  = "SELECT tblongoing_tasks.id, tblongoing_tasks.task,tblongoing_tasks.user,tblongoing_tasks.deadline,tblongoing_tasks.date_assigned,tblongoing_tasks.percentage,tblongoing_tasks.proj
                                                FROM 
                                                tblongoing_tasks where company='".$_SESSION['company']."'
                                                ORDER BY percentage ";
                                            $result = mysqli_query($con, $query);
                                                while($row = mysqli_fetch_array($result))
                                                  { 
                                            $proj = $row['proj'];
                                            $per = $row['percentage'];
                                            $d = $row['deadline'];
                        
                                            $q  = "SELECT tblprojects.id,tblprojects.project
                                                FROM 
                                                tblprojects
                                                ";
                                            $res = mysqli_query($con, $q);
                                                while ($rows = mysqli_fetch_array($res))
                                                  { 
                                                     $pp=ucwords($rows['project']);
                                                  }
                                                  
                                            if($per<100)
                                            {
                                                $status = '<p style="color: red">'. "Incomplete" .'</p>';
                                            }
                                            elseif($per>=100)
                                            {
                                                $status = '<p style="color: green">'. "Completed" .'</p>';
                                            }
                                            echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.$pp.'</td>
                                                <td>'.ucwords($row['task']).'</td>
                                                <td>'.ucwords($row['date_assigned']).'</td>  
                                                <td>'.$row['deadline'].'</td>
                                                <td>'.ucwords($row['percentage']).' %</td>
                                                <!--td>'.ucwords($row['user']).'</td--> 
                                                <td>'.$status.'</td> 
                                                <td><center><a data-target="#editprogress'.$row['id'].'" data-toggle="modal"><img src="../../images/icons/doc_edit.png" title="Edit this record" class="iconb"></a></center></td>
                                                <!--td><center><a href="ts.php?proj='.$row['id'].'"><img src="../../images/icons/eye.png" title="Edit this record" class="iconb"></a></center></td-->                                  
                                                </tr>
                                                ';
                                                
                                                include "editprogress.php";
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
              $(function() {
                  $("#table").dataTable({
                     "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
                  });
              });
          </script>        
    </body>
</html>



