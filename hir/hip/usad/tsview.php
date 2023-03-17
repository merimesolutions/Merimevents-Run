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
?>
<?php
include "../connection.php";
    if(isset($_POST['okayadmin'])){
        $faqmessage=mysqli_real_escape_string($con,$_POST['faqmessage']);
        $todate=date('Y-m-d h:i:sa');
        $user = $_SESSION['userid'];
        $msg='';
        $who = "admin";
        $task = $_GET['task'];
        $reply = 1;
        $name = $_SESSION['username'];
    
        $result = mysqli_query($con,"INSERT INTO faq (user,message,ask_date,who,task,full_name) VALUES ('$user','$faqmessage','$todate','$who','$task','$name')");

        $query = mysqli_query($con,"UPDATE faq SET reply = '".$reply."' where task = '".$task."' and who !='".$who."' and reply IS NULL ");
       if($result==true){
                  
    $_SESSION['sent'] = 1;
          echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
}

     else{
             echo '<script type="text/javascript">'; 
    echo 'alert("Error during submission");'; 
    echo '</script>';
       }
    
        }
        // INSERT FILE
 if(isset($_POST['send_file'])){
                 // name of the uploaded file
 
     $task_id = $_POST['task'];
     $file=basename($_FILES["myfile"]["name"]);
     $tmp_name = $_FILES["myfile"]["name"];
    // get the file extension
    $extension = pathinfo($tmp_name, PATHINFO_EXTENSION);

     
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx','png','jpg','pptx'])) {
        echo "<script>alert('You file extension must be .zip, .pptx, .pdf or .docx');</script>";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "<script>alert('File too large!');</script>";
    } else {
        // ------------------image-----------------------
    // destination of the file on the server
    $destination="../documents/".$file;
   $file1=explode(".",$file);
   $ext=$file1[1];
    $date = date("l jS \of F Y h:i:s A");
    $companyz = $_SESSION['company'];
    $user_i=$_SESSION['userid'];
   $allowed=array("jpg","png","gif","pdf","wmv","pdf","zip","pptx");
   if(in_array($ext,$allowed)) {
   if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $destination)){
        // ----------------------------------------------------------------------------------------
        // move the uploaded (temporary) file to the specified destination
      $sql = "INSERT IGNORE INTO tbltasksdocuments (task_id,doc_name, size, downloads,`date`,company,user_id)
             VALUES ('$task_id','$tmp_name', '$size', 0,'$date','$companyz','$user_i')";
                        if (mysqli_query($con, $sql)) {
                // $_SESSION['edit'] = 1;
                       echo '<script>';
                        echo 'alert("Document saved successfully");';
                        echo '</script>';

            }
        }else {
                    echo '<script>alert("Failed to upload file")';
                        echo '</script>';
        }
     }
   }
}
?>
<!DOCTYPE html>
<html>
    <?php include('../head_css.php'); ?>
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
        .sidebar-menu .pl{
        background-color:#009999;
    }
    </style>
        <style>
      .container.gallery-container {
        background-color: #fff;
        color: #35373a;
        min-height: 100vh;
        border-radius: 20px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.06);
    }

    .gallery-container h1 {
        text-align: center;
        margin-top: 70px;
        font-family: 'Droid Sans', sans-serif;
        font-weight: bold;
    }

    .gallery-container p.page-description {
        text-align: center;
        max-width: 800px;
        margin: 25px auto;
        color: #888;
        font-size: 18px;
    }

    .tz-gallery {
        padding: 40px;
    }

    .tz-gallery .lightbox img {
        width: 100%;
        margin-bottom: 30px;
        transition: 0.2s ease-in-out;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.2);
    }


    .tz-gallery .lightbox img:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
    }

    .tz-gallery img {
        border-radius: 4px;
    }

    .baguetteBox-button {
        background-color: transparent !important;
    }


    @media(max-width: 768px) {
        body {
            padding: 0;
        }

        .container.gallery-container {
            border-radius: 0;
        }
    }

    .sub-banner {
        background-image: url('images/listing_images/<?php echo $picha; ?>') !important;
        height: 70vh !important;
    }

    .msger {
        display: flex;
        flex-flow: column wrap;
        justify-content: space-between;
        width: 100%;
        /*max-width: 800px;*/
        margin: 25px 10px;
        height: calc(100% - 50px);
        border: var(--border);
        border-radius: 5px;
        background: var(--msger-bg);
        box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);



    }

    .msger-header {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: var(--border);
        background: #eee;
        color: #666;
        width: 100%;
    }

    .msger-chat {
        flex: 1;
        overflow-y: auto;
        padding: 10px;



    }

    .msger-chat::-webkit-scrollbar {
        width: 6px;
    }

    .msger-chat::-webkit-scrollbar-track {
        background: #ddd;
    }

    .msger-chat::-webkit-scrollbar-thumb {
        background: #bdbdbd;
    }

    .msg {
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px;
    }

    .msg:last-of-type {
        margin: 0;
    }

    .msg-img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
        background: #ddd;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border-radius: 50%;
    }

    .msg-bubble {
        max-width: 450px;
        padding: 15px;
        border-radius: 15px;
        background: var(--left-msg-bg);
    }

    .msg-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .msg-info-name {
        margin-right: 10px;
        font-weight: bold;
    }

    .msg-info-time {
        font-size: 0.85em;
    }

    .left-msg .msg-bubble {
        border-bottom-left-radius: 0;
    }

    .right-msg {
        flex-direction: row-reverse;
    }

    .right-msg .msg-bubble {
        background: var(--right-msg-bg);
        color: #fff;
        border-bottom-right-radius: 0;
    }

    .right-msg .msg-img {
        margin: 0 0 0 10px;
    }

    .msger-inputarea {
        display: flex;
        padding: 10px;
        border-top: var(--border);
        background: #eee;
        width: 100%;
    }

    .msger-inputarea * {
        padding: 10px;
        border: none;
        border-radius: 3px;
        font-size: 1em;
    }

    .msger-input {
        flex: 1;
        background: #ddd;
    }

    .msger-send-btn {
        margin-left: 10px;
        background: rgb(0, 196, 65);
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.23s;
    }

    .msger-send-btn:hover {
        background: rgb(0, 180, 50);
    }

    .msger-chat {
        background-color: #fcfcfe;
        background-image: url(https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png);
        width: 100%;
    }

    .btn-get-started {
        transition: 0.5s;
        line-height: 1;
        margin: 10px;
        color: #fff;
    }

    #comments {
        overflow: hidden
    }
    /**/
        .attachment{
        margin: 8px 0 0 10px;
        padding: 5px 0 5px 10px;
        display: flex;
        width: 100%;
        align-content: space-around;
         border:1px #e1e1e1 solid;
         align-items: center;
         background: #000;
         color: #fff;
    }
    .attachment p,.attachment a{
        align-self: center;

    }

  </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>
         
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <form method="post">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a href="javascript:void(0)"  title="Go Back" onclick="goBack()"><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                    
                    <!--<a href="tsa.php" target="_parent" class=""><i class="fa fa-tasks" aria-hidden="true"></i> Assign Tasks</a>&nbsp;&nbsp;&nbsp;-->
                   <input type="submit" class="btn btn-danger btn-sm" name="delete_task" style="position:absolute;right:15px;margin-top:3px;" value="Delete Task"> 
                   
        
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
   
                      <div class="box">
                        <div class="box-body table-responsive">   
                        <h5 style="background-color: rgba(0,0,0,0.1);padding:2px;"><span style="color:#000;">Task: </span> <?php
                        $q  = "SELECT tblongoing_tasks.task FROM tblongoing_tasks
                                              where tblongoing_tasks.proj = '".$_GET['proj']."' and tblongoing_tasks.id = '".$_GET['task']."'
                                                ";
                                            $result = mysqli_query($con, $q);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                                    echo ucwords($row['task']);
                                                  }
                                                  ?></h5>        
                            
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 15px !important;"><i class="fa fa-hashtag"></i></th>
                                                <th style="width: 20px !important;"><i class="fa fa-list"></i></th>
                                                <th>Task</th>
                                                <th>Description</th>
                                                <th>Start</th>
                                                <th>Deadline</th>
                                                <th>Completion</th>
                                                <th>Person[s] in charge<!--span style="float:right">Add <i class="fa fa-user" aria-hidden="true"></i></span--></th>
                                                <th>Status</th>
                                                <th style="width:40px;text-align: center;">Edit Task</th>
                                                <th style="width:40px;">Update Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c=1;
                                            $date=date("Y-m-d");
                $query  = "SELECT *
                        FROM tblongoing_tasks where proj = '".$_GET['proj']."' and tblongoing_tasks.id = '".$_GET['task']."'
                        ORDER BY id desc";
                        
                        $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_array($result))
                                                  {
                                            $ids =$row['user'];
                          $id_users = explode(',', $ids);
                           $name ='';
                          foreach ($id_users as $id_user) {
                             $get_users  =mysqli_query($con,"SELECT * FROM tblusers where id = '".$id_user."' ") ;
                             while($users  =mysqli_fetch_assoc($get_users)){
                              $name .= $users['full_name'].'<br>';
                             }

                          }


                $qy  = "SELECT * FROM tblusers where id = '".$row['user']."' ";
                        $res = mysqli_query($con, $qy);
                            while($rows = mysqli_fetch_array($res))
                                                  {

                                           $task = $row['task'];
                                             $urgency = $row['urgency'];
                                            $per = $row['percentage'];
                                            $d = $row['deadline'];
                                            $task = $row['task'];
                                            if($per<100)
                                            {
                                                $status = '<p style="color: red">'. "Incomplete" .'</p>';
                                            }
                                            elseif($per>=100)
                                            {
                                                $status = '<p style="color: green">'. "Completed" .'</p>';
                                            }
                                              $tasks = mysqli_query($con,"SELECT * FROM tbltasks WHERE task_name= '$task' ");
                                            //  echo  $e = mysqli_num_rows($tasks);
                                             while($matask = mysqli_fetch_assoc($tasks)):
                                                  $ta =  $matask['description'];
                                                 endwhile;
                 
                                            echo '
                                            <tr><td><input type="checkbox" name="tasks[]" value="'.$task.'"></td>
                                                <td>'.$c++.'</td> 
                                                <td title="tasks">'.ucwords($row['task']).'</td>
                                                <td>'.$ta.'</td>
                                                <td>'.ucwords($row['date_assigned']).'</td>  
                                                <td>'.$row['deadline'].'</td>
                                                <td>'.ucwords($row['percentage']).' %</td>
                                                <td>'.ucwords($name).'  
                                        <!--button data-target="#edituser'.$row['id'].'" data-toggle="modal" style="float:right"><i class="fa fa-plus" aria-hidden="true"></i></button-->
                                                </td> 
                                                <td>'.$status.'</td> 
                                                
                                                <td><center><a href="edittask.php?proj='.$_GET['proj'].'&task='.$row['id'].'"><img src="../../images/icons/doc_edit.png" title="View this task" class="iconb"></a></center></td>';
                                        if($per != 100){
                                              echo '
                                                <td><center><a href="javascript:void(0)" data-target="#editprogress'.$row['id'].'" data-toggle="modal"><img src="../../images/icons/doc_edit.png" title="Edit this record" class="iconb"></a></center></td>';
                                            }else{
                                                echo '<td><center> <img src="../../images/icons/success.png" title="Edit this record" class="iconb"> </center></td>';
                                            }
                                                echo '
                                                </tr>
                                                ';
                                           
                                                 include "editprogress.php";
                                                 
                                               
                                     
                                                  }
                                            ?>
                                        </tbody>
                                    </table>
                                         <?php
                                   echo '<br>';
                                       switch($urgency){
                                                    case 1:
                                                        if($per!=100){ 
                                                        echo '
                                                        
                                                <div class=" alert alert-danger shadow" role="alert" style="border-left:#721C24 5px solid; border-radius: 0px;padding:0 1px;margin-bottom:0;">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="color:#721C24">&times;</span>
                                                    </button>
                                                    <div class="row" style="margin:0;">
                                                       <div class="col-lg-2 col-sm-2">
                                                    
                                                        </div>
                                                        <div class="col-lg-10 col-sm-10">
                                                        <p style="font-size:13px" class="mb-0 font-weight-light"><b class="mr-1">Urgent!</b></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                        ' 
                                                        ;
                                                        }
                                                     break;
                                                     case 2:
                                                         if($per!=100){ 
                                                         echo ' <div class=" alert alert-warning shadow my-auto" role="alert" style="border-left:#ffff00 5px solid;border-radius: 0px;padding:0 1px;margin-bottom:0;">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="color:#721C24">&times;</span>
                                                    </button>
                                                    <div class="row" style="margin:0;">
                                                       <div class="col-lg-2 col-sm-2">
                                                    
                                                        </div>
                                                        <div class="col-lg-10 col-sm-10">
                                                        <p style="font-size:13px" class="mb-0 font-weight-light"><b class="mr-1">Semi Urgent!</b></p>
                                                        </div>
                                                    </div>
                                                </div>';
                                                         }
                                                   break;
                                                    default:
                                                        echo '';
                                                }
                                              }
                                   ?>
                                   
                                    <!--?php include "../deleteModal.php"; ?-->

                                    
             <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>
            <?php include "deletefunction.php";?>
            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>

                  </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Chat</a></li>
                    <li><a data-toggle="tab" href="#menu1">Attach a file</a></li>
                    <li><a data-toggle="tab" href="#menu2">Attachments</a></li>

                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
  <div class="contact-3" id="chat">
            
