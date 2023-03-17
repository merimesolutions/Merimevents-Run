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
        .sidebar-menu .reports{
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
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                     <a href="prr" aria-hidden="true" target="_blank"><i class="fa fa-print" ></i> Print</a>
                     
                    
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
                                    ?>  
                                <h2>Task assigments</h2> </center>       
                            <form method="post">
                                    <table id="table" class="table  table">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px !important;">No.</th>
                                                <th>Projects</th>
                                                <th>Started</th>
                                                <th>Deadline</th>
                                                <th>Status</th>
                                                <th>Tasks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $task=0;
                                            $date=date("Y-m-d");
                                            $query  = "SELECT tblprojects.id, tblprojects.project,tblprojects.description, tblprojects.deadline,tblprojects.started,tblprojects.status
                                                FROM 
                                                tblprojects
                                                where company='".$_SESSION['company']."'
                                                ORDER BY id desc";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                      

                                            echo '
                                            <tr>
                                                <td style="vertical-align: text-top;">'.$c++.'</td> 
                                                <td style="vertical-align: text-top;">'.ucwords($row['project']).'</td>
                                                <td style="vertical-align: text-top;">'.ucwords($row['started']).'</td>  
                                                <td style="vertical-align: text-top;">'.$row['deadline'].'</td>
                                                <td style="vertical-align: text-top;">'.ucwords($row['status']).'</td> 
                                                <td>
                                                
                                        <table class="table table-bordered">
                                        <tr>
                                        <th><small>Task</small></th>
                                        <th><small>Assigned date</small></th>
                                        <th><small>Deadline</small></th>
                                        <th><small>Person in Charge</small></th>
                                        <th><small>Status</small></th>
                                        </tr>';
                                        $p=ucwords($row['id']);  
                        $q  = "SELECT tblongoing_tasks.id, tblongoing_tasks.task,tblongoing_tasks.user,tblongoing_tasks.deadline,tblongoing_tasks.date_assigned,tblongoing_tasks.percentage,tblongoing_tasks.proj
                        FROM tblongoing_tasks where tblongoing_tasks.proj = '".$p."'
                        ORDER BY id desc";
                        $r = mysqli_query($con, $q);
                            while($rows = mysqli_fetch_array($r))
                                                  { 
                                            $per = $rows['percentage'];
                                            $d = $rows['deadline'];
                                            if($per<100)
                                            {
                                                $status = '<p style="color: red">'. "Incomplete" .'</p>';
                                            }
                                            elseif($per>=100)
                                            {
                                                $status = '<p style="color: green">'. "Completed" .'</p>';
                                            }
                                            echo '
                                                <tr>
                                                <td><small>'.ucwords($rows['task']).'</small></td>
                                                <td><small>'.ucwords($rows['date_assigned']).'</small></td>
                                                <td><small>'.$rows['deadline'].'</small></td>
                                                <td><small>'.ucwords($rows['user']).'</small></td>
                                                <td><small>'.$status.'</small></td> 
                                                </tr>';
                                                  }
                                                echo '
                                                </table>
                                                </td>
                                                
                                                                                  
                                                </tr>
                                                ';
                                                
                                                include "editPls.php";
                                                      
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
          function goBack() {
           window.history.back();
           }

          </script>        
    </body>
</html>



