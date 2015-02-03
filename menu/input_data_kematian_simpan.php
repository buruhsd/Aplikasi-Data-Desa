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
	// $nomor = mysql_query ("SELECT MAX(SUBSTR(NoSuratKematian,5,4)) as NoSuratKematian from tblkematian");
	// $no 	= mysql_fetch_assoc($nomor);
	// $kode 		= $no['NoSuratKematian'];
	// $kode++;
	//$NoSuratKematian 	= sprintf("MAT/%04s",$kode)."/".$bulan."/".$tahun;

$no_kematian		= $_POST['no_kematian'];
$TanggalSurat		=date("Y-m-d");
$NoKK				=$_POST['no_kk'];
$NamaKepalaKeluarga	=$_POST['nama_KK'];
$NIK_Jenazah		=$_POST['NoIdentitasJenazah'];
$NamaLengkapJenazah	=$_POST['NamaLengkapJenazah'];
$JenisKelaminJenazah=$_POST['JenisKelamin'];
$TanggalLahirJenazah=$_POST['TanggalLahirJenazah'];
$Umur				=$_POST['UmurJenazah'];
$TempatLahirIDJenazah	=$_POST['TempatLahirIDJenazah'];
$AgamaIDJenazah		=$_POST['AgamaIDJenazah'];
$PekerjaanIDJenazah	=$_POST['PekerjaanJenazah'];
$AlamatJenazah		=$_POST['AlamatJenazah'];
$KewarganegaraanJenazah=$_POST['KewarganegaraanJenazah'];
$KeturunanIDJenazah	=$_POST['keturunanJenazah'];
$KebangsaanIDJenazah=$_POST['kebangsaanJenazah'];
$TglKematianJenazah	=$_POST['tgl_kematian'];
$jam 				=$_POST['jam'];
$menit 				=$_POST['menit'];
$JamKematianJenazah	=$jam.":".$menit.":00";
$SebabKematianIDJenazah	=$_POST['sebab_kematian'];
$TempatKematianJenazah	=$_POST['TempatKematianJenazah'];
$YangMenerangkanKematian=$_POST['YangMenerangkanKematian'];
$NIK_Pelapor		=$_POST['nik_pelapor'];
$NamaLengkapPelapor	=$_POST['nama_pelapor'];
$hubungan			=$_POST['hubungan'];
$tanda_tangan 		= 'Kepala Desa';
$tanggalini 		=date("Y-m-d H:i:s");
$NIK_Saksi1 		=$_POST['NIK_Saksi1'];
$NamaLengkapSaksi1	=$_POST['NamaLengkapSaksi1'];
$NIK_Saksi2 		=$_POST['NIK_Saksi2'];
$NamaLengkapSaksi2 	=$_POST['NamaLengkapSaksi2'];
$AnakKeJenazah 		=$_POST['AnakKeJenazah'];

