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
<?php
$error = NULL;
$msg   = NULL;
include('../connection.php');

if(isset($_POST['addToDo'])){
    $task = $_POST['task'];
    $start = $_POST['start'];
    $deadline = $_POST['deadline'];
    $date = date("Y-m-d h:i:sa");
    $user   = $_SESSION['userid'];
    $status = "Pending";
    
    $task = $mysqli->real_escape_string($task);
    $start = $mysqli->real_escape_string($start);
    $deadline = $mysqli->real_escape_string($deadline);


    
    $insert = $mysqli->query("INSERT INTO todo (task,start,deadline,user,status) VALUES('$task','$start','$deadline','$user','$status')");
    
    if($insert){
            echo '<script type="text/javascript">'; 
            echo 'alert("Submitted successfully. ");'; 
            echo 'window.location = "todo";';
            echo '</script>';
    }else{
        echo '<script type="text/javascript">'; 
            echo 'alert("Error occured. ");'; 
            echo 'window.location = "todo";';
            echo '</script>';
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

        <?php
                function RandomString($length) {
                    $keys = array_merge(range(0,9));
                        $key = "";
                        for($i=0; $i < $length; $i++) {
                        $key .= $keys[mt_rand(0, count($keys) - 1)];
                    }
                        return $key;               
                }
            ?>
         
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                     <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;

                    <a href="todo"><i class="fa fa-list" ></i> ToDo Tasks</a>&nbsp;&nbsp;&nbsp;

                   <!--  <a data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" aria-hidden="true" title="Delete selected item"></i> Delete</a> -->
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">          
                            <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr><th style="width: 20px !important;"><input type="checkbox" name="chk_todo[]" class="cbxMain" onchange="checkMain(this)" />
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Task</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Delete task</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                        $query  = "SELECT * FROM 
                                                todo where user = '".$_SESSION['userid']."' and status=1
                                                ORDER BY id desc";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                  if($row['status']==0) {
                                                    $status = "Pending";
                                                  } else{
                                                    $status = "Complete";
                                                  }             
                                                echo '
                                            <tr>
                                            <td><input type="checkbox" name="chk_todo[]" class="chk_delete" value="'.$row['id'].'" /></td> 
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['task']).'</td>
                                                <td>'.ucwords($row['start']).'</td>
                                                <td>'.$status.'</td>
                                                <td><a class="text-danger" onclick="deLete('.$row['id'].')" style="cursor:pointer;"><i class="nav-icon fas fa-trash"></i> Delete</td>
                                                </tr>
                                                ';
                                                
                                                //include "editlsd.php";
                                                  
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>
                                 
                                    </form>

                                    <!---Add events Modal-->
<form method="post">
<div class="modal fade" id="addToDo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title" style="color:teal; font-weight:bold;"><center>Add To Do List</center></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form">
    <div class="input-group mb-2">
    <span class="input-group-addon bg-white border-right-0 px-4"><i class="fas fa-signature"></i></span>
    <input type="text" class="form-control bg-white border-left-0 " name="task" placeholder="Enter task title" Required>
  </div><br>

<div class="input-group mb-2">
    <span class="input-group-addon bg-white border-right-0 px-4"><i class="fas fa-calendar"></i></span>
    <input type="date" class="form-control bg-white border-left-0 " name="start" placeholder="Enter start date" Required>
  </div><br>
               <div class="input-group mb-2">
    <span class="input-group-addon bg-white border-right-0 px-4"><i class="fas fa-calendar"></i></span>
    <input type="date" class="form-control bg-white border-left-0 " name="deadline" placeholder="Enter deadline" Required>
  </div>
         
          </div>
   
    
      </div>
      <div class="modal-footer">
          <button type="submit" name="addToDo" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>

                  </div>
            <?php include "../notification.php"; ?>
            <?php include "../addModal.php"; ?>
            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>
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
          </script> 
          <script type="text/javascript">
   function deLete(id)
     {   
      var  id=id;
      if (confirm("Are you sure you want to delete this task?") == true) {
      if(id!='')
        {
         $.ajax({
         type:'POST',
         url:'delete-todo.php',
         data:{id: id},
         success:function(msg){
          setInterval('location.reload()',350);
         }
         });
         } } }
</script>       
    </body>
</html>



