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
		//$this->Image('../logo1.jpg',1,0.7,2.1);
	
		// $this->SetFont('Times','BU','10');
		// $this->Cell(1,0.5,'',0,1,'L');
		// $this->Ln();
		// $this->Cell(1,0.5,'',0,0,'L');
		// $this->Cell(6,0.5,'UNTUK ARSIP DESA/KELURAHAN',0,0,'R');
		
  	}
  
  	function Footer()
  	{	
   		// $this->SetY(-2,5);
		//$this->Cell(0,1,$this->PageNo(),0,0,'C');
  	}
}


	$pdf = new PDF('P','cm','A4');
	 $pdf->SetMargins(1,0.5,0.5);
   	$pdf->Open();
   	$pdf->AliasNbPages();
   	$pdf->AddPage();
	$pdf->SetXY(1,1);
	
		$id		=$_GET['id'];
		$data 	=mysql_query ("SELECT * from tblkematian where NIK_Jenazah='$id'");
		$dt 	=mysql_fetch_array ($data);	
		$data_jenazah 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NIK_Jenazah]'");
		$dtje 		=mysql_fetch_array($data_jenazah);
		$dusun 		=mysql_query("SELECT NamaDusun FROM tbldusun where DusunID='$dtje[DusunID]'");
		$dsn 		=mysql_fetch_array($dusun);
		$kabkota = mysql_query("SELECT  SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID FROM tblkabkota where KabKotaID='$dtje[KabupatenID]'");
		$kab	 = mysql_fetch_array($kabkota);
		$kecamatan=mysql_query("SELECT NamaKecamatan,KecamatanID,KabKotaID FROM tblkecamatan where KabKotaID='$dtje[KabupatenID]'");
		$kec	 = mysql_fetch_array($kecamatan);
		$kelurahan =mysql_query("SELECT KelurahanID,NamaKelurahan FROM tblkelurahan where KelurahanID='$dtje[KelurahanID]'");
		$kel 		=mysql_fetch_array($kelurahan);
		$prov 		=mysql_query("SELECT NamaProvinsi from tblprovinsi where ProvinsiID='$dtje[ProvinsiID]'");
		$prv 		=mysql_fetch_array($prov);

		$aktifitas="User $_SESSION[username] Melakukan Cetak Data Kematian Nomer $dt[NoSuratKematian]";
						include"../key_log.php";

	$pdf->SetFont('Times','','9');
	$pdf->Cell(5,0.4,'Kode',0,0,'L');
	$pdf->Cell(0.5,0.4,': ',0,0,'L');
	$pdf->Cell(10,0.4,'F-202',0,1,'L'); //data
	$pdf->Cell(5,0.4,'Pemerintahan Kab/Kota',0,0,'L');
	$pdf->Cell(0.5,0.4,': ',0,0,'L');
	$pdf->Cell(10,0.4,strtoupper($kab['NamaKabKota']),0,1,'L'); //data
	$pdf->Cell(5,0.4,'Kecamatan',0,0,'L');
	$pdf->Cell(0.5,0.4,': ',0,0,'L');
	$pdf->Cell(5,0.4,strtoupper($kec['NamaKecamatan']),0,0,'L'); //data
	$pdf->Cell(3,0.4,'Kode Wilayah',0,0,'L');
	$pdf->Cell(0.5,0.4,': ',0,0,'L');
	$pdf->Cell(5,0.4,'-',1,1,'L'); //data
	$pdf->Cell(5,0.4,'Desa/Kelurahan',0,0,'L');
	$pdf->Cell(0.5,0.4,': ',0,0,'L');
	$pdf->Cell(10,0.4,strtoupper($kel['NamaKelurahan']),0,1,'L'); //data


	$pdf->SetFont('Times','B','9');
	$pdf->Cell(19,0.1,'',0,1,'L');
	$pdf->Cell(19,0.4,'ARSIP UNTUK KECAMATAN/PEREKAM DATA',0,1,'C');
	$pdf->Cell(19,0.4,'SURAT KETERANGAN KEMATIAN',0,1,'C');
	$pdf->Cell(19,0.4,'NO. '.strtoupper($dt['NoSuratKematian']),0,1,'C');//data

	$pdf->SetFont('Times','','9');
	$pdf->Cell(5,0.4,'Nama Kepala Keluarga',0,0,'L');
	$pdf->Cell(0.5,0.4,':',0,0,'L'); 
	$pdf->Cell(12,0.4,strtoupper($dt['NamaKepalaKeluarga']),1,1,'L'); //data
	$pdf->Cell(5,0.4,'Nomor Kartu Keluarga',0,0,'L');
	$pdf->Cell(0.5,0.4,':',0,0,'L'); 
	$pdf->Cell(8,0.4,strtoupper($dt['NoKK']),1,1,'L'); //data

	$pdf->Cell(19,0.2,'','0',1,'L');
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(19,0.5,'JENAZAH','TLR',1,'L');
	$pdf->SetFont('Times','','9');

	$pdf->Cell(5,0.5,'1. NIK','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,strtoupper($dt['NIK_Jenazah']),1,0,'L');
	$pdf->Cell(7,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'2. Nama Lengkap','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(10,0.5,strtoupper($dt['NamaLengkapJenazah']),1,0,'L');
	$pdf->Cell(3.5,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'3. Jenis Kelamin','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	if ($dt['JenisKelaminJenazah'] == '0')
	{
		$pdf->Cell(1,0.5,'1',1,0,'C');//data
	}else
	{
		$pdf->Cell(1,0.5,'2',1,0,'C');//data
	}
	$pdf->Cell(12.5,0.5,'1. Laki-Laki  2. Perempuan','R',1,'L'); 

	$TanggalLahirJenazah = tgl_indo ($dt['TanggalLahirJenazah']);
	$pdf->Cell(5,0.5,'4. Tanggal Lahir/Umur','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(2,0.5,'Tanggal Lahir ',0,0,'L');//data
	$pdf->Cell(6,0.5,$TanggalLahirJenazah,1,0,'L');//data
	$pdf->Cell(1.5,0.5,'Umur ',0,0,'L');//data
	$pdf->Cell(1,0.5,$dt['Umur'],1,0,'L');//data
	$pdf->Cell(3,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'5. Tempat Lahir','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(4,0.5,$dt['TempatLahirIDJenazah'],1,0,'L');//data
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(1.5,0.5,'Kode Prov',1,0,'L');
	$pdf->Cell(2,0.5,$dtje['ProvinsiID'],1,0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(1.5,0.5,'Kode Kab',1,0,'L');
	$pdf->Cell(2,0.5,strtoupper($kab['KabKotaID']),1,0,'L');
	$pdf->Cell(1.5,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'6. Agama','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	if ($dt['AgamaIDJenazah'] == 'ISLAM')
	{
		$pdf->Cell(1,0.5,'1',1,0,'C');//data
	}
	elseif ($dt['AgamaIDJenazah'] == 'PROTESTAN')
	{
		$pdf->Cell(1,0.5,'2',1,0,'C');//data
	}
	elseif ($dt['AgamaIDJenazah'] == 'KATHOLIK')
	{
		$pdf->Cell(1,0.5,'3',1,0,'C');//data
	}
	elseif ($dt['AgamaIDJenazah'] == 'HINDU')
	{
		$pdf->Cell(1,0.5,'4',1,0,'C');//data
	}
	elseif ($dt['AgamaIDJenazah'] == 'BUDHA')
	{
		$pdf->Cell(1,0.5,'5',1,0,'C');//data
	}
	else
	{
		$pdf->Cell(1,0.5,'6',1,0,'C');//data
	}
	
	$pdf->Cell(12.5,0.5,'1. Islam  2. Kristen 3. Katolik 4. Hindu 5. Budha 6.Lainnya','R',1,'L'); 

	$kerja 	= mysql_query("SELECT PekerjaanID,NamaPekerjaan FROM tblpekerjaan where NamaPekerjaan='$dt[PekerjaanIDJenazah]'");
	$krj 	= mysql_fetch_array($kerja);

	$pdf->Cell(5,0.5,'4. Pekerjaan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(1,0.5,$krj['PekerjaanID'],1,0,'C');//data
	$pdf->Cell(12.5,0.5,$krj['NamaPekerjaan'],'R',1,'L');//data

	$pdf->Cell(5,0.5,'5. Alamat','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(12.5,0.5,''.ucfirst($dt['AlamatJenazah']),1,'L'); //data
	$pdf->Cell(1,0.5,'','R',1,'L'); //data

	$pdf->Cell(5.5,0.5,'','L',0,'L');
	$pdf->Cell(3,0.5,'a. Desa/Kelurahan',0,0,'L');
	$pdf->Cell(3.5,0.5,$kel['NamaKelurahan'],1,0,'L'); //data
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(2,0.5,'c. Kab/Kota',0,0,'L');
	$pdf->Cell(3.5,0.5,$kab['NamaKabKota'],1,0,'L');
	$pdf->Cell(1,0.5,'','R',1,'L'); //data

	$pdf->Cell(5.5,0.5,'','L',0,'L');
	$pdf->Cell(3,0.5,'b. Kecamatan',0,0,'L');
	$pdf->Cell(3.5,0.5,$kec['NamaKecamatan'],1,0,'L'); //data
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(2,0.5,'d. Provinsi',0,0,'L');
	$pdf->Cell(3.5,0.5,$prv['NamaProvinsi'],1,0,'L');
	$pdf->Cell(1,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'6. Kewarganegaraan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	if ($dt['KewarganegaraanJenazah'] =='WNI')
	{
		$pdf->Cell(1,0.5,'1',1,0,'C');//data
	}
	else
	{
		$pdf->Cell(1,0.5,'2',1,0,'C');//data
	}
	$pdf->Cell(12.5,0.5,'1. WNI  2. WNA','R',1,'L'); 

	$pdf->Cell(5,0.5,'7. Keturunan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	if ($dt['KeturunanIDJenazah'] == 'Eropa')
	{
		$pdf->Cell(1,0.5,'1',1,0,'C');//data
	}
	elseif ($dt['KeturunanIDJenazah'] == 'Cina/Timur Asing Lainnya')
	{
		$pdf->Cell(1,0.5,'2',1,0,'C');//data
	}
	elseif ($dt['KeturunanIDJenazah'] == 'Indonesia')
	{
		$pdf->Cell(1,0.5,'3',1,0,'C');//data
	}
	elseif ($dt['KeturunanIDJenazah'] == 'Indonesia Nasional')
	{
		$pdf->Cell(1,0.5,'4',1,0,'C');//data
	}
	else
	{
		$pdf->Cell(1,0.5,'5',1,0,'C');//data
	}
	$pdf->Cell(12.5,0.5,'1. Eropa 2. Cina/Timur Asing Lainnya 3. Indonesia  4.Indonesia Nasional 5.lainnya','R',1,'L'); 

	$pdf->Cell(5,0.5,'8. Kebangsaaan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,$dt['KebangsaanIDJenazah'],1,0,'L');
	$pdf->Cell(7,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'8. Anak Ke','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(1,0.5,$dt['AnakKeJenazah'],1,0,'L');//data
	$pdf->Cell(12.5,0.5,'1, 2, 3, 4','R',1,'L'); 

	$TglKematianJenazah = tgl_indo($dt['TglKematianJenazah']);
	$pdf->Cell(5,0.5,'9. Tanggal Kematian','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(4.5,0.5,$TglKematianJenazah,1,0,'L');
	$pdf->Cell(9,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'6. Pukul','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(3.5,0.5,$dt['JamKematianJenazah'],1,0,'L');//data
	$pdf->Cell(10,0.5,'','R',1,'L'); 

	$pdf->Cell(5,0.5,'7. Sebab Kematian','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	if ($dt['SebabKematianIDJenazah'] == 'Sakit Biasa/Tua')
	{
		$pdf->Cell(1,0.5,'1',1,0,'C');//data
	}
	elseif ($dt['SebabKematianIDJenazah'] == 'Wabah Penyakit')
	{
		$pdf->Cell(1,0.5,'2',1,0,'C');//data
	}
	elseif ($dt['SebabKematianIDJenazah'] == 'Kecelakaan')
	{
		$pdf->Cell(1,0.5,'3',1,0,'C');//data
	}
	elseif ($dt['SebabKematianIDJenazah'] == 'Kriminalitas')
	{
		$pdf->Cell(1,0.5,'4',1,0,'C');//data
	}
	elseif ($dt['SebabKematianIDJenazah'] == 'Bunuh Diri')
	{
		$pdf->Cell(1,0.5,'5',1,0,'C');//data
	}
	else
	{
		$pdf->Cell(1,0.5,'1',1,0,'C');//data
	}
	
	$pdf->Cell(12.5,0.5,'1. Sakit Biasa/Tua 2. Wabah Penyakit 3. Kecelakaan 4. Kriminalitas 5. Bunuh Diri 6. Lainnya','R',1,'L'); 

	$pdf->Cell(5,0.5,'8. Tempat Kematian','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(12,0.5,$dt['TempatKematianJenazah'],1,0,'L');//data
	$pdf->Cell(1.5,0.5,'','R',1,'L'); 

	$pdf->Cell(5,0.5,'9. Yang Menerangkan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	if ($dt['YangMenerangkanKematian'] == 'Dokter')
	{
		$pdf->Cell(1,0.5,'1',1,0,'C');//data
	}
	elseif  ($dt['YangMenerangkanKematian'] == 'Tenaga Kesehatan')
	{
		$pdf->Cell(1,0.5,'2',1,0,'C');//data
	}
	elseif  ($dt['YangMenerangkanKematian'] == 'Kepolisian')
	{
		$pdf->Cell(1,0.5,'3',1,0,'C');//data
	}
	else
	{
		$pdf->Cell(1,0.5,'4',1,0,'C');//data
	}
	$pdf->Cell(12.5,0.5,'1. Dokter  2. Tenaga Kesehatan 3. Kepolisian  4.Lainnya','R',1,'L'); 
	$pdf->Cell(19,0.2,'','LRB',1,'L');

//Data Ayah
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(19,0.3,'AYAH','TLR',1,'L');
	$pdf->SetFont('Times','','9');

	$pdf->Cell(5,0.5,'1. NIK','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,$dt['NIK_Ayah'],1,0,'L');
	$pdf->Cell(7,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'2. Nama Lengkap','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(8.5,0.5,strtoupper($dt['NamaLengkapAyah']),1,0,'L');
	$pdf->Cell(5,0.5,'','R',1,'L'); //data

	$TanggalLahirAyah = tgl_indo($dt['TanggalLahirAyah']);
	$umurAyah 	= umur($dt['TanggalLahirAyah']);

	$pdf->Cell(5,0.5,'3. Tanggal Lahir/Umur','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(2,0.5,'Tanggal Lahir ',0,0,'L');//data
	$pdf->Cell(6,0.5,$TanggalLahirAyah,0,'L');//data
	$pdf->Cell(1.5,0.5,'Umur ',0,0,'L');//data
	$pdf->Cell(1,0.5,$umurAyah,1,0,'L');//data
	$pdf->Cell(3,0.5,'','R',1,'L'); //data

	$data_ayah 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NIK_Ayah]'");
	$ayah 		=mysql_fetch_array($data_ayah);

	$kerjaayah 	= mysql_query("SELECT PekerjaanID,NamaPekerjaan FROM tblpekerjaan where NamaPekerjaan='$dt[PekerjaanIDAyah]'");
	$krjayah 	= mysql_fetch_array($kerjaayah);

	$provayah=mysql_query("SELECT NamaProvinsi from tblprovinsi where ProvinsiID='$ayah[ProvinsiID]'");
		$payah=mysql_fetch_array($provayah);
		$kabayah=mysql_query("SELECT NamaKabKota from tblkabkota where KabKotaID='$ayah[KabupatenID]'");
		$bayah=mysql_fetch_array($kabayah);
		$kecayah=mysql_query("SELECT NamaKecamatan from tblkecamatan where KecamatanID='$ayah[KecamatanID]'");
		$cayah=mysql_fetch_array($kecayah);
		$kelayah=mysql_query("SELECT NamaKelurahan from tblkelurahan where KelurahanID='$ayah[KelurahanID]'");
		$layah=mysql_fetch_array($kelayah);

	$pdf->Cell(5,0.5,'4. Pekerjaan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(1,0.5,$krjayah['PekerjaanID'],1,0,'C');//data
	$pdf->Cell(12.5,0.5,$krjayah['NamaPekerjaan'],'R',1,'L');//data

	$pdf->Cell(5,0.5,'5. Alamat','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(12.5,0.5,''.ucfirst($dt['AlamatAyah']),1,'L'); //data
	$pdf->Cell(1,0.5,'','R',1,'L'); //data

	$pdf->Cell(5.5,0.5,'','L',0,'L');
	$pdf->Cell(3,0.5,'a. Desa/Kelurahan',0,0,'L');
	$pdf->Cell(3,0.5,$layah['NamaKelurahan'],1,0,'L'); //data
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(2,0.5,'c. Kab/Kota',0,0,'L');
	$pdf->Cell(4,0.5,$bayah['NamaKabKota'],1,0,'L');
	$pdf->Cell(1,0.5,'','R',1,'L'); //data

	$pdf->Cell(5.5,0.5,'','L',0,'L');
	$pdf->Cell(3,0.5,'b. Kecamatan',0,0,'L');
	$pdf->Cell(3,0.5,$cayah['NamaKecamatan'],1,0,'L'); //data
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(2,0.5,'d. Provinsi',0,0,'L');
	$pdf->Cell(4,0.5,$payah['NamaProvinsi'],1,0,'L');
	$pdf->Cell(1,0.5,'','R',1,'L'); //data

	$data_ibu 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NIK_Ibu]'");
	$ibu 		=mysql_fetch_array($data_ibu);
	$kerjaibu 	= mysql_query("SELECT PekerjaanID,NamaPekerjaan FROM tblpekerjaan where NamaPekerjaan='$dt[PekerjaanIbu]'");
	$krjibu 	= mysql_fetch_array($kerjaibu);
	$provibu=mysql_query("SELECT NamaProvinsi from tblprovinsi where ProvinsiID='$ibu[ProvinsiID]'");
		$pibu=mysql_fetch_array($provibu);
		$kabibu=mysql_query("SELECT NamaKabKota from tblkabkota where KabKotaID='$ibu[KabupatenID]'");
		$bibu=mysql_fetch_array($kabibu);
		$kecibu=mysql_query("SELECT NamaKecamatan from tblkecamatan where KecamatanID='$ibu[KecamatanID]'");
		$cibu=mysql_fetch_array($kecibu);
		$kelibu=mysql_query("SELECT NamaKelurahan from tblkelurahan where KelurahanID='$ibu[KelurahanID]'");
		$libu=mysql_fetch_array($kelibu);

//Data Ibu
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(19,0.3,'IBU','TLR',1,'L');
	$pdf->SetFont('Times','','9');

	$pdf->Cell(5,0.5,'1. NIK','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,$dt['NIK_Ibu'],1,0,'L');
	$pdf->Cell(7,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'2. Nama Lengkap','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(8.5,0.5,strtoupper($dt['NamaLengkapIbu']),1,0,'L');
	$pdf->Cell(5,0.5,'','R',1,'L'); //data

	$TanggalLahirIbu = tgl_indo($dt['TanggalLahirIbu']);
	$umurIbu 	= umur($dt['TanggalLahirIbu']);

	$pdf->Cell(5,0.5,'3. Tanggal Lahir/Umur','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(2,0.5,'Tanggal Lahir ',0,0,'L');//data
	$pdf->Cell(6,0.5,$TanggalLahirIbu,1,0,'L');//data
	$pdf->Cell(1.5,0.5,'Umur ',0,0,'L');//data
	$pdf->Cell(1,0.5,$umurIbu,1,0,'L');//data
	$pdf->Cell(3,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'4. Pekerjaan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(1,0.5,$krjibu['PekerjaanID'],1,0,'L');//data
	$pdf->Cell(12.5,0.5,$krjibu['NamaPekerjaan'],'R',1,'L');//data

	$pdf->Cell(5,0.5,'5. Alamat','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(12.5,0.5,''.ucfirst($dt['AlamatIbu']),1,'L'); //data
	$pdf->Cell(1,0.5,'','R',1,'L'); //data

	$pdf->Cell(5.5,0.5,'','L',0,'L');
	$pdf->Cell(3,0.5,'a. Desa/Kelurahan',0,0,'L');
	$pdf->Cell(3,0.5,$libu['NamaKelurahan'],1,0,'L'); //data
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(2,0.5,'c. Kab/Kota',0,0,'L');
	$pdf->Cell(4,0.5,$bibu['NamaKabKota'],1,0,'L');
	$pdf->Cell(1,0.5,'','R',1,'L'); //data

	$pdf->Cell(5.5,0.5,'','L',0,'L');
	$pdf->Cell(3,0.5,'b. Kecamatan',0,0,'L');
	$pdf->Cell(3,0.5,$cibu['NamaKecamatan'],1,0,'L'); //data
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(2,0.5,'d. Provinsi',0,0,'L');
	$pdf->Cell(4,0.5,$pibu['NamaProvinsi'],1,0,'L');
	$pdf->Cell(1,0.5,'','R',1,'L'); //data


//PElapor
	//$pdf->Cell(19,0.2,'','0',1,'L');
	$pelapor 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NIK_Pelapor]'");
	$plp 		=mysql_fetch_array($pelapor);
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(19,0.4,'PELAPOR','TLR',1,'L');
	$pdf->SetFont('Times','','9');

	$pdf->Cell(5,0.5,'1. NIK','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,$plp['NoIdentitas'],1,0,'L');
	$pdf->Cell(7,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'2. Nama Lengkap','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(8.5,0.5,strtoupper($plp['NamaLengkap']),1,0,'L');
	$pdf->Cell(5,0.5,'','R',1,'L'); //data
	$pdf->Cell(19,0.2,'','LRB',1,'L');

//SAKSI I
	//$pdf->Cell(19,0.2,'','0',1,'L');
	$saksi1 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NIK_Saksi1]'");
	$sks1 		=mysql_fetch_array($saksi1);

	$pdf->SetFont('Times','B','9');
	$pdf->Cell(19,0.4,'SAKSI I','TLR',1,'L');
	$pdf->SetFont('Times','','9');

	$pdf->Cell(5,0.5,'1. NIK','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,$sks1['NoIdentitas'],1,0,'L');
	$pdf->Cell(7,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'2. Nama Lengkap','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(8.5,0.5,strtoupper($sks1['NamaLengkap']),1,0,'L');
	$pdf->Cell(5,0.5,'','R',1,'L'); //data
	$pdf->Cell(19,0.2,'','LRB',1,'L');

//SAKSI
	//$pdf->Cell(19,0.2,'','0',1,'L');
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(19,0.4,'SAKSI II','TLR',1,'L');
	$pdf->SetFont('Times','','9');

	$saksi2 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NIK_Saksi2]'");
	$sks2 		=mysql_fetch_array($saksi2);

	$pdf->Cell(5,0.5,'1. NIK','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,$sks2['NoIdentitas'],1,0,'L');
	$pdf->Cell(7,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'2. Nama Lengkap','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(8.5,0.5,strtoupper($sks2['NamaLengkap']),1,0,'L');
	$pdf->Cell(5,0.5,'','R',1,'L'); //data
	$pdf->Cell(19,0.2,'','LRB',1,'L');

	$pdf->Ln();
	$pdf->output("Surat Kematian","I");
?>
		