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
                                    <h3 class="box-title">DATA KTP</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=permohonan_ktp_data'>";
echo"<table class='table'>";
echo"<tr><td>Rincian Data KTP</td><td><div class='col-md-5'>
<div class='input-group'><select name='tahun' class='form-control'>
<option value='0' selected>Pilih Tahun</option>
<option value=''>Semua Data</option>";
$getsiswa=mysql_query("SELECT distinct(SUBSTR(TanggalPermohonan,1,4)) as tgl FROM tblpermohonanktp");
  if($getsiswa){
    while($resultsiswa=mysql_fetch_array($getsiswa)){
     echo"<option value=".$resultsiswa['tgl'].">".$resultsiswa['tgl']."</option>"; 
    }
  }
echo"</select>";
echo"<span class='input-group-btn'><button class='btn btn-info btn-flat' name='btnTampil' type='submit'>Cari</button></a>
	</span>
	</div></div></td></tr></table></form>";
if($_POST){
	if (isset($_POST['btnTampil'])){
$tahun =$_POST['tahun'];
$cek_ktp = mysql_query ("SELECT * FROM tblpermohonanktp where TanggalPermohonan like '%$tahun%'");
$cek 	 = mysql_num_rows($cek_ktp);
	if ($cek > 0)
	{
	?>
	<div class="callout callout-info">
	<p><h4>Rincian Data KTP Tahun <?php echo"$tahun";?></h4></p>
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
											  <th>No</th>
											  <th>No Pengajuan</th>
											  <th>Nama Lengkap</th>
											  <th>Nomor KK</th>
											  <th>NIK</th>
											  <th>Alamat</th>
											  <th>Keterangan</th>
											  <th>Yang Bertanda Tangan</th>
											  <th>Aksi</th>
											  </tr>
											</thead>
											<tbody>
<?php
  $no=1;
  $data_ktp = mysql_query("SELECT
  							tblpermohonanktp.no_pengajuan,
							tblpermohonanktp.NIK,
							tblpermohonanktp.Permohonan,
							tblpermohonanktp.tanda_tangan,
							tblpermohonanktp.NamaAparat,
							tblpenduduk.Jalan,
							tblpenduduk.NoKK,
							tblpenduduk.NamaLengkap
							FROM
							tblpermohonanktp
							LEFT JOIN tblpenduduk ON tblpenduduk.NoIdentitas = tblpermohonanktp.NIK
							WHERE tblpermohonanktp.TanggalPermohonan like '%$tahun%'
							ORDER BY tblpermohonanktp.TanggalPermohonan DESC");
  while ($ktp=mysql_fetch_array($data_ktp))
  {
    echo"<tr>
          <td>$no</td>
           <td>".strtoupper($ktp['no_pengajuan'])."</td>
          <td>".strtoupper($ktp['NamaLengkap'])."</td>
		  <td>".$ktp['NoKK']."</td>
		  <td>".$ktp['NIK']."</td>
		  <td>".$ktp['Jalan']."</td>
		  <td>".$ktp['Permohonan']."</td>
		  <td>".$ktp['tanda_tangan']."</td>
          <td>
          <div class='btn-group'>
      <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
      <span class='glyphicon glyphicon-cog'> Pilih
          <span class='caret'></span>
        </button>
        <ul class='dropdown-menu'>
        <li><a href=Print/surat_permohonan_ktp.php?id=$ktp[NIK] target='_blank'><span class='glyphicon glyphicon-print'> Cetak</span></a></li>
		<li><a href=?mn=permohonan_ktp_edit&id=$ktp[NIK]><span class='glyphicon glyphicon-pencil'> Edit</span></a></li>
      <li><a href=?mn=permohonan_ktp_hapus&id=$ktp[NIK] onclick=\"return confirm('apakah akan menghapus data KTP  $ktp[NamaLengkap]')\"><span class='glyphicon glyphicon-trash'> Delete</span></a></li>
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
	Tidak Ada Data Rincian KTP Tahun $tahun.</h4></p>
	</div></p>";
	  }
	  }
	 }
echo"</div></div></div>";
?>