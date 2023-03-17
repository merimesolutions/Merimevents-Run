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
		$this->Cell(190,7,'Recent added stock',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Arial','B',9);
		$this->Cell(12,5,'No.', 1,0,'L');
        $this->Cell(20,5,'Batch No.', 1,0,'L');
        $this->Cell(45,5,'Item Name', 1,0,'L');
        $this->Cell(18,5,'Quantity', 1,0,'L');
        $this->Cell(35,5,'Quality.', 1,0,'L');
        $this->Cell(35,5,'Category', 1,0,'L');
        $this->Cell(25,5,'Added date', 1,0,'L');
        $this->Ln();

    }
    

        function viewTable($conn){

        $today=date('Y-m-d');
		$c=1;
        $stmt = $conn->query('select * from tblitems where added_date="'.$today.'" order by id desc');
        
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){

        $this->SetFont('Arial','',9);
		$this->Cell(12,5,$c, 1,0,'L');
        $this->Cell(20,5,$data->bno, 1,0,'L');
        $this->Cell(45,5,ucwords($data->item_name), 1,0,'L');
        $this->Cell(18,5,$data->qnty, 1,0,'L');
        $this->Cell(35,5,ucwords($data->qlty), 1,0,'L');
        $this->Cell(35,5,ucwords($data->category), 1,0,'L');
        $this->Cell(25,5,ucwords($data->added_date), 1,0,'L');
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