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
    include "../connection.php";
$event_id=$_GET['id'];

 $sql=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
 if($sql){
     $number_of_rows= mysqli_num_rows($sql);
 }
     if($number_of_rows > 0){
         echo '<script>window.location="view_event?id='."$event_id".'";</script>';
     
 }
  ?>
<!--?php
  if(isset($_POST['generate']))
  { 
    $client = $_GET['client'];
      $invoice = $_POST['invoice'] ;

      $query = mysqli_query($con,"UPDATE tblleased SET invoice = '".$invoice."',random = '".$invoice."'  where client = '".$client."' and invoice IS NULL ");
      
      if($query == true){
          echo '<script type="text/javascript">'; 
            echo 'alert("Invoice generated successfully.");'; 
            echo 'window.location = "ilp.php";';
            echo '</script>';
      }
    if(mysqli_error($con)){
      echo '<script type="text/javascript">'; 
            echo 'alert("Error occured.");'; 
            echo 'window.location = "add-item.php";';
            echo '</script>';
    }
  }
?-->

<!DOCTYPE html>
<html>

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

	button .save {
		background-color: green;
	}

	.button {
		width: 40px;
	}

	.top-wrapper {
		/* background-color: black;
            padding: 0 5px 5px 5px;
            border-radius: 5px;*/
	}

	.sidebar-menu .active {
		background-color: #009999;
	}

	#myAdd {
		display: none;
	}

	.card {
		/* Add shadows to create the "card" effect */
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		transition: 0.3s;
	}

	/* On mouse-over, add a deeper shadow */
	.card:hover {
		box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
	}

	/* Add some padding inside the card container */
	.card-body {
		padding: 2px 16px;
	}

</style>
<script type="text/javascript">
	function myFunction() {
		var x = document.getElementById("myAdd");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}

</script>

<?php include('../head_css.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

<script>
	$(document).ready(function() {
		$('select').selectize({
			sortField: 'text'
		});
	});

</script>

<body class="skin-black">
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
			<section class="content-header">
				<a href="javascript:void(0)" title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left"></i> Back</a>&nbsp;&nbsp;&nbsp;
				<!--

				<a href="ani.php" title="Add Items "><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Add Item(s) </a>&nbsp;&nbsp;&nbsp;
-->

			</section>

			<!-- Main content -->
			<section class="content">
				<center>
					<div class="container">
						<!--Get name of event-->
						<?php
						$rf=mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event_id'");
						while($row = mysqli_fetch_array($rf)){
							$event_name =$row['event_name'];
							$customer_name =$row['customer_name'];
						}
						?>

						<div class="row">
							<?php
									$des=mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event_id'");
									while($mes =mysqli_fetch_array($des)){
										$event_namee =$mes['event_name'];
										$cusst_name =$mes['customer_name'];
									}
									?>

							<center>
								<h3 style="font-family:fangsong;"><strong><u><span class="text-info">Event Name: </span><?php echo $event_namee; ?>
										</u></strong> </h3>
								<h3 style="font-family:fangsong;" class="mt-4"><strong><span class="text-info">Customer Name: </span><?php echo $cusst_name; ?>
									</strong> </h3>
							</center>

							<u>
								<center>
									<h3 class="text-left mb-5 text-primary" style="font-family:fangsong;  padding: 2px 16px;"><strong>What type of Quotation do you want to create?</strong></h3>
								</center>
							</u>
							<div class="col-lg-4">
								<div class="card" style="height:18rem!important;">

									<div class="card-body">
										<h3 class="mt-4 mb-4" style="font-family:fangsong!important;"><strong>Inventory Items Quotation</strong></h3>
										<p class="card-text">Quotation based on items from the inventory (+ Additional costs if need be)</p>
										<a class="mt-5 mb-5 bn btn-primary btn-sm" href="add-quotation?id=<?php echo $event_id; ?>">Next <i class="fas fa-arrow-right"></i></a>
									</div>
								</div>

							</div>
							<div class="col-lg-4">
								<div class="card" style="height:18rem!important;">

									<div class="card-body">
										<h3 class="mt-4 mb-4" style="font-family:fangsong!important;"><strong>Strictly Items from external vendors</strong></h3>
										<p class="card-text">Quotation based on items not in the inventory</p>
										<a class="mt-5 mb-5 bn btn-primary btn-sm" href="external?id=<?php echo $event_id; ?>">Next <i class="fas fa-arrow-right"></i></a>
									</div>
								</div>

							</div>
						</div>

					</div>
				</center>
			</section>
		</aside>
	</div>
	<?php 
        include "../footer.php"; ?>

	<script>
		//back function
		function goBack() {
			window.history.back();
		}

	</script>
</body>

</html>
