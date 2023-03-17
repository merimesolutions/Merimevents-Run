 <?php
 
 switch ('$nini){
  case 'this_quarter':
          $current_month = date('m');
          $current_year = date('Y');
          if($current_month>=1 && $current_month<=3)
          {
            $start_date = strtotime('1-January-'.$current_year);  // timestamp or 1-Januray 12:00:00 AM
            $end_date = strtotime('1-April-'.$current_year);  // timestamp or 1-April 12:00:00 AM means end of 31 March
          }
          else  if($current_month>=4 && $current_month<=6)
          {
            $start_date = strtotime('1-April-'.$current_year);  // timestamp or 1-April 12:00:00 AM
            $end_date = strtotime('1-July-'.$current_year);  // timestamp or 1-July 12:00:00 AM means end of 30 June
          }
          else  if($current_month>=7 && $current_month<=9)
          {
            $start_date = strtotime('1-July-'.$current_year);  // timestamp or 1-July 12:00:00 AM
            $end_date = strtotime('1-October-'.$current_year);  // timestamp or 1-October 12:00:00 AM means end of 30 September
          }
          else  if($current_month>=10 && $current_month<=12)
          {
            $start_date = strtotime('1-October-'.$current_year);  // timestamp or 1-October 12:00:00 AM
            $end_date = strtotime('1-January-'.($current_year+1));  // timestamp or 1-January Next year 12:00:00 AM means end of 31 December this year
          }
        break;
      case 'last_quarter':

          $current_month = date('m');
          $current_year = date('Y');

          if($current_month>=1 && $current_month<=3)
          {
            $start_date = strtotime('1-October-'.($current_year-1));  // timestamp or 1-October Last Year 12:00:00 AM
            $end_date = strtotime('1-January-'.$current_year);  // // timestamp or 1-January  12:00:00 AM means end of 31 December Last year
          } 
          else if($current_month>=4 && $current_month<=6)
          {
            $start_date = strtotime('1-January-'.$current_year);  // timestamp or 1-Januray 12:00:00 AM
            $end_date = strtotime('1-April-'.$current_year);  // timestamp or 1-April 12:00:00 AM means end of 31 March
          }
          else  if($current_month>=7 && $current_month<=9)
          {
            $start_date = strtotime('1-April-'.$current_year);  // timestamp or 1-April 12:00:00 AM
            $end_date = strtotime('1-July-'.$current_year);  // timestamp or 1-July 12:00:00 AM means end of 30 June
          }
          else  if($current_month>=10 && $current_month<=12)
          {
            $start_date = strtotime('1-July-'.$current_year);  // timestamp or 1-July 12:00:00 AM
            $end_date = strtotime('1-October-'.$current_year);  // timestamp or 1-October 12:00:00 AM means end of 30 September
          }

        break;
        default:
            echo "gasfg";
 }}