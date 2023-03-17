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
        $this->SetFont('Arial','B',10);
        $this->Cell(290,7,ucwords($image['companyname']),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(290,7,ucwords($image['location']),0,0,'C');
        $this->Ln(5);
        $this->Cell(290,7,ucwords($image['contact']),0,0,'C');
        $this->Ln(5);
        $this->Cell(290,7,$image['email'],0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','BU',10);
        $this->Cell(290,7,'Leased Items',0,1,'C');
    }
    
    
    function viewTable($con){
        $this->SetFont('Arial','',10);
        $this->Cell(13,6,'No.', 1,0,'L');
        $this->Cell(55,6,'Client', 1,0,'L');
        $this->Cell(22,6,'ID No.', 1,0,'L');
        $this->Cell(53,6,'Item', 1,0,'L');
        $this->Cell(20,6,'Invoice', 1,0,'L');
        $this->Cell(25,6,'Leased date', 1,0,'L');
        $this->Cell(25,6,'Returning Date', 1,0,'L');
        $this->Cell(15,6,'Qnty', 1,0,'L');
        $this->Cell(25,6,'@', 1,0,'R');
        $this->Cell(25,6,'Amount', 1,1,'R');
        $date=date("Y-m-d");
        $c=1;

        $query  = "SELECT tblcustomers.fname,tblcustomers.mname,tblcustomers.lname, tblitems.id, tblitems.item_name,tblleased.qnty,tblleased.invoice,tblleased.qlty,tblleased.ldate,tblleased.rdate, tblleased.served_by,tblleased.item_name_id,tblleased.item_id,tblleased.price,tblleased.client
            FROM 
            tblcustomers
            LEFT JOIN tblleased 
            ON tblcustomers.identity = tblleased.client
            LEFT JOIN tblitems 
            ON tblitems.id = tblleased.item_name_id where tblleased.company='".$_SESSION['company']."' ORDER BY id DESC";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($result))
                               { 
                    $ldate = date('Y-m-d',strtotime(ucwords($row['ldate'])));
                    $rdate = date('Y-m-d',strtotime(ucwords($row['rdate'])));
                    $amount = ($row['price'] * $row['qnty']);          

        $this->SetFont('Arial','',9);
        $this->Cell(13,5,$c, 1,0,'L');
        $this->Cell(55,5,ucwords($row['fname']).' '.ucwords($row['mname']).' '.ucwords($row['lname']), 1,0,'L');
        $this->Cell(22,5,ucwords($row['client']), 1,0,'L');
        $this->Cell(53,5,ucwords($row['item_name']), 1,0,'L');
        $this->Cell(20,5,ucwords($row['invoice']), 1,0,'L');
        $this->Cell(25,5,$ldate, 1,0,'L');
        $this->Cell(25,5,$rdate, 1,0,'L');
        $this->Cell(15,5,$row['qnty'], 1,0,'L');
        $this->Cell(25,5,number_format($row['price'],1), 1,0,'R');
        $this->Cell(25,5,number_format($amount,1), 1,1,'R');
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