<?php
$id = $row['id'];
$qnty =$row['qnty'];
echo '<div id="editrei'.$row['id'].'" class="modal fade">
<form method="post" id="reiform">
  <div class="modal-dialog modal-sm" style="width:400px !important;">
    <div class="modal-content">
   
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Restocking the existing items</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">

                    <label>Item Name </label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" title="This field is disabled" disabled value="'.ucwords($row['item_name']).'" />
                    <br>
                    <label>Batch</label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" title="This field is disabled" disabled value="'.ucwords($row['bno']).'" />
                    <br>
                    <label>Current Quantity </label>
                    <input name="" id="current_q" class="form-control input-sm"type="text" style="width:100%" disabled title="This field is disabled" value="'.$row['qnty'].'" />
                    <br>
                    <label>Additional Quantity</label>
                    <input name="add_edit_sy" id="new_quantity" autocomplete="off" onkeyup=" return myFunction('.$id.')" class="form-control input-sm" type="text" style="width:100%" value="" />
                    <br>
                    <label>New Quantity</label>
                    <span id="summed_quantity" class="text-success form-control" style="font-family:fangsong;"></span>
  
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_restock_item" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';
               
?>
 