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
<!DOCTYPE html>
<html>
<script>
	function updateId(id) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				// alert(xmlhttp.responseText);
			}
		};
		xmlhttp.open("GET", "updatesms.php?id=" + id, true);
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

	.sidebar-menu .pl {
		background-color: #009999;
	}

	/*My loader comes here*/
	.lds-ellipsis {
		display: inline-block;
		position: relative;
		width: 80px;
		height: 80px;
	}

	.lds-ellipsis div {
		position: absolute;
		top: 33px;
		width: 13px;
		height: 13px;
		border-radius: 50%;
		background: #008000;
		animation-timing-function: cubic-bezier(0, 1, 1, 0);
	}

	.lds-ellipsis div:nth-child(1) {
		left: 8px;
		animation: lds-ellipsis1 0.6s infinite;
	}

	.lds-ellipsis div:nth-child(2) {
		left: 8px;
		animation: lds-ellipsis2 0.6s infinite;
	}

	.lds-ellipsis div:nth-child(3) {
		left: 32px;
		animation: lds-ellipsis2 0.6s infinite;
	}

	.lds-ellipsis div:nth-child(4) {
		left: 56px;
		animation: lds-ellipsis3 0.6s infinite;
	}

	@keyframes lds-ellipsis1 {
		0% {
			transform: scale(0);
		}

		100% {
			transform: scale(1);
		}
	}

	@keyframes lds-ellipsis3 {
		0% {
			transform: scale(1);
		}

		100% {
			transform: scale(0);
		}
	}

	@keyframes lds-ellipsis2 {
		0% {
			transform: translate(0, 0);
		}

		100% {
			transform: translate(24px, 0);
		}
	}

</style>

