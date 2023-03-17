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
<!DOCTYPE html>
<html>
    <?php include('../head_css.php'); ?>
    <style type="text/css">
        .icon{
            width: 40px;
            padding-right: 10px;
        }
        .iconb{
            width: 30px;
            padding-right: 10px;
        }
        button .btn:hover{
           background-color: red;
        }
    .panel:hover {
  background-color: lightblue;
}
p{font-size: 16px;}

    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>
      
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->

                <!-- Main content -->
                <section class="content">
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
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body" style="background-color: gray; color: #fff">
                                            <h2 class="text-center">Basic Package </h2>
                                            <h3 class="text-center">2,500 <sub>KES</sub></h3>
                                            <h4 class="text-center">Per month</h3>
                                            </div>
                                            
                                            








                                            <div class="panel-body">
                                            <p> Project (Event) management<span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p> 
                                            <p> Customer registration <span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p> 
                                            <p> Invoices <span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p> 
                                            <p> Reports <span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p>
                                            <p> 1 user account <span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p>
                                            
                                        <form action="m.php" method="GET">
                                            <input hidden type="text" value="<?php $_SESSION['company']; ?>" name="user"/>
                                            <input hidden type="text" value="Bronze Package" name="package"/>
                                            <input hidden type="text" value="1" name="pno"/>
                                            <button class="btn btn-success" style="border-radius: 20px;" type="submit" value="2500" name="pay">Make Payment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body" style="background-color: skyblue; color: #fff">
                                            <h2 class="text-center">Silver Package </h2>
                                            <h3 class="text-center">3,500 <sub>KES</sub></h3>
                                            <h4 class="text-center">Per month</h4>
                                            </div>
                                            <div class="panel-body">
                                            <p> Everything in Bronze Plus<span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p> 
                                            <p> Leasing items <span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p> 
                                            <p> Returning items <span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p> 
                                            <p> Inventory management <span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p>
                                            <p> 3 user account <span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p>
                                            
                                        <form action="m.php" method="GET">
                                            <input hidden type="text" value="<?php $_SESSION['company']; ?>" name="user"/>
                                            <input hidden type="text" value="Silver Package" name="package"/>
                                            <input hidden type="text" value="2" name="pno"/>
                                            <button class="btn btn-success" style="border-radius: 20px;" type="submit" value="3500" name="pay">Make Payment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body" style="background-color: orange; color: #fff">
                                            <h2 class="text-center">Premium Package </h2>
                                            <h3 class="text-center">5,000 <sub>KES</sub></h3>
                                            <h4 class="text-center">Per month</h3>
                                            </div>
                                            <div class="panel-body">
                                            <p> Everything in Silver Plus <span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p> 
                                            <p> Penalities <span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p> 
                                            <p> Unlimited users <span style="float:right"><i class="fa fa-check" style="color: green"></i></span></p> 
                                            
                                        <form action="m.php" method="GET">
                                            <input hidden type="text" value="<?php $_SESSION['company']; ?>" name="user"/>
                                            <input hidden type="text" value="Gold Package" name="package"/>
                                            <input hidden type="text" value="3" name="pno"/>
                                            <button class="btn btn-success" style="border-radius: 20px;" type="submit" value="5000" name="pay">Make Payment</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                
                                
            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <!--?php include "editfunction.php"; ?-->
            <!--?php include "deletefunction.php"; ?-->


                    </div>   <!-- /.row -->
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