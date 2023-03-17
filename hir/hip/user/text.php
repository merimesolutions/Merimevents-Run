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
if(isset($_POST['send_sms'])){
	  $dgts = $_POST['phone_no'];
	  $to = $dgts.'@sms.alltelwireless.com';
	  $message = $_POST['message'];
	  $from ="contactus@merimesolutions.com";
	  $headers= "From: $from\n";
	if(mail($to,'', $message, $headers)){
		echo "message sent!";
	}
}
if(isset($_POST['send_email'])){
	        $to = $_POST['email'];
	        $message = $_POST['message'];
	        $subject =$_POST['subject'];
	        $to = "$to";
	        $message = "$message";
	        $subject = "$subject";
	        $from = "help@merimevents-run.com";
	        $headers= "From: $from\n";
			if(mail($to,$subject, $message, $headers)){
				$_SESSION['sent'] =1;
			}else{
		      $_SESSION['fail']=1;
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

	.sidebar-menu .cl {
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
form{
  
 width: 90%;
 height: auto;
 /*background:red;*/
 padding: 20px;
 /*position: absolute;*/
 overflow: hidden; 
  /*adding overflow hidden*/
}
form:before{
 content: ‘’;
 width: 300px;
 height: 400px;
 background: inherit; 
 position: absolute;
 left: -25px;  /*giving minus -25px left position*/
 right: 0;
 top: -25px;   /*giving minus -25px top position */
 bottom: 0;
 box-shadow: inset 0 0 0 200px rgba(255,255,255,0.3);
 filter: blur(10px);
}
.main .input-group-append {
  display: flex;
}
 
  .main .btn {
    position: relative;
    z-index: 2;
  } 

</style>
  <script src="https://www.w3schools.com/lib/w3.js"></script>
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
			<section class="content-header" style="border-style:;border:1px solid #dedede;">
				<a href="javascript:void(0)" title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go Back"></i> Back</a>&nbsp;&nbsp;&nbsp;

				<a href="c" title="Add new customers"><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Add new customers</a>&nbsp;&nbsp;&nbsp;

		 


			</section>
			<!-- Main content -->
			<section class="content">
				<?php 
	$customer_id = $_GET['id'];
    $get_customer=mysqli_query($con, "Select * FROM tblcustomers WHERE company='".$_SESSION['company']."' AND id='$customer_id' ");
    $data = mysqli_fetch_assoc($get_customer);
				 ?>
			 
				<div class="row">
					<div class="box">
						<!-- left column -->
						<div class="box-body table-responsive">
							 		<!-- chat tab -->

				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#home">Email</a></li>
					<li><a data-toggle="tab" href="#menu1">Send Message</a></li>

				</ul>
				<div class="tab-content">
					<div id="home" class="tab-pane fade in active" style="border-bottom: 1px solid #ddd;border-left: 1px solid #ddd;border-right: 1px solid #ddd;padding:12px;">
						<div class="container-fluid  bg-success">
							<div class="row">
								<div class="col-lg-4">
									    <!-- Modal content-->
						    <div class="main modal-content" style="margin-top: 20px;">
						       
						      <div class="modal-body">
						      	<div class="input-group">
							  <input type="text" class="form-control" oninput="w3.filterHTML('.checkbox','.chk', this.value)" id="livesearch" placeholder="Search for names.." aria-label="" aria-describedby="basic-addon1">
							  <div class="input-group-append">
							    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#emailModal"><i class="fas fa-search"></i></button>
							  </div>
							</div>
						      	<!-- <h4>Select Contacts</h4> -->
						      	<?php
						      	$customers =mysqli_query($con, "Select * FROM tblcustomers WHERE company='".$_SESSION['company']."'");
						      	echo '<div class="checkbox">
						      	     <label>
												 <input type="checkbox" value="" name="selectall"  id="selectAllMail" >  Select All</label>
										</div>';
						      	while($users = mysqli_fetch_assoc($customers)){
						      		$name = ucwords($users["fname"])." ".ucwords($users["lname"]);
						      		$customer_email = $users['email'];
                      $emaild[]= $users['email'];
						      		echo '<table class="checkbox">
												  <tr ><td class="chk">
												  <div >
						      	     <label>
						      		<input type="checkbox" name="mailcustomer"  id="'.$customer_email.'" value="'.$customer_email.'" class="selectMail" > '.$name.'
						      		</label>
										  </div>
						      		</td></tr>
												</table>';
						      	}
						      	 $all_emails = implode(',', $emaild);
						         ?>

						      </div>

						   
						    </div>
								</div>
							<div class="col-lg-8">
						<form class="main form-group p-4 bg-light" action="text.php" method="POST" >
							<div class="form-group  ">
							  <input type="text" class="form-control" name="email" id="customerMail" placeholder="Email Addess" aria-label="" aria-describedby="basic-addon1">
							   
							</div>
							<!-- <div class="form-group">
				      <label for="email">To:</label>
				      <input type="email" class="form-control" name="email" value="<?php // echo $data['email'];?>" placeholder="Email Address" aria-label="Email Address" multiple>
				    </div> -->
						 <div class="form-group">
				      <label for="colFormLabel" class="">Subject</label>
				      <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
				    </div>
				    <div class="form-group">
				      <label for="colFormLabel" class="">Message</label>
				     <textarea class="form-control" placeholder="Write a message" name="message" id="floatingTextarea2" style="height: 200px"></textarea>
				    </div>
				<br>
						<div class="form-group">
							  
						    <button type="submit" class="btn btn-primary" name="send_email"    >Send Now</button>
						 
						</div>
						 <div id="state"></div>
							</form>
						</div>
						</div>

					</div> 
					</div>
					 
					<div id="menu1" class="tab-pane fade" style="border-bottom: 1px solid #ddd;border-left: 1px solid #ddd;border-right: 1px solid #ddd;padding:12px;">
						<div class="container-fluid bg-info"   >
							<div class="row"> <!-- start  the row -->
							 <div class="col-lg-4">
									    <!-- Modal content-->
						    <div class="main modal-content" style="margin-top: 20px;">
						       
						      <div class="modal-body">
						      	<div class="input-group">
							  <input type="text" class="form-control" oninput="w3.filterHTML('.checkbox','.chk', this.value)" id="livesearch" placeholder="Search for names.." aria-label="" aria-describedby="basic-addon1">
							  <div class="input-group-append">
							    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#emailModal"><i class="fas fa-search"></i></button>
							  </div>
							</div>
						      	<!-- <h4>Select Contacts</h4> -->
						      	<?php
						      	$customers =mysqli_query($con, "Select * FROM tblcustomers WHERE company='".$_SESSION['company']."'");
						      	echo '<div class="checkbox">
						      	     <label>
												 <input type="checkbox" value="" name="selectall"  id="selectAllContacts" >  Select All</label>
										</div>';
						      	while($users = mysqli_fetch_assoc($customers)){
						      		$name = ucwords($users["fname"])." ".ucwords($users["lname"]);
						      		$customer_number = $users['fcontact'];
                      $contacts[]= $users['fcontact'];
						      		echo '<table class="checkbox">
												  <tr ><td class="chk">
												  <div >
						      	     <label>
						      		<input type="checkbox" name="mailcustomer"  id="'.$customer_number.'" value="'.$customer_number.'" class="selectcontacts" > '.$name.'
						      		</label>
										  </div>
						      		</td></tr>
												</table>';
						      	}
						      	 $all_contacts = implode(',', $contacts);
						         ?>
						      </div>
						    </div>
								</div>
								<!-- end first column -->
								<div class="col-lg-8">
						      <div class=message-form><!-- start message div -->
						      	<form method="post" action="text.php">
								  <div class="form-group">
								    <label for="exampleFormControlInput1">Phone Number</label>
								    <input type="text" class="form-control" id="customerNo" name="phone_no" placeholder="0734---------">
								  </div>
								 
								  <div class="form-group">
								    <label for="exampleFormControlTextarea1">SMS</label>
								    <textarea   id="exampleFormControlTextarea1" name="message" rows="3" class="form-control Write Message "></textarea>
								  </div>
								  <div class="form-group">
								     <input type="submit" name="send_sms" value="Send" class="btn btn-success">
								  </div>
								</form>
						      </div> <!--end message div-->
						    </div> <!--  end column -->
               </div> <!-- end row -->
						 </div>
					</div>

				</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->


					<?php include "../notification.php"; ?>

					<?php include "../addModal.php"; ?>

					<!--?php include " ../addfunction.php"; ?-->
					<?php include "editfunction.php"; ?>
					<?php include "deletefunction.php"; ?>


				</div> <!-- /.row -->
			</section><!-- /.content -->
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
	<!-- jQuery 2.0.2 -->
	<?php include "../footer.php"; ?>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function(){
      $("#selectAllMail").change(function(){
         var checked = $(this).is(":checked");//get checkbox state
         if(this.checked) //if true then checke all customers
         	 $(".selectMail").prop('checked',true);
         else
         	 $(".selectMail").prop('checked',false);//or uncheck all checkboxes
         if(this.checked){
         	var emails ="<?php echo $all_emails; ?>";
         	document.getElementById('customerMail').value =emails;
         }else{
         	document.getElementById('customerMail').value ='';
         }
      });
    var selected = [];
       $(".selectMail").change(function(){
           if($(this).is(":checked")) {
            	var email = $(this).val();
            	selected.push(email);
              document.getElementById('customerMail').value =selected;  
           }else{
           	selected = selected.filter(e=> e !== this.value);
        	    document.getElementById('customerMail').value =selected.join(','); 
        }
      });
       //  start contacts' selection function  &&&&&  ****************************************
       // ------------------------------------------------------------------------------------
       $("#selectAllContacts").change(function(){
         var checked = $(this).is(":checked");//get checkbox state
         if(this.checked) //if true then checked all customers
         	 $(".selectcontacts").prop('checked',true);
         else
         	 $(".selectcontacts").prop('checked',false);//or uncheck all checkboxes
         if(this.checked){
         	var contacts ="<?php echo $all_contacts; ?>";
         	document.getElementById('customerNo').value = contacts;
         }else{
         	document.getElementById('customerNo').value ='';
         }
      });
       // --------------------------------------------Start single contact selection--------
    var selected = [];
       $(".selectcontacts").change(function(){
           if($(this).is(":checked")) {
            	var contact = $(this).val();
            	selected.push(contact);
              document.getElementById('customerNo').value =selected;  
           }else{
           	selected = selected.filter(e=> e !== this.value);
        	    document.getElementById('customerNo').value =selected.join(','); 
        }
      });
       // end select one by one---------------------------------------------------------------
      });
		 
	</script>
	<script type="text/javascript">
		function goBack() {
			window.history.back();
		}
		$(function() {
			$("#table").dataTable({
				"aoColumnDefs": [{
					"bSortable": false,
					"aTargets": [0, 2]
				}],
				"aaSorting": []
			});
		});

	</script>
		<script>
    function showMailedGuys(str){
      if (str == "") {
    document.getElementById("all_mails").value = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("all_mails").value = this.responseText;
     
      }
    };
    xmlhttp.open("GET","messanger.php?q="+str,true);
    xmlhttp.send();
  }
}
     
  </script>

</body>

</html>
