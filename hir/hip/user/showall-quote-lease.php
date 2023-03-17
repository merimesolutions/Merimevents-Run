<?php
  session_start();
if (!isset($_SESSION['userid'])){
}
  ?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>
<?php
include("../connection.php");
$event_id = $_GET['event_id'];
?>
<?php
                function RandomString($length) {
                    $keys = array_merge(range(0,9));
                        $key = "";
                        for($i=0; $i < $length; $i++) {
                        $key .= $keys[mt_rand(0, count($keys) - 1)];
                    }
                        return $key;               
                }
            ?>
            <form action="delete_qq.php" method="post">
<table border="1">
        <tr>
        <th colspan="8" style="text-align:right;">
          <?php
          $quoteid = $_GET['quoteid'];
          $query = mysqli_query($con, "SELECT distinct identitty FROM tblquotation WHERE identitty = '$quoteid' ");
   while($row = mysqli_fetch_array($query))                                
  { echo '
        <a href="print-quotation-lease?id='.$_GET['quoteid'].' " target="_blank" class="btn btn-primary btn-sm form-group" ><i class="fa fa-print"></i>&nbsp;Print quotation</a>';
        
        }  
?>
        </th>
        </tr>
        <tr>
            <th>S.N</th>
            <th>Item name</th>
            <th>Description</th>
            <th>Qnty</th>
            <th>No. of days</th>
            <th>Unit price</th>
            <th>Total cost</th>  
            <th style="width:80px !important;">Delete</th>
        </tr> 
   <?php
   $sn = 1;
   $quoteid = $_GET['quoteid'];
   $squery = mysqli_query($con, "SELECT * FROM tblquotation where identitty = '$quoteid' ORDER BY id desc");
   while($data = mysqli_fetch_array($squery))                                
  {
 echo '<tr>
          <td>'.$sn++.'</td>
          <td>'.ucwords($data['item_name']).'</td>
          <td>'.$data['description'].'</td>
          <td>'.$data['no_days'].'</td>
          <td>'.$data['quantity'].'</td>
          <td>'.number_format($data['unit_price'],2).'</td>
          <td>'.number_format($data['total_amount'],2).'</td>
          <td><a class="" style="cursor: pointer;" href="delete_qq?id='.$quoteid.'"><i class="fa fa-trash"> </i> Delete</a></td>
          <td> <input type="submit" name="delete_this"  " id="deleteDB" style="margin-top:10px !important;background-color:transparent; border:none;" value="Delete" ></td>
          </tr>';
       
 
}  
// <td><a class="" style="cursor: pointer;" onclick="myDel('.$data['id'].')"><i class="fa fa-trash"> </i> Delete</a></td>
   
?>
</table></form>
</body>
</html>