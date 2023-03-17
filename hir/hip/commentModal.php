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
 
include "connection.php";
$id =$_POST['clear'];
//	if(isset($_POST['submitt'])){
//		echo'<script>alert("Error: '."$erf".'")</script>';
//	$note =$_POST['add_note'];
//	$cus=$_POST['custom_id'];	
//	$addn=mysqli_query($con,"INSERT INTO customer_notes(customer_id,comment_id,note) VALUES ('$cus','$id','$note')");
//	if($addn){
//		echo'<script>alert("Note Added Succesfully!")</script>';
//	}else{
//		$erf=mysqli_error($con);
//			echo'<script>alert("Error: '."$erf".'")</script>';
//	}
//	
//}
	
							
?>
<!doctype html>
<html>


<body>
	<?php
						$fin=mysqli_query($con,"SELECT * FROM customer_comments WHERE id='$id'");
						if($fin){
							while($ref =mysqli_fetch_assoc($fin)){
								$custt_id=$ref['customer_id'];
								$custt_person=$ref['customer_person'];
								$custt_additional=$ref['customer_additional'];
								$customer_progress=$ref['customer_progress'];
								$percent=$ref['progress_percent'];
								$cust_role=$ref['role'];
								$gru =mysqli_query($con,"SELECT * FROM tblcustomers WHERE id='$custt_id'");
								while($rayy = mysqli_fetch_array($gru)){
									$ffname=$rayy['fname'];
									$mmname=$rayy['mname'];
									$llname=$rayy['lname'];
								}
								//Get Progress
								if(empty($customer_progress)){
									$thisthing='Not Started';
								}else{
									if($customer_progress == 'In Progress'){
								    $thisthing = '<span style="font-family:fangsong!important;" class="text-warning"><strong>In Progress <span style="color: black!important;">'."$percent".' %</span</strong></span>';		
									}
									if($customer_progress == 'Not Started'){
										 $thisthing = '<span style="font-family:fangsong!important;" class="text-danger"><strong>Not Started</span></strong>';		
									}
									if($customer_progress == 'Completed'){
										 $thisthing = '<span style="font-family:fangsong!important;" class="text-success"><strong>Completed</span></strong>';		
									}
									}
								if($cust_role == "admin"){
									$grey=mysqli_query($con,"SELECT * FROM tblstaff WHERE id='$custt_person'");
								while($eye = mysqli_fetch_array($grey)){
									$fullname =$eye['full_name'];
								}
								}elseif($cust_role == "user"){
								$gre=mysqli_query($con,"SELECT * FROM tblusers WHERE id='$custt_person'");
								while($eye = mysqli_fetch_array($gre)){
									$fullname =$eye['full_name'];
								}
								}
						
								?>
	<h4 class="text-center text-primary" style="font-family:fangsong;"><strong> <?php echo $ffname; ?> <?php echo $mmname;?> <?php echo $llname;?>'s Comments</strong></h4>


	<form mehod="POST" class="forma">
		<label class="mb-4">Date the Comment was Added</label>
		<div class="form-group mt-4">
			<input type="date" class="form-control" value="<?php echo $ref['customer_date'] ?>" readonly>
		</div>
		<label class="mb-4">Comment Added by:</label>
		<div class="form-group mt-4">
			<input type="text" class="form-control" value="<?php echo $fullname; ?>" readonly>
		</div>
		<label class="mb-4">Comment</label>
		<div class="form-group">
			<textarea id="quoteInput" class="quote-input text-left" readonly><?php echo $ref['customer_comment']; ?></textarea>

		</div>

		<label class="mb-4">Follow Up Action:</label>
		<div class="form-group mt-4">
			<input type="text" class="form-control" value="<?php echo $ref['customer_followup']; ?>" readonly>
		</div>

		<?php if((!empty($ref['demo_date'])) && ($ref['customer_followup'] == 'Book a Demo')){?>
		<label class="mb-4">Prefered Demo Date</label>
		<div class="form-group mt-4">
			<input type="date" class="form-control" value="<?php echo $ref['demo_date'] ?>" readonly>
		</div>
		<?php } ?>



		<label class="mb-4">Prefered Follow up Date</label>
		<div class="form-group mt-4">
		
			<input type="text" class="form-control" value="<?php echo $ref['customer_prefdate'] ?>" readonly>
		</div>



		<br>
		<label>Current Followup Progress ( <?php echo $thisthing; ?>)</label><br><br>


		<?php if(!empty($ref['customer_additional'])){?>
		<label class="mb-4">Additional Followup Information</label>
		<textarea class="text-left  quote-input" readonly><?php echo $ref['customer_additional']; ?></textarea>
		<?php } ?>

		<?php if(!empty($ref['followup_user'])){?>
		<label class="mb-4">Person Responsible for followup</label>
		<input class="form-control" type="text" value="<?php echo $ref['followup_user']; ?>" readonly>
		<?php } ?>
		<?php if(!empty($ref['customer_updatedate'])){?>
		<label class="mb-4">Last Updated on</label>
		<input type="text" class="form-control" value="<?php echo $ref['customer_updatedate']; ?>" readonly>
		<?php } ?>



		<?php }} ?>




	</form>





	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
