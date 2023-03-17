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

//Current Quarter
//Get the day today





?>
<!DOCTYPE html>
<html>
    <style>.sidebar-menu .reports{
        background-color:#009999;
    }</style>
    <?php include('../head_css.php'); ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        include "../connection.php";
        $comps =$_SESSION['company'];
$todate=date('Y-m-d');
//Getting current Month and Year
$mon=date('m', strtotime($todate));
$ye=date('Y', strtotime($todate));


//Fetch all sale reecords for this year
$sql=mysqli_query($con,"SELECT * FROM  tblleased WHERE company='$comps' AND ldate LIKE '%$ye%'");
if($sql){
    while($row = mysqli_fetch_assoc($sql)){
        $month_year=$row['ldate'];
        $month=date('m', strtotime($month_year));
//Determinig Quarters
//(Jan,Feb,March,April) == Quarter 1
if($mon>=1  && $mon<=3){
    $quarter=1;
    $lastquarter=3;
    $dayz1=1;
    $dayz2=30;
    $monthz1=01;
    $monthz2=03;
     $startdate =date("Y-m-d",strtotime($monthz1.'/'.$dayz1.'/'.$ye));
    $enddate = date("Y-m-d",strtotime($monthz2.'/'.$dayz2.'/'.$ye));
    
}
//(May,June,July,August) ==Quarter 2
if($mon>=4 && $mon<=6){
    $quarter=2;
    $last_quarter=1;
    $dayz1=1;
    $dayz2=30;
    $monthz1=4;
    $monthz2=6;
    $startdate = date("Y-m-d",strtotime($monthz1.'/'.$dayz1.'/'.$ye));
    $enddate = date("Y-m-d",strtotime($monthz2.'/'.$dayz2.'/'.$ye));
 
    
}
//(September,October,November,December) ==Quarter 3
if($mon>=7 && $mon<=9){
    $quarter=3;
    $last_quarter=2;
    $dayz1=1;
    $dayz2=30;
    $monthz1=7;
    $monthz2=9;
    
      $startdate =date("Y-m-d",strtotime($monthz1.'/'.$dayz1.'/'.$ye));
     $enddate = date("Y-m-d",strtotime($monthz2.'/'.$dayz2.'/'.$ye));
     
    
   }
   if($mon>=10 && $mon<=12){
    $quarter=3;
    $last_quarter=2;
    $dayz1=1;
    $dayz2=31;
    $monthz1=10;
    $monthz2=12;
    
      $startdate = date("Y-m-d",strtotime($monthz1.'/'.$dayz1.'/'.$ye));
     $enddate = date("Y-m-d",strtotime($monthz2.'/'.$dayz2.'/'.$ye));
   }

  }
    
}

        ?>
        
        <?php include('../header.php'); ?>
      
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="border-style:;border:1px solid #dedede;">
                    <a  href="javascript:void(0)"  title="Go Back" onclick="goBack()" ><i class="fa fa-angle-double-left" ></i> Back</a>&nbsp;&nbsp;&nbsp;
                </section>

                <!-- Main content -->
                <section class="content">
           
                  <div class="box-body table-responsive">            
                   <div class="panel-heading   "style="height:100%;"  >
                     <div class="container-fluid container-full bg-white">
                      <div class="row ">
                         <form action="sales-prev" target="_parent" method="GET">
                          <div class="col-md-3">
                               <!-- Example single danger button -->
                                 <p>Select Duration:</p>
                                 <p></p>
                                <select class="form-control" name="select_report_period" id="select_report_period">
                                      <option selected disabled>Select Report Period</option>
                                      <option value="CurrentWeek">Current Week</option>
                                      <option value="LastWeek">Last Week</option>
                                      <option value="CurrentMonth">Current Month</option>
                                      <option value="LastMonth">Last Month</option>
                                      <option value="CurrentQuater">Current Quarter </option>
                                      <option value="LastQuater">Last Quarter</option>
                                      <option value="CurrentYear">Current Year</option>
                                      <option value="LastYear">Last Year</option>
                                      <option value="customDate">Custom date</option>
                                </select>
                                <!--Dropdown-->
                          </div>
                        <div class="col-md-3">
                             
                         <div id="show_us">
                        <P>From:</p>
                     <!--search//dcsnmm895jk4xcjk89wnm-euiuirsdkl478895nuieryu-->
                        <input type="text"  class="form-control"   name="start" id="start" placeholder="Start Date" style="width:100%;overflow: flex; margin-bottom:5px; float:left" />
                        <P>To:</p>
                        <input type="text"  class="form-control" name="end" id="end" placeholder="End Date" style="width:100%;overflow: flex; margin-bottom:5px; float:left" />
                                
                           </div>
                     
                            </div>
                             <div class="col-md-3">
                               <!-- Example single danger button -->
                                 <p>Select type:</p>
                                 <p></p>
                                <select class="form-control" name="select_report_type" id="select_report_type">
                                      <option value="generalsales" selected>General Sales</option>
                                      <option value="damagedsales">Damaged Sales</option>
                                      <option value="leasedsales">Leased Sales</option>
                               
                                </select>
                                <!--Dropdown-->
                          </div>
                            <div class="col-md-3" style="display:grid;place-items:center;margin-top:20px;">
                                <button type="submit" class="form-control btn btn-sm btn-success" name="" style="width:50%;"> 
                        <i class="fa fa-spinner" aria-hidden="true" style="font-size:15px;"></i> &nbsp; Generate</button>
                            </div>
                             
                             </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
               </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->   
                <!-- jQuery 2.0.2 -->
        <?php include "../footer.php";
        //current week
            
            //check the current day
