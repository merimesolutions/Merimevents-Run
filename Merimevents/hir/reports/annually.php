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
        $this->Image('../../images/watermark.jpg',65,85,80);
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',10);
        $this->Cell(190,7,'SOTIK TEA COMPANY LIMITED / SOTIK HIGHLANDS TEA ESTATE, PRIVATE BAG SOTIK.',0,0,'C');
        $this->Ln(4);
        $this->SetFont('Arial','',10);
        if ($_SESSION['estate']=="arr"){
                $estate="at Arroket Dispensary";
            }else{
                if ($_SESSION['estate']=="high"){
            $estate="at Highlands Dispensary";
            }else{
        if ($_SESSION['estate']=="mon"){
            $estate="at Monieri Dispensary";
            }else{
            $estate="From All Estates"; 
            } }}
        $this->Cell(190,7,'ANNUAL SICK-OFF DAYS REPORT',0,0,'C');
        $this->Ln(4);
        $this->SetFont('Arial','',10);
        $this->Cell(190,7,'Printed '.$estate,0,0,'C');
        $this->Ln(6);
        $this->SetFont('Arial','B',10);
        $this->Cell(17,5,'No.', 1,0,'L');
        $this->Cell(20,5,'Year', 1,0,'L');
        $this->Cell(25,5,'CrNo.', 1,0,'L');
        $this->Cell(74,5,'Full Name', 1,0,'L');
        $this->Cell(27,5,'Sick-off Days', 1,0,'L');
        $this->Cell(27,5,'Balance Days', 1,0,'L');
        $this->Ln();

    }
    

        function viewTable($conn){
        $year=$_POST['searchdate'];
        $d=0;
        $stmt = $conn->query('SELECT crno,period,today,no,p_name,sickleave,sickoff_days,balance_days, sum(sickoff_days) AS sickdays FROM tblreport  WHERE period="'.$year.'" and category  NOT LIKE "Non Employee" and category  NOT LIKE "Not Specified" and sickoff_days>"'.$d.'" group by crno ORDER BY sickoff_days DESC');
        $c=1;
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $sickdays=$data->sickdays;  
                $normal_days="110";                             
                $balance= $normal_days-$sickdays;
            //set personal details and complaint... top

        $this->SetFont('Arial','',10);
        $this->Cell(17,5,$c, 1,0,'L');
        $this->Cell(20,5,$data->period, 1,0,'L');
        $this->Cell(25,5,$data->crno, 1,0,'L');
        $this->Cell(74,5,ucwords($data->p_name), 1,0,'L');
        $this->Cell(27,5,$sickdays, 1,0,'L');
        $this->Cell(27,5,$balance, 1,0,'L');
        $this->Ln();
        $c++;
        }
        
}
        
        
    }
    

$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('','A4',0);
$pdf->viewTable($conn);
$pdf->Output();
?>