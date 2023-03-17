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
  include "connection.php";
      $search = $_GET['client'];
    
            $sql_dd=mysqli_query($con,"select * from tblcustomers where identity='".$search."' and company='".$_SESSION['company']."' ");
             
while ($row=mysqli_fetch_array($sql_dd)) {

  $GLOBALS['client'] = $row['identity']; 
       echo '<table class="table table-striped">
          <tr>
            <th scope>Customer Name</th>
            <th scope>National ID No.</th>
            <th>Contact</th>
            <th scope>Email <input type="hidden" id="clientid" value="'.$row['identity'].'" ></th>
          </tr>
          <tr style="background-color:#EBF5FB;">
            <td>'.ucwords($row['fname']).' '.ucwords($row['lname']).' '.ucwords($row['mname']).'</td>
            <td>'.$row['identity'].'</td>   
            <td>'.ucwords($row['fcontact']).'  '.ucwords($row['scontact']).'</td>
            <td>'.$row['email'] .'</td>
          </tr> 
          </table>'; 
            }

            ?>

                        
                                
      