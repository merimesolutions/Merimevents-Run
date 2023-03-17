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
        .sidebar-menu .pl{
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
                    <form method="post">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" style="padding-top:10px;"><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;

                    <!--a href="plr.php" target="_blank"><img src="../../images/icons/print.png" title="Print projects report" class="icon"></a-->
                    <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#addProject" style="padding-top:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Add Project</a>&nbsp;&nbsp;&nbsp; -->

                    <a href="pl" ><i class="fa fa-tasks" aria-hidden="true" style="padding-top:10px;"></i> Active Projects</a>

                    <!-- <input type="submit" class="btn btn-danger btn-sm" name="delete_project"  value="Delete Project"> --> 
                    
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                       <div class="box">
                        <div class="box-body table-responsive">
                        
                        
                                    <table id="table" class="table  table-striped">
                                        <div class="box-body table-responsive">   
                            <div class="dropdown" style=" position: absolute;
  right: 10px;
  top: 5px;
  margin-bottom:10px;
  z-index: 1;">
<button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float:right; padding: 2px 20px;">
Action
</button>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="padding:10px;">
<input type="submit" name="restore_project"  class="dropdown-item" style="background-color:transparent ; border:none;" value="Restore project"> 
 <input type="submit" name="delete_project"  class="dropdown-item" style="margin-top:10px !important;background-color:transparent ; border:none;" value="Delete project">
</div>
</div>
                                        <thead>
                                            <tr>
                                                <th style="width: 15px !important;"><i class="fa fa-hashtag"></i></th>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Projects</th>
                                                <th>Started</th>
                                                <th>Deadline</th>
                                                <th>Status</th>
                                                <th><center>Edit</center></th>
                                                <th><center>View</center></th>
                                              
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
                                                where company='".$_SESSION['company']."' and del=1 
                                                ORDER BY id desc";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                      $project = $row['id'];

                                            echo '
                                            <tr><td><input type="checkbox" name="projects[]" value="'.$project.'"></td>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['project']).'</td>
                                                <td>'.ucwords($row['started']).'</td>  
                                                <td>'.$row['deadline'].'</td>
                                                <td>'.ucwords($row['status']).'</td> 
                                                <td><center><a data-target="#editPls'.$row['id'].'" data-toggle="modal"><img src="../../images/icons/doc_edit.png" title="Edit this record" class="iconb"></a></center></td>
                                                <td><center><a href="ts.php?proj='.$row['id'].'"><img src="../../images/icons/eye.png" title="View this project" class="iconb"> </a></center></td>   
                                                                             
                                                </tr>
                                                ';
                                                
                                                include "editPls.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                   

             <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>
            <?php include "deletefunction.php";?>
            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>

                  </div>
                </div>
               </section><!-- /.content -->
                </form>
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
          
<!-- delete event -->
<script type="text/javascript">
   function arChive(id)
     {   
      var  id=id;
      if (confirm("Are you sure you want to archive this project?") == true) {
      if(id!='')
        {
         $.ajax({
         type:'POST',
         url:'archive-pl.php',
         data:{id: id},
         success:function(msg){
          setInterval('location.reload()',350);
         }
         });
         } } }
</script>

<!-- delete event-->
<script type="text/javascript">
   function deLete(id)
     {   
      var  id=id;
      if (confirm("Are you sure you want to delete this project?") == true) {
      if(id!='')
        {
         $.ajax({
         type:'POST',
         url:'delete-pl.php',
         data:{id: id},
         success:function(msg){
          setInterval('location.reload()',350);
         }
         });
         } } }
</script>
   
    </body>
</html>



