<?php echo '<div id="editts'.$row['id'].'" class="modal fade">
<form method="post">
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
                    <select name="txtTask[]" id="txtTask[]" type="text"  class="form-control" style="width:100%">
                       <option value="'.$row['id'].'">'.ucwords($row['id']).'</option>
                                                        
                                                </select>
                    <br>
                    <label>Batch</label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" title="This field is disabled" disabled value="" />
                    <br>
                    <label>Current Quantity </label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" disabled title="This field is disabled" value="" />
                    <br>
                    <label>Additional Quantity</label>
                    <input name="add_edit_sy" id="add_edit_sy" class="form-control input-sm" type="text" pattern="[0-9]+" style="width:100%" value="" />
                    <br>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_ts" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>
