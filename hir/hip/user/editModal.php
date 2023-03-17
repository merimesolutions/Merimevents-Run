<?php echo '<div id="editModal'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:600px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Edit customers record</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">

                    <label>First Name </label>
                    <input name="fname_edit_sy" id="fname_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[a-zA-Z]+" value="'.ucwords($row['fname']).'" />
                    <br>
                    <label>Middle Name </label>
                    <input name="mname_edit_sy" id="mname_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="'.$row['mname'].'" />
                    <br>
                    <label>Last Name </label>
                    <input name="lname_edit_sy" id="lname_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="'.$row['lname'].'" />
                    <br>
                    <label>Gender </label>
                    <input name="gender_edit_sy" id="gender_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="'.ucwords($row['gender']).'" />
                    <br>
                    <label>National ID </label>
                    <input name="identity_edit_sy" id="identity_edit_sy" class="form-control input-sm" type="text" pattern="[0-9]+" style="width:100%" value="'.$row['identity'].'" />
                    <br>
                    <label>First Contact </label>
                    <input name="fcontact_edit_sy" id="fcontact_edit_sy" class="form-control input-sm" type="text"  style="width:100%" value="'.$row['fcontact'].'" />
                    <br>
                     <label>Physical Address </label>
                    <input name="phy_address_edit_sy" id="phy_address_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z0-9 ]+" style="width:100%" value="'.ucwords($row['phy_address']).'" />
                </div>
            </div>

            <div class="col-md-6">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                <label>Second Contact </label>
                    <input name="scontact_edit_sy" id="scontact_edit_sy" class="form-control input-sm" type="text" pattern="[0-9]+" style="width:100%" maxlength="12" value="'.$row['scontact'].'" />
                    <br>
                    <label>Postal Code </label>
                    <input name="code_edit_sy" id="code_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[0-9]+" maxlength="12" value="'.$row['code'].'" />

                     <br>
                    <label>Box No. </label>
                    <input name="box_edit_sy" id="box_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[0-9]+" value="'.$row['box'].'" />

                     <br>
                    <label>Town </label>
                    <input name="town_edit_sy" id="town_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[a-zA-Z ]+" value="'.ucwords($row['town']).'" />

                    <br>
                    <label>Business / company </label>
                    <input name="b_c_name_edit_sy" id="b_c_name_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="'.ucwords($row['b_c_name']).'" />

                     <br>
                    <label>Business / Company Location </label>
                    <input name="b_c_location_edit_sy" id="b_c_location_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="'.ucwords($row['b_c_location']).'" />';
                   if($row['state']=='0'){
                    echo '
                    <br>
                    <label>Customer type</label>
                     <select class="form-control" id="exampleFormControlSelect1" required name="customer_type">
                        <option selected disabled>Change Customer type</option>
                        <option value="1">Client</option>
                        <option value="0">Lead</option>
                    </select>';
                }
                    echo '

                </div>
        </div>


        <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                   
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
</div>';
?>

<?php echo '<div id="viewModalzz'.$customer_id.'" class="modal fade">
<form>
  <div class="modal-dialog modal-sm" style="width:600px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>View  customers records</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">

                    <label>First Name </label>
                    <input name="fname_edit_sy" id="fname_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[a-zA-Z]+" value="'.ucwords($row['fname']).'" readonly/>
                    <br>
                    <label>Middle Name </label>
                    <input name="mname_edit_sy" id="mname_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="'.$row['mname'].'" readonly />
                    <br>
                    <label>Last Name </label>
                    <input name="lname_edit_sy" id="lname_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="'.$row['lname'].'" readonly/>
                    <br>
                    <label>Gender </label>
                    <input name="gender_edit_sy" id="gender_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z]+" style="width:100%" value="'.ucwords($row['gender']).'" readonly />
                    <br>
                    <label>National ID </label>
                    <input name="identity_edit_sy" id="identity_edit_sy" class="form-control input-sm" type="text" pattern="[0-9]+" style="width:100%" value="'.$row['identity'].'" readonly />
                    <br>
                    <label>First Contact </label>
                    <input name="fcontact_edit_sy" id="fcontact_edit_sy" class="form-control input-sm" type="text"  style="width:100%" value="'.$row['fcontact'].'" readonly/>
                </div>
            </div>

            <div class="col-md-6">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                <label>Second Contact </label>
                    <input name="scontact_edit_sy" id="scontact_edit_sy" class="form-control input-sm" type="text" pattern="[0-9]+" style="width:100%" maxlength="12" value="'.$row['scontact'].'" readonly/>
                    <br>
                    <label>Postal Code </label>
                    <input name="code_edit_sy" id="code_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[0-9]+" maxlength="12" value="'.$row['code'].'" readonly />

                     <br>
                    <label>Box No. </label>
                    <input name="box_edit_sy" id="box_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[0-9]+" value="'.$row['box'].'" readonly/>

                     <br>
                    <label>Town </label>
                    <input name="town_edit_sy" id="town_edit_sy" class="form-control input-sm" type="text" style="width:100%" pattern="[a-zA-Z ]+" value="'.ucwords($row['town']).'" readonly />

                    <br>
                    <label>Business / company </label>
                    <input name="b_c_name_edit_sy" id="b_c_name_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="'.ucwords($row['b_c_name']).'" readonly/>

                     <br>
                    <label>Business / Company Location </label>
                    <input name="b_c_location_edit_sy" id="b_c_location_edit_sy" class="form-control input-sm" type="text" style="width:100%" value="'.ucwords($row['b_c_location']).'" readonly/>

                </div>
        </div>


        <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Physical Address </label>
                    <input name="phy_address_edit_sy" id="phy_address_edit_sy" class="form-control input-sm" type="text" pattern="[a-zA-Z0-9 ]+" style="width:100%" value="'.ucwords($row['phy_address']).'" readonly/>
                </div>
        </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
          
        </div>
    </div>
  </div>
</form>
</div>';?>

<!-- Email us -->
