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

$tanggal_entri 	= date('Y-m-d');
$jam			= date('H:i:s');
$waktu			=$tanggal_entri.' '.$jam;


$cek_identitas = mysql_query ("SELECT * from tblpermohonan_kk where no_ktp='$_POST[no_ktp]'");
$cek = mysql_num_rows($cek_identitas);

if ($cek >0)
{
		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
			<br/>No Identitas Sudah pernah dibuat..silahkan Cek lagi !!</p>";
			$hal="?mn=input_data_penduduk";
			echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}
else
{						
	
	$sql=mysql_query("INSERT INTO tblpermohonan_kk (no_kk_kel,
												nama_lengkap,
												alamat,
												kode_pos,
												telepon,
												provinsi,
												kabupaten,
												kecamatan,
												desa,
												dusun,
												no_ktp,
												no_pasport,
												tgl_akhir_pasport,
												jenis_kelamin,
												tempat_lahir,
												tgl_lahir,
												akta_lahir,
												no_akta_lahir,
												gol_darah,
												agama,
												status_perkawinan,
												akta_perkawinan,
												no_akta_perkawinan,
												tgl_perkawinan,
												akta_perceraian,
												no_cerai,
												tgl_cerai,
												hub_keluarga,
												kelainan,
												penyandang_cacat,
												pendidikan_terakhir,
												pekerjaan,
												nik_ibu,
												nama_ibu,
												nik_ayah,
												nama_ayah,
												tanggal)
										VALUES('$_POST[kk]',
												'$_POST[nama_lengkap]',
												'$_POST[alamat]',
												'$_POST[kode_pos]',
												'$_POST[telepon]',
												'$_POST[provinsi]',
												'$_POST[kabupaten]',
												'$_POST[kecamatan]',
												'$_POST[desa]',
												'$_POST[dusun]',
												'$_POST[no_ktp]',
												'$_POST[no_pasport]',
												'$_POST[tgl_akhir_pasport]',
												'$_POST[jenis_kelamin]',
												'$_POST[tempat_lahir]',
												'$_POST[tgl_lahir]',
												'$_POST[akta_lahir]',
												'$_POST[no_akta_lahir]',
												'$_POST[gol_darah]',
												'$_POST[agama]',
												'$_POST[status_perkawinan]',
												'$_POST[akta_perkawinan]',
												'$_POST[no_akta_perkawinan]',
												'$_POST[tgl_perkawinan]',
												'$_POST[akta_perceraian]',
												'$_POST[no_cerai]',
												'$_POST[tgl_cerai]',
												'$_POST[hub_keluarga]',
												'$_POST[kelainan]',
												'$_POST[penyandang_cacat]',
												'$_POST[pendidikan_terakhir]',
												'$_POST[pekerjaan]',
												'$_POST[nik_ibu]',
												'$_POST[nama_ibu]',
												'$_POST[nik_ayah]',
												'$_POST[nama_ayah]',
												'$tanggal_entri')") or die (mysql_error());

$aktifitas="User $_SESSION[username] Melakukan Penginputan Data Pemohon KK No. $_POST[no_kk_kel] dan $_POST[nama_lengkap]";
				include"key_log.php";
											

echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
<br/><b>Pemohon KK <u>$_POST[nama_lengkap]</u> berhasil dibuat</b></p>";
$hal="?mn=data_permohonan_kk_view&id=$_POST[kk]";
echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";

}											
echo"</div></div>";
?>