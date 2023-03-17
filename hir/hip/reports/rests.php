

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
        $this->Image('../../images/logo.png',10,2,25);
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',10);
        $this->Cell(280,16,'AVAILABLE STOCK',0,0,'C');
        $this->Ln(12);
        $this->SetFont('Arial','B',10);
        $this->Cell(15,6,'No.', 1,0,'L');
        $this->Cell(30,6,'Batch No', 1,0,'L');
        $this->Cell(75,6,'item Name', 1,0,'L');
        $this->Cell(25,6,'Quantity', 1,0,'L');
        $this->Cell(53,6,'Lease charges', 1,0,'L');
        $this->Cell(53,6,'Supplier', 1,0,'L');
        $this->Cell(25,6,'Receipt No', 1,0,'L');
        $this->Cell(25,6,'Added By', 1,0,'L');
        $this->Ln();

    }
    

        function viewTable($conn){

        $today=date('Y-m-d');
        $stmt = $conn->query('select * from tblitems order by id desc');
        $c=1;
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            //set personal details and complaint... top

        $this->SetFont('Arial','',10);
        $this->Cell(15,6,$c, 1,0,'L');
        $this->Cell(30,6,$data->bno, 1,0,'L');
        $this->Cell(75,6,ucwords($data->item_name), 1,0,'L');
        $this->Cell(25,6,$data->qnty, 1,0,'L');
        $this->Cell(53,6,ucwords($data->lease_charges), 1,0,'L');
        $this->Cell(53,6,ucwords($data->supplier), 1,0,'L');
        $this->Cell(53,6,ucwords($data->receipt), 1,0,'L');
        $this->Cell(53,6,ucwords($data->added_by), 1,0,'L');
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