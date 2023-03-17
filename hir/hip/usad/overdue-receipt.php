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
        $this->Image('../logos/'.$i,10,5,45);
        $this->SetFont('Arial','B',12);
        $this->Cell(190,7,ucwords($image['companyname']),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',12);
        $this->Cell(190,7,ucwords($image['location']),0,0,'C');
        $this->Ln(5);
        $this->Cell(190,7,ucwords($image['contact']),0,0,'C');
        $this->Ln(5);
        $this->Cell(190,7,$image['email'],0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','BU',12);
        $this->Cell(190,7,'Overdue Items Payment Receipt',0,1,'C');
        $this->Ln(5);
    }
    
    function body($con){

       $c = mysqli_query($con, "select * from tbloverdate where id ='".$_GET['receipt']."' ");
        while($row = mysqli_fetch_array($c))
                                            {
                    $client = $row['client'] ;                           
          $customer = mysqli_query($con, "select * from tblcustomers where identity ='".$client."' ");
        while($rows = mysqli_fetch_array($customer))
                                            {                                      
        $this->SetFont('Arial','B',12);
        $this->Cell(190,6,'Amount paid for: '.ucwords($row['item']),0,1,'C');
        $this->Cell(190,6,'PAID BY',0,1,'L');
        $this->SetFont('Arial','',12);
        $this->Cell(30,6,'Name:',0,0,'L');
        $this->Cell(120,6,ucwords($rows['fname']).' '.ucwords($rows['mname']).' '.ucwords($rows['lname']),0,0,'L');
        $this->Cell(40,6,'Trans: ',0,1,'R');
        $this->Cell(30,6,'Identity:',0,0,'L');
        $this->Cell(160,6,ucwords($row['client']),0,1,'L');
        $this->Cell(30,6,'Date:',0,0,'L');
        $this->Cell(160,6,$row['cleared_date'],0,1,'L');
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->Cell(190,6,'AMOUNT PAID: '.number_format($row['payment'],2),0,1,'C');
        
        $this->SetFont('Arial','B',12);
        $this->Cell(190,6,'Any Comment: ',0,1,'L');
        $this->SetFont('Times','',11);
        $this->Cell(190,6,ucwords($row['comment']),0,1,'L');
        
        $this->Ln(7);
        $this->SetFont('Arial','',9);
        $this->Cell(34,7,'Paid by:', 0,0,'L');
        $this->Cell(80,7,'.....................................................................................', 0,0,'L');
        $this->Cell(25,7,'Signature', 0,0,'L');
        $this->Cell(60,7,'....................................................', 0,1,'L');

        $this->Cell(34,7,'Served by:', 0,0,'L');
        $this->Cell(80,7,'.....................................................................................', 0,0,'L');
        $this->Cell(25,7,'Signature', 0,0,'L');
        $this->Cell(60,7,'....................................................', 0,1,'L');
                                          
         }
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
$pdf->AddPage('L','A5',0);
$pdf->hd($con);
$pdf->body($con);
$pdf->Output();

?>