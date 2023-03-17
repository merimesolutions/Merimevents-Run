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
    function header(){
        $this->Image('../../images/logo.png',10,5,45);
        $this->SetFont('Arial','B',10);
        $this->Cell(190,7,'Merime Solutions',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(190,7,'2nd floor, Kilifi Plaza',0,0,'C');
        $this->Ln(5);
        $this->Cell(190,7,'Tel: 0700000001',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','BU',12);
        $this->Cell(190,7,'Overdue Invoice',0,1,'C');
        
    }
    function invoice($con){
        $date=date("Y-m-d h:i:sa");
        $inv=mysqli_query($con,'select * from tblleased WHERE client = "'.$_GET['cl'].'" group by invoice ');
        $invoice = mysqli_fetch_array($inv);
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
        $this->Cell(30,5,'Customer Name:', 0,0,'L');
        $this->Cell(120,5,ucwords($cc['fname']).' '.ucwords($cc['mname']).' '.ucwords($cc['lname']),0,1,'L');//end of the line        
        $this->Cell(30,5,'Customer ID:', 0,0,'L');
        $this->Cell(120,5,ucwords($data['client']),0,1,'L');//end of the line
        $this->Cell(30,5,'Contact / Email:', 0,0,'L');
        $this->Cell(150,5,$cc['fcontact'].' '.$cc['email'],0,1,'L');//end of the line
        $this->Ln(5);

    }
    function viewTable($con){
        $this->Cell(10,6,'No.', 1,0,'L');
        $this->Cell(55,6,'Item Name', 1,0,'L');
        $this->Cell(22,6,'Qnty leased', 1,0,'L');
        $this->Cell(22,6,'Return date', 1,0,'L');
        $this->Cell(20,6,'Extra days', 1,0,'L');
        $this->Cell(20,6,'Charged', 1,0,'L');
        $this->Cell(20,6,'Paid', 1,0,'L');
        $this->Cell(20,6,'Balance', 1,1,'L');
        $c=1;
        $date=date("Y-m-d");
        $query  = "SELECT tblcustomers.id, tblcustomers.fname,tblcustomers.mname,tblcustomers.lname,tblcustomers.identity,tblcustomers.fcontact, tblleased.client,tblleased.item_name_id,tblleased.qnty,tblleased.qlty,tblleased.rdate,tblleased.ldate,tblleased.served_by,tblleased.status,tblleased.damaged,tblleased.item_id,tblitems.item_name,tblitems.damage_charges,tblitems.overdue_charges
                                                FROM 
                                                tblcustomers 
                                                LEFT JOIN tblleased 
                                                ON tblcustomers.identity = tblleased.client 
                                                LEFT JOIN tblitems 
                                                ON tblitems.id = tblleased.item_name_id  
                                                where rdate < '".$date."' and comment = 'not cleared' and client='".$_GET['cl']."'";
                                            $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result))
                                                  { 
                                            $cb=$row['client'];
                                            $z=$row['item_name_id'];
                                            $q = "SELECT * FROM tbloverdate where item_name_id_overdue ='".$z."' and client='".$_GET['cl']."' ";
                                            $query_run = mysqli_query($con,$q);

                                            $paid= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $paid += $num['payment'];
                                            }
                                            
                                            date_default_timezone_set('Africa/Nairobi');
                                            $time2 = strtotime(date("Y-m-d"));
                                            $time1 = strtotime($row['rdate']);
                                            $dif   = floor( ($time2-$time1) /(60*60*24));
                                            $overdue =($row['overdue_charges'] * $dif);

                                            $bal=$overdue - $paid;

        $this->SetFont('Arial','',9);
        $this->Cell(10,5,$c, 1,0,'L');
        $this->Cell(55,5,ucwords($row['item_name']), 1,0,'L');
        $this->Cell(22,5,$row['qnty'], 1,0,'L');
        $this->Cell(22,5,$row['rdate'], 1,0,'L');
        $this->Cell(20,5,floor( ($time2-$time1) /(60*60*24)), 1,0,'L');
        $this->Cell(20,5,number_format($overdue,2), 1,0,'R');
        $this->Cell(20,5,number_format($paid,2), 1,0,'R');
        $this->Cell(20,5,number_format($bal,2), 1,0,'R');
        $this->Ln();
        $c++;
        }
    }
    function viewTabl($con){
        $total=mysqli_query($con,'select sum(qnty*price) as product from tblleased WHERE client = "'.$_GET['cl'].'" ');
        $ttle = mysqli_fetch_array($total);
        $this->SetFont('Arial','B',10);
        /*$this->Cell(107,6,'Grand Total', 0,0,'R');   
        $this->Cell(25,6,number_format($ttle['product'],2), 1,0,'R');
        $this->Cell(25,6,number_format($ttle['product'],2), 1,0,'R');
        $this->Cell(30,6,number_format($ttle['product'],2), 1,1,'R');*/

        /*$this->Ln(10);
        $this->SetFont('Arial','',9);
        $this->Cell(34,7,'Collector Name', 0,0,'L');
        $this->Cell(80,7,'.....................................................................................', 0,0,'L');
        $this->Cell(25,7,'Signature', 0,0,'L');
        $this->Cell(60,7,'....................................................', 0,1,'L');

        $this->Cell(34,7,'Served by', 0,0,'L');
        $this->Cell(80,7,'.....................................................................................', 0,0,'L');
        $this->Cell(25,7,'Signature', 0,0,'L');
        $this->Cell(60,7,'....................................................', 0,1,'L');

        $this->Cell(34,7,'Authorized by', 0,0,'L');
        $this->Cell(80,7,'.....................................................................................', 0,0,'L');
        $this->Cell(25,7,'Signature', 0,0,'L');
        $this->Cell(60,7,'....................................................', 0,1,'L');*/
        $this->Ln(8);

        $this->SetFont('Arial','BU',9);
        $this->Cell(34,7,'Payment details', 0,1,'L');
        $this->SetFont('Arial','',8);
        $this->Cell(30,5,'Mpesa Pay Bill:', 0,0,'L');
        $this->Cell(70,5,'658412', 0,1,'L');
        $this->Cell(30,5,'Equity Bank:', 0,0,'L');
        $this->Cell(70,5,'777 526 236 254 587', 0,1,'L');
        $this->Cell(30,5,'KCB Bank:', 0,0,'L');
        $this->Cell(70,5,'658 412 000 452 000', 0,1,'L');

}

    
function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',7);
        $this->Cell(0,5,'Thank you for choosing Merime Solutions',0,0,'L');
        $this->SetFont('Arial','',8);
        $this->Cell(0,5,'Page'.$this->PageNo().'/{nb}',0,0,'R');
    }

    }
    

$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('','A4',0);
$pdf->invoice($con);
$pdf->body($con);
$pdf->viewTable($con);
$pdf->viewTabl($con);
$pdf->Output();

?>