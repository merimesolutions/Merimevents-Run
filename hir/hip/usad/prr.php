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
        $this->Cell(290,7,'Task assigments',0,1,'C');
        
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
        $this->Cell(45,6,'Project', 1,0,'L');
        $this->Cell(19,6,'Started', 1,0,'L');
        $this->Cell(19,6,'Deadline', 1,0,'L');
        $this->Cell(20,6,'Status', 1,0,'L');
        $this->Cell(164,6,'Tasks', 1,1,'C');
        $c=1;
        $task=0;
        $date=date("Y-m-d");
        $query  = "SELECT tblprojects.id, tblprojects.project,tblprojects.description, tblprojects.deadline,tblprojects.started,tblprojects.status
            FROM 
            tblprojects
            where company='".$_SESSION['company']."'
            ORDER BY id desc";
        $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result))
              {

        $this->SetFont('Arial','',9);
        $this->Cell(12,5,$c, 1,0,'L');
        $this->Cell(45,5,ucwords($row['project']), 1,0,'L');
        $this->Cell(19,5,ucwords($row['started']), 1,0,'L');
        $this->Cell(19,5,$row['deadline'], 1,0,'L');
        $this->Cell(20,5,ucwords($row['status']), 1,0,'L');
        
        $this->SetFont('Arial','B',9);
        $this->Cell(50,5,'Task', 1,0,'L');
        $this->Cell(25,5,'Date assigned', 1,0,'L');
        $this->Cell(19,5,'Deadline', 1,0,'L');
        $this->Cell(50,5,'Person in charge', 1,0,'L');
        $this->Cell(20,5,'Status', 1,1,'L');
        $p=ucwords($row['id']);  
                        $q  = "SELECT tblongoing_tasks.id, tblongoing_tasks.task,tblongoing_tasks.user,tblongoing_tasks.deadline,tblongoing_tasks.date_assigned,tblongoing_tasks.percentage,tblongoing_tasks.proj
                        FROM tblongoing_tasks where tblongoing_tasks.proj = '".$p."'
                        ORDER BY id desc";
        $r = mysqli_query($con, $q);
                            while($rows = mysqli_fetch_array($r))
                                                  { 
                                            $per = $rows['percentage'];
                                            $d = $rows['deadline'];
                                            if($per<100)
                                            {
                                                $status = "Incomplete";
                                            }
                                            elseif($per>=100)
                                            {
                                                $status = "Completed";
                                            }
        $this->SetFont('Arial','',9);
        $this->Cell(115,5,'', 0,0,'L');
        $this->Cell(50,5,ucwords($rows['task']), 1,0,'L');
        $this->Cell(25,5,ucwords($rows['date_assigned']), 1,0,'L');
        $this->Cell(19,5,$rows['deadline'], 1,0,'L');
        $this->Cell(50,5,ucwords($rows['user']), 1,0,'L');
        $this->Cell(20,5,$status, 1,1,'L');
        
        $c++;
        
        
          }
          $this->Ln(2);
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