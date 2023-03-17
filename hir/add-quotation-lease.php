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

 // $sql=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
 // if($sql){
 //     $number_of_rows= mysqli_num_rows($sql);
 // }
 //     if($number_of_rows > 0){
 //         echo '<script>window.location="view_event.php?id='."$event_id".'";</script>';
     
 // }
  ?>
<!--?php
  if(isset($_POST['generate']))
  { 
    $client = $_GET['client'];
      $invoice = $_POST['invoice'] ;

      $query = mysqli_query($con,"UPDATE tblleased SET invoice = '".$invoice."',random = '".$invoice."'  where client = '".$client."' and invoice IS NULL ");
      
      if($query == true){
          echo '<script type="text/javascript">'; 
            echo 'alert("Invoice generated successfully.");'; 
            echo 'window.location = "ilp.php";';
            echo '</script>';
      }
    if(mysqli_error($con)){
      echo '<script type="text/javascript">'; 
            echo 'alert("Error occured.");'; 
            echo 'window.location = "add-item.php";';
            echo '</script>';
    }
  }
?-->

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
        .sidebar-menu .active{
        background-color:#009999;
    }
    #myAdd{
      display: none;
    }
    </style>
    <script type="text/javascript">
function myFunction() {
  var x = document.getElementById("myAdd");
  if (x.style.display === "none") {
       
    x.style.display = "block";
    var quoteid = document.getElementById('quoteid').value;
     var quotet= document.getElementById('quotet').value;
     document.forms['insert']['quoteido'].value = quoteid;
     document.forms['insert']['quoteto'].value = quotet;
  } else {
    x.style.display = "none";
  }
}
    </script>

    <?php include('../head_css.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

<script>
$(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>

    <body class="skin-black">
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
             <?php
                function RandomID($length) {
                    $keys = array_merge(range(111,999));
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
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    
                    <a href="ani.php" title="Add Items "><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Add Item(s) </a>&nbsp;&nbsp;&nbsp;
         
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <p id="msg" style="color: red; font-weight: bold;"></p>
                        <!-- left column -->
                            <div class="box">
                                <div class="box-body">

    <div class="row">
     <div class="col-lg-12">
<h3>Create quotation</h3>
</div>
</div>
 

                              
                            <div id="customer_details"></div>
                            
                            <div class="row">
                              <div class="col-lg-10">
                              <form method="post">
                              <div class="row">
                                <div class="col-lg-4">
                                  <?php
                                  $qtid= rand(375, 975);
                                  ?>
                                  <!-- <input type="hidden" id="gen_value" name="gen_value" value=""/> -->
                                  <input type="text" name="quotation_id" id="quoteid" class="form-control" placeholder=<?php echo RandomID(3);?> value="<?php echo RandomID(3); ?>"/>
                                <!-- <input type="text"   name="quotation_id" id="quoteid" class="form-control" value= "<?php $qtid?>" placeholder=<?php echo $qtid;?> required> -->
                              </div>
                                <div class="col-lg-4">
                                <input type="text" name="quotation_title" id="quotet" class="form-control" placeholder="Qoutation title" required>
                              </div>
                              <div class="col-lg-4">
                                <input type="date" name="l_date" id="l_date" class="form-control" placeholder="Date" required>
                              </div>
                            </div>
                            <div class="row" style="margin-top:15px;">

                              <div class="col-lg-12">
                                    
                                  <select name="users" onchange="showUser(this.value)" class="form-control input-sm" style="background: linear-gradient(to right, #00ffff 0%, #66ccff 100%);">
                                    <option value="">Click here to select item</option>
                                    <?php
                                      $a = mysqli_query($con,"SELECT * from tblitems where qnty>0 and company='".$_SESSION['company']."' ORDER BY item_name");
                                        while($row=mysqli_fetch_array($a)){
                                            echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).'</option>';
                                                                                            }    
                                          ?>
                                    </select>
                                  </div>
                                </div>
                                  </form>
                                </div>
                                <div class="col-lg-2">
                                  <button  class="btn" onclick="myFunction()"><i class="fa fa-plus"></i> Add other costs</button>
                                </div>
                              </div>
                                  <br>
                                  <div id="txtHint"></div>
                                  <br><br>

                                  <!-- additional items -->
                                  <div id="myAdd">
                                  <form id="insert" method="post">
                                  <table class="table table-striped" id="table_field2">
                                        <tr>
                                            <th>Additional Item/Service</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th colspan="2">Supplier</th>
                                           
                                            </tr>
                                            <tr>
                                            <td>
                                              <input type="hidden" name="quoteido">
                                              <input type="hidden" name="quoteto">
                                              <input type="text" name="costName[]" class="form-control" required></td>
                                            <td><input type="text" name="costDescription[]" value="Nill" class="form-control" ></td>
                                            <td><input type="number" name="costQuantity[]" class="form-control" required></td>
                                            <td><input type="number" name="costPrice[]" class="form-control" required></td>
                                            <td>
                                              <select name="costSupplier[]" class="form-control input-sm" >
                                              <option value="" disabled selected>..Select..</option>
                                              <?php
                                                $a = mysqli_query($con,"SELECT * from tblsuppliers where company='".$_SESSION['company']."' ");
                                                  while($row=mysqli_fetch_array($a)){
                                                      echo '<option value="'.$row['id'].'">'.ucwords($row['full_name']).'</option>';
                                                                  }    
                                                    ?>
                                              </select>
                                              </td>
                                             <td style="width: 10px"><input type="button" name="add" id="add2" value="+" class="btn btn-warning"></td>
                                             </tr>
                                             </table>
                                             <center><button type="submit" title="Lease item" class="btn btn-success btn-sm" style="margin-top:10px;margin-left:20px; width:150px;" id="showData">  Save</button> </center>
                                           </form>
                                           </div>
                                    <!-- end of additional items -->
                                    <br><br><br>
                                  <div id="table-container"></div>
                                </div>
                              </div>
                            </div>
                          </section>
                        </aside>
                      </div>
<?php 
        include "../footer.php"; ?>
 <script>
//get data
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
     var event_id ='<?php echo $_GET["id"];?>';
     var quoteid = document.getElementById('quoteid').value;
     var quotet= document.getElementById('quotet').value;
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","get-item-quote-lease.php?q="+str+"&c="+event_id+"&quoteid="+quoteid+"&quotet="+quotet,true);
    xmlhttp.send();
  }
} 

