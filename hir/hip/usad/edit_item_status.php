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
 $compp=$_SESSION['company'];
 include "../connection.php";

if(isset($_POST['btn_edit_item'])){
    $event_idd =$_POST['event_id'];
    $event_itemm =$_POST['item_name'];
    $damage_status =$_POST['damage_status'];
    $return_date=$_POST['return_date'];
    //Check if this item has already been returned
    $fda =mysqli_query($con,"SELECT * FROM event_items WHERE event_item='$event_itemm' AND event_id='$event_idd' AND altered=1 ");
    if($fda){
        $numero = mysqli_num_rows($fda);
        if($numero > 0){
            echo'<script>alert("This item had previously been returned");window.location="view_event.php?id='."$event_idd".'";</script>';
        }
    }
    //Check all items present in the database before the return
    $remo =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$event_itemm' AND company='$compp'");
    if($remo){
        while($dax = mysqli_fetch_assoc($remo)){
        $qty_before_return = $dax['qnty'];
         //Get the number of items requested
    $betra =mysqli_query($con,"SELECT * FROM event_quotation WHERE event_item='$event_itemm' AND event_id='$event_idd'");
    while($roty = mysqli_fetch_array($betra)){
        $original_quantity =$roty['event_quantity'];
    }
   if(!empty($_POST['damaged_quantity'])){
       $damaged_quantity=$_POST['damaged_quantity'];
       $good_condition = $original_quantity - $damaged_quantity;
       
   }else{
       $damaged_quantity = 0;
       $good_condition = $original_quantity;
   }
   //Quantity after return
    $new_quantity = $qty_before_return + $good_condition;
   
    }
    //Insert into DB
   
    $sqf =mysqli_query($con,"INSERT INTO event_items (event_id,event_item,damage_status,damage_quantity,original_quantity,good_condition,company,return_date,altered) VALUES ('$event_idd','$event_itemm','$damage_status','$damaged_quantity','$original_quantity','$good_condition','$compp','$return_date',1)");
if($sqf){
    $ter=mysqli_query($con,"UPDATE event_quotation SET return_status='returned' WHERE event_id='$event_idd' AND event_item='$event_itemm' AND event_quantity='$original_quantity'");
    //Update AVAILABLE STOCK
     $wezz =mysqli_query($con,"UPDATE tblitems SET qnty='$new_quantity' WHERE id='$event_itemm' AND company='$compp'");
     if(!$wezz){
         $makosa = mysqli_error($con);
         echo '<script>alert("'."$makosa".'");</script>';
     }
    echo'<script>alert("returned item added succesfully!!");window.location="view_event.php?id='."$event_idd".'"</script>';
    
    
}else{
    $erry =mysqli_error($con);
     echo'<script>alert("'."$erry".' ");window.location="view_event.php?id='."$event_idd".'"</script>';
}
}
}
?>
<!---Edit item event status-->
<div id="edititemstatus<?php echo $event_iddd ;?>" class="modal fade">
<form method="post" action="" enctype="multipart/form-data">
  <div class="modal-dialog modal-sm" style="width:400px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Add a  returned Item</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                 
                $sql =mysqli_query($con,"SELECT * FROM event_quotation WHERE  event_id='$event_iddd'");
                if($sql){
                    while($roy = mysqli_fetch_assoc($sql)){
                      $sele =mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event_iddd'");
                      if($sele){
                          while($royy =mysqli_fetch_assoc($sele)){
                              $event_named = $royy['event_name'];
                              $customer_named =$royy['customer_name'];
                          }
                      }
                    }
                   
                }
                ?>
              <strong><h4 style="font-family:fangsong;" class="text-center"><?php echo $customer_named; ?> &nbsp; <?php echo $event_named; ?></h4></strong>
                <input type="hidden" name="event_id" value="<?php echo $event_iddd; ?>">
               
                 <div class="form-group">
 
        
                    <label>Select item</label>
                      <input type="text" class="form-control" name="item_name"   list="returnitems" id="myInput" placeholder="Enter Item Name" Required>
    <datalist id="returnitems" style="list-style:none!important;">
       <?php 
           
               
                $sp=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_iddd'");
                if($sp){
                  
                while ($row = mysqli_fetch_assoc($sp)){
                   $itemquantity =$row['event_quantity'];
                   $itemid=$row['event_item'];
                    
            ?>
               
                <option  id="myTable" value="<?php echo $row['event_item'];
                ?>">
               <?php
               $sq =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$itemid'");
                                                    while($datax = mysqli_fetch_array($sq)){
                                                        $item_namez= $datax['item_name'];
                                                    }
               ?>
                  <?php echo $item_namez; ?>
                </option>
            <?php 
                }
                  
                }
                // While loop must be terminated
            ?>
        
    </datalist>
                </div>
               <label>Were there any damaged units?</label>
               <div class="form-group">
                <select class="form-control" name="damage_status" Required>
                    <option disabled selected>Select </option>
                    <option value="damaged">Yes</option>
                    <option value="notdamaged">No</option>
                </select>
                </div>
                <label>If Yes Enter the quantity of damaged units</label>
               <div class="form-group">
                <input name="damaged_quantity" class="form-control" type="number" placeholder="Enter Number">
                </div>
               
               
                 <label>Enter Date of Return</label>
               <div class="form-group">
                <input name="return_date" class="form-control" type="date" Required >
                </div>
               
               
               
                
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_edit_item" value="Save"/>
        </div>
    </div>
  </div>
</div>
</form>
</div>
<script>
	$(document).ready(function() {
				$('.checkall').on('click', function() {

					}
				}

</script>

<script>
    $('.custom_select').change(function() {
  if (($(this).val() == 'damaged') {
    $('.showcontent1').show();
  
  } else {
    
    $('.showcontent1').hide();
  }
});
</script>




<!-------------------------->