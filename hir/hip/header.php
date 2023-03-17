<?php
session_start();
sleep(1);
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

<style>
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
<?php
$compan = $_SESSION['company'];
$lol = $_SESSION['role'];
$this_spec = $_SESSION['userid'];
$thix_date = date('Y-m-d');

if ($lol == 'admin') {    
    $sem = mysqli_query($con, "SELECT * FROM customer_comments WHERE company='$compan' AND customer_progress!='Completed'");    
    if ($sem) {
        //Getting Deadine

        $expiration = date('Y-m-d', strtotime($thix_date . ' -1 days'));
        $expirationz = date('Y-m-d', strtotime($thix_date . '+3 days'));


        $sema = mysqli_query($con, "SELECT * FROM customer_comments WHERE company='$compan' AND customer_progress!='Completed' AND customer_prefdate >= '$expiration' AND customer_prefdate >='$expirationz' ");
        if ($sema) {
            $numb = mysqli_num_rows($sema);
        }    
    }
}elseif ($lol !== 'admin') {   
 $sem = mysqli_query($con, "SELECT * FROM customer_comments WHERE (company='$compan' AND customer_progress!='Completed' AND customer_person='$this_spec' )  || (company='$compan' AND customer_progress!='Completed' AND followup_userid='$this_spec')");   
  if ($sem) {

        //Getting Deadine
        $line = $op['customer_prefdate'];
        $expiration = date('Y-m-d', strtotime($thix_date . ' -1 days'));
        $expirationz = date('Y-m-d', strtotime($thix_date . '+3 days'));
        $sema = mysqli_query($con, "SELECT * FROM customer_comments WHERE (company='$compan' AND customer_progress!='Completed' AND customer_person='$this_spec' AND customer_prefdate >= '$expiration' AND customer_prefdate <= '$expirationz' )  || (company='$compan' AND customer_progress!='Completed' AND followup_userid='$this_spec' AND customer_prefdate >= '$expiration' AND customer_prefdate <= '$expirationz')");
        if ($sema) {
            $numb = mysqli_num_rows($sema);
        }


    }
}

