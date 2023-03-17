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
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                     <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    <a href="ani.php" title="Add new item(s) to stock"><i class="fa fa-tasks" aria-hidden="true" title="Add new item(s) to stock"></i> Restock</a>&nbsp;&nbsp;&nbsp;
                    <a href="dic.php" title="Set charges"><i class="fa fa-money" aria-hidden="true"></i> Set charges</a>&nbsp;&nbsp;&nbsp;
                    
                    <a href="aiEx.php" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to Excel</a>
                    &nbsp;&nbsp;&nbsp;

                    <a href="aipr.php" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Print</a>
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="">
                        <div class="box-body table-responsive" style="background:#fff;margin:20px;box-shadow: 5px 5px 5px 5px  #888888;padding:15px 10px;">  
                        <center>
                        <?php
                                       $company =$_SESSION['company'];
                                       $c =mysqli_query($con,"SELECT * FROM tblstaff WHERE company='$company'");
                                                         while($r =mysqli_fetch_assoc($c)){
                                                              $compname=$r['companyname'];
                                                              $location=$r['location'];
                                                              $email=$r['email'];
                                                              $contact=$r['contact'];
                                                              echo '<h3><center>'.ucwords($compname).'</center></h3> ';
                                                              echo '<h4><center>'.ucwords($location).'</center></h4> ';
                                                              echo '<h5><center>'.$email.'</center></h5> ';
                                                              echo '<h5><center>'.$contact.'</center></h5> ';
                                                         }
                                    ?></center>
                        <h2><center>Available stock</center></h2>
                               
                            <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;">No.</th>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Description</th>
                                                <th>Initial stock</th>
                                                <th>Stocked Date</th>
                                                <th>Damaged Qnty</th>
                                                <th>Current Qnty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                        $company=$_SESSION['company'];
                                        $query  = "SELECT tblitems.id, tblitems.item_name,tblitems.qnty,tblitems.qlty,tblitems.bno,tblitems.category, tblitems.added_date,tblitems.added_by,tblitems.company
                                                FROM 
                                                tblitems where company='".$company."' 
                                                ORDER BY tblitems.id desc";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                               $item = $row['id'] ;      
                            $qry  = "SELECT SUM(bal_qnty) AS sum ,SUM(damaged) AS damaged FROM tblleased where item_name_id='".$item."' ";
                            
                                $r = mysqli_query($con, $qry);
                                    while ($rows = mysqli_fetch_assoc($r))
                                                  {
                                    $d='0';                  
                                    $bal = $row['qnty'] - $rows['sum'];
                                    $d=$rows['damaged'];             
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['bno']).'</td>
                                                <td>'.ucwords($row['item_name']).'</td>  
                                                <td>'.ucwords($row['category']).'</td>
                                                <td>'.$row['qnty'].'</td>
                                                <td>'.ucwords($row['added_date']).'</td> 
                                                <td>'.$d.'</td>
                                                <td style="background-color:lightblue">'.$bal.'</td>
                                                </tr>
                                                ';
                                                
                                                //include "editlsd.php";
                                                  }   
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    </form>

                  </div>
            <?php include "../notification.php"; ?>
            <?php include "../addModal.php"; ?>
            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>
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
          </script>        
    </body>
</html>



