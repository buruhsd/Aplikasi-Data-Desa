<?php
session_start();
include "../library/koneksi.php";
include "../library/fungsi_library.php";
define('FPDF_FONTPATH', 'fpdf/font/');
include "fpdf/fpdf.php";
//include "fpdf/dash.php";
date_default_timezone_set("Asia/Jakarta");

class PDF extends FPDF
{
	function Header()
  	{
		
		
		$this->Image('grobogan.jpg',1,0.7,2.1);
		
		$this->SetFont('Times','B','12');
		
		
		$this->Cell(19,0.5,'PEMERINTAH KABUPATEN GROBOGAN',0,0,'C');
		$this->Ln();
		$this->Cell(19,0.5,'KECAMATAN GODONG',0,0,'C');
		$this->Ln();
		$this->Cell(19,0.5,'DESA KEMLOKO',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','B','11');
		$this->Cell(19,0.5,'Jalan Raya Godong Karangrayung Km 2 Kode Pos 58162 ',0,0,'C');
	
		$this->Line(1,3.45,20,3.45);
		$this->Line(1,3.4,20,3.4);
  	}
  
  	function Footer()
  	{	
   		// $this->SetY(-2,5);
		//$this->Cell(0,1,$this->PageNo(),0,0,'C');
  	}
}
$pdf = new PDF('P','cm','A4');
	// $pdf->SetMargins(0.5,0.5,0.5);
   	$pdf->Open();
   	$pdf->AliasNbPages();
   	$pdf->AddPage();
	$pdf->SetXY(1,3.5);
	
	

	$pdf->SetFont('Times','I','10');
	$pdf->Cell(18,0.5,'Simpendes',0,1,'L');
	$pdf->SetFont('Times','B','10');
	$pdf->Cell(19,0.5,'SURAT KETERANGAN PINDAH WNI',0,1,'C');
	$pdf->SetFont('Times','B','10');
	$pdf->Cell(1,0.5,'',0,0,'L');
	$pdf->Cell(19,0.5,'DATA DAERAH ASAL',0,1,'L');

	$id = $_GET['id'];

	$data 	= mysql_query("SELECT * from tblpenduduk where id='$id'");
	$dt 	= mysql_fetch_array($data);

	$datakepala 	= mysql_query ("SELECT * from tblpenduduk where NoKK='$dt[NoKK]' AND UrutPosisiKK='0'");
	$dtk 	= mysql_fetch_array($datakepala);
	
	$pdf->SetFont('Times','','10');
	$pdf->Cell(5,0.5,'1. Nomor Kartu Keluarga',0,0,'L');
	$pdf->Cell(8,0.5,$dt['NoKK'],1,1,'L'); //data
	$pdf->Cell(19,0.1,'',0,1,'L'); 
	
	$pdf->Cell(5,0.5,'2. Nama Kepala Keluarga',0,0,'L');
	$pdf->Cell(14,0.5,strtoupper($dtk['NamaLengkap']),1,1,'L'); //data
	$pdf->Cell(19,0.1,'',0,1,'L'); 
	
	$pdf->Cell(5,0.5,'3. Alamat',0,0,'L');
	$pdf->Cell(8,0.5,$dt['JalanLama'],1,0,'L'); //data
	$pdf->Cell(1,0.5,'RT',0,0,'L');
	$pdf->Cell(2,0.5,$dt['RT'],1,0,'L'); //data
	$pdf->Cell(1,0.5,'RW',0,0,'L');
	$pdf->Cell(2,0.5,$dt['RW'],1,1,'L'); //data
	$pdf->Cell(19,0.1,'',0,1,'L');
	
	$kel=mysql_query("SELECT * from tblkelurahan where KelurahanID='$dt[KelurahanIDLama]'");
	$l=mysql_fetch_array($kel);
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(4.5,0.5,'a. Desa/Kelurahan',0,0,'L');
	$pdf->Cell(5,0.5,$l['NamaKelurahan'],1,0,'L'); //data

	$kab 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[KabupatenIDLama]'");
  	$kb 	= mysql_fetch_array($kab);
	$pdf->Cell(4,0.5,'b. Kab/Kota',0,0,'C');
	$pdf->Cell(5,0.5,$kb['NamaKabKota'],1,1,'L'); //data
	$pdf->Cell(19,0.1,'',0,1,'L');
	
