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
	
		$this->SetFont('Times','BU','10');
		$this->Cell(1,0.5,'',0,1,'L');
		$this->Ln();
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
	$pdf->SetXY(1,2.5);
	
	$id = $_GET['id'];
	
	$data_kelahiran= mysql_query("SELECT * FROM tblkelahiran where no_kelahiran='$id'");
	$dt= mysql_fetch_array($data_kelahiran);
	$kabkota = mysql_query("SELECT  SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID FROM tblkabkota where KabKotaID='$dt[TempatKelahiran]'");
	$kab	 = mysql_fetch_array($kabkota);
	$kecamatan=mysql_query("SELECT NamaKecamatan,KecamatanID,KabKotaID FROM tblkecamatan where KabKotaID='$kab[KabKotaID]'");
	$kec	 = mysql_fetch_array($kecamatan);
	
	
	$aktifitas="User $_SESSION[username] Melakukan Cetak Data Kelahiran Nomer $dt[no_kelahiran] Bayi $dt[NamaBayi]";
				include"../key_log.php";

	$pdf->SetFont('Times','I','9');
	$pdf->Cell(1,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'Simpedes',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6,0.5,'',0,0,'L');
	$pdf->Cell(5,0.5,'Simpedes',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'Simpedes','TLR',1,'R');
	
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(7,0.5,'',0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(11,0.5,'SURAT KELAHIRAN',0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'','LR',1,'C');
	
	$pdf->Cell(7,0.5,'SURAT KELAHIRAN',0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->SetFont('Times','','9');
	$pdf->Cell(11,0.5,'No:'.strtoupper($dt['no_kelahiran']),0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(7.5,0.5,'SURAT KELAHIRAN','LR',1,'C');
	
	$pdf->SetFont('Times','','9');
	$pdf->Cell(7,0.5,'No:'.strtoupper($dt['no_kelahiran']),0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(11,0.5,'',0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'No:'.strtoupper($dt['no_kelahiran']),'LR',1,'C');
	
	$pdf->Cell(7,0.5,'',0,0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'1. Nama Lengkap','TL',0,'L');
	$pdf->Cell(8,0.5,': '.strtoupper($dt['NamaBayi']),'TR',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'','LR',1,'C');
	
	$pdf->Cell(0.5,0.5,'',0,0,'C');
	$pdf->Cell(6.5,0.5,'Yang bertanda tangan dibawah ini menerangkan',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'2. Jenis Kelamin','L',0,'L');
	if($dt['JKelBayi']== 0){
	$pdf->Cell(8,0.5,': Laki-Laki','R',0,'L'); //data
	}else{
	$pdf->Cell(8,0.5,': Perempuan','R',0,'L'); //data
	}
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(0.5,0.5,'','L',0,'L');
	$pdf->Cell(7,0.5,'Yang bertanda tangan dibawah ini menerangkan','R',1,'L');
	
	$pdf->Cell(7,0.5,'bahwa :',0,0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'3. Dilahirkan','L',0,'L');
	$tgl_lahir =tgl_indo($dt['TglLahir']);
	$pdf->Cell(8,0.5,': '.$tgl_lahir,'R',0,'L');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'bahwa :','LR',1,'L');
	
	$hari=hari($dt['TglLahir']);
	$pdf->Cell(1.5,0.5,'Hari',0,0,'L');
	$pdf->Cell(5.5,0.5,': '.$hari,0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'4. Kelahiran','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dt['JKelahiran'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'Hari','L',0,'L');
	$pdf->Cell(6,0.5,': '.$hari,'R',1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'Tanggal',0,0,'L');
	$pdf->Cell(5.5,0.5,': '.$tgl_lahir,0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(4,0.5,'Jika kembar, anak ini lahir yang ke : ','L',0,'L');
	$pdf->Cell(7,0.5,'','R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'Tanggal','L',0,'L');
	$pdf->Cell(6,0.5,': '.$tgl_lahir,'R',1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'Di',0,0,'L');
	$pdf->Cell(5.5,0.5,': '.$dt['TempatDilahirkan'],0,0,'L'); //datadusun
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'5. Tempat Kelahiran ','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dt['TempatDilahirkan'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'Di ','L',0,'L');
	$pdf->Cell(6,0.5,': '.$dt['TempatDilahirkan'],'R',1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'',0,0,'L');
	$pdf->Cell(5.5,0.5,'Desa '.strtoupper($dt['Dusun']),0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'','L',0,'L');
	$pdf->Cell(4,0.5,'Desa :'.$dt['Dusun'],0,0,'L'); //data
	$pdf->Cell(4,0.5,'Kec :'.$kec['NamaKecamatan'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'','L',0,'L');
	$pdf->Cell(6,0.5,'Desa '.strtoupper($dt['Dusun']),'R',1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'',0,0,'L');
	$pdf->Cell(5.5,0.5,'Kec '.$kec['NamaKecamatan'],0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'','L',0,'L');
	$pdf->Cell(8,0.5,'Kab/Kota :'.$kab['NamaKabKota'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'','L',0,'L');
	$pdf->Cell(6,0.5,'Kec '.$kec['NamaKecamatan'],'R',1,'L'); //data
	
	if($dt['JKelBayi']== 0){
	$pdf->Cell(7,0.5,'Telah Lahir seorang anak : Laki-Laki',0,0,'L'); //data
	}else{
	$pdf->Cell(7,0.5,'Telah Lahir seorang anak : Perempuan',0,0,'L'); //data
	}
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'6. Penolong Kelahiran','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dt['PenolongKelahiran'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	if($dt['JKelBayi']== 0){
	$pdf->Cell(7.5,0.5,'Telah Lahir seorang anak : Laki-Laki','LR',1,'L'); //data
	}else{
	$pdf->Cell(7.5,0.5,'Telah Lahir seorang anak : Perempuan','LR',1,'L'); //data
	}
	
	$pdf->Cell(7,0.5,'Nama Bayi : '.strtoupper($dt['NamaBayi']),0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(11,0.5,' ','LR',0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->SetFont('Times','','9');
	$pdf->Cell(7.5,0.5,'Nama Bayi : '.strtoupper($dt['NamaBayi']),'LR',1,'L'); //data

	$pdf->Cell(7,0.5,'Dari seorang ibu bernama :',0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(11,0.5,'I B U ','LR',0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->SetFont('Times','','9');
	$pdf->Cell(7.5,0.5,'Dari seorang ibu bernama :','LR',1,'L'); //data
	
	$data_ibu 	=mysql_query("SELECT NoIdentitas,NamaLengkap,Jalan,TempatLahir FROM tblpenduduk where NoIdentitas='$dt[nik_ibu]'");
	$ibu 		=mysql_fetch_array($data_ibu);
	$kabkotaibu = mysql_query("SELECT  SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID FROM tblkabkota where KabKotaID='$ibu[TempatLahir]'");
	$kibu	 = mysql_fetch_array($kabkotaibu);
	$pdf->Cell(7,0.5,strtoupper($ibu['NamaLengkap']),0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'7. Nama Lengkap','L',0,'L');
	$pdf->Cell(8,0.5,': '.strtoupper($ibu['NamaLengkap']),'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|','',0,'C');
	$pdf->Cell(6,0.5,strtoupper($ibu['NamaLengkap']),'L',0,'L'); //data
	$pdf->Cell(1.5,0.5,'','R',1,'L'); 
	
	$pdf->Cell(1.5,0.5,'Alamat',0,0,'L'); 
	$pdf->Cell(5.5,0.5,': '.ucfirst($ibu['Jalan']),0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'8. Alamat','L',0,'L');
	$pdf->Cell(8,0.5,': '.ucfirst($ibu['Jalan']),'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'Alamat','L',0,'L'); 
	$pdf->Cell(6,0.5,': '.ucfirst($ibu['Jalan']),'R',1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'',0,0,'L'); 
	$pdf->Cell(5.5,0.5,'',0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'9. Dilahirkan di','L',0,'L');
	$pdf->Cell(8,0.5,': '.$kibu['NamaKabKota'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'','L',0,'L'); 
	$pdf->Cell(6,0.5,'','R',1,'L'); //data
	
	$pdf->Cell(1.5,0.5,'',0,0,'L'); 
	$pdf->Cell(5.5,0.5,' ',0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'10. Kewarganegaraan','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dt['kebangsaan_ibu'],'R',0,'L'); //data,
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(1.5,0.5,'','L',0,'L'); 
	$pdf->Cell(6,0.5,' ','R',1,'L'); //data
	
	$data_ayah 	=mysql_query("SELECT NoIdentitas,NamaLengkap,NoKK,Jalan,TempatLahir FROM tblpenduduk where NoIdentitas='$dt[nik_ayah]'");
	$ayah 		=mysql_fetch_array($data_ayah);
	$kabkotaayah = mysql_query("SELECT  SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID FROM tblkabkota where KabKotaID='$ayah[TempatLahir]'");
	$kayah	 = mysql_fetch_array($kabkotaayah);
	$pdf->Cell(1.5,0.5,'Istri dari',0,0,'L'); 
	$pdf->Cell(5.5,0.5,': '.strtoupper($ayah['NamaLengkap']),0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->SetFont('Times','BU','9');
	$pdf->Cell(11,0.5,'A Y A H','LR',0,'C');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->SetFont('Times','','9');
	$pdf->Cell(1.5,0.5,'Istri dari','L',0,'L'); 
	$pdf->Cell(6,0.5,': '.strtoupper($ayah['NamaLengkap']),'R',1,'L'); //data
	
	$pdf->Cell(7,0.5,'Surat keterangan ini dibuat atas dasar yang ',0,0,'L'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'11. Nama Lengkap','L',0,'L');
	$pdf->Cell(8,0.5,': '.strtoupper($ayah['NamaLengkap']),'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'Surat keterangan ini dibuat atas dasar yang ','LR',1,'L'); 
	
	$pdf->Cell(7,0.5,'sebenarnya',0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'12. Dilahirkan di','L',0,'L');
	$pdf->Cell(8,0.5,': '.$kayah['NamaKabKota'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'sebenarnya','LR',1,'L'); //data
	
	$pdf->Cell(7,0.5,'',0,0,'L'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'13. Kewarganegaraan','L',0,'L');
	$pdf->Cell(8,0.5,': '.$dt['kebangsaan_ayah'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'','LR',1,'L'); 
	
	$pelapor 	=mysql_query("SELECT NoIdentitas,NoKK,NamaLengkap,Jalan,TempatLahir FROM tblpenduduk where NoIdentitas='$dt[nik_pelapor]'");
	$plp 		=mysql_fetch_array($pelapor);
	$pdf->Cell(7,0.5,'Nama Pelapor : '.strtoupper($plp['NamaLengkap']),0,0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'14. No Kartu Keluarga','L',0,'L');
	$pdf->Cell(8,0.5,': '.$plp['NoKK'],'R',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'Nama Pelapor : '.strtoupper($plp['NamaLengkap']),'LR',1,'L');  //data
	
	$pdf->Cell(7,0.5,'Hubungan dengan bayi : '.ucfirst($dt['hubungan_bayi']),0,0,'L'); //data 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(3,0.5,'15. No KTP','LB',0,'L');
	$pdf->Cell(8,0.5,': '.$plp['NoIdentitas'],'RB',0,'L'); //data
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(7.5,0.5,'Hubungan dengan bayi : '.ucfirst($dt['hubungan_bayi']),'LR',1,'L'); //data
	
	$pdf->Cell(7,0.5,'',0,0,'R'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(10,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,'','L',0,'R');
	$pdf->Cell(1,0.5,'','R',1,'R');
	
	$tglini=tgl_indo(date("Y m d"));
	$kelurahan =mysql_query("SELECT KelurahanID,NamaKelurahan FROM tblkelurahan where KelurahanID='$_SESSION[kelurahan]'");
	$kel 		=mysql_fetch_array($kelurahan);
	$pdf->Cell(7,0.5,$kel['NamaKelurahan'].",".$tglini,0,0,'R'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(10,0.5,$kel['NamaKelurahan'].",".$tglini,0,0,'R');
	$pdf->Cell(1,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,$kel['NamaKelurahan'].",".$tglini,'L',0,'R');
	$pdf->Cell(1,0.5,'','R',1,'R');
	
	$pdf->Cell(7,0.5,'KEPALA DESA '.strtoupper($kel['NamaKelurahan']),0,0,'C'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(10,0.5,'KEPALA DESA '.strtoupper($kel['NamaKelurahan']),0,0,'R');
	$pdf->Cell(1,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,'KEPALA DESA '.strtoupper($kel['NamaKelurahan']),'L',0,'C');
	$pdf->Cell(1,0.5,'','R',1,'R');
	
	$pdf->Cell(7,0.5,'',0,0,'R'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(10,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,'','L',0,'R');
	$pdf->Cell(1,0.5,'','R',1,'R');
	
	$pdf->Cell(7,0.5,'',0,0,'R'); 
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(10,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'',0,0,'R');
	$pdf->Cell(1,0.5,'|',0,0,'C');
	$pdf->Cell(6.5,0.5,'','L',0,'R');
	$pdf->Cell(1,0.5,'','R',1,'R');
	
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
	$pdf->output("Surat Kelahiran","I");
?>
		