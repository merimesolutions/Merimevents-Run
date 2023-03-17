<?php echo '<div id="edit-quote'.$data['id'].'" class="modal fade">
<form method="post" action="edquote.php">
  <div class="modal-dialog modal-sm" style="width:450px !important;">
    <div class="modal-content">
        <div class="modal-header" style="border-radius:2px;color:#000">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><center><strong>Edit Quotation</strong></center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$data['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Item Name </label>
                    <input name="ie" id="" class="form-control input-sm" type="text" rows="4" value="'.$data['item_name'].'" disabled/>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input name="qt" id="" class="form-control input-sm" type="text" rows="4" value="'.$data['quantity'].'" />
                </div>
                <div class="form-group">
                    <label>No of Days  </label>
                    <input name="nd" id="" class="form-control input-sm" type="text" rows="4" value="'.$data['no_days'].'" />
                </div>
                <div class="form-group">
                    <label>Unit Price </label>
                    <input name="uop" id="" class="form-control input-sm" type="text" rows="4" value="'.$data['unit_price'].'" />
                </div>
               
            </div>
        </div>
        </div>
        <div class="modal-footer">
  
            <input type="submit" class="btn btn-primary btn-sm" name="edit_quoe" value="Save"/>
            <input type="submit" class="btn btn-primary btn-sm" name="del_quoe" value="Delete Item"/>
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
        </div>
    </div>
  </div>
</form>
</div>';?>