	$kec=mysql_query("SELECT * from tblkecamatan where KecamatanID='$dt[KecamatanIDLama]'");
	$c=mysql_fetch_array($kec);
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(4.5,0.5,'c. Kecamatan',0,0,'L');
	$pdf->Cell(5,0.5,$c['NamaKecamatan'],1,0,'L'); //data

	$data_provinsi 	= mysql_query("SELECT * from tblprovinsi where ProvinsiID='$dt[ProvinsiIDLama]'");
	$dtprov 	 	= mysql_fetch_array($data_provinsi);
	$pdf->Cell(4,0.5,'d. Provinsi',0,0,'C');
	$pdf->Cell(5,0.5,$dtprov['NamaProvinsi'],1,1,'L'); //data
	$pdf->Cell(19,0.1,'',0,1,'L');
	
	$pdf->Cell(5,0.5,'',0,0,'L');
	$pdf->Cell(2,0.5,'Kode Pos',0,0,'L'); 
	$pdf->Cell(3,0.5,$dt['KodePosLama'],1,0,'L'); //data
	$pdf->Cell(4,0.5,'Telepon',0,0,'C'); 
	$pdf->Cell(5,0.5,$dt['NoTelp'],1,1,'L'); //data
	$pdf->Cell(19,0.1,'',0,1,'L');
	
	$pdf->SetFont('Times','B','10');
	$pdf->Cell(19,0.5,'DATA KEPINDAHAN',0,1,'L');
	
	$pdf->SetFont('Times','','10');
	$pdf->Cell(5,1,'1. Alasan Pindah',0,0,'L');
	$pdf->Cell(1,1,$dt['AlasanPindahID'],1,0,'C'); //data
	$pdf->Cell(2.5,0.5,'1. Pekerjaan',0,0,'L');
	$pdf->Cell(2.5,0.5,'3. Keamanan',0,0,'L');
	$pdf->Cell(2.5,0.5,'5. Perumahan',0,0,'L');
	$pdf->Cell(2.5,0.5,'7. Lainnya',0,1,'L');
	$pdf->Cell(6,0.5,'',0,0,'L');
	$pdf->Cell(2.5,0.5,'2. Pendidikan',0,0,'L');
	$pdf->Cell(2.5,0.5,'4. Kesehatan',0,0,'L');
	$pdf->Cell(2.5,0.5,'6. Keluarga',0,1,'L');
	$pdf->Cell(2.5,0.5,'',0,1,'R');
	
	$pdf->Cell(5,0.5,'2. Alamat Tujuan Pindah',0,0,'L');
	$pdf->Cell(8,0.5,$dt['Jalan'],1,0,'L'); //data
	$pdf->Cell(1,0.5,'RT',0,0,'L');
	$pdf->Cell(2,0.5,$dt['RT'],1,0,'L'); //data
	$pdf->Cell(1,0.5,'RW',0,0,'L');
	$pdf->Cell(2,0.5,$dt['RW'],1,1,'L'); //data
	$pdf->Cell(19,0.1,'',0,1,'L');
	
	$kel1=mysql_query("SELECT * from tblkelurahan where KelurahanID='$dt[KelurahanIDLama]'");
	$l1=mysql_fetch_array($kel1);
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(4.5,0.5,'a. Desa/Kelurahan',0,0,'L');
	$pdf->Cell(5,0.5,$l1['NamaKelurahan'],1,0,'L'); //data

	$kab1 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[KabupatenIDLama]'");
  	$kb1 	= mysql_fetch_array($kab1);
	$pdf->Cell(4,0.5,'b. Kab/Kota',0,0,'C');
	$pdf->Cell(5,0.5,$kb1['NamaKabKota'],1,1,'L'); //data
	$pdf->Cell(19,0.1,'',0,1,'L');
	
	$kec1=mysql_query("SELECT * from tblkecamatan where KecamatanID='$dt[KecamatanIDLama]'");
	$c1=mysql_fetch_array($kec1);
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(4.5,0.5,'c. Kecamatan',0,0,'L');
	$pdf->Cell(5,0.5,$c1['NamaKecamatan'],1,0,'L'); //data

	$data_provinsi1 	= mysql_query("SELECT * from tblprovinsi where ProvinsiID='$dt[ProvinsiIDLama]'");
	$dtprov1 	 	= mysql_fetch_array($data_provinsi1);
	$pdf->Cell(4,0.5,'d. Provinsi',0,0,'C');
	$pdf->Cell(5,0.5,$dtprov1['NamaProvinsi'],1,1,'L'); //data
	$pdf->Cell(19,0.1,'',0,1,'L');
	
