<?php
  session_start();
//   ini_set('display_errors', 1);
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
<?php
$error = NULL;
$msg   = NULL;
include('../connection.php');

if(isset($_POST['addToDo'])){
    $task = $_POST['task'];
    $start = $_POST['start'];
    $date = date("Y-m-d h:i:sa");
    $user   = $_SESSION['userid'];
    $status = 0;
    
    $task = $mysqli->real_escape_string($task);
    $start = $mysqli->real_escape_string($start);


    
    $insert = $mysqli->query("INSERT INTO todo (task,start,user,status) VALUES('$task','$start','$user','$status')");
    
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
//--------------------------------
if(isset($_GET['redo-id'])){
     $txt_id = $_GET['redo-id'];
     $q = $_GET['state'];
   $query = $mysqli->query("UPDATE subtasks SET status = '".$q."' WHERE id = '".$txt_id."' ");
    if($query){
       echo '<script> window.history.back();</script>';
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
                    <a class="float-left" href="subtasks?t=<?php echo $_GET['t']; ?>"><i class="fa fa-plus" ></i> Add Sub-task </a>&nbsp;&nbsp;&nbsp;


                   <!--  <a data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" aria-hidden="true" title="Delete selected item"></i> Delete</a> -->
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <!-- <div class="box"> -->

                            <form method="post">
                        <div class="box-body table-responsive">
                                <p><?php
                                           $substasks=$_GET['t'];  
                                        $query  = "SELECT * FROM 
                                                todo where id = '".$_GET['t']."'";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                    {
                                                        echo $row['task']; } ?>
                                                        </p>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;">#</th>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Sub-Tasks</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                        $query  = "SELECT * FROM 
                                                subtasks where task = '".$_GET['t']."' ORDER BY status ";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                    {
                                                    if($row['status'] != 1) {
                                                        $status = "Pending";
                                                        $action = '<a class="text-success" href="s-todo?t='.$substasks.'&redo-id='.$row['id'].'&state=1" style="cursor:pointer;"><i class="nav-icon fas fa-pencil-square-o"></i> Done';
                                                    } else{
                                                        $status = "Done";
                                                        $action = '<a class="text-danger" href="s-todo?t='.$substasks.'&redo-id='.$row['id'].'&state=0" style="cursor:pointer;"><i class="nav-icon fas fa-redo"></i> Redo';
                                                    }

                                                echo '
                                            <tr>
                                                <td><input type="checkbox" name="chk_todo[]" class="chk_delete" value="'.$row['id'].'" /></td> 
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['sub_task']).'</td> 
                                                <td>'.$status.'</td> 
                                                <td>'.$action.'</td>
                                            </tr>
                                                ';
                                                
                                                //include "editlsd.php";
                                                  
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>
                                    <?php include "deletefunction.php"; ?>
</div>
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

                  
            <?php include "../notification.php"; ?>
            <?php include "../addModal.php"; ?>
            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>
                <!-- </div> -->
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
   function sTatus(id)
     {   
      var  id=id;
      if (confirm("Are you sure you want to end selected sub-task?") == true) {
      if(id!='')
        {
         $.ajax({
         type:'POST',
         url:'endsubtask.php',
         data:{id: id},
         success:function(msg){
          setInterval('location.reload()',350);
         }
         });
         } } }

         // redo
         function rEdo(id)
                {   
      var  id=id;
      if (confirm("Are you sure you want to redo this subtask?") == true) {
      if(id!='')
        {
         $.ajax({
         type:'POST',
         url:'redosubtask.php',
         data:{id: id},
         success:function(msg){
          setInterval('location.reload()',350);
         }
         });
         } } }
</script>       
    </body>
</html>



