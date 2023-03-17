<?php
include "../connection.php";
$now=date('Y-m-d');
 $today=new DateTime($now);
 $today1=new DateTime($now);
 $today2=new DateTime($now);
 $today3=new DateTime($now);
 $today4=new DateTime($now);
 $today5=new DateTime($now);
 $today6=new DateTime($now);

 $today->sub(new dateInterval('P1D'));
$today1->sub(new dateInterval('P2D'));
            $today2->sub(new dateInterval('P3D'));
            $today3->sub(new dateInterval('P4D'));
            $today4->sub(new dateInterval('P5D'));
            $today5->sub(new dateInterval('P6D'));
            $today6->sub(new dateInterval('P7D'));
            $d1= $today->format('Y-m-d');
            $d2= $today1->format('Y-m-d');
            $d3= $today2->format('Y-m-d');
            $d4= $today3->format('Y-m-d');
            $d5= $today4->format('Y-m-d');
            $d6= $today5->format('Y-m-d');
            $d7= $today6->format('Y-m-d');

            $tday = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$now' and estate='".$_SESSION['estate']."' ");
            $treated = mysqli_num_rows($tday);
            $f = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d1' and estate='".$_SESSION['estate']."' ");
            $treated1 = mysqli_num_rows($f);
            $s = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d2' and estate='".$_SESSION['estate']."' ");
            $treated2 = mysqli_num_rows($s);
            $th = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d3' and estate='".$_SESSION['estate']."' ");
            $treated3 = mysqli_num_rows($th);
            $fr = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d4' and estate='".$_SESSION['estate']."' ");
            $treated4 = mysqli_num_rows($fr);
            $ff = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d5' and estate='".$_SESSION['estate']."' ");
            $treated5 = mysqli_num_rows($ff);
            $sx = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d6' and estate='".$_SESSION['estate']."' ");
            $treated6 = mysqli_num_rows($sx);
            $sv = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d7' and estate='".$_SESSION['estate']."' ");
            $treated7 = mysqli_num_rows($sv);

$dataPoints = array(
    array("label"=> "Today", "y"=> $treated),
	array("label"=> $d1, "y"=> $treated1),
    array("label"=> $d2, "y"=> $treated2),
    array("label"=> $d3, "y"=> $treated3),
    array("label"=> $d4, "y"=> $treated4),
    array("label"=> $d5, "y"=> $treated5),
    array("label"=> $d6, "y"=> $treated6),
    array("label"=> $d7, "y"=> $treated7),
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
        text: "Patients Treated For The Last 7 Days"
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