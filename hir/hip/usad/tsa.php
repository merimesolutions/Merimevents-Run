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
<style>.sidebar-menu .pl{
        background-color:#009999;
    }</style>
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
                   <a href="pl.php" title="Go back"><i class="fa fa-level-up" aria-hidden="true"></i> My tasks</a>&nbsp;&nbsp;&nbsp;
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="box">
                                      
                            <div class="panel panel-default">
                            <form method="post" class="insert=form" id="insert_form" action="">
                                <div class="panel-heading" >
                                    
                                    
                                
                                </div><!-- /.box-header -->
                                
                                <div class="box-body table-responsive">
                                    <table class="table table-striped" id="table_field">
                                        <tr>
                                            <th>Main task</th>
                                            <th>sub-Task</th>
                                            <th>Start</th>
                                            <th>Deadline</th>
                                            <th>Person in Charge</th>
                                            <th style="width: 20px"></th>
                                        </tr>

                                        <?php
                                        if(isset($_POST['save'])){
                                            $txtProject = $_POST['txtProject'];
                                            $txtTask = $_POST['txtTask'];
                                            $txtStart = $_POST['txtStart'];
                                            $txtDeadline = $_POST['txtDeadline'];
                                            $txtUser = $_POST['txtUser'];
                                            $served_by=$_SESSION['username'];
                                            $zero = '0';
                                            $date=date("Y-m-d");
                                            
                                            
  
                                            foreach($txtProject as $key => $value){
                                                $sql_u = "SELECT * FROM tblongoing_tasks WHERE task = '".$txtTask[$key]."' and company='".$_SESSION['company']."' and percentage !='100' ";
                                              $results = mysqli_query($mysqli,$sql_u);
                                          if(mysqli_num_rows($results)>0){
                                                echo '<script type="text/javascript">'; 
                                                echo 'alert("Task already assigned to someone.");'; 
                                                echo 'window.location.href = window.location.href;';
                                                echo '</script>';
                                                  }else{
                                                $save = "INSERT INTO tblongoing_tasks(proj, task, date_assigned, deadline,user,company,percentage) VALUES ('".$value."','".$txtTask[$key]."','".$txtStart[$key]."','".$txtDeadline[$key]."','".$txtUser[$key]."','".$_SESSION['company']."','".$zero."')";
                                                $query = mysqli_query($con, $save);
                                            
                                            if($query == true){
                                                    echo '<script type="text/javascript">'; 
                                                    echo 'alert("Added successfully.");'; 
                                                    echo 'window.location.href = "tss.php";';
                                                    echo '</script>';
                                            }
                                                }
                                            }
                                        }
                                        ?>

                                        <tr>
                                            <td><select name="txtProject[]" id="txtProject[]" type="text"  class="form-control" style="width:100%" required>
                                                <option value="" selected disabled>Select</option>
                                                      <?php
                                                        $a = mysqli_query($con,"SELECT * from tblprojects where company='".$_SESSION['company']."' order by project desc");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['id'].'">'.ucwords($row['project']).'</option>';
                                                          }    
                                                      ?>
                                                </select></td>
                                            <td><select name="txtTask[]" id="txtTask[]" type="text"  class="someone form-control" style="width:75%;float:left;" required>
                                                <option value="" selected disabled>select</option>
                                                      <span id="someone"><?php
                                                        $a = mysqli_query($con,"SELECT * from tbltasks where company ='".$_SESSION['company']."' order by task_name desc");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option class="" value="'.$row['task_name'].'">'.ucwords($row['task_name']).'</option>';
                                                          }    
                                                      ?></span>
                                                
                                                </select>
                                                <button class="btn" data-toggle="modal" data-target="#addtask" style="width:25%;float:right"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                </td>
                                            <td><input type="date" name="txtStart[]" id="txtStart[]" class="form-control" required></td>
                                            <td><input type="date" name="txtDeadline[]" id="txtDeadline[]" class="form-control"></td>
                                            <td><select name="txtUser[]" id="txtUser[]" type="text"  class="form-control" style="width:100%" required>
                                                <option value="" selected disabled>select</option>
                                                      <?php
                                                        $a = mysqli_query($con,"SELECT * from tblusers where company='".$_SESSION['company']."' order by full_name desc");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['full_name'].'">'.ucwords($row['full_name']).'</option>';
                                                          }    
                                                      ?>
                                                
                                                </select></td>
                                            <td><input type="button" name="add" id="add" value="+" class="btn btn-info"></td>
                                        </tr>
                                    </table>
                                 </div>
                                 <center>
                                 <button class="btn btn-success btn-sm" type="submit" name="save" id="save"  value=""><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</a></button>
                                <button class="btn btn-default btn-sm" type="reset" name=""  value=""><i class="fa fa-undo" aria-hidden="true"></i> Reset</a></button>
                                </center>
                                <br>
                                 </form>
                             </div>
                         </div>
                    </div>
            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
                    </div>  
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
            var html = '<tr><td><select name="txtProject[]" id="txtProject[]" type="text"  class="form-control" style="width:100%" required><option value="" selected disabled>Select</option><?php
                                                        $a = mysqli_query($con,"SELECT * from tblprojects where company ='".$_SESSION['company']."' order by project desc");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['id'].'">'.ucwords($row['project']).'</option>';
                                                          }    
                                                      ?>
                                                </select></td><td><select name="txtTask[]" id="txtTask[]" type="text"  class="form-control" style="width:75%;float:left;" required><option value="" selected disabled>Select</option><?php
                                                        $a = mysqli_query($con,"SELECT * from tbltasks where company ='".$_SESSION['company']."' order by task_name desc");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['task_name'].'">'.ucwords($row['task_name']).'</option>';
                                                          }    
                                                      ?>
                                                </select><button class="btn" data-toggle="modal" data-target="#addtask" style="width:25%;float:right"><i class="fa fa-plus" aria-hidden="true"></i></button></td><td><input type="date" name="txtStart[]" id="txtStart[]" class="form-control" required></td><td><input type="date" name="txtDeadline[]" id="txtDeadline[]" class="form-control"></td><td><select name="txtUser[]" id="txtUser[]" type="text"  class="form-control" style="width:100%" required><option value="" selected disabled>Select</option><?php
                                                        $a = mysqli_query($con,"SELECT * from tblusers where company ='".$_SESSION['company']."' order by full_name desc");
                                                          while($row=mysqli_fetch_array($a)){
                                                        echo '<option value="'.$row['full_name'].'">'.ucwords($row['full_name']).'</option>';
                                                          }    
                                                      ?>
                                                </select></td><td><input type="button" name="remove" id="remove" value="x" class="btn btn-danger"></td></tr>';

            var x = 1;

            $("#add").click(function(){
                $("#table_field").append(html);
            }); 
            $("#table_field").on('click','#remove',function(){
                $(this).closest('tr').remove();
            }); 

        });
    </script>
<script>
  $(document).ready(function () {
    $('.btn_task').click(function (e) {
      e.preventDefault();
      var task = $('#task').val();
      var task_discr = $('#task_discr').val();
      $.ajax
        ({
          type: "POST",
          url: "test.php",
          data: { "task": task, "task_discr": task_discr },
          success: function (data) {
            //$('.result').html(data);
           $('#someone').load();
            $('#contactform')[0].reset();
          }
        });
        /* setInterval(function(){
            $('.someone').load().fadeIn('slow');
        },1);*/
    });
  });
</script>
    </body>
</html>