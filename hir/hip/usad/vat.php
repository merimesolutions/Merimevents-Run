<?php
  $i=$_GET['id'];
                            $total=mysqli_query($con,'select sum(total_cost) as product from tblleased WHERE invoice = "'.$_GET['tm'].'" ');
     $ttle = mysqli_fetch_array($total);
    
                                 ?>   
                              <tr>
                                  <th colspan="5" style="text-align: right;">Total Cost</th>
                                  <th style="text-align: right;"><?php echo $ttle['total_amount'] ?></th>
                              </tr>
                              <?php
                              $amount=mysqli_query($con,'select sum(amount) as paid from tbltransactions WHERE invoice = "'.$_GET['tm'].'" ');
    $a = mysqli_fetch_array($amount);
    $vats=($ttle['product']) * 0.16;
    $tots=$vats + $a['paid'];
    ?>
                              <tr>
                                  <th colspan="5" style="text-align: right;">Amount Paid</th>
                                  <th style="text-align: right;"><?php echo number_format($a['paid'],2); ?></th>
                              </tr>
                              <tr>
                                  <th colspan="5" style="text-align: right;">VAT 16%</th>
                                  <th style="text-align: right;"><?php echo number_format($vats,2); ?></th>
                              </tr>
                              <tr>
                                  <th colspan="5" style="text-align: right;">Balance</th>
                                  <th style="text-align: right;"><?php echo number_format(($ttle['product'])-$a['paid'],2); ?></th>
                              </tr>