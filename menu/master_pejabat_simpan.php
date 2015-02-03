<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";

$nip				= $_POST['nip'];
$nama_pejabat		= $_POST['nama_pejabat'];
$jabatan 			= $_POST['jabatan'];

echo"<div class='box box-solid box-danger'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Informasi</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-danger btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";
$master_pejabat= mysql_query("SELECT * from tblpejabat where jabatan='$jabatan'");
$mp=mysql_fetch_array($master_pejabat);

if ($mp >0)
{
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/>Data Jabatan $jabatan sudah pernah dibuat silahkan ulangi lagi !!</p>";
	$hal="?mn=master_pejabat_tambah";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}
else
{

	$sql=mysql_query("INSERT INTO tblpejabat (nip,nama_pejabat,jabatan)
												VALUES ('$nip',
														'$nama_pejabat',
														'$jabatan')") or die (mysql_error());
														
	$aktifitas="User $_SESSION[username] Melakukan Peng-input-an Data Jabatan $nama_pejabat $jabatan";
				include"key_log.php";
				
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Penambahan Kategori Jabatan <u>$nama_pejabat $jabatan</u> berhasil</b></p>";
		$hal="?mn=master_pejabat";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
													
}
echo"</div></div>";
?>