	$pdf->Cell(5,0.5,'',0,0,'L');
	$pdf->Cell(2,0.5,'Kode Pos',0,0,'L'); 
	$pdf->Cell(3,0.5,$dt['KodePos'],1,0,'L'); //data
	$pdf->Cell(4,0.5,'Telepon',0,0,'C'); 
	$pdf->Cell(5,0.5,$dt['NoTelp'],1,1,'L'); //data
	$pdf->Cell(19,0.1,'',0,1,'L');
	
	$pdf->Cell(5,1,'3. Klasifikasi Pindah',0,0,'L');
	$pdf->Cell(1,1,$dt['KlasifikasiPindahID'],1,0,'C'); //data
	$pdf->Cell(5,0.5,'1. Dalam Satu Desa/Kelurahan',0,0,'L');
	$pdf->Cell(3.5,0.5,'3. Antar Kecamatan',0,0,'L');
	$pdf->Cell(2,0.5,'5. Antar Provinsi',0,1,'L');
	$pdf->Cell(6,0.5,'',0,0,'L');
	$pdf->Cell(5,0.5,'2. Antar Desa/Kelurahan',0,0,'L');
	$pdf->Cell(3.5,0.5,'4. Antar Kota/Kab',0,1,'L');
	$pdf->Cell(19,0.1,'',0,1,'R');
	
	$pdf->Cell(5,1,'4. Jenis Kepindahan',0,0,'L');
	$pdf->Cell(1,1,$dt['JenisKepindahanID'],1,0,'C'); //data
	$pdf->Cell(7,0.5,'1. Kepala Keluarga',0,0,'L');
	$pdf->Cell(6,0.5,'3. Kepala Keluarga dan Sbg Angg. Keluarga',0,1,'L');
	$pdf->Cell(6,0.5,'',0,0,'L');
	$pdf->Cell(7,0.5,'2. Kepala Keluarga dan Seluruh Angg. Keluarga',0,0,'L');
	$pdf->Cell(6,0.5,'4. Angg. Keluarga',0,1,'L');
	$pdf->Cell(19,0.1,'',0,1,'R');
	
	$pdf->Cell(5,0.5,'5. Status Nomor KK',0,0,'L');
	$pdf->Cell(1,1,$dt['kk_tidak_pindah'],1,0,'C'); //data
	$pdf->Cell(3.5,0.5,'1. Numpang KK',0,0,'L');
	$pdf->Cell(9,0.5,'3. Tidak ada Angg. Yang Ditinggal',0,1,'L');
	$pdf->Cell(6,0.5,'   Bagi Yang Tidak Pindah',0,0,'L');
	$pdf->Cell(3.5,0.5,'2. Membuat KK Baru',0,0,'L');
	$pdf->Cell(9,0.5,'4. Nomor KK Tetap',0,1,'L');
	$pdf->Cell(19,0.1,'',0,1,'R');
	
	$pdf->Cell(5,0.5,'6. Status Nomor KK',0,0,'L');
	$pdf->Cell(1,1,$dt['kk_pindah'],1,0,'C'); //data
	$pdf->Cell(3.5,0.5,'1. Numpang KK',0,0,'L');
	$pdf->Cell(6,0.5,'3. Nama Kepala Keluarga dan Nomor KK Tetap',0,1,'L');
	$pdf->Cell(6,0.5,'   Bagi Yang Pindah',0,0,'L');
	$pdf->Cell(3.5,0.5,'2. Membuat KK Baru',0,1,'L');
	$pdf->Cell(19,0.1,'',0,1,'R');
	
	$tgl_pindah =tgl_indo($dt['TanggalDatang']);
	$pdf->Cell(5,0.5,'7. Rencana Tanggal Pindah',0,0,'L');
	$pdf->Cell(6,0.5,$tgl_pindah,1,1,'L'); //data 
	$pdf->Cell(19,0.1,'',0,1,'L'); 
	
	$pdf->Cell(5,0.5,'8. Keluarga Yang Pindah',0,1,'L');
	$pdf->Cell(19,0.1,'',0,1,'L'); 
	
