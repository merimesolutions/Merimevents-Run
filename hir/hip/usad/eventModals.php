<?php
// session_start();
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
 $compp=$_SESSION['company'];
 include "../connection.php";
 //Task Assignments
 if(isset($_POST['btn_add_event_task'])){

	 $employee_id=$_POST['employee_id'];
     $task_name=$_POST['task_name'];
     $task_role=$_POST['task_role'];
     $start_date =$_POST['start_date'];
     $end_date=$_POST['dead_line'];
     $event_name=$_POST['event_name'];
     $event_id=$_POST['event_id'];
    
     
     //GET employee id and validate employee name
     $smp =mysqli_query($con, "SELECT * FROM tblusers WHERE id='$employee_id' AND company='$compp'");
    
     if($smp){
         $no_no =mysqli_num_rows($smp);
         if($no_no == 0){
             $name_err ="There is no staff member by that name";
         }
		 while($roma = mysqli_fetch_assoc($smp)){
			 $employee_name =$roma['full_name'];
			 
		 }
       
     }
     //check if the task already exists
     $sql000=mysqli_query($con,"SELECT * FROM tbltasks WHERE task_name='$task_name' AND project='Event' AND event_id='$event_id' AND employee_id='$employee_id' ");
     if($sql000){
         $number = mysqli_num_rows($sql000);
              if($number > 0){
         $err_of = "This task record already exists";
      
     }

     }  
     //----------------//
     if((empty($name_err)) && (empty($err_of))){
         $squery =mysqli_query($con,"INSERT INTO tbltasks(task_name,description,project,company,event_name,event_id,employee_name,employee_id,task_role,start_date,end_date,task_progress) VALUES ('$task_name','NILL','Event','$compp','$event_name','$event_id','$employee_name','$employee_id','$task_role','$start_date','$end_date',0)");
         if($squery){
             echo '<script>alert("Task Assigned successfully");window.location="events";</script>';
         }else{
             $errx =mysqli_error($con);
             echo'<script>alert("'."$errx".' ");window.location="events.php";</script>';
         }
     
     
     }
         if(!empty($name_err)){
            echo'<script>alert("'."$name_err".' ");window.location="events.php";</script>';  
          
         }
         if(!empty($err_of)){
       echo'<script>alert("'."$err_of".' ");window.location="events.php";</script>';  
         }
         
    
 
     }
 
       //Edit Tasks
    if(isset($_POST['btn_edit_event_task'])){
        
         $employee_name =$_POST['employee_name'];
     $task_name=$_POST['task_name'];
     $task_role=$_POST['task_role'];
     $start_date =$_POST['start_date'];
     $end_date=$_POST['dead_line'];
     $event_name=$_POST['event_name'];
     $event_id=$_POST['event_id'];
     $task_progress=$_POST['task_progress'];
     $tasks_id=$_POST['task_id'];
    
     
     //GET employee id and validate employee name
     $smp =mysqli_query($con, "SELECT * FROM tblusers WHERE full_name='$employee_name' AND company='$compp'");
    
     if($smp){
         $no_no =mysqli_num_rows($smp);
         if($no_no == 0){
             $name_err ="There is no staff member by that name";
         }
         while($er =mysqli_fetch_assoc($smp)){
             $employee_id =$er['id'];
    }}
    //if no error
    if(empty($name_err)){
        $squery=mysqli_query($con,"UPDATE tbltasks SET task_name='$task_name', task_role='$task_role', start_date='$start_date',end_date='$end_date',event_id='$event_id',event_name='$event_name',employee_name='$employee_name',employee_id='$employee_id',task_progress='$task_progress' WHERE id='$tasks_id'");
        if($squery){
            echo'<script>alert("Task Updated successfully!");window.location="";</script>';
        }else{
            $errr=mysqli_error($con);
              echo'<script>alert("'."$errr".'");window.location="view_event.php?'."$event_id".'";</script>';
        }
    }else{
         echo'<script>alert("'."$name_err".'");window.location="view_event.php?'."$event_id".'";</script>';
    }
    
     }
    
