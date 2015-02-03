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
  <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Data Penduduk Input</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=input_data_penduduk_simpan' enctype='multipart/form-data' name='FUpload' id='FUpload'>";
echo"<table class='table'>
	<tr><td>Nama Lengkap</td><td><div class='col-md-5'><input type=text name='nama_lengkap' class='form-control' required></div></td></tr>
	<tr><td>Jenis Kelamin</td><td><div class='col-md-5'>
		<select id='kelamin' name='kelamin' class='form-control' required>
		<option value=''>Pilih Jenis Kelamin</option>
		<option value='0'>Laki-Laki</option>
		<option value='1'>Perempuan</option>
		</div></select></td></tr>
	<tr><td>Tempat Lahir</td><td>
	<div class='col-md-5'>
	<select id='tmp_lahir' name='tmp_lahir' class='selectpicker show-tick form-control' data-live-search='true' required>
	<option value=''>Pilih Tempat Lahir</option>";
	$tmp_lahir = mysql_query ("SELECT * from tblkabkota ORDER BY NamaKabKota ASC");
	while($lahir=mysql_fetch_array($tmp_lahir))
	{
	echo"<option value='$lahir[KabKotaID]'>$lahir[NamaKabKota]</option>";
	}
	echo"</div></select></td></tr>";

echo"<tr><td>Tanggal Lahir</td><td><div class='col-md-10'> 
<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value=''>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2' value='' name='tgl_lahir'></div></td></tr>";
echo"<tr><td>No Kartu Keluarga</td><td><div class='col-md-8'><input type=text name='no_kk' class='form-control' required></div></td></tr>";
echo"<tr><td>Posisi dalam Keluarga</td><td><div class='col-md-4'>
	<select name='PosisiKKID' id='PosisiKKID' class='selectpicker show-tick form-control' data-live-search='true' required>
      <option value=''>::pilih::</option>";
      $posisikk = mysql_query ("SELECT * from tblposisikk ORDER BY PosisiKKID ASC");
      while($pkk = mysql_fetch_array($posisikk))
      {
      	echo"<option value='$pkk[PosisiKKID]'>$pkk[NamaPosisiKK]</option>";
      }
     	echo"</select></div>
		<div class='col-md-3'><input type='text' name='UrutPosisiKK' Placeholder='Urutan Posisi KK' required class='form-control' onKeyPress='return numbersonly(this, event)'></div></td></tr>";
echo"<tr><td>Nomor NIK KK/Identitas</td><td>";
echo"<div class='col-md-2'>
		<select name='KartuID' id='KartuID' class='form-control' required>
                      <option value=''>::Pilih::</option>
                      <option value='0'>KTP</option>
                      <option value='1'>Passport</option>
						</select>
		</div>";
echo"<div class='col-md-6'><input type=text name='noidentitas' class='form-control' required></div></td></tr>";
echo"<tr><td>Agama</td><td><div class='col-md-5'>
						<select name='Agama' id='Agama' class='form-control' required>
							<option value=''>::Pilih::</option>";
	$agama = mysql_query("SELECT * from tblagama");
	while ($agm = mysql_fetch_array($agama))
	{
	echo"<option value='$agm[AgamaID]'>$agm[NamaAgama]</option>";	
	}
		echo"</div></select></td></tr>";	
echo"<tr><td>Status Perkawinan</td><td><div class='col-md-5'>
						<select name='StatusPerkawinan' id='StatusPerkawinan' class='form-control' required>
							<option value=''>::Pilih::</option>";
	$StatusPerkawinan = mysql_query ("SELECT * from tblstatuskawin");
	while ($kawin=mysql_fetch_array($StatusPerkawinan))
	{
		echo"<option value='$kawin[StatusPerkawinan]'>$kawin[NamaStatusPerkawinan]</option>";	
	}
echo"</div></select></td></tr>";							
echo"<tr><td>Status Kependudukan</td><td><div class='col-md-5'>
						<select name='StatusKependudukan' id='StatusKependudukan' class='form-control' required>
							<option value=''>::Pilih::</option>
							<option value='0'>WNI</option>
							<option value='1'>WNA</option>
	</div></select></td></tr>";
echo"<tr><td>Penduduk Desa/Bukan</td><td><div class='col-md-5'>
						<select name='PendudukAsli' id='PendudukAsli' required class='form-control'>
							<option value=''>::pilih::</option>
							<option value='0'>Desa</option>
							<option value='1'>Pendatang</option>
	</div></select></td></tr>";
echo"<tr><td>Pekerjaan</td><td><div class='col-md-5'>
						<select name='Pekerjaan' id='Pekerjaan' required class='selectpicker show-tick form-control' data-live-search='true' >
							<option value=''>::Pilih::</option>";
	$Pekerjaan = mysql_query("SELECT * from tblpekerjaan");
	while($pkj=mysql_fetch_array($Pekerjaan))
	{
		echo"<option value='$pkj[PekerjaanID]'>$pkj[NamaPekerjaan]</option>";
	}
