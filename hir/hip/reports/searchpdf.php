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
        $this->Image('../../images/watermark.jpg',105,60,80);
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',10);
        $this->Cell(280,7,'SOTIK TEA COMPANY LIMITED / SOTIK HIGHLANDS TEA ESTATE, PRIVATE BAG SOTIK.',0,0,'C');
        $this->Ln(4);
        $this->SetFont('Arial','U',10);
        if ($_SESSION['estate']=="arr"){
                $estate="ARROKET DISPENSARY";
            }else{
                if ($_SESSION['estate']=="high"){
            $estate="SOTIK HIGHLANDS TEA ESTATE DISPENSARY";
            }else{
        if ($_SESSION['estate']=="mon"){
            $estate="MONIERI DISPENSARY";
            }else{
            $estate="DISPENSARY SYSTEM"; 
            } }}
        $this->Cell(280,7,'PATIENT VISIT REPORT - '.$estate,0,0,'C');
    
        $this->Ln(4);

    }
    

        function viewSickness($conn){
        $this->SetFont('Arial','B',10);
        $this->Cell(90,7,'Sickness Category - Employees', 0,0,'L');
        $this->Ln();
        $this->SetFont('Arial','B',10);
        $this->Cell(15,5,'No.', 1,0,'L');
        $this->Cell(35,5,'PatientID', 1,0,'L');
        $this->Cell(35,5,'CrNo.', 1,0,'L');
        $this->Cell(90,5,'Full Name', 1,0,'L');
        $this->Cell(50,5,'Visit Date', 1,0,'L');
        $this->Cell(50,5,'Treatment Category', 1,0,'L');
        $this->Ln();
        
        $today=$_POST['searchdate'];
        $stmt = $conn->query('select * from tblreport where today="'.$today.'" and category="sickness" and estate="'.$_SESSION['estate'].'" order by id desc');
        $c=1;
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            //set personal details and complaint... top

        
        $this->SetFont('Arial','',10);
        $this->Cell(15,5,$c, 1,0,'L');
        $this->Cell(35,5,$data->no, 1,0,'L');
        $this->Cell(35,5,$data->crno, 1,0,'L');
        $this->Cell(90,5,ucwords($data->p_name), 1,0,'L');
        $this->Cell(50,5,$data->serviced_date, 1,0,'L');
        $this->Cell(50,5,$data->category, 1,0,'L');
        $this->Ln();
        $c++;
        }
        require "../connection.php"; 
         $query =mysqli_query($con,'select * from tblreport WHERE today = "'.$today.'" and estate = "'.$_SESSION['estate'].'" and category = "sickness" ');
        $sickness = mysqli_num_rows($query);
        $this->SetFont('Arial','B',10);
        $this->Cell(175,5,'', 0,0,'L');
        $this->Cell(50,5,'Sub Total', 1,0,'L');
        $this->Cell(50,5,$sickness, 1,0,'L');
        $this->Ln();
}
        function viewOnDuty($conn){
        $this->SetFont('Arial','B',10);
        $this->Cell(90,7,'On-Duty Injury Category - Employees', 0,0,'L');
        $this->Ln();
        $this->SetFont('Arial','B',10);
        $this->Cell(15,5,'No.', 1,0,'L');
        $this->Cell(35,5,'PatientID', 1,0,'L');
        $this->Cell(35,5,'CrNo.', 1,0,'L');
        $this->Cell(90,5,'Full Name', 1,0,'L');
        $this->Cell(50,5,'Visit Date', 1,0,'L');
        $this->Cell(50,5,'Treatment Category', 1,0,'L');
        $this->Ln();

        $today=$_POST['searchdate'];
        $stmt = $conn->query('select * from tblreport where today="'.$today.'" and category="On-Duty Injury" and estate="'.$_SESSION['estate'].'" order by id desc');
        $c=1;
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            //set personal details and complaint... top

        $this->SetFont('Arial','',10);
        $this->Cell(15,5,$c, 1,0,'L');
        $this->Cell(35,5,$data->no, 1,0,'L');
        $this->Cell(35,5,$data->crno, 1,0,'L');
        $this->Cell(90,5,ucwords($data->p_name), 1,0,'L');
        $this->Cell(50,5,$data->serviced_date, 1,0,'L');
        $this->Cell(50,5,$data->category, 1,0,'L');
        $this->Ln();
        $c++;
        }
        require "../connection.php"; 
         $query =mysqli_query($con,'select * from tblreport WHERE today = "'.$today.'" and estate = "'.$_SESSION['estate'].'" and category = "On-Duty Injury" ');
        $onduty = mysqli_num_rows($query);
        $this->SetFont('Arial','B',10);
        $this->Cell(175,5,'', 0,0,'L');
        $this->Cell(50,5,'Sub Total', 1,0,'L');
        $this->Cell(50,5,$onduty, 1,0,'L');
        $this->Ln();
      }
       function viewOffDuty($conn){
        $this->SetFont('Arial','B',10);
        $this->Cell(90,7,'Off-Duty Injury Category - Employees', 0,0,'L');
        $this->Ln();
        $this->SetFont('Arial','B',10);
        $this->Cell(15,5,'No.', 1,0,'L');
        $this->Cell(35,5,'PatientID', 1,0,'L');
        $this->Cell(35,5,'CrNo.', 1,0,'L');
        $this->Cell(90,5,'Full Name', 1,0,'L');
        $this->Cell(50,5,'Visit Date', 1,0,'L');
        $this->Cell(50,5,'Treatment Category', 1,0,'L');
        $this->Ln();

        $today=$_POST['searchdate'];
        $stmt = $conn->query('select * from tblreport where today="'.$today.'" and category="Off-Duty Injury" and estate="'.$_SESSION['estate'].'" order by id desc');
        $c=1;
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            //set personal details and complaint... top

        $this->SetFont('Arial','',10);
        $this->Cell(15,5,$c, 1,0,'L');
        $this->Cell(35,5,$data->no, 1,0,'L');
        $this->Cell(35,5,$data->crno, 1,0,'L');
        $this->Cell(90,5,ucwords($data->p_name), 1,0,'L');
        $this->Cell(50,5,$data->serviced_date, 1,0,'L');
        $this->Cell(50,5,$data->category, 1,0,'L');
        $this->Ln();
        $c++;
        }
        require "../connection.php"; 
         $query =mysqli_query($con,'select * from tblreport WHERE today = "'.$today.'" and estate = "'.$_SESSION['estate'].'" and category = "Off-Duty Injury" ');
        $offduty = mysqli_num_rows($query);
        $this->SetFont('Arial','B',10);
        $this->Cell(175,5,'', 0,0,'L');
        $this->Cell(50,5,'Sub Total', 1,0,'L');
        $this->Cell(50,5,$offduty, 1,0,'L');
        $this->Ln();
      }
       function viewMch($conn){
        $this->SetFont('Arial','B',10);
        $this->Cell(90,7,'MCH', 0,0,'L');
        $this->Ln();
        $this->SetFont('Arial','B',10);
        $this->Cell(15,5,'No.', 1,0,'L');
        $this->Cell(35,5,'PatientID', 1,0,'L');
        $this->Cell(35,5,'CrNo.', 1,0,'L');
        $this->Cell(90,5,'Full Name', 1,0,'L');
        $this->Cell(50,5,'Visit Date', 1,0,'L');
        $this->Cell(50,5,'Treatment Category', 1,0,'L');
        $this->Ln();

        $today=date('Y-m-d');
        $mstmt = $conn->query('select * from tblreport where today="'.$today.'" and purpose="MCH" and estate="'.$_SESSION['estate'].'" order by id desc');
        $c=1;
        while($data = $mstmt->fetch(PDO::FETCH_OBJ)){
            //set personal details and complaint... top

        $this->SetFont('Arial','',10);
        $this->Cell(15,5,$c, 1,0,'L');
        $this->Cell(35,5,$data->no, 1,0,'L');
        $this->Cell(35,5,$data->crno, 1,0,'L');
        $this->Cell(90,5,ucwords($data->p_name), 1,0,'L');
        $this->Cell(50,5,$data->serviced_date, 1,0,'L');
        $this->Cell(50,5,$data->purpose, 1,0,'L');
        $this->Ln();
        $c++;
        }
        require "../connection.php"; 
         $mquery =mysqli_query($con,'select * from tblreport WHERE today = "'.$today.'" and estate = "'.$_SESSION['estate'].'" and purpose="MCH" ');
        $mch = mysqli_num_rows($mquery);
        $this->SetFont('Arial','B',10);
        $this->Cell(175,5,'', 0,0,'L');
        $this->Cell(50,5,'Sub Total', 1,0,'L');
        $this->Cell(50,5,$mch, 1,0,'L');
        $this->Ln();
      }
        function viewDep($conn){
        $this->SetFont('Arial','B',10);
        $this->Cell(90,7,'Dependants', 0,0,'L');
        $this->Ln();
        $this->SetFont('Arial','B',10);
        $this->Cell(15,5,'No.', 1,0,'L');
        $this->Cell(35,5,'PatientID', 1,0,'L');
        $this->Cell(35,5,'CrNo. Used', 1,0,'L');
        $this->Cell(90,5,'Full Name', 1,0,'L');
        $this->Cell(50,5,'Visit Date', 1,0,'L');
        $this->Cell(50,5,'Purpose', 1,0,'L');
        $this->Ln();

        $today=$_POST['searchdate'];
        $stmt = $conn->query('select * from tblreport where today="'.$today.'" and purpose="Treatment" and estate="'.$_SESSION['estate'].'" order by id desc');
        $c=1;
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            //set personal details and complaint... top

        $this->SetFont('Arial','',10);
        $this->Cell(15,5,$c, 1,0,'L');
        $this->Cell(35,5,$data->no, 1,0,'L');
        $this->Cell(35,5,$data->crno, 1,0,'L');
        $this->Cell(90,5,ucwords($data->p_name), 1,0,'L');
        $this->Cell(50,5,$data->serviced_date, 1,0,'L');
        $this->Cell(50,5,$data->purpose, 1,0,'L');
        $this->Ln();
        $c++;
        }
        require "../connection.php"; 
         $query =mysqli_query($con,'select * from tblreport WHERE today = "'.$today.'" and estate = "'.$_SESSION['estate'].'" and purpose="Treatment" ');
        $dep = mysqli_num_rows($query);
        $this->SetFont('Arial','B',10);
        $this->Cell(175,5,'', 0,0,'L');
        $this->Cell(50,5,'Sub Total', 1,0,'L');
        $this->Cell(50,5,$dep, 1,0,'L');
        $this->Ln();
      }
        function viewNon($conn){
        $this->SetFont('Arial','B',10);
        $this->Cell(90,7,'Non Employees', 0,0,'L');
        $this->Ln();
        $this->SetFont('Arial','B',10);
        $this->Cell(15,5,'No.', 1,0,'L');
        $this->Cell(35,5,'PatientID', 1,0,'L');
        $this->Cell(35,5,'ID/Birth No.', 1,0,'L');
        $this->Cell(90,5,'Full Name', 1,0,'L');
        $this->Cell(50,5,'Visit Date', 1,0,'L');
        $this->Cell(50,5,'Treatment Category', 1,0,'L');
        $this->Ln();

        $today=$_POST['searchdate'];
        $stmt = $conn->query('select * from tblreport where today="'.$today.'" and category="Non Employee" and estate="'.$_SESSION['estate'].'" order by id desc');
        $c=1;
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            //set personal details and complaint... top

        $this->SetFont('Arial','',10);
        $this->Cell(15,5,$c, 1,0,'L');
        $this->Cell(35,5,$data->no, 1,0,'L');
        $this->Cell(35,5,$data->crno, 1,0,'L');
        $this->Cell(90,5,ucwords($data->p_name), 1,0,'L');
        $this->Cell(50,5,$data->serviced_date, 1,0,'L');
        $this->Cell(50,5,$data->category, 1,0,'L');
        $this->Ln();
        $c++;
        }
        require "../connection.php"; 
         $query =mysqli_query($con,'select * from tblreport WHERE today = "'.$today.'" and estate = "'.$_SESSION['estate'].'" and category = "Non Employee" ');
        $non = mysqli_num_rows($query);
        $this->SetFont('Arial','B',10);
        $this->Cell(175,5,'', 0,0,'L');
        $this->Cell(50,5,'Sub Total', 1,0,'L');
        $this->Cell(50,5,$non, 1,1,'L');
        $this->Ln(2);
         $query =mysqli_query($con,'select * from tblreport WHERE today = "'.$today.'" and estate = "'.$_SESSION['estate'].'" ');
        $grand = mysqli_num_rows($query);
        $this->SetFont('Arial','B',11);
        $this->Cell(175,7,'', 0,0,'L');
        $this->Cell(50,7,'Grand Total', 1,0,'L');
        $this->Cell(50,7,$grand, 1,0,'L');
        $this->Ln();
      }
      function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,5,'DMS - Powered by TeqnoCrats',0,0,'L');
        $this->SetFont('Arial','',8);
        $this->Cell(0,5,'Page'.$this->PageNo().'/{nb}',0,0,'R');
    }

        
    }
    

$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->viewSickness($conn);
$pdf->viewOnDuty($conn);
$pdf->viewOffDuty($conn);
$pdf->viewMch($conn);
$pdf->viewDep($conn);
$pdf->viewNon($conn);
$pdf->Output();
?>