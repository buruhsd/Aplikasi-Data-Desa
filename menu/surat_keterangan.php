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
                                    <h3 class="box-title">Data Surat Keterangan</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=surat_keterangan'>";
echo"<table class='table'>";
echo"<tr><td>Rincian Data Surat Keterangan</td><td><div class='col-md-5'>
<div class='input-group'><select name='tahun' class='form-control'>
<option value='0000' selected>Pilih Tahun</option>
<option value=''>Semua Data</option>";
$getdata=mysql_query("SELECT distinct(SUBSTR(Tanggal,1,4)) as thn FROM tblskumum");
    while($data=mysql_fetch_array($getdata)){
     echo"<option value=".$data['thn'].">".$data['thn']."</option>"; 
    }
echo"</select>";
echo"<span class='input-group-btn'><button class='btn btn-info btn-flat' name='btnTampil' type='submit'>Cari</button></a>
	</span>
	</div></div></td></tr></table></form>";
if($_POST){
	if (isset($_POST['btnTampil'])){
$tahun =$_POST['tahun'];
$cek_data = mysql_query ("SELECT * FROM tblkelahiran where TanggalEntry like '%$tahun%'");
$cek 	 = mysql_num_rows($cek_data);
	if ($cek > 0)
	{
	?>
	<div class="callout callout-info">
	<p><h4>Rincian Data Surat Keterangan Tahun <?php echo"$tahun";?></h4></p>
    <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
         <thead>
            <tr>
			<th>No Surat</th>
              <th>NIK</th>
              <th>Nama Lengkap</th>
			  <th>Jenis Kelamin</th>
			  <th>Alamat</th>
			  <th>Tanggal Pembuatan</th>
			  <th>Keperluan</th>
			  <th>Tanda Tangan Kelurahan</th>
			  <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
<?php
  $no=1;
  $data = mysql_query("SELECT tblskumum.id,
						tblskumum.no_surat,
						tblskumum.tanggal,
						tblskumum.nik,
						tblskumum.keperluan,
						tblskumum.tanda_tangan,
						tblpenduduk.NamaLengkap,
						tblpenduduk.JenisKelamin,
						tblpenduduk.Jalan
						FROM
						tblskumum
						INNER JOIN tblpenduduk ON tblskumum.nik = tblpenduduk.NoIdentitas ORDER BY tblskumum.tanggal ASC");
  while ($dt=mysql_fetch_array($data))
  {
    echo"<tr>
		<td>$no</td>
          <td>$dt[no_surat]</td>
          <td>".strtoupper($dt['NamaLengkap'])."</td>";
		  if($dt['JenisKelamin'] == 0){
		echo"<td>Laki-Laki</td>";
		}else{
		echo"<td>Perempuan</td>";
		}
        echo"<td>$dt[Jalan]</td>
			<td>$dt[tanggal]</td>
			<td>$dt[keperluan]</td>
			<td>$dt[tanda_tangan]</td>
		<td>
          <div class='btn-group'>
      <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
      <span class='glyphicon glyphicon-cog'> Pilih
          <span class='caret'></span>
        </button>
        <ul class='dropdown-menu'>
		<li><a href=Print/suratpengantar.php?id=$dt[no_surat] target='_blank'><span class='glyphicon glyphicon-print'> Cetak</span></a></li>
        <li><a href=?mn=surat_keterangan_edit&id=$dt[id]><span class='glyphicon glyphicon-pencil'> Edit</span></a></li>
      <li><a href=?mn=surat_keterangan_hapus&id=$dt[id] onclick=\"return confirm('apakah akan menghapus data  $dt[NamaLengkap]')\"><span class='glyphicon glyphicon-trash'> Delete</span></a></li>
      </div></td>
      </tr>";
      $no++;
  } 
  echo"</tbody>
      </table>
	</div></p>";
	}
	else
	{
	echo"<p><div class='callout callout-danger'>
	<p><h4><b>Alert!</b>
	Tidak Ada Data Rincian Kelahiran Tahun $tahun.</h4></p>
	</div></p>";
	  }
	  }
	 }
echo"</div></div></div>";

?>
