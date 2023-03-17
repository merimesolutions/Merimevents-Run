<?php
include "../connection.php";
            $now=date('Y');
            $today=new DateTime($now);
            $today1=new DateTime($now);
            $today2=new DateTime($now);
            $today3=new DateTime($now);
            $today4=new DateTime($now);
            $today5=new DateTime($now);
            $today6=new DateTime($now);
            $today7=new DateTime($now);
            $today8=new DateTime($now);
            $today9=new DateTime($now);

            $today->sub(new dateInterval('P365D'));
            $today1->sub(new dateInterval('P730D'));
            $today2->sub(new dateInterval('P1095D'));
            $today3->sub(new dateInterval('P1460D'));
            $today4->sub(new dateInterval('P1825D'));
            $today5->sub(new dateInterval('P2190D'));
            $today6->sub(new dateInterval('P2555D'));
            $today7->sub(new dateInterval('P2920D'));
            $today8->sub(new dateInterval('P3285D'));
            $today9->sub(new dateInterval('P3650D'));

            $d1= $today->format('Y');
            $d2= $today1->format('Y');
            $d3= $today2->format('Y');
            $d4= $today3->format('Y');
            $d5= $today4->format('Y');
            $d6= $today5->format('Y');
            $d7= $today6->format('Y');
            $d8= $today7->format('Y');
            $d9= $today8->format('Y');
            $d10= $today9->format('Y');

$q = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$now."' and estate='".$_SESSION['estate']."' ");
                $treated = mysqli_num_rows($q); 
$t1 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d1."' and estate='".$_SESSION['estate']."' ");
                $treated1 = mysqli_num_rows($t1);
$t2 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d2."' and estate='".$_SESSION['estate']."' ");
                $treated2 = mysqli_num_rows($t2);
$t3 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d3."' and estate='".$_SESSION['estate']."' ");
                $treated3 = mysqli_num_rows($t3);
$t4 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d4."' and estate='".$_SESSION['estate']."' ");
                $treated4 = mysqli_num_rows($t4);
$t5 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d5."' and estate='".$_SESSION['estate']."' ");
                $treated5 = mysqli_num_rows($t5);
$t6 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d6."' and estate='".$_SESSION['estate']."' ");
                $treated6 = mysqli_num_rows($t6);
$t7 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d7."' and estate='".$_SESSION['estate']."' ");
                $treated7 = mysqli_num_rows($t7);
$t8 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d8."' and estate='".$_SESSION['estate']."' ");
                $treated8 = mysqli_num_rows($t8);
$t9 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d9."' and estate='".$_SESSION['estate']."' ");
                $treated9 = mysqli_num_rows($t9);
$t10 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d10."' and estate='".$_SESSION['estate']."' ");
                $treated10 = mysqli_num_rows($t10);

$dataPoints = array(
    array("label"=> $now, "y"=> $treated),
    array("label"=> $d1, "y"=> $treated1),
    array("label"=> $d2, "y"=> $treated2),
    array("label"=> $d3, "y"=> $treated3),
    array("label"=> $d4, "y"=> $treated4),
    array("label"=> $d5, "y"=> $treated5),
    array("label"=> $d6, "y"=> $treated6),
    array("label"=> $d7, "y"=> $treated7),
    array("label"=> $d8, "y"=> $treated8),
    array("label"=> $d9, "y"=> $treated9),
    array("label"=> $d10, "y"=> $treated10),
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
        text: "Patients Treated For The Last 10 Year"
    },
    axisY: {
        title: "Number of Patients"
    },
    data: [
    {
        type: "spline",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }
    ]
}
);
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
    <?php include('../head_css.php'); ?>
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
                                
                                </div>   <!-- /.row -->
                            </div>
 
    </body>
</html>