echo"</div></select></td></tr>";	
echo"<tr><td>Jalan</td><td><div class='col-md-10'><input type='text' name='Jalan' id='Jalan' required class='form-control'></div></td></tr>";
echo"<tr><td>RT / RW</td><td><div class='col-md-2'><input type='text' name='rt' id='rt' required class='form-control' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class='col-md-2'><input type='text' name='rw' id='rw' placeholder='RW' class='form-control' required onKeyPress='return numbersonly(this, event)'></div></td>
				</tr>
				<tr>";

$daerah 	=mysql_query ("SELECT
							tblkelurahan.KelurahanID,
							tblkelurahan.NamaKelurahan,
							tblprovinsi.ProvinsiID,
							tblprovinsi.NamaProvinsi,
							tblkabkota.KabKotaID,
							tblkabkota.NamaKabKota,
							tblkecamatan.KecamatanID,
							tblkecamatan.NamaKecamatan
							FROM
							tblkelurahan
							INNER JOIN tblkecamatan ON tblkecamatan.KecamatanID = tblkelurahan.KecamatanID
							INNER JOIN tblkabkota ON tblkabkota.KabKotaID = tblkecamatan.KabKotaID
							INNER JOIN tblprovinsi ON tblprovinsi.ProvinsiID = tblkabkota.ProvinsiID
							where tblkelurahan.KelurahanID ='3315162020'
							ORDER BY NamaKelurahan ASC");
$drh 		= mysql_fetch_array($daerah);

echo"<tr><td>Provinsi</td><td>
	 <div class='col-lg-5'>
	<select id='provinsi' name='provinsi' class='selectpicker show-tick form-control' data-live-search='true' required>
	<option value='$drh[ProvinsiID]'>$drh[NamaProvinsi]</option>";
	$provinsi = mysql_query("SELECT * from tblprovinsi");
	while ($prov=mysql_fetch_array($provinsi))
	{
		echo"<option value='$prov[ProvinsiID]'>$prov[NamaProvinsi]</option>";
	}
echo"</select></div></td></tr>";
echo"<tr><td>Kabupaten/Kota</td><td>
	 <div class='col-md-5'>
	<select id='kota' name='kota' class='form-control' required>
	<option value='$drh[KabKotaID]'>$drh[NamaKabKota]</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kecamatan</td><td>
	 <div class='col-md-5'>
	<select id='kec' name='kec' class='form-control' required>
	<option value='$drh[KecamatanID]'>$drh[NamaKecamatan]</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kelurahan</td><td>
	 <div class='col-md-5'>
	<select id='kel' name='kel' class='form-control' required>
	<option value='$drh[KelurahanID]'>$drh[NamaKelurahan]</option>";
echo"</div></select></td></tr>";

echo"<tr><td>Dusun</td><td><div class='col-md-5'>
		<select id='dusun' name='dusun' class='form-control' required>";
	echo"<option value=''>==Pilih Dusun==</option>";
	$dusun 	= mysql_query ("SELECT * from tbldusun ORDER BY NamaDusun ASC");
	while($dsn 	= mysql_fetch_array($dusun))
	{
	echo"<option value='$dsn[DusunID]'>$dsn[NamaDusun]</option>";
	}
	echo"</div></select></td></tr>";
echo"<tr><td>Kode Pos</td><td><div class='col-md-4'><input type='text' name='KodePos' id='KodePos' class='form-control' onKeyPress='return numbersonly(this, event)'></td></tr>";
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
echo"<tr><td>Kewarganegaraan</td> <td><div class='col-md-5'>
<select name='negara' id='negara' class='selectpicker show-tick form-control' data-live-search='true' required>
                    <option value='ID'>INDONESIA</option>";
			$negara = mysql_query ("SELECT * from tblnegara ORDER BY NamaNegara ASC");
			while ($ngr=mysql_fetch_array($negara)){
			echo"<option value='$ngr[NegaraID]'>$ngr[NamaNegara]</option>";
			}
echo"</div></select></td></tr>";

echo"<tr><td>Keturunan</td> <td><div class='col-md-10'>
		<input type='radio' name='Keturunan' value='1'/> Eropa 
        <input type='radio' name='Keturunan' value='2'/> Cina/Timur/Asing Lainnya
        <input type='radio' name='Keturunan' value='3' checked/> Indonesia 
        <input type='radio' name='Keturunan' value='4' /> Indonesia Nasional
        <input type='radio' name='Keturunan' value='5'/> Lainnya </div></td>
        </tr>";	

echo"<tr><td>Nama Ayah</td><td><div class='col-md-5'><input type='text' name='NamaAyah' class='form-control'></div></td></tr>";
echo"<tr><td>Nama Ibu</td><td><div class='col-md-5'><input type='text' name='NamaIbu' size='40' class='form-control'></div></td></tr>";
echo"<tr><td>Upload Foto</td><td><div class='col-md-10'><input type='file' name='nama_file' id='nama_file'>Bila Foto tidak ada kosongi saja</div></td></tr>";
echo"<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Simpan</button>
				<button type='reset' class='btn btn-primary' onclick=self.history.back()>
					<i class='fa fa-fw fa-repeat'></i>Batal</button></p></td></tr>";
echo"</table>";
echo"</form>";
echo"</div>";
?>