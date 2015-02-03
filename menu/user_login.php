<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";

echo" <div class='box box-primary'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Manajemen User</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-primary btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";
echo"<form method='POST' action='media.php?mn=user_login_tambah'>
<p><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Tambah</button></p>
</form>";
echo"<div class='box'>
        <div class='box-header'>
            <h3 class='box-title'>Data Menu</h3>                                    
         </div>
          <div class='box-body table-responsive'>
          <table id='example1' class='table table-bordered table-striped'>
            <thead>
             <tr>
			<th>No</th>
			<th>Username</th>
			<th>Nama Lengkap</th>
			<th>No. Telp</th>
			<th>Aktif</th>
			<th>Aksi</th>
			</tr>
		</thead>
		<tbody>";

	$no=1;
	$user_login = mysql_query("SELECT * from kel_login ORDER BY nm_lengkap ASC");
	while ($usr=mysql_fetch_array($user_login))
	{
		echo"<tr>
				<td>$no</td>
				<td>$usr[id_user]</td>
				<td>$usr[nm_lengkap]</td>
				<td>$usr[no_telp]</td>";
				if($usr['aktif'] == '1')
				{
				echo"<td>Aktif</td>";
				}
				else
				{
				echo"<td>Non Aktif</td>";
				}
		echo"<td>
		<div class='btn-group'>
	<button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
	<span class='glyphicon glyphicon-cog'> Pilih
      <span class='caret'></span>
    </button>
    <ul class='dropdown-menu'>
    <li><a href=?mn=user_login_edit&id=$usr[id_user]><span class='glyphicon glyphicon-pencil'> Edit</span></a></li>
	<li><a href=?mn=user_login_hapus&id=$usr[id_user] onclick=\"return confirm('apakah akan menghapus Username $usr[id_user]')\"><span class='glyphicon glyphicon-trash'> Delete</span></a></li></td>
			</tr>";
			$no++;
	} 
	echo"</tbody>
			</table>";
			echo"</div></div></div>";
?>
