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

//sickness
$qs= mysqli_query($con,"SELECT * from tblreport where category='sickness' and period='".$now."' and estate='".$_SESSION['estate']."' ");
                $sickness = mysqli_num_rows($qs);
$qs1 = mysqli_query($con,"SELECT * from tblreport where category='sickness' and period='".$d1."' and estate='".$_SESSION['estate']."' ");
                $sickness1 = mysqli_num_rows($qs1);
$qs2 = mysqli_query($con,"SELECT * from tblreport where category='sickness' and period='".$d2."' and estate='".$_SESSION['estate']."' ");
                $sickness2 = mysqli_num_rows($qs2);
$qs3 = mysqli_query($con,"SELECT * from tblreport where category='sickness' and period='".$d3."' and estate='".$_SESSION['estate']."' ");
                $sickness3 = mysqli_num_rows($qs3);
$qs4 = mysqli_query($con,"SELECT * from tblreport where category='sickness' and period='".$d4."' and estate='".$_SESSION['estate']."' ");
                $sickness4 = mysqli_num_rows($qs4);
$qs5 = mysqli_query($con,"SELECT * from tblreport where category='sickness' and period='".$d5."' and estate='".$_SESSION['estate']."' ");
                $sickness5 = mysqli_num_rows($qs5);
$qs6 = mysqli_query($con,"SELECT * from tblreport where category='sickness' and period='".$d6."' and estate='".$_SESSION['estate']."' ");
                $sickness6 = mysqli_num_rows($qs6);
$qs7 = mysqli_query($con,"SELECT * from tblreport where category='sickness' and period='".$d7."' and estate='".$_SESSION['estate']."' ");
                $sickness7 = mysqli_num_rows($qs7);
$qs8 = mysqli_query($con,"SELECT * from tblreport where category='sickness' and period='".$d8."' and estate='".$_SESSION['estate']."' ");
                $sickness8 = mysqli_num_rows($qs8);
$qs9 = mysqli_query($con,"SELECT * from tblreport where category='sickness' and period='".$d9."' and estate='".$_SESSION['estate']."' ");
                $sickness9 = mysqli_num_rows($qs9);
$qs10 = mysqli_query($con,"SELECT * from tblreport where category='sickness' and period='".$d10."' and estate='".$_SESSION['estate']."' ");
                $sickness10 = mysqli_num_rows($qs10);

//On-Duty Injury
$qod= mysqli_query($con,"SELECT * from tblreport where category='On-Duty Injury' and period='".$now."' and estate='".$_SESSION['estate']."' ");
                $sicknessod = mysqli_num_rows($qod);
$qod1 = mysqli_query($con,"SELECT * from tblreport where category='On-Duty Injury' and period='".$d1."' and estate='".$_SESSION['estate']."' ");
                $sicknessod1 = mysqli_num_rows($qod1);
$qod2 = mysqli_query($con,"SELECT * from tblreport where category='On-Duty Injury' and period='".$d2."' and estate='".$_SESSION['estate']."' ");
                $sicknessod2 = mysqli_num_rows($qod2);
$qod3 = mysqli_query($con,"SELECT * from tblreport where category='On-Duty Injury' and period='".$d3."' and estate='".$_SESSION['estate']."' ");
                $sicknessod3 = mysqli_num_rows($qod3);
$qod4 = mysqli_query($con,"SELECT * from tblreport where category='On-Duty Injury' and period='".$d4."' and estate='".$_SESSION['estate']."' ");
                $sicknessod4 = mysqli_num_rows($qod4);
$qod5 = mysqli_query($con,"SELECT * from tblreport where category='On-Duty Injury' and period='".$d5."' and estate='".$_SESSION['estate']."' ");
                $sicknessod5 = mysqli_num_rows($qod5);
$qod6 = mysqli_query($con,"SELECT * from tblreport where category='On-Duty Injury' and period='".$d6."' and estate='".$_SESSION['estate']."' ");
                $sicknessod6 = mysqli_num_rows($qod6);
$qod7 = mysqli_query($con,"SELECT * from tblreport where category='On-Duty Injury' and period='".$d7."' and estate='".$_SESSION['estate']."' ");
                $sicknessod7 = mysqli_num_rows($qod7);
