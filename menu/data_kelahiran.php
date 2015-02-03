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
                                    <h3 class="box-title">Daftar Data Kelahiran</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=data_kelahiran'>";
echo"<table class='table'>";
echo"<tr><td>Rincian Data Kelahiran</td><td><div class='col-md-5'>
<div class='input-group'><select name='tahun' class='form-control'>
<option value='0000' selected>Pilih Tahun</option>
<option value=''>Semua Data</option>";
$getdata=mysql_query("SELECT distinct(SUBSTR(TanggalEntry,1,4)) as thn FROM tblkelahiran");
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
	<p><h4>Rincian Data Kelahiran Tahun <?php echo"$tahun";?></h4></p>
    <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
         <thead>
            <tr>
			<th>No</th>
			<th>No Surat Kelahiran</th>
              <th>No KK</th>
			  <th>Nama Bayi</th>
			  <th>Jenis Kelamin Bayi</th>
			  <th>Tempat Lahir Bayi</th>
			  <th>Hari, Tgl Lahir Bayi</th>
			  <th>Nama Ibu</th>
			  <th>Nama Ayah</th>
			  <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
<?php
  $no=1;
  $data = mysql_query("SELECT * FROM tblkelahiran where TanggalEntry like '%$tahun%' ORDER BY no_kelahiran desc");
  while ($dt=mysql_fetch_array($data))
  {
  $kab 	= mysql_query ("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota from tblkabkota where KabKotaID='$dt[TempatKelahiran]'");
  $kb 	= mysql_fetch_array($kab);
  $ibu 	= mysql_query ("SELECT * FROM tblpenduduk where NoIdentitas='$dt[nik_ibu]'");
  $ib	= mysql_fetch_array($ibu);
  $ayah = mysql_query ("SELECT * FROM tblpenduduk where NoIdentitas='$dt[nik_ayah]'");
  $ay	= mysql_fetch_array($ayah);
    echo"<tr>
		<td>$no</td>
          <td>$dt[no_kelahiran]</td>
		<td>$dt[NoKK]</td>
		  <td>".strtoupper($dt['NamaBayi'])."</td>";
		  if($dt['JKelBayi'] == 0){
				echo"<td>Laki-Laki</td>";
				}else{
				echo"<td>Perempuan</td>";
				}
        echo"<td>$kb[NamaKabKota]</td>
			<td>$dt[TglLahir] Hari</td>
          <td>".strtoupper($ib['NamaLengkap'])."</td>
          <td>".strtoupper($ay['NamaLengkap'])."</td>
		<td>
          <div class='btn-group'>
      <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
      <span class='glyphicon glyphicon-cog'> Pilih
          <span class='caret'></span>
        </button>
        <ul class='dropdown-menu'>
      <li><a href=Print/surat_kelahiran_new.php?id=$dt[no_kelahiran] target='_blank'><span class='glyphicon glyphicon-print'> Cetak Kel</span></a></li>
	  <li><a href=Print/surat_kelahiran_new.php?id=$dt[no_kelahiran] target='_blank'><span class='glyphicon glyphicon-print'> Cetak Warga</span></a></li>
        <li><a href=?mn=input_data_kelahiran_edit&id=$dt[id]><span class='glyphicon glyphicon-pencil'> Edit</span></a></li>
      <li><a href=?mn=input_data_kelahiran_hapus&id=$dt[id] onclick=\"return confirm('apakah akan menghapus data bayi $dt[NamaBayi]')\">
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
