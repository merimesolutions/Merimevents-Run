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

<?php
    require "../connection.php";                           
?>
<?php     
require "../fpdf/fpdf.php";


class myPDF extends FPDF{
    function header(){
        $this->Image('../../images/watermark.jpg',65,24,80);
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',12);
        $this->Cell(190,7,'SOTIK TEA COMPANY LIMITED / SOTIK HIGHLANDS TEA ESTATE',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',11);
        $this->Cell(190,7,'PRIVATE BAG SOTIK',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','U',10);
        if ($_SESSION['estate']=="arr"){
                $estate="ARROKET DISPENSARY";
            }else{
                if ($_SESSION['estate']=="high"){
            $estate="SOTIK HIGHLANDS TEA ESTATE DISPENSARY";
            }else{
        if ($_SESSION['estate']=="mon"){
            $estate="MONIERI DISPENSARY";
            }else{
            $estate="DISPENSARY SYSTEM"; 
            } }}
        $this->Cell(190,7,'PATIENT REFERRAL REPORT - '.$estate,0,0,'C');
        $this->Ln(8);

    }
    function body($con){
        $query =mysqli_query($con,'select * from tblreferral WHERE patient_id = "'.$_GET['patientid'].'"');
        $data = mysqli_fetch_array($query);
            //set personal details and complaint... top
        $this->SetFont('Arial','B',10);
        $this->Cell(45,7,'Date', 0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(120,7,$data['ref_date'],0,1,'L');//end of the line
        $this->Ln(5);
        
        $this->SetFont('Arial','B',10);
        $this->Cell(45,6,'Patient Name', 0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(120,6,ucwords($data['p_name']),0,1,'L');//end of the line
        $this->SetFont('Arial','B',10);
        $this->Cell(45,6,'Patient ID ', 0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(120,6,ucwords($data['patient_id']),0,0,'L');//end of the line
        $this->Ln(10);

        $this->SetFont('Arial','B',10);
        $this->Cell(190,0,'',1,1,'');
        $this->Cell(45,6,'Medical practitioner', 0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(145,6,ucwords($data['doc_onduty']), 0,0,'L');
        $this->Ln(7);

        $this->SetFont('Arial','B',10);
        $this->Cell(190,0,'',1,1,'');
        $this->Cell(45,6,'Reason for Referral', 0,0,'L');
        $this->SetFont('Arial','',10);
        $this->MultiCell(145 ,6,$data['ref_reason'],0,1);
        $this->Cell(190,0,'',1,1,'');

        $this->SetFont('Arial','B',10);
        $this->Cell(45,6,'Referred To ', 0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(145,7,ucwords($data['ref_to']), 0,1,'L');
        $this->Cell(190,0,'',1,1,'');
        $this->Ln(12);
        $this->SetFont('Arial','',10);
        $this->Cell(190,7,'Checked By:              ......................................................................', 0,0,'L');
        $this->Ln(10);
        $this->Cell(190,7,'Signature / Stamp:     ......................................................................', 0,0,'L');
        $this->Ln(1);
         }
    
function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',6);
        $this->Cell(0,5,'This is the property of Sotik Tea Company Limited / Sotik Highlands Tea Estate',0,0,'L');
        $this->SetFont('Arial','',8);
        $this->Cell(0,5,'Page'.$this->PageNo().'/{nb}',0,0,'R');
    }

    }
    

$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A5',0);
$pdf->body($con);
$pdf->Output();

?>