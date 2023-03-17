<?php
$id = $row['id'];
$qnty =$row['qnty'];
echo '<div id="editrei'.$row['id'].'" class="modal fade">
<form method="post" id="reiform">
  <div class="modal-dialog modal-sm" style="width:550px !important;">
    <div class="modal-content">
   
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Restocking the existing items</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">

                    <label>Item Name </label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" title="This field is disabled" disabled value="'.ucwords($row['item_name']).'" />
                    <br>
                  <div class="row">
                  <div class="col-lg-6">
                    <label>Batch</label>
                    <input name="" id="" class="form-control input-sm" type="text" style="width:100%" title="This field is disabled" disabled value="'.ucwords($row['bno']).'" />
                      </div>
                      <div class="col-lg-6">';
                      ?>
<label>Supplier </label>
<div class="input-group mb-2">

	<span class="input-group-addon bg-white border-right-0 px-4"><i class="fa fa-user"></i></span>

	<input type="text" class="form-control" name="supplier" value="" list="cust" id="data1" onchange="get_data()" placeholder="Select supplier">

	<datalist id="cust" style="list-style:none!important;">
		<?php 
           
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                $sp=mysqli_query($con, "SELECT * FROM tblsuppliers WHERE company='".$_SESSION['company']."'");
                if($sp){
                  
                while ($row_supply = mysqli_fetch_assoc($sp)){
                    
                    
            ?>

		<option data-value="<?php echo $_GET['client'] = $row_supply['id'];?>" value="<?php echo $row_supply['full_name'];?>">


		</option>
		<?php 
                }
                  
                }
                 
            ?>

	</datalist>

</div>
<span class="mt-3 small"><a class="btn btn-info btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#addSupplier"><i class="fas fa-plus"></i> Add Supplier</a></span>
<?php echo '</div>
                      </div>
                      <br>
                    <label>Current Quantity </label>
                    <input name="" id="current_q" class="form-control input-sm"type="text" style="width:100%" disabled title="This field is disabled" value="'.$row['qnty'].'" />
                    <br>
                    <label>Additional Quantity</label>
                    <input name="add_edit_sy" id="new_quantity" autocomplete="off" onkeyup=" return myFunction('.$id.','.$row['qnty'].',this.value)" class="form-control input-sm" type="text" style="width:100%" value="" />
                    <br>
                    <label>New Quantity</label>
                    <span id="summed_quantity'.$row['id'].'" class="text-success form-control" style="font-family:fangsong;"></span>
  
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_restock_item" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';
               
?>

