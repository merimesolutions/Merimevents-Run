<?php
 session_start();
if (!isset($_SESSION['merime'])){
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
<!DOCTYPE html>
<html>
    <?php include('../head_css.php'); ?>
    <style type="text/css">
.panel:hover {
  background-color: lightblue;
    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>
      
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../admin-side-bar.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                </section>

                <!-- Main content -->
                <section class="content">
                    <label>Dashboard</label>
                    <div class="row">

                        <div class="main-content">
                    <div class="wrap-content container" id="container" style="width: 100%;height: 100%;">
                        <!-- start: PAGE TITLE -->
                        
                        <!-- end: PAGE TITLE -->
                        <!-- start: BASIC EXAMPLE -->
                            <div class="container-fluid container-fullw" style="/*border-radius: 10px;background: linear-gradient(to top right, #a8e8e4 22%, #b7cad2 49%)*/">

                                <!--background-image: linear-gradient(red, yellow, green);box-shadow: 2px 0px 20px rgba(0, 0, 0, 0.8);-->
                            <div class="row">
                                <br>
                                <div class="col-sm-4">
                                    <a href="active.php" title="Leased Items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"> <img src="../../images/icons/active.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;">Active Accounts </span>
                                        <span style="color:#000;float:right;"> <?php
                                            $date=date("d-m-Y");
                                            $q = mysqli_query($con,"SELECT * from tblstaff where status='active'");
                                            $num_rows = mysqli_num_rows($q);
                                            echo number_format($num_rows,0);
                                        ?></span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="inactive.php" title="Leased Items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-1x"> <img src="../../images/icons/inactive.png" class="icon"> </span>
                                            <span style="color:#000;margin-left: 7px;">Inactive Accounts </span>
                                        <span style="color:#000;float:right;"> <?php
                                            $date=date("d-m-Y");
                                            $q = mysqli_query($con,"SELECT * from tblstaff where status='inactive'");
                                            $num_rows = mysqli_num_rows($q);
                                            echo number_format($num_rows,0);
                                        ?></span>
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <br>
                                    <label>Database Traffic</label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Database Traffic</th>
                                            <th>Items available</th>
                                            <th>Average based on Companies</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td><img src="../../images/icons/leased.png" class="iconc">
                                            <span style="color:#000;margin-left: 7px;">All Leasing Traffic </span></td>
                                            <td><?php
                                            $query = "SELECT * FROM tblleased ";
                                            $query_run = mysqli_query($con,$query);

                                            $qty= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $y += $num['bal_qnty'];
                                            }
                                            echo number_format($y,0);
                                        ?></td>
                                            <td>
                                                <?php 
                                            $query = "SELECT * FROM tblleased ";
                                            $query_run = mysqli_query($con,$query);

                                            $y= 0.00000000000000000000000000001;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $y += $num['bal_qnty'];
                                            }
                                            $n= 0.00000000000000000000000000001; 
                                            $ccc = mysqli_query($con,"SELECT * from tblstaff ");
                                            $ws = mysqli_num_rows($ccc);
                                            $n = number_format($ws,0);
                                            echo round($y/$n,0);
                                            
                                                ?>
                                            </td>
                                            </tr>
                                            
                                            <tr>
                                            <td><img src="../../images/icons/stock.png" class="iconc">
                                            <span style="color:#000;margin-left: 7px;">Stock Traffic</span></td>
                                            <td><?php
                                                $company=$_SESSION['company'];
                                                $query  = "SELECT SUM(qnty) AS stock FROM tblitems ";
                                                $result = mysqli_query($con, $query);
                                                    while ($row = mysqli_fetch_array($result))
                                                                      { 
                                                $qry  = "SELECT SUM(bal_qnty) AS sum ,SUM(damaged) AS damaged FROM tblleased ";
                                                
                                                $r = mysqli_query($con, $qry);
                                                        while ($rows = mysqli_fetch_assoc($r))
                                                                      {
                                                        $d='0';                  
                                                        $bal = $row['stock'] - $rows['sum'];
                                                        echo number_format($bal,0);
                                                  }
                                                  }
                                        ?> </td>
                                            <td>
                                                <?php
                                                $company=$_SESSION['company'];
                                                $query  = "SELECT SUM(qnty) AS stock FROM tblitems ";
                                                $result = mysqli_query($con, $query);
                                                    while ($row = mysqli_fetch_array($result))
                                                                      { 
                                                $qry  = "SELECT SUM(bal_qnty) AS sum ,SUM(damaged) AS damaged FROM tblleased ";
                                                
                                                $r = mysqli_query($con, $qry);
                                                        while ($rows = mysqli_fetch_assoc($r))
                                                                      {
                                                        $bal=0.00000000000000000000000000001;                  
                                                        $bal = $row['stock'] - $rows['sum'];
                                                       // echo number_format($bal,0);
                                                
                                                $n= 0.00000000000000000000000000001; 
                                                $ccc = mysqli_query($con,"SELECT * from tblstaff ");
                                                $ws = mysqli_num_rows($ccc);
                                                $n = number_format($ws,0);
                                                echo round($bal/$n,0);
                                                  }
                                                  }
                                            ?> 
                                            </td>
                                            </tr>
                                            
                                            
                                            
                                            <tr>
                                            <td><img src="../../images/icons/broken.png" class="iconc">
                                            <span style="color:#000;margin-left: 7px;">Damaged items</span></td>
                                            <td><?php
                                            $query = "SELECT * FROM tblleased where damaged>'0' and comment = 'not cleared' ";
                                            $query_run = mysqli_query($con,$query);

                                            $qty= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $qty += $num['damaged'];
                                            }
                                            echo number_format($qty,0);
                                        ?> </td>
                                            <td>
                                            <?php
                                            $query = "SELECT * FROM tblleased where damaged>'0' and comment = 'not cleared' ";
                                            $query_run = mysqli_query($con,$query);

                                            $qty= 0.00000000000000000000000000001 ;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $qty += $num['damaged'];
                                            }
                                            //echo number_format($qty,0);
                                            $n= 0.00000000000000000000000000001; 
                                                $ccc = mysqli_query($con,"SELECT * from tblstaff ");
                                                $ws = mysqli_num_rows($ccc);
                                                $n = number_format($ws,0);
                                                echo round($qty/$n,0);
                                        ?> 
                                            </td>
                                            </tr>
                                            
                                            
                                            
                                            <tr>
                                            <td><img src="../../images/icons/overdue.png" class="iconc">
                                            <span style="color:#000;margin-left: 7px;">Overdue items </span></td>
                                            <td><?php
                                            $date=date("Y-m-d");
                                            $q = mysqli_query($con,"SELECT * from tblleased where rdate<'".$date."' ");
                                            $num_rows = mysqli_num_rows($q);
                                            echo number_format($num_rows,0);
                                        ?></td>
                                            <td>
                                            <?php
                                            $date=date("Y-m-d");
                                            $q = mysqli_query($con,"SELECT * from tblleased where rdate<'".$date."' ");
                                            $num_rows = mysqli_num_rows($q);
                                            //echo number_format($num_rows,0);
                                            
                                            $n= 0.00000000000000000000000000001; 
                                                $ccc = mysqli_query($con,"SELECT * from tblstaff ");
                                                $ws = mysqli_num_rows($ccc);
                                                $n = number_format($ws,0);
                                                echo round($num_rows/$n,0);
                                            ?>
                                            </td>
                                            </tr>
                                            
                                            
                                            
                                            <tr>
                                            <td><img src="../../images/icons/returned.png" class="iconc">
                                            <span style="color:#000;margin-left: 7px;">Returnined items</span></td>
                                            <td><?php
                                            $query = "SELECT * FROM tblleased ";
                                            $query_run = mysqli_query($con,$query);

                                            $qty= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $qty += $num['rqnty'];
                                            }
                                            echo number_format($qty,0);
                                        ?></td>
                                            <td>
                                                <?php
                                            $query = "SELECT * FROM tblleased ";
                                            $query_run = mysqli_query($con,$query);

                                            $qty= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $qty += $num['rqnty'];
                                            }
                                            //echo number_format($qty,0);
                                            
                                            $n= 0.00000000000000000000000000001; 
                                                $ccc = mysqli_query($con,"SELECT * from tblstaff ");
                                                $ws = mysqli_num_rows($ccc);
                                                $n = number_format($ws,0);
                                                echo round($qty/$n,0);
                                        ?>
                                            </td>
                                            </tr>
                                            
                                            
                                            
                                            <tr>
                                            <td><img src="../../images/icons/users.png" class="iconc">
                                            <span style="color:#000;margin-left: 7px;">Company customers </span></td>
                                            <td><?php
                                            $q = mysqli_query($con,"SELECT * from tblcustomers ");
                                            $num_rows = mysqli_num_rows($q);
                                            echo number_format($num_rows,0);
                                        ?></td>
                                            <td>
                                            <?php
                                            $q = mysqli_query($con,"SELECT * from tblcustomers ");
                                            $num_rows = mysqli_num_rows($q);
                                            //echo number_format($num_rows,0);
                                            
                                            $n= 0.00000000000000000000000000001; 
                                                $ccc = mysqli_query($con,"SELECT * from tblstaff ");
                                                $ws = mysqli_num_rows($ccc);
                                                $n = number_format($ws,0);
                                                echo round($num_rows/$n,0);
                                            ?>
                                            </td>
                                            </tr>
                                            
                                            
                                            <tr>
                                            <td><img src="../../images/icons/users.png" class="iconc">
                                            <span style="color:#000;margin-left: 7px;">Company registered </span></td>
                                            <td><?php
                                            $co = mysqli_query($con,"SELECT * from tblstaff ");
                                            $s = mysqli_num_rows($co);
                                            echo number_format($s,0);
                                        ?></td>
                                            <td>Nill</td>
                                            </tr>
                                            
                                            <tr>
                                            <td><img src="../../images/icons/project.png" class="iconc">
                                            <span style="color:#000;margin-left: 7px;">Company projects</span></td>
                                            <td>
                                            <?php
                                            $q = mysqli_query($con,"SELECT * from tblprojects ");
                                            $num_rows = mysqli_num_rows($q);
                                            echo number_format($num_rows,0);
                                            ?>
                                            </td>
                                            <td>
                                                <?php
                                            $q = mysqli_query($con,"SELECT * from tblprojects ");
                                            $num_rows = mysqli_num_rows($q);
                                            //echo number_format($num_rows,0);
                                            
                                            $n= 0.00000000000000000000000000001; 
                                                $ccc = mysqli_query($con,"SELECT * from tblstaff ");
                                                $ws = mysqli_num_rows($ccc);
                                                $n = number_format($ws,0);
                                                echo round($num_rows/$n,0);
                                            ?>
                                            </td>
                                            </tr>
                                        </tbody>
                                            
                                    </table>
                                </div>
                            </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>