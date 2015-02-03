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
		$this->Image('grobogan.jpg',2,0.7,2.1);
	
		$this->SetFont('Times','B','12');
		$this->Cell(19,0.5,'PEMERINTAH KABUPATEN GROBOGAN',0,1,'C');
		$this->Cell(19,0.5,'KECAMATAN GODONG',0,1,'C');
		$this->Cell(19,0.5,'DESA KEMLOKO',0,1,'C');
		$this->Cell(19,0.5,'Jalan Raya Godong Karangrayung Km 2 Kode Pos 58162',0,1,'C');
		$this->Ln();
		$this->Line(1,3.45,19,3.45);
		$this->Line(1,3.4,19,3.4);
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
								tblpenduduk.KartuID,
								tblpenduduk.DusunID
								FROM
								tblskumum
								LEFT JOIN tblpenduduk ON tblskumum.nik = tblpenduduk.NoIdentitas
								where tblskumum.no_surat='$id'");
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
	$kec=mysql_query("SELECT NamaKecamatan from tblkecamatan where KecamatanID='$dt[KecamatanID]'");
	$c=mysql_fetch_array($kec);
	$kel=mysql_query("SELECT NamaKelurahan from tblkelurahan where KelurahanID='$dt[KelurahanID]'");
	$l=mysql_fetch_array($kel);
	
	
	$dusun		=mysql_query("SELECT DusunID,NamaDusun FROM tbldusun where DusunID='$dt[DusunID]'");
	$dsn		=mysql_fetch_array($dusun);

	$aktifitas="User $_SESSION[username] Melakukan Cetak Surat Keterangan Nomer $dt[no_surat] Nama $dt[NamaLengkap]";
				include"../key_log.php";

	$pdf->SetFont('Times','','10');
	$pdf->Cell(1.7,0.5,'Kode Desa : ',0,1,'L');
	$pdf->Cell(5.3,0.5,$_SESSION['kelurahan'],0,1,'L'); //Kode Desa

	$pdf->SetFont('Times','BU','12');
	$pdf->Cell(19,0.5,'SURAT PENGANTAR KETERANGAN',0,1,'C');
	$pdf->SetFont('Times','B','12');
	$pdf->Cell(7.5,0.5,'Nomor : ',0,0,'R');
	$pdf->Cell(5.5,0.5,strtoupper($dt['no_surat']),'B',1,'L'); //Kode Desa
	$pdf->Ln();

	$pdf->SetFont('Times','','11');
	$pdf->Cell(19,0.5,'Yang bertanda tanda tangan di bawah ini menerangkan bahwa :',0,1,'C');
	$pdf->Ln();

	$pdf->Cell(6,0.5,'1. Nama',0,0,'L');
	$pdf->Cell(10,0.5,':  '.strtoupper($dt['NamaLengkap']),0,0,'L');
	if ($dt['JenisKelamin']==0){
	$pdf->Cell(2,0.5,'Laki-laki',0,1,'R'); //jenis kelamin
	}else{
	$pdf->Cell(2,0.5,'Perempuan',0,1,'R'); //jenis kelamin
	}

	$tgllahir= tgl_indo($dt['TanggalLahir']);
	$pdf->Cell(6,0.5,'2. Tempat & Tanggal Lahir',0,0,'L');
	$pdf->Cell(13,0.5,': '.ucfirst($b['NamaKabKota'])." / ".$tgllahir,0,1,'L'); //data

	$pdf->Cell(6,0.5,'3. Kewarganegaraan & Agama',0,0,'L');
	$pdf->Cell(13,0.5,":  ".ucfirst($ngr['NamaNegara'])." /".ucfirst($agm['NamaAgama']),0,1,'L'); //data

	$pdf->Cell(6,0.5,'4. Pekerjaan',0,0,'L');
	$pdf->Cell(13,0.5,":  ".ucfirst($krj['NamaPekerjaan']),0,1,'L'); //data

	$pdf->Cell(6,0.5,'5. Tempat Tinggal',0,0,'L');
	$pdf->MultiCell(13,0.5,":  Dusun ".ucfirst($dsn['NamaDusun'])." Desa ".ucfirst($l['NamaKelurahan']).", Kec. ".ucfirst($c['NamaKecamatan']),0,'L'); //data
	$pdf->Cell(6,0.5,'',0,0,'L');
	$pdf->Cell(13,0.5,":  Kabupaten ".ucfirst($kb['NamaKabKota'])." Provinsi ".ucfirst($p['NamaProvinsi']),0,1,'L'); //data

	$pdf->Cell(6,0.5,'6. Surat Bukti Diri KTP',0,0,'L');
	$pdf->Cell(6.5,0.5,":  ".ucfirst($dt['NoIdentitas']),0,0,'L'); //data
	$pdf->Cell(6.5,0.5,"KKK No. ".ucfirst($dt['NoKK']),0,1,'L'); //data

	$pdf->Cell(6,0.5,'7. Keperluan',0,0,'L');
	$pdf->MultiCell(13,0.5,":  ".ucfirst($dt['keperluan']),0,'L'); //data

	$pdf->Cell(6,0.5,'8. Berlaku mulai',0,0,'L');
	$pdf->Cell(13,0.5,":  ".tgl_indo($dt['tanggal_awal'])." s/d ".tgl_indo($dt['tanggal_akhir']),0,1,'L'); //data
 
	$pdf->Cell(6,0.5,'9. Keterangan lain-lain*)',0,0,'L');
	$pdf->MultiCell(13,0.5,":  ".ucfirst($dt['keterangan_lain']),0,'L'); //data
	$pdf->Cell(6,0.5,'',0,0,'L');
	$pdf->Cell(13,0.5,'',0,1,'L'); //data
	$pdf->Ln();
	$pdf->Cell(19,0.5,'Demikian untuk menjadikan maklum bagi yang berkepentingan.',0,1,'C');
	$pdf->Cell(7.5,0.5,'Nomor   : ',0,0,'R');
	$pdf->Cell(5.5,0.5,strtoupper($dt['no_surat']),0,1,'L'); //data
	$pdf->Cell(7.5,0.5,'Tanggal : ',0,0,'R');
	$tglini=tgl_indo(date("Y m d"));
	$kelurahan =mysql_query("SELECT KelurahanID,NamaKelurahan FROM tblkelurahan where KelurahanID='$_SESSION[kelurahan]'");
	$kl 		=mysql_fetch_array($kelurahan);

	$pdf->Cell(5.5,0.5,$tglini,0,1,'L'); //data
	$pdf->Ln();

	$pdf->Cell(6,0.5,'Tanda Tangan Pemegang',0,0,'C');
	$pdf->Cell(6,0.5,'Mengetahui,',0,0,'C');
	$pdf->Cell(6,0.5,ucfirst($kl['NamaKelurahan']).", ".$tglini,0,1,'C');

	$pdf->Cell(6,0.5,'',0,0,'C');
	$pdf->Cell(6,0.5,'Camat '.ucfirst($c['NamaKecamatan']),0,0,'C');
	$pdf->Cell(6,0.5,'Kepala Desa '.ucfirst($kl['NamaKelurahan']),0,0,'C');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();

	$kepaladesa = mysql_query("SELECT id_pejabat,nip,nama_pejabat,jabatan FROM tblpejabat where jabatan='$dt[tanda_tangan]'");
	$kpl 		= mysql_fetch_array($kepaladesa);

	$pdf->Cell(1,0.5,"",0,0,'C');
	$pdf->Cell(5,0.5,strtoupper($dt['NamaLengkap']),'B',0,'C');
	$pdf->Cell(1,0.5,"",0,0,'C');
	$pdf->Cell(5,0.5,"",'B',0,'C');
	$pdf->Cell(1,0.5,"",0,0,'C');
	$pdf->Cell(5,0.5,strtoupper($kpl['nama_pejabat']),'B',1,'C');

	$pdf->Cell(1,0.5,"",0,0,'C');
	$pdf->Cell(5,0.5,"",0,0,'L');
	$pdf->Cell(1,0.5,"",0,0,'C');
	$pdf->Cell(5,0.5,"NIP. ",0,0,'L');
	$pdf->Cell(1,0.5,"",0,0,'C');
	$pdf->Cell(5,0.5,"NIP. ".strtoupper($kpl['nip']),0,1,'L');

	$pdf->SetFont('Times','B','8');
	$pdf->Cell(2,0.5,'Catatan *): ',0,0,'R');
	$pdf->SetFont('Times','','8');
	$pdf->Cell(16,0.5,'Apabila ruangan ini tidak mencukupi ,harap ditulis sebaliknya dengan dibubuhi stemepl Desa',0,1,'L');
	$pdf->Ln();
	
	$pdf->Ln();
	$pdf->output("Surat Permohonan KTP","I");
	
?>