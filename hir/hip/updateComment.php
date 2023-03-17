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
$id=$_POST['clear'];


						$fin=mysqli_query($con,"SELECT * FROM customer_comments WHERE id='$id'");
						if($fin){
							while($ref =mysqli_fetch_assoc($fin)){
								$custt_id=$ref['customer_id'];
								$custt_person=$ref['customer_person'];
								$followup=$ref['customer_followup'];
								$customer_prefdate=$ref['customer_prefdate'];
								$customer_comment=$ref['customer_comment'];
								$customer_additional=$ref['customer_additional'];
								$customer_progress=$ref['customer_progress'];
								$percent=$ref['progress_percent'];
								$user_role=$ref['role'];
								$demodate=$ref['demo_date'];
								$followup_person=$ref['followup_user'];
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
								
								$gru =mysqli_query($con,"SELECT * FROM tblcustomers WHERE id='$custt_id'");
								while($rayy = mysqli_fetch_array($gru)){
									$ffname=$rayy['fname'];
									$mmname=$rayy['mname'];
									$llname=$rayy['lname'];
								}
								
								if($user_role == 'admin'){
									$grey=mysqli_query($con,"SELECT * FROM tblstaff WHERE id='$custt_person'");
								while($eye = mysqli_fetch_array($grey)){
									$fullname =$eye['full_name'];
								}
								}elseif($user_role == 'user'){
								$gre=mysqli_query($con,"SELECT * FROM tblusers WHERE id='$custt_person'");
								while($eye = mysqli_fetch_array($gre)){
									$fullname =$eye['full_name'];
								}
								}}}
?>
<html>

<h4 class="text-primary text-center" style="font-family:fangsong!important; margin-bottom:20px!important;"><strong>Update Comment </strong></h4>

<form method="post" class="forma">



	<label class="mb-4">Comment Added by:</label>
	<div class="form-group  mt-5">
		<input type="text" class="form-control" name="person" value="<?php echo $fullname; ?>" readonly>

	</div>
	<!--------------------------------------------------------------------------------------------------------------------------------->
	<?php
	$g=1;
	$rfds =mysqli_query($con,"SELECT * FROM followup_comments WHERE comment_id='$id'");
	if($rfds){
		$no_fo =mysqli_num_rows($rfds);
		if($no_fo > 0){?>
	<label class="mb-4">Previous Comments:</label>
	<table class="table table-striped" class="margin-top: 30px!important;">

		<thead>
			<tr>
				<th>#</th>
				<th>Comment</th>
				<th>followup action</th>
				<th>Followup date</th>
				<th>Date Added</th>
			</tr>
		</thead>

		<tbody>
			<?php
					   while($fore =mysqli_fetch_assoc($rfds)){
					   
					   ?>
			<tr>
				<td><?php echo $g++; ?></td>
				<td><?php echo $fore['comment']; ?></td>
				<td><?php echo $fore['followup_action']; ?></td>
				<td><?php echo $fore['followup_date']; ?></td>
				<td><?php echo $fore['date']; ?></td>
			</tr>
			<?php }?>

		</tbody>
	</table>
	<?php }} ?>










	<!-------------------------------------------------------------------------------------------------------------------------------------------->
	<label class="mb-4">Current Comment:</label>
	<div class=" form-group ">
		<input type="text" name="comment" value="<?php echo $customer_comment; ?>" class="form-control">
		<!--
		<textarea class="form-control" name="comment">
              <?php echo $customer_comment; ?>
                 </textarea>
-->
	</div>
	<input type="hidden" name="comment_id" value="<?php echo $id; ?>">

	<label class="mb-4">Current Followup action</label>
	<div class="form-group">
		<input type="text" class="form-control bg-white border-left-0" name="old_followup" value="<?php echo $followup;?>" readonly>
	</div>
	<?php if((!empty($demodate)) && ($followup == 'Book a Demo')){?>
	<label>Demo Date</label>
	<div class=" form-group">
		<input type="text" name="demo_date" class="form-control bg-white" value="<?php echo $demodate; ?>" readonly>
	</div>
	<label>New Demo Date <span class="text-info"><i>(optional)</i></span></label>
	<div class=" form-group mt-1">
		<input type="date" name="demo_date" class="form-control bg-white">
	</div>

	<?php } ?>
	<label class="mb-4">New Follow up Action (<span class="text-info"><i>if need be</i></span>)</label>

 
<div class="form-group">

									<input type="text" class="form-control bg-white border-left-0 customselect" name="new_followup" value="" list="agentss" placeholder="Enter/ Select follow up Action" Required>
									<datalist id="agentss" style="list-style:none!important; background-color:white!important;">
										<?php
										 $compzz =$_SESSION['company'];
										$foll=mysqli_query($con,"SELECT * FROM followups WHERE user='$compzz'");
										while($romer =mysqli_fetch_array($foll)){?>
										<option value="<?php echo $romer['followup_detail']; ?>"><?php echo $romer['followup_detail']; ?>
										</option>
										<?php } ?>
									</datalist>
								</div>
	 

	<label>Prefered Followup date</label>
	<div class=" form-group">
		
		<input type="date" name="pref_date" class="form-control bg-white" value="<?php echo $customer_prefdate; ?>">
	</div>



	<label class="mb-4">Additional Followup Information</label>
	<textarea class="text-left  quote-input" name="add"><?php echo $customer_additional; ?></textarea>
	<br><br>

	<?php if(!empty($followup_person)){?>
	<label>Person Responsible for followup</label>
	<div class=" form-group">
		<input type="text" name="followup_person" class="form-control bg-white" value="<?php echo $followup_person; ?>" readonly>
	</div>
	<?php } ?>

	<label>Current Followup Progress ( <?php echo $thisthing; ?>)</label>
	<br><br>
	<?php
	$va=explode(',',$customer_progress);
	
	?>


	<label class="mb-4">Update Followup Progress</label>
	<select name="progress" class="cust form-control">
		<option disabled selected>Select Option</option>
		<option value="In Progress" <?php echo (in_array("In Progress", $va)?'selected':''); ?>>In progress</option>
		<option value="Completed" <?php echo (in_array("Completed", $va)?'selected':''); ?>>Completed</option>

	</select>
	<br>
	<?php if($customer_progress == 'In Progress'){?>
	<div>
		<label class="4"> Percentage of followup covered</label>
		<input type="number" name="progress_percent" value="<?php echo $percent; ?>" class="form-control" placeholder="Enter %">
	</div>

	<?php } ?>
	<div class="showup" style="display:none;">
		<label class="4">Enter Percentage of followup covered</label>
		<input type="number" name="progress_percentz" value="<?php echo $percent; ?>" class="form-control" placeholder="Enter %">
	</div>


	<div class="form-group" style="margin-top:20px!important;">
		<input type="submit" class="edit_commentz btn btn-block" name="update" style="background-color:#32cd32; color:white!important;" value="UPDATE">
	</div>

</form>

<script>
	$(document).ready(function() {
		$('.edit_commentz').click(function(e) {
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: "../updatecom.php",
				data: $("form").serialize(),
				success: function(data) {

					$('.result').html(data);
					window.location.reload()
					window.scrollTo({
						top: 0,
						left: 100,
						behavior: 'smooth'
					});

				}
			});
		});
	});

</script>
<script>
	$('.cust').change(function() {

		if (($(this).val() == 'In Progress')) {
			$('.showup').show();

		} else {
			$('.showup').hide();

		}
	});

	$('.customselect').change(function() {

		if (($(this).val() == 'Gave a Date')) {
			$('.showcontent').show();

		} else {
			$('.showcontent').hide();

		}
	});

</script>

</html>
