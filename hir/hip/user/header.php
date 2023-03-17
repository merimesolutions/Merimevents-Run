<?php
   echo  '<header class="header">
             <a href="#" class="logo" style="background-color:#0a1219;color:; font-size:px;border:1px solid #dedede;font-family:sans-serif;">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
               ';
               
               $company = mysqli_query($con,"SELECT * from tblstaff where id = '".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($company)){
                                        $_SESSION['user'] = $row['username'];
                                        echo '<span>'.ucwords($row['companyname']).'</span>';
                                    }
                $user = mysqli_query($con,"SELECT * from tblusers where id = '".$_SESSION['userid']."' ");
                                    while($rows = mysqli_fetch_array($user)){
                                        
                $companyname = mysqli_query($con,"SELECT * from tblstaff where company = '".$rows['company']."' ");
                                    while($r = mysqli_fetch_array($companyname)){
                                        echo '<span>'.ucwords($r['companyname']).'</span>';
                                    }
                                    }
                if($_SESSION['merime'] == "merime"){
                                        echo  "Merime Admin";
                                   
                            }
            echo '
            
            </a> 
            
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <img src="../../images/icons/resize.png" title="Resize window">
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->

                        <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span style="background: linear-gradient(to right, #00ff99 0%, #009999 100%);color: #000;padding:3px;border-radius: 2px;" id = "clock" onload="currentTime()"></span>
                        </a>
                        </li>

                       <li class="dropdown reminder reminder-menu">
      <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-bell" style="font-size:18px;"> <span class="badge bg-danger" id="count"><span style="border-radius:50%; color:red;">';
    
    // include("../connection.php");
    //     $date = date('Y-m-d');
    //      $dt2=date('Y-m-d', strtotime('+3 days'));
    //      $query = mysqli_query($con, "select count(user) as uu from tblreminder where user = '".$_SESSION['userid']."' AND scheduled_date BETWEEN  '".$date."' AND '".$dt2."' ");
    //      while($row = mysqli_fetch_array($query)){
    //             echo $row['uu'];
    // }
      
      echo '</span></a>
       
     </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user" style="color:teal;"></i>

                                Profile <i class="fa fa-sort-desc" aria-hidden="true"></i>';
                                
                            echo '</a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    
                                    <p>
                                        '.ucwords($_SESSION['username']).'
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#editProfileModal">Edit Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../../logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>'; ?>


         <div id="editProfileModal" class="modal fade">
            <form method="post">
              <div class="modal-dialog modal-sm" style="width:300px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Profile</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                        <?php
                        if($_SESSION['role'] == "admin"){
                            $user = mysqli_query($con,"SELECT * from tblstaff where id = '".$_SESSION['userid']."' ");
                            while($row = mysqli_fetch_array($user)){
                                echo '
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input name="txt_username" id="txt_username" class="form-control input-sm" type="text" value="'.$row['username'].'" />
                                    </div>
                                    <div class="form-group">
                                        <label>Change password:</label>
                                        <input name="txt_password" id="txt_password" class="form-control input-sm" type="password"  value="'.$row['password'].'"/>
                                    </div>';
                            } 
                        }
                        elseif($_SESSION['role'] == "new"){
                            $user = mysqli_query($con,"SELECT * from tblstaff where id = '".$_SESSION['userid']."' ");
                            while($row = mysqli_fetch_array($user)){
                                echo '
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input name="txt_username" id="txt_username" class="form-control input-sm" type="text" value="'.$row['username'].'" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input name="txt_password" id="txt_password" class="form-control input-sm" type="password"  value="'.$row['password'].'"/>
                                    </div>';
                            } 
                        }
                        else{
                            $user = mysqli_query($con,"SELECT * from tblusers where id = '".$_SESSION['userid']."' ");
                            while($row = mysqli_fetch_array($user)){
                                echo '
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input name="txt_username" id="txt_username" class="form-control input-sm" type="text" value="'.$row['username'].'" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input name="txt_password" id="txt_password" class="form-control input-sm" type="password"  value="'.$row['password'].'"/>
                                    </div>';
                            } 
                        }
                        ?>
                         
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                        <input type="submit" class="btn btn-primary btn-sm" id="btn_saveeditProfile" name="btn_saveeditProfile" value="Save"/>
                    </div>
                </div>
              </div>
              </form>
            </div>


            <?php
            if(isset($_POST['btn_saveeditProfile'])){
                $username = $_POST['txt_username'];
                $password = $_POST['txt_password'];
               


                    if($_SESSION['role'] == "admin"){
                        $updadmin = mysqli_query($con,"UPDATE tblstaff set username = '$username', password = '$password' where id = '".$_SESSION['userid']."' ");
                        if($updadmin == true){
                            $_SESSION['edit'] = 1;
                        }
                    }
                    elseif($_SESSION['role'] == "new"){
                        $updfaculty = mysqli_query($con,"UPDATE tblstaff set username = '$username', password = '$password' where id = '".$_SESSION['userid']."' ");
                        if($updfaculty == true){
                            $_SESSION['edit'] = 1;
                        }
                    }
                    else{
                        $upduser = mysqli_query($con,"UPDATE tblusers set username = '$username', password = '$password' where id = '".$_SESSION['userid']."' ");
                        if($upduser == true){
                            $_SESSION['edit'] = 1;
                        }
                    }
                    
            }

            ?>
         <div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Scheduled Events</h4>
        </div>
        <div class="modal-body">
              
          <table class="table table-striped">
              <tr><th>No.</th><th>Date</th><th>Time</th></th><th>Event</th></tr>
             <?php 
    include("../connection.php");
        $date = date('Y-m-d');
         $dt2=date('Y-m-d', strtotime('+3 days'));
         $n=1;
         $query = mysqli_query($con, "select * from tblreminder where user = '".$_SESSION['userid']."' AND scheduled_date BETWEEN  '".$date."' AND '".$dt2."' ");
         while($row = mysqli_fetch_array($query)){
            
           echo '
           <tr>
           <td>'.$n.'</td>
           <td>'.$row['scheduled_date'].'</td>
           <td>'.$row['scheduled_time'].'</td>
           <td>'.$row['event'].'</td>
           </tr>';
           $n++;
                
                
                
               
    }
    ?>
         
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

            <?php include "../notification.php"; ?>
            <!--  <script type="text/javascript" src="ajax-script.js"></script>-->
            <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
           
            