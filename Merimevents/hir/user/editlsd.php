<?php echo '<div id="editLeased'.$row['item_id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:400px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Edit leased item</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['item_id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">

                    <label>Item Name </label>
                    <input name="fname_edit_sy" id="fname_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[a-zA-Z]+" value="'.ucwords($row['item_name']).'" />
                    <br>
                    <label>Quantity </label>
                    <input name="mname_edit_sy" id="mname_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="'.$row['qnty'].'" />
                    <br>
                    <label>Leased Date </label>
                    <input name="lname_edit_sy" id="lname_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="'.$row['ldate'].'" />
                    <br>
                    <label>Returned Datee </label>
                    <input name="gender_edit_sy" id="gender_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="'.ucwords($row['rdate']).'" />
                    <br>
                    <label>Returned Datee </label>
                    <input name="gender_edit_sy" id="gender_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="'.ucwords($row['rdate']).'" />
                    <br>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_save" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>
