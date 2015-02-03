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
								
     $no_ktp 		=$_POST['no_ktp'];    	
	$id 			= $_POST['id'];
	$permohonanKTP	=$_POST['permohonanKTP'];
	$NamaLengkap	=$_POST['NamaLengkap'];
	$NIK			=$_POST['NIK'];
	$NoKK			=$_POST['NoKK'];
	$RT				=$_POST['RT'];
	$RW				=$_POST['RW'];
	$KodePos		=$_POST['KodePos'];
	$Alamat			=$_POST['Alamat'];
	$ProvID			=$_POST['ProvID'];
	$Prov			=$_POST['Prov'];
	$KabID			=$_POST['KabID'];
	$Kab			=$_POST['Kab'];
	$KecID			=$_POST['KecID'];
	$Kec			=$_POST['Kec'];
	$KelurahanID	=$_POST['KelurahanID'];
	$Kelurahan		=$_POST['Kelurahan'];
	$tanggal 		=date("Y-m-d");
	$jam			=date("H:i:s");
	$waktu 			=$tanggal.' '.$jam;
	$tanda_tangan	=$_POST['tanda_tangan'];
	
	/*$cek_data1 	= mysql_query ("SELECT * from tblpermohonanktp where no_pengajuan ='$no_ktp'");
	$cek1 		=  mysql_num_rows($cek_data1);
	if ($cek1 >0)
	{
		echo"<p align='center'>No Pengajuan KTP Telah Dibuat Silahkan Ulangi Lagi</p>";
	}
	else
	{*/
	
	$data = mysql_query ("UPDATE tblpermohonanktp SET no_pengajuan ='$no_ktp',
															NIK ='$NIK',
															TanggalPermohonan='$waktu',
															Permohonan='$permohonanKTP',
															KelurahanID='$KelurahanID',
															tanda_tangan='$tanda_tangan',
															NamaAparat='$_SESSION[username]' where NIK='$id'") or die (mysql_error());
															
		$aktifitas="User $_SESSION[username] Melakukan Peng-Update-an Data KTP $NIK";
				include"key_log.php";
				
		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Proses Permohonan KTP Nama <u>$NamaLengkap</u> berhasil di update</b></p>";
		$hal="?mn=permohonan_ktp_data";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";		
	
?>		