
<?php
include "../connection.php";
            $date=date("Y-m-d");
            //general
$q = mysqli_query($con,"SELECT * from tblreport where status='pharmacy' and today='$date' ");
            $pharmacy = mysqli_num_rows($q);
$z = mysqli_query($con,"SELECT * from tblmedicalhistory where status='new' and today='$date' ");
            $new = mysqli_num_rows($z);
$y = mysqli_query($con,"SELECT * from tblreport where status='labTest' and today='$date' ");
            $labTest = mysqli_num_rows($y);
$d = mysqli_query($con,"SELECT * from tblreport where status='finalDX' and today='$date' ");
            $final = mysqli_num_rows($d);
$w = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$date' ");
            $treated = mysqli_num_rows($w);
            //highlands
$qh = mysqli_query($con,"SELECT * from tblreport where status='pharmacy' and estate='high' and today='$date' ");
            $pharmacyh = mysqli_num_rows($qh);
$zh = mysqli_query($con,"SELECT * from tblmedicalhistory where status='new' and estate='high' and today='$date' ");
            $newh = mysqli_num_rows($zh);
$yh = mysqli_query($con,"SELECT * from tblreport where status='labTest' and estate='high' and today='$date' ");
            $labTesth = mysqli_num_rows($yh);
$dh = mysqli_query($con,"SELECT * from tblreport where status='finalDX' and estate='high' and today='$date' ");
            $finalh = mysqli_num_rows($dh);
$wh = mysqli_query($con,"SELECT * from tblreport where status='treated' and estate='high' and today='$date' ");
            $treatedh = mysqli_num_rows($wh);
            //arroket
$qarr = mysqli_query($con,"SELECT * from tblreport where status='pharmacy' and estate='arr' and today='$date' ");
            $pharmacyarr = mysqli_num_rows($qarr);
$zarr = mysqli_query($con,"SELECT * from tblmedicalhistory where status='new' and estate='arr' and today='$date' ");
            $newarr = mysqli_num_rows($zarr);
$yarr = mysqli_query($con,"SELECT * from tblreport where status='labTest' and estate='arr' and today='$date' ");
            $labTestarr = mysqli_num_rows($yarr);
$darr = mysqli_query($con,"SELECT * from tblreport where status='finalDX' and estate='arr' and today='$date' ");
            $finalarr = mysqli_num_rows($darr);
$warr = mysqli_query($con,"SELECT * from tblreport where status='treated' and estate='arr' and today='$date' ");
            $treatedarr = mysqli_num_rows($warr);
             //monieri
$qmon = mysqli_query($con,"SELECT * from tblreport where status='pharmacy' and estate='mon' and today='$date' ");
            $pharmacymon = mysqli_num_rows($qmon);
$zmon = mysqli_query($con,"SELECT * from tblmedicalhistory where status='new' and estate='mon' and today='$date' ");
            $newmon = mysqli_num_rows($zmon);
$ymon = mysqli_query($con,"SELECT * from tblreport where status='labTest' and estate='mon' and today='$date' ");
            $labTestmon = mysqli_num_rows($ymon);
$dmon = mysqli_query($con,"SELECT * from tblreport where status='finalDX' and estate='mon' and today='$date' ");
            $finalmon = mysqli_num_rows($dmon);
$wmon = mysqli_query($con,"SELECT * from tblreport where status='treated' and estate='mon' and today='$date' ");
            $treatedmon = mysqli_num_rows($wmon);
                                        ?>
<?php
 
$dataPoints = array(
    array("label"=> "New Patients", "y"=> $new),
    array("label"=> "Lab Queueing", "y"=> $labTest),
    array("label"=> "Final DX Queueing", "y"=> $final),
    array("label"=> "Pharmacy Queueing", "y"=> $pharmacy),
    array("label"=> "Treated Patients", "y"=> $treated),
);

$dataPointh = array(
    array("label"=> "New Patients", "y"=> $newh),
    array("label"=> "Lab Queueing", "y"=> $labTesth),
    array("label"=> "Final DX Queueing", "y"=> $finalh),
    array("label"=> "Pharmacy Queueing", "y"=> $pharmacyh),
    array("label"=> "Treated Patients", "y"=> $treatedh),
);

$dataPointarr = array(
    array("label"=> "New Patients", "y"=> $newarr),
    array("label"=> "Lab Queueing", "y"=> $labTestarr),
    array("label"=> "Final DX Queueing", "y"=> $finalarr),
    array("label"=> "Pharmacy Queueing", "y"=> $pharmacyarr),
    array("label"=> "Treated Patients", "y"=> $treatedarr),
);

$dataPointmon = array(
    array("label"=> "New Patients", "y"=> $newmon),
    array("label"=> "Lab Queueing", "y"=> $labTestmon),
    array("label"=> "Final DX Queueing", "y"=> $finalmon),
    array("label"=> "Pharmacy Queueing", "y"=> $pharmacymon),
    array("label"=> "Treated Patients", "y"=> $treatedmon),
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
        text: "Today Patients Visit Dispensaries"
    },
    axisY: {
        title: "Number of Patients"
    },
    data: [
    {
        type: "spline",
        name:"All Dispensaries",
        showInLegend:true,
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    },
    {
        type: "spline",
        name:"Highlands",
        showInLegend:true,
        dataPoints: <?php echo json_encode($dataPointh, JSON_NUMERIC_CHECK); ?>
    },
    {
        type: "spline",
        name:"Arroket",
        showInLegend:true,
        dataPoints: <?php echo json_encode($dataPointarr, JSON_NUMERIC_CHECK); ?>
    },
    {
        type: "spline",
        name:"Monieri",
        showInLegend:true,
        dataPoints: <?php echo json_encode($dataPointmon, JSON_NUMERIC_CHECK); ?>
    },
    ]
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
                                <a href="../charts/general2.php"><i class="fa fa-pie-chart"  style="color:teal;"></i> <span>Today</span></a>
                                </div>  
                                <div id="no-print" class="btn btn-sm btn-default"> 
                                <a href="../charts/generals.php" target="_parent"><i class="fa fa-pie-chart"  style="color:teal;"></i> Patients  treated for last 7 days </a> </div>  
                                <div id="no-print" class="btn btn-sm btn-default"> 
                                    <a href="../admin/monthly.php" target="_parent"><i class="fa fa-pie-chart"  style="color:teal;"></i> Patients Treated this year </a> </div>
                                <div id="no-print" class="btn btn-sm btn-default"> 
                                    <a href="../generaladmin/yearly.php" target="_parent"><i class="fa fa-pie-chart"  style="color:teal;"></i> Patients Treated for the last 10 years @ estate </a> </div>
                                <div id="no-print" class="btn btn-sm btn-default"> 
                                    <a href="../admin/gentreatment.php" target="_parent"><i class="fa fa-pie-chart"  style="color:teal;"></i> Treatment Category </a> </div>
                                <input type="button" style="color: steelblue" class="btn btn-sm btn-default" id="btnprint" value="Print" onclick="print_page()">
                            <div class="row">
                                <div id="chartContainer" style="height: 600px; width: 100%;"></div>
                        <script src="../canvasjs.min.js"></script>
                    </div>
                </div>
                                

    </body>
</html>