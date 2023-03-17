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


$compzz=$_SESSION['company'];

$cust_person=$_SESSION['userid'];
//Working with Urgency
//get today's date
$todate=date('Y-m-d');
//day itself
$years_today=date('Y',strtotime($todate));
$months_today=date('m',strtotime($todate));
$days_today=date('d',strtotime($todate));
$display_deadline='';
if(isset($_POST['submit_comment'])){
$cust_id=$_POST['customer_ids'];
$cust_comment =mysqli_real_escape_string($con,$_POST['comment']);

$cust_followup=$_POST['follow_up'];
$todate=date('Y-m-d');
$cust_prefdate=$_POST['spec_date'];
$additional=mysqli_real_escape_string($con,$_POST['additional']);
$progresz='Not Started';
$demo_date=$_POST['demo_date'];
 $followup_deets=$_POST['followup_user'];
      $deets =explode(',',$followup_deets);
                   $followup_userid = $deets[0];
                   $followup_userole =$deets[1];
    //Name of person in charge of followup
    //Admin
    if($followup_userole == 'Admin'){
        $follo=mysqli_query($con,"SELECT * FROM tblstaff WHERE id='$followup_userid'");
        while($tog = mysqli_fetch_array($follo)){
            $followup_user = $tog['full_name'];
        }
    }
   //Regular User
    if($followup_userole == 'User'){
        $follo=mysqli_query($con,"SELECT * FROM tblusers WHERE id='$followup_userid'");
        while($tog = mysqli_fetch_array($follo)){
            $followup_user = $tog['full_name'];
        }
    }
    

    

    

$redd=mysqli_query($con,"INSERT INTO customer_comments(customer_comment,customer_person,customer_followup,customer_date,customer_prefdate,customer_id,customer_additional,customer_progress,company,role,demo_date,followup_user,followup_userid,followup_userole) VALUES ('$cust_comment','$cust_person','$cust_followup','$todate','$cust_prefdate','$cust_id','$additional','$progresz','$compzz','admin','$demo_date','$followup_user','$followup_userid','$followup_userole')");
if($redd){
echo'<script>alert("Comment Added succesfully!!");window.location="followups.php"</script>';

}else{
$error=mysqli_error($con);
echo'<script>alert(" '."$error".'");window.location="followups.php"</script>';
}

}
    //DELETE COMMENTS
    
        if(isset($_POST['delete']))
        {
            
            if(empty($_POST['chk_delete'])){
                echo'<script>alert("Select Comment(s) to delete!");window.location="comments.php?id='."$cust_id".'"</script>';
            }
            foreach($_POST['chk_delete'] as $value)
            {
                $deletee = mysqli_query($con,"DELETE from customer_comments where id = '$value' ");
                    if(!$deletee){
                        $era=mysqli_error($con);
                        echo '<script>alert("Error: '."$era".'");</script>';
                    }
                        
                elseif($deletee == true)
                {
                    $_SESSION['delete'] = 1;
                    header("location: ".$_SERVER['REQUEST_URI']);
                }
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

    .sidebar-menu .follow {
        background-color: #009999;
    }

    /* define variables for the primary colors */
    $primary_1: #ff9999;
    $primary_2: #b2ad7f;
    $primary_3: #878f99;

    /* use the variables */
    .main-container {
        /*padding: 100px;*/
        background-color: $primary_1;
        /*border-top-left-radius: 50px;*/
    }

    form {


        height: auto;
        /*background:red;*/
        padding: 20px;
        /*position: absolute;*/
        overflow: hidden;
        /*adding overflow hidden*/
    }

    form:before {
        content: ‘’;
        /*
        width: 300px;
        height: 400px;
*/
        background: inherit;
        position: absolute;
        left: -25px;
        /*giving minus -25px left position*/
        right: 0;
        top: -25px;
        /*giving minus -25px top position */
        bottom: 0;
        box-shadow: inset 0 0 0 200px rgba(255, 255, 255, 0.3);
        filter: blur(10px);
    }

    .main .input-group-append {
        display: flex;
    }

    .main .btn {
        position: relative;
        z-index: 2;
    }


    .container {
        background-color: #F0DB4F;
        padding: 1rem;
        border-radius: .5rem;
        width: 700px;
        max-width: 90%;
    }

    .timer {
        position: absolute;
        top: 2rem;

        color: #F0DB4F;
        font-weight: bold;
    }

    .quote-display {
        margin-bottom: 1rem;
        margin-left: calc(1rem + 2px);
        margin-right: calc(1rem + 2px);
    }

    .quote-input {
        background-color: transparent;
        color: black;
        border: 2px solid #A1922E;
        outline: none;
        width: 100%;
        height: 8rem;
        margin: auto;
        resize: none;
        padding: .5rem 1rem;

        border-radius: .5rem;
    }

    .quote-input:focus {
        border-color: black;
    }

    .comos {
        /*      display: inline-block;*/
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 10ch;
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


            <!-- The modal -->
            <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color:red!important; font-weight:900">&times;</span>
                                </button>
                                <div class="pull-left image">
                                    <img src="../../images/icons/edit.png" class="img-circle" alt="User Image" style="width:35px" />
                                </div>
                                <h4 class="modal-title text-center text-info" style="font-family:fangsong!important;" id="modalLabel"><strong>Add comments </strong></h4>
                            </div>
                            <div class="modal-body" style="height:450px; overflow:auto!important;">
                                <label class="mb-4">Select Customer</label>
                                <div class="form-group">
                                    <select name="customer_ids" class="form-control">
                                        <option disabled selected>All Customers</option>
                                        <?php
                                    $selecta=mysqli_query($con,"SELECT * FROM tblcustomers WHERE company='$compzz'");
                                    while($compy = mysqli_fetch_array($selecta)){?>
                                        <option value="<?php echo $compy['id']; ?>"><?php echo $compy['fname']; ?> <?php echo $compy['mnmae']; ?> <?php echo $compy['lname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="mb-4">Add comment</label>
                                <div class=" form-group ">
                                    <textarea class="form-control" name="comment" rows="4" required>

                                         </textarea>
                                </div>


                                <label class="mb-4">Select /Enter Follow up Action</label>
                                <div class="form-group">

                                    <input type="text" class="form-control bg-white border-left-0 customselect" name="follow_up" value="" list="agentss" placeholder="Enter/ Select follow up Action" Required>
                                    <datalist id="agentss" style="list-style:none!important; background-color:white!important;">
                                        <option value="Needs Follow up">Needs Follow up
                                        </option>

                                        <option value="Book a Demo">Book a Demo
                                        </option>
                                        <option value="Follow up after a Demo">Follow up after a Demo
                                        </option>


                                        <option value="Onboard">Onboard
                                        </option>

                                        <option value="Gave a Date">Gave a Date
                                        </option>
                                        <option value="Send First Invoice">Send First Invoice
                                        </option>





                                    </datalist>
                                </div>
                                <div class="showcontent1" style="display:none;">
                                    <label>Enter Preffered date for the demo</label>
                                    <div class="form-group">
                                        <input type="date" class="form-control bg-white" name="demo_date">
                                    </div>
                                </div>
                                <div class="showcontent">
                                    <label>Enter Prefered date for followup</label>
                                    <div class="form-group">
                                        <input type="date" class="form-control bg-white" name="spec_date">
                                    </div>
                                </div>
                                <label class="mb-4 mt-4">Enter Additional Followup Information</label>
                                <div class="form-group">
                                    <textarea class="form-control" rows="4" name="additional">

                                    </textarea>
                                </div>
                                <label class="mb-4 mt-5">Who is responsible for followup?</label>
                                <select name="followup_user" class="form-control" required>
                                    <option disabled selected> Select </option>
                                    <?php 
                                    
                                    $wham =mysqli_query($con,"SELECT * FROM tblusers WHERE company='".$_SESSION['company']."' ");
                                    while($whamy = mysqli_fetch_array($wham)){ ?>
                                    <option value="<?php echo $whamy['id']; ?>,User"><?php echo $whamy['full_name']; ?></option>

                                    <?php }
                                
                                    $bang=mysqli_query($con,"SELECT * FROM tblstaff WHERE company='".$_SESSION['company']."' ");
                                    
                                    while($ban = mysqli_fetch_array($bang)){ ?>
                                    <option value="<?php echo $ban['full_name']; ?>,Admin"><?php echo $ban['full_name']; ?></option>

                                    <?php } ?>
                                </select>


                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="submit_comment" class="btn btn-primary">save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--End of Add comment Modal-->

            <!--==== View comment Modal  New--------->

            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" id="myyModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="">
                            <a type="button" href="todo" class="close" aria-hidden="true">&times;</a>
                            <div class="pull-left image">
                                <img src="../../images/icons/edit.png" class="img-circle" alt="User Image" style="width:35px" />
                            </div>

                        </div>
                        <div class="modal-body" style="overflow:auto; height:500px">
                            <div class="row">
                                <div class="result" id="txtHint"></div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="todo" class="btn btn-danger">Close</a>

                        </div>
                    </div>
                </div>
            </div>




                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
                        <form method="post">
                           <strong><h5>To Do Tasks</h5></strong>
                        <div class="box-body table-responsive">          
                            
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;">#</th>
                                                    <!-- <input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /> -->
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Task</th>
                                                <th>Deadline</th>
                                                <th>Status</th>
                                                <th>Sub-tasks</th>
                                                <th><center>Edit</center></th>
                                                <th>End task</th>
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
                                                ';
                                    include "edittodo.php";
                                     } ?>
                                        </tbody>
                                    </table>
                                </div>
                             </form>
                           <!-- <div class="box">  --> 
<br>
                        
                                        
                        <?php 
                        $sdo=mysqli_query($con,"SELECT * FROM customer_comments WHERE (company='$compzz' AND followup_userid ='$cust_person' OR customer_person ='$cust_person') AND customer_progress !='Completed' ");
                        $tddd = mysqli_num_rows($sdo);
                        if($tddd>0){
                            echo '<strong><h5>Followups</h5></strong>';
                                     echo '
                                <div class="box-body table-responsive"> 
                       <table id="table1" class="table table-striped">
                                    <thead>
                                <tr>
                                    <th>#</th>
                                    <th><i class="fa fa-list"></i></th>
                                    <th>Customer</th>
                                    <th>Deadline</th>
                                    <th>Followup Action</th>
                                    <th>Progress</th>
                                    <th>View</th>
                                    <th>Update</th>
                                 </tr></thead>
                                
                                 ';
                            

                               echo '<tbody>';
                                           
                            $sdo=mysqli_query($con,"SELECT * FROM customer_comments WHERE (company='$compzz' AND followup_userid ='$cust_person' OR customer_person ='$cust_person') AND customer_progress !='Completed' ORDER BY customer_progress DESC");
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
                                    $dis= '<span class="text-danger" style="font-family:fangsong;"><strong>Not started</strong></span>';
                                }
                                if(($romm['customer_progress']) == 'In Progress'){
                                    $dis= '<span  style="font-family:fangsong; color:#ffb000;"><strong>In Progress</strong></span><span class="text-dark" style="font-family:fangsong !important;"><em>('."$percent".' %)</em></span>';
                                }
                                if(($romm['customer_progress']) == 'Completed'){
                                    $dis= '<span class="text-success" style="font-family:fangsong;"><strong>Completed</strong></span>';
                                }}else{
                                    $dis= '<span class="text-danger" style="font-family:fangsong;"><strong>Not started</strong></span>';
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
                           $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-success">'."$deadlinez".'</span>';
                               }
                                }else{
                                         $display_deadline ='<span style="font-family:fangsong; font-size:15px;" class="text-dark">'."$deadlinez".'</span>';
                                    }
                                }
                                

                                echo '
                                    <tr>
                                        <td><i class="fa fa-check"></i></td>
                                        <td>'.$c++.'</td>
                                        <td>'.$ff.' '.$mm.' '.$ll.'</td>
                                        <td>'.$display_deadline.'</td>
                                        <td class="comos">'.$romm['customer_followup'].'</td>
                                        <td>'.$dis.'</td>
                                        <td><a id="'.$romm['id'].'" class="edit_status" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">
                                            <img src="https://merimevents-run.com/hir/images/icons/eye.png" class="iconb"></a></td>
                                        <td>
                                            <a id="'.$romm['id'].'" class="edit_offer" type="submit" name="submit" data-toggle="modal" data-target="#myyModal">
                                            <img src="https://merimevents-run.com/hir/images/icons/edit.png" class="iconb"></a>
                                        </td>
                                     </tr>';
                                           } 
                                            echo '</tbody>   
                                    </table>';
                                       }
                                      
                                            ?>
                                      
                                      
                                    <?php include "../deleteModal.php"; ?>
                                    <?php include "deletefunction.php"; ?>

                                    

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
              $(function() {
                  $("#table1").dataTable({
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
          window.location.href = window.location.href;
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
          setInterval('location.reload()',100);
         }
         });
         } } }
