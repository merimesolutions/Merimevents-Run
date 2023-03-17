
<?php
include "../editfunction.php";
$a = mysqli_query($con, "SELECT tblquotation.item_name, tblitems.item_name, tblitems.qnty, tblitems.id FROM `tblitems`
INNER JOIN tblquotation ON tblitems.item_name = tblquotation.item_name where tbitems.qnty>0 order by tblitems.id");
// echo $a;
while ($row = mysqli_fetch_array($a)) {
    $iddd = $row['id'];
    $itemm = $row['item_name'];
}
echo '

        <div id="editQuote' . $data['id'] . '" class="modal fade">
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
                        <input type="hidden" value="' . $data['id'] . '" name="hidden_id" id="hidden_id"/>
                        <input type="hidden" value="' . $c . '" name="hidden_company" id="hidden_id"/>
                        
                        <select name="users" onchange="showUser(this.value)" class="form-control input-sm" style="background: linear-gradient(to right, #00ffff 0%, #66ccff 100%);">
                            <option value="">Click here to select item</option>
                            <option value="' . $iddd . '">' . ucwords($itemm) . '</option>;
                                                                                            
                        </select>
                        <div class="form-group">
                            <label>Item Name </label>
                            <input name="iname" id="" class="form-control input-sm" type="text" rows="4" value="' . $data['item_name'] . '" />
                        </div>
                        <div class="form-group">
                            <label>No of days</label>
                            <input name="ndys" id="" class="form-control input-sm" type="text" rows="4" value="' . $data['no_days'] . '" />
                        </div>  
                        <div class="form-group">
                            <label>Quantity </label>
                            <input name="qty" id="" class="form-control input-sm" type="text" rows="4" value="' . $data['quantity'] . '" />
                        </div>
                        <div class="form-group">
                            <label>Unit price</label>
                            <input name="uprice" id="" class="form-control input-sm" type="text" rows="4" value="' . $data['unit_price'] . '" />
                        </div>
                        <div class="form-group">
                            <label>Total amount </label>
                            <input name="tamt" id="" class="form-control input-sm" type="text" rows="4" value="' . $data['total_amount'] . '" />
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
//      var event_id ='<?php echo $_GET["id"]; ?>';
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