$cek_kematian	= mysql_query ("SELECT * FROM tblkematian where NoSuratKematian='$no_kematian' OR NIK_Jenazah='$NIK_Jenazah'");
	$cek			= mysql_fetch_array($cek_kematian);
	if($cek > 0)
	{
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>No Surat Kematian Telah digunakan Atau Nama Jenazah telah di buatkan surat kematian silahkan cek kembali</b></p>";
		//$hal="?mn=input_data_kelahiran";
		//echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
	}
	else
	{

$data = mysql_query("INSERT INTO tblkematian (NoSuratKematian,
												TanggalSurat,
												NoKK,
												NamaKepalaKeluarga,
												
												NIK_Jenazah,
												NamaLengkapJenazah,
												JenisKelaminJenazah,
												TanggalLahirJenazah,
												
												Umur,
												TempatLahirIDJenazah,
												AgamaIDJenazah,
												PekerjaanIDJenazah,
												
												AlamatJenazah,
												KewarganegaraanJenazah,
												KeturunanIDJenazah,
												KebangsaanIDJenazah,
												
												TglKematianJenazah,
												JamKematianJenazah,
												SebabKematianIDJenazah,
												TempatKematianJenazah,
												
												YangMenerangkanKematian,
												NIK_Pelapor,
												NamaLengkapPelapor,
												HubunganJenazah,
												tanda_tangan,
												TanggalEntry,
												KelurahanID,

												NIK_Ayah,
												NamaLengkapAyah,
												TanggalLahirAyah,
												PekerjaanIDAyah,
												AlamatAyah,
												KelurahanIDAyah,

												NIK_Ibu,
												NamaLengkapIbu,
												TanggalLahirIbu,
												PekerjaanIbu,
												AlamatIbu,
												KelurahanIDIbu,

												NIK_Saksi1,
												NamaLengkapSaksi1,
												NIK_Saksi2,
												NamaLengkapSaksi2,
												AnakKeJenazah)
									values ('$no_kematian',
											'$TanggalSurat',
											'$NoKK',
											'$NamaKepalaKeluarga',
											
											'$NIK_Jenazah',
											'$NamaLengkapJenazah',
											'$JenisKelaminJenazah',
											'$TanggalLahirJenazah',
											
											'$Umur',
											'$TempatLahirIDJenazah',
											'$AgamaIDJenazah',
											'$PekerjaanIDJenazah',
											
											'$AlamatJenazah',
											'$KewarganegaraanJenazah',
											'$KeturunanIDJenazah',
											'$KebangsaanIDJenazah',
											
											'$TglKematianJenazah',
											'$JamKematianJenazah',
											'$SebabKematianIDJenazah',
											'$TempatKematianJenazah',
											
											'$YangMenerangkanKematian',
											'$NIK_Pelapor',
											'$NamaLengkapPelapor',
											'$hubungan',
											'$tanda_tangan',
											'$tanggalini',
											'$_SESSION[kelurahan]',

											'$_POST[NIK_Ayah]',
											'$_POST[NamaLengkapAyah]',
											'$_POST[TanggalLahirAyah]',
											'$_POST[PekerjaanIDAyah]',
											'$_POST[AlamatAyah]',
											'$_POST[KelurahanIDAyah]',

											'$_POST[NIK_Ibu]',
											'$_POST[NamaLengkapIbu]',
											'$_POST[TanggalLahirIbu]',
											'$_POST[PekerjaanIbu]',
											'$_POST[AlamatIbu]',
											'$_POST[KelurahanIbu]',

											'$NIK_Saksi1',
											'$NamaLengkapSaksi1',
											'$NIK_Saksi2',
											'$NamaLengkapSaksi2',
											'$AnakKeJenazah')") or die (mysql_error());

$status=mysql_query("UPDATE tblpenduduk SET Keterangan 		='mati'
												where NoIdentitas ='$NIK_Jenazah'") or die (mysql_error());
	
$aktifitas="User $_SESSION[username] Melakukan Penginputan Data Kematian Nomer $no_kematian";
				include"key_log.php";
				
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Proses Permohonan Data Kematian Jenazah <u>$NamaLengkapJenazah</u> berhasil di proses</b>";
		$hal="?mn=input_data_kematian";
		echo"<br><p align=center><a href='Print/surat_kematian_new.php?id=$NIK_Jenazah' target='_blank'><button type='submit' class='btn btn-danger'>Cetak Kelurahan</button></a>
		</p><p align=center>
		<a href='Print/surat_kematian.php?id=$NIK_Jenazah' target='_blank'><button type='submit' class='btn btn-danger'>Cetak Warga</button></a></p>
		<form method='POST' action='media.php?mn=input_data_kematian' class='form-horizontal'>
		<form method='POST' action='media.php?mn=input_data_kematian' class='form-horizontal'>";
		echo"<center><button type='submit' class='btn btn-primary'>Kembali</button>";
		echo"</form></center>";
		//echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";		

	}
	
echo"</div></div>";
?>



											
