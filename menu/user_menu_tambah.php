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
                                    <h3 class='box-title'>Manajemen Menu</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-primary btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

echo"<form method='POST' action='media.php?mn=user_menu_simpan' enctype='multipart/form-data' name='FUpload' id='FUpload'>";
echo"<table class='table'>
		<tr><td>Nama Menu</td><td><div class='col-md-5'><input type='text' name='nama_menu' required class='form-control'></div></td></tr>
		<tr><td>Link Menu</td><td><div class='col-md-5'><input type='text' name='link_menu' required class='form-control'></div></td></tr>";
echo"<tr><td>Kategori Menu</td><td><div class='col-md-4'>
				<select id='menu' name='sub_menu' id='sub_menu'  class='selectpicker show-tick form-control' data-live-search='true' required>
				<option value=''>Pilih Kategori Menu</option>
				<option value='0'>Menu Utama</option>";
				$menu = mysql_query ("SELECT id_menu_utama,nama_menu from kel_menu where status='tampil' ORDER BY nama_menu ASC");
				while ($mn=mysql_fetch_assoc($menu))
				{
				echo"<option value='$mn[id_menu_utama]'>Sub Menu $mn[nama_menu]</option>";
				}
				echo"</select></div></td></tr>";
echo"<tr><td>Status</td><td><div class='col-md-3'>
				<select id='status' name='status'  class='form-control'>
				<option value='tampil'>Tampil</option>
				<option value='tidak tampil'>Tidak Tampil</option>
				</select></div></td></tr>";
echo"<tr><td>Icon</td><td><div class='col-md-4'><input type='file' name='nama_file' id='nama_file'></td></tr>";
echo"<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Simpan</button>
				<button type='reset' class='btn btn-primary' onclick=self.history.back()>
					<i class='fa fa-fw fa-repeat'></i>Batal</button></p></td></tr>";
		echo"</thead></table>";
				echo"</form>";
					echo"</div></div>";
					?>
	
