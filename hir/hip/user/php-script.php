 <?php
  session_start();
if (!isset($_SESSION['userid'])){
}
  ?>
 <?php
include('../connection.php');
$db=$con;// database connection  
//legal input values
$txtItem_name   = legal_input($_POST['txtItem_name']);
$txtQnty        = legal_input($_POST['txtQnty']);
$txtbal_Qnty    = legal_input($_POST['txtQnty']);
$txtbal_Price   = legal_input($_POST['txtPrice']);
$txtRdate       = legal_input($_POST['txtRdate']);
$today          = date("Y-m-d");
$txtDescription = legal_input($_POST['txtDescription']);
$served_by      = $_SESSION['username'];
$comment        ="not cleared";
$date           =date("Y-m-d");
$time           =date("h:i:sa");
$random         =date("Y-m-dh:i:sa");
$member         = legal_input($_POST['id_yake']);
$invoice        = legal_input($_POST['invoice']);
$cancellation   = "active";
$company        =$_SESSION['company'];
$client         =legal_input($_POST['client']);
$time2 = strtotime($date);

$time1 = strtotime($txtRdate);
$dif   = floor( ($time1-$time2) /(60*60*24));
$total_cost = $dif * $txtQnty * $txtbal_Price;

   
if(!empty($txtQnty) && !empty($txtbal_Price) && !empty($txtRdate)){
    //  Sql Query to insert user data into database table
    Insert_data($txtQnty,$txtItem_name,$txtbal_Qnty,$txtbal_Price,$txtRdate,$today,$txtDescription,$served_by,$member,$comment,$time,$company,$cancellation,$total_cost,$client);
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
 function insert_data($txtQnty,$txtItem_name,$txtbal_Qnty,$txtbal_Price,$txtRdate,$today,$txtDescription,$served_by,$member,$comment,$time,$company,$cancellation,$total_cost,$client){
 
     global $db;
     
     $qry = mysqli_query($db, "select * from tblitems where id='".$txtItem_name."' ");
            while($row = mysqli_fetch_array($qry))
                        {
               $qnty= $row['qnty'];
               $bal = $qnty - $txtQnty ; 
    if($qnty>$txtQnty){         
     $q = mysqli_query($db,"UPDATE tblitems SET qnty = '".$bal."' where id = '".$txtItem_name."' ");
      

      $query="INSERT INTO tblleased(item_name_id,qnty,qlty,rdate,ldate,served_by,client,bal_qnty, price,comment,lease_time,company,cancellation,total_cost)VALUES('".$txtItem_name."','".$txtQnty."','".$txtDescription."','".$txtRdate."','$today','".$served_by."','".$client."','".$txtQnty."','".$txtbal_Price."','".$comment."','".$time."','".$company."','".$cancellation."','".$total_cost."')";
     $execute=mysqli_query($db,$query);
     if($execute==true)
     {
      /// echo "User data was inserted successfully";
     }else{
      echo  "Error: " . $sql . "<br>" . mysqli_error($db);
    }
 }else{
    echo "Insufficient stock level";
 }
 }
 }
?>