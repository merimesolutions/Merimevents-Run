
<?php

echo '<div id="editQuote'.$data['id'].'" class="modal">
        
    <form method="post">
        <div class="modal-dialog modal-sm" style="width:1100px !important;">
            <div class="modal-content">
                <div class="modal-header" style="border-radius:2px;color:#000">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><center><strong>Edit Quotation</strong></center></h4>
                </div>
                <div class="modal-body" >
                    <div class="row">
                        <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <label>Quotation ID</label>
                                        <input type="hidden" value="'. $idd.'" name="hidden_id" id="hidden_id"/>
                                        <input type="text" name="quoteid" id="quoteid" class="form-control" value="'.$idee.'"/> 
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Quotation title</label>
                                        <input type="text" name="quotet" id="quotet" class="form-control"  value="'.$qtt.'" />
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Date</label>
                                        <input required name="l_date" id="l_date" class="form-control" style="width: 100%" type="date" value="'.$dae.'"/>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Expiry Date</label>
                                        <input required name="e_date" id="e_date" class="form-control" style="width: 100%" type="date" value="'.$e_date.'"/>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Quotation status</label>
                                            <select name="quotation_status" class="form-control" id="quotation_status" Required>
                                                <option value="'.$data['quotation_status'].'" selected>Select Status</option>
                                                <option value="Pending" selected>Pending</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row" >
                                <div class="col-lg-12"  style="background: white;">
                                    <label>Item name</label>
                                    <select name="users" onchange="showUser(this.value)" class="form-control input-sm" style="background: linear-gradient(to right, #00ffff 0%, #66ccff 100%);">
                                        <option value="' . $idd . '">' . $it . '</option>';  
                                        $a = mysqli_query($con,"SELECT * from tblitems where qnty>0 and company='".$_SESSION['company']."' ORDER BY item_name");
                                            while($row=mysqli_fetch_array($a)){
                                                echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).'</option>';
                                                                                                                }   ;
                                      echo'                                                                                    
                                    </select>
                                </div>
                            </div>
                            <div class="row">  
                                <div class="col-lg-6"  style="background: white;">
                                    <label>No of days</label>
                                    <input name="ndys" id="" class="form-control input-sm" type="text" rows="4" value="'.$nd.'" />
                                </div>  
                                <div class="col-lg-6"  style="background: white;">
                                    <label>Quantity </label>
                                    <input name="qty" id="" class="form-control input-sm" type="text" rows="4" value="'.$qnt.'" />
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-lg-6"  style="background: white;">
                                    <label>Unit price</label>
                                    <input name="uprice" id="" class="form-control input-sm" type="text" rows="4" value="'.$unt.'" />
                                </div>
                                <div class="col-lg-6"  style="background: white;">
                                    <label>Total amount </label>
                                    <input name="tamt" id="" class="form-control input-sm" type="text" rows="4" value="' . $tamt . '" />
                                </div>
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
?>
<!-- <script> -->
<!-- // function showUser(str) {
//   if (str == "") {
//     document.getElementById("txtHint").innerHTML = "";
//     return;
//   } else {
//     var xmlhttp = new XMLHttpRequest();
//      var event_id ='<?php// echo $_GET["id"]; ?>';
//      var quoteid = document.getElementById('quoteid').value;
//      var quotet= document.getElementById('quotet').value;
//     xmlhttp.onreadystatechange = function() {
//       if (this.readyState == 4 && this.status == 200) {
//         document.getElementById("txtHint").innerHTML = this.responseText;
//       } -->
<!-- //     };
//     xmlhttp.open("GET","get-item-quote-lease.php?q="+str+"&c="+event_id+"&quoteid="+quoteid+"&quotet="+quotet,true);
//     xmlhttp.send();
//   } -->

<!-- </script> -->
<!-- <?php
// if(isset($_POST['btn_editquote'])){
//     $quote_id = mysqli_real_escape_string($con,$_POST['identitty']);
//     $quote_title = mysqli_real_escape_string($con,$_POST['qoutation_title']);
//     $query = mysqli_query($con,"UPDATE tblquotation SET identitty = '$quote_id', quotation_title = '$quote_title' ");


//     if($query == true){
//         echo '<script type="text/javascript">'; 
//         echo 'alert("Changes made successfully.");'; 
//         echo 'window.location.href = window.location.href;';
//         echo '</script>';
//         exit;
//     }

//     if(mysqli_error($con)){


//         echo '<script type="text/javascript">'; 
//         echo mysqli_error($con);
//         echo 'alert("No changes made.");'; 
//         echo 'window.location = "quotation-list.php";';
//         echo '</script>';
//     }
// }
?>

