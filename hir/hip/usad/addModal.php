<div id="addtask<?php $_GET['proj'];?>" class="modal fade">
         <?php    
            
            // $sql ="INSERT INTO tblusers(full_name,username,password,role,company)
                // SELECT tblstaff.full_name,tblstaff.username,tblstaff.password,tblstaff.role,tblstaff.company
                //   FROM tblstaff
                // WHERE tblstaff.full_name NOT IN (SELECT full_name FROM tblusers)";
                                                        $a = mysqli_query($con,"SELECT * from tblprojects where company='".$_SESSION['company']."' and id='".$_GET['proj']."' ");
                                                          while($p=mysqli_fetch_array($a)){
                                                           $name = $p['project'];
                                                          }    
                                                      ?>
<form method="post" id="contactform">
  <div class="modal-dialog modal-lg" style="width:70%;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="font-weight:bold;"><center>Add Task to <?php echo $name;?></center></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <input name="proj" class="form-control" value="<?php echo $_GET['proj'];?>" type="hidden">
                    <input required name="projname" id="projname" class="form-control" value="<?php echo $name; ?>" style="width: 100%" type="hidden"/>
                    <div class="form-group">
                        <label>Task Title</label>
                        <input required name="task" id="task" class="form-control" style="width: 100%" type="text"/>
                    </div>
                    <div class="form-group">
                        <label>Task description</label>
                        <textarea required name="task_discr" id="task_discr" class="form-control" style="width: 100%" rows="2" type="text"></textarea>
                    </div>
                    <!-- <div class="form-group">
                        <label>Person in charge</label>
                    <select name="txtUser" id="txtUser[]" type="text"  class="form-control" style="width:100%" required>
                                                <option value="" selected disabled>select Person Incharge</option> -->
                                                      <?php
                                                        // $a = mysqli_query($con,"SELECT * from tblusers where company='".$_SESSION['company']."' order by full_name desc");
                                                        // $b = mysqli_query($con,"SELECT * from tblstaff where company='".$_SESSION['company']."' order by full_name desc");
                                                        //  while($row=mysqli_fetch_array($b)){
                                                        // // echo '<option value="'.$row['id'].'">'.ucwords($row['full_name']).'</option>';
                                                        //   }   
                                                         
                                                        //   while($row=mysqli_fetch_array($a)){
                                                        // echo '<option value="'.$row['id'].'">'.ucwords($row['full_name']).'</option>';
                                                        //   }    
                                                      ?>
                                                
                     <!-- </select>
                     </div> -->
                     <!-- person in charge -->
                           
                                   
                               
                                  <!-- End person -->
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label>Urgency</label>
                                 <select name="txtUrgency" class="form-control">
                                      <option value="" selected diabled>Describe urgency </option>
                                      <option value="1">Urgent</option>
                                      <option value="2">Semi urgent</option>
                                      <option value="3">Not urgent</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                            <label>Person in charge</label>
                            
                                     <!-- users -->

                                        <div class="dropdown">
                                          <button class="btn btn-default dropdown-toggle" type="button" 
                                                  id="dropdownMenu1" data-toggle="dropdown" 
                                                  aria-haspopup="true" aria-expanded="true">
                                            <i class="fa fa-user"></i>
                                            <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1">
                                          
                                          <?php
                                                        $b = mysqli_query($con,"SELECT * from tblusers where company='".$_SESSION['company']."' order by full_name desc");
                                                   
                                                          while($row=mysqli_fetch_array($b)){
                                                            echo '<li> <label>';
                                                            echo '<input type="checkbox" name="txtUsers[]" class="form-control" value="'.$row['id'].'"> &nbsp;'.ucwords($row['full_name']);
                                                            echo '</label></li>';
                                                       
                                                          }    
                                                      ?>
    
                                          </ul>
                                        </div>
                                   </div>
                         </div>
                     </div>
                    <div class="row">
                        <div class="col-lg-6">
                             <div class="form-group">
                        <label>Start</label>
                        <input type="date" name="txtStart" id="txtStart[]" class="form-control" required>
                    </div>
                        </div>
                        <div class="col-lg-6">
                             <div class="form-group">
                        <label>End</label>
                       <input type="date" name="txtDeadline" id="txtDeadline[]" class="form-control">
                    </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Attach file (if any)</label>
                        <input name="taskfile" id="taskfile" class="form-control" style="width: 100%" type="file"/>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm btn_task" id="btn_task" name="btn_task" value="Save"/>
        </div>
    </div>
  </div>
  </form>
