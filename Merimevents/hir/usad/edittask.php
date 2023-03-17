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
        if(isset($_POST['save'])){
            $task_name = $_POST['task_name'];
            $description= $_POST['description'];
            $startdate = $_POST['startdate'];
            $deadline = $_POST['deadline'];
            $project_id = $_POST['project'];
            $task_id = $_POST['task'];
            $prev_taskname = $_POST['prev_taskname'];
              $sql = "UPDATE tblongoing_tasks SET task = '$task_name', deadline = '$deadline',date_assigned= '$startdate' WHERE id='$task_id' AND proj ='$project_id'";
              $sqtask = "UPDATE tbltasks SET task_name ='$task_name',description ='$description', start_date='$startdate',end_date ='$deadline' WHERE task_name='$prev_taskname'";
            $q1 = mysqli_query($con,$sql);
            $q2 = mysqli_query($con,$sqtask);
            if ( $q1 && $q2){
              
                $_SESSION['edit'] = 1;
                echo '<script>';
                echo 'Window.history.back();';
                echo '</script>';
            }else{
                // echo mysqli_error($con);
                echo '<script>alert("Failed to save changes !");</script>';
            }
            
        }
        ?>
        <?php include('../header.php'); ?>
         
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a href="javascript:void(0)"  title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    
                    <!--<a href="tsa.php" target="_parent" class=""><i class="fa fa-tasks" aria-hidden="true"></i> Assign Tasks</a>&nbsp;&nbsp;&nbsp;-->
                    
                   
        
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
                            <form method="post">
                            
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
                                                  $description =  $matask['description'];
                                                 endwhile;
                                                     $task = $row['task'];
                                                     $date_assigned =ucwords($row['date_assigned']);
                                                     $deadline = $row['deadline'];
                                                     $person =ucwords($row['user']);
                                                     $progress =ucwords($row['percentage']);
                                             
                                     
                                                  }
                                            ?>
                                            <input type="hidden" value="<?php echo $_GET['proj'];?>" name="project">
                                            <input type="hidden" value="<?php echo $_GET['task'];?>" name="task">
                                            <input type="hidden" value="<?php echo $task;?>" name="prev_taskname">
                                           <div class="row">
                                        <div class="col-lg-6">
                                           <label>Task Name</label>
                                          <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1"><i class="fa fa-tag"></i></span>
                                          <input type="text" class="form-control" placeholder="Username" name="task_name" value="<?php echo  $task;?>" aria-describedby="basic-addon1">
                                        </div>
                                       </div>
                                         <div class="col-lg-6">
                                             <div class="form-group">
                                                 <label>Urgency</label>
                                                 <select name="txtUrgency" class="form-control">
                                                      <option value="" selected diabled>Describe urgency </option>
                                                      <option value="1">Urgent</option>
                                                      <option value="2">Semi urgent</option>
                                                      <option value="3">Not urgent</option>
                                                 </select>
                                             </div>
                                         </div>
                                     </div>
                                         <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Task Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">
                                            <?php 
                                            if(!empty($description)){
                                                echo $description;}?>
                                        </textarea>
                                      </div>
                                      <div class="row">
                                          <div class="col-lg-6">
                                               <label for="exampleFormControlTextarea1">Start Date</label>
                                              <div class="input-group">
                                                  
                                          <span class="input-group-addon" id="basic-addon1"><i class="fa fa-table"></i></span>
                                          <input type="date" class="form-control" placeholder="Username" name="startdate"   value="<?php echo  $date_assigned;?>" aria-describedby="basic-addon1">
                                        </div>
                                          </div>
                                          <div class="col-lg-6">
                                               <label for="exampleFormControlTextarea1">Deadline</label>
                                              <div class="input-group">
                                                 
                                          <span class="input-group-addon" id="basic-addon1"><i class="fa fa-table"></i></span>
                                          <input type="date" class="form-control" placeholder="Username" name="deadline" value="<?php echo  $deadline;?>" aria-describedby="basic-addon1">
                                        </div>
                                          </div>
                                      </div>
                                      <label >Progress</label>
                                      <div class="progress">
                                          <?php if($progress>=1 && $progress<=10){ ?>
                                          <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><?php echo $progress;?>%</div>
                                          <?php }elseif($progress>=11 && $progress<=25){?>
                                          <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $progress;?>%</div>
                                           <?php }elseif($progress>=26 && $progress<=40){?>
                                          <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><?php echo $progress;?>%</div>
                                           <?php }elseif($progress>=41 && $progress<=50){?>
                                          <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $progress;?>%</div>
                                           <?php }elseif($progress>=51 && $progress<=75){?>
                                          <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><?php echo $progress;?>%</div>
                                           <?php }elseif($progress>=76 && $progress<=99){?>
                                          <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"><?php echo $progress;?>%</div>
                                           <?php }elseif($progress>=100){?>
                                          <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $progress;?>%</div>
                                          <?php }else{?>
                                          <div class="progress-bar" role="progressbar" style="width: 0%;background:red;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $progress;?>%</div>
                                          <?php }?>
                                        </div>
                                        <div class="input-group">
                                            <input type="submit" class="btn btn-primary" name="save" value="Save Changes">
                                        </div>

                                    
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
        
          </script>        
    </body>
</html>



