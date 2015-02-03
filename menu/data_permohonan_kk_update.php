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
//$tahun 		=date("Y");
//$bulan 		=date("m");
//$tanggal_entri 	= date('Y-m-d');
//$jam			= date('H:i:s');
//$waktu			=$tanggal_entri.' '.$jam;
 
//$nomor = mysql_query ("SELECT MAX(SUBSTR(no_kk_kel,4,4)) as no_kk from tblpermohonan_kk");
//$no 	= mysql_fetch_assoc($nomor);
//$kode 		= $no['no_kk'];
//$kode++;
//$no_kk 	= sprintf("KK/%04s",$kode)."/".$bulan."/".$tahun;

$id 	= $_POST['id_kk'];
$data 	= mysql_query ("SELECT * from tblpermohonan_kk where id_kk='$id'");
$dt 	= mysql_fetch_array ($data);
$no_kk 	= $dt['no_kk_kel'];
	$sql=mysql_query("UPDATE tblpermohonan_kk SET 
												nama_lengkap ='$_POST[nama_lengkap]',
												alamat		='$_POST[alamat]',
												kode_pos 	='$_POST[kode_pos]',

												telepon 	='$_POST[telepon]',
												provinsi 	='$_POST[provinsi]',
												kabupaten 	='$_POST[kabupaten]',
												kecamatan	='$_POST[kecamatan]',

												desa 		='$_POST[desa]',
												dusun		='$_POST[dusun]',
												no_ktp		='$_POST[no_ktp]',
												no_pasport	='$_POST[no_pasport]',
												tgl_akhir_pasport ='$_POST[tgl_akhir_pasport]',

												jenis_kelamin	='$_POST[jenis_kelamin]',
												tempat_lahir	='$_POST[tempat_lahir]',
												tgl_lahir		='$_POST[tgl_lahir]',
												akta_lahir		='$_POST[akta_lahir]',

												no_akta_lahir	='$_POST[no_akta_lahir]',
												gol_darah		='$_POST[gol_darah]',
												agama			='$_POST[agama]',
												status_perkawinan='$_POST[status_perkawinan]',

												akta_perkawinan	='$_POST[akta_perkawinan]',
												no_akta_perkawinan='$_POST[no_akta_perkawinan]',
												tgl_perkawinan	='$_POST[tgl_perkawinan]',
												akta_perceraian	='$_POST[akta_perceraian]',

												no_cerai		='$_POST[no_cerai]',
												tgl_cerai		='$_POST[tgl_cerai]',
												hub_keluarga	='$_POST[hub_keluarga]',
												kelainan 		='$_POST[kelainan]',

												penyandang_cacat='$_POST[penyandang_cacat]',
												pendidikan_terakhir='$_POST[pendidikan_terakhir]',
												pekerjaan 		='$_POST[pekerjaan]',
												nik_ibu			='$_POST[nik_ibu]',

												nama_ibu		='$_POST[nama_ibu]',
												nik_ayah		='$_POST[nik_ayah]',
												nama_ayah		='$_POST[nama_ayah]',
												tanggal 		='$_POST[tanggal]',
												rt				='$_POST[rt]',
												rw				='$_POST[rw]'
												where no_kk_kel ='$no_kk' AND id_kk='$_POST[id_kk]'") or die (mysql_error());

$aktifitas="User $_SESSION[username] Melakukan Peng-update-an Data Pemohon KK No. $_POST[no_kk_kel] dan $_POST[nama_lengkap]";
				include"key_log.php";
											

echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
<br/><b>Pemohon KK <u>$_POST[nama_lengkap]</u> berhasil di update</b></p>";
$hal="?mn=data_permohonan_kk_view&id=$no_kk";
echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
									
echo"</div></div>";
?>