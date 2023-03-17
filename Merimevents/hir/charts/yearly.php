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

//all estates
$q = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$now."' ");
                $treated = mysqli_num_rows($q); 
$t1 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d1."' ");
                $treated1 = mysqli_num_rows($t1);
$t2 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d2."' ");
                $treated2 = mysqli_num_rows($t2);
$t3 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d3."' ");
                $treated3 = mysqli_num_rows($t3);
$t4 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d4."' ");
                $treated4 = mysqli_num_rows($t4);
$t5 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d5."' ");
                $treated5 = mysqli_num_rows($t5);
$t6 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d6."' ");
                $treated6 = mysqli_num_rows($t6);
$t7 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d7."' ");
                $treated7 = mysqli_num_rows($t7);
$t8 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d8."' ");
                $treated8 = mysqli_num_rows($t8);
$t9 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d9."' ");
                $treated9 = mysqli_num_rows($t9);
$t10 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d10."' ");
                $treated10 = mysqli_num_rows($t10);

//all highlands
$qh = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$now."' and estate='high' ");
                $treatedh = mysqli_num_rows($qh); 
$th1 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d1."' and estate='high' ");
                $treatedh1 = mysqli_num_rows($th1);
$th2 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d2."' and estate='high' ");
                $treatedh2 = mysqli_num_rows($th2);
$th3 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d3."' and estate='high' ");
                $treatedh3 = mysqli_num_rows($th3);
$th4 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d4."' and estate='high' ");
                $treatedh4 = mysqli_num_rows($th4);
$th5 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d5."' and estate='high' ");
                $treatedh5 = mysqli_num_rows($th5);
$th6 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d6."' and estate='high' ");
                $treatedh6 = mysqli_num_rows($th6);
$th7 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d7."' and estate='high' ");
                $treatedh7 = mysqli_num_rows($th7);
$th8 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d8."' and estate='high' ");
                $treatedh8 = mysqli_num_rows($th8);
$th9 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d9."' and estate='high' ");
                $treatedh9 = mysqli_num_rows($th9);
$th10 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d10."' and estate='high' ");
                $treatedh10 = mysqli_num_rows($th10);

//all arroket
$qarr = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$now."' and estate='arr' ");
                $treatedarr = mysqli_num_rows($qarr); 
$tarr1 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d1."' and estate='arr' ");
                $treatedarr1 = mysqli_num_rows($tarr1);
$tarr2 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d2."' and estate='arr' ");
                $treatedarr2 = mysqli_num_rows($tarr2);
$tarr3 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d3."' and estate='arr' ");
                $treatedarr3 = mysqli_num_rows($tarr3);
$tarr4 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d4."' and estate='arr' ");
                $treatedarr4 = mysqli_num_rows($tarr4);
$tarr5 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d5."' and estate='arr' ");
                $treatedarr5 = mysqli_num_rows($tarr5);
$tarr6 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d6."' and estate='arr' ");
                $treatedarr6 = mysqli_num_rows($tarr6);
$tarr7 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d7."' and estate='arr' ");
                $treatedarr7 = mysqli_num_rows($tarr7);
$tarr8 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d8."' and estate='arr' ");
                $treatedarr8 = mysqli_num_rows($tarr8);
$tarr9 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d9."' and estate='arr' ");
                $treatedarr9 = mysqli_num_rows($tarr9);
$tarr10 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d10."' and estate='arr' ");
                $treatedarr10 = mysqli_num_rows($tarr10);

//all monieri
$qmon = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$now."' and estate='mon' ");
                $treatedmon = mysqli_num_rows($qmon); 
$tmon1 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d1."' and estate='mon' ");
                $treatedmon1 = mysqli_num_rows($tmon1);
$tmon2 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d2."' and estate='mon' ");
                $treatedmon2 = mysqli_num_rows($tmon2);
$tmon3 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d3."' and estate='mon' ");
                $treatedmon3 = mysqli_num_rows($tmon3);
$tmon4 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d4."' and estate='mon' ");
                $treatedmon4 = mysqli_num_rows($tmon4);
$tmon5 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d5."' and estate='mon' ");
                $treatedmon5 = mysqli_num_rows($tmon5);
$tmon6 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d6."' and estate='mon' ");
                $treatedmon6 = mysqli_num_rows($tmon6);
$tmon7 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d7."' and estate='mon' ");
                $treatedmon7 = mysqli_num_rows($tmon7);
$tmon8 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d8."' and estate='mon' ");
                $treatedmon8 = mysqli_num_rows($tmon8);
$tmon9 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d9."' and estate='mon' ");
                $treatedmon9 = mysqli_num_rows($tmon9);
$tmon10 = mysqli_query($con,"SELECT * from tblreport where status='treated' and period='".$d10."' and estate='mon' ");
                $treatedmon10 = mysqli_num_rows($tmon10);

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
 
 $dataPointh = array(
    array("label"=> $now, "y"=> $treatedh),
    array("label"=> $d1, "y"=> $treatedh1),
    array("label"=> $d2, "y"=> $treatedh2),
    array("label"=> $d3, "y"=> $treatedh3),
    array("label"=> $d4, "y"=> $treatedh4),
    array("label"=> $d5, "y"=> $treatedh5),
    array("label"=> $d6, "y"=> $treatedh6),
    array("label"=> $d7, "y"=> $treatedh7),
    array("label"=> $d8, "y"=> $treatedh8),
    array("label"=> $d9, "y"=> $treatedh9),
    array("label"=> $d10, "y"=> $treatedh10),
); 

 $dataPointarr = array(
    array("label"=> $now, "y"=> $treatedarr),
    array("label"=> $d1, "y"=> $treatedarr1),
    array("label"=> $d2, "y"=> $treatedarr2),
    array("label"=> $d3, "y"=> $treatedarr3),
    array("label"=> $d4, "y"=> $treatedarr4),
    array("label"=> $d5, "y"=> $treatedarr5),
    array("label"=> $d6, "y"=> $treatedarr6),
    array("label"=> $d7, "y"=> $treatedarr7),
    array("label"=> $d8, "y"=> $treatedarr8),
    array("label"=> $d9, "y"=> $treatedarr9),
    array("label"=> $d10, "y"=> $treatedarr10),
); 

 $dataPointmon = array(
    array("label"=> $now, "y"=> $treatedmon),
    array("label"=> $d1, "y"=> $treatedmon1),
    array("label"=> $d2, "y"=> $treatedmon2),
    array("label"=> $d3, "y"=> $treatedmon3),
    array("label"=> $d4, "y"=> $treatedmon4),
    array("label"=> $d5, "y"=> $treatedmon5),
    array("label"=> $d6, "y"=> $treatedmon6),
    array("label"=> $d7, "y"=> $treatedmon7),
    array("label"=> $d8, "y"=> $treatedmon8),
    array("label"=> $d9, "y"=> $treatedmon9),
    array("label"=> $d10, "y"=> $treatedmon10),
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