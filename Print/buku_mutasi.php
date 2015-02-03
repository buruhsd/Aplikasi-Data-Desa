<?php
session_start();
define('FPDF_FONTPATH', 'fpdf/font/');
include "fpdf/fpdf.php";
//include "fpdf/dash.php";
date_default_timezone_set("Asia/Jakarta");

class PDF extends FPDF
{
	function Header()
  	{
		
		
		// $this->Image('grobogan.jpg',1,0.7,2.1);
		
		// $this->SetFont('Times','B','12');
		
		
		// $this->Cell(19,0.5,'PEMERINTAH KABUPATEN GROBOGAN',0,0,'C');
		// $this->Ln();
		// $this->Line(1,3.45,20,3.45);
		// $this->Line(1,3.4,20,3.4);
  	}
  
  	function Footer()
  	{	
   		// $this->SetY(-2,5);
		//$this->Cell(0,1,$this->PageNo(),0,0,'C');
  	}
}
$pdf = new PDF('L','cm','A4');
	// $pdf->SetMargins(0.5,0.5,0.5);
   	$pdf->Open();
   	$pdf->AliasNbPages();
   	$pdf->AddPage();
	$pdf->SetXY(1,1);
	
	$pdf->SetFont('Times','B','12');
	$pdf->Cell(29,0.5,'BUKU MUTASI PENDUDUK WNI (BMP)',0,1,'C');
	$pdf->Ln();
	$pdf->SetFont('Times','','10');
	$pdf->Cell(6,0.5,'No Urut :',0,0,'L');//data
	$pdf->Cell(6,0.5,'No KK :',0,0,'L');//data
	$pdf->Cell(7.5,0.5,'Kepala Keluarga:',0,0,'L');//data
	$pdf->Cell(8,0.5,'Alamat :',0,1,'L');//data
	$pdf->Ln();
	$pdf->SetFont('Times','','8');
	$pdf->Cell(1,0.5,'No','TLR',0,'C');
	$pdf->Cell(10,0.5,'Identitas Penduduk','TLR',0,'C');
	$pdf->Cell(1,0.5,'L/P','TLR',0,'C');
	$pdf->Cell(6,0.5,'Peristiwa Yang Menyebabkan','TLR',0,'C');
	$pdf->Cell(4.5,0.5,'Peristiwa Yang Menyebabkan','TLR',0,'C');
	$pdf->Cell(5,0.5,'Keterangan','TLR',1,'C');

	$pdf->Cell(1,0.5,'','LR',0,'C');
	$pdf->Cell(10,0.5,'','LR',0,'C');
	$pdf->Cell(1,0.5,'','BLR',0,'C');
	$pdf->Cell(6,0.5,'Perubahan Jumlah Jiwa','BLR',0,'C');
	$pdf->Cell(4.5,0.5,'Perubahan Jumlah Jiwa','BLR',0,'C');
	$pdf->Cell(5,0.5,'','LR',1,'C');

	$pdf->Cell(1,0.5,'','BLR',0,'C');
	$pdf->Cell(6,0.5,'Nama',1,0,'C');
	$pdf->Cell(4,0.5,'Nik/No.KTP',1,0,'C');
	$pdf->Cell(1,0.5,'','BLR',0,'C');

	$pdf->Cell(1.5,0.5,'Lahir',1,0,'C');
	$pdf->Cell(1.5,0.5,'Mati',1,0,'C');
	$pdf->Cell(1.5,0.5,'Datang',1,0,'C');
	$pdf->Cell(1.5,0.5,'Pindah',1,0,'C');

	$pdf->Cell(1.5,0.5,'Kawin',1,0,'C');
	$pdf->Cell(1.5,0.5,'Cerai',1,0,'C');
	$pdf->Cell(1.5,0.5,'Lainnya',1,0,'C');

	$pdf->Cell(2.5,0.5,'Tanggal',1,0,'C');
	$pdf->Cell(2.5,0.5,'No.Datang',1,1,'C');

	$pdf->Cell(1,0.5,'1',1,0,'C');
	$pdf->Cell(6,0.5,'2',1,0,'C');
	$pdf->Cell(4,0.5,'3',1,0,'C');
	$pdf->Cell(1,0.5,'4','BLR',0,'C');

	$pdf->Cell(1.5,0.5,'5',1,0,'C');
	$pdf->Cell(1.5,0.5,'6',1,0,'C');
	$pdf->Cell(1.5,0.5,'7',1,0,'C');
	$pdf->Cell(1.5,0.5,'8',1,0,'C');

	$pdf->Cell(1.5,0.5,'9',1,0,'C');
	$pdf->Cell(1.5,0.5,'10',1,0,'C');
	$pdf->Cell(1.5,0.5,'11',1,0,'C');

	$pdf->Cell(2.5,0.5,'12',1,0,'C');
	$pdf->Cell(2.5,0.5,'13',1,1,'C');

	$pdf->Cell(1,0.5,'1',1,0,'C');//data
	$pdf->Cell(6,0.5,'2',1,0,'C');//data
	$pdf->Cell(4,0.5,'3',1,0,'C');//data
	$pdf->Cell(1,0.5,'4','BLR',0,'C');//data

	$pdf->Cell(1.5,0.5,'5',1,0,'C');//data
	$pdf->Cell(1.5,0.5,'6',1,0,'C');//data
	$pdf->Cell(1.5,0.5,'7',1,0,'C');//data//data
	$pdf->Cell(1.5,0.5,'8',1,0,'C');//data

	$pdf->Cell(1.5,0.5,'9',1,0,'C');//data
	$pdf->Cell(1.5,0.5,'10',1,0,'C');//data
	$pdf->Cell(1.5,0.5,'11',1,0,'C');//data

	$pdf->Cell(2.5,0.5,'12',1,0,'C');//data
	$pdf->Cell(2.5,0.5,'13',1,1,'C');//data

	
	$pdf->Ln();
	$pdf->output("Buku Mutasi WNI","I");
?>
		
		