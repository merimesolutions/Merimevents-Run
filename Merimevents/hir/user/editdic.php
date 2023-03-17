<?php echo '<div id="editdic'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:400px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/settings.png" class="img-circle" alt="icon" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center> Set Pricing / Charges</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">

                	<label>Batch No </label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" disabled value="'.ucwords($row['bno']).'" />
                    <br>
                    <label>Item Name </label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" disabled value="'.ucwords($row['item_name']).'" />
                    <br>
                    <label>Quality</label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" disabled pattern="[0-9]+" value="'.ucwords($row['qlty']).'"/>
                    <br>
                    <label>Damage charges (per item) <span style="color:red">*</span> </label>
                    <input name="damaged_edit_sy" id="damaged_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="'.$row['damage_charges'].'" required/>
                    <br>
                    <label>Overdue charges (per day) <span style="color:red">*</span> </label>
                    <input name="overdue_edit_sy" id="overdue_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="'.$row['overdue_charges'].'" required/>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_pc" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>
