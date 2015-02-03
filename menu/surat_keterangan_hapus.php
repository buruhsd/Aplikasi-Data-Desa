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

$cek_surat  = mysql_query ("SELECT * FROM tblskumum where id='$_GET[id]'");
    $cek            = mysql_fetch_array($cek_surat);

$aktifitas="User $_SESSION[username] Melakukan Peng-Hapus-an Surat Keterangan Nomer $cek[no_surat] ";
                include"key_log.php";

$query =mysql_query("INSERT INTO hapustblskumum (no_surat,
                                    tanggal,
                                    tanggal_awal,
                                    tanggal_akhir,
                                    nik,
                                    keperluan,
                                    keterangan_lain,
                                    KelurahanID,
                                    tanda_tangan)
                            values('$cek[no_surat]',
                                    '$cek[tanggal]',
                                    '$cek[tanggal_awal]',
                                    '$cek[tanggal_akhir]',
                                    '$cek[nik]',
                                    '$cek[keperluan]',
                                    '$cek[keterangan_lain]',
                                    '$cek[KelurahanID]',
                                    '$cek[tanda_tangan]')") or die (mysql_error());

$delete=mysql_query("delete FROM tblskumum where id='$_GET[id]'") or die (mysql_error());
if($delete){				
$hal="?mn=surat_keterangan";
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/><b>Data Surat Keterangan Berhasil Dihapus</b></p>";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}else{
echo "gagal";
}

echo"</div></div>";
?>
