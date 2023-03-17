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
      $msg="";
      $con = mysqli_connect('localhost','merimeve_event','user@event','merimeve_event') or die(mysqli_error());
      //if submit button is pressed
      if (isset($_POST['btn_login'])){

          $mname        =$_POST['mname'];
          $lname        =$_POST['lname'];
          $gender       =$_POST['gender'];
          $code         =$_POST['code']; 
          $box          =$_POST['box'];
          $town         =$_POST['town'];
          $identity     =$_POST['identity'];
          $phy_address  =$_POST['phy_address'];
          $fcontact     =$_POST['fcontact'];
          $scontact     =$_POST['scontact'];
          $email        =$_POST['email'];
          $b_c_name     =$_POST['b_c_name'];
          $b_c_location =$_POST['b_c_location'];
          $reg_date     =date("Y-m-d");
          $reg_time     =date("h:i:sa");
          $company      =$_SESSION['company'];

  $sql_u = "SELECT * FROM tblcustomers WHERE identity = '$identity' and company='$company' ";
      $results = mysqli_query($con,$sql_u);
        if(mysqli_num_rows($results)>0){
            echo '<script type="text/javascript">'; 
                echo 'alert("The customer is already registered !!!");'; 
                echo 'window.location = "c.php";';
                echo '</script>';
    }else{

          $sql="insert into tblcustomers(fname,mname,lname,gender,code,box,town,identity,phy_address,fcontact,scontact,email,b_c_name,b_c_location,company) VALUES('$fname','$mname','$lname','$gender', '$code', '$box','$town', '$identity', '$phy_address','$fcontact','$scontact','$email','$b_c_name','$b_c_location','$company')";
                  
          if(mysqli_query($con, $sql)){
              echo '<script type="text/javascript">'; 
                echo 'alert("The customer is registered successfully.");'; 
                echo 'window.location = "ocr.php";';
                echo '</script>';
          } else {
            echo '<script type="text/javascript">'; 
            echo 'alert("Error occured during submission.");'; 
            //echo 'window.location = "c.php";';
            echo '</script>';
          }

          mysqli_close($con);
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
                <a href="setting.php" title="Go home"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go home"></i> Back</a>
                </section>
                <!-- Main content -->
                <section class="content">
                <div class="box-body table-responsive">
                    <span style="font-weight:bold;">Role: </span>
                    <?php
                        $squery = mysqli_query($con, "select * from tblroles where id='".$_GET['role']."' ");
                             while($row = mysqli_fetch_array($squery))
                                 {
                                    echo ucwords($row['role']);
                                  }
                                ?>
                    
                                <form method="post">
                                    <?php
$con =  mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die("connection failed" . mysqli_error()); 
	if(isset($_POST['update']))
	{
	    $txt_id     = $_GET['role'];
	    $register   = $_POST['register'];
	    $lease      = $_POST['lease'];
	    $return     = $_POST['return'];
	    $inventory  = $_POST['inventory'];
	    $penalty    = $_POST['penalty'];
	    $invoice    = $_POST['invoice'];
	    $report     = $_POST['report'];
	    $project    = $_POST['project'];
	    $events    = $_POST['event'];
	    $user       = $_POST['user'];
 
	       $query = mysqli_query($con,"UPDATE tblroles SET register = '".$register."',lease = '".$lease."',returning = '".$return."',inventory = '".$inventory."',penalty = '".$penalty."',invoice = '".$invoice."',report = '".$report."',project = '".$project."',user = '".$user."',events = '".$events."' where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Updated successufully.");'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
           // echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>
                                    <button  style="float:right" class="btn btn-primary" type="submit" name="update" id="update" title="Save">Update</button>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activities / Modules</th>
                                                <!--<th>Status</th>-->
                                                <th>Edit</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "select * from tblroles where company='".$_SESSION['company']."' and id='".$_GET['role']."' ORDER BY id DESC");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                               
                                                    $r=$row['register'];
                                                
                                                    $l=$row['lease'];
                                                
                                                    $re=$row['returning'];
                                                
                                                    $i=$row['inventory'];
                                                 
                                                    $p=$row['penalty'];
                                                
                                                    $in=$row['invoice'];
                                                
                                                    $rep=$row['report'];
                    
                                                    $pr=$row['project'];
                                                    
                                                    $ev=$row['events'];
                                                
                                                    $u=$row['user'];
                                                
                                                
                                                echo '
                                                    <tr>
                                                <td>Customer Registration</td>
                                                
                                                <td>  <input type="checkbox" id="toggle-demo" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="registers"  data-size="sm"  data-onstyle="success" data-offstyle="danger">
                                                <input type="hidden" name="register" id="register" value="'.$r.'"></td>
                                                      
                                                </tr>
                                                
                                                <tr>
                                                <td>Leasing Items</td>
                                                 
                                                <td> <input type="checkbox" id="leases" data-toggle="toggle" data-on="Enable" data-off="Disable"  name="leases" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="lease" id="lease" value="'.$l.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Returning Items</td>
                                                 
                                                <td> <input type="checkbox" id="returns" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="return" id="return" value="'.$re.'"></td>
                                               
                                                </tr>
                                                
                                                <tr>
                                                <td>Inventory management</td>
                                                 
                                                <td><input type="checkbox" id="inventories" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="inventory" id="inventory" value="'.$i.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Penalties</td>
                                                
                                                <td><input type="checkbox" id="penalties" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="penalty" id="penalty" value="'.$p.'"></td>
                                                
                                                </tr>
                                                
                                                <tr>
                                                <td>Invoices</td>
                                                 
                                                <td><input type="checkbox" id="invoices" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="invoice" id="invoice" value="'.$in.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>Printing reports</td>
                                                
                                                <td><input type="checkbox" id="reports" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="report" id="report" value="'.$rep.'"></td>
                                                 
                                                </tr>
                                                
                                                <tr>
                                                <td>My tasks</td>
                                                
                                                <td><input type="checkbox" id="projects" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="project" id="project" value="'.$pr.'"></td>
                                                
                                                </tr>
                                                
                                                <tr>
                                                <td>Events</td>
                                                
                                                <td><input type="checkbox" id="events" data-toggle="toggle" data-on="Enable" data-off="Disable"  data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="event" id="event" value="'.$ev.'"></td>
                                                
                                                </tr>
                                                
                                                <tr>
                                                <td>Add user accounts</td>
                                                 
                                                <td><input type="checkbox" id="users" data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"  data-onstyle="success" data-offstyle="danger"><input type="hidden" name="user" id="user" value="'.$u.'"></td>
                                                
                                                </tr>
                                                ';
                                                include "editRole.php";
                                            }
                                            ?>
                                             <script>
                                                var r ="<?php echo $r;?>";
                                                var l = "<?php echo $l;?>";
                                                var re = "<?php echo $re;?>";
                                                var i =  "<?php echo $i;?>";
                                                var p = "<?php echo $p;?>";
                                                var invoice = "<?php echo $in;?>";
                                                var rep = "<?php echo $rep;?>";
                                                var pr  = "<?php echo $pr;?>";
                                                var ev  = "<?php echo $ev;?>";
                                                var u = "<?php echo $u;?>";
                                                if( r =='1'){
                                                    $('#toggle-demo').bootstrapToggle('on');
                                                }else{
                                                	$('#toggle-demo').bootstrapToggle('off')
                                                }
                                                if( l =='1'){
                                                    $('#leases').bootstrapToggle('on');
                                                }else{
                                                    $('#leases').bootstrapToggle('off')
                                                }
                                                if( re =='1'){
                                                    $('#returns').bootstrapToggle('on');
                                                }else{
                                                    $('#returns').bootstrapToggle('off')
                                                }
                                                //----------
                                                   if( i =='1'){
                                                    $('#inventories').bootstrapToggle('on');
                                                }else{
                                                    $('#inventories').bootstrapToggle('off')
                                                }
                                                //--------------
                                                   if( p =='1'){
                                                    $('#penalties').bootstrapToggle('on');
                                                }else{
                                                    $('#penalties').bootstrapToggle('off')
                                                }
                                                //---------
                                                 if( ev =='1'){
                                                    $('#events').bootstrapToggle('on');
                                                }else{
                                                    $('#events').bootstrapToggle('off')
                                                }
                                                //---------
                                                   if( invoice =='1'){
                                                    $('#invoices').bootstrapToggle('on');
                                                }else{
                                                    $('#invoices').bootstrapToggle('off')
                                                }
                                                 //---------
                                                   if( rep =='1'){
                                                    $('#reports').bootstrapToggle('on');
                                                }else{
                                                    $('#reports').bootstrapToggle('off')
                                                }
                                                 //---------
                                                   if( pr =='1'){
                                                    $('#projects').bootstrapToggle('on');
                                                }else{
                                                    $('#projects').bootstrapToggle('off')
                                                }
                                                 //---------
                                                   if( u =='1'){
                                                    $('#users').bootstrapToggle('on');
                                                }else{
                                                    $('#users').bootstrapToggle('off')
                                                }
                                                //--------------------------
                                                 $('#toggle-demo').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#register').val('1');
                                                    }else{
                                                        $('#register').val('0');
                                                    }
                                                });
                                                //---------changes made here
                                                $('#leases').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#lease').val('1');
                                                    }else{
                                                        $('#lease').val('0');
                                                    }
                                                });
                                                $('#returns').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#return').val('1');
                                                    }else{
                                                        $('#return').val('0');
                                                    }
                                                });
                                                $('#inventories').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#inventory').val('1');
                                                    }else{
                                                        $('#inventory').val('0');
                                                    }
                                                });
                                                $('#penalties').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#penalty').val('1');
                                                    }else{
                                                        $('#penalty').val('0');
                                                    }
                                                });
                                                $('#invoices').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#invoice').val('1');
                                                    }else{
                                                        $('#invoice').val('0');
                                                    }
                                                });
                                                $('#reports').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#report').val('1');
                                                    }else{
                                                        $('#report').val('0');
                                                    }
                                                });
                                                $('#projects').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#project').val('1');
                                                    }else{
                                                        $('#project').val('0');
                                                    }
                                                });
                                                $('#events').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#event').val('1');
                                                    }else{
                                                        $('#event').val('0');
                                                    }
                                                });
                                                $('#users').change(function (){
                                                    if($(this).prop('checked')){
                                                        $('#user').val('1');
                                                    }else{
                                                        $('#user').val('0');
                                                    }
                                                });
                                                
                                                
                                                
                                            </script>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>

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



