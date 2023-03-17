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
    include('../connection.php');

        if(isset($_POST['save'])){
            $txtTask   	= $_POST['txtTask'];
            $user 		= $_SESSION['userid'];
            $task 		= $_GET['t'];


                foreach($txtTask as $key => $value){
                    $save = "INSERT INTO subtasks(sub_task,user,task)VALUES('".$value."','".$user."','".$task."')";
                    $query = mysqli_query($con, $save);
                
                if($query == true){
                   echo '<script type="text/javascript">'; 
                    echo 'alert("Tasks added successfully.");'; 
                    echo 'window.location = "s-todo?t='.$task.'";';
                    echo '</script>';
                    }else{
                     echo '<script type="text/javascript">'; 
                    echo 'alert("Task already exist.");'; 
                    echo 'window.location = "subtasks";';
                    echo '</script>';   
                    }
                }
            }
     ?>
<!DOCTYPE html>
<html>
<style>
	.sidebar-menu .pl {
		background-color: #009999;
	}

</style>
<?php include('../head_css.php'); ?>

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
					<div class="box">

						<div class="box-body table-responsive">
							<p style="margin-bottom:10px;"><?php
                                            
                                        $query  = "SELECT * FROM 
                                                todo where id = '".$_GET['t']."'";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                    {
                                                        echo $row['task']; } ?>
                                                        </p>
							<div class="panel panel-default"><br>
								<form method="post" class="insert=form" id="insert_form" action="">
									<!--div class="panel-heading" >
                                    
                                </div-->
									<!-- /.box-header -->
									<div class="box-body table-responsive">

										<table class="table table-striped" id="table_field">
											<tr>
												<th>Sub tasks</th>
												<th></th>
											</tr>
											<tr>
												<td><input type="text" name="txtTask[]" class="form-control" required placeholder="Enter sub-task"></td>
												<td><input type="button" name="add" id="add" value="+" class="btn btn-info"></td>
											</tr>
										</table>
									</div>
									<center><button type="submit" class="btn btn-success btn-sm" name="save" id="save" title="Save"> Save</button>
										
									</center><br>
								</form>
							</div>
						</div>
					</div>


				</div> <!-- /.row -->
			</section><!-- /.content -->
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
	<!-- jQuery 2.0.2 -->
	<?php include "../footer.php"; ?>
	<script type="text/javascript">
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
		$(document).ready(function() {
			var html = '<tr><td><input type="text" name="txtTask[]" class="form-control" required placeholder="Add sub-task"><td><input type="button" name="remove" id="remove" value="x" class="btn btn-danger"></tr>';

			var x = 1;

			$("#add").click(function() {
				$("#table_field").append(html);
			});
			$("#table_field").on('click', '#remove', function() {
				$(this).closest('tr').remove();
			});

		});

	</script>
</body>

</html>
