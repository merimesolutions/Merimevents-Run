<?php
  session_start();
//       ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
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
    .checkbox-menu li label {
    display: block;
    padding: 3px 10px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
    margin:0;
    transition: background-color .4s ease;
}
.checkbox-menu li input {
    margin: 0px 5px;
    top: 2px;
    position: relative;
}

.checkbox-menu li.active label {
    background-color: #cbcbff;
    font-weight:bold;
}

.checkbox-menu li label:hover,
.checkbox-menu li label:focus {
    background-color: #f5f5f5;
}

.checkbox-menu li.active label:hover,
.checkbox-menu li.active label:focus {
    background-color: #b8b8ff;
}
    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        if(isset($_POST['save'])){
            $task_name = $_POST['task_name'];
            $company    =$_SESSION['company'];
            $description= $_POST['description'];
            $startdate = $_POST['startdate'];
            $deadline = $_POST['deadline'];
            $project_id = $_POST['project'];
            $task_id = $_POST['task'];
            $prev_taskname = $_POST['prev_taskname'];
            $userId = $_POST['userId'];
            if(!empty($userId)){
               $users_id = implode(',', $userId);
               //-----------------GET THESE GUYS---- -------------------------
                    $name = array() ;
                    foreach ($userId as $users_ide){ 

                    $users= mysqli_query($con,"SELECT * FROM tblusers WHERE id = '$users_ide' AND company ='$company'");
                       
                        while($u = mysqli_fetch_assoc($users)){
                        $user_id = $u['id'];
                        $name[] = $u['full_name'];

                        }
                        
                        $fullnames = implode(", ",$name);
                  
                    }
             // ------------------END GUYS-----------------------------
             }else{
                $users_id  = $_POST['users_assigned']; 
                
             } 
             //-------------------------if their is a file -----------------
              #file name with a random number so that similar dont get replaced
                     $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
                 
                    #temporary file name to store file
                    $tname = $_FILES["file"]["tmp_name"];
                     if(!empty($pname)){
                     #upload directory path
                    $uploads_dir = '../documents';
                    #TO move the uploaded file to specific location
                    move_uploaded_file($tname, $uploads_dir.'/'.$pname);
                      #sql query to insert into database
                    $sql_file = "INSERT into tbltasksdocuments(task_id,doc_name) VALUES('$task_id','$pname')";
                 
                    if(mysqli_query($con,$sql_file)){
                 
                    echo "File Sucessfully uploaded";
                    }
                    else{
                        echo "Error";
                    }
                }
                 
                            //------------------UPDATE THESE GUYS----------------------------------

              $sql = "UPDATE tasks SET task_name = '$task_name',user='$users_id', deadline = '$deadline',date_assigned= '$startdate' WHERE  project_id ='$project_id'";
             //  //edit tasks
             // $sqtask = "UPDATE tbltasks SET task_name ='$task_name',description ='$description', employee_id= '$users_id', start_date='$startdate', end_date ='$deadline' WHERE task_name='$prev_taskname'";
            $q1 = mysqli_query($con,$sql);
           // $q2 = mysqli_query($con,$sqtask);
            if ( $q1 ){
              
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
                    
                      <h5 style="position: absolute;right: 15px;padding:2px;font-weight: 600;color: #00cc99;"><span style="color:#000;">Task: </span> <?php
                        $q  = "SELECT * FROM  tasks where
                                               project_id = '".$_GET['proj']."' and  id = '".$_GET['task']."'
                                                ";
                                            $result = mysqli_query($con, $q);
                                                while ($row = mysqli_fetch_array($result))
                                                  {
                                                  $task = $row['task_name'];            
                                                   $description =  $row['description'];
                                                    echo ucwords($row['task_name']);
                                                  }
                                                  ?></h5> 
        
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">   
                            
                            <form method="post" enctype="multipart/form-data">
                            
                                            <?php
                                            $c=1;
                                            $date=date("Y-m-d");
                
                         
                            while($row = mysqli_fetch_array($result))
                                                  {
                                            $task = $row['task_name'];
                                            // $employee_id = $row['employee_id'];
                                            $per = $row['task_progress'];
                                            $d = $row['deadline'];
                                            if($per<100)
                                            {
                                                $status = '<p style="color: red">'. "Incomplete" .'</p>';
                                            }
                                            elseif($per>=100)
                                            {
                                                $status = '<p style="color: green">'. "Completed" .'</p>';
                                            }
                                            
                                                     
                                                     $date_assigned =ucwords($row['date_assigned']);
                                                     $deadline = $row['deadline'];
                                                     $person =$row['user'];
                                                     $progress =ucwords($row['task_progress']);
                                             
                                     
                                                  }
                                            ?>
                                            <input type="hidden" name="users_assigned" value="<?php echo $person;?>">
                                            <input type="hidden" value="<?php echo $_GET['proj'];?>" name="project">
                                            <input type="hidden" value="<?php echo $_GET['task'];?>" name="task">
                                            <input type="hidden" value="<?php echo $task;?>" name="prev_taskname">
                                            
                                           <div class="row">
                                        <div class="col-lg-6">
                                           <label>Task Name</label>
                                          <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1"><i class="fa fa-tag"></i></span>
                                          <input type="text" class="form-control" placeholder="Task Name" name="task_name" value="<?php echo  $task;?>" aria-describedby="basic-addon1">
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
                                     <div class="row">
                                        <div class="col-lg-6">
                                         <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Task Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description">
                                            <?php 
                                            if(!empty($description)){
                                                echo $description;}?>
                                        </textarea>
                                      </div>
                                  </div>
                                  <div class="col-lg-6">
                                    <div class="form-group">
                            <label>Person in charge</label>
                            
                                     <!-- users -->

                                        <div class="dropdown">
                                          <button class="btn btn-default dropdown-toggle" type="button" 
                                                  id="dropdownMenu1" data-toggle="dropdown" 
                                                  aria-haspopup="true" aria-expanded="true">
                                            <i class="fa fa-user"></i>
                                            <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1">
                                          
                                          <?php
                                                        $a = mysqli_query($con,"SELECT * from tblusers where company='".$_SESSION['company']."' order by full_name desc");
                                                   
                                                          while($row=mysqli_fetch_array($a)){
                                                            echo '<li>  <label>';
                                                            echo '<input type="checkbox" name="userId[]" class="form-control" value="'.$row['id'].'"> &nbsp;'.ucwords($row['full_name']);
                                                            echo '</label></li>';
                                                       
                                                          }    
                                                      ?>
    
                                          </ul>
                                        </div>
                                   </div>
                                  </div>
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
                                        <div class="row">
                                          <div class="col-lg-6">
                                               <label for="exampleFormControlTextarea1">Upload File</label>
                                              <div class="input-group">
                                                  
                                          <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                          <input type="File" class="form-control" placeholder="Upload file" name="file"   value="" aria-describedby="basic-addon1">
                                        </div>
                                          </div>
                                      </div>
                                      <br><br>
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



