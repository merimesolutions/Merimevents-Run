<?php echo '<div id="editsupplier'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:400px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Edit supplier details</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                <label>Full name </label>
                    <input name="full_name" id="full_name" class="form-control input-sm" type="text" style="width:100%" value="'.ucwords($row['full_name']).'" />
                 </div> 
                
                <div class="form-group">
                <label>Location </label>
                    <input name="location" id="location" class="form-control input-sm" type="text" style="width:100%" value="'.ucwords($row['location']).'" />
                 </div>
                <div class="form-group">
                <label>Contact </label>
                    <input name="contact" id="contact" class="form-control input-sm" type="text" style="width:100%" value="'.ucwords($row['contact']).'" />
                 </div> 
                 
                <div class="form-group">
                <label>Email </label>
                    <input name="email" id="email" class="form-control input-sm" type="text" style="width:100%" value="'.$row['email'].'" />
                 </div>
                 
                <div class="form-group">
                <label>Supply description </label>
                    <input name="description" id="description" class="form-control input-sm" type="text" style="width:100%" value="'.$row['description'].'" />
                 </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_supplier" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>
