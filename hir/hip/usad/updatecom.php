<?php
     include "connection.php";

	
      $cid=$_POST['comment_id'];
      $cdate=date('Y-m-d');
      $ccomment=$_POST['comment'];
      $cadditional=$_POST['add'];
      if(!empty($_POST['followup'])){
      $cfollowup=$_POST['followup'];
      if($cfollowup =='Gave a Date'){
      $cprefdate=$_POST['spec_date'];
      }
      }
    elseif(empty($_POST['followup'])){
      $fin=mysqli_query($con,"SELECT * FROM customer_comments WHERE id='$cid'"); 
      while($ref =mysqli_fetch_array($fin)){
      $cfollowup=$ref['customer_followup'];
      }
   
	if($cfollowup == 'Gave a Date'){
	 $cprefdate=$_POST['pref_date'];
	  }else{
        $cprefdate=NULL; 
      }
      }
     $cprogress=$_POST['progress'];
      $progress_per=$_POST['progress_percent'];
      $t=mysqli_query($con,"UPDATE customer_comments SET customer_comment='$ccomment', customer_followup='$cfollowup', customer_prefdate='$cprefdate', customer_updatedate='$cdate',customer_additional='$cadditional',customer_progress='$cprogress', progress_percent='$progress_per' WHERE id='$cid'");

      if($t){echo '<script>alert("Comment Updated!");</script>';


      }else{
      $error=mysqli_error($con);
      echo '<script>alert("Error: '."$error ".'");</script>';

      }




?>