if(date('D')!='Sun')
{    
 //take the last monday
  $monday  = date('Y-m-d',strtotime('last Sunday'));    

}else{
     $monday = date('Y-m-d');   
}

//always next saturday

if(date('D')!='Sat')
{
    $sunday  = date('Y-m-d',strtotime('next Saturday'));
}else{

        $sunday  = date('Y-m-d');
}
            
        
      //last week
          $previous_week = strtotime("-1 week +1 day");
            
            $start_week = strtotime("last sunday ",$previous_week);
            $end_week = strtotime("next saturday",$start_week);
            
            $last_week_s = date("Y-m-d",$start_week);
            $last_week_e = date("Y-m-d",$end_week);
            //this month
          $query_date = date('Y-m-d');

     // First day of the month.
      $thismonths =date('Y-m-01', strtotime($query_date));

      // Last day of the month.
      $thismonthe= date('Y-m-t', strtotime($query_date)); 
      //Last month 
      $lastmonths =  date("Y-m-d", strtotime("first day of previous month"));
      $lastmonthe= date("Y-m-t", strtotime("last day of previous month"));
        ?>
<script type="text/javascript">
  
             $('#hide_us').hide();
            $("#select_report_period").change(function(){
                var report= $(this).val();
                var startQuater = '<?php echo $startdate; ?>';
                var endQuater = '<?php echo $enddate;?>';
                var last_week_s = '<?php echo $last_week_s;?>';
                var last_week_e = '<?php echo $last_week_e;?>';
                var monday = '<?php echo $monday; ?>';
                var sunday = '<?php echo $sunday; ?>';
                //this month
                var thismonths = '<?php echo $thismonths; ?>';
                var thismonthe = '<?php echo $thismonthe; ?>';
                 //this month
                var lastmonths = '<?php echo $lastmonths; ?>';
                var lastmonthe = '<?php echo $lastmonthe; ?>';
              switch(report) {
        
                  case "CurrentWeek":
                      unDoSomething()
                     
                        
                          document.getElementById('start').value=monday;
                          document.getElementById('end').value=sunday;
                    // code block
                    break;
                case "LastWeek":
                      unDoSomething()
                     
                        
                          document.getElementById('start').value=last_week_s;
                          document.getElementById('end').value=last_week_e;
                    // code block
                    break;
                       case "CurrentMonth":
                      unDoSomething()
                     
                        
                          document.getElementById('start').value=thismonths;
                          document.getElementById('end').value=thismonthe;
                    // code block
                    break;
                    
                case "LastMonth":
                    unDoSomething()
                     
                        
                          document.getElementById('start').value=lastmonths;
                          document.getElementById('end').value=lastmonthe;
                    // code block
                          break;
                 case "CurrentQuater":
                     
                     unDoSomething()
                     
                       
                      document.getElementById('start').value=startQuater;
                      document.getElementById('end').value=endQuater;
                     
                    // code block
                    break;
                 case "LastQuater":
                     unDoSomething()
                    // code block
                     <?php 
                                 $current_month = date('m');
                                  $current_year = date('Y');
                        
                                  if($current_month>=1 && $current_month<=3)
                                  { 
                                    $current_year= $current_year-1;
                                    $start_date = strtotime('01-October-'.($current_year));  // timestamp or 1-October Last Year 12:00:00 AM
                                    $end_date = strtotime('31-December-'.$current_year);  // // timestamp or 1-January  12:00:00 AM means end of 31 December Last year
                                  } 
                                  else if($current_month>=4 && $current_month<=6)
                                  {
                                    $start_date = strtotime('1-January-'.$current_year);  // timestamp or 1-Januray 12:00:00 AM
                                    $end_date = strtotime('31-March-'.$current_year);  // timestamp or 1-April 12:00:00 AM means end of 31 March
                                  }
                                  else  if($current_month>=7 && $current_month<=9)
                                  {
                                    $start_date = strtotime('1-April-'.$current_year);  // timestamp or 1-April 12:00:00 AM
                                    $end_date = strtotime('30-June-'.$current_year);  // timestamp or 1-July 12:00:00 AM means end of 30 June
                                  }
                                  else  if($current_month>=10 && $current_month<=12)
                                  {
                                    $start_date = strtotime('1-July-'.$current_year);  // timestamp or 1-July 12:00:00 AM
                                    $end_date = strtotime('30-September-'.$current_year);  // timestamp or 1-October 12:00:00 AM means end of 30 September
                                  }
                                  $start_date = date("Y-m-d",  $start_date);
                                  $end_date = date("Y-m-d",  $end_date);
                                            
                     ?>
                       var start_date = '<?php echo $start_date;?>';
                       var end_date = '<?php echo $end_date;?>';
                       
                      document.getElementById('start').value=start_date;
                      document.getElementById('end').value=end_date;
                    break;
                  case "CurrentYear":
                      unDoSomething()
                        const d = new Date();
                        var year = d.getFullYear();
                     
                        var firstDay = new Date(year, 1, -29);
                        var lastDay = new Date(year, 11, 32);
                          document.getElementById('start').value=firstDay.toISOString().substring(0, 10);
                          document.getElementById('end').value=lastDay.toISOString().substring(0, 10) ;
                    // code block
                    break;
                  case "LastYear":
                       unDoSomething()
                       var last_year = new Date();
                        var year = last_year.getFullYear();
                        year = year - 1;
                        var firstDay = new Date(year, 1, -29);
                        var lastDay = new Date(year, 11, 32);
                       
                          document.getElementById('start').value=firstDay.toISOString().substring(0, 10);
                          document.getElementById('end').value=lastDay.toISOString().substring(0, 10);
                      
                    // code block
                    break;
                case "customDate":
                   doSomething();
                    break;
                  default:
                    // code block
                }
                function goBack(){
                    '<?php $mon = $mon-1;?>'
                }
                  function doSomething(){
                      document.getElementById('start').type = 'date';
                     document.getElementById('end').type = 'date';
                }
              
                 function unDoSomething(){
                     $('#show_us').show();
                    
                     document.getElementById('start').type = 'text';
                     document.getElementById('end').type = 'text';
                }
                
            });
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