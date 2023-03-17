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
        $this->SetFont('Arial','B',10);
        $this->Cell(190,7,ucwords($image['companyname']),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(190,7,ucwords($image['location']),0,0,'C');
        $this->Ln(5);
        $this->Cell(190,7,ucwords($image['contact']),0,0,'C');
        $this->Ln(5);
        $this->Cell(190,7,$image['email'],0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','BU',12);
        $this->Cell(190,7,'Payment Transactions',0,1,'C');
        $this->Ln(5);
    }
    
    function body($con){
        $squery = mysqli_query($con, "select distinct random,invoice,client,ldate,lease_time,company from tblleased where company='".$_SESSION['company']."' and random ='".$_GET['tjk78wenm4yuwernmnmzxcyunmnmztye7834nm434nm43rf//578nmsdjn//sdfjkmerime']."'  ");
                while($rows = mysqli_fetch_array($squery))
                                            {
                $random =$rows['random'];
                $invoice =$rows['invoice'];
                $r=$rows['client'];
                $cd = mysqli_query($con, "select * from tblcustomers where identity='".$r."' ");
                while($data = mysqli_fetch_array($cd))
            {
                $fname=$data['fname'];
                $mname=$data['mname'];
                $lname=$data['lname'];
            
        $this->SetFont('Arial','',10);
        $this->Cell(190,6,ucwords($fname).' '.ucwords($mname).' '.ucwords($lname),0,1,'C');
        $this->Cell(190,6,'ID: '.ucwords($r),0,1,'C');
                                          
                                            
       $c = mysqli_query($con, "select distinct random, invoice from tbltransactions where random ='".$_GET['tjk78wenm4yuwernmnmzxcyunmnmztye7834nm434nm43rf//578nmsdjn//sdfjkmerime']."' ");
        while($row = mysqli_fetch_array($c))
                                            {
        $this->SetFont('Arial','B',10);
        $this->Cell(190,6,'INV NO.'.ucwords($row['invoice']),0,1,'C');
                                            }
                                        }
         }
    }

    function viewTable($conn){
        $this->Ln(2);
        $this->SetFont('Arial','B',10);
        $this->Cell(12,6,'No.', 1,0,'L');
        $this->Cell(40,6,'Date', 1,0,'L');
        $this->Cell(35,6,'Transaction code', 1,0,'L');
        $this->Cell(65,6,'Served by', 1,0,'L');
        $this->Cell(35,6,'Amount paid', 1,1,'R');
        $c=1;
        $stmt = $conn->query('select * from tbltransactions WHERE random = "'.$_GET['tjk78wenm4yuwernmnmzxcyunmnmztye7834nm434nm43rf//578nmsdjn//sdfjkmerime'].'" order by id desc');
        while($row = $stmt->fetch(PDO::FETCH_OBJ)){

        $this->SetFont('Arial','',9);
        $this->Cell(12,5,$c, 1,0,'L');
        $this->Cell(40,5,ucwords($row->date_paid), 1,0,'L');
        $this->Cell(35,5,$row->trans, 1,0,'L');
        $this->Cell(65,5,ucwords($row->served_by), 1,0,'L');
        $this->Cell(35,5,number_format($row->amount,2), 1,1,'R');
        $c++;
        }
    }
    function viewTabl($con){
    $total=mysqli_query($con,'select sum(qnty*price) as product from tblleased WHERE random = "'.$_GET['tjk78wenm4yuwernmnmzxcyunmnmztye7834nm434nm43rf//578nmsdjn//sdfjkmerime'].'" ');
    $ttle = mysqli_fetch_array($total);
    
    $amount=mysqli_query($con,'select sum(amount) as paid from tbltransactions WHERE random = "'.$_GET['tjk78wenm4yuwernmnmzxcyunmnmztye7834nm434nm43rf//578nmsdjn//sdfjkmerime'].'" ');
    $a = mysqli_fetch_array($amount);
    
        $this->SetFont('Arial','B',9);
        $this->Cell(87,6,'', 0,0,'L');
        $this->Cell(65,6,'Total amount paid', 1,0,'R');
        $this->Cell(35,6,number_format($a['paid'],2), 1,1,'R');
        $this->Ln(2);
        
        $this->Cell(87,6,'', 0,0,'L');
        $this->Cell(65,6,'Total Amount Due', 1,0,'R');
        $this->Cell(35,6,number_format($ttle['product'],2), 1,1,'R');
        
        $this->Cell(87,6,'', 0,0,'L');
        $this->Cell(65,6,'Outstanding balance', 1,0,'R');
        $this->Cell(35,6,number_format($ttle['product']-$a['paid'],2), 1,1,'R');
        
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
$pdf->AddPage('','A4',0);
$pdf->hd($con);
$pdf->body($con);
$pdf->viewTable($conn);
$pdf->viewTabl($con);
$pdf->Output();

?>