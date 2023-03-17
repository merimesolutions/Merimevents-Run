<!-- ======== DELETE MODAL ========= -->
<div id="deleteModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete selected data below?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_delete" id="btn_delete" value="Yes"/>
        </div>
    </div>
  </div>
</div>
<!-- ===== END OF DELETE MODAL ===== -->
 

<!-- ======== DELETE MODAL ========= -->
<div id="deleteAcc" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete selected account below?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_acc" id="btn_acc" value="Yes"/>
        </div>
    </div>
  </div>
</div>
<!-- ===== END OF DELETE MODAL ===== -->

<!-- ======== DELETE MODAL ========= -->
<div id="deleteAcccc" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete selected account below?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_acccc" id="btn_acccc" value="Yes"/>
        </div>
    </div>
  </div>
</div>
<!-- ===== END OF DELETE MODAL ===== -->

<!-- ======== DELETE MODAL ========= -->
<div id="delactive" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete selected account below?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_active" id="btn_active" value="Yes"/>
        </div>
    </div>
  </div>
</div>
<!-- ===== END OF DELETE MODAL ===== -->

<!-- ======== DELETE MODAL ========= -->
<div id="deltodo" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete selected tasks below?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_deltodo" id="btn_deltodo" value="Yes"/>
        </div>
    </div>
  </div>
</div>
<!-- ===== END OF DELETE MODAL ===== -->

<!-- ======== DELETE MODAL ========= -->
<?php
include "connection.php";
include 'delete.php';
echo '
<div id="deldemo'.$row['id'].'" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete selected tasks below?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_deldemo" id="btn_deltodo" value="Yes"/>
        </div>
    </div>
  </div>
</div>'
?>
<!-- ===== END OF DELETE MODAL ===== -->