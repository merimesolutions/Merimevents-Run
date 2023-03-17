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

    require "../connection.php";                           
?>
<?php     
require "../fpdf/fpdf.php";


class myPDF extends FPDF{
    function hd($con){
        $date=date("Y-m-d h:i:sa");
       $img=mysqli_query($con,'select * from tblstaff WHERE company = "'.$_SESSION['company'].'"  ');
        $image = mysqli_fetch_array($img);
        if($image['profile_img']!=''){
            $i = $image['profile_img'];
        }else{
           $i = "8f64ad76980a7e3b35d084a6d67c96c5.jpg"; 
        }
        $this->Image('../logos/'.$i,10,5,45);
        $this->SetFont('Arial','',10);
        $date=date("Y-m-d h:i:sa");
         $c =mysqli_query($con,"SELECT * FROM tblstaff WHERE company='".$_SESSION['company']."'  ");
                while($r =mysqli_fetch_assoc($c)){
        $this->Cell(190,5,ucwords($r['companyname']),0,1,'C');
		$this->Cell(190,7,ucwords($r['location']),0,1,'C');
        $this->Cell(190,7,$r['email'],0,1,'C');
        $this->Cell(190,7,$r['contact'],0,1,'C');
        $this->SetFont('Arial','BU',13);
        $this->Cell(190,7,'QUOTATION',0,0,'C');
        $this->SetFont('Arial','B',9);
        $this->Ln(5);
        $this->SetFont('Arial','B',11);
        $this->Cell(50,7,'Cost of items', 0,1,'L');
        $this->SetFont('Arial','B',10);
		$this->Cell(10,7,'No.', 1,0,'L');
        $this->Cell(55,7,'Item', 1,0,'L');
        $this->Cell(40,7,'Item description', 1,0,'L');
        $this->Cell(15,7,'Qty', 1,0,'L');
        $this->Cell(25,7,'Unit price', 1,0,'C');
        $this->Cell(13,7,'Days', 1,0,'L');
        $this->Cell(30,7,'Total', 1,0,'C');
        $this->Ln();
                                                         }
    }
    

        function viewTable($con){
        $c=1;
        $task=0;
        $date=date("Y-m-d");
        $sqwe =mysqli_query($con,"SELECT SUM(total_items) AS total FROM event_quotation WHERE event_id='".$_GET['id']."'");
                     while($remmy =mysqli_fetch_assoc($sqwe)){
                          $total_items_cost=$remmy['total'];
                     }
        $query  = "SELECT * FROM event_quotation WHERE event_id='".$_GET['id']."' ";
        $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result))
              { 
                //   $event_id = $row['id'];
                //   $event_name=$row['event_name'];
                //   $cust_name=$row['customer_name'];
                $total_items =$row['total_items'];
                $item_id =$row['event_item'];
                $sqq =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$item_id'");
                while($data = mysqli_fetch_array($sqq)){
                    $item_name = $data['item_name'];
                }
       

        $this->SetFont('Arial','',9);
		    $this->Cell(10,6,$c++, 1,0,'L');
		    $this->Cell(55,6,ucwords($item_name), 1,0,'L');
        $this->Cell(40,6,ucwords($row['event_description']), 1,0,'L');
        $this->Cell(15,6,ucwords($row['event_quantity']), 1,0,'L');
        $this->Cell(25,6,number_format($row['event_single_price'],1), 1,0,'R');
        $this->Cell(13,6,ucwords($row['event_days']), 1,0,'C');
        $this->Cell(30,6,number_format($row['total_items'],1), 1,0,'R');
        $this->Ln();
      }
         $sqw =mysqli_query($con,"SELECT SUM(total_price) AS total FROM additional_costs WHERE event_id='".$_GET['id']."' ");
                     while($remmy =mysqli_fetch_assoc($sqw)){
                          $total_add_costs=$remmy['total'];
                     }
    
                 $rem=mysqli_query($con,"SELECT * FROM additional_costs WHERE event_id='".$_GET['id']."' ");
                 if($rem){
                     while($row =mysqli_fetch_assoc($rem)){
                       
                         if(!empty($row['cost_quantity'])){
                               $quan_quantity =$row['cost_quantity'];
                               $total_price =$row['cost_price'];
                         }else{
                             $quan_quantity="NILL";
                             $total_price =$row['costperunit'];
                         }
                    
      $this->Cell(10,6,$c++, 1,0,'L');
      $this->Cell(55,6,ucwords($row['cost_name']), 1,0,'L');
      $this->Cell(40,6,ucwords($row['cost_description']), 1,0,'L');
      $this->Cell(15,6,$quan_quantity, 1,0,'L');
      $this->Cell(25,6,number_format($row['costperunit'],1), 1,0,'R');
      $this->Cell(13,6,'-', 1,0,'C');
      $this->Cell(30,6,number_format($total_price,1), 1,0,'R');
      $this->Ln();
                       
                     }
      
        }
      
        $this->Cell(10,6,'', 0,0,'L');
		$this->Cell(65,6,'', 0,0,'L');
        $this->SetFont('Arial','B',9);
        $this->Cell(70,6,'Total cost:', 0,0,'R');
        $gtotal= $total_add_costs + $total_items_cost;
        $this->Cell(43,7,number_format($gtotal,1), 0,1,'R');
        $this->Ln(7);  

        $this->SetFont('Arial','',9);
        $this->Cell(54,8,'Accepted by:', 0,0,'L');
        $this->Cell(60,8,'..................................................................  ', 0,0,'L');
        $this->Cell(25,8,'  Signature', 0,0,'L');
        $this->Cell(60,8,'....................................', 0,1,'L');

