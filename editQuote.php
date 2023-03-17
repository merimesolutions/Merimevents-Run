<?php 
include "../connection.php";
echo '<div id="editQuote'.$data['identitty'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:450px !important;">
    <div class="modal-content">
        <div class="modal-header" style="border-radius:2px;color:#000">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><center><strong>Edit Quotation</strong></center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$data['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Task ID </label>
                    <input name="task" id="task" class="form-control input-sm" type="text" rows="4" value="'.ucwords($data['identitty']).'" />
                </div>
                <div class="form-group">
                    <label>Quotation title </label>
                    <input name="start" id="" class="form-control input-sm" type="text" rows="4" value="'.$data['qoutation_title'].'" />
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_editquote" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';

if(isset($_POST['btn_editquote'])){
    $quote_id = $_POST['identitty'];
    $quote_title = $_POST['qoutation_title'];
    $query = mysqli_query($con,"UPDATE tblquotation SET identitty = '".$quote_id."',quotation_title = '".$quote_title."' ");
	    
    if($query == true){
        echo '<script type="text/javascript">'; 
        echo 'alert("Changes made successfully.");'; 
        echo 'window.location.href = window.location.href;';
        echo '</script>';
        exit;
    }

    if(mysqli_error($con)){
        
        echo '<script type="text/javascript">'; 
        echo mysqli_error($con);
        echo 'alert("No changes made.");'; 
        echo 'window.location = "quotation-list.php";';
        echo '</script>';
    }
}

?>