$qod8 = mysqli_query($con,"SELECT * from tblreport where category='On-Duty Injury' and period='".$d8."' and estate='".$_SESSION['estate']."' ");
                $sicknessod8 = mysqli_num_rows($qod8);
$qod9 = mysqli_query($con,"SELECT * from tblreport where category='On-Duty Injury' and period='".$d9."' and estate='".$_SESSION['estate']."' ");
                $sicknessod9 = mysqli_num_rows($qod9);
$qod10 = mysqli_query($con,"SELECT * from tblreport where category='On-Duty Injury' and period='".$d10."' and estate='".$_SESSION['estate']."' ");
                $sicknessod10 = mysqli_num_rows($qod10);
//Off-Duty Injury
$qofd= mysqli_query($con,"SELECT * from tblreport where category='Off-Duty Injury' and period='".$now."' and estate='".$_SESSION['estate']."' ");
                $sicknessofd = mysqli_num_rows($qofd);
$qofd1 = mysqli_query($con,"SELECT * from tblreport where category='Off-Duty Injury' and period='".$d1."' and estate='".$_SESSION['estate']."' ");
                $sicknessofd1 = mysqli_num_rows($qofd1);
$qofd2 = mysqli_query($con,"SELECT * from tblreport where category='Off-Duty Injury' and period='".$d2."' and estate='".$_SESSION['estate']."' ");
                $sicknessofd2 = mysqli_num_rows($qofd2);
$qofd3 = mysqli_query($con,"SELECT * from tblreport where category='Off-Duty Injury' and period='".$d3."' and estate='".$_SESSION['estate']."' ");
                $sicknessofd3 = mysqli_num_rows($qofd3);
$qofd4 = mysqli_query($con,"SELECT * from tblreport where category='Off-Duty Injury' and period='".$d4."' and estate='".$_SESSION['estate']."' ");
                $sicknessofd4 = mysqli_num_rows($qofd4);
$qofd5 = mysqli_query($con,"SELECT * from tblreport where category='Off-Duty Injury' and period='".$d5."' and estate='".$_SESSION['estate']."' ");
                $sicknessofd5 = mysqli_num_rows($qofd5);
$qofd6 = mysqli_query($con,"SELECT * from tblreport where category='Off-Duty Injury' and period='".$d6."' and estate='".$_SESSION['estate']."' ");
                $sicknessofd6 = mysqli_num_rows($qofd6);
$qofd7 = mysqli_query($con,"SELECT * from tblreport where category='Off-Duty Injury' and period='".$d7."' and estate='".$_SESSION['estate']."' ");
                $sicknessofd7 = mysqli_num_rows($qofd7);
$qofd8 = mysqli_query($con,"SELECT * from tblreport where category='Off-Duty Injury' and period='".$d8."' and estate='".$_SESSION['estate']."' ");
                $sicknessofd8 = mysqli_num_rows($qofd8);
$qofd9 = mysqli_query($con,"SELECT * from tblreport where category='Off-Duty Injury' and period='".$d9."' and estate='".$_SESSION['estate']."' ");
                $sicknessofd9 = mysqli_num_rows($qofd9);
$qofd10 = mysqli_query($con,"SELECT * from tblreport where category='Off-Duty Injury' and period='".$d10."' and estate='".$_SESSION['estate']."' ");
                $sicknessofd10 = mysqli_num_rows($qofd10);

//MCH
$qmch= mysqli_query($con,"SELECT * from tblreport where purpose='MCH' and period='".$now."' and estate='".$_SESSION['estate']."' ");
                $mch = mysqli_num_rows($qmch);
$qmch1 = mysqli_query($con,"SELECT * from tblreport where purpose='MCH' and period='".$d1."' and estate='".$_SESSION['estate']."' ");
                $mch1 = mysqli_num_rows($qmch1);
$qmch2 = mysqli_query($con,"SELECT * from tblreport where purpose='MCH' and period='".$d2."' and estate='".$_SESSION['estate']."' ");
                $mch2 = mysqli_num_rows($qmch2);
