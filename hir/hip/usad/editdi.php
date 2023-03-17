<?php echo '<div id="editDi'.$row['item_id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:400px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Damaged items clearance</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['item_name_id'].'" name="hidden_id" id="hidden_id"/>
                <input type="hidden" value="'.$row['identity'].'" name="identity_edit_sy" id="identity_edit_sy"/>
                <input type="hidden" value="'.$row['item_name'].'" name="item_name_edit_sy" id="item_name_edit_sy"/>
                <input type="hidden" value="'.$row['damaged'].'" name="damaged_edit_sy" id="damaged_edit_sy"/>
                <input type="hidden" value="'.$row['item_name_id'].'" name="item_name_id_edit_sy" id="item_name_id_edit_sy"/>
                <div class="form-group">

                    <label>Client Name </label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" title="This field is disabled" disabled value="'.ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']).'" />
                    <br>
                    <label>Item Name </label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" title="This field is disabled" disabled value="'.ucwords($row['item_name']).'" />
                    <br>
                    <label>Damaged Quantity </label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" disabled title="This field is disabled" value="'.$row['damaged'].'" />
                    <br>
                    <label>Amount Paid</label>
                    <input name="amount_paid_edit_sy" id="amount_paid_edit_sy" class="form-control input-sm" type="text" style="width:100%" title="This field is disabled" />
                    <br>
                    <label>Option</label>
                    <select name="option_edit_sy" id="option_edit_sy" type="text"  class="form-control input-sm">
                        <option value="" selected disabled>Payment option</option>
                        <option value="cleared">Cleared all</option>
                        <option value="not cleared">Cleared Partially</option>
                    </select>
                    <br>
                    <label>Clearance comment</label>
                    <textarea name="comment_edit_sy" id="comment_edit_sy" class="form-control input-sm" type="text"></textarea>
                    <br>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_clear_comment" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>
