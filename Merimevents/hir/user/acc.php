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
<!DOCTYPE html>
<html>
    <style>
        .sidebar-menu .accl{
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
      
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                   <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="box">             
                     <div class="container-fluid container-fullw bg-white">
                      <div class="row">
           
                                                           
        <div class="container">
          <div class="col-md-6 col-md-offset-2 "><br>
              <div class="panel panel-default" style="background-color: rgba(0,0,0,0);">
              <div class="panel-heading"  style="background-color: rgba(0,0,0,0);">
              <h1 class="panel-title" >
              <center>Create user
              account</center></h1>
            </div>
              <div class="panel-body">
              <form method="post">
                  <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required autocomplete="off" >
                </div>
                <div class="form-group">
                  <label>Role</label>
                <select name="role" id="role" type="text"  class="form-control input-sm">
                                                <option value="" selected disabled>Select role</option>
                                                      <?php
                                                        $a = mysqli_query($con,"SELECT * from tblroles where company='".$_SESSION['company']."' order by id");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['id'].'">'.ucwords($row['role']).'</option>';
                                                          }    
                                                      ?>
                                                </select>
                  </div>
                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" class="form-control" name="full_name" placeholder="Enter fisrt name" pattern="[a-zA-Z ]+" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password1" placeholder="Enter password" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label>Confirm password</label>
                  <input type="password" class="form-control" name="password2" placeholder="Confirm password" required autocomplete="off">
                </div>
            <strong>
              <?php
                  $error = NULL;
                  if (isset($_POST['submit'])){
                      $username =$_POST['username'];
                      $role     =$_POST['role'];
                      $full_name=$_POST['full_name'];
                      $password1=$_POST['password1'];
                      $password2=$_POST['password2'];
                      $company=$_SESSION['company'];
                              
                      include "../connection.php";
                $p = mysqli_query($con, "select * from tblstaff where company ='".$_SESSION['company']."' ");
                    while($data = mysqli_fetch_array($p))
                            {
                          $package=$data['package'];
                            
                $q = mysqli_query($con,"SELECT * from tblusers where company ='".$_SESSION['company']."' ");
                    $num_rows = mysqli_num_rows($q);
                        $n = number_format($num_rows,0);
                       if($n >= 1 && $package == 1){
                           
                           echo "<p style='color:red;'><b>". 'You have reached maximum limit of the number of users that can be added to the system.'."</b></p>";
                       }
                       elseif($n >= 3 && $package == 2){
                           echo "<p style='color:red;'><b>". 'You have reached maximum limit of the number of users that can be added to the system.'."</b></p>";
                       }else{
                $sql_u = "SELECT * FROM tblusers WHERE username = '$username'";
                      $results = mysqli_query($mysqli,$sql_u);
                  if(mysqli_num_rows($results)>0){
                      $error .="<p style='color: red';>Username exits try another one</p>";
                        }
                  elseif (strlen($username)<3){
                      $error = "<p style='color: red';>Your Username must be at least 3 characters</p>";
                        }
                  elseif($password1 != $password2){
                      $error .= "<p style='color: red';>Your passwords do not match</p>";
                        }
                  elseif(strlen($password1)<6){
                      $error .= "<p style='color: red';>Password must be at least 6 characters</p>";
                        }else{
                           
                      $username=$mysqli->real_escape_string($username);
                      $full_name=$mysqli->real_escape_string($full_name);
                      $password1=$mysqli->real_escape_string($password1);
                      $password2=$mysqli->real_escape_string($password2);
                      $role=$mysqli->real_escape_string($role);
                      $company=$mysqli->real_escape_string($company);

                      $insert = $mysqli -> query("insert into tblusers(username,password,full_name,role,company) VALUES('$username','$password1','$full_name','$role','$company')");

                    if ($insert){
                        echo "<p style='color:green;'><b>". 'Registered Successfully.'."</b></p>";
                                        }else{
                                        echo "<p style='color:red;'><b>". 'Error occurred.'."</b></p>";
                                    }
                                      }
                                  }
                            }
                            }
                      echo $error;
                ?>
            </strong>

                            <button type="submit" class="btn btn-sm btn-primary form-control" name="submit">Submit</button>
                          </form>
                         </div>
                        </div>
                       </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
<script type="text/javascript">
function goBack() {
           window.history.back();
           }
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,2 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>