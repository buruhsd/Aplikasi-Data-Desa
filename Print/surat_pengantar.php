<?php
session_start();
define('FPDF_FONTPATH', 'fpdf/font/');
include "fpdf/fpdf.php";
//include "fpdf/dash.php";
date_default_timezone_set("Asia/Jakarta");
include "../library/koneksi.php";
include "../library/fungsi_library.php";
$id = $_GET['id'];

class PDF extends FPDF
{
	function Header()
  	{
		$this->Image('../img/grobogan.jpg',1,0.7,2.1);
	
		$this->SetFont('Times','B','12');
		$this->Cell(2,0.5,'',0,0,'L');
		$this->Cell(10,0.5,'PEMERINTAH KABUPATEN GROBOGAN',0,0,'C');
		$this->Cell(4,0.5,'',0,0,'L');
		$this->Image('../img/grobogan.jpg',15,0.7,2.1);
		$this->Cell(10,0.5,'PEMERINTAH KABUPATEN GROBOGAN',0,0,'C');
		$this->Ln();
		
		$this->Cell(2,0.5,'',0,0,'L');
		$this->Cell(10,0.5,'KECAMATAN GROBOGAN',0,0,'C');
		$this->Cell(4,0.5,'',0,0,'L');
		$this->Cell(10,0.5,'KECAMATAN GROBOGAN',0,0,'C');
		$this->Ln();
		
		$this->Cell(2,0.5,'',0,0,'L');
		$this->Cell(10,0.5,'DESA GROBOGAN',0,0,'C');
		$this->Cell(4,0.5,'',0,0,'L');
		$this->Cell(10,0.5,'DESA GROBOGAN',0,0,'C');
		$this->Ln();
		
		$this->SetFont('Times','B','11');
		$this->Cell(2,0.5,'',0,0,'L');
		$this->Cell(10,0.5,'Jalan Raya Godong Karangrayung Km 2 Kode Pos 58162 ',0,0,'C');
		$this->Cell(4,0.5,'',0,0,'L');
		$this->Cell(10,0.5,'Jalan Raya Godong Karangrayung Km 2 Kode Pos 58162 ',0,0,'C');
	
		$this->Line(1,3.45,14,3.45);
		$this->Line(1,3.4,14,3.4);
		
		$this->Line(29,3.45,15,3.45);
		$this->Line(29,3.4,15,3.4);
		
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
	$pdf->SetXY(1,3.5);
	$data_surat =mysql_query("SELECT
								tblskumum.id,
								tblskumum.no_surat,
								tblskumum.tanggal,
								tblskumum.tanggal_awal,
								tblskumum.tanggal_akhir,
								tblskumum.nik,
								tblskumum.keperluan,
								tblskumum.keterangan_lain,
								tblskumum.KelurahanID,
								tblskumum.tanda_tangan,
								tblpenduduk.NoIdentitas,
								tblpenduduk.NamaLengkap,
								tblpenduduk.JenisKelamin,
								tblpenduduk.TempatLahir,
								tblpenduduk.TanggalLahir,
								tblpenduduk.Agama,
								tblpenduduk.Pekerjaan,
								tblpenduduk.Jalan,
								tblpenduduk.RT,
								tblpenduduk.RW,
								tblpenduduk.KabupatenID,
								tblpenduduk.ProvinsiID,
								tblpenduduk.KecamatanID,
								tblpenduduk.NoKK,	
								tblpenduduk.NegaraID,
								tblpenduduk.KartuID
								FROM
								tblskumum
								LEFT JOIN tblpenduduk ON tblskumum.nik = tblpenduduk.NoIdentitas
								where tblskumum.id='$id'");
	$dt 		= mysql_fetch_assoc($data_surat);
	$tempatlahir=mysql_query("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$dt[KabupatenID]'");
	$b			=mysql_fetch_array($tempatlahir);
	$negara 	= mysql_query("SELECT NegaraID,NamaNegara FROM tblnegara where NegaraID='$dt[NegaraID]'");
	$ngr		=mysql_fetch_array($negara);
	$agama 		= mysql_query("SELECT AgamaID,NamaAgama FROM tblagama where AgamaID='$dt[Agama]'");
	$agm		=mysql_fetch_array($agama);
	$kerja 		= mysql_query("SELECT NamaPekerjaan,PekerjaanID FROM tblpekerjaan where PekerjaanID='$dt[Pekerjaan]'");
	$krj		=mysql_fetch_array($kerja);
	$prov		=mysql_query("SELECT NamaProvinsi,ProvinsiID from tblprovinsi where ProvinsiID='$dt[ProvinsiID]'");
	$p			=mysql_fetch_array($prov);
	$kab		=mysql_query("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$dt[KabupatenID]'");
	$kb			=mysql_fetch_array($kab);
	
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(1.7,0.5,'Kode Desa : ',0,0,'L');
	$pdf->Cell(5.3,0.5,$_SESSION['kelurahan'],0,0,'L'); //Kode Desa
	$pdf->Cell(6,0.5,'Simpendes',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.7,0.5,'Kode Desa : ',0,0,'L');
	$pdf->Cell(5.3,0.5,$_SESSION['kelurahan'],0,0,'L'); //Kode Desa
	$pdf->Cell(6,0.5,'Simpendes',0,0,'R');
	$pdf->Cell(1,0.5,'',0,1,'L');
	
	$pdf->Cell(6,1,'SURAT',0,0,'R');
	$pdf->Cell(3,0.5,'K E T E R A N G A N','B',0,'L');
	$pdf->Cell(4,0.5,'',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6,1,'SURAT',0,0,'R');
	$pdf->Cell(3,0.5,'K E T E R A N G A N','B',1,'L');
	
	$pdf->Cell(5,1,'',0,0,'R');
	$pdf->Cell(4,0.5,'P E N G A N T A R','B',0,'R');
	$pdf->Cell(4,0.5,'',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(5,1,'',0,0,'R');
	$pdf->Cell(4,0.5,'P E N G A N T A R','B',1,'R');
	
	$pdf->SetFont('Times','','9');
	$pdf->Cell(14,0.5,'Nomor :'.strtoupper($dt['no_surat']),0,0,'C');
	$pdf->Cell(14,0.5,'Nomor :'.strtoupper($dt['no_surat']),0,1,'C');
	
	$pdf->Cell(2,0.5,'',0,0,'L');
	$pdf->Cell(11,0.5,'Yang bertanda tangan di bawah ini menerangkan dengan sebenarnya bahwa:',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(2,0.5,'',0,0,'L');
	$pdf->Cell(11,0.5,'Yang bertanda tangan di bawah ini menerangkan dengan sebenarnya bahwa:',0,1,'L');
	
	$pdf->Cell(3,0.5,'Nama',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(7,0.5," ".strtoupper($dt['NamaLengkap']),0,0,'L'); //nama
	if ($dt['JenisKelamin']==0){
	$pdf->Cell(2,0.5,'Laki-laki',0,0,'L'); //jenis kelamin
	}else{
	$pdf->Cell(2,0.5,'Perempuan',0,0,'L'); //jenis kelamin
	}
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Nama',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(7,0.5," ".strtoupper($dt['NamaLengkap']),0,0,'L'); //nama
	if ($dt['JenisKelamin']==0){
	$pdf->Cell(2,0.5,'Laki-laki',0,1,'L'); //jenis kelamin
	}else{
	$pdf->Cell(2,0.5,'Perempuan',0,1,'L'); //jenis kelamin
	}
	
	$tgllahir= tgl_indo($dt['TanggalLahir']);
	$pdf->Cell(3,0.5,'Tempat/Tgl Lahir',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5,strtoupper($b['NamaKabKota'])." / ".$tgllahir,0,0,'L'); //Tempat/Tgl Lahir
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Tempat/Tgl Lahir',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5,strtoupper($b['NamaKabKota'])." / ".$tgllahir,0,1,'L'); //Tempat/Tgl Lahir
	
	$pdf->Cell(3,0.5,'Kewarganegaraan/Agama',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5," ".strtoupper($ngr['NamaNegara'])." /".strtoupper($agm['NamaAgama']),0,0,'L'); //Kewarganegaraan/Agama
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Kewarganegaraan/Agama',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5," ".strtoupper($ngr['NamaNegara'])." /".strtoupper($agm['NamaAgama']),0,1,'L'); //Kewarganegaraan/Agama
	
	$pdf->Cell(3,0.5,'Pekerjaan',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5," ".strtoupper($krj['NamaPekerjaan']),0,0,'L'); //Pekerjaan
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Pekerjaan',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5," ".strtoupper($krj['NamaPekerjaan']),0,1,'L'); //Pekerjaan
	
	$pdf->Cell(3,0.5,'Alamat',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5," ".ucwords($dt['Jalan'])." RT :".$dt['RT']." RW:".$dt['RW'],0,0,'L'); //Alamat
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Alamat',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5," ".ucwords($dt['Jalan'])." RT :".$dt['RT']." RW:".$dt['RW'],0,1,'L'); //Alamat
	
	$pdf->Cell(3,0.5,'Kabupaten',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(4.5,0.5,ucwords($kb['NamaKabKota']),0,0,'L'); //Kabupaten
	$pdf->Cell(1.5,0.5,'Provinsi :',0,0,'R');
	$pdf->Cell(3,0.5,ucwords($p['NamaProvinsi']),0,0,'L'); //Provinsi
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Kabupaten',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(4.5,0.5,ucwords($kb['NamaKabKota']),0,0,'L'); //Kabupaten
	$pdf->Cell(1.5,0.5,'Provinsi :',0,0,'R');
	$pdf->Cell(3,0.5,ucwords($p['NamaProvinsi']),0,1,'L'); //Provinsi
	
	$pdf->Cell(3,0.5,'Surat bukti diri',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	if ($dt['KartuID']==0){
	$pdf->Cell(4.5,0.5,"KTP.".$dt['NoIdentitas'],0,0,'L'); //Surat bukti diri
	}else{
	$pdf->Cell(4.5,0.5,"Passport.".$dt['NoIdentitas'],0,0,'L'); //Surat bukti diri
	}
	$pdf->Cell(1.5,0.5,'KK No : ',0,0,'R');
	$pdf->Cell(3,0.5,$dt['NoKK'],0,0,'L'); //KK NO
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Surat bukti diri',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	if ($dt['KartuID']==0){
	$pdf->Cell(4.5,0.5,"KTP.".$dt['NoIdentitas'],0,0,'L'); //Surat bukti diri
	}else{
	$pdf->Cell(4.5,0.5,"Passport.".$dt['NoIdentitas'],0,0,'L'); //Surat bukti diri
	}
	$pdf->Cell(1.5,0.5,'KK No : ',0,0,'R');
	$pdf->Cell(3,0.5,$dt['NoKK'],0,1,'L'); //KK NO
	
	$pdf->Cell(3,0.5,'Keperluan',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5,ucwords($dt['keperluan']), 0,0); //Multi Cell, 'J'Keperluan
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Keperluan',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5,ucwords($dt['keperluan']),0,1); //Keperluan
	
	$pdf->Cell(3,0.5,'Berlaku mulai',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(4,0.5,tgl_indo($dt['tanggal_awal']),0,0,'L'); //Berlaku mulai
	$pdf->Cell(1,0.5,'s.d.',0,0,'R');
	$pdf->Cell(4,0.5,tgl_indo($dt['tanggal_akhir']),0,0,'L'); //Berlaku mulai
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Berlaku mulai',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(4,0.5,tgl_indo($dt['tanggal_awal']),0,0,'L'); //Berlaku mulai
	$pdf->Cell(1,0.5,'s.d.',0,0,'R');
	$pdf->Cell(4,0.5,tgl_indo($dt['tanggal_akhir']),0,1,'L'); //Berlaku mulai
	
	$pdf->Cell(3,0.5,'Keterangan Lain',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5,ucwords($dt['keterangan_lain']), 0,0); //Multi Cell, 'J'Keperluan
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Keterangan Lain',0,0,'L');
	$pdf->Cell(1,0.5,':',0,0,'R');
	$pdf->Cell(9,0.5,ucwords($dt['keterangan_lain']),0,1); //Keperluan
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(2,0.5,'',0,0,'L');
	$pdf->Cell(11,0.5,'Demikian untuk menjadikan maklum bagi yang berkepentingan.',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(2,0.5,'',0,0,'L');
	$pdf->Cell(11,0.5,'Demikian untuk menjadikan maklum bagi yang berkepentingan.',0,1,'L');
	
	$pdf->Cell(4,0.5,'',0,0,'L');
	$pdf->Cell(1.5,0.5,'Nomor    : ',0,0,'L');
	$pdf->Cell(7.5,0.5,strtoupper($dt['no_surat']),0,0,'L'); //Nomor
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(4,0.5,'',0,0,'L');
	$pdf->Cell(1.5,0.5,'Nomor    : ',0,0,'L');
	$pdf->Cell(7.5,0.5,strtoupper($dt['no_surat']),0,1,'L');//Nomor
	
	$pdf->Cell(4,0.5,'',0,0,'L');
	$pdf->Cell(1.5,0.5,'Tanggal  : ',0,0,'L');
	$pdf->Cell(7.5,0.5,tgl_indo($dt['tanggal']),0,0,'L'); //Tanggal
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(4,0.5,'',0,0,'L');
	$pdf->Cell(1.5,0.5,'Tanggal  : ',0,0,'L'); 
	$pdf->Cell(7.5,0.5,tgl_indo($dt['tanggal']),0,1,'L');//Tanggal
	$pdf->Ln();
	
	$pdf->Cell(8,0.5,'Mengetahui',0,0,'R');
	$pdf->Cell(5,0.5,'Desa Kemloko,',0,0,'R'); //Desa
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(8,0.5,'Mengetahui',0,0,'R');
	$pdf->Cell(5,0.5,'Desa Kemloko,',0,1,'R'); //Desa
	
	$pdf->Cell(4,0.5,'Tanda Tangan Pemegang',0,0,'L');
	$pdf->Cell(2,0.5,'',0,0,'L');
	$pdf->Cell(3,0.5,'Camat Godong',0,0,'L');
	$pdf->Cell(2,0.5,'',0,0,'L');
	$pdf->Cell(2,0.5,'Kepala Desa',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(4,0.5,'Tanda Tangan Pemegang',0,0,'L');
	$pdf->Cell(2,0.5,'',0,0,'L');
	$pdf->Cell(3,0.5,'Camat Godong',0,0,'L');
	$pdf->Cell(2,0.5,'',0,0,'L');
	$pdf->Cell(2,0.5,'Kepala Desa',0,1,'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(4,0.5,strtoupper($dt['NamaLengkap']),'B',0,'C'); //ttd pemegang
	$pdf->Cell(2,0.5,'',0,0,'L');
	$pdf->Cell(3,0.5,'','B',0,'L'); //ttd Camat
	$pdf->Cell(2,0.5,'',0,0,'L'); 
	$pdf->Cell(2,0.5,'','B',0,'L'); //Kepala Desa
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(4,0.5,strtoupper($dt['NamaLengkap']),'B',0,'C'); //ttd pemegang
	$pdf->Cell(2,0.5,'',0,0,'L');
	$pdf->Cell(3,0.5,'','B',0,'L'); //ttd Camat
	$pdf->Cell(2,0.5,'',0,0,'L'); 
	$pdf->Cell(2,0.5,'','B',0,'L'); //Kepala Desa
	
	$pdf->Ln();
	$pdf->output("Surat Pengantar","I");
?>
		