</script>   
    <script>
        $('.customselect').change(function() {

            if (($(this).val() == '1')) {
                $('.showcontent2').show();
                $('.urgent').show();
                $('.all').hide();
                $('.my').hide();
                $('.others').hide();
                $('.showcontent1').hide();
                $('.showcontent3').hide();
                $('.showcontent4').hide();


            }
            if (($(this).val() == '2')) {
                $('.showcontent3').show();
                $('.my').show();
                $('.all').hide();
                $('.urgent').hide();
                $('.others').hide();
                $('.showcontent1').hide();
                $('.showcontent2').hide();
                $('.showcontent4').hide();


            }
            if (($(this).val() == '3')) {
                $('.showcontent4').show();
                $('.others').show();
                $('.all').hide();
                $('.my').hide();
                $('.urgent').hide();
                $('.showcontent1').hide();
                $('.showcontent2').hide();
                $('.showcontent3').hide();


            }
            if (($(this).val() == '0')) {
                $('.showcontent1').show();
                $('.all').show();
                $('.urgent').hide();
                $('.my').hide();
                $('.others').hide();
                $('.showcontent2').hide();
                $('.showcontent3').hide();
                $('.showcontent4').hide();


            }
        });

    </script>
    <script>
        $(document).ready(function() {
            $('.edit_status').click(function(e) {
                e.preventDefault();
                var del = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "../commentModal.php",
                    data: {
                        clear: del
                    },
                    success: function(data) {
                        $('.result').html(data);

                    }

                });
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $('.edit_offer').click(function(e) {
                e.preventDefault();
                var del = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "../updateComment.php",
                    data: {
                        clear: del
                    },
                    success: function(data) {
                        $('.result').html(data);

                    }
                });
            });
        });

    </script>    
    </body>
</html>



