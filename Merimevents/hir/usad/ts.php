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
           <?php $project = $_GET['proj'];?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a href="javascript:void(0)"  title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    
                    <!--<a href="tsa.php" target="_parent" class=""><i class="fa fa-tasks" aria-hidden="true"></i> Assign Tasks</a>&nbsp;&nbsp;&nbsp;-->
                    
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#addtask<?php $_GET['proj'];?>" ><i class="fa fa-plus" aria-hidden="true"></i> Add task</a>
                     <!--<input type="submit" class="btn btn-danger btn-sm" id="delete_task" name="delete_task"   value="Delete Project" style="position:absolute;right:15px;">-->
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">   
                        <h5 style="background-color: rgba(0,0,0,0.1);padding:2px;"><span style="color:#000;">Project: </span> <?php
                        $q  = "SELECT * FROM 
                                                tblprojects
                                                where id = '".$_GET['proj']."'
                                                ";
                                            $result = mysqli_query($con, $q);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                    echo ucwords($row['project']);
                                                  }
                                                  ?></h5>        
                            <form method="post">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Task</th>
                                                <th></th>
                                                <!--th>Description</th-->
                                                <th>Start</th>
                                                <th>Deadline</th>
                                                <th>Completion</th>
                                                <th>Person in charge<!--span style="float:right">Add <i class="fa fa-user" aria-hidden="true"></i></span--></th>
                                                <th>Status</th>
                                                <!--<th style="width:60px;text-align: center;">Edit</th>-->
                                                   
                                                <th style="width:40px;">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $date=date("Y-m-d");
                $query  = "SELECT tblongoing_tasks.id, tblongoing_tasks.urgency,tblongoing_tasks.task,tblongoing_tasks.user,tblongoing_tasks.deadline,tblongoing_tasks.date_assigned,tblongoing_tasks.percentage,tblongoing_tasks.proj
                        FROM tblongoing_tasks where tblongoing_tasks.proj = '".$_GET['proj']."'
                        ORDER BY id desc";
                        $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_array($result))
                                                  { 
                                         
                                            $urgency = $row['urgency'];
                                            $per = $row['percentage'];
                                            $d = $row['deadline'];
                                            $task = $row['task'];
                                            if(($per>=99) && ($per<=100))
                                            {$status = '<p style="color: #008000">'. "Completed" .'</p>';
                                                
                                            }
                                            elseif(($per>=75) && ($per<=98))
                                            {
                                             $status = '<p style="color:gold">'. "Almost done" .'</p>';   
                                            }elseif(($per>=50) && ($per<=74))
                                            {
                                             $status = '<p style="color: #66cc99">'. "Halfway done" .'</p>';   
                                            }elseif(($per>=1) && ($per<=49)){
                                              $status = '<p style="color: #ff6666">'. "In progress" .'</p>';   
                                            }else{
                                                $status = '<p style="color: red">'. "Not started" .'</p>';  
                                            }
                                            
                                            
                                              if($date > $row["deadline"]){
                                                  if($per!=100){
                                                   $g = '<td style="color:red">'.$row["deadline"].'</td>';
                                                  }else{
                                                     $g = '<td>'.$row["deadline"].'</td>';  
                                                  }
                                              }else{
                                                   $g = '<td>'.$row["deadline"].'</td>';
                                              }
                // $qry  = "SELECT * FROM tbltasks where task_name = '".$task."' 
                //         ORDER BY id desc";
                //         $res = mysqli_query($con, $qry);
                //             while($rows = mysqli_fetch_array($res))
                //                                   { 
                                            echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['task']).'</td>';
                                                 echo '<td>';
                                                
                                                switch($urgency){
                                                    case 1:
                                                       if($per!=100){ 
                                                        echo '
                                                        
                                                <div class=" alert alert-danger shadow" role="alert" style="border-left:#721C24 5px solid; border-radius: 0px;padding:0 1px;margin-bottom:0;">
                                            		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            		    <span aria-hidden="true" style="color:#721C24">&times;</span>
                                            		</button>
                                            		<div class="row" style="margin:0;">
                                            		   <div class="col-lg-2 col-sm-2">
                                            		
                                            			</div>
                                            			<div class="col-lg-10 col-sm-10">
                                            		  	<p style="font-size:13px" class="mb-0 font-weight-light"><b class="mr-1">Urgent!</b></p>
                                            		  	</div>
                                            		</div>
                                            	</div>
                                                        ' 
                                                        ;
                                                       }
                                                     break;
                                                     case 2:
                                                         if($per!=100){ 
                                                         echo ' <div class=" alert alert-warning shadow my-auto" role="alert" style="border-left:#ffff00 5px solid;border-radius: 0px;padding:0 1px;margin-bottom:0;">
                                            		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            		    <span aria-hidden="true" style="color:#721C24">&times;</span>
                                            		</button>
                                            		<div class="row" style="margin:0;">
                                            		   <div class="col-lg-2 col-sm-2">
                                            		
                                            			</div>
                                            			<div class="col-lg-10 col-sm-10">
                                            		  	<p style="font-size:13px" class="mb-0 font-weight-light"><b class="mr-1">Semi Urgent!</b></p>
                                            		  	</div>
                                            		</div>
                                            	</div>';
                                                         }
                                                   break;
                                                    default:
                                                        echo '';
                                                }
                                                echo '</td>';
                                                
                                                
                                                echo '<!--td>'.ucwords($rows['description']).'</td-->
                                                <td>'.ucwords($row['date_assigned']).'</td>  
                                                ' .$g.'
                                                <td>'.ucwords($row['percentage']).' %</td>
                                                <td>'.ucwords($row['user']).'  
                                        <!--button data-target="#edituser'.$row['id'].'" data-toggle="modal" style="float:right"><i class="fa fa-plus" aria-hidden="true"></i></button-->
                                                </td> 
                                                <td>'.$status.'</td> 
                                                <!--td><center><a data-target="#editprogress'.$row['id'].'" data-toggle="modal"><img src="../../images/icons/doc_edit.png" title="Edit this record" class="iconb"></a></center></td-->
                                                <td><center><a href="tsview.php?proj='.$_GET['proj'].'&task='.$row['id'].'"><img src="../../images/icons/eye.png" title="View this task" class="iconb"></a></center></td>                                 
                                                </tr>
                                                ';
                                                
                                                include "editprogress.php";
                                                
                                           // }
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
          
 

    $("#delete_task").click(function(){

    var value = "<?php echo $project;?>";

    alert( 'Are you sure you want to delete ?');

    $.ajax({
        url: 'deletetask.php', //This is the current doc
        type: "POST",
        data: ({id: value}),
        success: function(data){
            return data;   
      }
    });


    });
 
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



