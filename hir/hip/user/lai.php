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
            width: 30px;
            padding-right: 10px;
        }
        .iconb{
            width: 30px;
            padding-right: 10px;
        }
        .icon:hover{
            transition: 0.3s;
            /*box-shadow: 2px 0px 20px rgba(0, 0, 0, 0.8);*/
        }
        .sidebar-menu .ocr{
        background-color:#009999;
    }
    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <?php
                function RandomString($length) {
                    $keys = array_merge(range(0,9));
                        $key = "";
                        for($i=0; $i < $length; $i++) {
                        $key .= $keys[mt_rand(0, count($keys) - 1)];
                    }
                        return $key;               
                }
            ?>
         
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                     <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    <a href="inventory.php" title="Inventory"><i class="fa fa-angle-double-left" aria-hidden="true" title="Inventory"></i> Inventory</a>&nbsp;&nbsp;&nbsp;
                    <a href="ocr.php" title="Lease item"><i class="fa fa-refresh" aria-hidden="true" title="Lease item"></i> Lease items</a>&nbsp;&nbsp;&nbsp;

                    <a href="laiEx.php" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to Excel</a>
                    
                    &nbsp;&nbsp;&nbsp;

                    <a href="javascript:void(0)" onclick="javascript:window.open('laipr.php', '_Details', 'width=1000, height=700, scrollbars=1, resizable=1');"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Print</a>
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                          <!--form action="lair.php" class="search-box" method="post">
                      <input type="text" class="text search-input" name="searchq" placeholder="Search by..."  /><input type="submit" class="fa fa-search" style="padding:4px" value="Print"  />
                    </form-->
                        <div class="box-body table-responsive">  
                                <p>Leased Items <span style="float:right"> 
                            <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Client</th>
                                                <th>ID No.</th>
                                                <th>Item</th>
                                                <th>Invoice No.</th>
                                                <th>Leased date</th>
                                                <th>Returning Date</th>
                                                <th>Qnty</th>
                                                <th><center>@</center></th>
                                                <th>Amount</th>
                                                
                                                <th>View</th
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $date=date("Y-m-d");
                                            $c=1;

                                            $query  = "SELECT tblcustomers.fname,tblcustomers.mname,tblcustomers.lname, tblitems.id, tblitems.item_name,tblleased.invoice,tblleased.qnty,tblleased.qlty,tblleased.ldate,tblleased.rdate, tblleased.served_by,tblleased.item_name_id,tblleased.item_id,tblleased.price,tblleased.client
                                                FROM 
                                                tblcustomers
                                                LEFT JOIN tblleased 
                                                ON tblcustomers.identity = tblleased.client
                                                LEFT JOIN tblitems 
                                                ON tblitems.id = tblleased.item_name_id where tblleased.company='".$_SESSION['company']."' ORDER BY id DESC";
                                                $result = mysqli_query($con, $query);

                                                while ($row = mysqli_fetch_array($result))
                                                                    { 
                                                        $ldate = date('Y-m-d',strtotime(ucwords($row['ldate'])));
                                                        $rdate = date('Y-m-d',strtotime(ucwords($row['rdate'])));
                                                        $amount = ($row['price'] * $row['qnty']);
                                                        $fullname = ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']);
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td>
                                                <td>'.ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']).'</td>
                                                <td>'.ucwords($row['client']).'</td>
                                                <td>'.ucwords($row['item_name']).'</td>
                                                <td>'.$row['invoice'].'</td>
                                                <td>'.$ldate.'</td>
                                                <td>'.$rdate.'</td>
                                                <td>'.$row['qnty'].'</td>
                                                <td align="right">'.number_format($row['price'],2).'</td>
                                                <td align="right">'.number_format($amount,2).'</td>
                                                 
                                                <td><center><a data-target="#viewlai'.$row['client'].'" data-toggle="modal"><img src="../../images/icons/eye.png" title="View this record" class="iconb"></a></center></td>                                   
                                                </tr>
                                                ';?>
                                                                                       <!-- The Modal -->
                                <div class="modal fade" id="viewlai<?php echo $row['client']?>">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                
                                      <!-- Modal Header -->
                                      <div class="modal-header" style="background:#f2f2f2;">
                                        <h4 class="modal-title" style="color:#000"> <?php echo $fullname."'s Leased Items Report" ;?> </h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                
                                      <!-- Modal body -->
                                      <div class="modal-body ">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-1">
                                                       <h4>Items</h4> 
                                                       <p><?php echo ucwords($row['item_name']);?></p>
                                                    </div>
                                                     <div class="col-lg-3">
                                                        <h4>Lease Date</h4>
                                                        <p><?php echo ucwords($row['ldate']);?></p>
                                                    </div>
                                                     <div class="col-lg-3">
                                                        <h4>Return Date</h4>
                                                        <p><?php echo ucwords($row['rdate']);?></p>
                                                    </div> 
                                                    <div class="col-lg-3">
                                                        <h4>Quantity</h4>
                                                        <p><?php echo ucwords($row['qnty']);?></p>
                                                    </div>
                                                     <div class="col-lg-2">
                                                        <h4>Charges</h4>
                                                        <p><?php echo number_format($amount,2);?></p>
                                                    </div>
                                                </div>
                                                   <a href="" class="btn btn-success">Print</a>
                                            </div>
                                      </div>
                                
                                      
                                
                                    </div>
                                  </div>
                                </div>
                                <!--End view lai modal-->
                                                <?php
                                                
                                                //include "editlsd.php";
                                            }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    </form>

                  </div>
                </div>
               </section><!-- /.content -->
             
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->  
  
                <!-- jQuery 2.0.2 -->
        <?php 
        include "../footer.php"; ?>
          <script type="text/javascript">
          function goBack() {
           window.history.back();
           }
              $(function() {
                  $("#table").dataTable({
                     "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
                  });
              });
          </script>        
    </body>
</html>



