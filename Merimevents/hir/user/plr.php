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
	$year=date('m-Y');	
?>
<?php     
require "../fpdf/fpdf.php";


class myPDF extends FPDF{
    function header(){
        $this->Image('../../images/logo.png',10,5,20);
        $this->SetFont('Arial','B',10);
        $this->Cell(190,5,'Merime Solutions',0,0,'C');
        $this->Ln(5);
		$this->Cell(190,7,'Projects',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Arial','B',9);
		$this->Cell(10,5,'No.', 1,0,'L');
        $this->Cell(45,5,'Project', 1,0,'L');
        $this->Cell(20,5,'Started', 1,0,'L');
        $this->Cell(20,5,'Deadline.', 1,0,'L');
        $this->Cell(20,5,'Status', 1,0,'L');
        $this->Cell(75,5,'Description', 1,0,'L');
        $this->Ln();

    }
    

        function viewTable($conn){

        $today=date('Y-m-d');
		$c=1;
        $stmt = $conn->query('select * from tblprojects order by id desc');
        
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){

        $this->SetFont('Arial','',9);
		$this->Cell(10,5,$c, 1,0,'L');
        $this->Cell(45,5,ucwords($data->project), 1,0,'L');
        $this->Cell(20,5,$data->started, 1,0,'L');
        $this->Cell(20,5,$data->deadline, 1,0,'L');
        $this->Cell(20,5,$data->status, 1,0,'L');
        $this->Cell(75,5,ucwords($data->description), 1,0,'L');
        $this->Ln();
        $c++;
        }
        
}
      function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',7);
        $this->Cell(0,5,'This is the property of Merime | https://www.merimesolutions.com',0,0,'L');
        $this->SetFont('Arial','',8);
        $this->Cell(0,5,'Page'.$this->PageNo().'/{nb}',0,0,'R');
    }  
        
    }
    

$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('','A4',0);
$pdf->viewTable($conn);
$pdf->Output();
?>