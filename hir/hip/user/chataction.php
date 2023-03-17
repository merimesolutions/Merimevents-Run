<?php
  include "../connection.php";
  $sql090=mysqli_query($con,"SELECT * FROM faqall WHERE company = '".$_SESSION['company']."' ");
    while($ros =mysqli_fetch_assoc($sql090)){
      $message=$ros['message'];
      $askdate=$ros['ask_date'];
      $faqid=$ros['user'];
      $user_name=$ros['username'];
      $usersession = $_SESSION['userid'];
      if($faqid==$usersession){
        echo '
    <div class="msg right-msg">
        <div
       class="msg-img"
       style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
      ></div>

      <div class="msg-bubble" style="background-color:#ddff99;">
        <div class="msg-info">
          <!--div class="msg-info-name">'.ucwords($user_name).'</div>
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
        <div
       class="msg-img"
       style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
      ></div>

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