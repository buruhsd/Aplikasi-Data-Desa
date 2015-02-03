<?php
include "library/koneksi.php";

if (isset($_POST["username"]) && isset($_POST["password"]) )
   {
   	$pass 		= MD5($_POST['password']);
	$username	= $_POST['username'];

	###################################
	# cek user dia ada dalam database #
	###################################
	$dtcek=mysql_query("SELECT * FROM kel_login WHERE id_user='$username' AND password='$pass' AND aktif='1'");
	$rowcek=mysql_num_rows($dtcek);
	if($rowcek>0)
	{

		session_start();
		$dt=mysql_fetch_array($dtcek);
			
		$_SESSION[username]=$dt[id_user];
		$_SESSION[passuser]=$dt[password];
		$_SESSION[namalengkap]=$dt[nm_lengkap];
		$_SESSION[kelurahan]=$dt[kelurahan];
		
		$aktifitas="User $_SESSION[username] Melakukan LOGIN";
				include"key_log.php";		
				
		header('location:media.php?mn=welcome');
	}
	else {
	$error="login gagal!!";
	include"index.php";
	}
}
?>