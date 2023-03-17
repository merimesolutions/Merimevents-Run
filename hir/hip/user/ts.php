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
<script>
function updateId(id)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
           // alert(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET", "updatesms.php?id=" +id, true);
    xmlhttp.send();
}
</script>
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
     .checkbox-menu li label {
    display: block;
    padding: 3px 5px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
    margin:0;
    transition: background-color .4s ease;
}
.checkbox-menu li input {
    margin: 0px 5px;
    top: 2px;
    position: relative;
}

.checkbox-menu li.active label {
    background-color: #cbcbff;
    font-weight:bold;
}

.checkbox-menu li label:hover,
.checkbox-menu li label:focus {
    background-color: #f5f5f5;
}

.checkbox-menu li.active label:hover,
.checkbox-menu li.active label:focus {
    background-color: #b8b8ff;
}
 /*My loader comes here*/
 .lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ellipsis div {
  position: absolute;
  top: 33px;
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: #008000;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
  left: 8px;
  animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
  left: 8px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
  left: 32px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
  left: 56px;
  animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes lds-ellipsis3 {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes lds-ellipsis2 {
  0% {
    transform: translate(0, 0);
  }
  100% {
    transform: translate(24px, 0);
  }
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
    <select class="form-select" aria-label="Default select example" style="position: absolute;right: 15px;" onchange="showCustomer(this.value)">
              <option selected disabled>Filter by urgency</option>
              <option value="0">All tasks</option>
              <option value="1">Urgent</option>
              <option value="2">Semi Urgent</option>
              <option value="3">Not Urgent</option>
            </select>
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
                                <div class="waiting">
                                    <table id="table" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Task</th>
                                             
                                                <!--th>Description</th-->
                                                <th>Start</th>
                                                <th>Deadline</th>
                                                <th>Completion</th>
                                                <th>Person[s] in charge<!--span style="float:right">Add <i class="fa fa-user" aria-hidden="true"></i></span--></th>
                                                <th>Status</th>
                                                <!--<th style="width:60px;text-align: center;">Edit</th>-->
                                                   
                                                <th style="width:40px;">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $date=date("Y-m-d");
                       
             $query  = "SELECT * FROM tblongoing_tasks where proj = '".$_GET['proj']."'
                        ORDER BY percentage "; 
                        
                      
              
                
                        $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_array($result))
                                                  { 
                                $ids =$row['user'];
                          $id_users = explode(',', $ids);
                           $name ='';
                          foreach ($id_users as $id_user) {
                             $get_users  =mysqli_query($con,"SELECT * FROM tblusers where id = '".$id_user."' ") ;
                             while($users  =mysqli_fetch_assoc($get_users)){
                              $name .= $users['full_name'].'<br>';
                             }

                          }

                $qy  = "SELECT * FROM tblusers where id = '".$row['user']."' ";
                        $res = mysqli_query($con, $qy);
                            while($rows = mysqli_fetch_array($res))
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
                                             $status = '<p style="color:#ff6600;">'. "Almost done" .'</p>';   
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
                                                     //My switch guy............................
                                               switch($urgency){
                                                    case 1:
                                                        if($per!=100){ 
                                                     $t ='<td style="color:#ff0000;">'.ucwords($row['task']).'</td>';
                                                        }else{
                                                 $t ='<td style="color:#000;">'.ucwords($row['task']).'</td>';  
                                                        }
                                                     break;
                                                     case 2:
                                                         if($per!=100){ 
                                                     $t ='<td style="color:#ff6600;">'.ucwords($row['task']).'</td>';
                                                         }else{
                                                 $t ='<td style="color:#000;">'.ucwords($row['task']).'</td>';  
                                                         }
                                                   break;
                                                    case 3:
                                                         if($per!=100){ 
                                                     $t ='<td style="color:#00cc66;">'.ucwords($row['task']).'</td>';
                                                         }else{
                                                 $t ='<td style="color:#000;">'.ucwords($row['task']).'</td>';  
                                                         }
                                                   break;
                                                 default:
            
                                                    $t ='<td style="color:#000;">'.ucwords($row['task']).'</td>';
                                                   
                                                }
              $q = mysqli_query($con,"SELECT * FROM faq where task='".$row['id']."' and reply IS NULL and user !='".$_SESSION['userid']."' ");
                $num_rows = mysqli_num_rows($q);
                if($num_rows>0){
                $new_sms = 
                '<span class="badge" style="float:right;background-color:red;"><a style="color:#fff !important;" href="tsview.php?proj='.$_GET['proj'].'&task='.$row['id'].'" onClick="updateId('.$row['id'].')">'.$num_rows.' sms</a></span>';
              }else{
                $new_sms = '';
              } 
                                            echo '
                                            <tr>
                                                <td>'.$c++.'</td>'; 
                                               echo $t;
                                                  
                                                
                            
                                                echo '<!--td>'.ucwords($rows['description']).'</td-->
                                                <td>'.ucwords($row['date_assigned']).'</td>  
                                                ' .$g.'
                                                <td>'.ucwords($row['percentage']).' % '.$new_sms.'</td>
                                                <td>'.ucwords($name).'  
                                        <!--button data-target="#edituser'.$row['id'].'" data-toggle="modal" style="float:right"><i class="fa fa-plus" aria-hidden="true"></i></button-->
                                                </td> 
                                                <td>'.$status.'</td> 
                                                <!--td><center><a data-target="#editprogress'.$row['id'].'" data-toggle="modal"><img src="../../images/icons/doc_edit.png" title="Edit this record" class="iconb"></a></center></td-->
                                                <td><center><a href="tsview.php?proj='.$_GET['proj'].'&task='.$row['id'].'"><img src="../../images/icons/eye.png" title="View this task" class="iconb"></a></center></td>                                 
                                                </tr>
                                                ';
                                                
                                                // include "editprogress.php";
                                                
                                           }
                                                  }
                                            ?>
                                        </tbody>
                                    </table>
                                    </div>
                                   
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
    function showTasks(str) {

       alert(str)
 
      }
    function showCustomer(str) {
                var proj ="<?php echo $_GET['proj'];?>";
               $.ajax({
                    type: 'GET',
                    url: 'get_tasks.php',
                    data:'q='+ str+"&proj="+proj,
                    beforeSend:function(){
                      $('.waiting').html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>");
                    },
                    success: function(response) {
                        $('.waiting').html(response);
                    }
                });
}
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



