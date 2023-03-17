<?php
  session_start();
if (!isset($_SESSION['userid'])){
   // require "../redirect.php";
}
?><?php
        $con = mysqli_connect("localhost","merimeve_event","user@event","merimeve_event");

     
        //Additional Costs
        $event_id =$_POST['event_id'];
        $cost_name =$_POST['costName'];
        $cost_description=$_POST['costDescription'];
        $cost_unit_price=$_POST['costPrice'];
        $company=$_SESSION['company'];

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
                $sqme =mysqli_query($con,"INSERT INTO additional_costs(event_id,cost_name,cost_description,cost_quantity,cost_price,company,costperunit,total_price,supplier,quotation_type) VALUES ('$event_id','$value2','$cost_description[$key2]','$cost_quantity[$key2]','$total_price','$company','$cost_unit_price[$key2]','$total','$supplier[$key2]','External')");
                
                if(!$sqme){
                    $error=mysqli_error($con);}
            }
            if($sqme){
                // echo'<script>alert("Quotation Added succesfully!");window.location="view_event.php?id='."$event_id".'";</script>';
             }//if(!$sqme){
            //      echo'<script>alert(" An error occured during submission'."$error".'");window.location="add_event_quotation.php?id='."$event_id".'";</script>';
            // }
 
        ?>
