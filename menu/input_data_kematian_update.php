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
$id					= $_POST['id'];								
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
$JamKematianJenazah	=$_POST['JamKematianJenazah'];
$SebabKematianIDJenazah	=$_POST['sebab_kematian'];
$TempatKematianJenazah	=$_POST['TempatKematianJenazah'];
$YangMenerangkanKematian=$_POST['YangMenerangkanKematian'];
$NIK_Pelapor		=$_POST['nik_pelapor'];
$NamaLengkapPelapor	=$_POST['nama_pelapor'];
$hubungan			=$_POST['hubungan'];
$tanda_tangan 		='Kepala Desa';
$tanggalini 		=date("Y-m-d H:i:s");

$NIK_Saksi1 		=$_POST['NIK_Saksi1'];
$NamaLengkapSaksi1	=$_POST['NamaLengkapSaksi1'];
$NIK_Saksi2 		=$_POST['NIK_Saksi2'];
$NamaLengkapSaksi2 	=$_POST['NamaLengkapSaksi2'];
$AnakKeJenazah 		=$_POST['AnakKeJenazah'];
																
			$data = mysql_query("update tblkematian SET NoSuratKematian = '$no_kematian',
																TanggalSurat ='$TanggalSurat',
																NoKK ='$NoKK',
																NamaKepalaKeluarga='$NamaKepalaKeluarga',
																
																NIK_Jenazah='$NIK_Jenazah',
																NamaLengkapJenazah='$NamaLengkapJenazah',
																JenisKelaminJenazah='$JenisKelaminJenazah',
																TanggalLahirJenazah='$TanggalLahirJenazah',
																
																Umur='$Umur',
																TempatLahirIDJenazah='$TempatLahirIDJenazah',
																AgamaIDJenazah='$AgamaIDJenazah',
																PekerjaanIDJenazah='$PekerjaanIDJenazah',
																
																AlamatJenazah='$AlamatJenazah',
																KewarganegaraanJenazah='$KewarganegaraanJenazah',
																KeturunanIDJenazah='$KeturunanIDJenazah',
																KebangsaanIDJenazah='$KebangsaanIDJenazah',
																
																TglKematianJenazah='$TglKematianJenazah',
																JamKematianJenazah='$JamKematianJenazah',
																SebabKematianIDJenazah='$SebabKematianIDJenazah',
																TempatKematianJenazah='$TempatKematianJenazah',
																
																YangMenerangkanKematian ='$YangMenerangkanKematian',
																NIK_Pelapor='$NIK_Pelapor',
																NamaLengkapPelapor='$NamaLengkapPelapor',
																HubunganJenazah='$hubungan',
																tanda_tangan='$tanda_tangan ',
																TanggalEntry='$tanggalini',

																NIK_Ayah		='$_POST[NIK_Ayah]',
																NamaLengkapAyah ='$_POST[NamaLengkapAyah]',
																TanggalLahirAyah='$_POST[TanggalLahirAyah]',
																PekerjaanIDAyah	='$_POST[PekerjaanIDAyah]',
																AlamatAyah		='$_POST[AlamatAyah]',
																KelurahanIDAyah	='$_POST[KelurahanIDAyah]',

																NIK_Ibu			='$_POST[NIK_Ibu]',
																NamaLengkapIbu	='$_POST[NamaLengkapIbu]',
																TanggalLahirIbu	='$_POST[TanggalLahirIbu]',
																PekerjaanIbu	='$_POST[PekerjaanIDIbu]',
																AlamatIbu		='$_POST[AlamatIbu]',
																KelurahanIDIbu	='$_POST[KelurahanIbu]',

																NIK_Saksi1		='$NIK_Saksi1',
																NamaLengkapSaksi1='$NamaLengkapSaksi1',
																NIK_Saksi2		='$NIK_Saksi2 ',
																NamaLengkapSaksi2='$NamaLengkapSaksi2',
																AnakKeJenazah	='$AnakKeJenazah'
														where KematianID='$id' ") or die (mysql_error());
		
		$aktifitas="User $_SESSION[username] Melakukan Peng-update-an Data Kematian Nomer $no_kematian";
				include"key_log.php";

		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Proses Permohonan Data Kematian Jenazah <u>$NamaLengkapJenazah</u> berhasil di proses</b>";
		$hal="?mn=data_kematian";
		echo"<br>
		<a href='Print/surat_kematian_new.php?id=$NIK_Jenazah' target='_blank'><button type='submit' class='btn btn-danger'>Cetak Kelurahan</button></a></p>
		
		<p align=center>
		<a href='Print/surat_kematian.php?id=$NIK_Jenazah' target='_blank'><button type='submit' class='btn btn-danger'>Cetak Warga</button></a></p>
		
		<p align=center><form method='POST' action='media.php?mn=data_kematian' class='form-horizontal'>";
		echo"<center><button type='submit' class='btn btn-primary'>Kembali</button>";
		echo"</form></center>";				
		
echo"</div></div>";
?>


