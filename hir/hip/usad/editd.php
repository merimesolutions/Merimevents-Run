<?php echo '<div id="editd'.$rows['invoice'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:350px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Update Overdue Penalty Details</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$rows['invoice'].'" name="hidden_id" id="hidden_id"/><input type="hidden" value="'.$rows['invoice'].'" name="hidden_id" id="hidden_id"/>
               <input type="hidden" value="'.$rows['company'].'" name="company" id="invoice"/>
                <div class="form-group">
                    <label>Item name</label>
                    <select name="itemn4" onchange="showUser(this.value)" class="form-control input-sm" style="background: linear-gradient(to right, #00ffff 0%, #66ccff 100%);">
                        <option value="' . $item_id . '">' . $itens . '</option>';  
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
                    <input name="quantity3" id="person_id" class="form-control input-sm" type="number" style="width:100%" value="'.$rows['qnty'].'"  />
                    <br>
                </div>
                <div class="form-group">
                    <label>Price of item</label>
                    <input name="price3" id="amount" class="form-control input-sm" type="number" pattern="[0-9]+" style="width:100%" value="'.$rows['price'].'"/>
                    <br>
                </div>
               
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_od" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';


// <label>Item name</label>
// <input name="itemn" id="person" class="form-control input-sm" type="text" style="width:100%" value="" required placeholder="Name of Person paying" />

?>
