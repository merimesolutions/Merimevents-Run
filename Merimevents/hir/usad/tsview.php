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
        .sidebar-menu .pl{
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
                <form method="post">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a href="javascript:void(0)"  title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    
                    <!--<a href="tsa.php" target="_parent" class=""><i class="fa fa-tasks" aria-hidden="true"></i> Assign Tasks</a>&nbsp;&nbsp;&nbsp;-->
                   <input type="submit" class="btn btn-danger btn-sm" name="delete_task" style="position:absolute;right:15px;margin-top:3px;" value="Delete Task"> 
                   
        
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">   
                        <h5 style="background-color: rgba(0,0,0,0.1);padding:2px;"><span style="color:#000;">Task: </span> <?php
                        $q  = "SELECT tblongoing_tasks.task FROM tblongoing_tasks
                                              where tblongoing_tasks.proj = '".$_GET['proj']."' and tblongoing_tasks.id = '".$_GET['task']."'
                                                ";
                                            $result = mysqli_query($con, $q);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                    echo ucwords($row['task']);
                                                  }
                                                  ?></h5>        
                            
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 15px !important;"><i class="fa fa-hashtag"></i></th>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Task</th>
                                                <th>Description</th>
                                                <th>Start</th>
                                                <th>Deadline</th>
                                                <th>Completion</th>
                                                <th>Person in charge<!--span style="float:right">Add <i class="fa fa-user" aria-hidden="true"></i></span--></th>
                                                <th>Status</th>
                                                <th style="width:40px;text-align: center;">Edit Task</th>
                                                <th style="width:40px;">Update Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $date=date("Y-m-d");
                $query  = "SELECT tblongoing_tasks.id, tblongoing_tasks.task,tblongoing_tasks.user,tblongoing_tasks.deadline,tblongoing_tasks.date_assigned,tblongoing_tasks.percentage,tblongoing_tasks.proj
                        FROM tblongoing_tasks where tblongoing_tasks.proj = '".$_GET['proj']."' and tblongoing_tasks.id = '".$_GET['task']."'
                        ORDER BY id desc";
                        
                        $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_array($result))
                                                  {
                                           $task = $row['task'];
                                           
                                            $per = $row['percentage'];
                                            $d = $row['deadline'];
                                            $task = $row['task'];
                                            if($per<100)
                                            {
                                                $status = '<p style="color: red">'. "Incomplete" .'</p>';
                                            }
                                            elseif($per>=100)
                                            {
                                                $status = '<p style="color: green">'. "Completed" .'</p>';
                                            }
                                              $tasks = mysqli_query($con,"SELECT * FROM tbltasks WHERE task_name= '$task' ");
                                            //  echo  $e = mysqli_num_rows($tasks);
                                             while($matask = mysqli_fetch_assoc($tasks)):
                                                  $ta =  $matask['description'];
                                                 endwhile;
                 
                                            echo '
                                            <tr><td><input type="checkbox" name="tasks[]" value="'.$task.'"></td>
                                                <td>'.$c++.'</td> 
                                                <td title="tasks">'.ucwords($row['task']).'</td>
                                                <td>'.$ta.'</td>
                                                <td>'.ucwords($row['date_assigned']).'</td>  
                                                <td>'.$row['deadline'].'</td>
                                                <td>'.ucwords($row['percentage']).' %</td>
                                                <td>'.ucwords($row['user']).'  
                                        <!--button data-target="#edituser'.$row['id'].'" data-toggle="modal" style="float:right"><i class="fa fa-plus" aria-hidden="true"></i></button-->
                                                </td> 
                                                <td>'.$status.'</td> 
                                                
                                                <td><center><a href="edittask.php?proj='.$_GET['proj'].'&task='.$row['id'].'"><img src="../../images/icons/doc_edit.png" title="View this task" class="iconb"></a></center></td>
                                                <td><center><a href="javascript:void(0)" data-target="#editprogress'.$row['id'].'" data-toggle="modal"><img src="../../images/icons/doc_edit.png" title="Edit this record" class="iconb"></a></center></td>
                                                </tr>
                                                ';
                                           
                                                 include "editprogress.php";
                                                 
                                               
                                     
                                                  }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    
             <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>
            <?php include "deletefunction.php";?>
            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>

                  </div>
                </div>
               </section><!-- /.content -->
               </form>
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
          </script>        
    </body>
</html>



