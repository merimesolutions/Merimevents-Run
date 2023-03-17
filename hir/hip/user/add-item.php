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
  ?>
<?php
  if(isset($_POST['generate']))
  { 
    $client = $_POST['client'];
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
        .sidebar-menu .active{
        background-color:#009999;
    }
    </style>

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
      
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a href="ocr.php" title="Go home"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go home"></i> Back</a>&nbsp;&nbsp;&nbsp;
                    
                    <a href="ani.php" title="Add Items "><i class="fa fa-plus" aria-hidden="true" title="Go home"></i> Add Item(s) </a>&nbsp;&nbsp;&nbsp;
         
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <p id="msg" style="color: red; font-weight: bold;"></p>
                        <!-- left column -->
                            <div class="box">
                                <div class="box-body table-responsiv">
    <?php
$search = $_GET['client'];
if(empty($search)){?>
    <div class="row">
     <div class="col-lg-6">
     <select name="referral" onchange="get_customer_detail(this.value)" id="select-state" class="form-control" placeholder="Select Customer">
    <option value="Nill">--Customers' List--</option>
    <?php
   $sp=mysqli_query($con,"SELECT * FROM tblcustomers WHERE company='".$_SESSION['company']."'");
            while($row_d = mysqli_fetch_array($sp))
                                            {
     echo '<option value="'.$row_d['identity'].'">'.ucwords($row_d['fname']).' '.ucwords($row_d['mname']).' '.ucwords($row_d['lname']).'</option>';
}?>
</select>
</div>
</div>
 
        
   <?php 
                       }
                                
                                  $sql=mysqli_query($con,"select * from tblcustomers where identity='".$search."' and company='".$_SESSION['company']."' ");
                                  while ($row=mysqli_fetch_array($sql)) {
                              ?>
                              <table class="table table-striped">
                                <tr>
                                  <th scope>Customer Name</th>
                                  <th scope>National ID No.</th>
                                  <th>Contact</th>
                                  <th scope>Email</th>
                                </tr>
                                <tr style="background-color:#EBF5FB;">
                                  <td>

                                    <?php  echo ucwords($row['fname']).' '.ucwords($row['lname']).' '.ucwords($row['mname']);?></td>
                                  <td><?php  echo $row['identity'];?></td>   
                                  <td><?php  echo ucwords($row['fcontact']).'  '.ucwords($row['scontact']);?></td>
                                  <td><?php  echo $row['email'];?></td>
                                </tr> 
                                </table>              
                            <?php }?>
                             <input type="hidden" name="selected" id="selected_guy">
                            <div id="customer_details"></div>
                              <form method="post">
                                    <h4>Select item below:</h4>
                                  <select name="users" onchange="showUser(this.value)" class="form-control input-sm" style="background: linear-gradient(to right, #00ffff 0%, #66ccff 100%);">
                                    <option value="">Click here to select item</option>
                                    <?php
                                      $a = mysqli_query($con,"SELECT * from tblitems where qnty>0 and company='".$_SESSION['company']."' order by item_name");
                                        while($row=mysqli_fetch_array($a)){
                                            echo '<option value="'.$row['id'].'">'.ucwords($row['item_name']).'</option>';
                                                                                            }    
                                          ?>
                                    </select>
                                  </form>
                                  <br>
                                  <div id="txtHint"></div>
                                  <br><br>
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
    function get_customer_detail(str) {
  if (str == "") {
    document.getElementById("customer_details").innerHTML = "";
    return;
  } else {
  document.getElementById("selected_guy").value= str;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("customer_details").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","../get_customer_detail.php?client="+str,true);
    xmlhttp.send();
  }
}
//get data
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    
    
     
    var client_ids ='<?php echo $_GET['client'];?>';
    var clientid = document.getElementById("selected_guy").value;

    var client_id = '';
    if(client_ids){
        client_id=client_ids;
    }else{
       client_id=clientid; 
    }
     //alert(client_id)
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
        
    xmlhttp.open("GET","get-item.php?q="+str+"&c="+client_id,true);
    xmlhttp.send();
  }
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
  // var client_ids ='<?php //echo $_GET['client'];?>';
  //   var clientid = document.getElementById("selected_guy").value;

  //   var client = '';
  //   if(client_ids!=''){
  //       client=client_ids;
  //   }else{
  //      client=clientid; 
  //   }
  var refInterval = window.setInterval('update()', 200); //  seconds
  var update = function() {
  $(document).on('click','#showData',function(e){
     var client_ids ='<?php echo $_GET['client'];?>';
    var clientid = document.getElementById("selected_guy").value;

    var client = '';
    if(client_ids!=''){
        client=client_ids;
    }else{
       client=clientid; 
    }
 
      $.ajax({    
        type: "GET",
        url: "showall.php",             
        dataType: "html", 
        data:{'client':client},                 
        success: function(data){                    
            $("#table-container").html(data); 
        }
    });
});
}
  update()
</script>
<script type="text/javascript">
  $(document).on('submit','#userForm',function(e){
        e.preventDefault();
       
        $.ajax({
        method:"POST",
        url: "php-script.php",
        data:$(this).serialize(),
        success: function(data){
        $('#msg').html(data);
        $('#userForm').find('input').val('')

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
</body>
</html>