<?php
include "../connection.php";
 $year=date('Y');
 $now=date('m');
 $jan="01";
 $feb="02";
 $march="03";
 $april="04";
 $may="05";
 $jun="06";
 $jul="07";
 $aug="08";
 $sep="09";
 $oct="10";
 $nov="11";
 $dec="12";
            
/*
//all estates
$m1 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jan."' and period='".$year."' ");
                $jang = mysqli_num_rows($m1); 
$m2 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$feb."' and period='".$year."' ");
                $febg = mysqli_num_rows($m2);
$m3 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$march."' and period='".$year."' ");
                $marchg = mysqli_num_rows($m3);
$m4 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$april."' and period='".$year."' ");
                $aprilg = mysqli_num_rows($m4);
$m5 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$may."' and period='".$year."' ");
                $mayg = mysqli_num_rows($m5);
$m6 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jun."' and period='".$year."' ");
                $jung = mysqli_num_rows($m6);
$m7 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jul."' and period='".$year."' ");
                $julg = mysqli_num_rows($m7);
$m8 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$aug."' and period='".$year."' ");
                $augg = mysqli_num_rows($m8);
$m9 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$sep."' and period='".$year."' ");
                $sepg = mysqli_num_rows($m9);
$m10 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$oct."' and period='".$year."' ");
                $octg = mysqli_num_rows($m10);
$m11 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$nov."' and period='".$year."' ");
                $novg = mysqli_num_rows($m11);
$m12 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$dec."' and period='".$year."' ");
                $decg = mysqli_num_rows($m12);*/

//all highlands
$mh1 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jan."' and period='".$year."' and estate='high' ");
                $janh = mysqli_num_rows($mh1); 
$mh2 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$feb."' and period='".$year."' and estate='high' ");
                $febh = mysqli_num_rows($mh2);
$mh3 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$march."' and period='".$year."' and estate='high' ");
                $marchh = mysqli_num_rows($mh3);
$mh4 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$april."' and period='".$year."' and estate='high' ");
                $aprilh = mysqli_num_rows($mh4);
$mh5 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$may."' and period='".$year."' and estate='high' ");
                $mayh = mysqli_num_rows($mh5);
$mh6 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jun."' and period='".$year."' and estate='high' ");
                $junh = mysqli_num_rows($mh6);
$mh7 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jul."' and period='".$year."' and estate='high' ");
                $julh = mysqli_num_rows($mh7);
$mh8 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$aug."' and period='".$year."' and estate='high' ");
                $augh = mysqli_num_rows($mh8);
$mh9 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$sep."' and period='".$year."' and estate='high' ");
                $seph = mysqli_num_rows($mh9);
$mh10 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$oct."' and period='".$year."' and estate='high' ");
                $octh = mysqli_num_rows($mh10);
$mh11 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$nov."' and period='".$year."' and estate='high' ");
                $novh = mysqli_num_rows($mh11);
$mh12 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$dec."' and period='".$year."' and estate='high' ");
                $dech = mysqli_num_rows($mh12);
//all arroket
$ma1 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jan."' and period='".$year."' and estate='arr' ");
                $jana = mysqli_num_rows($ma1); 
$ma2 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$feb."' and period='".$year."' and estate='arr' ");
                $feba = mysqli_num_rows($ma2);
$ma3 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$march."' and period='".$year."' and estate='arr' ");
                $marcha = mysqli_num_rows($ma3);
$ma4 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$april."' and period='".$year."' and estate='arr' ");
                $aprila = mysqli_num_rows($ma4);
$ma5 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$may."' and period='".$year."' and estate='arr' ");
                $maya = mysqli_num_rows($ma5);
$ma6 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jun."' and period='".$year."' and estate='arr' ");
                $juna = mysqli_num_rows($ma6);
$ma7 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jul."' and period='".$year."' and estate='arr' ");
                $jula = mysqli_num_rows($ma7);
$ma8 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$aug."' and period='".$year."' and estate='arr' ");
                $auga = mysqli_num_rows($ma8);
$ma9 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$sep."' and period='".$year."' and estate='arr' ");
                $sepa = mysqli_num_rows($ma9);
$ma10 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$oct."' and period='".$year."' and estate='arr' ");
                $octa = mysqli_num_rows($ma10);
$ma11 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$nov."' and period='".$year."' and estate='arr' ");
                $nova = mysqli_num_rows($ma11);
$ma12 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$dec."' and period='".$year."' and estate='arr' ");
                $deca = mysqli_num_rows($ma12);

//all monieri
$mmon1 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jan."' and period='".$year."' and estate='mon' ");
                $janmon = mysqli_num_rows($mmon1); 
