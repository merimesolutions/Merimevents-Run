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
        $this->Cell(290,7,'Damaged items & payments',0,1,'C');
        
       /* $date=date("Y-m-d h:i:sa");
        $inv=mysqli_query($con,'select * from tblleased WHERE random = "'.$_GET['tm'].'"  ');
        $invoice = mysqli_fetch_array($inv);
        $this->SetFont('Arial','',9);
        $this->Cell(290,5,'Printed.: '.$date, 0,1,'C');
        $this->Cell(290,5,'Printed by.: '.$invoice['served_by'], 0,1,'C');
        $this->Ln();*/
    }
    
    
    function viewTable($con){
        $this->SetFont('Arial','B',10);
        $this->Cell(12,6,'No.', 1,0,'L');
        $this->Cell(55,6,'Client', 1,0,'L');
        $this->Cell(32,6,'ID No.', 1,0,'L');
        $this->Cell(55,6,'Item Name', 1,0,'L');
        $this->Cell(20,6,'Quantity', 1,0,'L');
        $this->Cell(30,6,'Charges for @', 1,0,'L');
        $this->Cell(24,6,'Charged', 1,0,'L');
        $this->Cell(24,6,'Paid', 1,0,'L');
        $this->Cell(24,6,'Balance', 1,1,'L');
               $c=1;
                             $s = $_SESSION['company'];
                            $q  = "SELECT * FROM tblcustomers where company = '".$_SESSION['company']."'";
                        $r = mysqli_query($con, $q);
                            while ($rows = mysqli_fetch_array($r))
                                                  { 
                                $cc=$rows['identity'];
                        $query  = "SELECT * FROM tblleased where damaged !='NULL' and comment = 'not cleared' and client= '$cc' ";
                        $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result))
                                                  { 
                                $cb=$row['client'];
                                $z=$row['item_name_id'];
                                $d=$row['damaged'];
                                
                        $qu = "SELECT * FROM tblitems where id ='$z'";
                        $res= mysqli_query($con, $qu);
                            while ($rowss = mysqli_fetch_array($res))
                                                  {
                                       $dmg=$rowss['damage_charges'];           $charges=($dmg*$d);    
                        $q = "SELECT * FROM tblcleared where item_name_id_clear ='".$z."' and client='".$cb."' ";
                                            $query_run = mysqli_query($con,$q);

                                            $paid= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $paid += $num['payment'];

                                        
                                                  }

        $this->SetFont('Arial','',9);
        $this->Cell(12,5,$c, 1,0,'L');
        $this->Cell(55,5,ucwords($rows['fname']).' '.ucwords($rows['mname']).' '.ucwords($rows['lname']), 1,0,'L');
        $this->Cell(32,5,$cc, 1,0,'L');
        $this->Cell(55,5,ucwords($rowss['item_name']), 1,0,'L');
        $this->Cell(20,5,$row['damaged'], 1,0,'L');
        $this->Cell(30,5,$rowss['damage_charges'], 1,0,'L');
        $this->Cell(24,5,$charges, 1,0,'L');
        $this->Cell(24,5,$paid, 1,0,'L');
        $this->Cell(24,5,($charges - $paid), 1,1,'L');
        $c++;
                                                  }
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