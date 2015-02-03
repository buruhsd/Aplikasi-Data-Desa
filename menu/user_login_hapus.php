<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
?>
 <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Informasi</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php

$id= $_GET['id'];

$data	= mysql_query ("SELECT * from kel_login where id_user='$_GET[id]'");
$dt	= mysql_fetch_array ($data);

$aktifitas="User $_SESSION[username] Melakukan Penghapusan Data Username $id";
				include"key_log.php";
				
$delete=mysql_query("delete from kel_login where id_user='$_GET[id]'") or die (mysql_error());
if($delete){				
$hal="?mn=user_login";
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/><b>Data User Berhasil Dihapus</b></p>";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}else{
echo "gagal";

}
?>
