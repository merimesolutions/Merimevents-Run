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
     function head($con){
        $date=date("Y-m-d h:i:sa");
        $img=mysqli_query($con,'select * from tblstaff WHERE company = "'.$_SESSION['company'].'"  ');
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
        $this->Cell(190,7,ucwords($image['location']),0,0,'C');
        $this->Ln(5);
        $this->Cell(190,7,ucwords($image['contact']),0,0,'C');
        $this->Ln(5);
        $this->Cell(190,7,$image['email'],0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','BU',10);
        $this->Cell(190,7,'Overdue Penalty Invoice',0,1,'C');
        $this->Ln(5);
    }
    
    function invoice($con){
        $date=date("Y-m-d h:i:sa");
        $inv=mysqli_query($con,'select * from tblleased WHERE random = "'.$_GET['tm'].'"  ');
        $invoice = mysqli_fetch_array($inv);
        
        $date=date("Y-m-d h:i:sa");
        $query =mysqli_query($con,'select * from tblleased WHERE client = "'.$_GET['tm'].'"');
        $data = mysqli_fetch_array($query);
        $cus=mysqli_query($con,'select * from tblcustomers where identity = "'.$data['client'].'" ');
        $cc = mysqli_fetch_array($cus);
        
        $this->SetFont('Arial','',10);
        $this->Cell(33,5,'Customer Name: ', 0,0,'L');
        $this->Cell(67,5,ucwords($cc['fname']).' '.ucwords($cc['mname']).' '.ucwords($cc['lname']), 0,0,'L');
        $this->Cell(72,5,'Invoice no.: '.$invoice['invoice'], 0,1,'R');
        $this->Cell(33,5,'Customer ID:', 0,0,'L');
        $this->Cell(67,5,ucwords($data['client']), 0,0,'L');
        $this->Cell(72,5,'Printed.: '.$date, 0,1,'R');
        $this->Cell(33,5,'Contact / Email:', 0,0,'L');
        $this->Cell(67,5,$cc['fcontact'].' '.$cc['email'], 0,0,'L');
        $this->Cell(72,5,'Served by.: '.ucwords($invoice['served_by']), 0,1,'R');
        $this->Ln();
    }
    function viewTable($con){

        $this->SetFont('Arial','B',10);
        $this->Cell(12,6,'No.', 1,0,'L');
        $this->Cell(45,6,'Item Name', 1,0,'L');
        $this->Cell(30,6,'Deadline', 1,0,'L');
        $this->Cell(20,6,'Quantity', 1,0,'L');
        $this->Cell(20,6,'Extra days', 1,0,'R');
        $this->Cell(30,6,'Charges per day', 1,0,'R');
        $this->Cell(30,6,'Amount Charges', 1,1,'R');
        $c=1;
        $date = date("Y-m-d h:i:sa");
        $query  = "SELECT tblcustomers.id, tblcustomers.fname,tblcustomers.mname,tblcustomers.lname,tblcustomers.identity,tblcustomers.fcontact, tblleased.client,tblleased.item_name_id,tblleased.qnty,tblleased.qlty,tblleased.rdate,tblleased.ldate,tblleased.served_by,tblleased.status,tblleased.damaged,tblleased.item_id,tblitems.item_name,tblitems.damage_charges,tblitems.overdue_charges,tblleased.company
            FROM 
            tblcustomers 
            LEFT JOIN tblleased 
            ON tblcustomers.identity = tblleased.client 
            LEFT JOIN tblitems 
            ON tblitems.id = tblleased.item_name_id  
            where rdate < '".$date."' and tblleased.company='".$_SESSION['company']."' and tblleased.comment !='cleared' and tblleased.client = '".$_GET['tm']."' ";
        $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result))
              { 
        $cb=$row['client'];
        $z=$row['item_id'];
         
        $amount=mysqli_query($con,'select payment from tbloverdate WHERE client = "'.$cb.'" and itemid = "'.$z.'" ');
       $a = mysqli_fetch_array($amount);

            $paid = $a['payment'];
        
        date_default_timezone_set('Africa/Nairobi');
        $time2 = strtotime(date("Y-m-d h:i:sa"));
        $time1 = strtotime($row['rdate']);
        $dif   = floor( ($time2-$time1) /(60*60*24));
        $overdue =($row['overdue_charges'] * $dif * $row['qnty']);

        $bal=$overdue - $paid;

        $this->SetFont('Arial','',9);
        $this->Cell(12,5,$c, 1,0,'L');
        $this->Cell(45,5,ucwords($row['item_name']), 1,0,'L');
        $this->Cell(30,5,$row['rdate'], 1,0,'L');
        $this->Cell(20,5,$row['qnty'], 1,0,'L');
        $this->Cell(20,5,floor( ($time2-$time1) /(60*60*24)), 1,0,'R');
        $this->Cell(30,5,number_format($row['overdue_charges'],2), 1,0,'R');
        $this->Cell(30,5,number_format($overdue,2), 1,1,'R');
        $c++;
        
    }
    $this->Cell(157,5,'Total Amount', 0,0,'R');
    $this->Cell(30,5,'', 1,1,'R');
    $this->Cell(157,5,'Total paid', 0,0,'R');
    $this->Cell(30,5,'', 1,1,'R');
    $this->Cell(157,5,'Balance', 0,0,'R');
    $this->Cell(30,5,'', 1,1,'R');
}
    function viewTabl($con){
        $this->Ln(5);
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
$pdf->head($con);
$pdf->invoice($con);
$pdf->viewTable($con);
$pdf->viewTabl($con);
$pdf->Output();

?>