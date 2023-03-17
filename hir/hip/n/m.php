<?php
  session_start();
/*if (!isset($_SESSION['userid'])){
    require "../redirect.php";
}else{
    $now=time();
    if ($now > $_SESSION['expire']){
        session_destroy();
        require "../redirect.php"; 
    }else{        
    }
}*/
if (!isset($_GET['pay'])){
    require "../redirect.php";
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
p{font-size: 18px;}

    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        ob_start();
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
                              <div class="col-sm-6">
                  <form action="stkpay.php" method="POST">
                    <div class="form-group">
                      <p>Lipa na mpesa / Use Mpesa to pay</p>
                      <small class="form-text text-muted">Fill the form below.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Package selected</label>
                      <input type="text" disabled class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" Value="<?php echo $_GET['package']; ?>">
                      </div>
                      <div class="form-group">
                      <label for="exampleInputEmail1">Amount</label>
                      <input type="text" disabled class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" Value="<?php echo $_GET['pay']; ?> /=">
                      </div>
                      <div class="form-group">
                      <label for="exampleInputEmail1">Mpesa phone number </label> <small> (254712345678)</small>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="254712345678" required maxlength="12"/>
                      </div>
                      <div class="form-group">
                      <!--label for="exampleInputEmail1">Amount</label-->
                      <input type="hidden" class="form-control" id="amount" name="amount" value="<?php echo $_POST['pay']; ?>">
                      </div>
                      <div class="form-group">
                      <button type="submit" class="btn btn-primary">Submit</button> <a href="d.php">Choose diffrent package</a>
                  </form>
                </div>
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