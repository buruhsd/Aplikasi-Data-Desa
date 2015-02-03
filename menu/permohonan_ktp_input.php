<script>
function open_win() {
window.open( "menu/list_KTP.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
</script>

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
                                    <h3 class="box-title">Surat Permohonan KTP</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=permohonan_ktp_simpan' onSubmit='return cekkosong(this);'>";
echo"<table class='table'>";
echo"<tr>
        <td>Permohonan KTP</td>
        <td colspan='2'><div class='col-lg-10'>
		<input type='radio' name='permohonanKTP' value='Baru' checked/> A. Baru 
        <input type='radio' name='permohonanKTP' value='Perpanjangan' /> B. Perpanjangan 
		<input type='radio' name='permohonanKTP' value='Penggantian' /> C. Penggantian 		</div></td>
        </tr>";
echo"<tr><td>No Pengajuan KTP</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='no_ktp' id='no_ktp' class='form-control' required></div></td></tr>
	<tr>";
echo"<tr><td>NIK</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='NIK' id='NIK' class='form-control' required >
	<span class='input-group-btn'>
	<a href='javascript:void(0)' onClick='open_win()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
	<tr>";
echo"<tr><td>Nama Lengkap</td><td><div class='col-lg-5'>
		<input name='NamaLengkap' type='text' id='NamaLengkap' readonly='true' class='form-control'/></div></td></tr>";
echo"<tr><td>Nomor KK </td><td><div class='col-lg-5'>
		<input name='NoKK' type='text' id='NoKK' readonly='true' class='form-control'/></div></td></tr>";
echo"<tr><td>RT / RW</td><td><div class='col-lg-2'>
		<input name='RT' type='text' id='RT' readonly='true' class='form-control' /></div>
          <div class='col-lg-2'><input name='RW' type='text' id='RW' readonly='true' class='form-control' /></div></td></tr>
	<tr><td>Kode Pos</td><td><div class='col-lg-2'>
		<input name='KodePos' type='text' id='KodePos' readonly='true' class='form-control' /></td></tr>";
echo"<tr><td>Alamat</td><td><div class='col-lg-6'>
		<input name='Alamat' type='text' id='Alamat' readonly='true' class='form-control'/></td></tr>";
echo" <tr><td>Provinsi</td><td><div class='col-md-3'>
			<input type='text' name='ProvID' readonly='true' class='form-control' id='ProvID'/></div>
		<div class='col-md-4'>
			<input type='text' name='Prov' readonly='true' class='form-control' id='Prov'/></div></td></tr>
	<tr><td>Kabupaten/Kota</td><td><div class='col-md-3'>
			<input type='text' name='KabID' id='KabID' readonly='true' class='form-control'/></div>
			<div class='col-md-4'>
			<input type='text' name='Kab' id='Kab' readonly='true' class='form-control'/></div></td></tr>
	 <tr><td>Kecamatan</td><td><div class='col-md-3'>
			<input type='text' name='KecID' id='KecID' readonly='true' class='form-control'/></div>
			<div class='col-md-4'>
			<input type='text' name='Kec' id='Kec' readonly='true' class='form-control'/></div></td></tr>
     <tr><td>Desa/Kelurahan</td><td><div class='col-md-3'>
			<input type='text' name='KelurahanID' id='KelurahanID' readonly='true' class='form-control'/></div>
			<div class='col-md-4'>
			<input type='text' name='Kelurahan' id='Kelurahan' readonly='true' class='form-control'/></div></td></tr>
	<tr><td>Tanda Tangan Kelurahan</td><td><div class='col-md-3'><select name='tanda_tangan' id='tanda_tangan' class='form-control'>
							<option value='Kepala Desa'>Kepala Desa</option>
							<option value='Sekretaris Desa'>Sekretaris Desa</option>
	</div></select></td></tr>";
echo"<tr><td colspan='2'>
				<p align='center'>
				<button type='submit' name='simpan' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Simpan dan Cetak</button>
				<button type='reset' class='btn btn-primary' onclick=self.history.back()>
					<i class='fa fa-fw fa-repeat'></i>Batal</button></p></td></tr>";
		echo"</thead></table>";
				echo"</form>";
					echo"</div></div>";
?>