$mmon2 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$feb."' and period='".$year."' and estate='mon' ");
                $febmon = mysqli_num_rows($mmon2);
$mmon3 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$march."' and period='".$year."' and estate='mon' ");
                $marchmon = mysqli_num_rows($mmon3);
$mmon4 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$april."' and period='".$year."' and estate='mon' ");
                $aprilmon = mysqli_num_rows($mmon4);
$mmon5 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$may."' and period='".$year."' and estate='mon' ");
                $maymon = mysqli_num_rows($mmon5);
$mmon6 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jun."' and period='".$year."' and estate='mon' ");
                $junmon = mysqli_num_rows($mmon6);
$mmon7 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$jul."' and period='".$year."' and estate='mon' ");
                $julmon = mysqli_num_rows($mmon7);
$mmon8 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$aug."' and period='".$year."' and estate='mon' ");
                $augmon = mysqli_num_rows($mmon8);
$mmon9 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$sep."' and period='".$year."' and estate='mon' ");
                $sepmon = mysqli_num_rows($mmon9);
$mmon10 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$oct."' and period='".$year."' and estate='mon' ");
                $octmon = mysqli_num_rows($mmon10);
$mmon11 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$nov."' and period='".$year."' and estate='mon' ");
                $novmon = mysqli_num_rows($mmon11);
$mmon12 = mysqli_query($con,"SELECT * from tblreport where status='treated' and month='".$dec."' and period='".$year."' and estate='mon' ");
                $decmon = mysqli_num_rows($mmon12);
/*
$dataPoints = array(
    array("label"=> "Jan", "y"=> $jang),
    array("label"=> "Feb", "y"=> $febg),
    array("label"=> "Mar", "y"=> $marchg),
    array("label"=> "Apr", "y"=> $aprilg),
    array("label"=> "May", "y"=> $mayg),
    array("label"=> "Jun", "y"=> $jung),
    array("label"=> "Jul", "y"=> $julg),
    array("label"=> "Aug", "y"=> $augg),
    array("label"=> "Sep", "y"=> $sepg),
    array("label"=> "Oct", "y"=> $octg),
    array("label"=> "Nov", "y"=> $novg),
    array("label"=> "Dec", "y"=> $decg),
);
 */
 $dataPointh = array(
    array("label"=> "Jan", "y"=> $janh),
    array("label"=> "Feb", "y"=> $febh),
    array("label"=> "Mar", "y"=> $marchh),
    array("label"=> "Apr", "y"=> $aprilh),
    array("label"=> "May", "y"=> $mayh),
    array("label"=> "Jun", "y"=> $junh),
    array("label"=> "Jul", "y"=> $julh),
    array("label"=> "Aug", "y"=> $augh),
    array("label"=> "Sep", "y"=> $seph),
    array("label"=> "Oct", "y"=> $octh),
    array("label"=> "Nov", "y"=> $novh),
    array("label"=> "Dec", "y"=> $dech),
); 

 $dataPointarr = array(
    array("label"=> "Jan", "y"=> $jana),
    array("label"=> "Feb", "y"=> $feba),
    array("label"=> "Mar", "y"=> $marcha),
    array("label"=> "Apr", "y"=> $aprila),
    array("label"=> "May", "y"=> $maya),
    array("label"=> "Jun", "y"=> $juna),
    array("label"=> "Jul", "y"=> $jula),
    array("label"=> "Aug", "y"=> $auga),
    array("label"=> "Sep", "y"=> $sepa),
    array("label"=> "Oct", "y"=> $octa),
    array("label"=> "Nov", "y"=> $nova),
    array("label"=> "Dec", "y"=> $deca),
); 

 $dataPointmon = array(
    array("label"=> "Jan", "y"=> $janmon),
    array("label"=> "Feb", "y"=> $febmon),
    array("label"=> "Mar", "y"=> $marchmon),
    array("label"=> "Apr", "y"=> $aprilmon),
    array("label"=> "May", "y"=> $maymon),
    array("label"=> "Jun", "y"=> $junmon),
    array("label"=> "Jul", "y"=> $julmon),
    array("label"=> "Aug", "y"=> $augmon),
    array("label"=> "Sep", "y"=> $sepmon),
    array("label"=> "Oct", "y"=> $octmon),
    array("label"=> "Nov", "y"=> $novmon),
    array("label"=> "Dec", "y"=> $decmon),
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
        text: "Patients Treated This Year"
    },
    axisY: {
        title: "Number of Patients"
    },
    data: [
    /*{
        type: "spline",
        name:"All Dispensaries",
        showInLegend:true,
        dataPoints: <!--?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?-->
    },*/
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