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
                                    <h3 class="box-title">Laporan Data Permohonan KTP</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
<?php
echo"<form method='POST' action='media.php?mn=data_permohonan_kk'>";
echo"<table class='table'>";
echo"<tr><td>Rincian Data Kelahiran</td><td><div class='col-md-5'>
<div class='input-group'><select name='tahun' class='form-control'>
<option value='0' selected>Pilih Tahun</option>
<option value=''>Semua Data</option>";
$getdata=mysql_query("SELECT distinct(SUBSTR(tanggal,1,4)) as thn FROM tblpermohonan_kk  ORDER BY tanggal DESC");

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
$cek_data = mysql_query ("SELECT * FROM tblpermohonan_kk where tanggal like '%$tahun%' ORDER BY no_kk_kel DESC");
$cek 	 = mysql_num_rows($cek_data);
	if ($cek > 0)
	{
	?>
	<div class="callout callout-info">
	<p><h4>Rincian Data Permohonan KK Tahun <?php echo"$tahun";?></h4></p>
    <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
         <thead>
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
            <tbody>
<?php
  $no=1;
  while ($dt=mysql_fetch_array($cek_data))
  {
  $kab 	= mysql_query ("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota from tblkabkota where KabKotaID='$dt[tempat_lahir]'");
  $kb 	= mysql_fetch_array($kab);
  $tgllahir = $dt['tgl_lahir'];
  $lahir 	=tgl_indo($tgllahir);
  $umur		=umur($tgllahir);
    echo"<tr>
		<td>$no</td>
    <td>$dt[no_kk_kel]</td>
		<td>$dt[no_ktp]</td>
		<td>".strtoupper($dt['nama_lengkap'])."</td>
		<td>$kb[NamaKabKota]</td>
			<td>$lahir</td>
          <td>$umur</td>";
		  if($dt['jenis_kelamin'] == 0){
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
		<li><a href=Print/kartukeluarga.php?id=$dt[no_kk_kel] target='_blank'><span class='glyphicon glyphicon-print'> Cetak</span></a></li>
      <li><a href=?mn=data_permohonan_kk_view&id=$dt[no_kk_kel]><span class='glyphicon glyphicon-list-alt'> View Keluarga</span></a></li>
       <li><a href=?mn=data_permohonan_kk_edit&id=$dt[id_kk]><span class='glyphicon glyphicon-pencil'> Edit</span></a></li>
      <li><a href=?mn=data_permohonan_kk_hapus&id=$dt[id_kk] onclick=\"return confirm('apakah akan menghapus data pemohon kk $dt[nama_lengkap]')\">
	  <span class='glyphicon glyphicon-trash'> Delete</span></a></li>
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
