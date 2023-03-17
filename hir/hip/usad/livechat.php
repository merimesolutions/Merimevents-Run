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
include "../connection.php";
    $companyz = $_SESSION['company'];
//Get this user's ID
$user_id=$_SESSION['userid'];

    
    if(isset($_POST['okayadmin'])){
        $faqmessage=mysqli_real_escape_string($con,$_POST['faqmessage']);
        $todate=date('Y-m-d h:i:sa');
        $msg='';
        $user = $_SESSION['userid']; 
        $username = $_SESSION['username'];
        $company = $_SESSION['company'];
    
        $result = mysqli_query($con,"INSERT INTO faqall (user,message,ask_date,username,company) VALUES ('$user','$faqmessage','$todate','$username','$company')");
       if($result==true){
                  
    $_SESSION['sent'] = 1;
          echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
}

     else{
             echo '<script type="text/javascript">'; 
    echo 'alert("Error during submission");'; 
    echo '</script>';
       }
    
        }
 if(isset($_POST['send_file'])){
 $uploaded_file =$_FILES['myfile']['name'];
//Might be a directory issue??
   //GET THE CV FIRST
    $file=basename($_FILES["myfile"]["name"]);
     $tmp_name = $_FILES["myfile"]["name"];
    $file_path = '../documents/'.$file;
    $date = date("l jS \of F Y h:i:s A");
    $user = $_SESSION['userid'];
     $z=move_uploaded_file($_FILES["myfile"]["tmp_name"],$file_path);
	 // $z=copy($_FILES['myfile']['tmp_name'],"../documents/".$_FILES['myfile']['name']); 
	 if($z== true){
		 $sql=mysqli_query($con,"INSERT INTO tbltasksdocuments(user_id,doc_name, size,company,`date`) VALUES ($user','$uploaded_file', '0','$companyz','$date' )");
		 $r ="INSERT INTO tbltasksdocuments(doc_name, size,company,'date') VALUES ('$user',$uploaded_file', '0','$companyz','$date' )";
		
		 if($sql==true){
		 	 echo'<script>alert("Attachment Succesfully Uploaded!!");</script>';
		 }else{
		 	 echo'<script>alert("An Error occured during Upload!! ");</script>';
		 }
	 }else{
		 echo'<script>alert("An Error occured during Upload!! ");</script>';
	 }
}
?>
<!DOCTYPE html>
<html>
<script>
function updateId(id)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
           // alert(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET", "updatesms-single.php?id=" +id, true);
    xmlhttp.send();
}
</script>
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

	.sidebar-menu .livechat {
		background-color: #009999;
	}

