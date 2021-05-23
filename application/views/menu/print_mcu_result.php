<?php
require('design/pdf/fpdf.php');
//Connect to your database
include './design/koneksi/file.php';
$query 		="SELECT `reg_date`, `id_reg`, `pat_name`, `pat_dob`, `pat_pob`, `gender`, `pat_MRN`, `pat_name`, `title_desc`, `id_reg`, `mst_service_package_h`.`package_name`, `client_name`, `client_address1` FROM `pat_data` LEFT JOIN `mst_gender` ON `mst_gender`.`id_gender` = `pat_data`.`pat_gender` LEFT JOIN `mst_marital_status` ON `mst_marital_status`.`id_status` = `pat_data`.`pat_marital_status` INNER JOIN `trx_registration` ON `trx_registration`.`id_pat` = `pat_data`.`id_Pat` INNER JOIN `mst_title` ON `mst_title`.`id_title` = `pat_data`.`id_title` LEFT JOIN `mst_service_package_h` ON `mst_service_package_h`.`id_package` = `trx_registration`.`id_package` LEFT JOIN `mst_client` ON `mst_client`.`id_Client` = `trx_registration`.`id_client` WHERE `id_reg` = '116020002' ORDER BY `reg_date` DESC";  
$result 	=mysqli_query($con,$query);

class PDF extends FPDF
{

// Page header
function Header()
{
    // Logo
	$this->Image('design/images/logo.png',10,6,30);
    // Arial bold 15
    //$this->SetFont('Arial','B',12);
	$this->SetFont('Times','B',9);
	$this->Ln(10);
    // Move to the right
    $this->Cell(10);
    // Title
    $this->Cell(50,18,'Content',1,0,'C');
    $this->Cell(30,18,'Std.Value',1,0,'C');
    $this->Cell(60,8,'Date of Result',1,0,'C');
    $this->Cell(30,18,'Unit',1,0,'C');
	$this->Ln(10);
    // Line break
	$this->Cell(10); //geser ke kanan
    // Title
    $this->Cell(50,0,'',0,0,'C');// trik colspan
    $this->Cell(30,0,'',0,0,'C');// trik colspan	
    $this->Cell(20,8,'27-01-2016',1,0,'C',0);
    $this->Cell(20,8,'27-01-2015',1,0,'C',0);
    $this->Cell(20,8,'27-01-2014',1,0,'C',0);
    $this->Cell(30,0,'',0,0,'C');// trik colspan
	$this->Ln(8);
	
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,3,'Page '.$this->PageNo().' from {nb}',0,0,'C');
	$this->SetY(-10);// pergerakan ke kanan
	$this->Cell(0,3,'Date of print : '.date("d-m-Y"),0,1,'L');
	$this->Ln();
	$this->Cell(0,3,'By : Dudi Ramdani',0,1,'L');
}
}

// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times','',8);
while($row = mysqli_fetch_array($result))
{

	$pdf->Cell(10);	
	
	
	$gender = $row["gender"];
	$idreg = $row["id_reg"];
	$package_name = $row["package_name"];
    $name = substr($row["pat_name"],0,20);	
	$pdf->SetFont('Times','B',8);
	$pdf->Cell(170,6,$package_name,1,0,'L');
	$pdf->Ln();
	$pdf->SetFont('Times','',8);
	$pdf->Cell(10);
	$pdf->Cell(50,6,$name,1,0,'C');
    $pdf->Cell(30,6,'Std.Value',1,0,'C');
    $pdf->Cell(60,6,'Date of Result',1,0,'C');
    $pdf->Cell(30,6,'Unit',1,0,'C');
    $pdf->Ln(20);
}
$pdf->Output();
?>