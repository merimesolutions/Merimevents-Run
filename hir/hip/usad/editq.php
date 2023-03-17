<?php echo '<div id="editq'.$row['invoice'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:350px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Update Invoice Details</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['random'].'" name="hidden_i" id="hidden_id"/>
                <input type="hidden" value="'.$items_id_things['random'].'" name="hidden_d" id="hidden_id"/>
                <input type="hidden" value="'.$row['invoice'].'" name="hidden_id" ="invoice"/>
                <input type="hidden" value="'.$row['company'].'" name="company" id="invoice"/>
                <div class="form-group">
                    <label>Item name</label>
                    <select name="itemn" onchange="showUser(this.value)" class="form-control input-sm" style="background: linear-gradient(to right, #00ffff 0%, #66ccff 100%);">
                        <option value="' . $item_id . '">' . $itemn . '</option>';  
                        $a = mysqli_query($con,"SELECT * from tblitems where qnty>0 and company='".$_SESSION['company']."' ORDER BY item_name");
                            while($row=mysqli_fetch_array($a)){
                                echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).'</option>';
                            }  ;
                      echo'                                                                                    
                    </select>
                    <br>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input name="quantity" id="person_id" class="form-control input-sm" type="text" style="width:100%" value="'.$qnty.'" " />
                    <br>
                </div>
                <div class="form-group">
                    <label>Price of item</label>
                    <input name="price" id="amount" class="form-control input-sm" type="number" pattern="[0-9]+" style="width:100%" value="'.$amount.'"/>
                    <br>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input name="ldate" id="trans" class="form-control input-sm" type="date" style="width:100%" value="'.$ldate.'"/>
                    <br>
                </div>
                <div class="form-group">
                    <label>Expiry date</label>
                    <input name="expdate" id="trans" class="form-control input-sm" type="date" style="width:100%" value="'.$expdate.'"/>
                    <br>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_quote1" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';


// <label>Item name</label>
// <input name="itemn" id="person" class="form-control input-sm" type="text" style="width:100%" value="" required placeholder="Name of Person paying" />

?>