// $ww = mysqli_query($con, "SELECT * FROM tblongoing_tasks where proj = ".$_GET['proj']." AND user LIKE  '%".$_SESSION['userid']."%' ORDER BY percentage ");
// while($tt = mysqli_fetch_array($ww)){

    $q = mysqli_query($con,"SELECT faq.full_name, tblongoing_tasks.proj FROM faq 
        LEFT JOIN tblongoing_tasks ON faq.task=tblongoing_tasks.id
     WHERE faq.reply IS NULL AND faq.user !='" . $_SESSION['userid']."' AND tblongoing_tasks.user LIKE '%".$_SESSION['userid']."% '  ");
   
    $num_rows = mysqli_num_rows($q);
    if($num_rows>0){
    // while($xu= mysqli_fetch_array($q)){
    //     if($xu == true){
            $nn_sms = '<span class="badge" style="float:right;background-color:red;"><a style="color:#fff !important;" href="tsview.php?tblongoing_tasks.proj='.$_GET['proj'].'&faq.task='.$row['id'].'" onClick="updateId('.$row['id'].')">'.$num_rows.' </a></span>';
            '<span class="badge" style="float:right;background-color:red;"><a style="color:#fff !important;" href="tsview.php?proj='.$_GET['tblongoing_tasks.proj'].'&task='.$row['id'].'" onClick="updateId('.$row['id'].')">'.$num_rows.' sms</a></span>';
              
            // 'New sms';
        // 
        }
        else{
            $nn_sms = '0';
        }
        
// }

echo '<header class="header">
             <a href="#" class="logo" style="background-color:#0a1219;color:; font-size:px;border:1px solid #dedede;font-family:sans-serif;">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
               ';

$company = mysqli_query($con, "SELECT * from tblstaff where id = '" . $_SESSION['userid'] . "' ");
while ($row = mysqli_fetch_array($company)) {
    $_SESSION['user'] = $row['username'];
    echo '<span>' . ucwords($row['companyname']) . '</span>';
}
$user = mysqli_query($con, "SELECT * from tblusers where id = '" . $_SESSION['userid'] . "' ");
while ($rows = mysqli_fetch_array($user)) {

    $companyname = mysqli_query($con, "SELECT * from tblstaff where company = '" . $rows['company'] . "' ");
    while ($r = mysqli_fetch_array($companyname)) {
        echo '<span>' . ucwords($r['companyname']) . '</span>';
    }
}
if ($_SESSION['merime'] == "merime") {
    echo "Merime Admin";

}

    
echo '
            
            </a> 
            
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <img src="../../images/icons/resize.png" title="Resize window">
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->

                        <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span style="background: linear-gradient(to right, #00ff99 0%, #009999 100%);color: #000;padding:3px;border-radius: 2px;" id = "clock" onload="currentTime()"></span>
                        </a>
                        </li>
                        
     <li class="dropdown reminder reminder-menu" style="margin-right:10px !important;">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-comment" style="font-size:18px;"></span>
       <span class="badge" style="position: absolute;
  top: ;
  right: -10px;
  padding: 2px 5px;
  border-radius: 50%;
  background: red;
  color: white;">'.$nn_sms.'';
 
echo '</span>
      </a>
        <div class="dropdown-content">';
$companyz = $_SESSION['company'];
$user_id = $_SESSION['userid'];

$squei = mysqli_query($con, "SELECT * FROM tblusers where company='" . $_SESSION['company'] . "' and password IS NULL  ");
$roi = mysqli_fetch_assoc($squei);
echo $identity = $roi['id'];
echo $name = $roi['full_name'];

if (($identity != $user_id) || ($identity == $user_id)) {

    $squery = mysqli_query($con, "SELECT * FROM tblusers where company='" . $_SESSION['company'] . "' AND id !='$identity' ORDER BY full_name ");
    while ($row = mysqli_fetch_array($squery)) {
        $rec_id = $row['id'];


        $q = mysqli_query($con, "SELECT * FROM singlefaq where rec_id ='$identity' and sender_id='$rec_id' and reply IS NULL");
        while ($roww = mysqli_fetch_array($q)) {
            $num_rows = mysqli_num_rows($q);
            if ($num_rows > 0) {
                echo $ne_sms =
                    '<a style="color:#000 !important; margin-bottom:0px !important" href="single_chat.php?id=' . $rec_id . '" onClick="readChat(' . $row['id'] . ')">New message from ' . ucwords($roww['username']) . '<br><span style="font-size:9px;"> ' . $roww['ask_date'] . '</span></a><hr>
                ';
            }
            else {
                echo $ne_sms = '';
            }
        }

    }
}




$squeii = mysqli_query($con, "SELECT * FROM tblusers WHERE company='" . $_SESSION['company'] . "' and id = '$user_id' ");
$roii = mysqli_fetch_assoc($squeii);
$identityy = $roii['id'];
$password = $roii['password'];

if (!empty($password)) {

    $qq = mysqli_query($con, "SELECT * FROM singlefaq WHERE rec_id ='$identityy' and sender_id='$rec_id' and reply IS NULL");
    while ($rowww = mysqli_fetch_array($qq)) {
        $num_rows = mysqli_num_rows($qq);
        if ($num_rows > 0) {
            echo $new_sms =
                '<a style="color:#000 !important; margin-bottom:0px !important" href="single_chat.php?id=' . $rec_id . '" onClick="readChat(' . $roii['id'] . ')">New message from ' . ucwords($rowww['username']) . '<br><span style="font-size:9px;"> ' . $rowww['ask_date'] . '</span></a><hr>
                ';
        }
        else {
            echo $new_sms = '';
        }
    }

}

'</div>
      <span class="badge"></span>
      </li>';
      
     $t="SELECT * FROM faq where reply IS NULL AND user !='" . $_SESSION['userid'] . "' ";
 {
    echo '
	<li class="dropdown reminder reminder-menu"  style="margin-right:10px !important;">
	        <a href="" data-toggle="modal" data-target="#notificationModal"><i class="fas fa-comments" style="font-size:18px; color:teal !important;"></i> <span class="badge " style="position: absolute;
  top: ;
  right: -10px;
  padding: 2px 5px;
  border-radius: 50%;
  background: green;
  color: white;">' . "$numb" . '</span></a>
	      </li>';
     
}
 
echo '
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user" style="color:teal;"></i>

                                Profile <i class="fa fa-sort-desc" aria-hidden="true"></i>';

echo '</a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    
                                    <p>
                                        ' . ucwords($_SESSION['username']) . '
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#editProfileModal">Edit Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../../logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>'; ?>
<!--==== View comment Modal  New--------->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" id="notificationModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="">

				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>


				<div class="pull-left image">
					<img src="../../images/icons/edit.png" class="img-circle" alt="User Image" style="width:35px" />
				</div>
				<h4 class="modal-title text-info text-center" style="font-family:fangsong!important;"><strong>Followup Reminders(Urgent)</strong></h4>
				<p class="text-center mt-3" style="font-family:fangsong; font-size:15px!important; color:red;"><u><em><strong>These followups deadlines have arrived!!</strong></em></u></p>

			</div>
			<div class="modal-body" style="overflow:auto; height:400px">




				<div class="box">
					<div class="box-body table-responsive">

						<table class="table  table-striped">
							<?php
if ($lol == 'admin') { ?>
							<center><a class="btn btn-info btn-sm mt-5 mb-5" style="font-family:fangsong!important;" href="https://merimevents-run.com/hir/hip/usad/followups.php">View All Comments</a></center>

							<?php
}
else { ?>
							<center><a class="btn btn-info btn-sm mt-5 mb-5" style="font-family:fangsong!important;" href="https://merimevents-run.com/hir/hip/user/followups.php">View All Comments</a></center>
							<?php
}?>
							<div class="box-body table-responsive">

								<thead>
									<tr>
										<th></th>
										<th>Customer</th>
										<th>Followup Action</th>
										<th>Progress</th>
										<th>Followup Task</th>


										<th>View</th>
									</tr>
								</thead>
								<?php if ($lol == 'admin') { ?>
								<tbody>
									<?php
    $t = 1;
    $redi = mysqli_query($con, "SELECT * FROM customer_comments WHERE company='$compan' AND customer_progress!='Completed' AND customer_prefdate >= '$expiration' AND customer_prefdate >='$expirationz' ");
    while ($low = mysqli_fetch_array($redi)) {
        $customer_idd = $low['customer_id'];
        $progrez = $low['customer_progress'];
        $perc = $low['progress_percent'];
        $persona = $low['followup_user'];        //										$this_assignee=$low['customer_person'];
        $grut = mysqli_query($con, "SELECT * FROM tblcustomers WHERE id='$customer_idd'");
        while ($ray = mysqli_fetch_array($grut)) {
            $fisname = $ray['fname'];
            $misname = $ray['mname'];
            $lisname = $ray['lname'];
        }
        //Get Progress
        //Get Progress

        if ($progrez == 'In Progress') {
            $thing = '<span style="font-family:fangsong!important;" class="text-warning"><strong>In Progress <span style="color: black!important;">' . "$perc" . ' %</span</strong></span>';
        }
        if ($progrez == 'Not Started') {
            $thing = '<span style="font-family:fangsong!important;" class="text-danger"><strong>Not Started</span></strong>';

        }
        //Checking if it's an assigned task or not
        if (($low['followup_userid'] == $this_spec) && ($low['customer_person'] !== $this_spec)) {
            $taskit = '<span class="text-success" style="font-family:fangsong; font-size:15px!important;"><strong>Assigned Followup</strong></span>';
        }
        if (($low['followup_userid'] !== $this_spec) && (!empty($low['followup_userid']))) {
            $taskit = '<span style="color:#FFA500; font-family:fangsong!important; font-size:15px!important;"><strong>' . "$persona" . '  Followup </strong></span>';
        }
        elseif (($low['customer_person'] == $this_spec) && ($low['followup_userid'] == $this_spec) || empty($low['followup_userid'])) {
            $taskit = '<span style="color:#FF7518; font-family:fangsong!important; font-size:15px!important;"><strong>My Followup </strong></span>';
        }




?>

									<tr>
										<td><?php echo $t++; ?></td>
										<td><?php echo $fisname; ?> <?php echo $misname; ?> <?php echo $lisname; ?> </td>
										<td><?php echo $low['customer_followup']; ?></td>
										<td><?php echo $thing; ?></td>
										<td><?php echo $taskit; ?></td>
										<td><a href="comments.php?id=<?php echo $customer_idd; ?>"><img src="https://merimevents-run.com/hir/images/icons/eye.png" class="iconb"></a></td>
									</tr <?php
    }?>>


								</tbody>
								<?php
}
else { ?>
								<tbody>
									<?php
    $t = 1;
    $redi = mysqli_query($con, "SELECT * FROM customer_comments WHERE (company='$compan' AND customer_progress!='Completed' AND customer_person='$this_spec' AND customer_prefdate >= '$expiration' AND customer_prefdate <= '$expirationz' )  || (company='$compan' AND customer_progress!='Completed' AND followup_userid='$this_spec' AND customer_prefdate >= '$expiration' AND customer_prefdate <= '$expirationz')");
    while ($low = mysqli_fetch_array($redi)) {
        $customer_idd = $low['customer_id'];
        $progrez = $low['customer_progress'];
        $perc = $low['progress_percent'];
        $persona = $low['followup_user'];
        $grut = mysqli_query($con, "SELECT * FROM tblcustomers WHERE id='$customer_idd'");
        while ($ray = mysqli_fetch_array($grut)) {
            $fisname = $ray['fname'];
            $misname = $ray['mname'];
            $lisname = $ray['lname'];
        }
        //Get Progress
        //Get Progress

        if ($progrez == 'In Progress') {
            $thing = '<span style="font-family:fangsong!important;" class="text-warning"><strong>In Progress <span style="color: black!important;">' . "$perc" . ' %</span</strong></span>';
        }
        if ($progrez == 'Not Started') {
            $thing = '<span style="font-family:fangsong!important;" class="text-danger"><strong>Not Started</span></strong>';
        }
        //Checking if it's an assigned task or not
        if (($low['followup_userid'] == $this_spec) && ($low['customer_person'] !== $this_spec)) {
            $taskit = '<span class="text-success" style="font-family:fangsong; font-size:15px!important;"><strong>Assigned Followup</strong></span>';
        }
        if (($low['followup_userid'] !== $this_spec) && ($low['customer_person'] == $this_spec) && (!empty($low['followup_userid']))) {
            $taskit = '<span style="color:#FFA500; font-family:fangsong!important; font-size:15px!important;"><strong>' . "$persona" . '  Followup </strong></span>';
        }
        elseif (($low['customer_person'] == $this_spec) && ($low['followup_userid'] == $this_spec) || empty($low['followup_userid'])) {
            $taskit = '<span style="color:#FF7518; font-family:fangsong!important; font-size:15px!important;"><strong>My Followup </strong></span>';
        }




        //----------------------//


?>

									<tr>
										<td><?php echo $t++; ?></td>
										<td><?php echo $fisname; ?> <?php echo $misname; ?> <?php echo $lisname; ?> </td>
										<td><?php echo $low['customer_followup']; ?></td>
										<td><?php echo $thing; ?></td>
										<td><?php echo $taskit; ?></td>
										<td><a href="comments.php?id=<?php echo $customer_idd; ?>"><img src="https://merimevents-run.com/hir/images/icons/eye.png" class="iconb"></a></td>
									</tr <?php
    }?>>


								</tbody>



								<?php
}?>
							</div>
						</table>
					</div>
				</div>



				<!------------------------->
			</div>


		</div>
	</div>
</div>
<!--End of Modal-->


<div id="editProfileModal" class="modal fade">
	<form method="post">
		<div class="modal-dialog modal-sm" style="width:300px !important;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit Profile</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<?php
if ($_SESSION['role'] == "admin") {
    $user = mysqli_query($con, "SELECT * from tblstaff where id = '" . $_SESSION['userid'] . "' ");
    while ($row = mysqli_fetch_array($user)) {
        echo '
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input name="txt_username" id="txt_username" class="form-control input-sm" type="text" value="' . $row['username'] . '" />
                                    </div>
                                    <div class="form-group">
                                        <label>Change password:</label>
                                        <input name="txt_password" id="txt_password" class="form-control input-sm" type="password"  value="' . $row['password'] . '"/>
                                    </div>';
    }
}
elseif ($_SESSION['role'] == "new") {
    $user = mysqli_query($con, "SELECT * from tblstaff where id = '" . $_SESSION['userid'] . "' ");
    while ($row = mysqli_fetch_array($user)) {
        echo '
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input name="txt_username" id="txt_username" class="form-control input-sm" type="text" value="' . $row['username'] . '" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input name="txt_password" id="txt_password" class="form-control input-sm" type="password"  value="' . $row['password'] . '"/>
                                    </div>';
    }
}
else {
    $user = mysqli_query($con, "SELECT * from tblusers where id = '" . $_SESSION['userid'] . "' ");
    while ($row = mysqli_fetch_array($user)) {
        echo '
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input name="txt_username" id="txt_username" class="form-control input-sm" type="text" value="' . $row['username'] . '" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input name="txt_password" id="txt_password" class="form-control input-sm" type="password"  value="' . $row['password'] . '"/>
                                    </div>';
    }
}
?>

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel" />
					<input type="submit" class="btn btn-primary btn-sm" id="btn_saveeditProfile" name="btn_saveeditProfile" value="Save" />
				</div>
			</div>
		</div>
	</form>
</div>


<?php
if (isset($_POST['btn_saveeditProfile'])) {
    $username = $_POST['txt_username'];
    $password = $_POST['txt_password'];



    if ($_SESSION['role'] == "admin") {
        $updadmin = mysqli_query($con, "UPDATE tblstaff set username = '$username', password = '$password' where id = '" . $_SESSION['userid'] . "' ");
        if ($updadmin == true) {
            $_SESSION['edit'] = 1;
        }
    }
    elseif ($_SESSION['role'] == "new") {
        $updfaculty = mysqli_query($con, "UPDATE tblstaff set username = '$username', password = '$password' where id = '" . $_SESSION['userid'] . "' ");
        if ($updfaculty == true) {
            $_SESSION['edit'] = 1;
        }
    }
    else {
        $upduser = mysqli_query($con, "UPDATE tblusers set username = '$username', password = '$password' where id = '" . $_SESSION['userid'] . "' ");
        if ($upduser == true) {
            $_SESSION['edit'] = 1;
        }
    }

}

?>
<div class="modal fade" id="myModal" role="dialog">

	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Scheduled Events</h4>
			</div>
			<div class="modal-body">

				<table class="table table-striped">
					<tr>
						<th>No.</th>
						<th>Date</th>
						<th>Time</th>

						<th>Event</th>
					</tr>
					<?php
include("../connection.php");
$date = date('Y-m-d');
$dt2 = date('Y-m-d', strtotime('+3 days'));
$n = 1;
$query = mysqli_query($con, "select * from tblreminder where user = '" . $_SESSION['userid'] . "' AND scheduled_date BETWEEN  '" . $date . "' AND '" . $dt2 . "' ");
while ($row = mysqli_fetch_array($query)) {

    echo '
           <tr>
           <td>' . $n . '</td>
           <td>' . $row['scheduled_date'] . '</td>
           <td>' . $row['scheduled_time'] . '</td>
           <td>' . $row['event'] . '</td>
           </tr>';
    $n++;




}
?>

				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>

<?php include "../notification.php"; ?>

	<script type="text/javascript">
   function readChat(id)
     {   
      var  id=id;
      if(id!='')
        {
         $.ajax({
         type:'POST',
         url:'read-chat.php',
         data:{id: id},
         success:function(msg){
          // setInterval('location.reload()',350);
         }
         });
         }  }	

	</script>
