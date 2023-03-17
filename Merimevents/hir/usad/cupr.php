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
     function hd($con){
        $date=date("Y-m-d h:i:sa");
        $img=mysqli_query($con,'select * from tblstaff WHERE company = "'.$_SESSION['company'].'"  ');
        $image = mysqli_fetch_array($img);
        if($image['profile_img']!=''){
            $i = $image['profile_img'];
        }else{
           $i = "8f64ad76980a7e3b35d084a6d67c96c5.jpg"; 
        }
        $this->Image('../logos/'.$i,10,5,25);
        $this->SetFont('Arial','B',12);
        $this->Cell(280,7,ucwords($image['companyname']),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(280,7,ucwords($image['location']),0,0,'C');
        $this->Ln(5);
        $this->Cell(280,7,ucwords($image['contact']),0,0,'C');
        $this->Ln(5);
        $this->Cell(280,7,$image['email'],0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','BU',14);
        $this->Cell(280,7,'Our Clients',0,1,'C');
    }
    
    
    function viewTable($con){
        $this->SetFont('Arial','B',11);
        $this->Cell(10,6,'No.', 1,0,'L');
        $this->Cell(63,6,'Customer Name', 1,0,'L');
        $this->Cell(40,6,'ID No.', 1,0,'L');
        $this->Cell(70,6,'Email Address', 1,0,'L');
        $this->Cell(30,6,'Phone Number', 1,0,'L');
        
      
        $this->Cell(63,6,'Company', 1,1,'L');
        $date=date("Y-m-d");
        $c=1;

        $query  = "SELECT * FROM tblcustomers where company='".$_SESSION['company']."' ORDER BY id ASC";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($result))
                                { 
                    $amount = ($row['price'] * $row['qnty']);          

        $this->SetFont('Arial','',9);
        $this->Cell(10,5,$c, 1,0,'L');
        $this->Cell(63,5,ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']), 1,0,'L');
        $this->Cell(40,5,ucwords($row['identity']), 1,0,'L');
        $this->Cell(70,5,$row['email'], 1,0,'L');
        $this->Cell(30,5,ucwords($row['fcontact']), 1,0,'L');
        $this->Cell(63,5,ucwords($row['b_c_name']), 1,1,'L');
        $c++;
                                                   
        }
    }
    

    
function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',7);
        $this->Cell(0,5,'',0,0,'L');
        $this->SetFont('Arial','',8);
        $this->Cell(0,5,'Page'.$this->PageNo().'/{nb}',0,0,'R');
    }

    }
    

$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->hd($con);
$pdf->viewTable($con);
$pdf->Output();

?>