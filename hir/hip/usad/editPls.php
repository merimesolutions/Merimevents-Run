<?php echo '<div id="editPls'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:400px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Edit Project</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
            
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">

                    <label>Status</label>
                    <select name="status" id="status" type="text"  class="form-control" style="width:100%" placeholder="Enter task title"><option value="" selected disabled></option>
                            <option value="In progress">In progress</option>
                            <option value="Completed">Completed</option> 
                            <option value="Terminated">Terminated</option> 
                            <option value="Paused">Paused</option>                            
                    </select>
                </div>
                <div class="form-group">
                <label>Task title </label>
                    <input name="project" id="project" class="form-control input-sm" type="text" style="width:100%" value="'.ucwords($row['project']).'" />
                 </div>   
                <div class="form-group">
                        <label>Started</label>
                        <input required name="started" id="started" class="form-control" style="width: 100%" type="date" value="'.ucwords($row['started']).'"/>
                </div>

                <div class="form-group">
                        <label>Deadline</label>
                        <input required name="deadline" id="deadline" class="form-control" style="width: 100%" type="date" value="'.ucwords($row['deadline']).'"/>
                    </div>
                </div>
            </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_pls" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>
