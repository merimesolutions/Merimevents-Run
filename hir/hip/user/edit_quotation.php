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
 $compp=$_SESSION['company'];
 include "../connection.php";
$event_id=$_GET['id'];
$remyma=mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id' AND quotation_status=1");
if($remyma){
    $numberma =mysqli_num_rows($remyma);
}
if($numberma > 0){
    echo '<script>alert("This Quotation has already been approved and can therefore not be edited");window.location="view_event.php?id='."$event_id".'"</script>';
}
$swei =mysqli_query($con,"SELECT * FROM tblevents WHERE id='$event_id'");
if($swei){
    while($row =mysqli_fetch_assoc($swei)){
        $ename=$row['event_name'];
        $custname=$row['customer_name'];
    }
}
?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--Editable Table CDN-->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  <!-------------------------------------------->
  <?php include('../head_css.php'); ?>
    <style type="text/css">
.panel:hover {
  background-color: lightblue;
    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
       
        <?php include('../header.php'); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>
             <aside class="right-side">
                 <section class="content-header">
                 <a class="btn btn-primary btn-sm " href="events.php"><i class="fas fa-arrow-up">&nbsp;Back</i></a>
                </section>
      <!--=======================================================================================================================-->
      <div class="container-fluid">
    <div class="row">
		<div class="col-md-12">
		    <h3 class="text-center margin-top-4 margin-bottom-5" style="color:teal; text-transform:uppercase;"><?php echo $custname; ?>&nbsp;<?php echo $ename; ?></h3>
		        
                        <div class="box-body table-responsive">  
                       
                            <form method="post">
                                    <table class="table  table-striped">
                                           <h4 >Cost of Items</h4>
                                
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Item</th>
                                                <th>Item Description</th>
                                                <th>Quantity</th>
                                                <th>Price/Day</th>
                                                <th>No of Days</th>
                                                <th>Total (items)</th>
                                                
                                                <th>Edit</th>
                                                <th>Delete</th>
                                                
                                            
                                                <!--<th style="width:40px">Edit</th>-->
                                                <!--<th style="width:40px">View</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $task=0;
                                            $date=date("Y-m-d");
                                            $sqwe =mysqli_query($con,"SELECT SUM(total_items) AS total FROM event_quotation WHERE event_id='$event_id'");
                                                         while($remmy =mysqli_fetch_assoc($sqwe)){
                                                              $total_items_cost=$remmy['total'];
                                                         }
                                            $query  = "SELECT * FROM event_quotation WHERE event_id='$event_id'";
                                            $result = mysqli_query($con, $query);
                                                while ($rowz = mysqli_fetch_array($result))
                                                  { 
                                                    //   $event_id = $row['id'];
                                                    //   $event_name=$row['event_name'];
                                                    //   $cust_name=$row['customer_name'];
                                                    $total_items =$rowz['total_items'];
                                                    $quote_item=$rowz['id'];
                                                    $item_id =$rowz['event_item'];
                                                    $sqq =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$item_id'");
                                                    while($data = mysqli_fetch_array($sqq)){
                                                        $item_name = $data['item_name'];
                                                    }
                                                   
                                                    
                                           ?>
                                            <tr>
                                                <td><?php echo $c++;?></td> 
                                              <td><input type="text" class="form-control" value="<?php echo $item_name;?>" readonly></td>
                                               
                                                <td><input type="text" class="form-control" value="<?php echo $rowz['event_description'];?>"></td>  
                                                <td><input type="text" class="form-control" value="<?php echo $rowz['event_quantity']; ?>"></td>
                                                <td><input type="text" class="form-control" value="<?php echo $rowz['event_single_price']; ?>"></td>
                                                <td><input type="text" class="form-control" value="<?php echo $rowz['event_days']; ?>"readonly ></td>
                                                <td><input type="text" class="form-control" value="<?php echo $rowz['total_items'];?>" readonly></td>  
                                                 <td><a href="edit_quotation_item.php?id=<?php echo $quote_item; ?>" class="btn btn-info"><i class="fas fa-save"></td>
                                              
                                                <td><a href="delete_quotation_item.php?id=<?php echo $quote_item; ?>" class="btn btn-danger"><i class="fas fa-trash"></td>
                                                
                                                  
                                               
                                                                                  
                                                </tr>
                                              
                                             
                                               
                                                
                                           <?php }?>
                                           
                                             
                                            <tr>
                                                <td>Total</td> 
                                              <td></td>
                                                <td></td>  
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><input type="text" class="form-control" value="<?php echo $total_items_cost; ?>" readonly></td>  
                                           
                                                  
                                               
                                                                                  
                                                </tr>
                                           
                                            
                                            
                                            
                                        </tbody>
                                        </table>
                                    
                                        <table class="table  table-striped" style="margin-top:30px;">
                                        <h4 >Additional Costs</h4>
                                
                                        <thead>
                                        
                                          <tr>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Name</th>
                                                <th>Cost</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                             
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $task=0;
                                            $date=date("Y-m-d");
                                            $sqw =mysqli_query($con,"SELECT SUM(cost_price) AS total FROM additional_costs WHERE event_id='$event_id'");
                                                         while($remmy =mysqli_fetch_assoc($sqw)){
                                                              $total_add_costs=$remmy['total'];
                                                         }
                                        
                                                     $rem=mysqli_query($con,"SELECT * FROM additional_costs WHERE event_id='$event_id'");
                                                     if($rem){
                                                        
                                                         
                                                         while($roml =mysqli_fetch_assoc($rem)){
                                                            $cost_name=$roml['cost_name'];
                                                            $cost_price=$roml['cost_price'];
                                                           
                                                        
                                          ?>
                                            <tr>
                                                <td><?php echo $c++; ?></td> 
                                                <td><input type="text" class="form-control" name="cost_name" value="<?php echo $cost_name;?>"></td>
                                                <td><input type="text" class="form-control" name="cost_price" value="<?php echo $cost_price; ?>"></td>  
                                                <td><a href="edit_quotation_item.php?id=<?php echo $quote_item; ?>" class="btn btn-info"><i class="fas fa-save"></td>
                                              
                                                <td><a href="delete_quotation_item.php?id=<?php echo $quote_item; ?>" class="btn btn-danger"><i class="fas fa-trash"></td>
                                           
                                                  
                                               
                                                                                  
                                                </tr>
                                               <?php }} ?>
                                          
                                            <tr>
                                                <td>Total</td> 
                                                <td></td>
                                             
                                                <td><input type="text" class="form-control" value="<?php echo $total_add_costs; ?>" readonly></td>
                                           
                                                  
                                               
                                                                                  
                                                </tr>
                                           
                                            
                                        </tbody>
                                    </table>
                                    
                                        <table class="table  table-striped" style="margin-top:30px">
                                            <h4>Total Costs</h4>
                                 <?php
                                 $overall_total =$total_add_costs + $total_items_cost;
                                 
                                 ?>
                                
                                        <thead>
                                        
                                          
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Total items Cost</th>
                                                <th>Total Additional Costs</th>
                                                <th>Overall Total Costs</th>
                                               
                                                
                                          
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <tr>
                                                <td>Total</td> 
                                                <td><input type="text" value="<?php echo $total_items_cost; ?>" class="form-control" readonly></td>
                                                <td><input type="text" value="<?php echo $total_add_costs; ?>" class="form-control" readonly></td>  
                                                 <td><input type="text" value="<?php echo $overall_total; ?>" class="form-control" readonly></td>  
                                                 
                                                  
                                               
                                                                                  
                                                </tr>
                                              
                                            
                                        </tbody>
                                    </table>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    </form>

           


        

                  </div>
		</div>
		</div>
		</div>
		<!--End of container fluid-->
		</aside>
		</div>
		   <?php include "../footer.php"; ?>
		</body>
		