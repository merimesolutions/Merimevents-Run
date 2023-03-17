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
//Get these details (expiry date, quotation status and creation date)from database
//
//$rfv=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
//while($rom = mysqli_fetch_array($rfv)){
//	$Expirydate =$rom['expiry_date'];
//	$Quotationstatus=$rom['quotation_status'];
//	$Creationdate=$rom['creation_date'];
//}
//
//
//
//echo'<script>alert("'."$event_id".'  '."$Expirydate".' '."$Quotationstatus".'  '""' ");</script>';
$item_id         =legal_input($_POST['item_id']);


//$Expirydate      =legal_input($_POST['expiry_date']);
//$Quotationstatus =legal_input($_POST['quotation_status']);
//$Creationdate    =$_POST['lease_date'];


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
							
//
                          }
$Edate  = $_POST['expiry_date'];
$Qstat  = $_POST['quotation_status'];
$Cdate  = $_POST['creation_date'];
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
    Insert_data($item_id,$customer_name,$event_id,$txtQnty,$txtItem_name,$txtPrice,$txtDescription,$company,$total_cost,$txtLeasedate,$txtDay,$Edate,$Qstat,$Cdate);
}else{
 echo '<center><span class="text-danger"><strong>All fields are required!</strong></span></center>';
}  
 
// convert illegal input value to ligal value formate
function legal_input($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}
// // function to insert user data into database table
 function insert_data($item_id,$customer_name,$event_id,$txtQnty,$txtItem_name,$txtPrice,$txtDescription,$company,$total_cost,$txtLeasedate,$txtDay,$Edate,$Qstat,$Cdate){
 
     global $db;
        

      $query="INSERT INTO event_quotation(event_item,customer_name,event_id,event_item_name, event_quantity, event_description, event_single_price, event_days,company, total_items, lease_date,creation_date,expiry_date,quotation_status,quotation_type)VALUES('".$item_id."','".$customer_name."','".$event_id."','".$txtItem_name."', '".$txtQnty."', '".$txtDescription."', '".$txtPrice."', '".$txtDay."', '".$company."', '".$total_cost."', '".$txtLeasedate."','$Cdate','$Edate','$Qstat','Internal')";
     $execute=mysqli_query($db,$query);
     if($execute)
     {
	echo'<script>window.location="add_editevent_quotation?id='."$event_id".'";</script>';
		// echo '<script>alert("Quotation added succesfully!");</script>';
      // echo "User data was inserted successfully";
     }else{
		 $err= mysqli_error($db);
		 echo'<script>alert( "Error: '."$err".'");window.location="add_editevent_quotation?id= '."$event_id".'";</script>';
//      echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
 
 }

?>
 <script>
 	$("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
 		$("#success-alert").slideUp(500);
 	});
 	$(document).ready(function() {
 		$("#success-alert").hide();
 		$("#myWish").click(function showAlert() {
 			$("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
 				$("#success-alert").slideUp(500);
 			});
 		});
 	});

 </script>