$cc =mysqli_query($con,"SELECT * FROM tblstaff WHERE company='".$_SESSION['company']."'  ");
                while($rr =mysqli_fetch_assoc($cc)){
        $this->Cell(54,8,ucwords($rr['companyname']) .' :',0,0,'L');
       }
        $this->Cell(60,8,'..................................................................  ', 0,0,'L');
        $this->Cell(25,8,'  Signature', 0,0,'L');
        $this->Cell(60,8,'....................................', 0,1,'L'); 


         $this->Ln(7); 
       $pay=mysqli_query($con,'select * from tblstaff WHERE company = "'.$_SESSION['company'].'"  ');
        $py = mysqli_fetch_array($pay);
        
        $this->SetFont('Arial','BU',10);
        $this->Ln(2);
        $this->Cell(34,7,'Payment details', 0,1,'L');
        $this->SetFont('Arial','',9);
        $this->Cell(30,5,'Bank: ', 1,0,'L');
        $this->Cell(70,5,ucwords($py['bank_name']), 1,1,'L');
        $this->Cell(30,5,'Account Number:', 1,0,'L');
        $this->Cell(70,5,ucwords($py['acc_no']), 1,1,'L');
        $this->Cell(30,5,'Branch:', 1,0,'L');
        $this->Cell(70,5,ucwords($py['branch']), 1,1,'L');
        $this->Cell(30,5,'Account Name:', 1,0,'L');
        $this->Cell(70,5,ucwords($py['account_name']), 1,1,'L');
        $this->Ln(2);
        $this->Cell(30,5,'Mpesa Till Number:', 0,0,'L');
        $this->Cell(70,5,ucwords($py['till_no']), 0,1,'L');
        $this->Ln(2);
        $this->Cell(50,5,'Mpesa Pay Bill Business Number:', 1,0,'L');
        $this->Cell(50,5,ucwords($py['paybill']), 1,1,'L');
        $this->Cell(50,5,'Account Number:', 1,0,'L');
        $this->Cell(50,5,ucwords($py['business_no']), 1,1,'L'); 
}

                  
        
           


      function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',10);
        $this->Cell(0,5,$date=date("h:i:sa d-m-Y").' Served by '.ucwords($_SESSION['username']),0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(0,5,'Page'.$this->PageNo().'/{nb}',0,0,'R');
    }  
        
    }
    

$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('','A4',0);
$pdf->hd($con);
$pdf->viewTable($con);
$pdf->Output();
?>