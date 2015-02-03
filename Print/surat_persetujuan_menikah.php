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
		// $this->Image('grobogan.jpg',2,0.7,2.1);
	
		// $this->SetFont('Times','B','12');
		// $this->Cell(19,0.5,'PEMERINTAH KABUPATEN GROBOGAN',0,1,'C');
		// $this->Cell(19,0.5,'KECAMATAN GROBOGAN',0,1,'C');
		// $this->Cell(19,0.5,'DESA GROBOGAN',0,1,'C');
		// $this->Cell(19,0.5,'Jalan Raya Godong Karangrayung Km 2 Kode Pos 58162',0,1,'C');
		// $this->Ln();
		// $this->Line(1,3.45,19,3.45);
		// $this->Line(1,3.4,19,3.4);
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
	$data_surat =mysql_query("SELECT * FROM tblsuratketerangannikah where SuratKeteranganNikah='$id'");
	$dt 		= mysql_fetch_array($data_surat);

	$penduduksuami 	= mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NoIdentitasCalonSuami]'");
	$psu			= mysql_fetch_array($penduduksuami);
	$pendudukistri 	= mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NoIdentitasCalonIstri]'");
	$pis			= mysql_fetch_array($pendudukistri);

	$kerjasuami	= mysql_query("SELECT NamaPekerjaan,PekerjaanID FROM tblpekerjaan where PekerjaanID='$dt[PekerjaanCalonSuami]'");
	$ksu		=mysql_fetch_array($kerjasuami);
	$kerjaistri	= mysql_query("SELECT NamaPekerjaan,PekerjaanID FROM tblpekerjaan where PekerjaanID='$dt[PekerjaanCalonIstri]'");
	$kis		=mysql_fetch_array($kerjaistri);

	$agamasuami	= mysql_query("SELECT AgamaID,NamaAgama FROM tblagama where AgamaID='$dt[AgamaCalonSuami]'");
	$gsu		=mysql_fetch_array($agamasuami);
	$agamaistri	= mysql_query("SELECT AgamaID,NamaAgama FROM tblagama where AgamaID='$dt[AgamaCalonIstri]'");
	$gis		=mysql_fetch_array($agamaistri);
	
	$provsuami	=mysql_query("SELECT NamaProvinsi,ProvinsiID from tblprovinsi where ProvinsiID='$dt[ProvinsiCalonSuami]'");
	$psi		=mysql_fetch_array($provsuami);
	$provistri	=mysql_query("SELECT NamaProvinsi,ProvinsiID from tblprovinsi where ProvinsiID='$dt[ProvinsiCalonIstri]'");
	$pst			=mysql_fetch_array($provistri);

	$kabsuami	=mysql_query("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$dt[KabupatenCalonSuami]'");
	$kbs		=mysql_fetch_array($kabsuami);
	$kabistri	=mysql_query("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$dt[KabupatenCalonIstri]'");
	$kst		=mysql_fetch_array($kabistri);

	$kecsuami=mysql_query("SELECT NamaKecamatan from tblkecamatan where KecamatanID='$dt[KecamatanCalonSuami]'");
	$csu=mysql_fetch_array($kecsuami);
	$kecistri=mysql_query("SELECT NamaKecamatan from tblkecamatan where KecamatanID='$dt[KecamatanCalonIstri]'");
	$cis=mysql_fetch_array($kecistri);

	$kelsuami=mysql_query("SELECT NamaKelurahan from tblkelurahan where KelurahanID='$dt[KelurahanCalonSuami]'");
	$lsu=mysql_fetch_array($kelsuami);
	$kelistri=mysql_query("SELECT NamaKelurahan from tblkelurahan where KelurahanID='$dt[KelurahanCalonIstri]'");
	$lis=mysql_fetch_array($kelistri);
	

	$kelurahan =mysql_query("SELECT
							tblkabkota.NamaKabKota,
							tblkecamatan.NamaKecamatan,
							tblkelurahan.NamaKelurahan,
							tblkelurahan.KelurahanID
							FROM
							tblkelurahan
							INNER JOIN tblkecamatan ON tblkelurahan.KecamatanID = tblkecamatan.KecamatanID
							INNER JOIN tblkabkota ON tblkecamatan.KabKotaID = tblkabkota.KabKotaID where tblkelurahan.KelurahanID='$_SESSION[kelurahan]'");
								$kl 		=mysql_fetch_array($kelurahan);
	
	//$dusun		=mysql_query("SELECT DusunID,NamaDusun FROM tbldusun where DusunID='$dt[DusunID]'");
	//$dsn		=mysql_fetch_array($dusun);

	$aktifitas="User $_SESSION[username] Melakukan Cetak Surat Pernikahan Nomer $dt[SuratKeteranganNikah] Nama $dt[NamaCalonIstri] dan $dt[NamaCalonSuami]";
				include"../key_log.php";

	$pdf->SetFont('Times','','12');
	$pdf->Cell(4,0.5,'Kantor Desa ',0,0,'L');
	$pdf->Cell(4,0.5,': '.$kl['NamaKelurahan'],0,1,'L');
	$pdf->Cell(4,0.5,'Kecamatan',0,0,'L');
	$pdf->Cell(4,0.5,': '.$kl['NamaKecamatan'],0,1,'L');
	$pdf->Cell(4,0.5,'Kabupaten ',0,0,'L');
	$pdf->Cell(4,0.5,': '.$kl['NamaKabKota'],0,1,'L');
	$pdf->SetFont('Times','BU','12');
	$pdf->Ln();
	$pdf->Cell(19,0.5,'SURAT PERSETUJUAN MEMPELAI',0,1,'C');
	$pdf->SetFont('Times','','11');
	$pdf->Ln();
	$pdf->Cell(19,0.5,'Yang bertanda tangan dibawah ini : ',0,1,'L');
	$pdf->Ln();
	$pdf->Cell(19,0.5,'I. Calon Suami ',0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'1. Nama Lengkap dan Alias ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($dt['NamaCalonSuami']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'2. Bin ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($psu['NamaAyah']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'3. Tempat dan tanggal lahir ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($dt['TempatLahirCalonSuami']).', '.tgl_indo($dt['TanggalLahirCalonSuami']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'4. Kewarganegaraan ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($dt['KewarganegaraanCalonSuami']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'4. Agama ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($gsu['NamaAgama']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'5. Pekerjaan ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($ksu['NamaPekerjaan']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'6. Tempat Tinggal ',0,0,'L');
	$pdf->Cell(13,0.5,' : Desa '.$lsu['NamaKelurahan'].' - Kecamatan '.$csu['NamaKecamatan'],0,1,'L');
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'',0,0,'L');
	$pdf->Cell(13,0.5,' : KAB. '.$kbs['NamaKabKota'].' - '.$psi['NamaProvinsi'],0,1,'L');

	$pdf->Ln();
	$pdf->Cell(19,0.5,'I. Calon Istri ',0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'1. Nama Lengkap dan Alias ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($dt['NamaCalonIstri']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'2. Bin ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($pis['NamaAyah']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'3. Tempat dan tanggal lahir ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($dt['TempatLahirCalonIstri']).', '.tgl_indo($dt['TanggalLahirCalonIstri']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'4. Kewarganegaraan ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($dt['KewarganegaraanCalonIstri']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'4. Agama ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($gis['NamaAgama']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'5. Pekerjaan ',0,0,'L');
	$pdf->Cell(13,0.5,' : '.strtoupper($kis['NamaPekerjaan']),0,1,'L');

	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'6. Tempat Tinggal ',0,0,'L');
	$pdf->Cell(13,0.5,' : Desa '.$lis['NamaKelurahan'].' - Kecamatan '.$cis['NamaKecamatan'],0,1,'L');
	$pdf->Cell(0.5,0.5,'',0,0,'L');
	$pdf->Cell(6,0.5,'',0,0,'L');
	$pdf->Cell(13,0.5,' : KAB. '.$kst['NamaKabKota'].' - '.$pst['NamaProvinsi'],0,1,'L');
	$pdf->Ln();

	$pdf->Cell(19,0.5,'Menyatakan dengan sesungguhnya bahwa atas dasar suka rela, dengan kesadaran sendiri, tanpa paksaan siapapun juga,',0,1,'L');
	$pdf->Cell(19,0.5,'setuju untuk melangsungkan pernikahan.',0,1,'L');
	$pdf->Ln();

	$pdf->Cell(19,0.5,'Demikian surat persetujuan ini dibuat untuk digunakan seperlunya.',0,1,'L');
	$pdf->Ln();

	$tglini=tgl_indo(date("Y m d"));	

	$pdf->Cell(6,0.5,'',0,0,'C');
	$pdf->Cell(6,0.5,'',0,0,'C');
	$pdf->Cell(6,0.5,ucfirst($kl['NamaKelurahan']).", ".$tglini,0,1,'C');

	$pdf->Cell(6,0.5,'',0,0,'C');
	$pdf->Cell(6,0.5,'',0,0,'C');
	$pdf->Cell(6,0.5,'Kepala Desa '.ucfirst($kl['NamaKelurahan']),0,0,'C');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();

	$kepaladesa = mysql_query("SELECT id_pejabat,nip,nama_pejabat,jabatan FROM tblpejabat where jabatan='$dt[tanda_tangan]'");
	$kpl 		= mysql_fetch_array($kepaladesa);
	$pdf->SetFont('Times','BU','11');
	$pdf->Cell(6,0.5,'',0,0,'C');
	$pdf->Cell(6,0.5,'',0,0,'C');
	$pdf->Cell(6,0.5,strtoupper($kpl['nama_pejabat']),0,1,'C');
	$pdf->SetFont('Times','','11');
	$pdf->Cell(6,0.5,'',0,0,'C');
	$pdf->Cell(6,0.5,'',0,0,'C');
	$pdf->Cell(6,0.5,"NIP. ".strtoupper($kpl['nip']),0,1,'C');
	$pdf->Ln();
	
	$pdf->Ln();
	$pdf->output("Surat Permohonan KTP","I");
	
?>