<body class="skin-black">
	<!-- header logo: style can be found in header.less -->
	<?php 
        include "../connection.php";
        ?>
	<?php include('../header.php'); ?>
	<?php include('getroles.php');?>

	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<?php include('../sidebar-left.php'); ?>

		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<a href="pl.php" title="Go back to projects"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</a>&nbsp;&nbsp;&nbsp;
				<?php if($my_add_mytask==1){?>
				<a href="tsa.php" target="_parent" class=""><i class="fa fa-tasks" aria-hidden="true"></i> Assign Tasks</a>&nbsp;&nbsp;&nbsp;
				<?php }  if($my_add_mytask==1){?>

				<a data-toggle="modal" data-target="#addtask"><i class="fa fa-plus" aria-hidden="true"></i> Add task</a>
				<?php } ?>
				<select class="form-select" aria-label="Default select example" style="position: absolute;right: 15px;" onchange="showCustomer(this.value)">
					<option selected disabled>Filter by urgency</option>
					<option value="0">All tasks</option>
					<option value="1">Urgent</option>
					<option value="2">Semi Urgent</option>
					<option value="3">Not Urgent</option>
				</select>
			</section>

			<!-- Main content -->
			<section id="result" class="content" style="width: 100%;height: 100%;">

				<div class="box">
					<div class="box-body table-responsive">
						<h5 style="padding:2px;"><strong style="color:#000;">EVENT :</strong> <?php
                        $qqq  = "SELECT distinct task_name FROM tbltasks where event_id = '".$_GET['proj']."' and employee_id ='".$_SESSION['userid']."' ";
                                            $res = mysqli_query($con, $qqq);
                                                while ($rows = mysqli_fetch_array($res))
                                                  { 
                                                     
                        $q  = "SELECT * FROM tblongoing_tasks where task = '".$rows['task_name']."' ";
                                            $result = mysqli_query($con, $q);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                    echo ucwords($row['task']);
                                                  }
                                                  }
                                                  ?></h5>
						<form method="post">
							<div class="waiting">
								<table id="table" class="table table-striped table-hover">
									<thead>
										<tr>
											<th style="width: 20px !important;"><i class="fa fa-list"></i></th>
											<th>Task</th>

											<th>Start</th>
											<th>Deadline</th>
											<th>Completion</th>
											<th>Status</th>
											<?php if($my_view==1){?>
											<th style="width:40px">View</th>
											<?php }?>
										</tr>
									</thead>
									<div class="waiting">
										<tbody>
											<?php
                                            $c=1;
                                            $date=date("Y-m-d");
                                  //Some extenal selector

                    $query  = "SELECT * FROM tbltasks 
                                LEFT JOIN tblongoing_tasks
                                On tbltasks.task_name = tblongoing_tasks.task
                                where tbltasks.event_id = '".$_GET['proj']."' AND tbltasks.employee_id ='".$_SESSION['userid']."'
                                ORDER BY tblongoing_tasks.task_progress ";   

                        $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_array($result))
                                                  {   
                                            $urgency = $row['urgency'];
                                            $per = $row['task_progress'];
                                            $d = $row['end_date'];
                                            $task = $row['task_name'];
                                            if(($per>=99) && ($per<=100))
                                            {$status = '<p style="color: #008000">'. "Completed" .'</p>';
                                                
                                            }
                                            elseif(($per>=75) && ($per<=98))
                                            {
                                             $status = '<p style="color:#ff6600;">'. "Almost done" .'</p>';   
                                            }elseif(($per>=50) && ($per<=74))
                                            {
                                             $status = '<p style="color: black;">'. "Halfway done" .'</p>';   
                                            }elseif(($per>=1) && ($per<=49)){
                                              $status = '<p style="color: #ff6666">'. "In progress" .'</p>';   
                                            }else{
                                                $status = '<p style="color: red">'. "Not started" .'</p>';  
                                            }
                                            
                                              if($date > $row["deadline"]){
                                                  if($per!=100){
                                                   $g = '<p style="color:red">'.$row["deadline"].'</p>';
                                                  }else{
                                                     $g = '<p>'.$row["deadline"].'</p>';  
                                                  }
                                              }else{
                                                   $g = '<p>'.$row["deadline"].'</p>';
                                              }
                                              //My switch guy............................
                                               switch($urgency){
                                                    case 1:
                                                        if($per!=100){ 
                                                     $t ='<p style="color:#ff0000;">'.ucwords($row['task']).'</p>';
                                                        }else{
                                                 $t ='<p style="color:#000;">'.ucwords($row['task']).'</p>';  
                                                        }
                                                     break;
                                                     case 2:
                                                         if($per!=100){ 
                                                     $t ='<p style="color:#ff6600;">'.ucwords($row['task']).'</p>';
                                                         }else{
                                                 $t ='<p style="color:#000;">'.ucwords($row['task']).'</p>';  
                                                         }
                                                   break;
                                                    case 3:
                                                         if($per!=100){ 
                                                     $t ='<p style="color:#00cc66;">'.ucwords($row['task']).'</p>';
                                                         }
                                                   break;
                                                 default:
            
                                                    $t ='<p style="color:#000;">'.ucwords($row['task']).'</p>';
                                                   
                                                }
                                              //end switch
              $q = mysqli_query($con,"SELECT * FROM faq where task='".$row['id']."' and reply IS NULL and user !='".$_SESSION['userid']."' ");
                $num_rows = mysqli_num_rows($q);
                if($num_rows>0){
                $new_sms = 
                '<span class="badge" style="float:right;background-color:red;"><a style="color:#fff !important;" href="tsview.php?proj='.$_GET['proj'].'&task='.$row['id'].'" onClick="updateId('.$row['id'].')">'.$num_rows.' <i class="fas fa-bell"></i> </a></span>';
              }else{
                $new_sms = '';
              }

                                            echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.$t.'</td>
                                                <td>'.ucwords($row["date_assigned"]).'</td> 
                                                
                                                <td>'.$g.'</td>
                                                
                                                <td>'.ucwords($row["percentage"]).' % '.$new_sms.'</td>
                                                 
                                                <td>'.$status.'</td> ';
                                                if($my_view==1){
                                                echo '<td><center><a href="tsview.php?proj='.$_GET['proj'].'&task='.$row['id'].'"><img src="../../images/icons/eye.png" title="View this task" class="iconb"></a></center></td>';
                                                   }

                                               echo '</tr>
                                                ';
                                                
                                              //  include "editprogress.php";
                                                
                                            // }
                                                  }
                                            ?>
										</tbody>

								</table>
							</div>
							<!--?php include "../deleteModal.php"; ?-->

						</form>

						<?php include "../notification.php"; ?>

						<?php include "../addModal.php"; ?>

						<?php include "../addfunction.php"; ?>
						<?php include "editfunction.php"; ?>

					</div>
				</div>
			</section><!-- /.content -->
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
	<!-- jQuery 2.0.2 -->
	<?php 
        include "../footer.php"; ?>
	<script type="text/javascript">
		function showCustomer(str) {
			var proj = "<?php echo $_GET['proj'];?>";
			$.ajax({
				type: 'GET',
				url: 'get_tasks.php',
				data: 'q=' + str + "&proj=" + proj,
				beforeSend: function() {
					$('.waiting').html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>");
				},
				success: function(response) {
					$('.waiting').html(response);
				}
			});
		}

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
</body>

</html>
