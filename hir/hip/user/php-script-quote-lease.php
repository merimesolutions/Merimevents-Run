 <?php
  session_start();
if (!isset($_SESSION['userid'])){
}
  ?>
 <?php
include('../connection.php');
$db=$con;// database connection  
//legal input values
 $quoteid        =$_POST['quoteid'];
 $quotet        =$_POST['quotet'];
 $date        =$_POST['date'];
$event_id        =legal_input($_POST['event_id']);
$item_id         =legal_input($_POST['item_id']);

$txtItem_name   = legal_input($_POST['txtItem_name']);
$txtQnty        = legal_input($_POST['txtQnty']);
$txtPrice   = legal_input($_POST['txtPrice']);
$txtLeasedate       = legal_input($_POST['lease_date']);
$txtDescription = legal_input($_POST['txtDescription']);
$txtDay = legal_input($_POST['txtDays']);
$served_by      = $_SESSION['username'];
// $date         =date("Y-m-d h:i:sa");
$company        =$_SESSION['company'];


$total_cost =(int)$txtPrice * (int)$txtQnty * (int)$txtDay;
 
 if(!empty($txtQnty) && !empty($txtPrice)){
    //  Sql Query to insert user data into database table
    Insert_data($quoteid,$quotet,$item_id,$customer_name,$event_id,$txtQnty,$txtItem_name,$txtPrice,$txtDescription,$company,$total_cost,$txtLeasedate,$txtDay,$served_by,$date);
}else{
 echo "All fields are required";
}  
 
// convert illegal input value to ligal value formate
function legal_input($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}
// // function to insert user data into database table
 function insert_data($quoteid,$quotet,$item_id,$customer_name,$event_id,$txtQnty,$txtItem_name,$txtPrice,$txtDescription,$company,$total_cost,$txtLeasedate,$txtDay,$served_by,$date){
 
     global $db;
        

     $query="INSERT INTO `tblquotation`(`identitty`, `item_name`, `description`, `no_days`, `quantity`, `unit_price`, `total_amount`, `company`, `qoutation_title`, `date_create`, `create_by`)VALUES('".$quoteid."','".$txtItem_name."','".$txtDescription."','".$txtDay."', '".$txtQnty."', '".$txtPrice."', '".$total_cost."', '".$company."', '".$quotet."', '".$date."', '".$served_by."')";
     $execute=mysqli_query($db,$query);
     if($execute==true)
     {
      // echo "User data was inserted successfully";
     }else{
      echo  "Error: " . $query . "<br>" . mysqli_error($db);
    }
 
 }

?>