$qmch3 = mysqli_query($con,"SELECT * from tblreport where purpose='MCH' and period='".$d3."' and estate='".$_SESSION['estate']."' ");
                $mch3 = mysqli_num_rows($qmch3);
$qmch4 = mysqli_query($con,"SELECT * from tblreport where purpose='MCH' and period='".$d4."' and estate='".$_SESSION['estate']."' ");
                $mch4 = mysqli_num_rows($qmch4);
$qmch5 = mysqli_query($con,"SELECT * from tblreport where purpose='MCH' and period='".$d5."' and estate='".$_SESSION['estate']."' ");
                $mch5 = mysqli_num_rows($qmch5);
$qmch6 = mysqli_query($con,"SELECT * from tblreport where purpose='MCH' and period='".$d6."' and estate='".$_SESSION['estate']."' ");
                $mch6 = mysqli_num_rows($qmch6);
$qmch7 = mysqli_query($con,"SELECT * from tblreport where purpose='MCH' and period='".$d7."' and estate='".$_SESSION['estate']."' ");
                $mch7 = mysqli_num_rows($qmch7);
$qmch8 = mysqli_query($con,"SELECT * from tblreport where purpose='MCH' and period='".$d8."' and estate='".$_SESSION['estate']."' ");
                $mch8 = mysqli_num_rows($qmch8);
$qmch9 = mysqli_query($con,"SELECT * from tblreport where purpose='MCH' and period='".$d9."' and estate='".$_SESSION['estate']."' ");
                $mch9 = mysqli_num_rows($qmch9);
$qmch10 = mysqli_query($con,"SELECT * from tblreport where purpose='MCH' and period='".$d10."' and estate='".$_SESSION['estate']."' ");
                $mch10 = mysqli_num_rows($qmch10);

//Dependants
$qnot= mysqli_query($con,"SELECT * from tblreport where purpose='Treatment' and period='".$now."' and estate='".$_SESSION['estate']."' ");
                $sicknessnot = mysqli_num_rows($qnot);
$qnot1 = mysqli_query($con,"SELECT * from tblreport where purpose='Treatment' and period='".$d1."' and estate='".$_SESSION['estate']."' ");
                $sicknessnot1 = mysqli_num_rows($qnot1);
$qnot2 = mysqli_query($con,"SELECT * from tblreport where purpose='Treatment' and period='".$d2."' and estate='".$_SESSION['estate']."' ");
                $sicknessnot2 = mysqli_num_rows($qnot2);
$qnot3 = mysqli_query($con,"SELECT * from tblreport where purpose='Treatment' and period='".$d3."' and estate='".$_SESSION['estate']."' ");
                $sicknessnot3 = mysqli_num_rows($qnot3);
$qnot4 = mysqli_query($con,"SELECT * from tblreport where purpose='Treatment' and period='".$d4."' and estate='".$_SESSION['estate']."' ");
                $sicknessnot4 = mysqli_num_rows($qnot4);
$qnot5 = mysqli_query($con,"SELECT * from tblreport where purpose='Treatment' and period='".$d5."' and estate='".$_SESSION['estate']."' ");
                $sicknessnot5 = mysqli_num_rows($qnot5);
$qnot6 = mysqli_query($con,"SELECT * from tblreport where purpose='Treatment' and period='".$d6."' and estate='".$_SESSION['estate']."' ");
                $sicknessnot6 = mysqli_num_rows($qnot6);
$qnot7 = mysqli_query($con,"SELECT * from tblreport where purpose='Treatment' and period='".$d7."' and estate='".$_SESSION['estate']."' ");
                $sicknessnot7 = mysqli_num_rows($qnot7);
$qnot8 = mysqli_query($con,"SELECT * from tblreport where purpose='Treatment' and period='".$d8."' and estate='".$_SESSION['estate']."' ");
                $sicknessnot8 = mysqli_num_rows($qnot8);
$qnot9 = mysqli_query($con,"SELECT * from tblreport where purpose='Treatment' and period='".$d9."' and estate='".$_SESSION['estate']."' ");
                $sicknessnot9 = mysqli_num_rows($qnot9);
