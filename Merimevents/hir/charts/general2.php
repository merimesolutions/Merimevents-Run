<?php
include "../connection.php";
            $date=date("Y-m-d");
            $q = mysqli_query($con,"SELECT * from tblreport where status='pharmacy' and today='$date' ");
            $pharmacy = mysqli_num_rows($q);
            $z = mysqli_query($con,"SELECT * from tblmedicalhistory where status='new' and today='$date' ");
            $new = mysqli_num_rows($z);
            $y = mysqli_query($con,"SELECT * from tblreport where status='labTest' and today='$date' ");
            $labTest = mysqli_num_rows($y);
            $d = mysqli_query($con,"SELECT * from tblreport where status='finalDX' and today='$date' ");
            $final = mysqli_num_rows($d);
            $w = mysqli_query($con,"SELECT * from tblmedicinedose where status='treated' and today='$date' ");
            $treated = mysqli_num_rows($w);
                                        ?>
<?php
 
$dataPoints = array(
    array("label"=> "New Patients", "y"=> $new),
    array("label"=> "Lab Queueing", "y"=> $labTest),
    array("label"=> "Final DX Queueing", "y"=> $final),
    array("label"=> "Pharmacy Queueing", "y"=> $pharmacy),
    array("label"=> "Treated Patients", "y"=> $treated),
);
    
?>
<!DOCTYPE html>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title: {
        text: "Daily Patients Attendance"
    },
    axisY: {
        title: "Number of Patients"
    },
    data: [{
        type: "pie",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
}
</script>
</head>
    <?php include('../head_css.php'); ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        ob_start();
        ?>

        <?php include('../header.php'); ?>
      
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 style="font-weight:bold;">
                       <i class="fa fa-dashboard"></i> Dashboard
                    </h1>
                </section>


							<div class="container-fluid container-fullw bg-white">
                                <?php include('../charts/line.php'); ?>
								
                                </div>   <!-- /.row -->
                </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <?php include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>