</div>

<!--======== assign tasks =========-->

<div id="assignTask" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:450px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="font-weight:bold;"><center>Assign Task</center></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Prescription Terms</label>
                        <textarea required name="terms" id="terms" class="input-sm" style="width: 100%" rows="2" type="text"></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_terms" name="btn_terms" value="Save"/>
        </div>
    </div>
  </div>
  </form>
</div>

<!--======== New project =========-->

<div id="addProject" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:100%;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="font-weight:bold;"><center>Add New Project</center></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Project Title</label>
                        <input required name="project" id="project" class="form-control" style="width: 100%" type="text" placeholder="Enter project title" />
                    </div>

                    <div class="form-group">
                        <label>Started</label>
                        <input required name="started" id="started" class="form-control" style="width: 100%" type="date"/>
                    </div>

                    <div class="form-group">
                        <label>Deadline</label>
                        <input required name="deadline" id="deadline" class="form-control" style="width: 100%" type="date"/>
                    </div>

                    <div class="form-group">
                        <label>Project description</label>
                        <textarea name="description" id="description" style="width: 100%" class="form-control" placeholder="Enter project description"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Attach file (if any)</label>
                        <input name="projfile" id="projfile" class="form-control" style="width: 100%" type="file"/>
                    </div>

                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_project" name="btn_project" value="Save"/>
        </div>
    </div>
  </div>
  </form>
</div>


<!--======== add role =========-->

<div id="addrole" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:450px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="color:teal; font-weight:bold;"><center>Add role</center></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Role Title</label>
                        <textarea required name="role" id="role" class="input-sm" style="width: 100%" rows="1" type="text"></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_role" name="btn_add_role" value="Save"/>
        </div>
    </div>
  </div>
  </form>
</div>


                <!-- add product / service -->

<div id="addps" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:450px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="color:teal; font-weight:bold;"><center>Add role</center></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Role Title</label>
                        <textarea required name="role" id="role" class="input-sm" style="width: 100%" rows="1" type="text"></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_role" name="btn_add_role" value="Save"/>
        </div>
    </div>
  </div>
  </form>
</div>


<!--======== Reconcile =========-->

<div id="Reconcile" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:450px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="font-weight:bold;"><center>Reconcile</center></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Select item</label>
                        <select name="item" id="item" type="text"  class="form-control input-sm">
                                                <option value="" selected disabled>Select item</option>
                                                      <?php
                                                        $a = mysqli_query($con,"SELECT * from tblitems where company='".$_SESSION['company']."' order by item_name");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).' ('.ucwords($row['qnty']).')</option>';
                                                          }    
                                                      ?>
                                                </select>
                    </div>
                
                <div class="form-group">
                        <label>Actual number of items</label>
                        <input required name="actual" id="actual" class="form-control" style="width: 100%" type="text"/>
                </div>
                
                    <div class="form-group">
                        <label>Reason</label>
                        <textarea required name="reason" id="reason" class="input-sm" style="width: 100%" rows="1" type="text"></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_reconcile" name="btn_reconcile" value="Save"/>
        </div>
    </div>
  </div>
  </form>
</div>

<!--======== edit company  =========-->

