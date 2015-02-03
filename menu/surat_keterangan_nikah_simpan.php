<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
date_default_timezone_set("Asia/Jakarta");

echo"<div class='box box-solid box-danger'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Informasi</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-danger btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";
								
	// $tahun 		=date("Y");
	// $bulan 		=date("m");
	// $nomor = mysql_query ("SELECT MAX(SUBSTR(no_kelahiran,1,4)) as no_kelahiran from tblkelahiran");
	// $no 	= mysql_fetch_assoc($nomor);
	// $kode 		= $no['no_kelahiran'];
	// $kode++;
	// $no_kelahiran 	= sprintf("LHR/%04s",$kode)."/".$bulan."/".$tahun;

	$SuratKeteranganNikah 	= $_POST['no_surat_nikah'];
	//Suami
	$NoIdentitasCalonSuami	=$_POST['NoIdentitasCalonSuami'];
	$NamaCalonSuami			=$_POST['NamaCalonSuami'];
	$TempatLahirCalonSuami	=$_POST['TempatLahirCalonSuami'];
	$TanggalLahirCalonSuami	=$_POST['TanggalLahirCalonSuami'];
	$KewarganegaraanCalonSuami	=$_POST['KewarganegaraanCalonSuami'];
	$AgamaCalonSuami		=$_POST['AgamaCalonSuami'];
	$PekerjaanCalonSuami 	=$_POST['PekerjaanCalonSuami'];
	$JalanCalonSuami		=$_POST['JalanCalonSuami'];
	$RTCalonSuami 			=$_POST['RTCalonSuami'];
	$RWCalonSuami			=$_POST['RWCalonSuami'];
	$KelurahanCalonSuami	=$_POST['KelurahanCalonSuami'];
	$KecamatanCalonSuami 	=$_POST['KecamatanCalonSuami'];
	$KabupatenCalonSuami 	=$_POST['KabupatenCalonSuami'];
	$ProvinsiCalonSuami 	=$_POST['ProvinsiCalonSuami'];
	$StatusPerkawinanSuami	=$_POST['StatusPerkawinanSuami'];
	//Istri
	$NoIdentitasCalonIstri	=$_POST['NoIdentitasCalonIstri'];
	$NamaCalonIstri			=$_POST['NamaCalonIstri'];
	$TempatLahirCalonIstri	=$_POST['TempatLahirCalonIstri'];
	$TanggalLahirCalonIstri	=$_POST['TanggalLahirCalonIstri'];
	$KewarganegaraanCalonIstri=$_POST['KewarganegaraanCalonIstri'];
	$AgamaCalonIstri		=$_POST['AgamaCalonIstri'];
	$PekerjaanCalonIstri 	=$_POST['PekerjaanCalonIstri'];
	$JalanCalonIstri		=$_POST['JalanCalonIstri'];
	$RTCalonIstri 			=$_POST['RTCalonIstri'];
	$RWCalonIstri			=$_POST['RWCalonIstri'];
	$KelurahanCalonIstri	=$_POST['KelurahanCalonIstri'];
	$KecamatanCalonIstri 	=$_POST['KecamatanCalonIstri'];
	$KabupatenCalonIstri 	=$_POST['KabupatenCalonIstri'];
	$ProvinsiCalonIstri 	=$_POST['ProvinsiCalonIstri'];
	$StatusPerkawinanIstri	=$_POST['StatusPerkawinanIstri'];
	
	$TanggalSurat			=date("Y-m-d H:i:s");
	$TanggalPernikahan		=$_POST['TanggalPernikahan'];
	$JamPernikahan			=$_POST['JamPernikahan'];
	$Maskawin				=$_POST['Maskawin'];
	$TunaiHutang			=$_POST['TunaiHutang'];
	$tanda_tangan			="Kepala Desa";
	$KelurahanID			=$_SESSION['kelurahan'];
	
	$cek_data	= mysql_query ("SELECT * FROM tblsuratketerangannikah where SuratKeteranganNikah='$SuratKeteranganNikah'");
	$cek			= mysql_fetch_array($cek_data);
	if($cek > 0)
	{
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>No Surat Nikah Telah digunakan silahkan cek kembali</b></p>
		<center><form method='POST' action='media.php?mn=surat_keterangan_nikah_input' class='form-horizontal'>";
		echo"<center><button type='submit' class='btn btn-primary'>Kembali</button>";
		echo"</form></center>";
		//$hal="?mn=input_data_kelahiran";
		//echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
	}
	else
	{
	$data = mysql_query("INSERT INTO tblsuratketerangannikah (SuratKeteranganNikah,
																		NoIdentitasCalonIstri,
																		NamaCalonIstri,
																		TempatLahirCalonIstri,

																		TanggalLahirCalonIstri,
																		KewarganegaraanCalonIstri,
																		AgamaCalonIstri,
																		PekerjaanCalonIstri,

																		JalanCalonIstri,
																		RTCalonIstri,
																		RWCalonIstri,
																		KelurahanCalonIstri,

																		KecamatanCalonIstri,
																		KabupatenCalonIstri,
																		ProvinsiCalonIstri,
																		StatusPerkawinanIstri,

																		NoIdentitasCalonSuami,
																		NamaCalonSuami,
																		TempatLahirCalonSuami,
																		TanggalLahirCalonSuami,

																		KewarganegaraanCalonSuami,
																		AgamaCalonSuami,
																		PekerjaanCalonSuami,
																		JalanCalonSuami,

																		RTCalonSuami,
																		RWCalonSuami,
																		KelurahanCalonSuami,
																		KecamatanCalonSuami,

																		KabupatenCalonSuami,
																		ProvinsiCalonSuami,
																		StatusPerkawinanSuami,
																		TanggalSurat,

																		TanggalPernikahan,
																		JamPernikahan,
																		Maskawin,
																		TunaiHutang,

																		tanda_tangan,
																		KelurahanID)
																values('$SuratKeteranganNikah',
																		'$NoIdentitasCalonIstri',
																		'$NamaCalonIstri',
																		'$TempatLahirCalonIstri',

																		'$TanggalLahirCalonIstri',
																		'$KewarganegaraanCalonIstri',
																		'$AgamaCalonIstri',
																		'$PekerjaanCalonIstri',

																		'$JalanCalonIstri',
																		'$RTCalonIstri',
																		'$RWCalonIstri',
																		'$KelurahanCalonIstri',

																		'$KecamatanCalonIstri',
																		'$KabupatenCalonIstri',
																		'$ProvinsiCalonIstri',
																		'$StatusPerkawinanIstri',

																		'$NoIdentitasCalonSuami',
																		'$NamaCalonSuami',
																		'$TempatLahirCalonSuami',
																		'$TanggalLahirCalonSuami',

																		'$KewarganegaraanCalonSuami',
																		'$AgamaCalonSuami',
																		'$PekerjaanCalonSuami',
																		'$JalanCalonSuami',

																		'$RTCalonSuami',
																		'$RWCalonSuami',
																		'$KelurahanCalonSuami',
																		'$KecamatanCalonSuami',

																		'$KabupatenCalonSuami',
																		'$ProvinsiCalonSuami',
																		'$StatusPerkawinanSuami',
																		'$TanggalSurat',

																		'$TanggalPernikahan',
																		'$JamPernikahan',
																		'$Maskawin',
																		'$TunaiHutang',

																		'$tanda_tangan',
																		'$KelurahanID')") or die (mysql_error());
		
		
																
		$aktifitas="User $_SESSION[username] Melakukan Penginputan Data Surat Nikah Nomer $SuratKeteranganNikah Nama Calon $NamaCalonSuami & $NamaCalonIstri";
				include"key_log.php";

		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Proses Permohonan Data Pernikahan Nama Calon <u>$NamaCalonSuami & $NamaCalonIstri</u> berhasil di proses</b></p>";
		$hal="?mn=surat_keterangan_nikah_input";
		echo"<br><center><a href='Print/surat_persetujuan_menikah.php?id=$SuratKeteranganNikah' target='_blank'>
			<button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-print'> Cetak</span></button></a></center>
		<form method='POST' action='media.php?mn=surat_keterangan_nikah_input' class='form-horizontal'>";
		echo"<center><button type='submit' class='btn btn-primary'>Kembali</button>";
		echo"</form></center>";

		//echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
	
	}		
echo"</div></div>";
?>


