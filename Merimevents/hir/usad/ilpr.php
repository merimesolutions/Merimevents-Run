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
        if($img){
            while ($ron =mysqli_fetch_assoc($img)){
                $vat  = $ron['vat'];
            }
        }
        $image = mysqli_fetch_array($img);
        if($image['profile_img']!=''){
            $i = $image['profile_img'];
        }else{
           $i = "8f64ad76980a7e3b35d084a6d67c96c5.jpg"; 
        }
        $this->Image('../logos/'.$i,10,5,45);
        $this->SetFont('Arial','B',10);
        $this->Cell(190,7,ucwords($image['companyname']),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(190,7,ucwords($ron['location']),0,0,'C');
        $this->Ln(5);
        $this->Cell(190,7,ucwords($ron['contact']),0,0,'C');
        $this->Ln(5);
        $this->Cell(190,7,$ron['email'],0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','BU',12);
        $this->Cell(190,7,'Lease Invoice',0,1,'C');
        $this->Ln(5);
    }
    
    function invoice($con){
        $date=date("Y-m-d h:i:sa");
        $inv=mysqli_query($con,'select * from tblleased WHERE invoice = "'.$_GET['tm'].'"  ');
        $invoice = mysqli_fetch_array($inv);
        
        $date=date("Y-m-d h:i:sa");
        $query =mysqli_query($con,'select * from tblleased WHERE invoice = "'.$_GET['tm'].'"');
        $data = mysqli_fetch_array($query);
        $cus=mysqli_query($con,'select * from tblcustomers where identity = "'.$data['client'].'" ');
        $cc = mysqli_fetch_array($cus);
        
        $this->SetFont('Arial','',10);
        $this->Cell(30,5,'Date leased:', 0,0,'L');
        $this->Cell(110,5,$data['ldate'].' '.$data['lease_time'], 0,0,'L');
        $this->Cell(50,5,'Invoice no.: '.$invoice['invoice'], 0,1,'R');
        $this->Cell(30,5,'Customer Name:', 0,0,'L');
        $this->Cell(110,5,ucwords($cc['fname']).' '.ucwords($cc['mname']).' '.ucwords($cc['lname']), 0,0,'L');
        $this->Cell(50,5,'Printed.: '.$date, 0,1,'R');
        $this->Cell(30,5,'Customer ID:', 0,0,'L');
        $this->Cell(110,5,ucwords($data['client']), 0,0,'L');
        $this->Cell(50,5,'Served by.: '.ucwords($invoice['served_by']), 0,1,'R');
        $this->Cell(30,5,'Contact / Email:', 0,0,'L');
        $this->Cell(160,5,$cc['fcontact'].' '.$cc['email'], 0,1,'L');
        $this->Ln();
    }
    function viewTable($conn){
        $this->SetFont('Arial','B',10);
        $this->Cell(12,6,'No.', 1,0,'L');
        $this->Cell(65,6,'Item Name', 1,0,'L');
        $this->Cell(25,6,'Quantity', 1,0,'L');
        $this->Cell(25,6,'Price per item', 1,0,'L');
        $this->Cell(25,6,'Days', 1,0,'L');
        $this->Cell(35,6,'Total amount', 1,1,'C');
        $c=1;
        $stmt = $conn->query('select * from tblleased WHERE invoice = "'.$_GET['tm'].'" order by item_id desc');
        while($row = $stmt->fetch(PDO::FETCH_OBJ)){

            $client = $conn->query('select * from tblitems where id="'.$row->item_name_id.'" ');
            while($r = $client->fetch(PDO::FETCH_OBJ)){
                
                date_default_timezone_set('Africa/Nairobi');
                                            $time2 = strtotime($row->ldate);
                                            $time1 = strtotime($row->rdate);
                                            $dif   = floor( ($time1-$time2) /(60*60*24));

        $this->SetFont('Arial','',9);
        $this->Cell(12,5,$c, 1,0,'L');
        $this->Cell(65,5,ucwords($r->item_name), 1,0,'L');
        $this->Cell(25,5,$row->qnty, 1,0,'L');
        $this->Cell(25,5,$row->price, 1,0,'L');
        $this->Cell(25,5,$dif, 1,0,'L');
        $this->Cell(35,5,number_format(($row->price*$row->qnty*$dif),2), 1,1,'R');
        $c++;
    }
        }
    }
    function viewTabl($con){
        $this->Ln(1);
    $total=mysqli_query($con,'select sum(total_cost) as product from tblleased WHERE invoice = "'.$_GET['tm'].'" ');
    $ttle = mysqli_fetch_array($total);
    $t=mysqli_query($con,'select * from tblleased WHERE invoice = "'.$_GET['tm'].'" ');
    $tt = mysqli_fetch_array($t);
        $this->SetFont('Arial','B',9);
        $this->Cell(117,6,'', 0,0,'L');
        $this->Cell(35,6,'Total Cost', 1,0,'R');
        $this->Cell(35,6,number_format(($ttle['product']),2), 1,1,'R');
    $amount=mysqli_query($con,'select sum(amount) as paid from tbltransactions WHERE invoice = "'.$_GET['tm'].'" ');
    $a = mysqli_fetch_array($amount);
    $vats=($ttle['product']) * 0.16;
    $tots=$vats + $a['paid'];
        $this->Cell(117,6,'', 0,0,'L');
        $this->Cell(35,6,'Amount Paid', 1,0,'R');
        $this->Cell(35,6,number_format($a['paid'],2), 1,1,'R');
        if($vat = 'Inclusive'){
        echo
        $this->Cell(117,6,'', 0,0,'L');
        $this->Cell(35,6,'VAT 16%', 1,0,'R');
        $this->Cell(35,6,number_format($vats,2), 1,1,'R');
        }
        $this->Cell(117,6,'', 0,0,'L');
        $this->Cell(35,6,'Balance', 1,0,'R');
        $this->Cell(35,6,number_format(($ttle['product'])-$a['paid'],2), 1,1,'R');

        $this->Ln(7);
        $this->SetFont('Arial','',9);
        $this->Cell(34,7,'Collector Name:', 0,0,'L');
        $this->Cell(80,7,'.....................................................................................', 0,0,'L');
        $this->Cell(25,7,'Signature', 0,0,'L');
        $this->Cell(60,7,'....................................................', 0,1,'L');

        $this->Cell(34,7,'Served by:', 0,0,'L');
        $this->Cell(80,7,'.....................................................................................', 0,0,'L');
        $this->Cell(25,7,'Signature', 0,0,'L');
        $this->Cell(60,7,'....................................................', 0,1,'L');

        $this->Cell(34,7,'Authorized by:', 0,0,'L');
        $this->Cell(80,7,'.....................................................................................', 0,0,'L');
        $this->Cell(25,7,'Signature', 0,0,'L');
        $this->Cell(60,7,'....................................................', 0,1,'L');
        $this->Ln(8);
        
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
        $this->SetFont('Arial','',7);
        $this->Cell(0,5,'Thank you for choosing us',0,0,'L');
        $this->SetFont('Arial','',8);
        $this->Cell(0,5,'Page'.$this->PageNo().'/{nb}',0,0,'R');
    }

    }
    

$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('','A4',0);
$pdf->hd($con);
$pdf->invoice($con);
$pdf->viewTable($conn);
$pdf->viewTabl($con);
$pdf->Output();

?>