<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";

$id 				= $_POST['id'];
$nama_pekerjaan		= $_POST['nama_pekerjaan'];

echo"<div class='box box-solid box-danger'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Informasi</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-danger btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

	$sql=mysql_query("UPDATE tblpekerjaan SET NamaPekerjaan='$nama_pekerjaan'
													WHERE PekerjaanID='$id'") or die (mysql_error());

	$aktifitas="User $_SESSION[username] Melakukan Peng-update-an Data Pekerjaan $nama_pekerjaan";
				include"key_log.php"; 
				
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>UPDATE Kategori Pekerjaan <u>$nama_pekerjaan</u> berhasil</b></p>";
		$hal="?mn=master_pekerjaan";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
													
echo"</div></div>";
?>
