 <?php
  session_start();
if (!isset($_SESSION['userid'])){
}
  ?>
 <?php
include('../connection.php');
$db=$con;// database connection  
//legal input values
$event_id        =legal_input($_POST['event_id']);
$item_id         =legal_input($_POST['item_id']);

$red=mysqli_query($con,"SELECT * FROM tblevents WHERE id='".$event_id."'");
                          if($red){
                              while($romm = mysqli_fetch_assoc($red)){
                                  $event_name =$romm ['event_name'];
                                  $customer_name =$romm['customer_name'];
                                  $start_date=$romm['start_date'];
                                  $end_date=$romm['end_date'];
                                  $start_day=date('d', strtotime($start_date));
                                  $end_day=date('d', strtotime($end_date));
                                  $no_day=$end_day - $start_day;
                                  
                                  
                              }
                          }

$txtItem_name   = legal_input($_POST['txtItem_name']);
$txtQnty        = legal_input($_POST['txtQnty']);
$txtPrice   = legal_input($_POST['txtPrice']);
$txtLeasedate       = legal_input($_POST['lease_date']);
$txtDescription = legal_input($_POST['txtDescription']);
$txtDay = legal_input($_POST['txtDays']);
$served_by      = $_SESSION['username'];
$date         =date("Y-m-d h:i:sa");
$company        =$_SESSION['company'];


$total_cost =(int)$txtPrice * (int)$txtQnty * (int)$txtDay;
 
 if(!empty($txtQnty) && !empty($txtPrice)){
    //  Sql Query to insert user data into database table
    Insert_data($item_id,$customer_name,$event_id,$txtQnty,$txtItem_name,$txtPrice,$txtDescription,$company,$total_cost,$txtLeasedate,$txtDay);
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
 function insert_data($item_id,$customer_name,$event_id,$txtQnty,$txtItem_name,$txtPrice,$txtDescription,$company,$total_cost,$txtLeasedate,$txtDay){
 
     global $db;
        

      $query="INSERT INTO event_quotation(event_item,customer_name,event_id,event_item_name, event_quantity, event_description, event_single_price, event_days,company, total_items, lease_date)VALUES('".$item_id."','".$customer_name."','".$event_id."','".$txtItem_name."', '".$txtQnty."', '".$txtDescription."', '".$txtPrice."', '".$txtDay."', '".$company."', '".$total_cost."', '".$txtLeasedate."')";
     $execute=mysqli_query($db,$query);
     if($execute==true)
     {
      // echo "User data was inserted successfully";
     }else{
      echo  "Error: " . $sql . "<br>" . mysqli_error($db);
    }
 
 }

?>