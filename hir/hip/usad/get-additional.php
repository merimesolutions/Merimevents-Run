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
  include "../connection.php";
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
  <form id="addd" method="POST">
<table class="table table-striped">
  <tr>
  <th>Item/service</th>
  <th>Description</th>
  <th>Quantity</th>
  <th>Unit price</th>
  <th>Supplier</th>
  <th colspan="2">Date</th>
  </tr>

  <tr>
  <td>
    <input type="hidden" name="event_id" id="event_id" class="form-control" value="<?php echo $_GET['event_id'];?> ">
    <input type="text" name="costName" id="costName" class="form-control" ></td>
  <td><input type="text" name="costDescription" id="costDescription" class="form-control" value=""></td>
  <td><input type="number" min="1" name="costQuantity" id="costQuantity" class="form-control" required style="background-color:#b3ffcc;" placeholder="0"></td> 
  <td><input type="number" name="costPrice" id="costPrice" value="" class="form-control" required style="background-color:#b3ffcc;"></td>
  <td><select name="costSupplier" id="costSupplier" class="form-control input-sm" >
          <option value="" disabled selected>..Select..</option>
              <?php
                $a = mysqli_query($con,"SELECT * from tblsuppliers where company='".$_SESSION['company']."' ");
                    while($row=mysqli_fetch_array($a)){
                        echo '<option value="'.$row['id'].'">'.ucwords($row['full_name']).'</option>';
                                                                }    
                                                  ?>
                                            </select></td>
  <td><input type="date" name="lease_date" id="lease_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" ></td>  
  <td><input type="submit" name="add_additional" class="btn btn-primary" id="button" value="Add">
    <!-- <a href="javascript:void(0)" onClick="updateId('1')">Add</a> -->
    </td>
  </tr>
</table>
</form>
</body>
</html>