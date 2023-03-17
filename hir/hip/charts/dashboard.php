
<?php
include "../connection.php";
            $date=date("Y-m-d");
            $q = mysqli_query($con,"SELECT * from tblreport where status='pharmacy' and today='".$date."' and estate='".$_SESSION['estate']."' ");
            $pharmacy = mysqli_num_rows($q);
            $z = mysqli_query($con,"SELECT * from tblmedicalhistory where status='new' and today='".$date."' and estate='".$_SESSION['estate']."' ");
            $new = mysqli_num_rows($z);
            $y = mysqli_query($con,"SELECT * from tblreport where status='labTest' and today='".$date."' and estate='".$_SESSION['estate']."' ");
            $labTest = mysqli_num_rows($y);
            $d = mysqli_query($con,"SELECT * from tblreport where status='finalDX' and today='".$date."' and estate='".$_SESSION['estate']."' ");
            $final = mysqli_num_rows($d);
            $w = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='".$date."' and estate='".$_SESSION['estate']."' ");
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
        text: "Patient Visit Today"
    },
    axisY: {
        title: "Number of Patients"
    },
    data: [{
        type: "spline",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
}
</script>
<script type="text/javascript">
    function print_page(){
        var ButtonControl = document.getElementById("btnprint");
        ButtonControl.style.visibility = "hidden";
        window.print();
    }
    </script>
    <link rel="stylesheet" type="text/css" href="../../css/print.css" media="print">
</head>
    <body class="skin-black">
            
							<div class="container-fluid container-fullw bg-white">
                                <div id="no-print" class="btn btn-sm btn-default">
                                <a href="../admin/dashboard.php"><i class="fa fa-pie-chart" style="color:teal;"></i> <span>Patient Visit Today</span></a>
                                </div>
                                <div id="no-print" class="btn btn-sm btn-default"> 
                                <a id="noprint" href="../admin/statistics.php" target="_parent"><i class="fa fa-pie-chart" style="color:teal;"></i> Patients  treated for last 7 days </a> </div>
                                <div id="no-print" class="btn btn-sm btn-default"> 
                                <a id="noprint" href="../admin/adyearly.php" target="_parent"><i class="fa fa-pie-chart" style="color:teal;"></i> Patients  treated for last 10 years </a> </div>
                                <div id="no-print" class="btn btn-sm btn-default"> 
                                <a id="noprint" href="../admin/treatment.php" target="_parent"><i class="fa fa-pie-chart" style="color:teal;"></i> Treatment Category for employees </a> </div>

                                  <input type="button" style="color: steelblue" class="btn btn-sm btn-default" id="btnprint" value="Print" onclick="print_page()">
							<div class="row">
                                
                                <div id="chartContainer" style="height: 600px; width: 100%;"></div>
                                
                        <script src="../canvasjs.min.js"></script>
                    </div>
                </div>


    </body>
</html>