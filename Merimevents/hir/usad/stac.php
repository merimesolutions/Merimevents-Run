<?php
  session_start();
if (!isset($_SESSION['userid'])){
    require "../redirect.php";
}else{
    $now=time();
    if ($now > $_SESSION['expire']){
        session_destroy();
        require "../redirect.php"; 
    }else{        
    }
}
?>
<?php
include "../connection.php";
 $query = "SELECT * FROM tblleased where company='".$_SESSION['company']."' ";
        $query_run = mysqli_query($con,$query);
        $qty= 0;
        while ($num = mysqli_fetch_assoc ($query_run)) {
            $qty += $num['bal_qnty'];
                }
                
$company=$_SESSION['company'];
                            $query  = "SELECT SUM(qnty) AS stock FROM tblitems where company='".$company."' ";
                            $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_array($result))
                                                  { 
                            $qry  = "SELECT SUM(bal_qnty) AS sum ,SUM(damaged) AS damaged FROM tblleased where company='".$company."' ";
                            
                            $r = mysqli_query($con, $qry);
                                    while ($rows = mysqli_fetch_assoc($r))
                                                  {
                                    $d='0';                  
                                    $bal = $row['stock'] - $rows['sum'];
                        
                                                  }
                                                  }
                                                  
 $query = "SELECT * FROM tblleased where damaged>'0' and comment = 'not cleared' and company='".$_SESSION['company']."' ";
    $query_run = mysqli_query($con,$query);
        $damaged= 0;
        while ($num = mysqli_fetch_assoc ($query_run)) {
        $damaged += $num['damaged'];
                        }
                        
 $date=date("Y-m-d");
        $q = mysqli_query($con,"SELECT * from tblleased where rdate<'".$date."' and company='".$_SESSION['company']."' and comment !='cleared' ");
            $num_rows = mysqli_num_rows($q);
            
            
$qq = mysqli_query($con,"SELECT * from tblprojects where company='".$_SESSION['company']."' ");
            $num = mysqli_num_rows($qq);
            
                                          
$date=date("d-m-Y");
        $c = mysqli_query($con,"SELECT * from tblcustomers where company='".$_SESSION['company']."' ");
                                            $c = mysqli_num_rows($c); 
                                            
$r = "SELECT * FROM tblleased where company='".$_SESSION['company']."' ";
                $query_run = mysqli_query($con,$r);

                                            $rr= 0;
                    while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $rr += $num['rqnty'];
                                            }
?>
<?php
 
$dataPoints = array(
    /*array("label"=> "Stock Available", "y"=> $bal),*/
    array("label"=> "Leased Items", "y"=> $qty),
    array("label"=> "Damaged Items", "y"=> $damaged),
    array("label"=> "Overdue Items", "y"=> $num_rows),
    array("label"=> "Returned Items", "y"=> $rr),
    array("label"=> "Projects", "y"=> $num),
    array("label"=> "Customers", "y"=> $c),
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
        text: "Statistics"
    },
    axisY: {
        title: "Number of entities"
    },
    data: [{
        type: "pie",
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
                                  
							<div class="row">
                                
                                <div id="chartContainer" style="height: 550px; width: 98%;"></div>
                                
                        <script src="../canvasjs.min.js"></script>
                    </div>
                </div>


    </body>
</html>