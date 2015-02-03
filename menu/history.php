<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
date_default_timezone_set("Asia/Jakarta");

?>      
  <div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">History</div>
<?php
echo"<form method='POST' action='media.php?mn=history'>
						<table class='table table-striped'>
						  <thead>
<tr><td>Username</td><td><div class='col-md-4'>
<select name='username' id='username' class='selectpicker show-tick form-control' data-live-search='true'>
      <option value=''>::pilih::</option>";
      $username = mysql_query ("SELECT id_user FROM kel_login ORDER BY id_user ASC");
      while($user = mysql_fetch_array($username))
      {
      	echo"<option value='$user[id_user]'>$user[id_user]</option>";
      }
     	echo"</select></div></td>
<tr><td>Tanggal Awal</td><td> <div class='col-md-10'>
<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd'>
                    <input class='form-control' size='16' type='text' value='' placeholder='tanggal mulai' required>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
				<input type='hidden' id='dtp_input2' value='' name='awal'>
                </div></div></td></tr>
<tr><td>Tanggal Awal</td><td><div class='col-md-10'>
				<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input3' data-link-format='yyyy-mm-dd'>
                    <input class='form-control' size='16' type='text' value='' placeholder='tanggal akhir' required>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
                <input type='hidden' id='dtp_input3' value='' name='akhir'></div></td></tr>";
echo "<tr><td colspan='2'><p align='right'><button name='btnHistori' type='submit' class='btn btn-info'>
								 				<span class='glyphicon glyphicon-search'></span>Cari Data</button></p>
</thead></table>";
echo"</form>";

if($_POST) {
	# TOMBOL PILIH (KODE barang) DIKLIK
	if(isset($_POST['btnHistori'])){
	$username 	= $_POST['username'];
	$tglawal 	= $_POST['awal'];
	$tglakhir	= $_POST['akhir'];

	$no=1;
	$bagianwhere ="";
		if(isset($username))
	{
		if(empty($bagianwhere))
		{
			$bagianwhere .="AND user like '%$username%'";
		}
		else
		{
			$bagianwhere .="AND user like '%%'";
		}
	}
	
	echo"<h4>Data History Aktifitas Username $username Tanggal ".tgl_indo($tglawal)." s/d Tanggal ".tgl_indo($tglakhir)."</h4>";
	?>
<table class="table">
						  <thead>
							  <tr>
							  <th>No</th><th>Waktu</th><th>Aktifitas</th><th>User</th>
								</tr>
								<?php
	$pencarian = mysql_query ("SELECT * from history where tanggal BETWEEN '$tglawal' AND '$tglakhir' ".$bagianwhere."");
	while ($cari =mysql_fetch_array($pencarian))
	{	
		$tanggal=tgl_indo($cari['tanggal']);
		$jam 	= substr($cari['tanggal'],10,9);
		echo"<tr><td>$no</td>
				<td>$tanggal $jam</td>
				<td>$cari[keterangan]</td>
				<td>$cari[user]</td></tr>";
				$no++;
	}
	echo"</table>";
}
}
echo"</div>";
?>
