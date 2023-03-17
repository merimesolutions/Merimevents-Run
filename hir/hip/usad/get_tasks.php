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
// include('../head_css.php'); 
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css">
<?php
  include "../connection.php";
  if(isset($_GET['q'])){
  $q = $_GET['q'];
  if($q=='0'){
    echo '<script>window.location.reload();</script>';
    die();
  }
 $query  = "SELECT * FROM tblongoing_tasks where proj = '".$_GET['proj']."' AND urgency = '$q' ORDER BY percentage ";
    $result = mysqli_query($con, $query);
      $count = mysqli_num_rows($result);?>
  
   <table id="example" class="display" style="width:100%">
      <?php if($count){ ?>
     <thead>
    <tr>
        <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
        <th>Task</th>
     
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
      <?php }else{
         echo 'No record found';
          
      } ?>
       <tbody>
                             <?php
                                            $c=1;
                                            $date=date("Y-m-d");
                       
                
                        $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_array($result))
                                                  { 
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
                '<span class="badge" style="float:right;background-color:red;"><a style="color:#fff !important;" href="tsview.php?proj='.$_GET['proj'].'&task='.$row['id'].'">'.$num_rows.' sms</a></span>';
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
                                                <td>'.ucwords($rows['full_name']).'  
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
 
      
  <?php } 
  // include "../footer.php"; 

?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
<script>
    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example thead tr')
        .clone(true)
        .addClass('filters');
        // .appendTo('#example thead');
 
    var table = $('#example').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    
                });
        },
    });
});
</script>