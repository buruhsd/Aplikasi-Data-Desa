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
$pass		=md5($_POST['password']);
$id_user	=$_POST['id_user'];
$nm_lengkap	=$_POST['nm_lengkap'];
$status 	=$_POST['status'];
$no_telp 	=$_POST['no_telp'];

$user 	=mysql_query("SELECT * from kel_login where id_user='$id_user'");
$usr	=mysql_num_rows($user);
if($usr>0){
	echo"<p align=center>Username telah digunakan silahkan ganti yang lainnya!!</p>";
}
else {
	$data	=mysql_query("INSERT INTO kel_login (id_user,
													nm_lengkap,
													password,
													aktif,
													no_telp,
													kelurahan)
											VALUES ('$id_user',
													'$nm_lengkap',
													'$pass',
													'$status',
													'$no_telp',
													'$_POST[kel]')") or die (mysql_error());
											
		$aktifitas="User $_SESSION[username] Melakukan Peng-Input-an Data Username $id_user";
				include"key_log.php";
				
		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>User <u>$id_user</u> dan Pasword $_POST[password] berhasil ditambahkan</b></p>";
		$hal="?mn=user_login";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
	}
?>