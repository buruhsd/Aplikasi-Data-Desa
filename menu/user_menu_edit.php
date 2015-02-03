<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
$id=$_GET['id'];

//Menu Edit
$menu_edit 	= mysql_query("SELECT * from kel_menu where id_menu_utama='$id'");
$me 		= mysql_fetch_array($menu_edit);

echo"<div class='box box-primary'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Manajemen Menu</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-primary btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

echo"<form method='POST' action='media.php?mn=user_menu_update' enctype='multipart/form-data' name='FUpload' id='FUpload'>";
echo"<input type='hidden' name='id' value='$id'>";
echo"<table class='table'>
		<tr><td>Nama Menu</td><td><div class='col-md-5'><input type='text' name='nama_menu' value='$me[nama_menu]' required class='form-control'></div></td></tr>
		<tr><td>Link Menu</td><td><div class='col-md-5'><input type='text' name='link_menu' value='$me[nama_link]' required class='form-control'></div></td></tr>";
	echo"<tr><td>Sub Menu</td><td><div class='col-md-5'><select id='sub_menu' name='sub_menu'  class='selectpicker show-tick form-control' data-live-search='true' required>";
	$sub_menu 	= mysql_query ("SELECT id_menu_utama,nama_menu from kel_menu where id_menu_utama='$me[sub_menu]'");
	$sm 		= mysql_fetch_assoc($sub_menu);
	echo"<option value='$sm[id_menu_utama]'>$sm[nama_menu]</option>";
	$tampil_sub = mysql_query("SELECT id_menu_utama,nama_menu from kel_menu ORDER BY nama_menu ASC");
	while ($ts=mysql_fetch_assoc($tampil_sub))
	{
	echo"<option value='$ts[id_menu_utama]'>$ts[nama_menu]</option>";
	}
	echo"</select></div></td></tr>";
if ($me['status'] == 'tampil')
{
	echo"<tr><td>Status</td><td><div class='col-md-5'>
				<select id='status' name='status'  class='form-control'>
				<option value='tampil'>Tampil</option>
				<option value='tidak tampil'>Tidak Tampil</option>
				</div></select></td></tr>";
}
else
{
	echo"<tr><td>Status</td><td><div class='col-md-5'>
				<select id='status' name='status'  class='form-control'>
				<option value='tidak tampil'>Tidak Tampil</option>
				<option value='tampil'>Tampil</option>
				</div></select></td></tr>";
}
if ($me['img_menu'] == '')
{
	echo"<tr><td>Icon Lama</td><td><div class='col-md-5'>Tanpa Icon</div></td>";
}
else
{
	echo"<tr><td>Icon Lama</td><td><div class='col-md-5'><img src='$me[img_menu]'></div></td>";
}

echo"<tr><td>Ganti Icon</td><td><div class='col-md-5'><input type='file' name='nama_file' id='nama_file'></div></td></tr>";
echo"<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Update</button>
				<button type='reset' class='btn btn-primary' onclick=self.history.back()>
					<i class='fa fa-fw fa-repeat'></i>Batal</button></p></td></tr>";
		echo"</thead></table>";
				echo"</form>";
					echo"</div></div>";
					?>
	
