
<!DOCTYPE html>
<html>
    <?php include('../head_css.php'); ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        ob_start();
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
                    <h1 style="font-weight:bold;">
                       <i class="fa fa-braille" style="color:teal;"></i> Treatment Report 
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">

                <div class="box"> 
                  <div class="box-body table-responsive">            
                   <div class="panel-heading" >
                     <div class="container-fluid container-fullw bg-white">
                      <div class="row">
                        <div class="col-md-12">
                    <table>
                        <tr>
                            <td>
                    <a href="report.php" target="_blank" style="padding: px; font-size: 12px; color: white; font-family: arial" class="btn btn-sm btn-primary" >Print Today's Report</a>

                  </td>
                  <td>
                    <form action="searchreport.php" target="_parent" method="POST">
                     <input type="date" required class="input-sm" name="searchdate" id="searchdate" placeholder="Y-m-d e.g 2030-09-22" />
                        <button type="submit" class="btn btn-sm btn-primary" name="submit"><i class="fa fa-search" aria-hidden="true"></i>  Search</button>
                    </form>
                        </td>
                    <td>
                    <form action="searchpdf.php" target="_blank" method="POST">
                     <input type="date" required class="input-sm" name="searchdate" id="searchdate" placeholder="Y-m-d e.g 2030-09-22" />
                        <button type="submit" class="btn btn-sm btn-primary" name="submit"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Generate Report</button>
                    </form>
                        </td>
                    </tr>
                </table>
                    <hr>
              
            <table id="datatable" class="" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <tr>
                <p style="font-size:14px;color:black;font-weight: bold;"> Sickness Category - Employees
                </p>  
            </tr>
            <tr style="background-color: skyblue">
              <th style="width: 40px;">#</th>
              <th style="width: 120px;">PatientID</th>
              <th style="width: 120px;">CrNo.</th>
              <th>Name</th>
              <th style="width: 230px">Visit Date</th>
              <th style="width: 200px">Treatment Category</th>
            </tr>
            <?php
            $today=date("Y-m-d");
            $s=mysqli_query($con,"select * from tblreport WHERE estate='".$_SESSION['estate']."' and category = 'sickness' and today='$today' ");
            $c=1;
                while ($row=mysqli_fetch_array($s)) { ?>
        <tr>
            <td style="font-family: times"><?php echo ucwords($c); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['no']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['crno']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['p_name']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['serviced_date']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['category']); ?></td>
        </tr>
        <?php $c++; }?>
        <tr>
              <td colspan="5" align="right" style="color:black;font-weight: bold;">Sub Total:</td>
              <td align="center" style="background-color: lightgray;font-weight: bold;"><?php
                                            $q = mysqli_query($con,"SELECT * from tblreport where estate='".$_SESSION['estate']."' and category = 'sickness' and today='$today' ");
                                            $sickness = mysqli_num_rows($q);
                                            echo $sickness;
                                        ?> </td>
            </tr>
        </table><br>

         <table id="datatable" class="" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <tr>
                <p style="font-size:14px;color:black;font-weight: bold;"> On Duty Injury Category - Employees
                </p>  
            </tr>
            <tr style="background-color: skyblue">
              <th style="width: 40px;">#</th>
              <th style="width: 120px;">PatientID</th>
              <th style="width: 120px;">CrNo.</th>
              <th>Name</th>
              <th style="width: 230px">Visit Date</th>
              <th style="width: 200px">Treatment Category</th>
            </tr><?php
             $ond=mysqli_query($con,"select * from tblreport WHERE estate='".$_SESSION['estate']."' and category = 'On-Duty Injury' and today='$today' ");
            $c=1;
                while ($row=mysqli_fetch_array($ond)) { ?>
        <tr>
            <td style="font-family: times"><?php echo ucwords($c); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['no']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['crno']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['p_name']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['serviced_date']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['category']); ?></td>
        </tr>
        <?php $c++; }?>
        <tr>
              <td colspan="5" align="right" style="color:black;font-weight: bold;">Sub Total:</td>
              <td align="center" style="background-color: lightgray;font-weight: bold;"><?php
                                            $q = mysqli_query($con,"SELECT * from tblreport where estate='".$_SESSION['estate']."' and category = 'On-Duty Injury' and today='$today' ");
                                            $oinjury = mysqli_num_rows($q);
                                            echo $oinjury;
                                        ?> </td>
            </tr>
        </table><br>

        <table id="datatable" class="" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <tr>
                <p style="font-size:14px;color:black;font-weight: bold;"> Off Duty Injury Category - Employees
                </p>  
            </tr>
            <tr style="background-color: skyblue">
              <th style="width: 40px;">#</th>
              <th style="width: 120px;">PatientID</th>
              <th style="width: 120px;">CrNo.</th>
              <th>Name</th>
              <th style="width: 230px">Visit Date</th>
              <th style="width: 200px">Treatment Category</th>
            </tr>
            <?php
             $ofd=mysqli_query($con,"select * from tblreport WHERE estate='".$_SESSION['estate']."' and category = 'Off-Duty Injury' and today='$today' ");
            $cc=1;
                while ($row=mysqli_fetch_array($ofd)) { ?>
            <tr>
            <td style="font-family: times"><?php echo ucwords($cc); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['no']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['crno']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['p_name']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['serviced_date']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['category']); ?></td>
        </tr>
        <?php $cc++; }?>
        <tr>
              <td colspan="5" align="right" style="color:black;font-weight: bold;">Sub Total:</td>
              <td align="center" style="background-color: lightgray;font-weight: bold;"><?php
                                            $q = mysqli_query($con,"SELECT * from tblreport where estate='".$_SESSION['estate']."' and category = 'Off-Duty Injury' and today='$today' ");
                                            $finjury = mysqli_num_rows($q);
                                            echo $finjury;
                                        ?> </td>
            </tr>
        </table><br>

        <table id="datatable" class="" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <tr>
                <p style="font-size:14px;color:black;font-weight: bold;"> MCH
                </p>  
            </tr>
            <tr style="background-color: skyblue">
              <th style="width: 40px;">#</th>
              <th style="width: 120px;">PatientID</th>
              <th style="width: 120px;">CrNo.</th>
              <th>Name</th>
              <th style="width: 230px">Visit Date</th>
              <th style="width: 200px">Treatment Category</th>
            </tr>
            <?php
             $mch=mysqli_query($con,"select * from tblreport WHERE estate='".$_SESSION['estate']."' and purpose = 'MCH' and today='$today' ");
            $cc=1;
                while ($row=mysqli_fetch_array($mch)) { ?>
            <tr>
            <td style="font-family: times"><?php echo ucwords($cc); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['no']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['crno']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['p_name']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['serviced_date']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['purpose']); ?></td>
        </tr>
        <?php $cc++; }?>
        <tr>
              <td colspan="5" align="right" style="color:black;font-weight: bold;">Sub Total:</td>
              <td align="center" style="background-color: lightgray;font-weight: bold;"><?php
                                            $qmch = mysqli_query($con,"SELECT * from tblreport where estate='".$_SESSION['estate']."' and purpose = 'MCH' and today='$today' ");
                                            $dmch = mysqli_num_rows($qmch);
                                            echo $dmch;
                                        ?> </td>
            </tr>
        </table><br>

        <table id="datatable" class="" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <tr>
                <p style="font-size:14px;color:black;font-weight: bold;"> Dependants
                </p>  
            </tr>
            <tr style="background-color: skyblue">
              <th style="width: 40px;">#</th>
              <th style="width: 120px;">PatientID</th>
              <th style="width: 120px;">CrNo.</th>
              <th>Name</th>
              <th style="width: 230px">Visit Date</th>
              <th style="width: 200px">Purpose</th>
            </tr>
            <?php
             $dep=mysqli_query($con,"select * from tblreport WHERE estate='".$_SESSION['estate']."' and purpose = 'Treatment' and today='$today' ");
            $ccc=1;
                while ($row=mysqli_fetch_array($dep)) { ?>
            <tr>
            <td style="font-family: times"><?php echo ucwords($ccc); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['no']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['crno']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['p_name']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['serviced_date']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['purpose']); ?></td>
        </tr>
        <?php $ccc++; }?>
        <tr>
              <td colspan="5" align="right" style="color:black;font-weight: bold;">Sub Total:</td>
              <td align="center" style="background-color: lightgray;font-weight: bold;"><?php
                                            $q = mysqli_query($con,"SELECT * from tblreport where estate='".$_SESSION['estate']."' and purpose = 'Treatment' and today='$today' ");
                                            $dinjury = mysqli_num_rows($q);
                                            echo $dinjury;
                                        ?> </td>
            </tr>
        </table><br>

         <table id="datatable" class="" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <tr>
                <p style="font-size:14px;color:black;font-weight: bold;"> Non Employees
                </p>  
            </tr>
            <tr style="background-color: skyblue">
              <th style="width: 40px;">#</th>
              <th style="width: 120px;">PatientID</th>
              <th>Name</th>
              <th style="width: 230px">Visit Date</th>
              <th style="width: 200px">National ID/Passport/Birth No.</th>
            </tr>
            <?php
             $none=mysqli_query($con,"select * from tblreport WHERE estate='".$_SESSION['estate']."' and category = 'Non Employee' and today='$today' ");
            $ccc=1;
                while ($row=mysqli_fetch_array($none)) { ?>
            <tr>
            <td style="font-family: times"><?php echo ucwords($ccc); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['no']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['p_name']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['serviced_date']); ?></td>
            <td style="font-family: times"><?php echo ucwords($row['crno']); ?></td>
        </tr>
        <?php $ccc++; }?>
        <tr>
              <td colspan="4" align="right" style="color:black;font-weight: bold;">Sub Total:</td>
              <td align="center" style="background-color: lightgray;font-weight: bold;"><?php
                                            $q = mysqli_query($con,"SELECT * from tblreport where estate='".$_SESSION['estate']."' and category = 'Non Employee' and today='$today' ");
                                            $ninjury = mysqli_num_rows($q);
                                            echo $ninjury;
                                        ?> </td>
            </tr>
            <tr>
              <td colspan="6">.</td>
            </tr>
          <tr>
            <td colspan="4" align="right" style="color:black;font-weight: bold;">Grand Total:</td>
            <td  align="center" style="background-color: brown;color: white"><?php echo ($sickness+$oinjury+$finjury+$dinjury+$ninjury+$dmch); ?></td>
          </tr>
        </table><br>

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
        <?php 
        include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>



