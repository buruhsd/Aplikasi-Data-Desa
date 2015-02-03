<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";

$id = $_GET['id'];
$data 	= mysql_query("SELECT * from tblpejabat where id_pejabat='$id'");
$dt 	= mysql_fetch_array($data);

echo"<div class='box box-primary'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Master Data Pejabat</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-primary btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

echo"<form method='POST' action='media.php?mn=master_pejabat_update'>";
echo"<table class='table'>
<input type='hidden' name='id' required class='form-control' value='$id'>
		<tr><td>Nama Pejabat</td><td><div class='col-md-6'><input type='text' name='nama_pejabat' required class='form-control' value='$dt[nama_pejabat]'>
		</td></tr>
		<tr><td>Nip</td><td><div class='col-md-5'><input type='text' name='nip' required class='form-control' value='$dt[nip]'></div></td></tr>
		<tr><td>Jabatan</td><td><div class='col-md-6'>
	<select id='jabatan' name='jabatan' class='form-control' required>
	<option value='$dt[jabatan]'>$dt[jabatan]</option>
	<option value='Kepala Desa'>Kepala Desa</option>
	<option value='Sekretaris Desa'>Sekretaris Desa</option>
	<div></select></td></tr>";
echo"<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Update</button></p></td></tr>";
		echo"</thead></table>";
				echo"</form>";
					echo"</div></div>";
					?>
	