</style>
<style>
	.container.gallery-container {
		background-color: #fff;
		color: #35373a;
		min-height: 100vh;
		border-radius: 20px;
		box-shadow: 0 8px 15px rgba(0, 0, 0, 0.06);
	}

	.gallery-container h1 {
		text-align: center;
		margin-top: 70px;
		font-family: 'Droid Sans', sans-serif;
		font-weight: bold;
	}

	.gallery-container p.page-description {
		text-align: center;
		max-width: 800px;
		margin: 25px auto;
		color: #888;
		font-size: 18px;
	}

	.tz-gallery {
		padding: 40px;
	}

	.tz-gallery .lightbox img {
		width: 100%;
		margin-bottom: 30px;
		transition: 0.2s ease-in-out;
		box-shadow: 0 2px 3px rgba(0, 0, 0, 0.2);
	}


	.tz-gallery .lightbox img:hover {
		transform: scale(1.05);
		box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
	}

	.tz-gallery img {
		border-radius: 4px;
	}

	.baguetteBox-button {
		background-color: transparent !important;
	}


	@media(max-width: 768px) {
		body {
			padding: 0;
		}

		.container.gallery-container {
			border-radius: 0;
		}
	}

	.sub-banner {
		background-image: url('images/listing_images/<?php echo $picha; ?>') !important;
		height: 70vh !important;
	}

	.msger {
		display: flex;
		flex-flow: column wrap;
		justify-content: space-between;
		width: 100%;
		/*max-width: 800px;*/
		margin: 25px 10px;
		height: calc(100% - 50px);
		border: var(--border);
		border-radius: 5px;
		background: var(--msger-bg);
		box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);



	}

	.msger-header {
		display: flex;
		justify-content: space-between;
		padding: 10px;
		border-bottom: var(--border);
		background: #eee;
		color: #666;
		width: 100%;
	}

	.msger-chat {
		flex: 1;
		overflow-y: auto;
		padding: 10px;



	}

	.msger-chat::-webkit-scrollbar {
		width: 6px;
	}

	.msger-chat::-webkit-scrollbar-track {
		background: #ddd;
	}

	.msger-chat::-webkit-scrollbar-thumb {
		background: #bdbdbd;
	}

	.msg {
		display: flex;
		align-items: flex-end;
		margin-bottom: 10px;
	}

	.msg:last-of-type {
		margin: 0;
	}

	.msg-img {
		width: 50px;
		height: 50px;
		margin-right: 10px;
		background: #ddd;
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
		border-radius: 50%;
	}

	.msg-bubble {
		max-width: 450px;
		padding: 15px;
		border-radius: 15px;
		background: var(--left-msg-bg);
	}

	.msg-info {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 10px;
	}

	.msg-info-name {
		margin-right: 10px;
		font-weight: bold;
	}

	.msg-info-time {
		font-size: 0.85em;
	}

	.left-msg .msg-bubble {
		border-bottom-left-radius: 0;
	}

	.right-msg {
		flex-direction: row-reverse;
	}

	.right-msg .msg-bubble {
		background: var(--right-msg-bg);
		color: #fff;
		border-bottom-right-radius: 0;
	}

	.right-msg .msg-img {
		margin: 0 0 0 10px;
	}

	.msger-inputarea {
		display: flex;
		padding: 10px;
		border-top: var(--border);
		background: #eee;
		width: 100%;
	}

	.msger-inputarea * {
		padding: 10px;
		border: none;
		border-radius: 3px;
		font-size: 1em;
	}

	.msger-input {
		flex: 1;
		background: #ddd;
	}

	.msger-send-btn {
		margin-left: 10px;
		background: rgb(0, 196, 65);
		color: #fff;
		font-weight: bold;
		cursor: pointer;
		transition: background 0.23s;
	}

	.msger-send-btn:hover {
		background: rgb(0, 180, 50);
	}

	.msger-chat.vs {
		background-color: #fcfcfe;
		background-image: url(https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png);
		width: 100%;
	}
  .msger-chat {
		background-color: #e6ffe6;
		/*background-image: url(https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png);*/
		width: 100%;
	}

	.btn-get-started {
		transition: 0.5s;
		line-height: 1;
		margin: 10px;
		color: #fff;
	}

	#comments {
		overflow: hidden
	}

</style>

