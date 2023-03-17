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
    <script type="text/javascript">
    function print_page(){
        var ButtonControl = document.getElementById("btnprint");
        ButtonControl.style.visibility = "hidden";
        window.print();
    }
    </script>
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
            <section class="content-header">
                
                       <input type="button" style="background-color:transparent; color: teal" class="btn btn-sm btn-primary" id="btnprint" value="Print Report" onclick="print_page()">
            </section>

                <!-- Main content -->
      <section class="content">
        <div class="box"> 
          <div class="box-body table-responsive">            
            <div class="panel-heading" >
              <div class="container-fluid container-fullw bg-white">
                <div class="row">
                  <div class="col-md-12">
                   
                    <h4>Merime Solutions</h4>
                    <h5>List of leased items and payments</h5>
                    <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;">No.</th>
                                                <th>Item name</th>
                                                <th>Quantity</th>
                                                <th>Price (@)</th>
                                                <th>Amount</th>
                                                <th>Leased date</th>
                                                <th>Returning Date</th>
                                                <th>Leased by</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           
                                            $date=date("Y-m-d");
                                            $c=1;

                                            $query  = "SELECT tblitems.id, tblitems.item_name,tblleased.qnty,tblleased.qlty,tblleased.ldate,tblleased.rdate, tblleased.served_by,tblleased.item_name_id,tblleased.item_id,tblleased.price,tblleased.bal_qnty
                                                FROM 
                                                tblitems 
                                                LEFT JOIN tblleased 
                                                ON tblitems.id = tblleased.item_name_id 
                                             ORDER BY id DESC";
                                                $result = mysqli_query($con, $query);

                                                while ($row = mysqli_fetch_array($result))
                                                                    { 
                                                        $amount = ($row['price'] * $row['qnty']);
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['item_name']).'</td>
                                                <td>'.$row['qnty'].'</td>
                                                <td>'.$row['price'].'</td>
                                                <td>'.$amount.'</td>
                                                <td>'.ucwords($row['ldate']).'</td>
                                                <td>'.ucwords($row['rdate']).'</td> 
                                                <td>'.ucwords($row['served_by']).'</td>                                  
                                                </tr>
                                                ';
                                                
                                                include "editlsd.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->   
                <!-- jQuery 2.0.2 -->
        <?php 
        include "../footer.php"; ?>

    </body>
</html>



