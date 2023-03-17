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
    function header(){
        $this->Image('../../images/logo.png',10,5,30);
        $this->SetFont('Arial','B',10);
        $this->Cell(190,7,'Merime Solutions',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(190,7,'2nd floor, Kilifi Plaza',0,0,'C');
        $this->Ln(5);
        $this->Cell(190,7,'Tel: 0700000001',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','BU',10);
        $this->Cell(190,7,'Items leased report',0,1,'C');
    }
    function viewTable($con){
        $this->SetFont('Arial','',9);
        $this->Cell(10,6,'No.', 1,0,'L');
        $this->Cell(30,6,'Client', 1,0,'L');
        $this->Cell(22,6,'ID No.', 1,0,'L');
        $this->Cell(32,6,'Item', 1,0,'L');
        $this->Cell(20,6,'Leased date', 1,0,'L');
        $this->Cell(23,6,'Returning date', 1,0,'L');
        $this->Cell(10,6,'Qnty', 1,0,'L');
        $this->Cell(20,6,'@', 1,0,'L');
        $this->Cell(20,6,'Total', 1,1,'L');
        $c=1;
    $date=date("Y-m-d");
    $c=1;

    $query  = "SELECT tblcustomers.fname,tblcustomers.mname,tblcustomers.lname, tblitems.id, tblitems.item_name,tblleased.qnty,tblleased.qlty,tblleased.ldate,tblleased.rdate, tblleased.served_by,tblleased.item_name_id,tblleased.item_id,tblleased.price,tblleased.client
        FROM 
        tblcustomers
        LEFT JOIN tblleased 
        ON tblcustomers.identity = tblleased.client
        LEFT JOIN tblitems 
        ON tblitems.id = tblleased.item_name_id ORDER BY id DESC";
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_array($result))
                            { 
                $amount = ($row['price'] * $row['qnty']);

        $this->SetFont('Arial','',9);
        $this->Cell(10,5,$c, 1,0,'L');
        $this->Cell(30,5,ucwords($row['fname']), 1,0,'L');
        $this->Cell(22,5,ucwords($row['client']), 1,0,'L');
        $this->Cell(32,5,ucwords($row['client']), 1,0,'L');
        $this->Cell(20,5,ucwords($row['client']), 1,0,'L');
        $this->Cell(23,5,ucwords($row['client']), 1,0,'R');
        $this->Cell(10,5,ucwords($row['qnty']), 1,0,'R');
        $this->Cell(20,5,ucwords($row['client']), 1,0,'R');
        $this->Cell(20,5,ucwords($row['client']), 1,0,'R');
        $this->Ln();
        $c++;
        }
    }
    function viewTabl($con){
        $this->Ln(8);

        $this->SetFont('Arial','BU',9);
        $this->Cell(34,7,'Payment details', 0,1,'L');
        $this->SetFont('Arial','',8);
        $this->Cell(30,5,'Mpesa Pay Bill:', 0,0,'L');
        $this->Cell(70,5,'658412', 0,1,'L');
        $this->Cell(30,5,'Equity Bank:', 0,0,'L');
        $this->Cell(70,5,'777 526 236 254 587', 0,1,'L');
        $this->Cell(30,5,'KCB Bank:', 0,0,'L');
        $this->Cell(70,5,'658 412 000 452 000', 0,1,'L');

}

    
function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',7);
        $this->Cell(0,5,'Thank you for choosing Merime Solutions',0,0,'L');
        $this->SetFont('Arial','',8);
        $this->Cell(0,5,'Page'.$this->PageNo().'/{nb}',0,0,'R');
    }

    }
    

$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('','A4',0);
$pdf->viewTable($con);
$pdf->viewTabl($con);
$pdf->Output();

?>