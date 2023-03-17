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
    <style type="text/css">
        .icon{
            width: 45px;
            padding-right: 10px;
        }
        .iconb{
            width: 30px;
            padding-right: 10px;
        }
        .icon:hover{
            transition: 0.3s;
            /*box-shadow: 2px 0px 20px rgba(0, 0, 0, 0.8);*/
        }
        .scrollable {
    height: 500px; /* or any value */
    overflow-y: auto;
}
a{text-decoration:none;color:#000;}
#myList{
     display: inline-block;
}
.sidebar-menu .invoices{
        background-color:#009999;
    }
    </style>
    <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>
        
      <?php
	if(isset($_POST['cancel']))
	{
	    $txt_id = $_POST['invoice'];
	    $cancellation = $_POST['cancellation'];
	    $editor = $_SESSION['username'];
	    $date=date("Y-m-d");

	       $query = mysqli_query($con,"UPDATE tblleased SET cancellation = '".$cancellation."',cancelled_by = '".$editor."',cancelled_date= '".$date."' where invoice = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Cancellation saved successfully.");';
            echo 'window.location = "ilp.php";';
            echo '</script>';
            exit;
	    }

		else{
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            //echo 'window.location.href = window.location.href;';
            echo '</script>';
		}
	}
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                </section>
                <form method="post">

                <!-- Main content -->
                <section class="content">
                    <div class="row">

                                <div class="box-body table-responsive">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Invoice</th>
                                                <th>Invoiced date</th>
                                                <th>Customer ID</th>
                                                <th>Full Name </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "select * from tblleased where company='".$_SESSION['company']."' and invoice='".$_GET['invoice']."' ");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                $r=$row['client'];
                                                  $c = mysqli_query($con, "select * from tblcustomers where identity='".$r."' ");
                                                while($data = mysqli_fetch_array($c))
                                            {
                                                $fname=$data['fname'];
                                                $mname=$data['mname'];
                                                $lname=$data['lname'];
                                            }
                                                echo '
                                            <td>'.$row['invoice'].'</td>
                                            <td>'.$row['ldate'].'</td>
                                            <td>'.$row['client'].'</td>
                                            <td>'.ucwords($fname).' '.ucwords($lname).' '.ucwords($mname).'</td>';
                                            }
                                            ?>
                                            
                                        </tbody>
                                    </table>        
                                    
                                    <div class="col-sm-6"
                                    <form class="form" method="POST">
                                        <input type="hidden" value="<?php echo $_GET['invoice'] ?>" name="invoice" id="invoice"/>
                                        <div class="form-group">
                                        <label>Reason for Invoice Cancellation</label>
                                        </div>
                                        <div class="form-group">
                                        <textarea class="form-control" name="cancellation" id="cancellation" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-sm btn_task" id="cancel" name="cancel" value="Save"/>
                                        </div>
                                        
                                    </form>
                                    </div>
                                      </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
                </form>
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
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>