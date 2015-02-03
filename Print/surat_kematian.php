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
	
		$this->SetFont('Times','BU','10');
		$this->Cell(1,0.5,'',0,0,'L');
		$this->Cell(6,0.5,'UNTUK ARSIP DESA/KELURAHAN',0,0,'R');
		$this->Cell(1,0.5,'|',0,0,'C');
		$this->Cell(6,0.5,'',0,0,'L');
		$this->Cell(5,0.5,'UNTUK ARSIP KECAMATAN',0,0,'R');
		$this->Cell(1,0.5,'|',0,0,'C');
		$this->Cell(2,0.5,'',0,0,'L');
		$this->Cell(5,0.5,'UNTUK YANG BERSAKUTAN',0,0,'C');
		
		$this->Ln();
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
	$pdf->SetXY(1,1.5);
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

$aktifitas="User $_SESSION[username] Melakukan Cetak Data Kematian Nomer $dt[NoSuratKematian]";
				include"../key_log.php";

	$pdf->SetFont('Times','I','9');
	$pdf->Cell(1,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'Simpedes',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6,0.5,'',0,0,'L');
	$pdf->Cell(5,0.5,'Simpedes',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'Simpedes',0,1,'R');
	
	$pdf->Ln();
	
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(7,0.5,'',0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(11,0.5,'SURAT KEMATIAN',0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'',0,1,'C');
	
	$pdf->Cell(7,0.5,'SURAT KEMATIAN',0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->SetFont('Times','','9');
	$pdf->Cell(11,0.5,'No: '.strtoupper($dt['NoSuratKematian']),0,0,'C');//data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(7.5,0.5,'SURAT KEMATIAN',0,1,'C');
	
	$pdf->SetFont('Times','','9');
	$pdf->Cell(7,0.5,'No: '.strtoupper($dt['NoSuratKematian']),0,0,'C');//data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(11,0.5,'',0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'No: '.strtoupper($dt['NoSuratKematian']),0,1,'C');//data
	
	$pdf->Cell(7,0.5,'',0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(11,0.5,'','TLR',0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'',0,1,'C');
	
	$pdf->Cell(0.5,0.5,'',0,0,'C');
	$pdf->Cell(6.5,0.5,'Yang bertanda tangan dibawah ini menerangkan',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'1. Nama ','L',0,'L');
	$pdf->Cell(8,0.5,': '.strtoupper($dt['NamaLengkapJenazah']),'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(7,0.5,'Yang bertanda tangan dibawah ini menerangkan',0,1,'L');
	
	$pdf->Cell(7,0.5,'bahwa :',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'2. Jenis Kelamin','L',0,'L');
	if($dt['JenisKelaminJenazah']== 0){
	$pdf->Cell(8,0.5,': Laki-Laki','R',0,'L'); //data
	}else{
	$pdf->Cell(8,0.5,': Perempuan','R',0,'L'); //data
	}
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'bahwa :',0,1,'L');
	
	$pdf->Cell(1.5,0.5,'Nama',0,0,'L');
	$pdf->Cell(5.5,0.5,': '.strtoupper($dt['NamaLengkapJenazah']),0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'3. Alamat','L',0,'L');
	$pdf->Cell(8,0.5,': '.strtoupper($dt['AlamatJenazah']),'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'Nama',0,0,'L');
	$pdf->Cell(6,0.5,': '.strtoupper($dt['NamaLengkapJenazah']),0,1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'Kelamin',0,0,'L');
	if($dt['JenisKelaminJenazah']== 0){
		$pdf->Cell(5.5,0.5,': Laki-Laki',0,0,'L'); //data
	}else{
		$pdf->Cell(5.5,0.5,': Perempuan',0,0,'L'); //data
	}
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'     Desa '.strtoupper($dsn['NamaDusun']),'L',0,'L');
	$pdf->Cell(8,0.5,': ','R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'Kelamin',0,0,'L');
	if($dt['JenisKelaminJenazah']== 0){
		$pdf->Cell(5.5,0.5,': Laki-Laki',0,1,'L'); //data
	}else{
		$pdf->Cell(5.5,0.5,': Perempuan',0,1,'L'); //data
	}
	
	$TanggalLahir = tgl_indo($dtje['TanggalLahir']);
	$pdf->Cell(1.5,0.5,'Alamat',0,0,'L');
	$pdf->Cell(5.5,0.5,': '.ucfirst($dt['AlamatJenazah']),0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'4. Dilahirkan ','L',0,'L');
	$pdf->Cell(8,0.5,': '.$TanggalLahir,'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'Alamat',0,0,'L');
	$pdf->Cell(6,0.5,': '.ucfirst($dt['AlamatJenazah']),0,1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'',0,0,'L');
	$pdf->Cell(5.5,0.5,': '.strtoupper($dsn['NamaDusun']),0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(4,0.5,'4. Umur pada saat kematian : ','L',0,'L'); //data
	$pdf->Cell(1,0.5,$dt['Umur'],0,0,'R'); //data
	$pdf->Cell(1,0.5,'Tahun',0,0,'L');
	$pdf->Cell(1,0.5,'',0,0,'R'); //data
	$pdf->Cell(1,0.5,'',0,0,'L');//Bulan
	$pdf->Cell(1,0.5,'',0,0,'R'); //data
	$pdf->Cell(2,0.5,'','R',0,'L');//Hari
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,': '.strtoupper($dsn['NamaDusun']),0,1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'Umur',0,0,'L');
	$pdf->Cell(0.8,0.5,': '.$dt['Umur'],0,0,'L'); //data
	$pdf->Cell(1,0.5,'Tahun',0,0,'L'); 
	$pdf->Cell(1,0.5,'',0,0,'R'); //data
	$pdf->Cell(1,0.5,'',0,0,'L'); //Bulan
	$pdf->Cell(1,0.5,'',0,0,'R'); //data
	$pdf->Cell(0.7,0.5,'',0,0,'L');//Hari
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'7. Kewarganegaraan ','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dt['KewarganegaraanJenazah'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'Umur',0,0,'L');
	$pdf->Cell(0.8,0.5,': '.$dt['Umur'],0,0,'L'); //data
	$pdf->Cell(1,0.5,'Tahun',0,0,'L'); 
	$pdf->Cell(1,0.5,'',0,0,'R'); //data
	$pdf->Cell(1,0.5,'',0,0,'L'); //Bulan
	$pdf->Cell(1,0.5,'',0,0,'R'); //data
	$pdf->Cell(1,0.5,'',0,1,'L');//Hari
	
	$pdf->Cell(7,0.5,'',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'8. Agama','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dt['AgamaIDJenazah'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'',0,1,'L'); 
	
	$kawin =mysql_query("SELECT StatusPerkawinan,NamaStatusPerkawinan FROM tblstatuskawin WHERE StatusPerkawinan='$dtje[StatusPerkawinan]'");
	$kwn 	= mysql_fetch_array($kawin);
	$pdf->Cell(7,0.5,'Telah meninggal dunia pada :',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'9. Status Perkawinan','L',0,'L');
	$pdf->Cell(8,0.5,': '.$kwn['NamaStatusPerkawinan'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'Telah meninggal dunia pada :',0,1,'L'); //data
	
	$hari =hari($dt['TglKematianJenazah']);
	$pdf->Cell(1.5,0.5,'Hari',0,0,'L');
	$pdf->Cell(5.5,0.5,': '.$hari,0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'10. Pekerjaan','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dt['PekerjaanIDJenazah'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'Hari',0,0,'L');
	$pdf->Cell(6,0.5,': '.$hari,0,1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'Tanggal',0,0,'L');
	$tglmati = tgl_indo($dt['TglKematianJenazah']);
	
	$pdf->Cell(5.5,0.5,': '.$tglmati,0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'11. Tempat Kematian','L',0,'L');
	$pdf->Cell(8,0.5,': '.$tglmati,'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'Tanggal',0,0,'L');
	$pdf->Cell(6,0.5,': '.$tglmati,0,1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'Di',0,0,'L'); 
	$pdf->Cell(5.5,0.5,': '.$dt['TempatKematianJenazah'],0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'','L',0,'L');
	$pdf->Cell(2,0.5,'Desa ',0,0,'L');
	$pdf->Cell(6,0.5,': '.$dsn['NamaDusun'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'Di',0,0,'L'); 
	$pdf->Cell(6,0.5,': '.$dt['TempatKematianJenazah'],0,1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'',0,0,'L'); 
	$pdf->Cell(5.5,0.5,'',0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'','L',0,'L');
	$pdf->Cell(2,0.5,'Kecamatan ',0,0,'L');
	$pdf->Cell(6,0.5,': '.$kec['NamaKecamatan'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'',0,1,'L'); //data
	
	$pdf->Cell(7,0.5,'',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'','L',0,'L');
	$pdf->Cell(2,0.5,'Kabupaten',0,0,'L');
	$pdf->Cell(6,0.5,': '.$kab['NamaKabKota'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'',0,1,'L'); 
	
	$pdf->Cell(3,0.5,'Disebabkan karena',0,0,'L');
	$pdf->Cell(4,0.5,': ',0,0,'L'); //data
	//$pdf->Cell(4,0.5,': '.$dt['SebabKematianIDJenazah'],0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'12. Sebab Kematian','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dt['SebabKematianIDJenazah'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Disebabkan karena',0,0,'L');
	//$pdf->Cell(4.5,0.5,': '.$dt['SebabKematianIDJenazah'],0,1,'L'); //data
	$pdf->Cell(4.5,0.5,': ',0,1,'L'); //data
	
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	//$pdf->Cell(4,0.5,'',0,0,'L'); //data
	$pdf->Cell(6.5,0.5,$dt['SebabKematianIDJenazah'],0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'13. Yang menentukan','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dt['YangMenerangkanKematian'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	//$pdf->Cell(4.5,0.5,'',0,1,'L'); //data
	$pdf->Cell(7,0.5,$dt['SebabKematianIDJenazah'],0,1,'L'); //data
	
	$pdf->Cell(3,0.5,'',0,0,'L');
	$pdf->Cell(4,0.5,'',0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'    No. Kartu Keluarga','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dtje['NoKK'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'',0,0,'L');
	$pdf->Cell(4.5,0.5,'',0,1,'L'); //data

	
	$pdf->Cell(7,0.5,'Surat keterangan ini dibuat atas dasar yang',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'    No. KTP','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dtje['NoIdentitas'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'Surat keterangan ini dibuat atas dasar yang',0,1,'L'); 
	
	$pdf->Cell(7,0.5,'sebenarnya',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(11,0.5,'','LR',0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'sebenarnya',0,1,'L'); 
	
	$pdf->Cell(3,0.5,'Nama Pelapor',0,0,'L');
	$pdf->Cell(4,0.5,': '.ucfirst($dt['NamaLengkapPelapor']),0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(11,0.5,'','LRB',0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'Nama Pelapor',0,0,'L');
	$pdf->Cell(4.5,0.5,': '.ucfirst($dt['NamaLengkapPelapor']),0,1,'L'); //data
	
	$pdf->Cell(7,0.5,'Hubungan dengan mati : '.$dt['HubunganJenazah'],0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(11,0.5,'',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'Hubungan dengan mati : '.$dt['HubunganJenazah'],0,0,'L'); //data
	
	$pdf->Cell(7,0.5,'',0,0,'R'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(10,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'',0,1,'R');
	
	$pdf->Ln();
	$tglini=tgl_indo(date("Y m d"));
	$kelurahan =mysql_query("SELECT KelurahanID,NamaKelurahan FROM tblkelurahan where KelurahanID='$_SESSION[kelurahan]'");
	$kel 		=mysql_fetch_array($kelurahan);
	$pdf->Cell(7,0.5,$kel['NamaKelurahan'].",".$tglini,0,0,'R'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(10,0.5,$kel['NamaKelurahan'].",".$tglini,0,0,'R');
	$pdf->Cell(1,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,$kel['NamaKelurahan'].",".$tglini,0,0,'R');
	$pdf->Cell(1,0.5,'',0,1,'R');
	
	$pdf->Cell(7,0.5,'KEPALA DESA '.strtoupper($kel['NamaKelurahan']),0,0,'C'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(10,0.5,'KEPALA DESA '.strtoupper($kel['NamaKelurahan']),0,0,'R');
	$pdf->Cell(1,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,'KEPALA DESA '.strtoupper($kel['NamaKelurahan']),0,0,'C');
	$pdf->Cell(1,0.5,'',0,1,'R');
	
	$pdf->Cell(7,0.5,'',0,0,'R'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(10,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'',0,1,'R');
	
	$pdf->Cell(7,0.5,'',0,0,'R'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(10,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'',0,1,'R');


	$kepaladesa = mysql_query("SELECT id_pejabat,nip,nama_pejabat,jabatan FROM tblpejabat where jabatan='$dt[tanda_tangan]'");
	$kpl 		= mysql_fetch_array($kepaladesa);
	
	$pdf->SetFont('Times','U','9');
	$pdf->Cell(7,0.5,strtoupper($kpl['nama_pejabat']),0,0,'C'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,'',0,0,'R');
	$pdf->Cell(4.5,0.5,strtoupper($kpl['nama_pejabat']),0,0,'C'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,strtoupper($kpl['nama_pejabat']),0,0,'C');//data
	$pdf->Cell(1,0.5,'',0,1,'R');
	$pdf->SetFont('Times','','9');
	$pdf->Cell(7,0.5,'NIP. '.$kpl['nip'],0,0,'C'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,'',0,0,'R');
	$pdf->Cell(4.5,0.5,'NIP. '.$kpl['nip'],0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,'NIP. '.$kpl['nip'],0,1,'C');
	
	$pdf->Ln();
	$pdf->output("Surat Kematian","I");
?>
		