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
        .sidebar-menu .inventory{
        background-color:#009999;
    }
    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>
        <?php include('getroles.php'); ?>
         
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a href="inventory.php" title="Go back"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go back"></i> Back</a>&nbsp;&nbsp;&nbsp;
                          <?php if($ri_print==1){?>
                    <a href="../reports/air.php" target="_blank"><i class="fa fa-print" aria-hidden="true" title="Go back"> Print</i></a>
                             <?php }?>
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">  
                        <p style="color: teal;">Restock the current quantity</p>         
                            <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Batch No</th>
                                                <th>Item Name</th>
                                                <th>Qnty</th>
                                                <th>Quality</th>
                                                <th>Category</th>
                                                <?php if($ri_add==1){
                                                   echo '<th style="width:60px">Add</th>';
                                                }?>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $c=1;
                                        $company=$_SESSION['company'];
                                        $query  = "SELECT tblitems.id, tblitems.item_name,tblitems.qnty,tblitems.qlty,tblitems.bno,tblitems.category, tblitems.added_date,tblitems.added_by
                                                FROM 
                                                tblitems where company='".$company."' 
                                                ORDER BY tblitems.id desc";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                            
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['bno']).'</td>
                                                <td>'.ucwords($row['item_name']).'</td>  
                                                <td>'.$row['qnty'].'</td>
                                                <td>'.ucwords($row['qlty']).'</td>
                                                <td>'.ucwords($row['category']).'</td> 
                                                ';
                                                if($ri_add==1){
                                                    echo '
                                                <td><button class="btn btn-primary btn-sm" data-target="#editrei'.$row['id'].'" data-toggle="modal" style="width:60px"> + </button></td>';}
                                                                                  
                                                echo '</tr>
                                                ';
                                                
                                                include "editrei.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    </form>

             <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>

                  </div>
                </div>
               </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->   
                <!-- jQuery 2.0.2 -->
        <?php 
        include "../footer.php"; ?>
       
          <script type="text/javascript">
        
              $(function() {
                  $("#table").dataTable({
                     "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
                  });
              });
          </script>  
          <script>
    function myFunction(id,x,y){
          
       
          var x = x;
           
          var y= y;
          var z=Number(x) + Number(y);
          document.getElementById("summed_quantity"+id).innerHTML = z;
    }
</script>
    </body>
</html>



