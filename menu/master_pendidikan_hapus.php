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
								
$data	= mysql_query ("SELECT * from tblpendidikan where PendidikanID='$_GET[id]'");
$dt	= mysql_fetch_array ($data);

$aktifitas="User $_SESSION[username] Melakukan Penghapusan Data Pendidikan $dt[NamaPendidikan]";
				include"key_log.php";
				
$delete=mysql_query("delete from tblpendidikan where PendidikanID='$_GET[id]'") or die (mysql_error());
if($delete){				
$hal="?mn=master_pendidikan";
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/><b>Data Pendidikan Berhasil Dihapus</b></p>";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}else{
echo "gagal";
}

echo"</div></div>";
?>