<div class="container" style="height: 400px; width:100%">
          <section class="msger">
  <header class="msger-header">
    <div class="">
      Lets chat...
    </div>
  </header>

  <main id="chatscreen" class="msger-chat">
  <?php
  include "../connection.php";
  $sql090=mysqli_query($con,"SELECT * FROM faq WHERE task = '".$_GET['task']."' ");
    while($ros =mysqli_fetch_assoc($sql090)){
      $message=$ros['message'];
      $askdate=$ros['ask_date'];
      $faqid=$ros['id'];  
      $who=$ros['who']; 
      $user_name=$ros['full_name'];
      if($who=="admin"){
        echo '
    <div class="msg right-msg">
        <!--div
       class="msg-img"
       style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
      ></div-->

      <div class="msg-bubble" style="background-color:#ddff99;">
        <div class="msg-info">
          <!--div class="msg-info-name">Kiptum</div>
          <div class="msg-info-time">10:00am</div-->
        </div>

        <div class="msg-text" style="color: black !important;">
          '.$message.' <br><small style="color:grey;font-size:9px;">'.$askdate.'</small>
        </div>
      </div>
    </div>';
}else{
  echo '
  <div class="msg left-msg">
        <!--div
       class="msg-img"
       style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
      ></div-->

      <div class="msg-bubble" style="background-color:#fff;">
        <div class="msg-info">
          <div class="msg-info-name" style="color: #009933 !important;">'.ucwords($user_name).'</div>
          <!--div class="msg-info-time">10:00am</div-->
        </div>

        <div class="msg-text" style="color: black !important;">
          '.$message.' <br><small style="color:grey;font-size:9px;">'.$askdate.'</small>
        </div>
      </div>
    </div>';
}
}
    ?>

  </main>

  <form class="msger-inputarea" method="POST">
     
      <div class="form-row">
       
    <!-- <input type="text" class=""  name="faqmessage" placeholder="Enter your message..." autocomplete="off" required> -->
    <textarea id="comments" cols="90"  name ="faqmessage" required placeholder="Type a message" rows="1" style="width:100%;"> </textarea> 
    
    <button type="submit" class="btn btn-success" name="okayadmin">Send</button>
    </div>
  </form>
