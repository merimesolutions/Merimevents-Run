 <?php
  session_start();
if (!isset($_SESSION['userid'])){
}
  ?>
 <?php
include('../connection.php'); 
//Additional Costs
$quoteid        =$_POST['quoteido'];
 $quotet        =$_POST['quoteto'];
        $cost_name =$_POST['costName'];
        $cost_description=$_POST['costDescription'];
        $cost_unit_price=$_POST['costPrice'];
        $company=$_SESSION['company'];
        $txtDay="Nill";
        $date         =date("Y-m-d");

        foreach($cost_name as $key2 => $value2){
            if(!empty($_POST['costQuantity'][$key2])){
             $cost_quantity=$_POST['costQuantity'];
             $supplier=$_POST['costSupplier'];
              $total_price =(int)$cost_quantity[$key2] * (int)$cost_unit_price[$key2];
              $total=$total_price;
              }elseif(empty($_POST['costQuantity'][$key2])){
             
              $total_price = 1 * (int)$cost_unit_price[$key2];
              $total=$total_price;
              }
$served_by      = $_SESSION['username'];

     $query="INSERT INTO `tblquotation`(`identitty`, `item_name`, `description`, `no_days`, `quantity`, `unit_price`, `total_amount`, `company`, `qoutation_title`, `date_create`, `create_by`, `supplier`)VALUES('".$quoteid."','".$value2."','".$cost_description[$key2]."','".$txtDay."', '".$cost_quantity[$key2]."', '".$cost_unit_price[$key2]."', '".$total_price."', '".$company."', '".$quotet."', '".$date."', '".$served_by."','".$supplier[$key2]."')";
     $execute=mysqli_query($con,$query);
     if($execute==true)
     {
      // echo "User data was inserted successfully";
     }else{
      echo  "Error: " . $query . "<br>" . mysqli_error($db);
    }
 
 }

?>