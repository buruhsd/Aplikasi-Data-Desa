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
echo"<form method='POST' action='media.php?mn=ganti_password_simpan'>";
echo"<div class='box-content'>";
echo "<table class='table'>
<input type=text name=id_user value='$id'>
		<thead>
			<tr><td>Nama Lengkap</td><td><input type=text name=nama_user value='$u[nm_lengkap]'></td></tr>
			<tr><td>Username</td><td><input type=text name=id_user value='$u[id_user]'>
			<tr><td>Ganti Password</td><td>
			<input type=password name=password placeholder='Masukan Passwod Baru'></td></tr>
			<tr><td colspan=2><p align=center><button type='submit' class='btn btn-primary'>Update</button></p></td></tr>";
echo"</table>";
echo"</div>";
echo"</form>";
echo"</div></div>";
?>
			
				