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

		table,
		td,
		th {
			border: 1px solid black;
			padding: 5px;
		}

		th {
			text-align: left;
		}

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
	<table border="1">
		<tr>
			<th colspan="8" style="text-align:right;">
				<?php
          $query = mysqli_query($con, "SELECT distinct event_id FROM event_quotation WHERE event_id = '$event_id' ");
   while($row = mysqli_fetch_array($query))                                
  { echo '
        <a href="print-quotation?id='.$row['event_id'].' " target="_blank" class="btn btn-primary btn-sm form-group" ><i class="fa fa-print"></i>&nbsp;Print quotation</a>';
        
        }  
?>
			</th>
		</tr>
		<tr>
			<th></th>
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
   
   $squery = mysqli_query($con, "SELECT * FROM event_quotation WHERE event_id = '".$event_id."' ORDER BY id desc");
   while($data = mysqli_fetch_array($squery))                                
  {
 echo '<tr>
          <td>'.$sn++.'</td>
          <td>'.ucwords($data['event_item_name']).'</td>
          <td>'.$data['event_description'].'</td>
          <td>'.$data['event_days'].'</td>
          <td>'.$data['event_quantity'].'</td>
          <td>'.number_format($data['event_single_price'],2).'</td>
          <td>'.number_format($data['total_items'],2).'</td>
          <td><a class="" style="cursor: pointer;" onclick="myDel('.$data['item_id'].')"><i class="fa fa-trash"> </i> Delete</a></td>
   </tr>';
       
 
} 
$query = mysqli_query($con, "SELECT * FROM additional_costs WHERE event_id = '".$event_id."' ORDER BY id desc");
   while($dat = mysqli_fetch_array($query))                                
  {
 echo '<tr>
          <td>'.$sn++.'</td>
          <td>'.ucwords($dat['cost_name']).'</td>
          <td>'.$dat['cost_description'].'</td>
          <td>'.$dat['cost_quantity'].'</td>
          <td>-</td>
          <td>'.number_format($dat['costperunit'],2).'</td>
          <td>'.number_format($dat['total_price'],2).'</td>
          <td><a class="" style="cursor: pointer;" onclick="myDel('.$data['item_id'].')"><i class="fa fa-trash"> </i> Delete</a></td>
   </tr>';
       
 
}  
?>
	</table>
</body>

</html>
