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
        $this->Image('../../images/watermark.jpg',105,60,80);
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',10);
        $this->Cell(280,7,'SOTIK TEA COMPANY LIMITED / SOTIK HIGHLANDS TEA ESTATE, PRIVATE BAG SOTIK.',0,0,'C');
        $this->Ln(4);
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
            $estate="ALL DISPENSARIES"; 
            } }}
        $this->Cell(280,7,'SICK-OFF REPORT - '.$estate,0,0,'C');
        $this->Ln(7);
        $this->SetFont('Arial','B',10);
        $this->Cell(11,5,'No.', 1,0,'L');
        $this->Cell(20,5,'Date', 1,0,'L');
        $this->Cell(22,5,'PatientID', 1,0,'L');
        $this->Cell(18,5,'CrNo.', 1,0,'L');
        $this->Cell(46,5,'Full Name', 1,0,'L');
        $this->Cell(46,5,'Medical practitioner', 1,0,'L');
        $this->Cell(80,5,'Sick-Off Comment', 1,0,'L');
        $this->Cell(17,5,'Off Days', 1,0,'L');
        $this->Cell(17,5,'Bal Days', 1,0,'L');
        $this->Ln();

    }
    

        function viewTable($conn){

        $today=date('Y-m-d');
        $stmt = $conn->query('select * from tblreport where today="'.$today.'" and sickoff="sickoff" and category  NOT LIKE "Non Employee" and category  NOT LIKE "Not Specified" order by id desc');
        $c=1;
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            //set personal details and complaint... top

        $this->SetFont('Arial','',10);
        $this->Cell(11,5,$c, 1,0,'L');
        $this->Cell(20,5,$data->today, 1,0,'L');
        $this->Cell(22,5,$data->no, 1,0,'L');
        $this->Cell(18,5,$data->crno, 1,0,'L');
        $this->Cell(46,5,ucwords($data->p_name), 1,0,'L');
        $this->Cell(46,5,ucwords($data->serviced_by), 1,0,'L');
        $this->Cell(80,5,$data->sickleave, 1,0,'L');
        $this->Cell(17,5,$data->sickoff_days, 1,0,'L');
        $this->Cell(17,5,$data->balance_days, 1,0,'L');
        $this->Ln();
        $c++;
        }
        
}
        
        
    }
    

$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->viewTable($conn);
$pdf->Output();
?>