<div id="editcompany" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:450px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="font-weight:bold;"><center>Edit Company Details</center></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                     <?php
                        $c=1;
                        $squery = mysqli_query($con, "select * from tblstaff where id='".$_SESSION['userid']."' ORDER BY id DESC");
                            while($row = mysqli_fetch_array($squery))
                                {
                     ?>
                    <div class="form-group">
                        <label>Company Name</label>
                        <input name="id" id="id" class="form-control" type="hidden" value="<?php echo ucwords($row['id']) ?>"/>
                        <input name="company" id="company" class="form-control" style="width: 100%" type="text" value="<?php echo ucwords($row['companyname']) ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input name="location" id="location" class="form-control" style="width: 100%" type="text" value="<?php echo ucwords($row['location']) ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <input name="contact" id="contact" class="form-control" style="width: 100%" type="text" value="<?php echo ucwords($row['contact']) ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" id="email" class="form-control" style="width: 100%" type="text" value="<?php echo ucwords($row['email']) ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Tax Settings(VAT)</label>
                        <select name="vat" class="form-control">
                            <?php 
													    
													 
									$va= explode(',',$row['vat']);
 
?>													
													
                            <option disabled selected>Tax Option</option>
                            <option value="Inclusive" <?php echo(in_array("Inclusive", $va)?'selected':''); ?>>Inclusive</option>
                            <option value="Exclusive" <?php echo(in_array("Exclusive", $va)?'selected':''); ?>>Exclusive</option>
                            <option value="None" <?php echo(in_array("None", $va)?'selected':''); ?>>None</option>
                           
                        </select>
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="editcompany" name="editcompany" value="Save"/>
        </div>
    </div>
  </div>
  </form>
</div>


<!--======== edit payment details  =========-->

<div id="editpayment" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:850px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="font-weight:bold;"><center>Edit Payment Details</center></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-6">
                     <?php
                        $c=1;
                        $squery = mysqli_query($con, "select * from tblstaff where id='".$_SESSION['userid']."' ORDER BY id DESC");
                            while($row = mysqli_fetch_array($squery))
                                {
                     ?>
                    <h4>Bank details</h4>
                    <div class="form-group">
                        <label>Bank Name</label>
                        <input name="id" id="id" class="form-control" type="hidden" value="<?php echo ucwords($row['id']) ?>"/>
                        <input name="bank_name" id="bank_name" class="form-control" style="width: 100%" type="text" value="<?php echo ucwords($row['bank_name']) ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Branch</label>
                        <input name="branch" id="branch" class="form-control" style="width: 100%" type="text" value="<?php echo ucwords($row['branch']) ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Account Number</label>
                        <input name="acc_no" id="acc_no" class="form-control" style="width: 100%" type="text" value="<?php echo ucwords($row['acc_no']) ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Account Name</label>
                        <input name="account_name" id="account_name" class="form-control" style="width: 100%" type="text" value="<?php echo ucwords($row['account_name']) ?>"/>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <h4>Mpesa details</h4>
                    <div class="form-group">
                        <label>Mpesa Pay Bill Business Number:</label>
                        <input name="paybill" id="paybill" class="form-control" style="width: 100%" type="text" value="<?php echo ucwords($row['paybill']) ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Account Number:</label>
                        <input name="business_no" id="business_no" class="form-control" style="width: 100%" type="text" value="<?php echo ucwords($row['business_no']) ?>"/>
                    </div>
                    
                    <div class="form-group">
                        <label>Mpesa Till Number:</label>
                        <input name="till_no" id="till_no" class="form-control" style="width: 100%" type="text" value="<?php echo ucwords($row['till_no']) ?>"/>
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="editpayment" name="editpayment" value="Save"/>
        </div>
    </div>
  </div>
  </form>
</div>


<!--======== add supplier =========-->

<div id="addSupplier" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:450px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="color:teal; font-weight:bold;"><center>Add supplier</center></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Full name</label>
                        <input required name="full_name" id="full_name" class="form-control" style="width: 100%" type="text" placeholder="Enter full name" />
                    </div>
                    
                    <div class="form-group">
                        <label>Location</label>
                        <input required name="location" id="location" class="form-control" style="width: 100%" type="text" placeholder="Enter location" />
                    </div>
                    
                    <div class="form-group">
                        <label>Contact number</label>
                        <input name="contact" id="contact" class="form-control" style="width: 100%" type="text" placeholder="Enter contact" />
                    </div>
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" id="email" class="form-control" style="width: 100%" type="email" placeholder="Enter email address" />
                    </div>
                    
                    <div class="form-group">
                        <label>Goods / service description</label>
                        <textarea name="description" id="description" class="input-sm" style="width: 100%" rows="1" type="text"></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_supplier" name="btn_add_supplier" value="Save"/>
        </div>
    </div>
  </div>
  </form>
</div>



