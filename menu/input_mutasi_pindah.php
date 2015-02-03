<script>
function open_win() {
window.open( "menu/list_Keterangan.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
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
date_default_timezone_set("Asia/Jakarta");
echo"<div class='box box-primary'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Input Mutasi Pindah</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-primary btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

echo"<form method='POST' action='media.php?mn=input_mutasi_datang_simpan' enctype='multipart/form-data' name='FUpload' id='FUpload'>";
echo"<table class='table'>
<tr>
    <td>NIK</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='nik' id='Nik' class='form-control' required>
	<span class='input-group-btn'>
	<a href='javascript:void(0)' onClick='open_win()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
  <tr>
    <td>Nama</td><td><div class='col-md-5'>
    <input type='text' name='nama' id='Nama' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Nomor KK </td>
    <td><div class='col-md-5'>
    <input type='text' name='no_kk' id='No_kk' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Tempat Lahir </td><td><div class='col-md-4'>
    <input type='text' name='tempat_lahir' id='Tempat_lahir' class='form-control'/></div>
  </tr>
  <tr><td>Tanggal Lahir</td>
	<td><div class='col-md-4'>
    <input type='text' name='tgl_lahir' id='Tgl_lahir' class='form-control'/></div></td>
	</tr>
  <tr>
    <td>Jenis Kelamin </td>
    <td><div class='col-md-4'>
    <input type='text' name='jkel' id='Jkel' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Pekerjaan</td>
    <td><div class='col-md-5'>
    <input type='text' name='pekerjaan' id='Pekerjaan' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Kewarganegaraan</td>
    <td><div class='col-md-4'>
    <input type='text' name='kewarganegaraan' id='Kewarganegaraan' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Agama</td>
    <td><div class='col-md-4'>
    <input type='text' name='agama' id='Agama' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td><div class='col-md-7'>
    <input type='text' name='alamat' id='Alamat' class='form-control'/></div></td>
  </tr>
  <tr>
  <tr><td>Desa/Kelurahan</td><td><div class='col-md-4'>
			<input type='text' name='kelurahan' id='Kelurahan' class='form-control'/>
			<input type='hidden' name='kelurahanid' id='KelurahanID' class='form-control'/></div></td></tr>
      <tr><td>Kecamatan</td><td><div class='col-md-3'>
			<input type='text' name='kec' id='Kec' class='form-control'/></div></td></tr>
      <tr><td>Kabupaten/Kota</td><td><div class='col-md-3'>
			<input type='text' name='kab' id='Kab' class='form-control'/></div></td></tr>
			
	<tr><td>Nama Lengkap</td><td><div class='col-md-7'><div class='input-group'><input type=text name='nama_lengkap' id='Nama' class='form-control' required >
  <span class='input-group-btn'>
  <a href='javascript:void(0)' onClick='open_win()'>
  <button class='btn btn-info btn-flat' type='button'>Go!</button></a>
  </span>
  </div></td></tr>
	<tr><td>Jenis Kelamin</td><td><div class='col-md-5'><input type=text name='kelamin' id='Kelamin1' class='form-control' required>
                                                        <input type=hidden name='jenis_kelamin' id='Kelamin' class='form-control' required>  
	<tr><td>Tempat Lahir</td><td>
	<div class='col-md-5'><input type=text name='tempat_lahir1' id='Tempat1' class='form-control' required>
                        <input type=hidden name='tempat_lahir' id='Tempat' class='form-control' required>";
	echo"</div></td></tr>";
echo"<tr><td>Tanggal Lahir</td><td><div class='col-md-4'><input type=text name='tgl_lahir' id='Lahir' class='form-control' required ></div></td></tr>";
echo"<tr><td>No KTP</td><td><div class='col-md-6'><input type=text name='no_ktp' id='KTP' class='form-control' required></div></td></tr>";

<?php
include "library/koneksi.php";
date_default_timezone_set("Asia/Jakarta");
?>
  <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Data Mutasi Penduduk</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=input_mutasi_datang_simpan' enctype='multipart/form-data' name='FUpload' id='FUpload'>";
echo"<table class='table'>";
echo"<tr><td colspan='2' bgcolor='#99CCFF'><center>Jenis Mutasi Pindah</center><input type=hidden name='status' value='mutasi pindah' class='form-control'></td></tr>

		<tr>
			<td>Nama Lengkap</td><td><div class='col-md-5'><input type=text name='NamaLengkap' class='form-control' required></div></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
				<td><div class='col-md-5'>
						<select name='JenisKelamin' id='JenisKelamin' class='form-control'>
							<option value=''>::Pilih::</option>
							<option value='0' >Laki-laki</option>
							<option value='1' >Perempuan</option>
						</select></div></td>
				</tr>
				<tr>
					<td>Tempat Lahir</td>
					<td><div class='col-md-5'>
						<select name='TempatLahir' id='TempatLahir' class='selectpicker show-tick form-control' data-live-search='true'>
							<option value=''>Pilih Tempat Lahir</option>";
							$tmp_lahir = mysql_query ("SELECT * from tblkabkota ORDER BY NamaKabKota ASC");
							while($lahir=mysql_fetch_array($tmp_lahir))
							{
							echo"<option value='$lahir[KabKotaID]'>$lahir[NamaKabKota]</option>";
							}
							echo"</div></select></td></tr>";
	echo"<tr>
					<td>Tanggal Lahir</td>
					<td><div class='col-md-10'> 
						<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value=''>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2' value='' name='TanggalLahir'></div></td></tr>
				<tr>
					<td>No. Kartu Keluarga Lama</td>
					<td><div class='col-md-5'><input type='text' name='xNoKKLama' class='form-control' /></td>
				</tr>
				<tr>
					<td>Posisi dalam Keluarga</td>
					<td><div class='col-md-4'><select name='PosisiKKID' id='PosisiKKID' class='selectpicker show-tick form-control' data-live-search='true' required>
					      <option value=''>::pilih::</option>";
					      $posisikk = mysql_query ("SELECT * from tblposisikk ORDER BY PosisiKKID ASC");
					      while($pkk = mysql_fetch_array($posisikk))
					      {
					      	echo"<option value='$pkk[PosisiKKID]'>$pkk[NamaPosisiKK]</option>";
					      }
					     	echo"</select></div><div class='col-md-3'>
					     	<input type='text' name='UrutPosisiKK' Placeholder='Urutan Posisi KK' required class='form-control' onKeyPress='return numbersonly(this, event)'></div>
					     	</td></tr>
				<tr>
					<td>Nomor NIK/Identitas</td>
					<td><div class='col-md-2'>
					<select name='KartuID' id='KartuID' class='form-control' required>
                      <option value=''>::Pilih::</option>
                      <option value='0'>KTP</option>
                      <option value='1'>Passport</option>
						</select></div>";
echo"<div class='col-md-6'>
	<input type=text name='NoIdentitas' class='form-control' required></div></td></tr>
				<tr>
					<td>Agama</td>
					<td><div class='col-md-5'><select name='Agama' id='Agama' class='form-control' required>
							<option value=''>::Pilih::</option>";
	$agama = mysql_query("SELECT * from tblagama");
	while ($agm = mysql_fetch_array($agama))
	{
	echo"<option value='$agm[AgamaID]'>$agm[NamaAgama]</option>";	
	}
		echo"</div></select></td></tr>
				<tr>
					<td>Status Perkawinan</td>
					<td><div class='col-md-5'><select name='StatusPerkawinan' id='StatusPerkawinan' class='form-control' required>
							<option value=''>::Pilih::</option>";
	$StatusPerkawinan = mysql_query ("SELECT * from tblstatuskawin");
	while ($kawin=mysql_fetch_array($StatusPerkawinan))
	{
		echo"<option value='$kawin[StatusPerkawinan]'>$kawin[NamaStatusPerkawinan]</option>";	
	}
echo"</div></select></td></tr>
			<tr><td>Status Kependudukan</td><td><div class='col-md-5'>
						<select name='StatusKependudukan' id='StatusKependudukan' class='form-control' required>
							<option value=''>::Pilih::</option>
							<option value='0'>WNI</option>
							<option value='1'>WNA</option>
	</div></select></td></tr>
	<tr><td>Pekerjaan</td><td><div class='col-md-5'>
						<select name='Pekerjaan' id='Pekerjaan' required class='selectpicker show-tick form-control' data-live-search='true' >
							<option value=''>::Pilih::</option>";
	$Pekerjaan = mysql_query("SELECT * from tblpekerjaan");
	while($pkj=mysql_fetch_array($Pekerjaan))
	{
		echo"<option value='$pkj[PekerjaanID]'>$pkj[NamaPekerjaan]</option>";
	}
echo"</div></select></td></tr>";
echo"<tr><td>Provinsi Lama</td><td>
	 <div class='col-lg-5'>
	<select id='provinsi1' name='provinsi1' class='selectpicker show-tick form-control' data-live-search='true' required>
	<option value=''>Pilih Provinsi</option>";
	$provinsi = mysql_query("SELECT * from tblprovinsi");
	while ($prov=mysql_fetch_array($provinsi))
	{
		echo"<option value='$prov[ProvinsiID]'>$prov[NamaProvinsi]</option>";
	}
echo"</select></div></td></tr>";
echo"<tr><td>Kabupaten Lama</td><td>
	 <div class='col-md-5'>
	<select id='kota1' name='kota1' class='form-control'>
	<option value=''>Pilih Kab Kota</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kecamatan Lama</td><td>
	 <div class='col-md-5'>
	<select id='kec1' name='kec1' class='form-control'>
	<option value=''>Pilih Kecamatan</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kelurahan Lama</td><td>
	 <div class='col-md-5'>
	<select id='kel1' name='kel1' class='form-control'>
	<option value=''>Pilih Kelurahan</option>";
echo"</div></select></td></tr>";
echo"<tr>
                  <td>Nama Jalan Lama</td>
				  <td> <div class='col-md-5'><input type='text' name='xJalanLama' id='xJalanLama' class='form-control'/></td>
			  </tr>";
echo"<tr><td>RT Lama / RW Lama</td><td><div class='col-md-2'><input type='text' name='xRTLama' id='xRTLama' required class='form-control' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
							<div class='col-md-2'><input type='text' name='xRWLama' id='xRWLama' placeholder='RW' class='form-control' required onKeyPress='return numbersonly(this, event)'></div></td>
				</tr>
				<tr>";
echo"<tr><td>Kode Pos Lama</td><td><div class='col-md-4'><input type='text' name='xKodePosLama' id='xKodePosLama' class='form-control' onKeyPress='return numbersonly(this, event)'></td></tr>";
echo"<tr><td>Pendidikan Terakhir </td>
				  <td><div class='col-md-5'><select name='PendidikanID' id='PendidikanID' class='form-control'>
                    <option value=''>::pilih::</option>";
                    $Pendidikan = mysql_query("SELECT * from tblpendidikan");
                    while ($pdd = mysql_fetch_array($Pendidikan))
                    {
                    echo" <option value='$pdd[PendidikanID]'>$pdd[NamaPendidikan]</option>";
                    }
echo"</div></select></td></tr>";   
echo"<tr><td>Dapat Membaca Huruf </td> 
				  <td><div class='col-md-5'><select name='BacaID' id='BacaID' class='form-control'>
                    <option value=''>::pilih::</option>";
					$sql_huruf = mysql_query("SELECT * from tblbacahuruf");
					while ($hrf = mysql_fetch_array($sql_huruf))
					{
					echo"<option value='$hrf[BacaID]'>$hrf[Keterangan]</option>";
					}
echo"</div></select></td></tr>";   
echo"<tr><td>No. Telpon</td><td><div class='col-md-3'><input type='text' name='NoTelp' id='NoTelp' class='form-control' onKeyPress='return numbersonly(this, event)'></div></td></tr>";
echo"<tr><td>No. Handphone</td><td><div class='col-md-3'><input type='text' name='NoHP' id='NoHP' class='form-control' onKeyPress='return numbersonly(this, event)'></div></td></tr>";
echo"<tr><td>Email</td><td><div class='col-md-5'><input type='text' name='Email' id='Email' class='form-control'></div></td></tr>";
echo"<tr><td>Website</td><td><div class='col-md-5'><input type='text' name='WebSite' id='WebSite' class='form-control'></div></td></tr>";
echo"<tr><td colspan='2'><b>Keterangan</b></td></tr>";
echo"<tr><td>Alasan Pindah </td> 
				  <td><div class='col-md-5'><select name='AlasanPindah' id='AlasanPindah' class='form-control' required>";
					$pindah= mysql_query("SELECT AlasanPindahID,NamaAlasanPindah FROM tblalasanpindah");
					while ($pdh = mysql_fetch_array($pindah))
					{
					echo"<option value='$pdh[AlasanPindahID]'>$pdh[NamaAlasanPindah]</option>";
					}
echo"</div></select></td></tr>";  
echo"<tr><td>Klasifikasi Pindah</td> 
				  <td><div class='col-md-5'><select name='KlasifikasiPindah' id='KlasifikasiPindah' class='form-control' required>";
					$kpindah= mysql_query("SELECT KlasifikasiPindahID,NamaKlasifikasiPindah FROM tblklasifikasipindah");
					while ($kpdh = mysql_fetch_array($kpindah))
					{
					echo"<option value='$kpdh[KlasifikasiPindahID]'>$kpdh[NamaKlasifikasiPindah]</option>";
					}
echo"</div></select></td></tr>";  
echo"<tr><td>Jenis Kepindahan</td> 
				  <td><div class='col-md-5'><select name='JenisKepindahan' id='JenisKepindahan' class='form-control' required>";
					$jpindah= mysql_query("SELECT JenisKepindahanID, NamaJenisKepindahan FROM tbljeniskepindahan");
					while ($jpdh = mysql_fetch_array($jpindah))
					{
					echo"<option value='$jpdh[JenisKepindahanID]'>$jpdh[NamaJenisKepindahan]</option>";
					}
echo"</div></select></td></tr>";  
echo"<tr><td>Status KK Tidak Pindah</td> 
				  <td><div class='col-md-5'><select name='KKTidakPindah' id='KKTidakPindah' class='form-control' required>";
					$ktpindah= mysql_query("SELECT StatusKKID,NamaStatusKK FROM tblstatuskk");
					while ($ktpdh = mysql_fetch_array($ktpindah))
					{
					echo"<option value='$ktpdh[StatusKKID]'>$ktpdh[NamaStatusKK]</option>";
					}
echo"</div></select></td></tr>"; 
echo"<tr><td>Status KK Pindah</td> 
				  <td><div class='col-md-5'><select name='KKPindah' id='KKPindah' class='form-control' required>";
					$kkpindah= mysql_query("SELECT StatusKKID,NamaStatusKK FROM tblstatuskk");
					while ($kkpdh = mysql_fetch_array($kkpindah))
					{
					echo"<option value='$kkpdh[StatusKKID]'>$kkpdh[NamaStatusKK]</option>";
					}
echo"</div></select></td></tr>"; 
echo"<tr>
					<td>Tanggal Pindah/Datang</td>
					<td><div class='col-md-10'> 
						<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input3' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value=''>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input3' value='' name='xTanggalPindah'></div></td></tr>
					<tr>
						<td colspan='2'><b>Alamat Sekarang (untuk Pendatang/Pindahan/Temporary)</b></td>
					</tr>";
echo"<tr><td>Kewarganegaraan</td> <td><div class='col-md-5'>
<select name='xNegaraID' id='xNegaraID' class='selectpicker show-tick form-control' data-live-search='true' required>
                    <option value=''>::pilih::</option>";
			$negara = mysql_query ("SELECT * from tblnegara ORDER BY NamaNegara ASC");
			while ($ngr=mysql_fetch_array($negara)){
			echo"<option value='$ngr[NegaraID]'>$ngr[NamaNegara]</option>";
			}
echo"</div></select></td></tr>";
echo"<tr><td>No Kartu Keluarga</td><td><div class='col-md-8'><input type=text name='NoKK' class='form-control' required></div></td></tr>";
echo"<tr>
		<td>Jalan</td>
		<td><div class='col-md-5'><input type='text' name='Jalan' id='Jalan' required class='form-control'></div>
		</td></tr>";
echo"<tr><td>RT / RW</td><td><div class='col-md-2'><input type='text' name='RT' id='RT' required class='form-control' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
							<div class='col-md-2'><input type='text' name='RW' id='RW' placeholder='RW' class='form-control' required onKeyPress='return numbersonly(this, event)'></div></td>
				</tr>";
echo"<tr><td>Provinsi</td><td>
	 <div class='col-lg-5'>
	<select id='provinsi' name='provinsi' class='selectpicker show-tick form-control' data-live-search='true' required>
	<option value=''>Pilih Provinsi</option>";
	$provinsi = mysql_query("SELECT * from tblprovinsi");
	while ($prov=mysql_fetch_array($provinsi))
	{
		echo"<option value='$prov[ProvinsiID]'>$prov[NamaProvinsi]</option>";
	}
echo"</select></div></td></tr>";
echo"<tr><td>Kabupaten/Kota</td><td>
	 <div class='col-md-5'>
	<select id='kota' name='kota' class='form-control' required>
	<option value=''>Pilih Kab Kota</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kecamatan</td><td>
	 <div class='col-md-5'>
	<select id='kec' name='kec' class='form-control' required>
	<option value=''>Pilih Kecamatan</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kelurahan</td><td>
	 <div class='col-md-5'>
	<select id='kel' name='kel' class='form-control' required>
	<option value=''>Pilih Kelurahan</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Dusun</td><td><div class='col-md-5'>
		<select id='dusun' name='dusun' class='form-control'>
		<option value=''>Pilih Dusun</option>";
	echo"</div></select></td></tr>";
echo"<tr><td>Kode Pos</td><td><div class='col-md-4'><input type='text' name='KodePos' id='KodePos' class='form-control' onKeyPress='return numbersonly(this, event)'></td></tr>";
echo"<tr><td>Upload Foto</td><td><div class='col-md-10'><input type='file' name='nama_file' id='nama_file'>Bila Foto tidak ada kosongi saja</div></td></tr>";
echo"<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Simpan</button></p></td></tr>";
echo"</table>";
echo"</form>";
echo"</div>";
?>