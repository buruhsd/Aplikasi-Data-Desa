<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";

$id= $_GET['id'];

echo"<div class='box box-solid box-danger'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Informasi</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-danger btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

$data	= mysql_query ("SELECT * from tblpermohonanktp where NIK='$_GET[id]'");
$dt	= mysql_fetch_array ($data);

$aktifitas="User $_SESSION[username] Melakukan Penghapusan Data KTP $id";
				include"key_log.php";

$insert = mysql_query("INSERT INTO hapustblpermohonanktp (NIK,TanggalPermohonan,Permohonan,KelurahanID,tanda_tangan,NamaAparat)
                                                        values('$dt[NIK]','$dt[TanggalPermohonan]','$dt[Permohonan]','$dt[KelurahanID]','$dt[tanda_tangan]','$_SESSION[username]')") or die (mysql_error());
				
$delete=mysql_query("delete from tblpermohonanktp where NIK='$_GET[id]'") or die (mysql_error());
if($delete){				
$hal="?mn=permohonan_ktp_data";
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/><b>Data KTP Berhasil Dihapus</b></p>";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}else{
echo "gagal";
}

echo"</div></div>";
?>
