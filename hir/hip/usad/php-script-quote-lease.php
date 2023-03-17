<?php
  session_start();
if (!isset($_SESSION['userid'])){
}
  ?>
 <?php
include('../connection.php');
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$db=$con;// database connection  
//legal input values
 $quoteid        =$_POST['quoteid'];
 $myInput        =$_POST['myInput'];
 $quotet        =$_POST['quotet'];
 $ldate        =$_POST['l_date'];
//  $expdate   = date($ldate, strtotime('+1 years'));
//  $expdate=date('Y-m-d H:i:s', strtotime($ldate. '+3 days'));
$expdate=$_POST['e_date'];
$quotation_status= $_POST['quotation_status'];
$event_id        =legal_input($_POST['event_id']);
$item_id         =legal_input($_POST['item_id']);

$txtItem_name   = legal_input($_POST['txtItem_name']);
$txtQnty        = legal_input($_POST['txtQnty']);
$txtPrice   = legal_input($_POST['txtPrice']);
// $txtLeasedate       = legal_input($_POST['lease_date']);
$txtDescription = legal_input($_POST['txtDescription']);
$txtDay = legal_input($_POST['txtDays']);
$served_by      = $_SESSION['username'];
// $date         =date("Y-m-d h:i:sa");
$company        =$_SESSION['company'];


$total_cost =(int)$txtPrice * (int)$txtQnty * (int)$txtDay;
 
 if(!empty($txtQnty) && !empty($txtPrice)){
    //  Sql Query to insert user data into database table
    Insert_data($myInput,$quoteid,$quotet,$item_id,$event_id,$txtQnty,$txtItem_name,$txtPrice,$txtDescription,$company,$total_cost,$txtDay,$served_by,$ldate, $expdate, $quotation_status);
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
 function insert_data($myInput,$quoteid,$quotet,$item_id,$event_id,$txtQnty,$txtItem_name,$txtPrice,$txtDescription,$company,$total_cost,$txtDay,$served_by,$ldate, $expdate, $quotation_status){
 
     global $db;
        

     $query="INSERT INTO `tblquotation`(`identitty`, `item_name`, `description`, `no_days`, `quantity`, `unit_price`, `total_amount`, `company`, `qoutation_title`, `date_create`, `expire_date`, `quotation_status`, `create_by`, `customer_name`)VALUES('".$quoteid."','".$txtItem_name."','".$txtDescription."','".$txtDay."', '".$txtQnty."', '".$txtPrice."', '".$total_cost."', '".$company."', '".$quotet."', '".$ldate."', '".$expdate."','".$quotation_status."', '".$served_by."', '".$myInput."')";
     $execute=mysqli_query($db,$query);
     if($execute==true)
     {
      // echo "User data was inserted successfully";
     }else{
      echo  "Error: " . $query . "<br>" . mysqli_error($db);
    }
 
 }

?>