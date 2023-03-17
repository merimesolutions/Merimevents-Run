<?php 
 $company = $_SESSION['company'];
$user1 = mysqli_query($con,"SELECT * FROM tblusers ORDER BY full_name ");


echo '<div id="editprogress'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:400px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Edit Progress</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">

                    <label>Percentage 0-100%</label>
                    <input name="progress_edit_sy" id="progress_edit_sy" class="form-control input-sm" type="number" min="0" max="100" maxlength="3" pattern="[0-9]+" value="'.ucwords($row['percentage']).'" required/>
                     
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_progress" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';
?>
<script>
  $(document).ready(function () {
  $("#person_edit_sy").CreateMultiCheckBox({ width: '230px',
             defaultText : 'Edit person', height:'250px' });
});
</script>