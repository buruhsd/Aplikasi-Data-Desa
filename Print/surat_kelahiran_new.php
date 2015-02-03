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
	// $pdf->SetMargins(0.5,0.5,0.5);
   	$pdf->Open();
   	$pdf->AliasNbPages();
   	$pdf->AddPage();
	$pdf->SetXY(1,1);
	
	$id = $_GET['id'];
	
	$data_kelahiran= mysql_query("SELECT * FROM tblkelahiran where no_kelahiran='$id'");
	$dt= mysql_fetch_array($data_kelahiran);
	$kabkota = mysql_query("SELECT  SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID FROM tblkabkota where KabKotaID='$dt[TempatKelahiran]'");
	$kab	 = mysql_fetch_array($kabkota);
	$kecamatan=mysql_query("SELECT NamaKecamatan,KecamatanID,KabKotaID FROM tblkecamatan where KabKotaID='$kab[KabKotaID]'");
	$kec	 = mysql_fetch_array($kecamatan);
	$kelurahan =mysql_query("SELECT KelurahanID,NamaKelurahan FROM tblkelurahan where KelurahanID='$_SESSION[kelurahan]'");
	$kel 		=mysql_fetch_array($kelurahan);
	
	$aktifitas="User $_SESSION[username] Melakukan Cetak Data Kelahiran Nomer $dt[no_kelahiran] Bayi $dt[NamaBayi]";
				include"../key_log.php";

	$pdf->SetFont('Times','','9');
	$pdf->Cell(5,0.4,'Kode ',0,0,'L');
	$pdf->Cell(0.5,0.4,':',0,0,'L');
	$pdf->Cell(10,0.4,'F-2.02',0,1,'L'); //data
	$pdf->Cell(5,0.4,'Pemerintahan Kab/Kota',0,0,'L');
	$pdf->Cell(0.5,0.4,':',0,0,'L');
	$pdf->Cell(10,0.4,strtoupper($kab['NamaKabKota']),0,1,'L'); //data
	$pdf->Cell(5,0.4,'Kecamatan',0,0,'L');
	$pdf->Cell(0.5,0.4,':',0,0,'L');
	$pdf->Cell(5,0.4,strtoupper($kec['NamaKecamatan']),0,0,'L'); //data
	$pdf->Cell(3,0.4,'Kode Wilayah',0,0,'L');
	$pdf->Cell(0.5,0.4,':',0,0,'L');
	$pdf->Cell(5,0.4,'-',1,1,'L'); //data
	$pdf->Cell(5,0.4,'Desa/Kelurahan',0,0,'L');
	$pdf->Cell(0.5,0.4,':',0,0,'L');
	$pdf->Cell(10,0.4,strtoupper($kel['NamaKelurahan']),0,1,'L'); //data

	$pdf->SetFont('Times','B','9');
	$pdf->Cell(19,0.2,'',0,1,'L');
	$pdf->Cell(19,0.4,'ARSIP UNTUK KECAMATAN/PEREKAM DATA',0,1,'C');
	$pdf->Cell(19,0.4,'SURAT KETERANGAN KELAHIRAN',0,1,'C');
	$pdf->Cell(19,0.4,'NO. '.strtoupper($dt['no_kelahiran']),0,1,'C');//data

	$data_ayah 	=mysql_query("SELECT NoIdentitas,NamaLengkap,NoKK,Jalan,TempatLahir FROM tblpenduduk where NoIdentitas='$dt[nik_ayah]'");
	$ayah 		=mysql_fetch_array($data_ayah);
	$kabkotaayah = mysql_query("SELECT  SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID FROM tblkabkota where KabKotaID='$ayah[TempatLahir]'");
	$kayah	 = mysql_fetch_array($kabkotaayah);

	$pdf->SetFont('Times','','9');
	$pdf->Cell(5,0.5,'Nama Kepala Keluarga',0,0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L'); 
	$pdf->Cell(12,0.5,strtoupper($ayah['NamaLengkap']),1,1,'L'); //data
	$pdf->Cell(5,0.5,'Nomor Kartu Keluarga',0,0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L'); 
	$pdf->Cell(8,0.5,$ayah['NoKK'],1,1,'L'); //data

	$pdf->Cell(19,0.2,'','0',1,'L');
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(19,0.4,'BAYI','TLR',1,'L');
	$pdf->SetFont('Times','','9');

	$pdf->Cell(5,0.5,'1. Nama','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(8.5,0.5,strtoupper($dt['NamaBayi']),1,0,'L');
	$pdf->Cell(5,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'2. Jenis Kelamin','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	if ($dt['JKelBayi'] == '0')
	{
		$pdf->Cell(1,0.5,'1',1,0,'C');//data
	}else
	{
		$pdf->Cell(1,0.5,'2',1,0,'C');//data
	}
	$pdf->Cell(12.5,0.5,'1. Laki-Laki  2. Perempuan','R',1,'L'); 

	$pdf->Cell(5,0.5,'3. Tempat Dilahirkan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'C');
	if ($dt['TempatDilahirkan'] == 'RS/RB')
	{
		$pdf->Cell(1,0.5,'1',1,0,'C');//data
	}
	elseif ($dt['TempatDilahirkan'] == 'Puskesmas')
	{
		$pdf->Cell(1,0.5,'2',1,0,'C');//data
	}
	elseif ($dt['TempatDilahirkan'] == 'Polindes')
	{
		$pdf->Cell(1,0.5,'3',1,0,'C');//data
	}
	elseif ($dt['TempatDilahirkan'] == 'Rumah')
	{
		$pdf->Cell(1,0.5,'4',1,0,'C');//data
	}
	else
	{
		$pdf->Cell(1,0.5,'5',1,0,'C');//data
	}
	$pdf->Cell(12.5,0.5,'1. RS/RB 2. Puskesmas 3. Polindes 4. Rumah 5. Lainnya','R',1,'L'); 

	$pdf->Cell(5,0.5,'4. Tempat Kelahiran','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,$kab['NamaKabKota'],1,0,'L');//data
	$pdf->Cell(7,0.5,'','R',1,'L'); 

	$hari=hari($dt['TglLahir']);
	$tgl_lahir =tgl_indo($dt['TglLahir']);
	$pdf->Cell(5,0.5,'5. Hari dan Tanggal Lahir','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(1.5,0.5,'Hari ',0,0,'L');//data
	$pdf->Cell(2,0.5,$hari,1,0,'L');//data
	$pdf->Cell(2,0.5,'Tanggal Lahir ',0,0,'L');//data
	$pdf->Cell(6,0.5,$tgl_lahir,1,0,'L');//data
	$pdf->Cell(2,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'6. Pukul','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(3.5,0.5,$dt['Pukul'],1,0,'L');//data
	$pdf->Cell(10,0.5,'','R',1,'L'); 

	$pdf->Cell(5,0.5,'7. Jenis Kelahiran','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	if ($dt['JKelahiran'] == 'Tunggal')
	{
		$pdf->Cell(1,0.5,'1',1,0,'C');//data
	}
	elseif ($dt['JKelahiran'] == 'Kembar 2')
	{
		$pdf->Cell(1,0.5,'2',1,0,'C');//data
	}
	elseif ($dt['JKelahiran'] == 'Kembar 3')
	{
		$pdf->Cell(1,0.5,'3',1,0,'C');//data
	}
	elseif ($dt['JKelahiran'] == 'Kembar 4')
	{
		$pdf->Cell(1,0.5,'4',1,0,'C');//data
	}
	else
	{
		$pdf->Cell(1,0.5,'5',1,0,'C');//data
	}
	$pdf->Cell(12.5,0.5,'1. Tunggal 2. Kembar2 3. Kembar3 4. Kembar4 5. Lainnya','R',1,'L'); 

	$pdf->Cell(5,0.5,'8. Kelahiran Ke','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(1,0.5,$dt['KelahiranKe'],1,0,'C');//data
	$pdf->Cell(12.5,0.5,'1, 2, 3, 4','R',1,'L'); 

	$pdf->Cell(5,0.5,'9. Penolong Kelahiran','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	if ($dt['PenolongKelahiran'] == 'Dokter')
	{
		$pdf->Cell(1,0.5,'1',1,0,'C');//data
	}
	elseif ($dt['PenolongKelahiran'] == 'Bidan')
	{
		$pdf->Cell(1,0.5,'2',1,0,'C');//data
	}
	elseif ($dt['PenolongKelahiran'] == 'Dukun')
	{
		$pdf->Cell(1,0.5,'3',1,0,'C');//data
	}
	else
	{
		$pdf->Cell(1,0.5,'4',1,0,'C');//data
	}

	$pdf->Cell(12.5,0.5,'1. Dokter  2. Bidan 3. Dukun  4.Lainnya','R',1,'L'); 

	$pdf->Cell(5,0.5,'10. Berat Bayi','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(2,0.5,$dt['BeratBayi'],1,0,'L');//data
	$pdf->Cell(0.5,0.5,'Kg',0,0,'L');
	$pdf->Cell(11,0.5,'','R',1,'L'); 
	$pdf->Cell(19,0.2,'','LRB',1,'L');

	$data_ibu 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[nik_ibu]'");
	$ibu 		=mysql_fetch_array($data_ibu);
	$kabkotaibu = mysql_query("SELECT  SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID FROM tblkabkota where KabKotaID='$ibu[TempatLahir]'");
	$kibu	 = mysql_fetch_array($kabkotaibu);

//Data Ibu
	//$pdf->Cell(19,0.2,'','0',1,'L');
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(19,0.4,'IBU','TLR',1,'L');
	$pdf->SetFont('Times','','9');

	$pdf->Cell(5,0.5,'1. NIK','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,$ibu['NoIdentitas'],1,0,'L');
	$pdf->Cell(7,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'2. Nama Lengkap','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(8.5,0.5,strtoupper($ibu['NamaLengkap']),1,0,'L');
	$pdf->Cell(5,0.5,'','R',1,'L'); //data

	$tglibu = $ibu['TanggalLahir'];
	$umur 	= umur($tglibu);
	$pdf->Cell(5,0.5,'3. Tanggal Lahir/Umur','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(2,0.5,'Tanggal Lahir ',0,0,'L');//data
	$pdf->Cell(6,0.5,tgl_indo($tglibu),1,0,'L');//data
	$pdf->Cell(1.5,0.5,'Umur ',0,0,'L');//data
	$pdf->Cell(1,0.5,$umur,1,0,'L');//data
	$pdf->Cell(3,0.5,'','R',1,'L'); //data

	$kerjaibu 	= mysql_query("SELECT PekerjaanID,NamaPekerjaan FROM tblpekerjaan where PekerjaanID='$ibu[Pekerjaan]'");
	$krjibu 	= mysql_fetch_array($kerjaibu);
	$pdf->Cell(5,0.5,'4. Pekerjaan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(1,0.5,$krjibu['PekerjaanID'],1,0,'C');//data
	$pdf->Cell(12.5,0.5,$krjibu['NamaPekerjaan'],'R',1,'L');//data

	$pdf->Cell(5,0.5,'5. Alamat','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(12.5,0.5,$ibu['Jalan'],1,'L'); //data
	$pdf->Cell(1,0.5,'','R',1,'L'); //data

		$provibu=mysql_query("SELECT NamaProvinsi from tblprovinsi where ProvinsiID='$ibu[ProvinsiID]'");
		$pibu=mysql_fetch_array($provibu);
		$kabibu=mysql_query("SELECT NamaKabKota from tblkabkota where KabKotaID='$ibu[KabupatenID]'");
		$bibu=mysql_fetch_array($kabibu);
		$kecibu=mysql_query("SELECT NamaKecamatan from tblkecamatan where KecamatanID='$ibu[KecamatanID]'");
		$cibu=mysql_fetch_array($kecibu);
		$kelibu=mysql_query("SELECT NamaKelurahan from tblkelurahan where KelurahanID='$ibu[KelurahanID]'");
		$libu=mysql_fetch_array($kelibu);

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

	$pdf->Cell(5,0.5,'6. Kewarganegaraan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	if ($ibu ['StatusKependudukan'] == '0')
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
	$pdf->Cell(1,0.5,$ibu['Keturunan'],1,0,'C');//data
	$pdf->Cell(12.5,0.5,'1. Eropa 2. Cina/Timur Asing Lainnya 3. Indonesia  4.Indonesia Nasional 5.lainnya','R',1,'L'); 

	$ngribu=mysql_query("SELECT NamaNegara from tblnegara where NegaraID='$ibu[NegaraID]'");
	$nibu=mysql_fetch_array($ngribu);
	$pdf->Cell(5,0.5,'8. Kebangsaaan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,$nibu['NamaNegara'],1,0,'L');
	$pdf->Cell(7,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'9. Tanggal Pencatatan Perkawinan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(3.5,0.5,tgl_indo($dt['tgl_perkawinan_ibu']),1,0,'L');
	$pdf->Cell(10,0.5,'','R',1,'L'); //data
	$pdf->Cell(19,0.2,'','LRB',1,'L');

//Data Ayah
	$data_ayah 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[nik_ayah]'");
	$ayah 		=mysql_fetch_array($data_ayah);
	$kabkotaayah = mysql_query("SELECT  SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID FROM tblkabkota where KabKotaID='$ayah[TempatLahir]'");
	$kayah	 = mysql_fetch_array($kabkotaayah);

	$kerjaayah 	= mysql_query("SELECT PekerjaanID,NamaPekerjaan FROM tblpekerjaan where PekerjaanID='$ayah[Pekerjaan]'");
	$krjayah 	= mysql_fetch_array($kerjaayah);

		$provayah=mysql_query("SELECT NamaProvinsi from tblprovinsi where ProvinsiID='$ayah[ProvinsiID]'");
		$payah=mysql_fetch_array($provayah);
		$kabayah=mysql_query("SELECT NamaKabKota from tblkabkota where KabKotaID='$ayah[KabupatenID]'");
		$bayah=mysql_fetch_array($kabayah);
		$kecayah=mysql_query("SELECT NamaKecamatan from tblkecamatan where KecamatanID='$ayah[KecamatanID]'");
		$cayah=mysql_fetch_array($kecayah);
		$kelayah=mysql_query("SELECT NamaKelurahan from tblkelurahan where KelurahanID='$ayah[KelurahanID]'");
		$layah=mysql_fetch_array($kelayah);

	//$pdf->Cell(19,0.2,'','0',1,'L');
	$pdf->SetFont('Times','B','9');
	$pdf->Cell(19,0.4,'AYAH','TLR',1,'L');
	$pdf->SetFont('Times','','9');

		$pdf->Cell(5,0.5,'1. NIK','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,$ayah['NoIdentitas'],1,0,'L');
	$pdf->Cell(7,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'2. Nama Lengkap','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(8.5,0.5,strtoupper($ayah['NamaLengkap']),1,0,'L');
	$pdf->Cell(5,0.5,'','R',1,'L'); //data

	$tglayah = $ayah['TanggalLahir'];
	$umur 	= umur($tglayah);
	$pdf->Cell(5,0.5,'3. Tanggal Lahir/Umur','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(2,0.5,'Tanggal Lahir ',0,0,'L');//data
	$pdf->Cell(6,0.5,tgl_indo($tglayah),1,0,'L');//data
	$pdf->Cell(1.5,0.5,'Umur ',0,0,'L');//data
	$pdf->Cell(1,0.5,$umur,1,0,'L');//data
	$pdf->Cell(3,0.5,'','R',1,'L'); //data

	$pdf->Cell(5,0.5,'4. Pekerjaan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(1,0.5,$krjayah['PekerjaanID'],1,0,'C');//data
	$pdf->Cell(12.5,0.5,$krjayah['NamaPekerjaan'],'R',1,'L');//data

	$pdf->Cell(5,0.5,'5. Alamat','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(12.5,0.5,$ayah['Jalan'],1,'L'); //data
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

	$pdf->Cell(5,0.5,'6. Kewarganegaraan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	if ($ayah ['StatusKependudukan'] == '0')
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
	$pdf->Cell(1,0.5,$ibu['Keturunan'],1,0,'C');//data
	$pdf->Cell(12.5,0.5,'1. Eropa 2. Cina/Timur Asing Lainnya 3. Indonesia  4.Indonesia Nasional 5.lainnya','R',1,'L'); 

	$ngrayah=mysql_query("SELECT NamaNegara from tblnegara where NegaraID='$ayah[NegaraID]'");
	$nayah=mysql_fetch_array($ngrayah);
	$pdf->Cell(5,0.5,'8. Kebangsaaan','L',0,'L');
	$pdf->Cell(0.5,0.5,':',0,0,'L');
	$pdf->Cell(6.5,0.5,$nayah['NamaNegara'],1,0,'L');
	$pdf->Cell(7,0.5,'','R',1,'L'); //data

//PElapor
	//$pdf->Cell(19,0.2,'','0',1,'L');
	$pelapor 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[nik_pelapor]'");
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
	$saksi1 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[nik_saksi1]'");
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

	$saksi2 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[nik_saksi2]'");
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
	$pdf->output("Surat Kelahiran","I");
?>
		