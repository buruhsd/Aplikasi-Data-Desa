<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
echo"<div class='box box-primary'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Master Data Pendidikan</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-primary btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

$master_pendidikan = mysql_query("SELECT max(PendidikanID) as id from tblpendidikan");
$mp=mysql_fetch_array($master_pendidikan);
$id 	=$mp['id'] + 1;

echo"<form method='POST' action='media.php?mn=master_pendidikan_simpan'>";
echo"<table class='table'>
		<tr><td>ID Pendidikan</td><td><div class='col-md-2'><input type='text' name='id' value='$id' readonly class='form-control'></div></td></tr>
		<tr><td>Nama Pendidikan</td><td><div class='col-md-5'><input type='text' name='nama_pendidikan' required class='form-control'></div></td></tr>";
echo"<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Simpan</button>
				<button type='reset' class='btn btn-primary' onclick=self.history.back()>
					<i class='fa fa-fw fa-repeat'></i>Batal</button></p></td></tr>";
		echo"</thead></table>";
				echo"</form>";
					echo"</div></div>";
					?>
	
