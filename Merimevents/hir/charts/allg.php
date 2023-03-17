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
//general
$tday = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$now' ");
            $treated = mysqli_num_rows($tday);
$f = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d1' ");
            $treated1 = mysqli_num_rows($f);
$s = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d2'");
            $treated2 = mysqli_num_rows($s);
$th = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d3' ");
            $treated3 = mysqli_num_rows($th);
$fr = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d4' ");
            $treated4 = mysqli_num_rows($fr);
$ff = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d5' ");
            $treated5 = mysqli_num_rows($ff);
$sx = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d6' ");
            $treated6 = mysqli_num_rows($sx);
$sv = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d7' ");
            $treated7 = mysqli_num_rows($sv);
//highlands
$tdayh = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$now' and estate='high' ");
            $treatedh = mysqli_num_rows($tdayh);
$fh = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d1' and estate='high' ");
            $treatedh1 = mysqli_num_rows($fh);
$sh = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d2' and estate='high' ");
            $treatedh2 = mysqli_num_rows($sh);
$thh = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d3' and estate='high' ");
            $treatedh3 = mysqli_num_rows($thh);
$frh = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d4' and estate='high' ");
            $treatedh4 = mysqli_num_rows($frh);
$ffh = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d5' and estate='high' ");
            $treatedh5 = mysqli_num_rows($ffh);
$sxh = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d6' and estate='high' ");
            $treatedh6 = mysqli_num_rows($sxh);
$svh = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d7' and estate='high' ");
            $treatedh7 = mysqli_num_rows($svh);
//arroket
$tdayarr = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$now' and estate='arr' ");
            $treatedarr = mysqli_num_rows($tdayarr);
$farr = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d1' and estate='arr' ");
            $treatedarr1 = mysqli_num_rows($farr);
$sarr = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d2' and estate='arr' ");
            $treatedarr2 = mysqli_num_rows($sarr);
$tharr = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d3' and estate='arr' ");
            $treatedarr3 = mysqli_num_rows($tharr);
$frarr = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d4' and estate='arr' ");
            $treatedarr4 = mysqli_num_rows($frarr);
$ffarr = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d5' and estate='arr' ");
            $treatedarr5 = mysqli_num_rows($ffarr);
$sxarr = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d6' and estate='arr' ");
            $treatedarr6 = mysqli_num_rows($sxarr);
$svarr = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d7' and estate='arr' ");
            $treatedarr7 = mysqli_num_rows($svarr);
//monieri
$tdaymon = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$now' and estate='mon' ");
            $treatedmon= mysqli_num_rows($tdaymon);
$fmon = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d1' and estate='mon' ");
            $treatedmon1 = mysqli_num_rows($fmon);
$smon = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d2' and estate='mon' ");
            $treatedmon2 = mysqli_num_rows($smon);
$thmon = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d3' and estate='mon' ");
            $treatedmon3 = mysqli_num_rows($thmon);
$frmon = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d4' and estate='mon' ");
            $treatedmon4 = mysqli_num_rows($frmon);
$ffmon = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d5' and estate='mon' ");
            $treatedmon5 = mysqli_num_rows($ffmon);
$sxmon = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d6' and estate='mon' ");
            $treatedmon6 = mysqli_num_rows($sxmon);
$svmon = mysqli_query($con,"SELECT * from tblreport where status='treated' and today='$d7' and estate='mon' ");
            $treatedmon7 = mysqli_num_rows($svmon);

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
$dataPointh = array(
    array("label"=> "Today", "y"=> $treatedh),
    array("label"=> $d1, "y"=> $treatedh1),
    array("label"=> $d2, "y"=> $treatedh2),
    array("label"=> $d3, "y"=> $treatedh3),
    array("label"=> $d4, "y"=> $treatedh4),
    array("label"=> $d5, "y"=> $treatedh5),
    array("label"=> $d6, "y"=> $treatedh6),
    array("label"=> $d7, "y"=> $treatedh7),
);
$dataPointarr = array(
    array("label"=> "Today", "y"=> $treatedarr),
    array("label"=> $d1, "y"=> $treatedarr1),
    array("label"=> $d2, "y"=> $treatedarr2),
    array("label"=> $d3, "y"=> $treatedarr3),
    array("label"=> $d4, "y"=> $treatedarr4),
    array("label"=> $d5, "y"=> $treatedarr5),
    array("label"=> $d6, "y"=> $treatedarr6),
    array("label"=> $d7, "y"=> $treatedarr7),
);
$dataPointmon = array(
    array("label"=> "Today", "y"=> $treatedmon),
    array("label"=> $d1, "y"=> $treatedmon1),
    array("label"=> $d2, "y"=> $treatedmon2),
    array("label"=> $d3, "y"=> $treatedmon3),
    array("label"=> $d4, "y"=> $treatedmon4),
    array("label"=> $d5, "y"=> $treatedmon5),
    array("label"=> $d6, "y"=> $treatedmon6),
    array("label"=> $d7, "y"=> $treatedmon7),
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
        title: "Number of Patients",
        includeZero:true
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
    <?php include('../head_css.php'); ?>
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
                                
                                </div>   <!-- /.row -->
                            </div>
 
    </body>
</html>