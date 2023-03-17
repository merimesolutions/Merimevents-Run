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
        $this->Cell(290,7,'Available stock',0,1,'C');
    }
    
    
    function viewTable($con){
        $this->SetFont('Arial','',10);
        $this->Cell(13,6,'No.', 1,0,'L');
        $this->Cell(25,6,'Item Code', 1,0,'L');
        $this->Cell(59,6,'Item Name', 1,0,'L');
        $this->Cell(59,6,'Description', 1,0,'L');
        $this->Cell(30,6,'Stocked Qnty', 1,0,'L');
        $this->Cell(30,6,'Stocked Date', 1,0,'L');
        $this->Cell(30,6,'Damaged Qnty', 1,0,'L');
        $this->Cell(30,6,'Current Qnty', 1,1,'L');
        $c=1;
        $company=$_SESSION['company'];
        $query  = "SELECT tblitems.id, tblitems.item_name,tblitems.qnty,tblitems.qlty,tblitems.bno,tblitems.category, tblitems.added_date,tblitems.added_by,tblitems.company
                FROM 
                tblitems where company='".$company."' 
                ORDER BY tblitems.id desc";
            $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result))
                  { 
               $item = $row['id'] ;      
        $qry  = "SELECT SUM(bal_qnty) AS sum ,SUM(damaged) AS damaged FROM tblleased where item_name_id='".$item."' ";

    $r = mysqli_query($con, $qry);
    while ($rows = mysqli_fetch_assoc($r))
                  {
    $d='0';                  
    $bal = $row['qnty'] - $rows['sum'];
    $d=$rows['damaged'];             

        $this->SetFont('Arial','',9);
        $this->Cell(13,5,$c, 1,0,'L');
        $this->Cell(25,5,ucwords($row['bno']), 1,0,'L');
        $this->Cell(59,5,ucwords($row['item_name']), 1,0,'L');
        $this->Cell(59,5,ucwords($row['category']), 1,0,'L');
        $this->Cell(30,5,$row['qnty'], 1,0,'L');
        $this->Cell(30,5,ucwords($row['added_date']), 1,0,'L');
        $this->Cell(30,5,$d, 1,0,'L');
        $this->Cell(30,5,$bal, 1,1,'L');
        $c++;
                  }                                 
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