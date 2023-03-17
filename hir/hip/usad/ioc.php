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
            width: 45px;
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
        .scrollable {
    height: 500px; /* or any value */
    overflow-y: auto;
}
a{text-decoration:none;color:#000;}
#myList{
     display: inline-block;
}
    </style>
    <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
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
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                    <a href="db.php" title="Go back"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go back"></i> Back</a>&nbsp;&nbsp;&nbsp;
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
                    <div class="row">

                                <div class="box-body table-responsive">
                                    <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                
                                                <th style="width: 15px !important;"><i class="fa fa-list"></i></th>
                                                <th>Customer ID</th>
                                                <th>Full Name </th>
                                                <th>Total Items Hired</th>
                                                <th style="text-align:center;">Receipts</th>
                                                <th style="width: 40px !important;text-align:center;">Preview</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
                                            $c=1;
                                            $date = date("Y-m-d h:i:sa");
                                            
                                            $qry  = "SELECT DISTINCT a.client, b.identity,b.fname,mname,lname 
                                            FROM tblleased a 
                                            LEFT JOIN tblcustomers b ON a.client=b.identity 
                                            WHERE a.rdate < '".$date."' and a.company='".$_SESSION['company']."' and a.comment !='cleared'
                                            ORDER BY a.client ";

                                            $res = mysqli_query($con, $qry);
                                                while ($rows = mysqli_fetch_array($res))
                                                  { 
                                          $client = $rows['client'];
                                          
                                         $sum=mysqli_query($con,'select sum(qnty) as product from tblleased WHERE client = "'.$client.'" and rdate < "'.$date.'" and company="'.$_SESSION['company'].'" ');
                                            $ttle = mysqli_fetch_array($sum);
                                            
                                           $sm =   $ttle['product'];
                                           
                                           
                                         $z=$ttle['item_name_id'];
                                    $q = "SELECT * FROM tbloverdate where item_name_id_overdue ='".$z."' and client='".$client."' ";
                                            $query_run = mysqli_query($con,$q);

                                            $paid= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $paid += $num['payment'];
                                            }
                                            
                                            date_default_timezone_set('Africa/Nairobi');
                                            $time2 = strtotime(date("Y-m-d-m-Y h:i:sa"));
                                            $time1 = strtotime($row['rdate']);
                                            $dif   = floor( ($time2-$time1) /(60*60*24));
                                            $overdue =($ttle['overdue_charges'] * $dif * $ttle['qnty']);

                                            $bal=$overdue - $paid;
                                                  
                                                echo '
                                            
                                            <tr> 
                                                <td><a href=penalties-invoice.php?tm='.$rows['client'].' target="_blank"><img src="../../images/icons/folder_open.png" class="iconb" ></a></td>
                                        
                                                <td><a href=penalties-invoice.php?tm='.$rows['client'].' target="_blank">'.$rows['client'].'</a></td> 
                                                <td><a href=penalties-invoice.php?tm='.$rows['client'].' target="_blank">'.ucwords($rows['fname']).' '.ucwords($rows['mname']).' '.ucwords($rows['lname']).'</a></td>
                                                <td><a href=penalties-invoice.php?tm='.$rows['client'].' target="_blank">'.number_format($sm,0).'</a></td>
                                                
                                                <td><center><a href="overdue-transactions.php?tjk78wenm4yuwernmnmzxcyunmnmztye7834nm434nm43rf//578nmsdjn//sdfjkmerime='.$rows['client'].'"><img src="../../images/icons/eye.png" title="Edit this record" class="iconb"></a></center></td>
                                        
                                                
                                                <td><a class="btn btn-success" href=penalties-invoice.php?tm='.$rows['client'].' target="_blank">Preview</a></td>  
                                                </tr>
                                                
                                                ';
                                                
                                                include "editpay.php";
                                            
                                                  }
                                            ?>
                                        </tbody>
                                    </table>
                                    </form>
                                    
                                      </div>
                                   
                    <script>
                        function myFunction() {
                          var input, filter, img, tr, td, i, txtValue;
                          input = document.getElementById("myInput");
                          filter = input.value.toUpperCase();
                          table = document.getElementById("myTable");
                          tr = table.getElementsByTagName("tr");
                          for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[0];
                            if (td) {
                              txtValue = td.textContent || td.innerText;
                              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                              } else {
                                tr[i].style.display = "none";
                              }
                            }       
                          }
                        }
                        </script>

                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


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
</html><?php
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
                <form method="post">
                <section class="content-header">
                    <a href="db.php"><img src="../../images/icons/home.png" title="Go home" class="icon"></a>

                    <a href="acc.php"><img src="../../images/icons/add.png" title="Add new account" class="icon"></a>

                    <a data-toggle="modal" data-target="#deleteAcc"><img src="../../images/icons/delete.png" title="Delete selected data" class="icon"></a>
                       
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">

                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding-left:10px;">
                                        <h4 style="color: teal;font-weight: bold">Overdue charges invoices</h4>
                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <!--th style="width: 20px !important;"><input type="checkbox" name="chk_delacc[]" class="cbxMain" onchange="checkMain(this)" /></th-->
                                                <th style="width: 15px !important;"><i class="fa fa-list"></i></th>
                                                <th style="width: 100px !important;">Customer ID</th>
                                                <th style="width: 300px !important;">Full Name </th>
                                                <th style="width: 20px !important;">Print</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                                $query = mysqli_query($con, "select * from tblleased where damaged>'0' and comment='not cleared' group by client ");
                                                while($row = mysqli_fetch_array($query))
                                            {
                                                $r=$row['client'];
                                                $c = mysqli_query($con, "select * from tblcustomers where identity='".$r."' ");
                                                while($data = mysqli_fetch_array($c))
                                            {
                                                $fname=$data['fname'];
                                                $mname=$data['mname'];
                                                $lname=$data['lname'];
                                                echo '
                                            <tr>
                                                <!--td><input type="checkbox" name="chk_delacc[]" class="chk_delete" value="" /></td--> 
                                                <td><a href=iocr.php?cl='.$row['client'].' target="_blank"><img src="../../images/icons/folder_open.png" class="iconb"title="Print invoice: '.$row['client'].'"></a></td>
                                                <td>'.$row['client'].'</td> 
                                                <td>'.$data['fname'].' '.$data['mname'].' '.$data['lname'].'</td> 
                                                <td><center><a href=iocr.php?cl='.$row['client'].' target="_blank"><img src="../../images/icons/print.png" title="Print invoice: '.$row['client'].'" class="iconb"></a></center></td>                             
                                                </tr>
                                                ';
                                                
                                                //include "editaccl.php";
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
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>