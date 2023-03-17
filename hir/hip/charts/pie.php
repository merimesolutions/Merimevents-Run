
<?php
include "../connection.php";
            $date=date("Y-m-d");
            $q = mysqli_query($con,"SELECT * from tblreport where status='pharmacy' and today='$date' and estate='".$_SESSION['estate']."' ");
            $pharmacy = mysqli_num_rows($q);
            $z = mysqli_query($con,"SELECT * from tblmedicalhistory where status='new' and today='$date' and estate='".$_SESSION['estate']."' ");
            $new = mysqli_num_rows($z);
            $y = mysqli_query($con,"SELECT * from tblreport where status='labTest' and today='$date' and estate='".$_SESSION['estate']."' ");
            $labTest = mysqli_num_rows($y);
            $d = mysqli_query($con,"SELECT * from tblreport where status='finalDX' and today='$date' and estate='".$_SESSION['estate']."' ");
            $final = mysqli_num_rows($d);
            $w = mysqli_query($con,"SELECT * from tblmedicinedose where status='treated' and today='$date' and estate='".$_SESSION['estate']."' ");
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
        text: "Daily Patients Visit"
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
    <body class="skin-black">

                            <div class="container-fluid container-fullw bg-white">
                                <div class="btn btn-sm btn-default">
                                <a href="../charts/pie.php">Pie</a> | <a href="../charts/bar.php">Bar</a> | <a href="../charts/column.php">Column</a> | <a href="../charts/area.php">Area</a> | <a href="../charts/line.php">Line</a>
                                </div>
                                 | <div class="btn btn-sm btn-default"> <a href="../charts/wpie.php">Patients  treated for last 7 days </a> </div>
                            <div class="row">
                                <div id="chartContainer" style="height: 570px; width: 100%;"></div>
                        <script src="../canvasjs.min.js"></script>
                    </div>
                </div>
                                

    </body>
</html>