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
                                    <h3 class='box-title'>Master Data Agama</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-primary btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

$master_agama = mysql_query("SELECT max(AgamaID) as id from tblagama");
$ma=mysql_fetch_array($master_agama);
$id 	=$ma['id'] + 1;

echo"<form method='POST' action='media.php?mn=master_agama_simpan'>";
echo"<table class='table'>
		<tr><td>ID Agama</td><td><div class='col-md-2'><input type='text' name='id' value='$id' readonly class='form-control'></div></td></tr>
		<tr><td>Nama Agama</td><td><div class='col-md-5'><input type='text' name='nama_agama' required class='form-control'></div></td></tr>";
echo"<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Simpan</button>
				<button type='reset' class='btn btn-primary' onclick=self.history.back()>
					<i class='fa fa-fw fa-repeat'></i>Batal</button></p></td></tr>";
		echo"</thead></table>";
				echo"</form>";
					echo"</div></div>";
					?>
	
