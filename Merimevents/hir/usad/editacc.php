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
<!DOCTYPE html>
<html>
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
                <a href="accl.php" title="Go home"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go home"></i> Back</a>
                </section>
                <!-- Main content -->
                <section class="content">
                <div class="box-body table-responsive">
                    <span style="font-weight:bold;">Selected account for: </span>
                    <?php
                        $squery = mysqli_query($con, "select * from tblusers where id='".$_GET['id']."' ");
                             while($row = mysqli_fetch_array($squery))
                                 {
                                    echo ucwords($row['full_name']);
                                  }
                                ?>
                    
                                <form method="post">
<?php
	if(isset($_POST['updateprofile']))
	{
	    $txt_id     = $_GET['id'];
	    $username   = $_POST['username'];
	    $name  = $_POST['name'];
	    $password  = $_POST['password'];

	       $query = mysqli_query($con,"UPDATE tblusers SET username = '".$username."',full_name = '".$name."',password = '".$password."' where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "accl.php";';
            echo '</script>';
		}
	}
?>
<?php
	if(isset($_POST['crole']))
	{
	    $txt_id     = $_GET['id'];
	    $changerole     = $_POST['changerole'];


	 $q = mysqli_query($con,"UPDATE tblusers SET role = '".$changerole."' where id = '".$txt_id."' ");
	    

	    if($q == true){
	        echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
		}
	}
?>

                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Full name</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Password</th>
                                                <th>Updated Profile</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "select * from tblusers where id='".$_GET['id']."' and id='".$_GET['id']."' ORDER BY id DESC");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                
                                                $r=$row['role'];
                                           $sq = mysqli_query($con, "select * from tblroles where id='".$r."' ORDER BY id DESC");
                                            while($rows = mysqli_fetch_array($sq))
                                            {     
                                               $role =  $rows['role'];
                                            }
                                                
                                                echo '
                                                <tr>
                                                <td><input name="name" id="name" class="form-control input-sm" type="text" style="width:100%" value="'.ucwords($row['full_name']).'" /></td>
                                                <td><input name="username" id="username" class="form-control input-sm" type="text" style="width:100%" value="'.$row['username'].'" /></td>
                                                <td><input disabled name="role" id="role" class="form-control input-sm" type="text" style="width:100%" value="'.ucwords($role).'" /></td>
                                                <td><input name="password" id="password" class="form-control input-sm" type="password" style="width:100%"  value="'.ucwords($row['password']).'" /></td>
                                                <td><button class="btn btn-primary" type="submit" name="updateprofile" id="updateprofile" title="Save">Update</button></td>
                                                </tr>
                                                
                                                
                                                ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   <hr>
                                   <label>Change Role</label><br>
                                   <select name="changerole" id="changerole" type="text"  class="input-sm">
                                                <option value="" selected disabled>Select role</option>
                                                      <?php
                                                        $a = mysqli_query($con,"SELECT * from tblroles where company='".$_SESSION['company']."' order by id");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['id'].'">'.ucwords($row['role']).'</option>';
                                                          }    
                                                      ?>
                                                </select>
                                        
                                        <button class="btn btn-primary" type="submit" name="crole" id="crole" title="Update role">Update role</button>

                                    </form>
                                </div><!-- /.box-body -->

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>

          </section>
				</div>
		
        <?php 
        include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>



