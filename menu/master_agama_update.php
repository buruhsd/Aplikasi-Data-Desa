<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";

$id 				= $_POST['id'];
$nama_agama			= $_POST['nama_agama'];

echo"<div class='box box-solid box-danger'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Informasi</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-danger btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

	$sql=mysql_query("UPDATE tblagama SET NamaAgama='$nama_agama'
													WHERE AgamaID='$id'") or die (mysql_error());

	$aktifitas="User $_SESSION[username] Melakukan Peng-Update-an Data Agama $nama_agama";
				include"key_log.php";
				
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>UPDATE Kategori Agama <u>$nama_agama</u> berhasil</b></p>";
		$hal="?mn=master_agama";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
													
echo"</div></div>";
?>
