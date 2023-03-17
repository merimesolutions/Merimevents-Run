<?php
     include "connection.php";

	
      $cid=$_POST['comment_id'];
      $cdate=date('Y-m-d');
      $ccomment=mysqli_real_escape_string($con,$_POST['comment']);
      $cadditional=$_POST['add'];
      $old=$_POST['old_followup'];
      $new=$_POST['new_followup'];
      $followup=$_POST['follow_person'];
      $demod=$_POST['demo_date'];
//    $cfollowup=$_POST['new_followup'];
     $cprefdate=$_POST['pref_date'];
$roday=date('Y-m-d');
//If new followup
if(!empty($_POST['new_followup'])){
	$cfollowup=$_POST['new_followup'];
}else{
	$cfollowup=$_POST['old_followup'];
}

 //Check if the old followup was a date and if it's equal to the value of the new followup
//if(!empty($new)){
// $cfollowup =$_POST['new_followup'];
// //Check if it's a date
// if(($cfollowup == $old)&& ($cfollowup == 'Gave a Date')){
// $cprefdate =$_POST['pref_date'];
// }elseif($cfollowup !== 'Gave a Date'){
// $cprefdate=NULL;
// }
//
//}elseif(empty($new)){
// $cfollowup=$_POST['old_followup'];
// if($cfollowup == 'Gave a Date'){
// $cprefdate=$_POST['pref_date'];
// }else{
// $cprefdate=NULL;
// }
//}
if(empty($_POST['progress_percent'])){
 $progress_per=$_POST['progress_percentz'];	
}else{
$progress_per=$_POST['progress_percent'];	
}
      $cprogress=$_POST['progress'];
     
      $t=mysqli_query($con,"UPDATE customer_comments SET customer_comment='$ccomment', customer_followup='$cfollowup', customer_prefdate='$cprefdate', customer_updatedate='$cdate',customer_additional='$cadditional',customer_progress='$cprogress', progress_percent='$progress_per',demo_date='$demod' WHERE id='$cid'");

      if($t){
		  //Check if the comment has been changed or not
		  
		  $ds=mysqli_query($con,"SELECT * FROM followup_comments WHERE comment='$ccomment' AND comment_id='$cid' AND followup_action='$cfollowup'");
		  if($ds){
			  $nooo=mysqli_num_rows($ds);
			  if($nooo < 1){
		  $ed=mysqli_query($con,"INSERT INTO followup_comments (comment,followup_action,date,additional_info,comment_id,followup_date) VALUES ('$ccomment','$cfollowup','$roday','$cadditional','$cid','$cdate')");
			  }}
		  if($progress_per ==100){
			  $y=mysqli_query($con,"UPDATE customer_comments SET customer_progress='Completed' WHERE id='$cid'");
		  }
		  
		  echo '<script>alert("Comment Updated!");</script>';


      }else{
      $error=mysqli_error($con);
      echo '<script>alert("Error: '."$error ".'");</script>';

      }




?>
