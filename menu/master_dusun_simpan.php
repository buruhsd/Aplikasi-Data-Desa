<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";

$kelurahan			= $_POST['kelurahan'];
$nama_dusun			= $_POST['nama_dusun'];

echo"<div class='box box-solid box-danger'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Informasi</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-danger btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

$cekdata = mysql_query ("SELECT * FROM tbldusun where NamaDusun='$nama_dusun' AND KelurahanID='$kelurahan'");
$cek=mysql_fetch_array($cekdata);
if ($cek >0)
{
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/>Nama Dusun sudah pernah dibuat silahkan ulangi lagi !!</p>";
	$hal="?mn=master_dusun_tambah";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}
else
{

$data_kelurahan = mysql_query ("SELECT SUBSTR(DusunID,11,2) as id_dusun FROM tbldusun where KelurahanID='$kelurahan' ORDER BY DusunID DESC LIMIT 1");
$kl=mysql_fetch_array($data_kelurahan);
$kode 		= $kl['id_dusun'];
$kode++;
$id_dusun 	= "$kelurahan".sprintf("%02s",$kode);

	$sql=mysql_query("INSERT INTO tbldusun (DusunID,KelurahanID,NamaDusun)
												VALUES ('$id_dusun',
														'$kelurahan',
														'$nama_dusun')") or die (mysql_error());
														
		$aktifitas="User $_SESSION[username] Melakukan Peng-input-an Data Dusun $nama_dusun";
				include"key_log.php";

	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Penambahan Nama Dusun <u>$nama_dusun</u> berhasil</b></p>";
		$hal="?mn=master_dusun";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
													
}
echo"</div></div>";
?>
