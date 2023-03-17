<?php echo '<div id="editToDo'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:450px !important;">
    <div class="modal-content">
        <div class="modal-header" style="border-radius:2px;color:#000">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><center><strong>Edit task</strong></center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Task </label>
                    <input name="task" id="task" class="form-control input-sm" type="text" rows="4" value="'.ucwords($row['task']).'" />
                </div>
                <div class="form-group">
                    <label>Date to be done </label>
                    <input name="start" id="" class="form-control input-sm" type="date" rows="4" value="'.$row['start'].'" />
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_edittodo" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>