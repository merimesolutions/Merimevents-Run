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

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$kr = mysqli_query($con, "UPDATE tblquotation SET inv = 1 where identitty='".$_GET['id']."'");
            if ($kr == true) {
                // echo '<script>alert("Invoice successfully created")</script>';
             
class myPDF extends FPDF{
    function hd($con){
        $date=date("Y-m-d h:i:sa");
        $img=mysqli_query($con,'SELECT * FROM tblstaff WHERE company = "'.$_SESSION['company'].'"  ');
        if($img){
            while ($ron =mysqli_fetch_assoc($img)){
                $vat  = $ron['vat'];
                if($ron['profile_img']!=''){
                    $i = $ron['profile_img'];
                }else{
                //    $i = "8f64ad76980a7e3b35d084a6d67c96c5.jpg";
                // $i = "logo.png"; 
                }
            }
        }
       
        $this->Image('../logos/'.$i,10,5,20);
        $this->SetFont('Arial','',10);
        $date=date("Y-m-d h:i:sa");
         $c =mysqli_query($con,"SELECT * FROM tblstaff WHERE company='".$_SESSION['company']."'  ");
                while($r =mysqli_fetch_assoc($c)){
                    $this->Image('../logos/'.$r['profile_img'],10,5,20);
        $this->Cell(190,5,ucwords($r['companyname']),0,1,'C');
		$this->Cell(190,7,ucwords($r['location']),0,1,'C');
        $this->Cell(190,7,$r['email'],0,1,'C');
        $this->Cell(190,7,$r['contact'],0,1,'C');
        $this->SetFont('Arial','BU',13);
        $sq =mysqli_query($con,"SELECT * FROM tblquotation WHERE identitty='".$_GET['id']."'");
                     while($re =mysqli_fetch_assoc($sq)){
                          $quote=$re['qoutation_title'];
                     
        $this->Cell(190,7,'INVOICE : '.strtoupper($quote),0,0,'C');
    }
        $this->SetFont('Arial','B',9);
        $this->Ln(5);
        $this->SetFont('Arial','B',11);
        $this->Cell(50,7,'Items', 0,1,'L');
        $this->SetFont('Arial','B',10);
		$this->Cell(10,7,'No.', 1,0,'L');
        $this->Cell(55,7,'Item', 1,0,'L');
        $this->Cell(40,7,'Item description', 1,0,'L');
        $this->Cell(15,7,'Qty', 1,0,'L');
        $this->Cell(25,7,'Unit price', 1,0,'C');
        $this->Cell(13,7,'Days', 1,0,'L');
        $this->Cell(30,7,'Total', 1,0,'C');
        $this->Ln();
                                                         }
    }
    

        function viewTable($con){
            $c=1;
            $task=0;
            $date=date("Y-m-d");
            $sqwe =mysqli_query($con,"SELECT SUM(total_amount) AS total FROM tblquotation WHERE identitty='".$_GET['id']."'");
            while($remmy =mysqli_fetch_assoc($sqwe)){
                $total_items_cost=$remmy['total'];
            }
            
            $query  = "SELECT * FROM tblquotation WHERE identitty='".$_GET['id']."' ";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result))
            { 
                $item_name =$row['item_name'];
                // $item_id =$row['event_item'];
                $this->SetFont('Arial','',9);
                $this->Cell(10,6,$c++, 1,0,'L');
                $this->Cell(55,6,ucwords($item_name), 1,0,'L');
                $this->Cell(40,6,ucwords($row['description']), 1,0,'L');
                $this->Cell(15,6,ucwords($row['quantity']), 1,0,'L');
                $this->Cell(25,6,number_format($row['unit_price'],1), 1,0,'R');
                $this->Cell(13,6,ucwords($row['no_days']), 1,0,'C');
                $this->Cell(30,6,number_format($row['total_amount'],1), 1,0,'R');
                $this->Ln();
            }
      
            $this->Cell(10,6,'', 0,0,'L');
            $this->Cell(65,6,'', 0,0,'L');
            $this->SetFont('Arial','B',9);
            $this->Cell(70,6,'Total cost:', 0,0,'R');
            $gtotal= $total_items_cost;
            $this->Cell(43,7,number_format($gtotal,1), 0,1,'R');
            $this->Ln(7);  

            $this->SetFont('Arial','',9);
            $this->Cell(54,8,'Accepted by:', 0,0,'L');
            $this->Cell(60,8,'..................................................................  ', 0,0,'L');
            $this->Cell(25,8,'  Signature', 0,0,'L');
            $this->Cell(60,8,'....................................', 0,1,'L');

            $cc =mysqli_query($con,"SELECT * FROM tblstaff WHERE company='".$_SESSION['company']."'  ");
            while($rr =mysqli_fetch_assoc($cc)){
                $this->Cell(54,8,ucwords($rr['companyname']) .' :',0,0,'L');
            }
            $this->Cell(60,8,'..................................................................  ', 0,0,'L');
            $this->Cell(25,8,'  Signature', 0,0,'L');
            $this->Cell(60,8,'....................................', 0,1,'L'); 
        }
        function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','',10);
            $this->Cell(0,5,$date=date("h:i:sa d-m-Y").' Served by '.ucwords($_SESSION['username']),0,0,'L');
            $this->SetFont('Arial','',10);
            $this->Cell(0,5,'Page'.$this->PageNo().'/{nb}',0,0,'R');
        }   
    }
    
}
else {
    $error = mysqli_error($con);
    echo '<script>alert("An error occured during invoice creation : ' . "$error" . '");"</script>';
}
$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('','A4',0);
$pdf->hd($con);
$pdf->viewTable($con);
$pdf->Output();

header("Location: quotation-list.php"); 



?>