$qnot10 = mysqli_query($con,"SELECT * from tblreport where purpose='Treatment' and period='".$d10."' and estate='".$_SESSION['estate']."' ");
                $sicknessnot10 = mysqli_num_rows($qnot10);

//non employees
$qnon= mysqli_query($con,"SELECT * from tblreport where category='Non Employee' and period='".$now."' and estate='".$_SESSION['estate']."' ");
                $sicknessnon = mysqli_num_rows($qnon);
$qnon1 = mysqli_query($con,"SELECT * from tblreport where category='Non Employee' and period='".$d1."' and estate='".$_SESSION['estate']."' ");
                $sicknessnon1 = mysqli_num_rows($qnon1);
$qnon2 = mysqli_query($con,"SELECT * from tblreport where category='Non Employee' and period='".$d2."' and estate='".$_SESSION['estate']."' ");
                $sicknessnon2 = mysqli_num_rows($qnon2);
$qnon3 = mysqli_query($con,"SELECT * from tblreport where category='Non Employee' and period='".$d3."' and estate='".$_SESSION['estate']."' ");
                $sicknessnon3 = mysqli_num_rows($qnon3);
$qnon4 = mysqli_query($con,"SELECT * from tblreport where category='Non Employee' and period='".$d4."' and estate='".$_SESSION['estate']."' ");
                $sicknessnon4 = mysqli_num_rows($qnon4);
$qnon5 = mysqli_query($con,"SELECT * from tblreport where category='Non Employee' and period='".$d5."' and estate='".$_SESSION['estate']."' ");
                $sicknessnon5 = mysqli_num_rows($qnon5);
$qnon6 = mysqli_query($con,"SELECT * from tblreport where category='Non Employee' and period='".$d6."' and estate='".$_SESSION['estate']."' ");
                $sicknessnon6 = mysqli_num_rows($qnon6);
$qnon7 = mysqli_query($con,"SELECT * from tblreport where category='Non Employee' and period='".$d7."' and estate='".$_SESSION['estate']."' ");
                $sicknessnon7 = mysqli_num_rows($qnon7);
$qnon8 = mysqli_query($con,"SELECT * from tblreport where category='Non Employee' and period='".$d8."' and estate='".$_SESSION['estate']."' ");
                $sicknessnon8 = mysqli_num_rows($qnon8);
$qnon9 = mysqli_query($con,"SELECT * from tblreport where category='Non Employee' and period='".$d9."' and estate='".$_SESSION['estate']."' ");
                $sicknessnon9 = mysqli_num_rows($qnon9);
$qnon10 = mysqli_query($con,"SELECT * from tblreport where category='Non Employee' and period='".$d10."' and estate='".$_SESSION['estate']."' ");
                $sicknessnon10 = mysqli_num_rows($qnon10);

/*
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
*/

