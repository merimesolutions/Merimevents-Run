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
        //$this->Image('../../img/watermark.jpg',65,85,80);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',14);
        $this->Cell(128,6,'Hire Kilifi',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','I',9);
        $this->Cell(128,6,'Kilifi, 2nd Floor Kilifi Plaza',0,0,'C');
        $this->Ln(5);
        $this->Cell(128,6,'P.O. Box. 40108-000, Tel: 254700000000',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(128,5,'Customer report',0,0,'C');
        $this->Ln(5);
        $this->Cell(128,0,'',1,0,'');
        $this->Ln(4);

    }
    function body($con){
        $query =mysqli_query($con,'select * from tblcustomers WHERE id = "'.$_GET['cus'].'"');
        $data = mysqli_fetch_array($query);

        $this->SetFont('Arial','',9);
        $this->Cell(28,5,'Customer Name', 0,0,'L');
        $this->SetFont('Times','',9);
        $this->Cell(55,5,': '.ucwords($data['fname']).' '.ucwords($data['lname']).' '.ucwords($data['mname']), 0,0,'L');
        $this->SetFont('Arial','',9);
        $this->Cell(22,5,'Postal Code', 0,0,'R');
        $this->SetFont('Times','',9);
        $this->Cell(23,5,': '.ucwords($data['code']), 0,1,'L');

        $this->SetFont('Arial','',9);
        $this->Cell(28,5,'Gender', 0,0,'L');
        $this->SetFont('Times','',9);
        $this->Cell(55,5,': '.ucwords($data['gender']), 0,0,'L');
        $this->SetFont('Arial','',9);
        $this->Cell(22,5,'Box No.', 0,0,'R');
        $this->SetFont('Times','',9);
        $this->Cell(23,5,': '.ucwords($data['box']), 0,1,'L');

        $this->SetFont('Arial','',9);
        $this->Cell(28,5,'National ID', 0,0,'L');
        $this->SetFont('Times','',9);
        $this->Cell(55,5,': '.ucwords($data['identity']), 0,0,'L');
        $this->SetFont('Arial','',9);
        $this->Cell(22,5,'Town', 0,0,'R');
        $this->SetFont('Times','',9);
        $this->Cell(23,5,': '.ucwords($data['town']), 0,1,'L');
        $this->Ln(7);

        $this->SetFont('Arial','B',9);
        $this->Cell(128,5,'Contact details', 0,1,'L');
        $this->Ln(2);
        $this->SetFont('Arial','',9);
        $this->Cell(35,5,'Physical Address', 0,0,'L');
        $this->SetFont('Times','',9);
        $this->Cell(93,5,': '.ucwords($data['phy_address']), 0,1,'L');
        $this->SetFont('Arial','',9);
        $this->Cell(35,5,'First Contact No.', 0,0,'L');
        $this->SetFont('Times','',9);
        $this->Cell(76,5,': '.ucwords($data['fcontact']), 0,1,'L');
        $this->SetFont('Arial','',9);
        $this->Cell(35,5,'Second Contact No.', 0,0,'L');
        $this->SetFont('Times','',9);
        $this->Cell(76,5,': '.ucwords($data['scontact']), 0,1,'L');
        $this->SetFont('Arial','',9);
        $this->Cell(35,5,'Email Address', 0,0,'L');
        $this->SetFont('Times','',9);
        $this->Cell(76,5,': '.$data['email'], 0,1,'L');
        $this->Ln(5);

        $this->SetFont('Arial','B',9);
        $this->Cell(189,5,'Business / Company', 0,1,'L');
        $this->Ln(2);
        $this->SetFont('Arial','',9);
        $this->Cell(40,5,'Business / Company Name', 0,0,'L');
        $this->SetFont('Times','',9);
        $this->Cell(88,5,': '.ucwords($data['b_c_name']), 0,1,'L');
        $this->SetFont('Arial','',9);
        $this->Cell(40,5,'Location', 0,0,'L');
        $this->SetFont('Times','',9);
        $this->Cell(88,5,': '.ucwords($data['b_c_location']), 0,1,'L');


        $this->Ln(1);
        $this->SetY(-27);
        $this->SetFont('Arial','',7);
        $this->Cell(112,5,'Powered by Merime Solutions. ', 0,0,'L');

        $this->SetY(-12); 
         }
    
    function footer(){
        $this->Cell(0,5,'Page'.$this->PageNo().'/{nb}',0,0,'R');

        }
    }
    

$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('','A5',0);
$pdf->body($con);
$pdf->Output();

?>