<body class="skin-black">
	<!-- header logo: style can be found in header.less -->
	<?php 
        include "../connection.php";
        ?>
	<?php include('../header.php'); ?>

	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<?php include('../sidebar-left.php'); ?>

		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">

			<!-- Content Header (Page header) -->
			<section class="content-header">
				<a href="javascript:void(0)" title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left"></i> Back</a>&nbsp;&nbsp;&nbsp;

			</section>

			<!-- Main content -->
			<section class="content">

				<div class="row">

					<div class="box-body table-responsive">

						<div class="contact-3" id="chat">

							<div class="container overflow-auto col-lg-8 col-md-8 col-sm-8" style="height: 550px;">
								<section class="msger">
									<header class="msger-header">
										<div class="">
											<i class="fas fa-users fa-2x " style="color:#ffad33;font-size: 13px;"></i>&nbsp;&nbsp; CHAT ROOM
										</div>
									</header>

									<div id="chatscreen" class="msger-chat vs">
										<?php
	$squei = mysqli_query($con, "select * from tblusers where company='".$_SESSION['company']."' and password IS NULL  ");
        $roi = mysqli_fetch_assoc($squei);
				$identity =$roi['id'];
				$name =$roi['full_name']; 

  include "../connection.php";
  $sql090=mysqli_query($con,"SELECT * FROM faqall WHERE company = '".$_SESSION['company']."' ");
    while($ros =mysqli_fetch_assoc($sql090)){
      
      $message=$ros['message'];
      $askdate=$ros['ask_date'];
      $faqid=$ros['user'];
      $user_name=$ros['username'];
      $usersession = $_SESSION['userid'];
      if($faqid==$usersession){
        echo '
    <div class="msg right-msg">
        <!--div
       class="msg-img"
       style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
      ></div-->

      <div class="msg-bubble" style="background-color:#ddff99;">

        <div class="msg-text" style="color: black !important;">
          '.$message.' <br><small style="color:grey;font-size:9px;">'.$askdate.'</small>
        </div>
      </div>
    </div>';
}else{
  echo '
  <div class="msg left-msg" style="">
        <!--div
       class="msg-img"
       style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
      ></div-->

      <div class="msg-bubble" style="background-color:#fff;">
        <div class="msg-info">
          <div class="msg-info-name" style="color: #009933 !important;">'.ucwords($user_name).'</div>
          <!--div class="msg-info-time">10:00am</div-->
        </div>

        <div class="msg-text" style="color: black !important;">
          '.$message.' <br><small style="color:grey;font-size:9px;">'.$askdate.'</small>
        </div>
      </div>
    </div>';
}
}
    ?>

									</div>

									<form class="msger-inputarea" method="POST">

										<div class="form-row">

											<!--  <input type="text" class="" name="faqmessage" placeholder="Type a message" autocomplete="off" required> -->
											<textarea id="comments" cols="90" class="form-group col-lg-10 col-md-10 col-sm-10" name="faqmessage" required placeholder="Type a message" rows="1" style="width:100%;"></textarea>
											<i class="fas fa-paperclip fa-2x text-gray" data-toggle="modal" data-target="#exampleModal"></i>

											<button type="submit" class="btn btn-success form-group" name="okayadmin">Send</button>
										</div>
									</form>
								</section>
							</div>
							<div class="col-lg-4 col-sm-12 col-md-4" style="height:550px!important; overflow: auto!important;">
								<section class="msger">
									<header class="msger-header">
										<div class="">
											CHATS
										</div>
									</header>
									<div id="chatscreen" class="msger-chat">

										<div class="form-row">
											<?php
									$squery = mysqli_query($con, "select * from tblusers where company='".$_SESSION['company']."' AND id!='$identity' ORDER BY full_name ");
                                            while($row = mysqli_fetch_array($squery))
                                            {
												$rec_id =$row['id'];
												?>
											<div class="mt-2 form-group"><i class="fas fa-user fa-2x " style="color:#00ff55;font-size: 15px"></i>&nbsp;&nbsp;<span style="font-size: 13px"><a onclick="readChat(<?php echo $rec_id; ?> )" href="single_chat.php?id=<?php echo $rec_id; ?>"><?php echo $row['full_name']; ?></a></span> 
	<?php
						$q = mysqli_query($con,"SELECT * FROM singlefaq where rec_id ='$identity' and sender_id='$rec_id' and reply IS NULL");
                $num_rows = mysqli_num_rows($q);
                if($num_rows>0){
               echo $new_sms = 
                '<span class="badge" style="float:right;background-color:#00802b;"><a style="color:#fff !important;" href="single_chat.php?id='.$rec_id.'" onClick="readChat('.$row['id'].')">'.$num_rows.'</a></span>';
              }else{
               echo $new_sms = '';
              }  
											?>
											</div>

											<?php } ?>
										</div>


									</div>


								</section>
							</div>
							<!-- Modal -->
							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form method="POST" action="" enctype="multipart/form-data">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Select File To Upload</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">

												<div class="row">
													<div class="form_cont col-lg-12">

														<div class="input-group">

															<span class="input-group-addon" id="basic-addon1"><i class="fa fa-file-pdf-o"></i></span>

															<input type="file" class="form-control" placeholder="Upload file" name="myfile" aria-describedby="basic-addon1">
														</div>

													</div>

												</div>

											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" name="send_file" class="btn btn-primary">Upload</button>
											</div>
										</form>
									</div>
								</div>
							</div>


						</div>




						<?php include "../notification.php"; ?>

						<?php include "../addModal.php"; ?>
						<?php include "deletefunction.php";?>
						<?php include "../addfunction.php"; ?>
						<?php include "editfunction.php"; ?>

					</div>
				</div>
			</section><!-- /.content -->
			<!-- </form> -->
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
	<!-- jQuery 2.0.2 -->
	<?php 
        include "../footer.php"; ?>
	<script type="text/javascript">
		// Expanding text box
		var element = document.getElementById('comments');
		var retractsAutomatically = false;

		var sizeOfOne = element.clientHeight;
		element.rows = 2;
		var sizeOfExtra = element.clientHeight - sizeOfOne;
		element.rows = 1;

		var resize = function() {
			var length = element.scrollHeight;

			if (retractsAutomatically) {
				if (element.clientHeight == length)
					return;
			} else {
				element.rows = 1;
				length = element.scrollHeight;
			}

			element.rows = 1 + (length - sizeOfOne) / sizeOfExtra;
		};

		//modern
		if (element.addEventListener)
			element.addEventListener('input', resize, false);
		//IE8
		else {
			element.attachEvent('onpropertychange', resize)
			retractsAutomaticaly = true;
		}
		// ..................
		function goBack() {
			window.history.back();
		}
		$(function() {
			$("#table").dataTable({
				"aoColumnDefs": [{
					"bSortable": false,
					"aTargets": [0, 5]
				}],
				"aaSorting": []
			});
		});

	</script>
	<script type="text/javascript">
		var chatscreen = document.getElementById("chatscreen");
		chatscreen.scrollTop = chatscreen.scrollHeight;


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
</body>

</html>
