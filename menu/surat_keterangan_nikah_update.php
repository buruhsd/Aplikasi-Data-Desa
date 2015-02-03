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

    $id =$_POST['id'];

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
	
	$data = mysql_query("UPDATE tblsuratketerangannikah SET SuratKeteranganNikah ='$SuratKeteranganNikah',
																		NoIdentitasCalonIstri='$NoIdentitasCalonIstri',
																		NamaCalonIstri='$NamaCalonIstri',
																		TempatLahirCalonIstri='$TempatLahirCalonIstri',

																		TanggalLahirCalonIstri ='$TanggalLahirCalonIstri',
																		KewarganegaraanCalonIstri='$KewarganegaraanCalonIstri',
																		AgamaCalonIstri='$AgamaCalonIstri',
																		PekerjaanCalonIstri='$PekerjaanCalonIstri',

																		JalanCalonIstri='$JalanCalonIstri',
																		RTCalonIstri='$RTCalonIstri',
																		RWCalonIstri='$RWCalonIstri',
																		KelurahanCalonIstri='$KelurahanCalonIstri',

																		KecamatanCalonIstri='$KecamatanCalonIstri',
																		KabupatenCalonIstri='$KabupatenCalonIstri',
																		ProvinsiCalonIstri='$ProvinsiCalonIstri',
																		StatusPerkawinanIstri='$StatusPerkawinanIstri',

																		NoIdentitasCalonSuami='$NoIdentitasCalonSuami',
																		NamaCalonSuami='$NamaCalonSuami',
																		TempatLahirCalonSuami='$TempatLahirCalonSuami',
																		TanggalLahirCalonSuami='$TanggalLahirCalonSuami',

																		KewarganegaraanCalonSuami='$KewarganegaraanCalonSuami',
																		AgamaCalonSuami='$AgamaCalonSuami',
																		PekerjaanCalonSuami='$PekerjaanCalonSuami',
																		JalanCalonSuami='$JalanCalonSuami',

																		RTCalonSuami='$RTCalonSuami',
																		RWCalonSuami='$RWCalonSuami',
																		KelurahanCalonSuami='$KelurahanCalonSuami',
																		KecamatanCalonSuami='$KecamatanCalonSuami',

																		KabupatenCalonSuami='$KabupatenCalonSuami',
																		ProvinsiCalonSuami='$ProvinsiCalonSuami',
																		StatusPerkawinanSuami='$StatusPerkawinanSuami',
																		TanggalSurat='$TanggalSurat',

																		TanggalPernikahan='$TanggalPernikahan',
																		JamPernikahan='$JamPernikahan',
																		Maskawin='$Maskawin',
																		TunaiHutang='$TunaiHutang',

																		tanda_tangan='$tanda_tangan',
																		KelurahanID='$KelurahanID' where SuratKeteranganNikahID='$id'") or die (mysql_error());
		
		
		$aktifitas="User $_SESSION[username] Melakukan Peng-update-an Data Surat Nikah Nomer $SuratKeteranganNikah Nama Calon $NamaCalonSuami & $NamaCalonIstri";
				include"key_log.php";

		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Proses Permohonan Data Pernikahan Nama Calon <u>$NamaCalonSuami & $NamaCalonIstri</u> berhasil di Update</b></p>";
		$hal="?mn=data_surat_nikah";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
			
echo"</div></div>";
?>


