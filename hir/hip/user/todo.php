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
$compzz=$_SESSION['company'];

$cust_person=$_SESSION['userid'];
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
     .sidebar-menu .todo{
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
                    <a class="float-left" role="button" data-toggle="modal" data-target="#addToDo"><i class="fa fa-plus" ></i> Add To-Do task </a>&nbsp;&nbsp;&nbsp;

                    <a href="task-done"><i class="fa fa-list" ></i> ToDo archive</a>&nbsp;&nbsp;&nbsp;

                   <a data-toggle="modal" data-target="#deltodo" style="color:red;"><i class="fa fa-trash" aria-hidden="true" title="Delete selected tasks"></i> Delete</a>
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">          
                            <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;">#</th>
                                                    <!-- <input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /> -->
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Task</th>
                                                <th>Date to be done</th>
                                                <th>Status</th>
                                                <th>Sub-tasks</th>
                                                <th><center>Edit</center></th>
                                                <th>End task</th>
                                                <!-- <th><center>Del</center></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            
                                        $query  = "SELECT * FROM 
                                                todo where user= '".$_SESSION['userid']."' and status = 0
                                                ORDER BY id desc";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  {
                                                    $rw = $row['id'];
                                        $tod = mysqli_query($con,"SELECT * from subtasks where task= '$rw' and (status = 0 or status IS NULL) ");
                                            $td = mysqli_num_rows($tod); 
                                        if($td>0){
                                            $t = '<span style="color:#fff;float:right;background-color:red;font-size:9px;" class="badge"> '.number_format($td,0).'</span>';
                                        }else{
                                           $t = '<span style="color:#fff;float:right;background-color:darkgreen;font-size:9px;" class="badge"> Add</span>'; 
                                        }

                                                  if($row['status']==0) {
                                                    $status = "Pending";
                                                  } else{
                                                    $status = "Complete";
                                                  }          
                                                echo '
                                            <tr>
                                                <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td> 
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['task']).'</td>
                                                <td>'.ucwords($row['start']).'</td>
                                                <td>'.$status.'</td>
                                                <td><a class="text-success" href="s-todo?t='.$row['id'].'">Sub-tasks '.$t.'</a></td>  
                                                <td><center><a class="float-left" role="button" data-toggle="modal" data-target="#editToDo'.$row['id'].'"><i class="nav-icon fas fa-edit"> </i> Edit</a></center></td>
                                                <td><a class="text-danger" onclick="arChive('.$row['id'].')" style="cursor:pointer;"><i class="nav-icon fas fa-times"></i> End Task</td>
                                                <!--td><center><a class="text-danger" onclick="deLete('.$row['id'].')" style="cursor:pointer;"><i class="nav-icon fas fa-trash text-danger"> </i> Del</a></center></td>
                                                </tr-->
                                                ';
                                    $b=1;
                            $sdo=mysqli_query($con,"SELECT * FROM customer_comments WHERE (company='$compzz' AND followup_userid ='$cust_person' ) || (company= '$compzz' AND customer_person ='$cust_person') ORDER BY id ASC");
                            while($romm =mysqli_fetch_array($sdo)){
                                $cutt_person=$romm['customer_person'];
                                $cust_id=$romm['customer_id'];
                                $cimment=$romm['customer_comment'];
                                $percent=$romm['progress_percent'];
                                $personaz=$romm['followup_user'];
                                $deadlinez =$romm['customer_prefdate'];
                                $sd=mysqli_query($con,"SELECT * FROM tblstaff WHERE id='$cutt_person'");
                                while($ray =mysqli_fetch_array($sd)){
                                    $mname=$ray['full_name'];
                                    
                                }
                                //GET CUSTOMER NAME
                                
                                $nombre =mysqli_query($con,"SELECT * FROM tblcustomers WHERE id='$cust_id'");
                                while($uno =mysqli_fetch_array($nombre)){
                                    $ff=$uno['fname'];
                                    $mm=$uno['mname'];
                                    $ll=$uno['lname'];
                                }
                                //PROGRESS
                                if(!empty($romm['customer_progress'])){
                                if(($romm['customer_progress']) == 'Not Started'){
                                    $dis= '<span class="text-danger" style="font-family:fangsong; font-size: 15px!important;"><strong>Not started</strong></span>';
                                }
                                if(($romm['customer_progress']) == 'In Progress'){
                                    $dis= '<span  style="font-family:fangsong; color:#ffb000; font-size: 15px!important;"><strong>In Progress</strong></span><span class="text-dark" style="font-family:fangsong !important;"><em>('."$percent".' %)</em></span>';
                                }
                                if(($romm['customer_progress']) == 'Completed'){
                                    $dis= '<span class="text-success" style="font-family:fangsong; font-size: 15px!important;"><strong>Completed</strong></span>';
                                }}else{
                                    $dis= '<span class="text-danger" style="font-family:fangsong; font-size: 15px!important;"><strong>Not started</strong></span>';
                                }
                               //FOLLOWUP ASSIGNMENTS
                                //Checking if it's an assigned task or not
                                        if(($romm['followup_userid'] == $cust_person) && ($romm['customer_person']!== $cust_person)){
                                    $taskitz ='<span class="text-success" style="font-family:fangsong; font-size:15px!important;"><strong>Assigned Followup</strong></span>';
                                }
                                if(($romm['followup_userid'] !== $cust_person) && ($romm['customer_person'] == $cust_person ) && (!empty($romm['followup_userid']))){
                                $taskitz ='<span style="color:#FFA500; font-family:fangsong!important; font-size:15px!important;"><strong>'."$personaz".'  Followup </strong></span>';
                                }elseif(($romm['customer_person'] ==$cust_person) && ($romm['followup_userid'] == $cust_person) || empty($romm['followup_userid'])){
                                    $taskitz ='<span style="color:#FF7518; font-family:fangsong!important; font-size:15px!important;"><strong>My Followup </strong></span>';
                                }
                                //DEADLINES
                                if(!empty($deadlinez)){
                                    

                               $days_deadline=date('d',strtotime($deadlinez));
                               $months_deadline=date('m',strtotime($deadlinez));
                               $years_deadline=date('Y',strtotime($deadlinez));
                                    if(($months_deadline == $months_today )&& ($years_deadline == $years_today)){
                                    $day_diff =$days_today -$days_deadline;
                                
//                         
                           //if it's a diffrence of 2days deadline=color red
                               if($day_diff <= 1){
                               $display_deadline ='<span style="font-family:fangsong; font-size:15px; color:red;"><strong>'."$deadlinez".'</strong></span>';
                                }
//                             //5 days Amber
                            elseif(($day_diff <= 5) && ($day_diff >= 3)){
                               $display_deadline ='<span style="font-family:fangsong; font-size:15px; color:#C76A00;"><strong>'."$deadlinez".'</strong></span>';
                              }
//
//                             //else green
                             else{
                           $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-success"><strong>'."$deadlinez".'</strong></span>';
                               }
                                }else{
                                         $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-dark"><strong>'."$deadlinez".'</strong></span>';
                                    }
                                }
                                

                           
//
                                    
                            
                            
                                echo '
                                    <tr>
                                        <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$romm['id'].'" /></td>
                                        <td>'.$b++.'</td>
                                        <td>'.$ff.' '.$mm.' '.$ll.'</td>

                                        <td class="comos">'.$romm['customer_comment'].'</td>
                                        <td class="comos">'.$romm['customer_followup'].'</td>
                                        <td>'.$dis.'</td>
                                        <td>'.$display_deadline.'</td>
                                        <td>'.$taskitz.'</td>
                                        <td><a id="'.$romm['id'].'" class="edit_status" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">



                                                <img src="https://merimevents-run.com/hir/images/icons/eye.png" class="iconb"></a></td>
                                        <td>
                                            <a id="'.$romm['id'].'" class="edit_offer" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">




                                                <img src="https://merimevents-run.com/hir/images/icons/edit.png" class="iconb"></a>
                                        </td>




                                    </tr>';

                                     }
                                                
                                                include "edittodo.php";
                                                  
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>
                                    <?php include "deletefunction.php"; ?>

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
   function arChive(id)
     {   
      var  id=id;
      if (confirm("Are you sure you want to END this task?") == true) {
      if(id!='')
        {
         $.ajax({
         type:'POST',
         url:'endtask.php',
         data:{id: id},
         success:function(msg){
          setInterval('location.reload()',350);
         }
         });
         } } }


          function deLete(id)
     {   
      var  id=id;
      if (confirm("Are you sure you want to DELETE this task?") == true) {
      if(id!='')
        {
         $.ajax({
         type:'POST',
         url:'deltodo.php',
         data:{id: id},
         success:function(msg){
          setInterval('location.reload()',350);
         }
         });
         } } }
</script>       
    </body>
</html>



