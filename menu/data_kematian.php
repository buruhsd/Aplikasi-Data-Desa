<?php
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
?>
  <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Daftar Data Kematian</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=data_kematian'>";
echo"<table class='table'>";
echo"<tr><td>Rincian Data Kematian</td><td><div class='col-md-5'>
<div class='input-group'><select name='tahun' class='form-control'>
<option value='0000' selected>Pilih Tahun</option>
<option value=''>Semua Data</option>";
$getdata=mysql_query("SELECT distinct(SUBSTR(TanggalEntry,1,4)) as thn FROM tblkematian");
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
	<p><h4>Rincian Data Kematian Tahun <?php echo"$tahun";?></h4></p>
    <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
         <thead>
            <tr>
			<th>No</th>
			<th>No Surat Kematian</th>
			  <th>Nama Lengkap</th>
              <th>Tanggal Kematian</th>
			  <th>Jam Kematian</th>
			  <th>Sebab Kematian</th>
			  <th>Tempat Kematian</th>
			  <th>Yang Menerangkan Kematian</th>
			  <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
<?php
  $no=1;
  $data = mysql_query("SELECT * FROM tblkematian ORDER BY NoSuratKematian desc");
  while ($dt=mysql_fetch_array($data))
  {
    echo"<tr>
		<td>$no</td>
          <td>$dt[NoSuratKematian]</td>
		  <td>".strtoupper($dt['NamaLengkapJenazah'])."</td>
			<td>$dt[TglKematianJenazah]</td>
			<td>$dt[JamKematianJenazah]</td>
			<td>$dt[SebabKematianIDJenazah]</td>
			<td>$dt[TempatKematianJenazah]</td>
			<td>$dt[YangMenerangkanKematian]</td>
		<td>
          <div class='btn-group'>
      <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
      <span class='glyphicon glyphicon-cog'> Pilih
          <span class='caret'></span>
        </button>
        <ul class='dropdown-menu'>
      <li><a href=Print/surat_kematian_new.php?id=$dt[NIK_Jenazah] target='_blank'><span class='glyphicon glyphicon-print'> Cetak Kel</span></a></li>
	   <li><a href=Print/surat_kematian.php?id=$dt[NIK_Jenazah] target='_blank'><span class='glyphicon glyphicon-print'> Cetak Warga</span></a></li>
        <li><a href=?mn=input_data_kematian_edit&id=$dt[KematianID]><span class='glyphicon glyphicon-pencil'> Edit</span></a></li>
      <li><a href=?mn=input_data_kematian_hapus&id=$dt[KematianID] onclick=\"return confirm('apakah akan menghapus data jenazah $dt[NamaLengkapJenazah]')\">
	  <span class='glyphicon glyphicon-trash'> Delete</span></a></li>
      </div></td>
      </tr>";
      $no++;
  } 
  echo"</tbody>
      </table></div></p>";
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
