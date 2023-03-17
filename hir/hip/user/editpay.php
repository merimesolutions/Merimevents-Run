<?php echo '<div id="editpay'.$row['invoice'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:350px !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Update Payments</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['random'].'" name="hidden_id" id="hidden_id"/>
                <input type="hidden" value="'.$row['invoice'].'" name="invoice" id="invoice"/>
                <div class="form-group">
                    <label>Full name</label>
                    <input name="person" id="person" class="form-control input-sm" type="text" style="width:100%" value="" required placeholder="Name of Person paying" />
                    <br>
                </div>
                <div class="form-group">
                    <label>Identity (National ID / Passport)</label>
                    <input name="person_id" id="person_id" class="form-control input-sm" type="text" style="width:100%" value="" required placeholder="National ID / Passport" />
                    <br>
                </div>
                <div class="form-group">
                    <label>Amount Paid</label>
                    <input name="amount" id="amount" class="form-control input-sm" type="text" pattern="[0-9]+" style="width:100%" value="" required placeholder="Amount paid" />
                    <br>
                </div>
                <div class="form-group">
                    <label>Transaction code</label>
                    <input name="trans" id="trans" class="form-control input-sm" type="text" style="width:100%" value="" required placeholder="Mpesa Transaction ID / Cheque No. / etc" />
                    <br>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_pay" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>
