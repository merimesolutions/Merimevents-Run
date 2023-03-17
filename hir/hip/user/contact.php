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
        ?>
<?php
    if(isset($_POST['okay'])){
        $faqmessage=mysqli_real_escape_string($con,$_POST['faqmessage']);
        $todate=date('Y-m-d h:i:sa');
        $user = $_SESSION['userid'];
        $company = $_SESSION['company'];
        $msg='';
    
        $result = mysqli_query($con,"INSERT INTO faq (user,faq_message,ask_date,company) VALUES ('$user','$faqmessage','$todate','$company')");
       if($result==true){
                  
    $msg='<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your Message send.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

     else{
             echo '<script type="text/javascript">'; 
    echo 'alert("Error during submission");'; 
    echo '</script>';
       }
    
        }
?>
<html>
    <head>
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
    box-shadow: 0 2px 3px rgba(0,0,0,0.2);
}


.tz-gallery .lightbox img:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 15px rgba(0,0,0,0.3);
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
.sub-banner{
    background-image: url('images/listing_images/<?php echo $picha; ?>')!important;
    height: 70vh!important;
}

.msger {
  display: flex;
  flex-flow: column wrap;
  justify-content: space-between;
  width: 100%;
  max-width: 867px;
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
  background-image: url(https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png);}
.btn-get-started{
    transition: 0.5s;
	line-height: 1;
	margin: 10px;
	color: #fff;
}
	</style>
<?php include('../head_css.php'); ?>
    </head>
    <body class="skin-black">
        
 <?php include('../header.php'); ?>
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <a href="db.php" title="Go home"><i class="fa fa-home" aria-hidden="true" title="Go home"></i> Home</a>&nbsp;&nbsp;&nbsp;
                </section>

                <!-- Main content -->
                <section class="content" style="width: 100%;height: 100%;">
                    <div class="row">
                        <div class="col-lg-2" style="background-color:#fff;margin:15px;">
                            <h4>Contacts</h4>
                
                            <form>
                            <table class="table table-stripped" style="">
                                <?php $admin=mysqli_query($con,"SELECT * FROM tblstaff WHERE company='".$_SESSION['company']."'");
                                while($row =mysqli_fetch_assoc($admin)){
                                    echo '
                                    <tr><td style="font-size:12px;font-family: sans-serif;border: none !important;"><a href="livechat">'.$row['full_name'].'</a></td></tr>';
                                } ?>
                            <?php $s=mysqli_query($con,"SELECT * FROM tblusers WHERE company='".$_SESSION['company']."' and id != '".$_SESSION['userid']."' ");
                                while($r =mysqli_fetch_assoc($s)){
                                    echo '
                                    <tr><td style="font-size:12px;font-family: sans-serif;border: none !important;"><a href="contact?id='.$r['id'].'">'.$r['full_name'].'</a></td></tr>';
                                } ?>
                            
                              </table>
                            </form>
                        </div>
                        <div class="col-lg-8">
<!-- Comments section start -->
							<div class="contact-3" id="chat">
						
						<div class="container overflow-auto" style="height: 550px;">
					<section class="msger">
  <header class="msger-header">
    <div class="">
      <?php $admin=mysqli_query($con,"SELECT * FROM tblstaff WHERE company='".$_SESSION['company']."'");
                                while($row =mysqli_fetch_assoc($admin)){
                                    echo '
                                    <p style="font-size:12px;font-family: sans-serif;border: none !important;"><a href="livechat"><i class="fa fa-user" aria-hidden="true"></i> '.$row['full_name'].'</a></p>';
                                } ?>
    </div>
  </header>

  <main class="msger-chat">
  <?php $sql090=mysqli_query($con,"SELECT * FROM faq WHERE company='".$_SESSION['company']."'");
while($ros =mysqli_fetch_assoc($sql090)){
    $persons=$ros['user'];
    $faqmessage1=$ros['faq_message'];
    $askdate1=$ros['ask_date'];
    $faqid=$ros['id'];
    
foreach($perso as $pers){

   if($pers->$ros['user'] == $_SESSION['userid']){
     echo '<div class="right">'.$faqmessage1.'</div>';

   }elseif($pers->$ros['user'] == $_GET['id']){
    echo '<div class="left">'.$faqmessage1.'</div>';

   }

}    

}
?>
   
  </main>

  <form class="msger-inputarea" method="POST">
     
      <div class="form-row">
       
    <input type="text" class=""  name="faqmessage" placeholder="Enter your message..." Required>
    
    <button type="submit" class="btn btn-success" name="okay">Send</button>
    </div>
  </form>
</section>
</div>
</div>

</div>
</div>
</div>


					<!--Live chat-->
   </body>
</html>