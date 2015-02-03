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
$id 		= $_POST['id'];

if(empty($_POST['password'])){
			mysql_query("UPDATE kel_login SET  id_user ='$id_user',
												nm_lengkap = '$nm_lengkap',
												aktif = '$status',
												no_telp ='$no_telp'
														where id_user='$id' ") or die (mysql_error());
			
echo "<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/><b>Berhasil Update User: $id_user , Tapi tidak update password</b></p>";
	$hal="?mn=user_login";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}
		//apablia pasword diubah
		else{
			mysql_query("UPDATE kel_login SET  id_user ='$id_user',
												nm_lengkap = '$nm_lengkap',
												aktif = '$status',
												no_telp ='$no_telp',
												password = '$pass'
														where id_user='$id' ") or die (mysql_error());
														
				$aktifitas="User $_SESSION[username] Melakukan Peng-Update-an Data Username $id_user";
				include"key_log.php";
			
			echo "<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Berhasil Update User: $id_user , dengan mengganti password <u>".$_POST['password']."</u></b></p>
			</div>";
			$hal="?mn=user_login";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
			}
?>