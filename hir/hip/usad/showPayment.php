    <?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['userid'])) {
    require "../redirect.php";
}
else {
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_destroy();
        require "../redirect.php";
    }
    else {
    }
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css">

<?php
$qw = $_GET['q'];
include "../connection.php";
?>
             <?php
                 $c =1;
                    switch ($qw) {
                        case 0:
                    $query = mysqli_query($con,"SELECT tblleased.qnty,tblleased.rqnty,tblleased.bal_qnty,tblleased.price,tblleased.total_cost,tblleased.amount,tblleased.rdate,tblleased.ldate,tblitems.item_name,tblleased.item_id 
                            FROM tblleased
                            LEFT JOIN tblitems 
                            ON  tblleased.item_name_id = tblitems.id WHERE  tblleased.company='" . $_SESSION['company'] . "'  ");
                            echo ' <div class="box">
                                    <div class="box-body table-responsive">       
                                        <form method="post">
                                            <table id="table" class="display table  table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Item Id</th>
                                                        <th>Item name</th>
                                                        <th>Quantity</th>
                                                        <th>Returned quantity</th>
                                                        <th>Balance quantity</th>
                                                        <th>Price</th>
                                                        <th>Total cost</th>
                                                        <th>Amount</th>
                                                        <th>Return date</th>
                                                        <th>Leased date</th>
                                                    </tr>       
                                                </thead>';
                            while($rez= mysqli_fetch_assoc($query) ){
                                echo '
                                
                                                <tbody>
                                                    <tr>
                                                        <td>' . ucwords($rez['item_id']) . '</td>
                                                        <td>' . ucwords($rez['item_name']) . '</td>
                                                        <td>' . ucwords($rez['qnty']) . '</td>
                                                        <td>' . ucwords($rez['rqnty']) . '</td>
                                                        <td>' . ucwords($rez['bal_qnty']) . '</td>
                                                        <td>' . ucwords($rez['price']) . '</td>
                                                        <td>' . ucwords($rez['total_cost']) . '</td>
                                                        <td>' . ucwords($rez['amount']) . '</td>
                                                        <td>' . ucwords($rez['rdate']) . '</td>
                                                        <td>' . ucwords($rez['ldate']) . '</td>
                                                    </tr>
                                                </tbody>';
                                            
                            }
                           
                            echo '
                            </table>
                                        </form>
                                    </div>
                                </div>';
                                break;
                            case 1:
                                $query = mysqli_query($con,"SELECT event_items.event_item,event_items.good_condition,event_items.damage_quantity,event_items.original_quantity,tblitems.item_name  FROM event_items
                                LEFT JOIN tblitems ON event_items.event_item = tblitems.id WHERE event_items.good_condition>0 AND event_items.company='" . $_SESSION['company'] . "'  ");
                                echo ' <div class="box">
                                <div class="box-body table-responsive">       
                                    <form method="post">
                                        <table id="table" class="table  table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Event item</th>
                                                    <th>Original quantity</th>
                                                    <th>Good items</th>
                                                    <th>Damaged quantity</th>
                                                </tr>       
                                            </thead>';
                                while ($rez= mysqli_fetch_array($query) ){
                                echo '
                                
                                                <tbody>
                                                    <tr>
                                                        <td>' . ucwords($rez['item_name']) . '</td>
                                                        <td>' . ucwords($rez['original_quantity']) . '</td>
                                                        <td>' . ucwords($rez['good_condition']) . '</td>
                                                        <td>' . ucwords($rez['damage_quantity']) . '</td>
                                                    </tr>               
                                                </tbody>
                                              ';
                            }
                            echo '
                            </table>
                                        </form>
                                    </div>
                                </div>  ';
                        break;
                        case 2:
                     
                            $query = mysqli_query($con,"SELECT tbloverdate.payment,tbloverdate.cleared_by,tbloverdate.date_cleared,tbloverdate.item,tbloverdate.item_name_id_overdue  
                                FROM `tbloverdate` LEFT JOIN tblitems ON tbloverdate.item_name_id_overdue =tblitems.id 
                                WHERE tbloverdate.payment=0 AND tblitems.company ='" . $_SESSION['company'] . "' ");
                            echo '<div class="box">
                            <div class="box-body table-responsive">       
                                <form method="post">
                                    <table id="table" class="table  table-striped">
                                        <thead>     
                                            <tr>
                                                <th>Item Id</th>
                                                <th>Item name</th>
                                                <th>Payments</th>
                                                <th>Cleared by</th>
                                                <th>Date cleared</th>
                                            </tr>                
                                        </thead>';

                            while ($rez= mysqli_fetch_array($query) ){
                        
                            echo'
                          
                                            <tbody>
                                                <tr>
                                                    <td>' .  $c++ . '</td>
                                                    <td>' . ucwords($rez['item']) . '</td>
                                                    <td>' . ucwords($rez['payment']) . '</td>
                                                    <td>' . ucwords($rez['cleared_by']) . '</td>
                                                    <td>' . ucwords($rez['date_cleared']) . '</td>
                                                </tr>
                                            </tbody>
                                        ';
                        }
                        echo '</table>
                                    </form>
                                </div>
                            </div>';
                    break;
                    case 3:
                      ?>
                      <div class="box">
                        <div class="box-body table-responsive">  
                            <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;">No.</th>
                                                <th>Client</th>
                                                <th>ID</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Charges for @ </th>
                                                <th>Charged (Ksh.)</th>
                                                <th>Paid (Ksh.)</th>
                                                <th>Balance (Ksh.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                             $s = $_SESSION['company'];
                            $q  = "SELECT * FROM tblcustomers where company = '".$_SESSION['company']."'";
                        $r = mysqli_query($con, $q);
                            while ($rows = mysqli_fetch_array($r))
                                                  { 
                                $cc=$rows['identity'];
                        $query  = "SELECT * FROM tblleased where damaged !='NULL' and comment = 'not cleared' and client= '$cc' ";
                        $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result))
                                                  { 
                                $cb=$row['client'];
                                $z=$row['item_name_id'];
                                $d=$row['damaged'];
                                
                        $qu = "SELECT * FROM tblitems where id ='$z'";
                        $res= mysqli_query($con, $qu);
                            while ($rowss = mysqli_fetch_array($res))
                                                  {
                                       $dmg=$rowss['damage_charges'];           $charges=($dmg*$d);    
                        $q = "SELECT * FROM tblcleared where item_name_id_clear ='".$z."' and client='".$cb."' ";
                                            $query_run = mysqli_query($con,$q);

                                            $paid= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $paid += $num['payment'];

                                        
                                                  }
                                                echo '
                                            <tr>
                                                <td>'.$c++.'</td> 
                                                <td>'.ucwords($rows['fname']).' '.ucwords($rows['mname']).' '.ucwords($rows['lname']).'</td>
                                                <td>'.$cc.'</td>
                                                <td>'.ucwords($rowss['item_name']).'</td>  
                                                <td>'.$row['damaged'].'</td> 
                                                <td>'.$rowss['damage_charges'].'</td>
                                                <td>'.$charges.'</td>
                                                <td>'.$paid.'</td>
                                                <td>'.($charges - $paid).'</td>
                                                                                 
                                                </tr>
                                                ';
                                                  }
                                                  }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    </form>

                  </div>
                </div>
                      <?php
                break;
                case 4:
                    $query = mysqli_query($con,"SELECT * FROM `tbloverdate` WHERE payment=0 ");
                    echo '<div class="box">
                    <div class="box-body table-responsive">       
                        <form method="post">
                            <table id="table" class="table  table-striped">
                                <thead>     
                                    <tr>
                                        <th>Item Id</th>
                                        <th>Item name</th>
                                        <th>Payments</th>
                                        <th>Cleared by</th>
                                        <th>Date cleared</th>
                                    </tr>                
                                </thead>';
                    while ($rez= mysqli_fetch_array($query) ){
                
                    echo'
                  
                                    <tbody>
                                        <tr
                                            <td>' . ucwords($rez['item_name_id_overdue']) . '</td>
                                            <td>' . ucwords($rez['item']) . '</td>
                                            <td>' . ucwords($rez['payment']) . '</td>
                                            <td>' . ucwords($rez['cleared_by']) . '</td>
                                            <td>' . ucwords($rez['date_cleared']) . '</td>
                                        </tr>
                                    </tbody>
                                ';
                }
                echo '</table>
                            </form>
                        </div>
                    </div>';
            break;
            case 5:
                $query = mysqli_query($con,"SELECT * FROM `tbloverdate` WHERE payment=0 ");
                echo '<div class="box">
                <div class="box-body table-responsive">       
                    <form method="post">
                        <table id="table" class="table  table-striped">
                            <thead>     
                                <tr>
                                    <th>Item Id</th>
                                    <th>Item name</th>
                                    <th>Payments</th>
                                    <th>Cleared by</th>
                                    <th>Date cleared</th>
                                </tr>                
                            </thead>';
                while ($rez= mysqli_fetch_array($query) ){
            
                echo'
              
                                <tbody>
                                    <tr
                                        <td>' . ucwords($rez['item_name_id_overdue']) . '</td>
                                        <td>' . ucwords($rez['item']) . '</td>
                                        <td>' . ucwords($rez['payment']) . '</td>
                                        <td>' . ucwords($rez['cleared_by']) . '</td>
                                        <td>' . ucwords($rez['date_cleared']) . '</td>
                                    </tr>
                                </tbody>
                            ';
            }
            echo '</table>
                        </form>
                    </div>
                </div>';
        break;
        }

                ?>
 
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
 <script>
    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#table thead tr')
        .clone(true)
        .addClass('filters');
        // .appendTo('#table thead');
 
    var table = $('#table').DataTable({
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