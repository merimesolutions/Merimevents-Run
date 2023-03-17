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
        .scrollable {
    height: 500px; /* or any value */
    overflow-y: auto;
}
#myList{
     display: inline-block;
}
    </style>
    <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
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
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                    <a href="db.php" title="Go home"><i class="fa fa-angle-double-left" aria-hidden="true" title="Go home"></i> Back</a>
                    <button type="reset" title="Reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
                </section>
                <form method="post">

                <!-- Main content -->
                <section class="content">
                    <div class="row">

                                <div class="box-body table-responsive">
                                    Search invoice:<input id="myInput" type="text" placeholder="Search.." class="input-sm" style="width:40%">
                                    
                                    <div class="scrollable">
                                    
                                            <?php
                                            $c=1;
                                            $squery = mysqli_query($con, "select * from tblleased where company='".$_SESSION['company']."' group by random ORDER BY item_id DESC");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                $r=$row['client'];
                                                $c = mysqli_query($con, "select * from tblcustomers where identity='".$r."' ");
                                                while($data = mysqli_fetch_array($c))
                                            {
                                                $fname=$data['fname'];
                                                $mname=$data['mname'];
                                                $lname=$data['lname'];
                                            }
                                                echo '
                                        <div id="myList">
                                    <a href="ocr.php" title="Lease items">
                                    <div class="panel panel-white no-radius">
                                        <div class="panel-body">
                                            <a href=ilpr.php?tm='.$row['ldate'].''.$row['lease_time'].' target="_blank"><img id="myTable" src="../../images/icons/folder_open.png" title="Print invoice: '.$row['invoice'].'" class="icon"></a><br>
                                            
                                            <small style="color:#000;"> '.$row['invoice'].'<br>'.$row['random'].'</small>   
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                           
                                                ';
                                                
                                                //include "editaccl.php";
                                            }
                                            ?>
                                      </div>
                                   
                    <script>
                        function myFunction() {
                          var input, filter, img, tr, td, i, txtValue;
                          input = document.getElementById("myInput");
                          filter = input.value.toUpperCase();
                          table = document.getElementById("myTable");
                          tr = table.getElementsByTagName("tr");
                          for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[0];
                            if (td) {
                              txtValue = td.textContent || td.innerText;
                              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                              } else {
                                tr[i].style.display = "none";
                              }
                            }       
                          }
                        }
                        </script>

                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <!--?php include "../addfunction.php"; ?-->
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
                </form>
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
    </body>
</html>