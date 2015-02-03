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
								
								
	$tanggal=date("Y-m-d");
	$nama	=$_POST['nama'];
	$query =mysql_query("UPDATE tblskumum SET no_surat='$_POST[no_surat]',
									tanggal 	='$tanggal',
									tanggal_awal 	='$_POST[tanggal_mulai]',
									tanggal_akhir	='$_POST[tanggal_akhir]',
									nik				='$_POST[nik]',
									keperluan		='$_POST[keperluan]',
									keterangan_lain	='$_POST[keterangan_lain]',
									KelurahanID		='$_POST[kelurahanid]',
									tanda_tangan	='$_POST[tanda_tangan]'
									where id='$_POST[id]'") or die (mysql_error());

	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Update Surat Keterangan Nama <u>$nama</u> berhasil</b></p>";
		$hal="?mn=surat_keterangan";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
?>