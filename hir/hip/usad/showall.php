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
<table border="1">
        <tr>
        <th colspan="8" style="text-align:right;">
        <form method="post">
          <input type="hidden" name="client" value="<?php echo $_GET['client']; ?>"/>
          <input type="hidden" name="invoice" value="<?php echo RandomString(5); ?>"/>
          <button type="submit" name="generate" class="btn btn-success">Generate invoice</button>
        </form>
        </th>
        </tr>
        <tr>
            <th>S.N</th>
            <th>Item name</th>
            <th>Qnty</th>
            <th>Unit price</th>
            <th>Total cost</th>
            <th>Description</th>
            <th>Return date</th>
            <th style="width:80px !important;">Delete</th>
        </tr>
   <?php
   $sn = 1;
   $client = $_GET['client'];
   $squery = mysqli_query($con, "SELECT * FROM tblleased WHERE company='".$_SESSION['company']."'  and invoice IS NULL ORDER BY item_id desc");
   while($data = mysqli_fetch_array($squery))                                
  {
$a = mysqli_query($con,"SELECT * from tblitems where id='".$data['item_name_id']."' ");
        while($row=mysqli_fetch_array($a)){
 echo '<tr>
          <td>'.$sn.'</td>
          <td>'.ucwords($row['item_name']).'</td>
          <td>'.$data['qnty'].'</td>
          <td>'.number_format($data['price'],2).'</td>
          <td>'.number_format($data['total_cost'],2).'</td>
          <td>'.$data['qlty'].'</td>
          <td>'.$data['rdate'].'</td>
          <td><a class="" style="cursor: pointer;" onclick="myDel('.$data['item_id'].')"><i class="fa fa-trash"> </i> Delete</a></td>
   </tr>';
       
  $sn++; 
 }
}  
?>
</table>
</body>
</html>