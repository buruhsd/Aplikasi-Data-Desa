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
								
	$id 			=$_POST['id'];							
	$no_kelahiran 	=$_POST['no_kelahiran'] ;
								
	$no_kk			=$_POST['no_kk'];
	$NamaKK			=$_POST['nama_KK'];
	//bayi
	$nama_bayi		=$_POST['nama_bayi'];
	$kelamin		=$_POST['kelamin'];
	$tempat_dilahirkan=$_POST['tempat_dilahirkan'];
	$tmp_lahir		=$_POST['tmp_lahir'];
	$tgl_lahir		=$_POST['tgl_lahir'];
	$jenis_kelahiran=$_POST['jenis_kelahiran'];
	$anak_ke 		=$_POST['anak_ke'];
	$penolong		=$_POST['penolong'];
	$berat_bayi		=$_POST['berat_bayi'];
	$Pukul 			=$_POST['pukul'];
	$dusun			=$_POST['dusun'];
	//ibu
	$nik_ibu		=$_POST['nik_ibu'];
	$nama_ibu		=$_POST['nama_ibu'];
	$tgl_kelahiran_ibu=$_POST['tgl_kelahiran_ibu'];
	$umur_ibu		=$_POST['umur_ibu'];
	$pekerjaan_ibu	=$_POST['pekerjaan_ibu'];
	$alamat_ibu		=$_POST['alamat_ibu'];
	$kelurahan_ibu	=$_POST['kelurahan_ibu'];
	$keturunan_ibu	=$_POST['keturunan_ibu'];
	$kebangsaan_ibu	=$_POST['kebangsaan_ibu'];
	$tgl_perkawinan=$_POST['tgl_perkawinan'];
	//ayah
	$nik_ayah		=$_POST['nik_ayah'];
	$nama_ayah		=$_POST['nama_ayah'];
	$tgl_kelahiran_ayah=$_POST['tgl_kelahiran_ayah'];
	$umur_ayah		=$_POST['umur_ayah'];
	$pekerjaan_ayah	=$_POST['pekerjaan_ayah'];
	$alamat_ayah		=$_POST['alamat_ayah'];
	$kelurahan_ayah	=$_POST['kelurahan_ayah'];
	$keturunan_ayah	=$_POST['keturunan_ayah'];
	$kebangsaan_ayah=$_POST['kebangsaan_ayah'];
	//pelapor
	$nik_pelapor	=$_POST['nik_pelapor'];
	$nama_pelapor	=$_POST['nama_pelapor'];
	//saksi1
	$NikSaksi1		=$_POST['nik_saksi1'];
	//$nama_saksi1	=$_POST['nama_saksi1'];
	//saksi2
	$NikSaksi2		=$_POST['nik_saksi2'];
	//$nama_saksi2	=$_POST['nama_saksi2'];
	$tanda_tangan 	= 'Kepala Desa';
	
	$tanggal 		=date("Y-m-d H:i:s");
																
			$data = mysql_query("update tblkelahiran SET no_kelahiran='$no_kelahiran',
														NoKK ='$no_kk',
														NamaBayi='$nama_bayi',
														JKelBayi='$kelamin',
														TempatDilahirkan='$tempat_dilahirkan',
														TempatKelahiran='$tmp_lahir',
														HariLahir='Hari',
																
														TglLahir='$tgl_lahir',
														Pukul='$Pukul',
														JKelahiran='$jenis_kelahiran',
														KelahiranKe='$anak_ke',
														
														Dusun ='$dusun',
																
														PenolongKelahiran='$penolong',
														BeratBayi='$berat_bayi',
														nik_ibu='$nik_ibu',
														nik_ayah='$nik_ayah',
																
														nik_pelapor='$nik_pelapor',
														hubungan_bayi='$_POST[hubungan]',
														nik_saksi1='$NikSaksi1',
														nik_saksi2='$NikSaksi2',
														KelurahanID='$kelurahan_ibu',
																
														DusunID='DUSUNID',
														keturunan_ibu='$keturunan_ibu',
														keturunan_ayah='$keturunan_ayah',
														kebangsaan_ibu='$kebangsaan_ibu',
																
														kebangsaan_ayah='$kebangsaan_ayah',
														tgl_perkawinan_ibu='$tgl_perkawinan',
														tanda_tangan='$tanda_tangan',
														TanggalEntry='$tanggal'
														where id='$id' ") or die (mysql_error());
														
		$aktifitas="User $_SESSION[username] Melakukan Pengupdatetan Data Kelahiran Nomer $no_kelahiran";
				include"key_log.php";
		
		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Proses Update Permohonan Data Kelahiran Nama <u>$nama_bayi</u> berhasil di proses</b></p>";
		$hal="?mn=data_kelahiran";

		echo"<br><center><a href='Print/surat_kelahiran_new.php?id=$no_kelahiran' target='_blank'>
			<button type='submit' class='btn btn-danger'>Cetak Kelurahan</span></button></a></center>
			
			<p align=center><center><a href='Print/surat_kelahiran.php?id=$no_kelahiran' target='_blank'>
			<button type='submit' class='btn btn-danger'>Cetak Warga</span></button></a></center></p>
			
		<p align=center>
		<form method='POST' action='media.php?mn=data_kelahiran' class='form-horizontal'>";
		echo"<center><button type='submit' class='btn btn-primary'>Kembali</button>";
		echo"</form></center>";

		//echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";					
	
	
echo"</div></div>";
?>


