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
<table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr><th colspan="10"> DAMAGED ITEMS <br>REPORT</th></tr>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Client Name</th>
                                                <th>Client ID</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Charges (@) </th>
                                                <th>Charged</th>
                                                <th>Paid</th>
                                                <th>Balance</th>
                                                <th>Served by</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                        ?>
                                            <?php
                                            $c=1;
                                            $query  = "SELECT tblcustomers.id, tblcustomers.fname,tblcustomers.mname,tblcustomers.lname,tblcustomers.identity,tblcustomers.fcontact, tblleased.client,tblleased.item_name_id,tblleased.qnty,tblleased.qlty,tblleased.rdate,tblleased.ldate,tblleased.served_by,tblleased.status,tblleased.company,tblleased.damaged,tblleased.item_id,tblleased.cby,tblitems.item_name,tblitems.damage_charges
                                                FROM 
                                                tblcustomers 
                                                LEFT JOIN tblleased 
                                                ON tblcustomers.identity = tblleased.client 
                                                LEFT JOIN tblitems 
                                                ON tblitems.id = tblleased.item_name_id  
                                                where damaged>'0' and comment = 'not cleared' and tblleased.company='".$_SESSION['company']."' ";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                            $cb=$row['client'];
                                            $z=$row['item_name_id'];
                                            $q = "SELECT * FROM tblcleared where item_name_id_clear ='".$z."' and client='".$cb."' ";
                                            $query_run = mysqli_query($con,$q);

                                            $paid= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $paid += $num['payment'];
                                            }
                                            

                                                    $dmg=$row['damage_charges'];
                                                    $d=$row['damaged'];
                                                    $charges=($dmg*$d);
                                                    $bal=$charges-$paid;
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td>
                                            <td>'.ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']).'</td>
                                                <td>'.ucwords($row['identity']).'</td>
                                                <td>'.ucwords($row['item_name']).'</td>  
                                                <td>'.$row['damaged'].'</td> 
                                                <td>'.$row['damage_charges'].'</td>
                                                <td>'.number_format($charges,2).'</td>
                                                <td>'.number_format($paid,2).'</td>
                                                <td>'.number_format($bal,2).'</td>
                                                <td>'.ucwords($row['cby']).'</td>
                                                                                  
                                                </tr>
                                                ';
                                                
                                               // include "editdi.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>