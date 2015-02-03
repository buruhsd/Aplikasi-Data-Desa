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
	
	$cek_data1 	= mysql_query ("SELECT * from tblpermohonanktp where no_pengajuan ='$no_ktp'");
	$cek1 		=  mysql_num_rows($cek_data1);
	if ($cek1 >0)
	{
		echo"<p align='center'>No Pengajuan KTP Telah Dibuat Silahkan Ulangi Lagi</p>";
	}
	else
	{
	$cek_data 	= mysql_query ("SELECT * from tblpermohonanktp where NIK='$NIK'");
	$cek 		=  mysql_num_rows($cek_data);
	
	if ($cek > 0)
	{
		$data = mysql_query ("UPDATE tblpermohonanktp SET no_pengajuan ='$no_ktp',
															NIK ='$NIK',
															TanggalPermohonan='$waktu',
															Permohonan='$permohonanKTP',
															KelurahanID='$KelurahanID',
															tanda_tangan='$tanda_tangan',
															NamaAparat='$_SESSION[username]' where NIK='$NIK'") or die (mysql_error());
															
		$aktifitas="User $_SESSION[username] Melakukan Peng-Update-an Data KTP $NIK";
				include"key_log.php";
				
		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Proses Permohonan KTP Nama <u>$NamaLengkap</u> berhasil di proses</b></p>";
		$hal="?mn=permohonan_ktp_input";
		
		echo"<br><center><a href='Print/surat_permohonan_ktp.php?id=$NIK' target='_blank'>
			<button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-print'> Cetak</span></button></a></center>
		<form method='POST' action='media.php?mn=permohonan_ktp_input' class='form-horizontal'>";
		echo"<center><button type='submit' class='btn btn-primary'>Kembali</button>";
		echo"</form></center>";
		//echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";															
	}
	else
	{
			$data = mysql_query("INSERT INTO tblpermohonanktp (no_pengajuan,NIK,TanggalPermohonan,Permohonan,KelurahanID,tanda_tangan,NamaAparat)
														values('$no_ktp','$NIK','$waktu','$permohonanKTP','$KelurahanID','$tanda_tangan','$_SESSION[username]')") or die (mysql_error());
		
			$aktifitas="User $_SESSION[username] Melakukan Peng-Input-an Data KTP $NIK";
				include"key_log.php"; 
				
		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Proses Permohonan KTP Nama <u>$NamaLengkap</u> berhasil di proses</b></p>";
		$hal="?mn=permohonan_ktp_input";
			echo"<br><center><a href='Print/surat_permohonan_ktp.php?id=$NIK' target='_blank'>
			<button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-print'> Cetak</span></button></a></center>
		<form method='POST' action='media.php?mn=permohonan_ktp_input' class='form-horizontal'>";
		echo"<center><button type='submit' class='btn btn-primary'>Kembali</button>";
		echo"</form></center>";
		//echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";					
	}
	}
echo"</div></div>";
?>


