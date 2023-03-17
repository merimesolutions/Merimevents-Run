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
        $this->SetFont('Arial','BU',12);
        $this->Cell(190,7,'Leased Items Sales Report',0,1,'C');
        $this->Ln(5);
    }

    function viewTable($conn){
        $this->SetFont('Arial','B',10);
        $this->Cell(12,6,'No.', 1,0,'L');
        $this->Cell(40,6,'Date Invoiced', 1,0,'L');
        $this->Cell(35,6,'Invoice Number', 1,0,'L');
        $this->Cell(35,6,'Total Revenue', 1,0,'R');
        $this->Cell(35,6,'Paid Revenue', 1,0,'R');
        $this->Cell(35,6,'Balance', 1,1,'R');
        $c=1;
$stmt = $conn->query('select distinct invoice,ldate from tblleased WHERE company = "'.$_SESSION['company'].'" AND (ldate BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'") ');
        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $invoice = $row->invoice;

$total=$conn->query('select sum(qnty*price) as product from tblleased where invoice="'.$row->invoice.'" ');
    while($rows = $total->fetch(PDO::FETCH_OBJ)){
    
$all=$conn->query('select rdate,
  ldate,
  DATEDIFF(rdate, ldate) as date_interval from tblleased where invoice="'.$row->invoice.'" ');
    while($r = $all->fetch(PDO::FETCH_OBJ)){
        $diff=$r->date_interval;
    } 
    
    $amount=$conn->query('select sum(amount) as paid from tbltransactions WHERE invoice = "'.$row->invoice.'" ');
    while($a = $amount->fetch(PDO::FETCH_OBJ)){
      $ldate = date('Y-m-d',strtotime($row->ldate));
        $this->SetFont('Arial','',9);
        $this->Cell(12,5,$c, 1,0,'L');
        $this->Cell(40,5,$ldate, 1,0,'L');
        $this->Cell(35,5,$row->invoice, 1,0,'L');
        $this->Cell(35,5,number_format($rows->product*$diff,2), 1,0,'R');
        $this->Cell(35,5,number_format($a->paid,2), 1,0,'R');
        $this->Cell(35,5,number_format(($rows->product*$diff)-$a->paid,2), 1,1,'R');
        $c++;
    
    }
}
            }
        }

    function viewTabl($conn){
  
  $total=$conn->query('select SUM(qnty*price) AS product from tblleased WHERE company = "'.$_SESSION['company'].'" AND (ldate BETWEEN  "'.$_GET['start'].'" AND "'.$_GET['end'].'")');
    while($rows = $total->fetch(PDO::FETCH_OBJ)){

        $this->SetFont('Arial','B',9);
        $this->Cell(52,6,'', 0,0,'L');
        $this->Cell(35,6,'Grand Total', 0,0,'C');
        $this->Cell(35,5,number_format($rows->product,2), 1,0,'R');
        $this->Cell(35,5,number_format($a->paid,2), 1,0,'R');
        $this->Cell(35,5,number_format(($rows->product*$diff)-$a->paid,2), 1,1,'R');
    
}
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
$pdf->viewTable($conn);
$pdf->viewTabl($conn);
$pdf->Output();

?>