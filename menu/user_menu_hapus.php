<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
  
$id =$_GET['id'];
				
$delete=mysql_query("delete from kel_menu where id_menu_utama='$id'") or die (mysql_error());
if($delete){
echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Menu berhasil dihapus</b></p>";
		$hal="?mn=user_menu";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}else{
echo "gagal";

}
?>