</section>
</div>
</div>
</div>
        <div id="menu1" class="tab-pane fade" style="margin-top:20px;">
                        <div class="my_files ">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form_cont col-lg-9">

                                        <div class="input-group input-group-lg">

                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-cloud-upload"></i></span>
                                            <input type="hidden" name="task" value="<?php echo $_GET['task'];?> ">
                                            <input type="file" class="form-control" placeholder="Upload file" name="myfile" value="" aria-describedby="basic-addon1">
                                            <span class="input-group-addon" id="basic-addon1">
                                                <input type="submit" class=" btn btn-success" name="send_file" value="Submit File">
                                                 </span>
                                        </div>
                                        
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="menu2" class="tab-pane fade" style="margin-top:20px;">
                        <div class="row">
                            <?php $getdocs = mysqli_query($con,"SELECT * FROM tbltasksdocuments WHERE task_id ='".$_GET['task']."'   ");
                                if(mysqli_num_rows($getdocs)>0){
                                  while($row_doc = mysqli_fetch_assoc($getdocs)):
                                   $doc_name = $row_doc['doc_name'];
                                    $doc="../documents/".$doc_name;
                              echo '<div class="col-lg-7 col-sm-12">
                                <div class="attachment">
                                <div class="one">
                                    <p>'.$doc_name.'</p>
                                </div>
                                <div class="two">
                                <a href="'.$doc.'" class="btn btn-danger" download="'.$doc_name.'"><i class="fa fa-cloud-download"></i> Download</a>
                                </div>
                              </div>
                              </div>';
                        endwhile;
                        }else{
                              echo 'No documents uploaded';
                        }
                            ?>
                        </div>
                    </div>
                </div>
               </section><!-- /.content -->
               </form>

<?php include "../notification.php"; ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->   
                <!-- jQuery 2.0.2 -->
        <?php 
        include "../footer.php"; ?>
          <script type="text/javascript">
                                 // Expanding text box
var element = document.getElementById('comments');
var retractsAutomatically = false;

var sizeOfOne = element.clientHeight;
element.rows = 2;
var sizeOfExtra = element.clientHeight - sizeOfOne;
element.rows = 1;

var resize = function() {
    var length = element.scrollHeight;
    
    if (retractsAutomatically) {
        if (element.clientHeight == length)
            return;
    }
    else {
        element.rows = 1;
        length = element.scrollHeight;
    }
    
    element.rows = 1 + (length - sizeOfOne) / sizeOfExtra;
};

//modern
if (element.addEventListener)
    element.addEventListener('input', resize, false);
//IE8
else {
    element.attachEvent('onpropertychange', resize)
    retractsAutomaticaly = true;
}
            // ..................
          function goBack() {
           window.history.back();
           }
            $(function() {
                  $("#table").dataTable({
                     "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
                  });
              });
          </script> 
          <script type="text/javascript">
var chatscreen = document.getElementById("chatscreen");
    chatscreen.scrollTop = chatscreen.scrollHeight;
          </script>       
    </body>
</html>



