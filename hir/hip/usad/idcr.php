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
        $this->Image('../logos/'.$image['profile_img'],10,5,45);
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
        $this->Cell(190,7,'Lease Invoice',0,1,'C');
    }
    function invoice($con){
        $date=date("Y-m-d h:i:sa");
        $inv=mysqli_query($con,'select * from tblleased WHERE client = "'.$_GET['cl'].'" ');
        $invoice = mysqli_fetch_array($inv);
        $this->SetFont('Arial','',10);
        $this->Cell(190,5,'Invoice no.: '.$invoice['invoice'], 0,1,'R');
        $this->SetFont('Arial','',9);
        $this->Cell(190,5,'Printed.: '.$date, 0,1,'R');
        $this->Cell(190,5,'Printed by.: '.$invoice['served_by'], 0,1,'R');
        $this->Ln();
    }
    function body($con){
        $date=date("Y-m-d h:i:sa");
        $query =mysqli_query($con,'select * from tblleased WHERE client = "'.$_GET['cl'].'"');
        $data = mysqli_fetch_array($query);
        $cus=mysqli_query($con,'select * from tblcustomers where identity = "'.$_GET['cl'].'" ');
        $cc = mysqli_fetch_array($cus);
            //set personal details and complaint... top
        $this->SetFont('Arial','',10);
        $this->Cell(30,5,'Date leased:', 0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(120,5,$data['ldate'].' '.$data['lease_time'],0,1,'L');//end of the line
        $this->Cell(30,5,'Customer Name:', 0,0,'L');
        $this->Cell(120,5,ucwords($cc['fname']).' '.ucwords($cc['mname']).' '.ucwords($cc['lname']),0,1,'L');//end of the line        
        $this->Cell(30,5,'Customer ID:', 0,0,'L');
        $this->Cell(120,5,ucwords($data['client']),0,1,'L');//end of the line
        $this->Cell(30,5,'Contact / Email:', 0,0,'L');
        $this->Cell(150,5,$cc['fcontact'].' '.$cc['email'],0,1,'L');//end of the line
        $this->Ln(5);

    }
    function viewTable($con){
        $this->Cell(12,6,'No.', 1,0,'L');
        $this->Cell(70,6,'Items', 1,0,'L');
        $this->Cell(25,6,'Charges @', 1,0,'L');
        $this->Cell(25,6,'Total Charged', 1,0,'L');
        $this->Cell(25,6,'Amount Paid', 1,0,'L');
        $this->Cell(30,6,'Balance', 1,1,'L');
        $c=1;
        $query  = "SELECT tblcustomers.id, tblcustomers.fname,tblcustomers.mname,tblcustomers.lname,tblcustomers.identity,tblcustomers.fcontact, tblleased.client,tblleased.item_name_id,tblleased.qnty,tblleased.qlty,tblleased.rdate,tblleased.ldate,tblleased.served_by,tblleased.status,tblleased.damaged,tblleased.item_id,tblitems.item_name,tblitems.damage_charges
                    FROM 
                    tblcustomers 
                    LEFT JOIN tblleased 
                    ON tblcustomers.identity = tblleased.client 
                    LEFT JOIN tblitems 
                    ON tblitems.id = tblleased.item_name_id  
                    where damaged>'0' and comment = 'not cleared' and client='".$_GET['cl']."' ";
                $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result))
                      { 
                $cb=$row['client'];
                $z=$row['item_name_id'];
                $q = "SELECT * FROM tblcleared where item_name_id_clear ='".$z."' and client='".$_GET['cl']."' ";
                $query_run = mysqli_query($con,$q);

                $paid= 0;
                while ($num = mysqli_fetch_assoc ($query_run)) {
                    $paid += $num['payment'];
                }
                        $dmg=$row['damage_charges'];
                        $d=$row['damaged'];
                        $charges=($dmg*$d);
                        $bal=$charges-$paid;

        $this->SetFont('Arial','',9);
        $this->Cell(12,5,$c, 1,0,'L');
        $this->Cell(70,5,$row['damaged'].' '.ucwords($row['item_name']), 1,0,'L');
        $this->Cell(25,5,$row['damage_charges'], 1,0,'L');
        $this->Cell(25,5,number_format($charges,2), 1,0,'L');
        $this->Cell(25,5,number_format($paid,2), 1,0,'L');
        $this->Cell(30,5,number_format($bal,2), 1,0,'R');
        $this->Ln();
        $c++;
        }
    }
    function viewTabl($con){
        $total=mysqli_query($con,'select sum(qnty*price) as product from tblleased WHERE client = "'.$_GET['cl'].'" ');
        $ttle = mysqli_fetch_array($total);
        $this->SetFont('Arial','B',10);
        $this->Ln(8);
        $pay=mysqli_query($con,'select * from tblstaff WHERE company = "'.$_SESSION['company'].'"  ');
        $py = mysqli_fetch_array($pay);
        
        $this->SetFont('Arial','BU',10);
        $this->Ln(2);
        $this->Cell(34,7,'Payment details', 0,1,'L');
        $this->SetFont('Arial','',9);
        $this->Cell(100,5,'Bank:    '.ucwords($py['bank_name']), 1,1,'L');
        $this->Cell(100,5,'Account Number:    '.ucwords($py['acc_no']), 1,1,'L');
        $this->Cell(100,5,'Branch:    '.ucwords($py['branch']), 1,1,'L');
        $this->Cell(100,5,'Account Name:   '.ucwords($py['account_name']), 1,1,'L');
        $this->Ln(2);
        $this->Cell(30,5,'Mpesa Till Number:', 0,0,'L');
        $this->Cell(70,5,ucwords($py['till_no']), 0,1,'L');
        $this->Ln(2);
        $this->Cell(50,5,'Mpesa Pay Bill Business Number:', 1,0,'L');
        $this->Cell(50,5,ucwords($py['paybill']), 1,1,'L');
        $this->Cell(50,5,'Account Number:', 1,0,'L');
        $this->Cell(50,5,ucwords($py['business_no']), 1,1,'L');

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
$pdf->invoice($con);
$pdf->body($con);
$pdf->viewTable($con);
$pdf->viewTabl($con);
$pdf->Output();

?>