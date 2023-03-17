<?php echo '<div id="edit'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:650px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Edit  record</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                    <label>Status</label>
                    <input name="status" id="status" class="form-control input-sm" type="text" style="width:100%" value="'.$row['status'].'" required />
                    <span> Change to: <i>Active</i> / <i>Inactive</i> </span>
            </div>
        </div>        
            <div class="col-md-6">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Customer Name</label>
                    <input name="full_name" id="full_name" class="form-control input-sm" type="text" style="width:100%" value="'.$row['full_name'].'" readonly />
                </div>
                <div class="form-group">
                    <label>Company Name</label>
                    <input name="companyname" id="companyname" class="form-control input-sm" type="text" style="width:100%" value="'.$row['companyname'].'" readonly />
                </div>
                <div class="form-group">
                    <label>Company Location</label>
                    <input name="location" id="location" class="form-control input-sm" type="text" style="width:100%" value="'.$row['location'].'" readonly />
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" id="email" class="form-control input-sm" type="text" style="width:100%" value="'.$row['email'].'" readonly />
                </div>
                <div class="form-group">
                    <label>Contact number</label>
                    <input name="contact" id="contact" class="form-control input-sm" type="text" style="width:100%" value="'.$row['contact'].'" readonly />
                </div>
                <div class="form-group">
                    <label>Package</label>
                    <input name="contact" id="contact" class="form-control input-sm" type="text" style="width:100%" value="'.$row['package'].'" required />
                    <span> Change to: <i style="color:red">1</i> for Bronze, <i style="color:red">2</i> for Silver, <i style="color:red">3</i> for Gold</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="editButton" id="editButton" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>
