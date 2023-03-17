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
                                            <tr>
                                                <th style="width: 30px !important;"><i class="fa fa-list"></i></th>
                                                <th  style="width: 200px !important;text-align:left">Client</th>
                                                <th style="width: 100px !important;text-align:left">ID No.</th>
                                                <th style="width: 150px !important;text-align:left">Item</th>
                                                <th style="width: 100px !important;text-align:left">Leased date</th>
                                                <th style="width: 100px !important;text-align:left">Returning Date</th>
                                                <th style="width: 100px !important;text-align:center">Quantity</th>
                                                <th style="width: 100px !important;text-align:right">@</center></th>
                                                <th style="width: 100px !important;text-align:right">Amount</th>
                                                
                                                <th>Leased By</th-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $date=date("Y-m-d");
                                            $c=1;

                                            $query  = "SELECT tblcustomers.fname,tblcustomers.mname,tblcustomers.lname, tblitems.id, tblitems.item_name,tblleased.qnty,tblleased.qlty,tblleased.ldate,tblleased.rdate, tblleased.served_by,tblleased.item_name_id,tblleased.item_id,tblleased.price,tblleased.client
                                                FROM 
                                                tblcustomers
                                                LEFT JOIN tblleased 
                                                ON tblcustomers.identity = tblleased.client
                                                LEFT JOIN tblitems 
                                                ON tblitems.id = tblleased.item_name_id where tblleased.company='".$_SESSION['company']."' ORDER BY id DESC";
                                                $result = mysqli_query($con, $query);

                                                while ($row = mysqli_fetch_array($result))
                                                                    { 
                                                        $amount = ($row['price'] * $row['qnty']);
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td>
                                                <td>'.ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']).'</td>
                                                <td style="text-align:left">'.ucwords($row['client']).'</td>
                                                <td>'.ucwords($row['item_name']).'</td>
                                                <td>'.ucwords($row['ldate']).'</td>
                                                <td>'.ucwords($row['rdate']).'</td>
                                                <td>'.$row['qnty'].'</td>
                                                <td align="right">'.number_format($row['price'],2).'</td>
                                                <td align="right">'.number_format($amount,2).'</td>
                                           <td>'.ucwords($row['served_by']).'</td>      
                                                                                  
                                                </tr>
                                                ';
                                                
                                                //include "editlsd.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>