//additional cost
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  var event_id ='<?php echo $_GET["id"];?>';
  var quoteid = document.getElementById('quoteid').value;
  var quotet= document.getElementById('quotet').value;
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("txtHint").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "get-additional-lease.php?event_id="+event_id+"&quoteid="+quoteid+"&quotet="+quotet, true);
  xhttp.send();
}
//back function
           function goBack() {
           window.history.back();
           }
              $(function() {
                  $("#table").dataTable({
                     "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
                  });
              });
     //get the user id and put it somewhere
    function get_data(){
   var shownVal = document.getElementById("data1").value;
   
   var value2send = document.querySelector("#cust option[value='"+shownVal+"']").dataset.value;
    var id = document.getElementById('id_yake').value= value2send;
    alert('My name is :'+ value2send );
}
//some crazy idea

  var refInterval = window.setInterval('update()', 200); //  seconds
  var update = function() {
  $(document).on('click','#showData',function(e){
    var quoteid = document.getElementById('quoteid').value;
      $.ajax({    
        type: "GET",
        url: "showall-quote-lease.php",             
        dataType: "html", 
        data:{'quoteid':quoteid},                 
        success: function(data){                    
            $("#table-container").html(data); 
        }
    });
});
}
  update()

  //additional items
  var refInterval = window.setInterval('update()', 200); //  seconds
  var update = function() {
  $(document).on('click','#showAdd',function(e){
    var quoteid = document.getElementById('quoteid').value;
      $.ajax({    
        type: "GET",
        url: "showall-quote-lease.php",             
        dataType: "html", 
        data:{'quoteid':quoteid},                 
        success: function(data){                    
            $("#table-container").html(data); 
        }
    });
});
}
  update()
</script>
<script type="text/javascript">
  var quoteid = document.getElementById('quoteid').value;
  var quotet= document.getElementById('quotet').value;
  var date= document.getElementById('l_date').value;
  $(document).on('submit','#userForm',function(e){
        e.preventDefault();
       
        $.ajax({
        method:"POST",
        url: "php-script-quote-lease.php",
        data:$(this).serialize(),
        success: function(data){
        $('#msg').html(data);
        $('#userForm').find('input').val('')

    }});
});
  </script>

<script type="text/javascript">
  $(document).on('submit','#insert',function(e){
        e.preventDefault();
       
        $.ajax({
        method:"POST",
        url: "php-script-additional-lease.php",
        data:$(this).serialize(),
        success: function(data){
        $('#msg').html(data);
        document.getElementById('myAdd').style.display = 'none';
        // $('#insert').find('input').val('')


        //some crazy idea
var quoteid = document.getElementById('quoteid').value;
  var refInterval = window.setInterval('update()', 300); //  seconds
  var update = function() {
  $(document).on('click','#showData',function(e){
      $.ajax({    
        type: "GET",
        url: "showall-quote-lease.php",             
        dataType: "html", 
        data:{'quoteid':quoteid},                 
        success: function(data){                    
            $("#table-container").html(data); 
        }
    });
});
}
  update()

    }});
});
  </script>
  
<script type="text/javascript">
   function myDel(fid)
     {   
      var  rmvfile=fid;
      if (confirm("Are you sure you want to Delete the file?") == true) {
      if(fid!='')
        {
         $.ajax({
         type:'POST',
         url:'delete_file.php',
         data:{rmvfile: rmvfile},
         success:function(msg){
var refInterval = window.setInterval('update()', 100); //  seconds
  var update = function() {
  $(document).on('click','#showData',function(e){
      $.ajax({    
        type: "GET",
        url: "showall.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#table-container").html(data); 
        }
    });
});
}
  update()
         }
         });
         } } }

 
</script>
<script type="text/javascript">
        $(document).ready(function(){
            var html = '<tr><td><input type="hidden" name="quoteido"> <input type="hidden" name="quoteto"><input type="text" name="costName[]" class="form-control" required></td><td><input type="text" name="costDescription[]" value="Nill" class="form-control"></td><td><input type="number" name="costQuantity[]" class="form-control" ></td></td><td><input type="number" name="costPrice[]" class="form-control" required></td><td><select name="costSupplier[]" class="form-control input-sm" ><option value="" disabled selected>..Select..</option> <?php
                                                $a = mysqli_query($con,"SELECT * from tblsuppliers where company='".$_SESSION['company']."' ");
                                                  while($row=mysqli_fetch_array($a)){
                                                      echo '<option value="'.$row['id'].'">'.ucwords($row['full_name']).'</option>';
                                                                  }    
                                                    ?>
                                              </select></td><td style="width: 10px"><input type="button" name="remove" id="remove" value="x" class="btn btn-danger"></td></tr>';

            var x = 1;

            $("#add2").click(function(){
                $("#table_field2").append(html);
            }); 
            $("#table_field2").on('click','#remove',function(){
                $(this).closest('tr').remove();
            }); 

        });
    </script>

</body>
</html>