?>
<div id="taskass<?php echo $row['id'];?>" class="modal fade">
	<form method="post" action="" enctype="multipart/form-data">
		<div class="modal-dialog modal-sm" style="width:400px !important;">
			<div class="modal-content">
				<div class="modal-header" style="">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<div class="pull-left image">
						<img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px" />
					</div>
					<h4 class="modal-title">
						<center>Task Assignments</center>
					</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<strong>
								<h4 class="text-center font-weight-bold" style="font-family:fangsong; margin-bottom:30px!important"><?php echo $row['customer_name'];?>&nbsp;<?php echo $row['event_name']; ?></h4>
							</strong>
							<input type="hidden" name="event_name" value="<?php echo $row['event_name'];?>">
							<input type="hidden" name="event_id" value="<?php echo $row['id'];?>">


							<div class="form-group">
								<label>Task Description</label>
								<textarea name="task_name" class="form-control" rows="4"></textarea>
							</div>

							<div class="form-group">


								<label>Select Employee</label>

								<select name="employee_id" class="form-control">
									<option disabled selected>Employees:</option>
									<?php
								  $sp=mysqli_query($con,"SELECT * FROM tblusers WHERE company='$compp'");
                if($sp){
                  
                while ($row = mysqli_fetch_assoc($sp)){
                   
                    
            ?>

									<option value="<?php echo $row['id']; ?>"><?php echo $row['full_name']; ?></option>

									<?php }}?>
								</select>
							</div>
							<div class="form-group">
								<label>Role</label>
								<select class="form-control" name="task_role">
									<option disabled selected>Select Role</option>
									<option value="event_leader">Event Leader</option>
									<option value="other">Other</option>
								</select>
							</div>
							<div class="form-group">
								<label>Start Date</label>
								<input required name="start_date" id="started" class="form-control" style="width: 100%" type="date" />
							</div>


							<div class="form-group">
								<label>Deadline</label>
								<input required name="dead_line" id="deadline" class="form-control" style="width: 100%" type="date" />
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel" />
						<input type="submit" class="btn btn-primary btn-sm" name="btn_add_event_task" value="Save" />
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<!------------------------------------------Edit Task Modal------------------->
<div id="editask<?php echo $task_id;?>" class="modal fade">
	<form method="post" action="" enctype="multipart/form-data">
		<div class="modal-dialog modal-sm" style="width:400px !important;">
			<div class="modal-content">
				<div class="modal-header" style="">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<div class="pull-left image">
						<img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px" />
					</div>
					<h4 class="modal-title">
						<center>Edit Task Assignment</center>
					</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<?php
                $res =mysqli_query($con,"SELECT * FROM tbltasks WHERE id='$task_id'");
                if($res){
                    while($row = mysqli_fetch_assoc($res)){
                        $taskk_name=$row['task_name'];
                        $employeee_name=$row['employee_name'];
                        $taskk_role=$row['task_role'];
                        $startt_date=$row['start_date'];
                        $endd_date=$row['end_date'];
                        $progresss=$row['task_progress'];
                        $eventt_name=$row['event_name'];
                        $eventt_id=$row['event_id'];
                        $taskk_id=$row['id'];
                        
                    }
                }
                
                ?>
							<strong>
								<h4 class="text-center font-weight-bold" style="font-family:fangsong; margin-bottom:30px!important"><?php echo $eventt_name ?></h4>
							</strong>
							<input type="hidden" name="event_name" value="<?php echo $eventt_name;?>">
							<input type="hidden" name="event_id" value="<?php echo $eventt_id; ?>">
							<input type="hidden" name="task_id" value="<?php echo $taskk_id;?>">


							<div class="form-group">
								<label>Task Name</label>
								<input name="task_name" class="form-control input-sm" type="text" style="width:100%" value="<?php echo $taskk_name;?>">
							</div>

							<div class="form-group">


								<label>Select Employee</label>
								<input type="text" class="form-control" name="employee_name" value="<?php echo $employeee_name; ?>" list="employee" id="myInput" placeholder="Enter Staff Name" Required>
								<datalist id="employee" style="list-style:none!important;">
									<?php 
           
               
                $sp=mysqli_query($con,"SELECT * FROM tblusers WHERE company='$compp'");
                if($sp){
                  
                while ($row = mysqli_fetch_assoc($sp)){
                   
                    
            ?>

									<option id="myTable" value="<?php echo $row['full_name'];
                ?>">


									</option>
									<?php 
                }
                  
                }
                // While loop must be terminated
            ?>

								</datalist>
							</div>
							<div class="form-group">
								<label>Role</label>
								<select class="form-control" name="task_role">
									<?php
                           $va=explode(',',$taskk_role);
                           ?>

									<option disabled selected>Select Role</option>
									<!--<option value="Bomet" <?php echo (in_array("Bomet", $va)?'selected':''); ?>>Bomet</option>-->
									<option value="event_leader" <?php echo (in_array("event_leader", $va)?'selected':''); ?>>Event Leader</option>
									<option <?php echo (in_array("other", $va)?'selected':'')?> value="other">Other</option>
								</select>
							</div>
							<div class="form-group">
								<label>Start Date</label>
								<input required name="start_date" id="started" class="form-control" style="width: 100%" type="date" value="<?php echo $startt_date; ?>" />
							</div>


							<div class="form-group">
								<label>Deadline</label>
								<input required name="dead_line" id="deadline" class="form-control" value="<?php echo $endd_date; ?>" style="width: 100%" type="date" />
							</div>
							<div class="form-group">
								<label>Progress</label>
								<?php
                           $vaz=explode(',',$progresss);
                           ?>
								<select class="form-control" name="task_progress">
									<option disabled selected>Select Progress</option>
									<option <?php echo (in_array("0", $vaz)?'selected':'')?> value="0">Not started</option>
									<option <?php echo (in_array("25", $vaz)?'selected':'')?> value="25">Quarter way Done(25%)</option>
									<option <?php echo (in_array("50", $vaz)?'selected':'')?> value="50">Halfway Done(50%)</option>
									<option <?php echo (in_array("75", $va)?'selected':'')?> value="75">Almost Done(75%)</option>
									<option <?php echo (in_array("100", $va)?'selected':'')?> value="100">Completed(100%)</option>
								</select>

							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel" />
						<input type="submit" class="btn btn-primary btn-sm" name="btn_edit_event_task" value="Edit" />
					</div>
				</div>
			</div>
		</div>
	</form>

</div>
<!------------------------------------------------------------------------------------>