	$pdf->SetFont('Times','B','8');
	$pdf->Cell(1,0.5,'NO',1,0,'C'); 
	$pdf->Cell(5,0.5,'NAMA',1,0,'C'); 
	$pdf->Cell(5,0.5,'TEMPAT/TGL LAHIR',1,0,'C'); 
	$pdf->Cell(5,0.5,'STATUS',1,0,'C'); 
	$pdf->Cell(3,0.5,'SHDK *)',1,1,'C');
	//Colom1
	$no=1;
	$keluarga 	= mysql_query("SELECT * from tblpenduduk where NoKK='$dt[NoKK]' ORDER BY UrutPosisiKK ASC");
	while($klg 	= mysql_fetch_array($keluarga))
	{
	$datalahir 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$klg[TempatLahir]' ORDER BY NamaKabKota ASC");
						$lhr 	= mysql_fetch_array($datalahir);
	$shdk 		= mysql_query("SELECT PosisiKKID,NamaPosisiKK FROM tblposisikk where PosisiKKID='$klg[UrutPosisiKK]'");
	$sh 		= mysql_fetch_array($shdk);

	$kerja 		= mysql_query("SELECT NamaPekerjaan,PekerjaanID FROM tblpekerjaan where PekerjaanID='$klg[Pekerjaan]'");
	$krj 		= mysql_fetch_array($kerja);


	$tgl_lahir =tgl_indo($klg['TanggalLahir']);
	$pdf->SetFont('Times','','6');
	$pdf->Cell(1,0.5,$no,1,0,'C'); 
	$pdf->Cell(5,0.5,strtoupper($klg['NamaLengkap']),1,0,'L'); 
	$pdf->Cell(5,0.5,$lhr['NamaKabKota']." / ".$tgl_lahir,1,0,'L'); 
	$pdf->Cell(5,0.5,$krj['NamaPekerjaan'],1,0,'L'); 
	$pdf->Cell(3,0.5,$sh['NamaPosisiKK'],1,1,'L');
	$no++;
	}
	$pdf->Ln();
	$pdf->Cell(0.5,0.5,'',0,0,'C'); 
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(6,0.5,'Dikerjakan Oleh :',0,0,'L'); 
	$pdf->Cell(6,0.5,'',0,0,'C'); 
	$pdf->Cell(6,0.5,'Dikeluarkan Oleh :',0,1,'L');
	$pdf->Cell(0.5,0.5,'',0,0,'C'); 
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(6,0.5,'Camat Godong',0,0,'C'); 
	$pdf->Cell(6,0.5,'Nama Pemohon',0,0,'C'); 
	$pdf->Cell(6,0.5,'Kepala Desa Kemloko',0,1,'C'); 
	$pdf->Cell(0.5,0.5,'',0,0,'C'); 
	$pdf->SetFont('Times','','9');
	$tglini=tgl_indo(date("Y m d"));
	//$pdf->Cell(2.5,0.5,'No.123456789,',0,0,'L'); //data
	$pdf->Cell(5.5,0.5,'Tgl. '.$tglini ,0,0,'C'); //data
	$pdf->Cell(6,0.5,'',0,0,'C'); 
	//$pdf->Cell(2.5,0.5,'No.123456789,',0,0,'L'); //data
	$pdf->Cell(6,0.5,'Tgl. '.$tglini,0,1,'C'); //data
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();

	$kepaladesa = mysql_query("SELECT id_pejabat,nip,nama_pejabat,jabatan FROM tblpejabat where jabatan='Kepala Desa'");
	$kpl 		= mysql_fetch_array($kepaladesa);
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(0.5,0.5,'',0,0,'C'); 
	$pdf->Cell(6,0.5,'(                                             )',0,0,'C'); //data
	$pdf->Cell(6,0.5,'(                                             )',0,0,'C'); //data
	$pdf->Cell(6,0.5,"(".$kpl['nama_pejabat'].")",0,1,'C');//data
	
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(0.5,0.5,'',0,0,'C'); 
	$pdf->Cell(6,0.5,'NIP.',0,0,'C'); //data 
	$pdf->Cell(6,0.5,'',0,0,'C');  //data
	$pdf->Cell(6,0.5,'NIP. '.$kpl['nip'],0,1,'C');//data
	$pdf->Ln();
	$pdf->Cell(19,0.5,'*) SHDK (Status Hubungan Dengan Kepala Keluarga)',0,1,'L'); 
	
	$pdf->Ln();
	$pdf->output("Surat Pengantar","I");
?>
		
		