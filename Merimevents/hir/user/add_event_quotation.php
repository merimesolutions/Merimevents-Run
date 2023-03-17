<?php
  session_start();
if (!isset($_SESSION['userid'])){
    require "../redirect.php";
}else{
    $now=time();
    if ($now > $_SESSION['expire']){
        session_destroy();
        require "../redirect.php"; 
    }else{        
    }
}
  include "../connection.php";
$event_id=$_GET['id'];

 $sql=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
 if($sql){
     $number_of_rows= mysqli_num_rows($sql);
 }
     if($number_of_rows > 0){
         echo '<script>window.location="view_event.php?id='."$event_id".'";</script>';
     
 }
?>
<!DOCTYPE html>
<html>
    <style type="text/css">
        .icon{
            width: 30px;
            padding-right: 10px;
        }
        .iconb{
            width: 30px;
            padding-right: 10px;
        }
        .icon:hover{
            transition: 0.3s;
            /*box-shadow: 2px 0px 20px rgba(0, 0, 0, 0.8);*/
        }
        button .save{
           background-color:green;
        }
        .button{
            width: 40px;
        }
        .top-wrapper{
           /* background-color: black;
            padding: 0 5px 5px 5px;
            border-radius: 5px;*/
        }
        .sidebar-menu .events{
        background-color:#009999;
    }
    </style>

    <?php include('../head_css.php'); ?>

    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>
        <?php
                function RandomString($length) {
                    $keys = array_merge(range(0,9));
                        $key = "";
                        for($i=0; $i < $length; $i++) {
                        $key .= $keys[mt_rand(0, count($keys) - 1)];
                    }
                        return $key;               
                }
            ?>
      
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="form-row">
                    <a href="events.php" class="btn btn-sm btn-danger form-group"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                 
                    
                
                    </div>
         
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">

                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                               
                          <br>
                          <?php
                          $red=mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event_id'");
                          if($red){
                              while($romm = mysqli_fetch_assoc($red)){
                                  $event_name =$romm ['event_name'];
                                  $customer_name =$romm['customer_name'];
                                  $start_date=$romm['start_date'];
                                  $end_date=$romm['end_date'];
                                  $start_day=date('d', strtotime($start_date));
                                  $end_day=date('d', strtotime($end_date));
                                  $no_day=$end_day - $start_day;
                                  if($no_day == 0){
                                      $no_days =1;
                                  }else{
                                      $no_days =$no_day;
                                  }
                                  
                              }
                          }
                          ?>
                          <h4 class="text-center text-info" style="margin-bottom: 30px; text-transform:uppercase;">Add Quotation For&nbsp;<?php echo $customer_name;?>'s &nbsp;<?php echo $event_name;?></h4>
                        
                                <form method="post" class="insert=form" id="insert_form" action="">
                                    <table class="table table-striped" id="table_field">
                                        <tr>
                                            <th style="width: 200px">Item</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Price/Day</th>
                                            <th>No of Days</th> 
                                            <th style="width: 10px"></th>
                                        </tr>

                                        <?php
                                        $connn = mysqli_connect("localhost","merimeve_event","user@event","merimeve_event");

                                        if(isset($_POST['save'])){
                                        $txtItem_name = $_POST['txtItem_name'];
                                        $txtQnty = $_POST['txtQnty'];
                                        // $txtbal_Qnty = $_POST['txtQnty'];
                                        $txtbal_Price= $_POST['txtPrice'];
                                        $noDays=$_POST['noDays'];
                                       if(!empty($_POST['txtDescription'])){
                                            $txtDescription = $_POST['txtDescription'];
                                       }else{
                                            $txtDescription = "Nill";
                                       }
                                       
                                     
                                        //Additional Costs
                                        $cost_name =$_POST['costName'];
                                        $cost_description=$_POST['costDescription'];
                                        $cost_unit_price=$_POST['costPrice'];
                        
                                        $company=$_SESSION['company'];
  
                                            foreach($txtItem_name as $key => $value){
                                                   $total_items_cost =(int)$txtbal_Price[$key] * (int)$txtQnty[$key] * (int)$noDays[$key];
                                                   
                                        $ddd =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$value'");
                                        while($hd = mysqli_fetch_array($ddd)){
                                            $get_quantity =$hd['qnty'];
                                            $get_name=$hd['item_name'];
                                        
                                                if($get_quantity < $txtQnty[$key]){
                                                    echo '<script>alert("STOCK ALERT : Note that there are currently only '."$get_quantity".' '."$get_name".' present.");</script>';
                                                }}
                                                $sqle =mysqli_query($connn,"INSERT INTO event_quotation(event_id,customer_name,event_item,event_description,event_quantity,event_single_price,event_days,total_items,company) VALUES ('$event_id','$customer_name','$value','$txtDescription[$key]',' $txtQnty[$key]','$txtbal_Price[$key]','$no_days','$total_items_cost','$company')");
                                                if(!$sqle){
                                                    $err=mysqli_error($connn);
                                                }
                                            }
                                            foreach($cost_name as $key2 => $value2){
                                            if(!empty($_POST['costQuantity'][$key2])){
                                             $cost_quantity=$_POST['costQuantity'];
                                              $total_price =(int)$cost_quantity[$key2] * (int)$cost_unit_price[$key2];
                                              $total=$total_price;
                                              }elseif(empty($_POST['costQuantity'][$key2])){
                                             
                                              $total_price = 1 * (int)$cost_unit_price[$key2];
                                              $total=$total_price;
                                              }
                                                $sqme =mysqli_query($connn,"INSERT INTO additional_costs(event_id,cost_name,cost_description,cost_quantity,cost_price,company,costperunit,total_price) VALUES ('$event_id','$value2','$cost_description[$key2]','$cost_quantity[$key2]','$total_price','$company','$cost_unit_price[$key2]','$total')");
                                                
                                                if(!$sqme){
                                                    $error=mysqli_error($connn);
                                                }
                                            }
                                            if($sqme && $sqle){
                                                echo'<script>alert("Quotation Added succesfully!");window.location="view_event.php?id='."$event_id".'";</script>';
                                            }if(!$sqme){
                                                 echo'<script>alert(" An error occured during submission'."$error".'");window.location="add_event_quotation.php?id='."$event_id".'";</script>';
                                            }
                                            if(!$sqle){
                                                  echo'<script>alert(" Error:'."$err".'");window.location="add_event_quotation.php?id='."$event_id".'";</script>';
                                            }
                                        }
                                        ?>

                                        <tr>
                                            <td><select name="txtItem_name[]" id="txtItem_name[]" type="text"  class="form-control">
                                                <option value="" selected disabled>Select item</option>
                                                      <?php
                                                        $a = mysqli_query($con,"SELECT * from tblitems where company='".$_SESSION['company']."' order by item_name");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).'</option>';
                                                         
                                                          }    
                                                      ?>
                                                </select></td>
                                            <td><textarea name="txtDescription[]"  class="form-control" required=""><?php echo "Nill"; ?></textarea></td>
                                            <td><input type="number" name="txtQnty[]" class="form-control" required></td>
                                            <td><input type="number" name="txtPrice[]" class="form-control" required></td>
                                            <td><input type="number" name="noDays[]"value="<?php echo $no_days; ?>" class="form-control" ></td>
                                          
                                            <!--<td><input type="date" name="txtRdate[]" class="form-control" required></td>-->
                                            <!--<td><input type="datetime-local" name="txtPdate[]" class="form-control" required></td>-->
                                            <td><input type="button" name="add" id="add" value="+" class="btn btn-info"></td>
                                        </tr>
                                    </table><br>
                                    <input type="hidden" name="invoice" value="<?php echo RandomString(7); ?>"/>
                                    <h4>Additional Costs</h4>
                                      <table class="table table-striped" id="table_field2">
                                        <tr>
                                            <!--<th style="width: 200px">Name of Cost</th>-->
                                            <!--<th style="width: 200px">Price</th>-->
                                            <th style="width: 200px">Item/Service</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                        
                                            <th style="width: 10px"></th>
                                           
                                            </tr>
                                            <tr>
                                            <td><input type="text" name="costName[]" class="form-control"></td>
                                            <td><input type="text" name="costDescription[]" value="Nill" class="form-control" ></td>
                                            <td><input type="text" name="costQuantity[]" class="form-control"></td>
                                            <td><input type="text" name="costPrice[]" class="form-control"></td>
                                         
                                             <td><input type="button" name="add" id="add2" value="+" class="btn btn-warning"></td>
                                             </tr>
                                             </table>
                                        
                                    
                                    
                                    <center><button type="submit" class="btn btn-success" name="save" id="save" title="Save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>&nbsp;&nbsp;&nbsp;
                                        <button type="reset" class="btn btn-default" title="Reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button></center>
        
                                    </form>
                                </div><!-- /.box-body -->

                            </div><!-- /.box -->
            <!--?php include "../notification.php"; ?-->
            <!--?php include "../addModal.php"; ?-->
            <!--?php include "../addfunction.php"; ?-->
            <!--?php include "editfunction.php"; ?-->
            <!--?php include "deletefunction.php"; ?-->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    <script type="text/javascript">
        $(document).ready(function(){
            var html = '<tr><td><input type="text" name="costName[]" class="form-control" required></td><td><input type="text" name="costDescription[]" value="Nill" class="form-control"></td><td><input type="text" name="costQuantity[]" class="form-control" ></td></td><td><input type="number" name="costPrice[]" class="form-control" required></td><td><input type="button" name="remove" id="remove" value="x" class="btn btn-danger"></td></tr>';

            var x = 1;

            $("#add2").click(function(){
                $("#table_field2").append(html);
            }); 
            $("#table_field2").on('click','#remove',function(){
                $(this).closest('tr').remove();
            }); 

        });
    </script>
    
        <script type="text/javascript">
        $(document).ready(function(){
            var html = '<tr><td><select name="txtItem_name[]" id="txtItem_name[]" type="text"  class="form-control"><option value="" selected disabled>Select item</option><?php
                                                      $date=date("Y-m-d");
                                                        $a = mysqli_query($con,"SELECT * from tblitems where company='".$_SESSION['company']."' order by item_name");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).'</option>';
                                                          }    
                                                      ?>
                                                </select></td><td><textarea name="txtDescription[]" class="form-control" required value="Nill"><?php echo "Nill"; ?></textarea></td><td><input type="number" name="txtQnty[]" class="form-control" required></td></td><td><input type="number" name="txtPrice[]" class="form-control" required></td></td><td><input type="text" name="noDays[]" class="form-control" value="<?php echo $no_days;?>"  required></td><td><input type="button" name="remove" id="remove" value="x" class="btn btn-danger"></td></tr>';

            var x = 1;

            $("#add").click(function(){
                $("#table_field").append(html);
            }); 
            $("#table_field").on('click','#remove',function(){
                $(this).closest('tr').remove();
            }); 

        });
    </script>
    </body>
</html>