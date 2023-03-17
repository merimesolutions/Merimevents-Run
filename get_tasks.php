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
include('../head_css.php'); 
  include "../connection.php";
  if(isset($_GET['q'])){
  $q = $_GET['q'];
  if($q=='0'){
    echo '<script>window.location.reload();</script>';
    die();
  }
    $query  = "SELECT * FROM tblongoing_tasks where proj = '".$_GET['proj']."' and user=  '".$_SESSION['userid']."' AND urgency = '$q' ORDER BY percentage ";
    $result = mysqli_query($con, $query);
      $count = mysqli_num_rows($result);?>
   <div class="datatables_wrapper form-inline no-footer" id="table_wrapper">  
       <div class="row">
           <div class="col-xs-6">
            <div class="dataTables_length" id="table_length">
                <label>
                    <select class="form-control input-sm" name="table_length" aria-controls="table">event
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </label>
                
            </div>
               
           </div>
       </div> 
   <table id="table" class="table table-striped">
      <?php if($count){ ?>
   <thead>
                          <tr>
                              <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                              <th>Task</th>
                      
                              <th>Start</th>
                              <th>Deadline</th>
                              <th>Completion</th>
                              <th>Status</th>
                               
                              <th style="width:40px">View</th>
                             
                                   </tr>
                               </thead>
      <?php }else{
         echo 'No record found';
          
      }?>
     <tbody>
      <?php
      $c=1;
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
                  $status = '<p style="color:#ff6600;">'. "Almost done" .'</p>';   
                 }elseif(($per>=50) && ($per<=74))
                 {
                  $status = '<p style="color: black;">'. "Halfway done" .'</p>';   
                 }elseif(($per>=1) && ($per<=49)){
                   $status = '<p style="color: #ff6666">'. "In progress" .'</p>';   
                 }else{
                     $status = '<p style="color: red">'. "Not started" .'</p>';  
                 }
                                            
                   if($date > $row["deadline"]){
                       if($per!=100){
                        $g = '<p style="color:red">'.$row["deadline"].'</p>';
                       }else{
                          $g = '<p>'.$row["deadline"].'</p>';  
                       }
                   }else{
                        $g = '<p>'.$row["deadline"].'</p>';
                   }
                   //My switch guy............................
                    switch($urgency){
                         case 1:
                             if($per!=100){ 
                          $t ='<p style="color:#ff0000;">'.ucwords($row['task']).'</p>';
                             }else{
                      $t ='<p style="color:#000;">'.ucwords($row['task']).'</p>';  
                             }
                          break;
                          case 2:
                              if($per!=100){ 
                          $t ='<p style="color:#ff6600;">'.ucwords($row['task']).'</p>';
                              }else{
                      $t ='<p style="color:#000;">'.ucwords($row['task']).'</p>';  
                              }
                        break;
                         case 3:
                              if($per!=100){ 
                          $t ='<p style="color:#00cc66;">'.ucwords($row['task']).'</p>';
                              }
                        break;
                      default:

                         $t ='<p style="color:#000;">'.ucwords($row['task']).'</p>';
                        
                     }
                                  //end switch
              $q = mysqli_query($con,"SELECT * FROM faq where task='".$row['id']."' and reply IS NULL and user !='".$_SESSION['userid']."' ");
                $num_rows = mysqli_num_rows($q);
                if($num_rows>0){
                $new_sms = 
                '<span class="badge" style="float:right;background-color:red;"><a style="color:#fff !important;" href="tsview.php?proj='.$_GET['proj'].'&task='.$row['id'].'">'.$num_rows.' sms</a></span>';
              }else{
                $new_sms = '';
              }

                    echo '
                    <tr>
                        <td>'.$c++.'</td> 
                        <td>'.$t.'</td>
                        <td>'.ucwords($row["date_assigned"]).'</td> 
                        
                        <td>'.$g.'</td>
                        
                        <td>'.ucwords($row["percentage"]).' % '.$new_sms.'</td>
                         
                        <td>'.$status.'</td> ';
                     
            echo '<td><center><a href="tsview.php?proj='.$_GET['proj'].'&task='.$row['id'].'"><img src="../../images/icons/eye.png" title="View this task" class="iconb"></a></center></td>';
                       echo '</tr>';
                        
                      //  include "editprogress.php";
                                       
                                   // }
                   }
         echo '</tbody>';
    
  
    echo '</table>';
    echo '</div>';
  } 
  include "../footer.php"; 

?>
<script>
     $(function() {
                  $("#table").dataTable({
                     "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
                  });
              });
</script>