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
	$no =$_POST['no_surat'];						
	$cek_surat	= mysql_query ("SELECT * FROM tblskumum where no_surat='$_POST[no_surat]'");
	$cek			= mysql_num_rows($cek_surat);
	if($cek > 0)
	{
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>No Surat Telah digunakan silahkan cek kembali</b></p>";
		//$hal="?mn=input_data_kelahiran";
		//echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
	}
	else
	{							
	$tanggal=date("Y-m-d");
	$nama	=$_POST['nama'];
	$query =mysql_query("INSERT INTO tblskumum (no_surat,
									tanggal,
									tanggal_awal,
									tanggal_akhir,
									nik,
									keperluan,
									keterangan_lain,
									KelurahanID,
									tanda_tangan)
							values('$_POST[no_surat]',
									'$tanggal',
									'$_POST[tanggal_mulai]',
									'$_POST[tanggal_akhir]',
									'$_POST[nik]',
									'$_POST[keperluan]',
									'$_POST[keterangan_lain]',
									'$_POST[kelurahanid]',
									'$_POST[tanda_tangan]')") or die (mysql_error());

	$aktifitas="User $_SESSION[username] Melakukan Peng-Inputan-an Surat Keterangan Nomer $_POST[no_surat] ";
                include"key_log.php";

	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Input Surat Keterangan Nama <u>$nama</u> berhasil</b></p>";
		$hal="?mn=surat_keterangan_input";

			echo"<br><center><a href='Print/suratpengantar.php?id=$no' target='_blank'>
			<button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-print'> Cetak</span></button></a></center>
		<form method='POST' action='media.php?mn=surat_keterangan_input' class='form-horizontal'>";
		echo"<center><button type='submit' class='btn btn-primary'>Kembali</button>";
		echo"</form></center>";


		//echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
	}
?>