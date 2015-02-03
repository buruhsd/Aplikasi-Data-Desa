<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
$id = $_GET['id'];
?>
  <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Laporan Data Mutasi View</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
<?php
echo"<form method='POST' action='media.php?mn=data_permohonan_kk_lagi'>";
echo"<input type=hidden name='kk' value='$id' class='form-control' required >";
echo"<p><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-plus'></i>Tambah Keluarga</button></p>";
echo"</form>";
echo"<table class='table table-bordered'>";
echo"<thead>
            <tr>
			<th>No</th>
       		 <th>No Permohonan KK</th>
			  <th>No KTP</th>
			  <th>Nama Lengkap</th>
			  <th>Tempat Lahir</th>
			  <th>Tgl Lahir</th>
			  <th>Umur</th>
			  <th>Jenis Kelamin</th>
			  <th>Aksi</th>
              </tr>
            </thead>
            <tbody>";

	$no=1;
	$cek_data = mysql_query ("SELECT * FROM tblpenduduk where NoKK='$id' ORDER BY UrutPosisiKK ASC");
 	while ($dt=mysql_fetch_array($cek_data))
  	{
  $kab 	= mysql_query ("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota from tblkabkota where KabKotaID='$dt[TempatLahir]'");
  $kb 	= mysql_fetch_array($kab);
  $tgllahir = $dt['TanggalLahir'];
  $lahir 	=tgl_indo($tgllahir);
  $umur		=umur($tgllahir);
    echo"<tr>
		<td>$no</td>
    <td>$dt[NoKK]</td>
		<td>$dt[NoIdentitas]</td>
		<td>".strtoupper($dt['NamaLengkap'])."</td>
		<td>$kb[NamaKabKota]</td>
			<td>$lahir</td>
          <td>$umur</td>";
		  if($dt['JenisKelamin'] == 0){
				echo"<td>Laki-Laki</td>";
				}else{
				echo"<td>Perempuan</td>";
				}
			echo"<td>
          <div class='btn-group'>
      <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
      <span class='glyphicon glyphicon-cog'> Pilih
          <span class='caret'></span>
        </button>
        <ul class='dropdown-menu'>
		<li><a href=Print/surat_pindah_wni.php?id=$dt[id] target='_blank'><span class='glyphicon glyphicon-print'> Cetak</span></a></li>
        <li><a href=?mn=input_data_mutasi_edit&id=$dt[id]><span class='glyphicon glyphicon-pencil'> Edit</span></a></li>
      </div></td>
      </tr>";
      $no++;
	  }
  echo"</tbody>
      </table>";
      echo"</div>";
      ?>