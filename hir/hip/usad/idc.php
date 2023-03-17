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
        .sidebar-menu .invoices{
        background-color:#009999;
    }
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
                
                <section class="content-header">
                       <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                </section>

                <!-- Main content -->
                <section class="content">
                    
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding-left:10px;">
                                        
                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <form method="post">
                                    <p>Items damaged invoices</p>
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <!--th style="width: 20px !important;"><input type="checkbox" name="chk_delacc[]" class="cbxMain" onchange="checkMain(this)" /></th-->
                                                <th style="width: 15px !important;"><i class="fa fa-list"></i></th>
                                                <th style="width: 100px !important;">Customer ID</th>
                                                <th style="width: 300px !important;">Full Name </th>
                                                <th style="width: 20px !important;text-align:center;">Receipts </th>
                                                <th style="width: 20px !important;;text-align:center;">Preview </th>
                                                <th style="width: 20px !important;text-align:center;">Pay</th>
                                                <th style="width: 40px !important;text-align:center;">Edit</th>
                                                <th style="width: 20px !important;text-align:center;">Cancel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            // $x= mysqli_query($con,"SELECT tblcustomers.id, tblcustomers.fname,tblcustomers.mname,tblcustomers.lname,tblcustomers.identity,tblcustomers.fcontact, tblleased.client,tblleased.item_name_id,tblleased.qnty,tblleased.qlty,tblleased.rdate,tblleased.ldate,tblleased.served_by,tblleased.status,tblleased.damaged,tblleased.item_id,tblitems.item_name,tblitems.damage_charges
                                            // FROM 
                                            // tblcustomers 
                                            // LEFT JOIN tblleased 
                                            // ON tblcustomers.identity = tblleased.client 
                                            // LEFT JOIN tblitems 
                                            // ON tblitems.id = tblleased.item_name_id  
                                            // where damaged>'0' and comment = 'not cleared' and client='".$_GET['cl']."' ");
                                            // while($y=mysqli_fetch_array($x)){

                                            // }


                                                $query = mysqli_query($con, "SELECT * FROM tblleased WHERE damaged>0 AND comment='not cleared' AND company = '".$_SESSION['company']."' ");
                                                while($row = mysqli_fetch_array($query))
                                            {
                                                $r=$row['client'];
                                                $q=$row['qnty'];
                                                $p=$row['price'];
                                                $t=$row['total_cost'];
                                                $item_id = $row['item_name_id'];
                                                $money_q = mysqli_query($con,"SELECT * FROM tblitems where id = '$item_id '");
                                            $x = mysqli_fetch_assoc($money_q);
                                            $itenn=$x['item_name'];
                                                $c = mysqli_query($con, "SELECT * FROM tblcustomers WHERE identity='".$r."' ");
                                                while($data = mysqli_fetch_array($c))
                                            {
                                                $fname=$data['fname'];
                                                $mname=$data['mname'];
                                                $lname=$data['lname'];
                                                echo '
                                            <tr>
                                                <!--td><input type="checkbox" name="chk_delacc[]" class="chk_delete" value="" /></td--> 
                                                <td><a href=idcr.php?cl='.$row['client'].' target="_blank"><img src="../../images/icons/folder_open.png" class="iconb"title="Print invoice: '.$row['client'].'"></a></td>
                                                <td><a href=idcr.php?cl='.$row['client'].' target="_blank">'.$row['client'].'</a></td> 
                                                <td><a href=idcr.php?cl='.$row['client'].' target="_blank">'.ucwords($data['fname']).' '.ucwords($data['mname']).' '.ucwords($data['lname']).'</a></td> 
                                                <td><center><a href="transactions_dmg?dmg='.$row['client'].'"><img src="../../images/icons/eye.png" title="Preview invoice" class="iconb"></a></center></td>
                                                <td><center><a  href="idc-prev?cl='.$row['client'].'" target="_parent" class="form-control btn-success"><i class="fas fa-file-invoice"></i></a></center></td> 
                                                <td><center><a class="form-control btn btn-info" data-target="#editpay'.$row['invoice'].'" data-toggle="modal"><small>Pay</small></a></center></td>  
                                                <td><center><a class="form-control" data-target="#editid'.$row['invoice'].'" data-toggle="modal"><i class="nav-icon fas fa-edit"> </a></center></td>  
                                              <td><a class="form-control btn btn-danger" href="idc?invoice_delete='.$row['client'].'"><small>Cancel</small></a></td>                             
                                                </tr>
                                                ';  
// include "editid.php";
    echo '<div id="editpay'.$_GET['cl'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:350px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Update Payments</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['client'].'" name="hidden_id" id="hidden_id"/>
                <input type="hidden" value="'.$row['client'].'" name="invoice" id="invoice"/>
                <input type="hidden" value="'.$row['client'].'" name="company" id="invoice"/>
                <div class="form-group">
                    <label>Full name</label>
                    <input name="person" id="person" class="form-control input-sm" type="text" style="width:100%" value="" required placeholder="Name of Person paying" />
                    <br>
                </div>
                <div class="form-group">
                    <label>Identity (National ID / Passport)</label>
                    <input name="person_id" id="person_id" class="form-control input-sm" type="text" style="width:100%" value="" required placeholder="National ID / Passport" />
                    <br>
                </div>
                <div class="form-group">
                    <label>Amount Paid</label>
                    <input name="amount" id="amount" class="form-control input-sm" type="text" pattern="[0-9]+" style="width:100%" value="" required placeholder="Amount paid" />
                    <br>
                </div>
                <div class="form-group">
                    <label>Transaction code</label>
                    <input name="trans" id="trans" class="form-control input-sm" type="text" style="width:100%" value="" required placeholder="Mpesa Transaction ID / Cheque No. / etc" />
                    <br>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_pay" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';

include "editid.php";
                                            }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <?php include "../deleteModal.php"; ?>

                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
                </form>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
function goBack() {
           window.history.back();
           }
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>