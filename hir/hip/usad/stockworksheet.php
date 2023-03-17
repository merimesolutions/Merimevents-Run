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
                                            <tr><th colspan="9"> AVAILABLE STOCK <br>REPORT</th></tr>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Stocked Qnty</th>
                                                <th>Current Qnty</th>
                                                <th>Damaged Qnty</th>
                                                <th>Description</th>
                                                <th>Stocked Date</th>
                                                <th>Stocked By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                        $company=$_SESSION['company'];
                                        $query  = "SELECT tblitems.id, tblitems.item_name,tblitems.qnty,tblitems.qlty,tblitems.bno,tblitems.category, tblitems.added_date,tblitems.added_by,tblitems.company
                                                FROM 
                                                tblitems where company='".$company."' 
                                                ORDER BY tblitems.id desc";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                               $item = $row['id'] ;      
                            $qry  = "SELECT SUM(bal_qnty) AS sum ,SUM(damaged) AS damaged FROM tblleased where item_name_id='".$item."' ";
                            
                                $r = mysqli_query($con, $qry);
                                    while ($rows = mysqli_fetch_assoc($r))
                                                  {
                                    $d='0';                  
                                    $bal = $row['qnty'] - $rows['sum'];
                                    $d=$rows['damaged'];             
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($row['bno']).'</td>
                                                <td>'.ucwords($row['item_name']).'</td>  
                                                <td>'.$row['qnty'].'</td>
                                                <td>'.$bal.'</td>
                                                <td>'.$d.'</td>
                                                <td>'.ucwords($row['category']).'</td>
                                                <td>'.ucwords($row['added_date']).'</td>  
                                                <td>'.ucwords($row['added_by']).'</td>
                                                </tr>
                                                ';
                                                
                                                //include "editlsd.php";
                                                  }   
                                            }
                                            ?>
                                        </tbody>
                                    </table>