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
<?php 
      
        include "../connection.php";
        ?>
<table id="table" class="table table-striped">
                                        <thead>
                                            <tr><th colspan="9"> OUR CUSTOMER'S <br>REPORT</th></tr>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Company</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                        $company=$_SESSION['company'];
                                           $query  = "SELECT * FROM tblcustomers where company='".$_SESSION['company']."' ORDER BY id ASC";
                                            $result = mysqli_query($con, $query);
                                            $i = 1;
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                       
                                                echo '
                                            <tr>  
                                            <td></td>
                                                <td>'.$i++.'</td> 
                                              
                                                <td>'.ucwords($row['customer_name']).'</td>  
                                                <td>'.$row['email'].'</td>
                                                 
                                                <td>'.ucwords($row['fcontact']).'</td>
                                                <td>'.ucwords($row['b_c_name']).'</td>  
                                            
                                                </tr>
                                                ';
                                                
                                                //include "editlsd.php";
                                                    
                                            }
                                            ?>
                                        </tbody>
                                    </table>