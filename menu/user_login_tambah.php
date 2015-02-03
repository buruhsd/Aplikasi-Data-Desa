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
                                    <h3 class="box-title">Manajemen User</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=user_login_simpan'>";
echo"<table class='table'>
		<tr><td>Username</td><td><div class='col-md-4'><input type='text' name='id_user' class='form-control' required></div></td></tr>
		<tr><td>Password</td><td><div class='col-md-5'><input id='password' type='password' name='password' class='form-control' required></div></td></tr>
		<tr><td>Nama Lengkap</td><td><div class='col-md-6'><input type='text' name='nm_lengkap' class='form-control' required></div></td></tr>
		<tr><td>No. Telp</td><td><div class='col-md-3'><input type='text' name='no_telp'  onKeyPress='return numbersonly(this, event)'  class='form-control' required></div></td></tr>
		<tr><td>Kelurahan</td><td>
	 <div class='col-md-5'>
	<select id='kel' name='kel' class='selectpicker show-tick form-control' data-live-search='true' required>
	<option value='3315162020'>Kemloko</option>";
	$kelurahan = mysql_query("SELECT KelurahanID, NamaKelurahan FROM tblkelurahan where KecamatanID='331516'");
	while ($kel=mysql_fetch_array($kelurahan))
	{
		echo"<option value='$kel[KelurahanID]'>$kel[NamaKelurahan]</option>";
	}
	echo"</select></div></td></tr>
		<tr><td>Status</td><td><div class='col-md-3'>
				<select id='status' name='status'  class='form-control'>
				<option value='1'>Aktif</option>
				<option value='0'>Non Aktif</option>
			</select></div></td></tr>
	 	<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-danger btn-line' data-original-title=''>Simpan</button>
				<button type='reset' class='btn btn-danger' onclick=self.history.back()>Batal</button></p></td></tr>";
		echo"</thead></table>";
				echo"</form>";

?>
	 