$dataPoints = array(
    array("label"=> $now, "y"=>$sickness),
    array("label"=> $d1, "y"=> $sickness1),
    array("label"=> $d2, "y"=> $sickness2),
    array("label"=> $d3, "y"=> $sickness3),
    array("label"=> $d4, "y"=> $sickness4),
    array("label"=> $d5, "y"=> $sickness5),
    array("label"=> $d6, "y"=> $sickness6),
    array("label"=> $d7, "y"=> $sickness7),
    array("label"=> $d8, "y"=> $sickness8),
    array("label"=> $d9, "y"=> $sickness9),
    array("label"=> $d10, "y"=>$sickness10),
);
 
 $dataPointod = array(
    array("label"=> $now, "y"=>$sicknessod),
    array("label"=> $d1, "y"=> $sicknessod1),
    array("label"=> $d2, "y"=> $sicknessod2),
    array("label"=> $d3, "y"=> $sicknessod3),
    array("label"=> $d4, "y"=> $sicknessod4),
    array("label"=> $d5, "y"=> $sicknessod5),
    array("label"=> $d6, "y"=> $sicknessod6),
    array("label"=> $d7, "y"=> $sicknessod7),
    array("label"=> $d8, "y"=> $sicknessod8),
    array("label"=> $d9, "y"=> $sicknessod9),
    array("label"=> $d10, "y"=>$sicknessod10),
); 

 $dataPointofd = array(
    array("label"=> $now, "y"=>$sicknessofd),
    array("label"=> $d1, "y"=> $sicknessofd1),
    array("label"=> $d2, "y"=> $sicknessofd2),
    array("label"=> $d3, "y"=> $sicknessofd3),
    array("label"=> $d4, "y"=> $sicknessofd4),
    array("label"=> $d5, "y"=> $sicknessofd5),
    array("label"=> $d6, "y"=> $sicknessofd6),
    array("label"=> $d7, "y"=> $sicknessofd7),
    array("label"=> $d8, "y"=> $sicknessofd8),
    array("label"=> $d9, "y"=> $sicknessofd9),
    array("label"=> $d10, "y"=>$sicknessofd10),
); 
$dataPointnot = array(
    array("label"=> $now, "y"=>$sicknessnot),
    array("label"=> $d1, "y"=> $sicknessnot1),
    array("label"=> $d2, "y"=> $sicknessnot2),
    array("label"=> $d3, "y"=> $sicknessnot3),
    array("label"=> $d4, "y"=> $sicknessnot4),
    array("label"=> $d5, "y"=> $sicknessnot5),
    array("label"=> $d6, "y"=> $sicknessnot6),
    array("label"=> $d7, "y"=> $sicknessnot7),
    array("label"=> $d8, "y"=> $sicknessnot8),
    array("label"=> $d9, "y"=> $sicknessnot9),
    array("label"=> $d10, "y"=>$sicknessnot10),
); 

$dataPointnon = array(
    array("label"=> $now, "y"=>$sicknessnon),
    array("label"=> $d1, "y"=> $sicknessnon1),
    array("label"=> $d2, "y"=> $sicknessnon2),
    array("label"=> $d3, "y"=> $sicknessnon3),
    array("label"=> $d4, "y"=> $sicknessnon4),
    array("label"=> $d5, "y"=> $sicknessnon5),
    array("label"=> $d6, "y"=> $sicknessnon6),
    array("label"=> $d7, "y"=> $sicknessnon7),
    array("label"=> $d8, "y"=> $sicknessnon8),
    array("label"=> $d9, "y"=> $sicknessnon9),
    array("label"=> $d10, "y"=>$sicknessnon10),
);

$dataPointmch = array(
    array("label"=> $now, "y"=> $mch),
    array("label"=> $d1, "y"=> $mch1),
    array("label"=> $d2, "y"=> $mch2),
    array("label"=> $d3, "y"=> $mch3),
    array("label"=> $d4, "y"=> $mch4),
    array("label"=> $d5, "y"=> $mch5),
    array("label"=> $d6, "y"=> $mch6),
    array("label"=> $d7, "y"=> $mch7),
    array("label"=> $d8, "y"=> $mch8),
    array("label"=> $d9, "y"=> $mch9),
    array("label"=> $d10, "y"=>$mch10),
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
        text: "Treatment category For Employees in the last 10 years"
    },
    axisY: {
        title: "Number of Patients"
    },
    data: [
    {
        type: "spline",
        name:"Sickness (employees)",
        showInLegend:true,
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    },
    {
        type: "spline",
        name:"On-Duty Injury (employees)",
        showInLegend:true,
        dataPoints: <?php echo json_encode($dataPointod, JSON_NUMERIC_CHECK); ?>
    },
    {
        type: "spline",
        name:"Off-Duty Injury (employees)",
        showInLegend:true,
        dataPoints: <?php echo json_encode($dataPointofd, JSON_NUMERIC_CHECK); ?>
    },
    {
        type: "spline",
        name:"Dependants",
        showInLegend:true,
        dataPoints: <?php echo json_encode($dataPointnot, JSON_NUMERIC_CHECK); ?>
    },
    {
        type: "spline",
        name:"Non Employees",
        showInLegend:true,
        dataPoints: <?php echo json_encode($dataPointnon, JSON_NUMERIC_CHECK); ?>
    },
    {
        type: "spline",
        name:"MCH",
        showInLegend:true,
        dataPoints: <?php echo json_encode($dataPointmch, JSON_NUMERIC_CHECK); ?>
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