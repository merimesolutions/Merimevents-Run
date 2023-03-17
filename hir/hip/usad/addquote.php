
 <!-------------------------Quotation Modal-------------------------------------->
<div id="taskstasks<?php echo $row['id'];?>" class="modal fade">
<form method="post" action="" enctype="multipart/form-data">
  <div class="modal-dialog modal-lg" style="width:100% !important;">
    <div class="modal-content">
        <div class="modal-header" style="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="pull-left image">
                <img src="../../images/icons/doc_edit.png" class="img-circle" alt="User Image" style="width:35px"/>
              </div>
            <h4 class="modal-title"><center>Add Quotation</center></h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <strong><h4 class="text-center font-weight-bold" style="font-family:fangsong; margin-bottom:30px!important"><?php echo $row['customer_name'];?>&nbsp;<?php echo $row['event_name']; ?></h4></strong>
             <input type="hidden" name="event_name" value="<?php echo $row['event_name'];?>"> 
            <input type="hidden" name="event_id" value="<?php echo $row['id'];?>">
 
             
                <div class="form-group">
 
        
                    <label>Select Item</label>
                      <input type="text" class="form-control" name="item_name"  list="itemz" id="myInput" placeholder="Enter item" Required>
    <datalist id="item" style="list-style:none!important;">
       <?php 
           
               
                $sp=mysqli_query($con,"SELECT * FROM tblitems WHERE company='$compp'");
                if($sp){
                  
                while ($row = mysqli_fetch_assoc($sp)){
                   
                    
            ?>
               
                <option  id="myTable" value="<?php echo $row['item_name'];
                ?>">
               
                  
                </option>
            <?php 
                }
                  
                }
                // While loop must be terminated
            ?>
        
    </datalist>
                </div>
                <div class="form-group">
                <label>Enter Description</label>
                    <input name="item_description"  placeholder="Enter Item description"class="form-control input-sm" type="text" style="width:100%" value="" />
                 </div> 
                <div class="form-group">
                <label>Enter Quantity</label>
                    <input name="item_quantity"  placeholder="Enter Quantity" class="form-control input-sm" type="number" style="width:100%" value="" />
                 </div> 
                  <div class="form-group">
                        <label>Price/Item</label>
                      <input type="number" class="form-control input-sm" placeholder="Enter Price/item">
                    </div>
                    <label>Additional Costs</label>
                    <div class="form-row">
                        <label>Name of expense:</label>
                        <div class="form-group col-lg-6 col-md-6">
                             <input type="text" class="form-control input-sm" placeholder="Enter Name">
                        </div>
                        <label>Cost of Expense</label>
                        <div class="form-group col-lg-6 col-md-6">
                             <input type="number" class="form-control input-sm" placeholder="Enter Price in Ksh">
                        </div>
                        
                    </div>
                 <!--<div class="form-group">-->
                 <!--       <label>Start Date</label>-->
                 <!--       <input required name="start_date" id="started" class="form-control" style="width: 100%" type="date" />-->
                 <!--   </div>-->
                    
              
                 <!--   <div class="form-group">-->
                 <!--       <label>Deadline</label>-->
                 <!--       <input required name="dead_line" id="deadline" class="form-control" style="width: 100%" type="date"/>-->
                 <!--   </div>-->
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_add_event_task" value="Save"/>
        </div>
    </div>
  </div>
</div>
</form>
</div>
<!------------------------------------------------------------------------------------>
