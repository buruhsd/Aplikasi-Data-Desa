<?php
session_start();
define('FPDF_FONTPATH', 'fpdf/font/');
include "fpdf/fpdf.php";
date_default_timezone_set("Asia/Jakarta");
include "../library/koneksi.php";
include "../library/fungsi_library.php";
$id = $_GET['id'];

class PDF extends FPDF
{
  	function Header()
  	{
		//$this->Image('grobogan.jpg',2,0.4,1.5);
	
		//$this->SetFont('Times','B','10');
		//$this->Cell(19,0.4,'FORMULIR PERMOHONAN KARTU TANDA PENDUDUK (KTP) WARGA NEGARA INDONESIA',0,1,'C');
		//$this->SetFont('Times','B','12');
		//$this->Cell(19,0.4,'DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL',0,1,'C');
		//$this->SetFont('Times','','10');
		//$this->Cell(19,0.4,'Jln. Dr. Sutomo No.5 Telp. (0292) 421940 Purwodadi 58111 ',0,1,'C');
		//$this->Ln();
		//$this->Line(1,2.4,20,2.4);
		//$this->Line(1,2.32,20,2.32);
		
  	}
  	function Footer()
  	{	
   		 //$this->SetY(-2,8);
		//$this->Cell(0,1,$this->PageNo(),0,0,'C');
  	}
}
$pdf = new PDF('P','cm','A4');
// $pdf->SetMargins(0.4,0.4,0.4);
   	$pdf->Open();
   	$pdf->AliasNbPages();
   	$pdf->AddPage();
	$pdf->SetXY(0,0.5);
	
	$data_ktp =mysql_query("SELECT
						tblpermohonanktp.no_pengajuan,
						tblpermohonanktp.NIK,
						tblpermohonanktp.Permohonan,
						tblpermohonanktp.tanda_tangan,
						tblpermohonanktp.NamaAparat,
						tblpenduduk.Jalan,
						tblpenduduk.NoKK,
						tblpenduduk.NamaLengkap,
						tblpenduduk.KodePos,
						tblpenduduk.KelurahanID,
						tblpenduduk.KecamatanID,
						tblpenduduk.KabupatenID,
						tblpenduduk.ProvinsiID,
						tblpenduduk.RW,
						tblpenduduk.RT
						FROM
						tblpermohonanktp
						LEFT JOIN tblpenduduk ON tblpenduduk.NoIdentitas = tblpermohonanktp.NIK WHERE tblpermohonanktp.NIK='$id'");
		$ktp 	= mysql_fetch_assoc($data_ktp);
		$prov=mysql_query("SELECT NamaProvinsi,ProvinsiID from tblprovinsi where ProvinsiID='$ktp[ProvinsiID]'");
		$p=mysql_fetch_array($prov);
		$kab=mysql_query("SELECT NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$ktp[KabupatenID]'");
		$b=mysql_fetch_array($kab);
		$kec=mysql_query("SELECT NamaKecamatan,KecamatanID from tblkecamatan where KecamatanID='$ktp[KecamatanID]'");
		$c=mysql_fetch_array($kec);
		$kel=mysql_query("SELECT NamaKelurahan,KelurahanID from tblkelurahan where KelurahanID='$ktp[KelurahanID]'");
		$l=mysql_fetch_array($kel);

	$aktifitas="User $_SESSION[username] Melakukan Cetak Data Permohonan KTP $ktp[NamaLengkap] Nomer $ktp[NIK]";
				include"../key_log.php";

	$pdf->SetFont('Times','B','10');
	$pdf->Cell(15,0.4,'',0,0,'C');
	$pdf->Cell(2,0.4,'F-1.21',1,1,'C'); //data $ktp['no_pengajuan']
	$pdf->Cell(19,0.1,'',0,1,'C');
	$pdf->SetFont('Times','B','10');
	$pdf->Cell(19,0.4,'FORMULIR PERMOHONAN KARTU TANDA PENDUDUK (KTP) WARGA NEGARA INDONESIA',0,1,'C');
	$pdf->SetFont('Times','','9');
	$pdf->Cell(19,0.4,'Perhatian :','TLR',1,'L');
	$pdf->Cell(19,0.4,'1. Harap dengan huruf cetak dan menggunakan tinta hitam;','LR',1,'L');
	$pdf->Cell(19,0.4,'2. Untuk kolom pilihan, harap memberi tanda (x) pada kotak pilihan;','LR',1,'L');
	$pdf->Cell(19,0.4,'3. Setelah formulir ini diisi dan ditandatangani, harap diserahkan kembali ke kantor Desa/Kelurahan;','BLR',1,'L');
	$pdf->Cell(19,0.1,'',0,1,'C');
	$pdf->Cell(7,0.4,'PEMERINTAH PROVINSI',0,0,'L');
	$pdf->Cell(3,0.4,$p['ProvinsiID'],1,0,'L'); //Data
	$pdf->Cell(1.5,0.4,'',0,0,'L');
	$pdf->Cell(7.5,0.4,$p['NamaProvinsi'],1,1,'L'); //Data
	
	$pdf->Cell(7,0.4,'KABUPATEN / KOTA',0,0,'L');
	$pdf->Cell(3,0.4,$b['KabKotaID'],1,0,'L'); //Data
	$pdf->Cell(1.5,0.4,'',0,0,'L');
	$pdf->Cell(7.5,0.4,$b['NamaKabKota'],1,1,'L'); //data
	
	$pdf->Cell(7,0.4,'KECAMATAN',0,0,'L');
	$pdf->Cell(3,0.4,$c['KecamatanID'],1,0,'L'); //Data
	$pdf->Cell(1.5,0.4,'',0,0,'L');
	$pdf->Cell(7.5,0.4,$c['NamaKecamatan'],1,1,'L'); //data
	
	$pdf->Cell(7,0.4,'KELURAHAN / DESA',0,0,'L');
	$pdf->Cell(3,0.4,$l['KelurahanID'],1,0,'L'); //Data
	$pdf->Cell(1.5,0.4,'',0,0,'L');
	$pdf->Cell(7.5,0.4,$l['NamaKelurahan'],1,1,'L');
	
	$pdf->Cell(19,0.1,'',0,1,'L');
	$pdf->Cell(6,0.4,'PERMOHONAN KTP',0,0,'L');
	  if ($ktp['Permohonan']=='Baru'){
	$pdf->Cell(0.75,0.4,'X',1,0,'L'); //data
	$pdf->Cell(3,0.4,'A.Baru',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(4,0.4,'B.Perpanjangan',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(3.4,0.4,'C.Pergantian',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,1,'L'); 
	$pdf->Cell(0.3,0.1,'',0,1,'L'); 
	}
	elseif($ktp['Permohonan']=='Perpanjangan'){
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(3,0.4,'A.Baru',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'X',1,0,'L'); //data
	$pdf->Cell(4,0.4,'B.Perpanjangan',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(3.4,0.4,'C.Pergantian',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,1,'L'); 
	$pdf->Cell(0.3,0.1,'',0,1,'L'); 
	}
	else{
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(3,0.4,'A.Baru',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(4,0.4,'B.Perpanjangan',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'X',1,0,'L'); //data
	$pdf->Cell(3.4,0.4,'C.Pergantian',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,1,'L'); 
	$pdf->Cell(0.3,0.1,'',0,1,'L'); 
	}
	
	$pdf->Cell(4,0.4,'1. Nama Lengkap',1,0,'L');
	$pdf->Cell(0.75,0.4,'',0,0,'L'); 
	$pdf->Cell(14.25,0.4,strtoupper($ktp['NamaLengkap']),1,1,'L'); //data
	$pdf->Cell(0.2,0.1,'',0,1,'L'); 
	
	$pdf->Cell(4,0.4,'2. No. KK',1,0,'L');
	$pdf->Cell(0.75,0.4,'',0,0,'L'); 
	$pdf->Cell(9,0.4,$ktp['NoKK'],1,1,'L'); //data
	$pdf->Cell(0.2,0.1,'',0,1,'L'); 
	
	$pdf->Cell(4,0.4,'3. NIK',1,0,'L');
	$pdf->Cell(0.75,0.4,'',0,0,'L'); 
	$pdf->Cell(14.25,0.4,$ktp['NIK'],1,1,'L'); //data
	$pdf->Cell(0.2,0.1,'',0,1,'L'); 
	
	$pdf->Cell(4,0.4,'4. Alamat',1,0,'L');
	$pdf->Cell(0.75,0.4,'',0,0,'L'); 
	$pdf->Cell(14.25,0.4,$ktp['Jalan'],1,1,'L'); //data
	$pdf->Cell(0.2,0.1,'',0,1,'L'); 
	
	
	$pdf->Cell(4.75,0.4,'',0,0,'L');
	$pdf->Cell(1,0.4,'RT',1,0,'L'); 
	$pdf->Cell(0.2,0.4,'',0,0,'L'); 
	$pdf->Cell(1.5,0.4,$ktp['RT'],1,0,'L'); //Data 
	$pdf->Cell(0.4,0.4,'',0,0,'L'); 
	
	$pdf->Cell(1,0.4,'RW',1,0,'L'); 
	$pdf->Cell(0.2,0.4,'',0,0,'L'); 
	$pdf->Cell(1.5,0.4,$ktp['RW'],1,0,'L'); //Data 
	$pdf->Cell(0.4,0.4,'',0,0,'L'); 
	
	$pdf->Cell(2,0.4,'Kode Pos',1,0,'L'); 
	$pdf->Cell(0.2,0.4,'',0,0,'L'); 
	$pdf->Cell(3,0.4,$ktp['KodePos'],1,1,'L'); //Data 
	$pdf->Cell(19,0.1,'',0,1,'C');
	
	$kelurahan =mysql_query("SELECT KelurahanID,NamaKelurahan FROM tblkelurahan where KelurahanID='$_SESSION[kelurahan]'");
	$kl 		=mysql_fetch_array($kelurahan);
	$tanggal=tgl_indo(date("Y m d"));
	
	$pdf->SetFont('Times','','9');
	$pdf->Cell(3,0.4,'Pas Photo(2X3)',1,0,'L');
	$pdf->Cell(3,0.4,'Cap Jempol',1,0,'L');
	$pdf->Cell(4.5,0.4,'Specimen Tanda Tangan',1,0,'L');
	$pdf->Cell(3,0.4,'',0,0,'L');
	$pdf->Cell(5.5,0.4,$kl['NamaKelurahan'].', '.$tanggal,0,1,'L');

	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(4.5,0.4,'','LR',0,'L');
	$pdf->Cell(2.5,0.4,'',0,0,'L');
	$pdf->Cell(5.5,0.4,'Pemohon',0,1,'C');
	
	
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(4.5,0.4,'','LR',1,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(4.5,0.4,'','LR',1,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(4.5,0.4,'','BLR',0,'L');
	$pdf->Cell(2.5,0.4,'',0,0,'L');
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(5.5,0.4,'',0,1,'C'); //data
	$pdf->Cell(3,0.4,'','BLR',0,'L');
	$pdf->Cell(3,0.4,'','BLR',0,'L');
	$pdf->SetFont('Times','','10');
	$pdf->Cell(4.5,0.4,'Ket.Cap Jempol/Tanda Tangan',0,0,'L');
	$pdf->Cell(2.5,0.4,'',0,0,'L');
	$pdf->SetFont('Times','BU','10');
	$pdf->Cell(5.5,0.4,strtoupper($ktp['NamaLengkap']),0,1,'C'); //data
	$pdf->Cell(2.5,0.4,'',0,0,'L');
	$pdf->Cell(5.5,0.4,'',0,1,'C');
	
	$kepaladesa = mysql_query("SELECT id_pejabat,nip,nama_pejabat,jabatan FROM tblpejabat where jabatan='$ktp[tanda_tangan]'");
	$kpl 		= mysql_fetch_array($kepaladesa);
	
	$pdf->SetFont('Times','','9');
	$pdf->Cell(9,0.4,'',0,0,'L');
	$pdf->Cell(4.5,0.4,'Mengetahui,',0,1,'C');
	$pdf->Cell(3,0.4,'',0,0,'L');
	$pdf->Cell(9.5,0.4,'CAMAT '.strtoupper($kl['NamaKelurahan']),0,0,'C');
	$pdf->Cell(6.5,0.4,strtoupper($ktp['tanda_tangan']).' '.strtoupper($kl['NamaKelurahan']),0,1,'C'); 
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(9,0.4,'',0,0,'L');
	$pdf->Cell(4.5,0.4,'',0,1,'C');
	$pdf->Cell(3,0.4,'',0,0,'L');
	$pdf->Cell(9.5,0.4,'_____________________________',0,0,'C');
	$pdf->Cell(6.5,0.4,strtoupper($kpl['nama_pejabat']),0,1,'C');
	
	$pdf->Cell(13,0.1,'',0,1,'L');
	$pdf->SetFont('Times','','9');
	$pdf->Cell(5,0.4,'',0,0,'L');
	$pdf->Cell(7.3,0.4,'NPD.',0,0,'L');
	$pdf->Cell(6.5,0.4,'NPD. '.$kpl['nip'],0,1,'C');
	$pdf->Cell(19,0.2,'',0,1,'C');

	$pdf->Cell(19,0.1,'Gunting disini',0,1,'C');
	$pdf->Cell(19,0.2,'','T',1,'C');
	
	$pdf->SetFont('Times','B','10');
	$pdf->Cell(15,0.4,'',0,0,'C');
	$pdf->Cell(2,0.4,'F-1.21',1,1,'C'); //data $ktp['no_pengajuan']
	$pdf->Cell(19,0.1,'',0,1,'C');
	$pdf->SetFont('Times','B','10');
	$pdf->Cell(19,0.4,'FORMULIR PERMOHONAN KARTU TANDA PENDUDUK (KTP) WARGA NEGARA INDONESIA',0,1,'C');
	$pdf->SetFont('Times','','9');
	$pdf->Cell(19,0.4,'Perhatian :','TLR',1,'L');
	$pdf->Cell(19,0.4,'1. Harap dengan huruf cetak dan menggunakan tinta hitam;','LR',1,'L');
	$pdf->Cell(19,0.4,'2. Untuk kolom pilihan, harap memberi tanda (x) pada kotak pilihan;','LR',1,'L');
	$pdf->Cell(19,0.4,'3. Setelah formulir ini diisi dan ditandatangani, harap diserahkan kembali ke kantor Desa/Kelurahan;','BLR',1,'L');
	$pdf->Cell(19,0.2,'',0,1,'C');
	$pdf->Cell(7,0.4,'PEMERINTAH PROVINSI',0,0,'L');
	$pdf->Cell(3,0.4,$p['ProvinsiID'],1,0,'L'); //Data
	$pdf->Cell(1.5,0.4,'',0,0,'L');
	$pdf->Cell(7.5,0.4,$p['NamaProvinsi'],1,1,'L'); //Data
	
	$pdf->Cell(7,0.4,'KABUPATEN / KOTA',0,0,'L');
	$pdf->Cell(3,0.4,$b['KabKotaID'],1,0,'L'); //Data
	$pdf->Cell(1.5,0.4,'',0,0,'L');
	$pdf->Cell(7.5,0.4,$b['NamaKabKota'],1,1,'L'); //data
	
	$pdf->Cell(7,0.4,'KECAMATAN',0,0,'L');
	$pdf->Cell(3,0.4,$c['KecamatanID'],1,0,'L'); //Data
	$pdf->Cell(1.5,0.4,'',0,0,'L');
	$pdf->Cell(7.5,0.4,$c['NamaKecamatan'],1,1,'L'); //data
	
	$pdf->Cell(7,0.4,'KELURAHAN / DESA',0,0,'L');
	$pdf->Cell(3,0.4,$l['KelurahanID'],1,0,'L'); //Data
	$pdf->Cell(1.5,0.4,'',0,0,'L');
	$pdf->Cell(7.5,0.4,$l['NamaKelurahan'],1,1,'L');
	
	$pdf->Cell(19,0.1,'',0,1,'L');
	$pdf->Cell(6,0.4,'PERMOHONAN KTP',0,0,'L');
	  if ($ktp['Permohonan']=='Baru'){
	$pdf->Cell(0.75,0.4,'X',1,0,'L'); //data
	$pdf->Cell(3,0.4,'A.Baru',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(4,0.4,'B.Perpanjangan',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(3.4,0.4,'C.Pergantian',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,1,'L'); 
	$pdf->Cell(0.3,0.1,'',0,1,'L'); 
	}
	elseif($ktp['Permohonan']=='Perpanjangan'){
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(3,0.4,'A.Baru',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'X',1,0,'L'); //data
	$pdf->Cell(4,0.4,'B.Perpanjangan',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(3.4,0.4,'C.Pergantian',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,1,'L'); 
	$pdf->Cell(0.3,0.1,'',0,1,'L'); 
	}
	else{
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(3,0.4,'A.Baru',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'',1,0,'L'); //data
	$pdf->Cell(4,0.4,'B.Perpanjangan',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,0,'L'); //data
	
	$pdf->Cell(0.75,0.4,'X',1,0,'L'); //data
	$pdf->Cell(3.4,0.4,'C.Pergantian',1,0,'C'); //data
	$pdf->Cell(0.2,0.4,'',0,1,'L'); 
	$pdf->Cell(0.3,0.1,'',0,1,'L'); 
	}
	
	$pdf->Cell(4,0.4,'1. Nama Lengkap',1,0,'L');
	$pdf->Cell(0.75,0.4,'',0,0,'L'); 
	$pdf->Cell(14.25,0.4,strtoupper($ktp['NamaLengkap']),1,1,'L'); //data
	$pdf->Cell(0.2,0.1,'',0,1,'L'); 
	
	$pdf->Cell(4,0.4,'2. No. KK',1,0,'L');
	$pdf->Cell(0.75,0.4,'',0,0,'L'); 
	$pdf->Cell(9,0.4,$ktp['NoKK'],1,1,'L'); //data
	$pdf->Cell(0.2,0.1,'',0,1,'L'); 
	
	$pdf->Cell(4,0.4,'3. NIK',1,0,'L');
	$pdf->Cell(0.75,0.4,'',0,0,'L'); 
	$pdf->Cell(14.25,0.4,$ktp['NIK'],1,1,'L'); //data
	$pdf->Cell(0.2,0.1,'',0,1,'L'); 
	
	$pdf->Cell(4,0.4,'4. Alamat',1,0,'L');
	$pdf->Cell(0.75,0.4,'',0,0,'L'); 
	$pdf->Cell(14.25,0.4,$ktp['Jalan'],1,1,'L'); //data
	$pdf->Cell(0.2,0.1,'',0,1,'L'); 
	
	
	$pdf->Cell(4.75,0.4,'',0,0,'L');
	$pdf->Cell(1,0.4,'RT',1,0,'L'); 
	$pdf->Cell(0.2,0.4,'',0,0,'L'); 
	$pdf->Cell(1.5,0.4,$ktp['RT'],1,0,'L'); //Data 
	$pdf->Cell(0.4,0.4,'',0,0,'L'); 
	
	$pdf->Cell(1,0.4,'RW',1,0,'L'); 
	$pdf->Cell(0.2,0.4,'',0,0,'L'); 
	$pdf->Cell(1.5,0.4,$ktp['RW'],1,0,'L'); //Data 
	$pdf->Cell(0.4,0.4,'',0,0,'L'); 
	
	$pdf->Cell(2,0.4,'Kode Pos',1,0,'L'); 
	$pdf->Cell(0.2,0.4,'',0,0,'L'); 
	$pdf->Cell(3,0.4,$ktp['KodePos'],1,1,'L'); //Data 
	$pdf->Cell(19,0.1,'',0,1,'C');
	
	$pdf->SetFont('Times','','9');
	$pdf->Cell(3,0.4,'Pas Photo(2X3)',1,0,'L');
	$pdf->Cell(3,0.4,'Cap Jempol',1,0,'L');
	$pdf->Cell(4.5,0.4,'Specimen Tanda Tangan',1,0,'L');
	$pdf->Cell(3,0.4,'',0,0,'L');
	$pdf->Cell(5.5,0.4,$kl['NamaKelurahan'].', '.$tanggal,0,1,'L');

	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(4.5,0.4,'','LR',0,'L');
	$pdf->Cell(2.5,0.4,'',0,0,'L');
	$pdf->Cell(5.5,0.4,'Pemohon',0,1,'C');
	
	
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(4.5,0.4,'','LR',1,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(4.5,0.4,'','LR',1,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(3,0.4,'','LR',0,'L');
	$pdf->Cell(4.5,0.4,'','BLR',0,'L');
	$pdf->Cell(2.5,0.4,'',0,0,'L');
	$pdf->SetFont('Times','BU','10');
	$pdf->Cell(5.5,0.4,'',0,1,'C'); //data
	$pdf->Cell(3,0.4,'','BLR',0,'L');
	$pdf->Cell(3,0.4,'','BLR',0,'L');
	$pdf->SetFont('Times','','9');
	$pdf->Cell(4.5,0.4,'Ket.Cap Jempol/Tanda Tangan',0,0,'L');
	$pdf->Cell(2.5,0.4,'',0,0,'L');
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(5.5,0.4,strtoupper($ktp['NamaLengkap']),0,1,'C'); //data
	$pdf->Cell(2.5,0.4,'',0,0,'L');
	$pdf->Cell(5.5,0.4,'',0,1,'C');
	
	$kepaladesa = mysql_query("SELECT id_pejabat,nip,nama_pejabat,jabatan FROM tblpejabat where jabatan='$ktp[tanda_tangan]'");
	$kpl 		= mysql_fetch_array($kepaladesa);
	
	$pdf->SetFont('Times','','9');
	$pdf->Cell(9,0.4,'',0,0,'L');
	$pdf->Cell(4.5,0.4,'Mengetahui,',0,1,'C');
	$pdf->Cell(3,0.4,'',0,0,'L');
	$pdf->Cell(9.5,0.4,'CAMAT '.strtoupper($kl['NamaKelurahan']),0,0,'C');
	$pdf->Cell(6.5,0.4,strtoupper($ktp['tanda_tangan']).' '.strtoupper($kl['NamaKelurahan']),0,1,'C'); 
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(9,0.4,'',0,0,'L');
	$pdf->Cell(4.5,0.4,'',0,1,'C');
	$pdf->Cell(3,0.4,'',0,0,'L');
	$pdf->Cell(9.5,0.4,'_____________________________',0,0,'C');
	$pdf->Cell(6.5,0.4,strtoupper($kpl['nama_pejabat']),0,1,'C');
	
	$pdf->Cell(13,0.2,'',0,1,'L');
	$pdf->SetFont('Times','','9');
	$pdf->Cell(5,0.4,'',0,0,'L');
	$pdf->Cell(7.3,0.4,'NPD.',0,0,'L');
	$pdf->Cell(6.5,0.4,'NPD. '.$kpl['nip'],0,1,'C');
	$pdf->output("Surat Permohonan KTP","I");
	
?>