<?php echo '<div id="editirs'.$row['item_id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:400px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/returning.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Return item</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['item_id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">

                    <label>Item Name </label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" disabled value="'.ucwords($row['item_name']).'" />
                    <br>
                    <label>Remaining items</label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" disabled pattern="[0-9]+" value="'.$row['bal_qnty'].'"/>
                    <br>
                    <label>Returned items in good condition </label>
                    <input name="rqnty_edit_sy" id="rqnty_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="" pattern="[0-9]+" required placeholder="Enter number of items returned in good condition"/>
                    <br>
                    <label>Damaged items </label>
                    <input name="damaged_edit_sy" id="damaged_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="" pattern="[0-9]+" required placeholder="Enter number of items damaged"/>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_return" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>
