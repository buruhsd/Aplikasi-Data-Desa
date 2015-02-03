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
                                    <h3 class="box-title">Manajemen Menu</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=user_menu_tambah'>
<p><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Tambah</button></p>
</form>";
?>
          <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data Menu</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
							<th>No</th>
							<th>Nama Menu</th>
							<th>Link Menu</th>
							<th>Status</th>
							<th>Img</th>
							<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
<?php
                         $no=1;
	$menu = mysql_query("SELECT * from kel_menu ORDER BY nama_menu ASC");
	while ($mn=mysql_fetch_array($menu))
	{
		echo"<tr>
				<td>$no</td>
				<td>$mn[nama_menu]</td>
				<td>$mn[nama_link]</td>
				<td>$mn[status]</td>";
				if ($mn['img_menu'] == '')
				{
				echo"<td>Tanpa Icon</td>";
				}
				else
				{
				echo"<td><img src='$mn[img_menu]'></td>";
				}
			echo"<td>
			<div class='btn-group'>
	<button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
	<span class='glyphicon glyphicon-cog'> Pilih
      <span class='caret'></span>
    </button>
    <ul class='dropdown-menu'>
    <li><a href=?mn=user_menu_edit&id=$mn[id_menu_utama]><span class='glyphicon glyphicon-pencil'> Edit</span></a></li>
	<li><a href=?mn=user_menu_hapus&id=$mn[id_menu_utama] onclick=\"return confirm('apakah akan menghapus menu $mn[nama_menu]')\"><span class='glyphicon glyphicon-trash'> Delete</span></a></li>
	</div></td>
			</tr>";
			$no++;
	} 
	echo"</tbody>
			</table>";
echo"</div></div></div></div></div>";

?>
