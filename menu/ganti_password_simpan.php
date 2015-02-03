<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
date_default_timezone_set("Asia/Jakarta");
$id = $_GET['id'];
echo"<div class='box box-primary'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Ganti Password</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-primary btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";
$nm_user	= $_POST['nm_user'];
$id_user	= $_POST['id_user'];
$password	= $_POST['password'];
$pass		= md5($_POST['password']);

$update		= mysql_query ("UPDATE so_user_login_ol SET password ='$pass'
									where id_user='$id_user' AND nm_user='$nm_user'") or die (mysql_error());


$aktifitas="User $_SESSION[id_user] Melakukan Update [password $password]";
				include"key_log.php";												

echo"<br/><p align=center><img title='img/ajax-loaders/ajax-loader-6.gif' src='img/ajax-loaders/ajax-loader-6.gif'>
<br/><b>User <u>$id_user</u> Berhasil Ganti Password $password</b></p>";
$hal="?".MarketEncrypt('mn=depan')."";
echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
?>