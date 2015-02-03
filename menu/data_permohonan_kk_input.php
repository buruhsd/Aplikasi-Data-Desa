<script>
function open_win() {
window.open( "menu/list_penduduk.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
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
                                    <h3 class='box-title'>Data Permohonan KK</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-primary btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

echo"<form method='POST' action='media.php?mn=data_permohonan_kk_simpan'>";
echo"<table class='table'>
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
echo"<tr><td>No Passport</td><td><div class='col-md-6'><input type=text name='no_pasport' class='form-control'></div></td></tr>";
echo"<tr><td>Tanggal Terakhir Pasport</td><td><div class='col-md-10'> 
<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input3' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value=''>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
          <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
        <input type='hidden' id='dtp_input3' value='' name='tgl_akhir_pasport'></div></td></tr>";	

echo"<tr><td>Agama</td><td><div class='col-md-5'>
            <select name='agama' id='agama' class='form-control' required>
              <option value=''>::Pilih::</option>";
  $agama = mysql_query("SELECT * from tblagama");
  while ($agm = mysql_fetch_array($agama))
  {
  echo"<option value='$agm[AgamaID]'>$agm[NamaAgama]</option>"; 
  }
    echo"</div></select></td></tr>";

    $daerah   =mysql_query ("SELECT
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
$drh    = mysql_fetch_array($daerah);

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
	<select id='kota' name='kabupaten' class='form-control' required>
	<option value='$drh[KabKotaID]'>$drh[NamaKabKota]</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kecamatan</td><td>
	 <div class='col-md-5'>
	<select id='kec' name='kecamatan' class='form-control' required>
	<option value='$drh[KecamatanID]'>$drh[NamaKecamatan]</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kelurahan</td><td>
	 <div class='col-md-5'>
	<select id='kel' name='desa' class='form-control' required>
<option value='$drh[KelurahanID]'>$drh[NamaKelurahan]</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Dusun</td><td><div class='col-md-5'>
		<select id='dusun' name='dusun' class='form-control'>";
    echo"<option value='0'>==Pilih Dusun==</option>";
		  $dusun  = mysql_query ("SELECT * from tbldusun ORDER BY NamaDusun ASC");
  while($dsn  = mysql_fetch_array($dusun))
  {
  echo"<option value='$dsn[DusunID]'>$dsn[NamaDusun]</option>";
  }
  echo"</div></select></td></tr>";
echo"<tr><td>Kode Pos</td><td><div class='col-md-4'><input type='text' name='kode_pos' id='kode_pos' class='form-control' onKeyPress='return numbersonly(this, event)'></div></td></tr>";
echo"<tr><td>Alamat</td><td><div class='col-md-10'><input type='text' name='alamat' id='alamat' class='form-control'></div></td></tr>";
echo"<tr><td>RT / RW</td><td><div class='col-md-2'><input type='text' name='rt' class='form-control' onKeyPress='return numbersonly(this, event)' placeholder='RT'></div>
<div class='col-md-2'><input type='text' name='rw' class='form-control' onKeyPress='return numbersonly(this, event)' placeholder='RW'></div></td></tr>";
echo"<tr>
        <td>Akta Lahir</td>
        <td colspan='2'><div class='col-lg-4'>
		<input type='radio' name='akta_lahir' value='1' checked/> Tidak Ada 
        <input type='radio' name='akta_lahir' value='2' /> Ada </div></td>
        </tr>";	
echo"<tr><td>Nomor Akta Kelahiran</td><td><div class='col-md-6'><input type=text name='no_akta_lahir' class='form-control'></div></td></tr>";		
echo"<tr>
        <td>Golongan Darah</td>
        <td colspan='2'><div class='col-lg-5'>
		<select name='gol_darah' id='gol_darah' class='form-control' required>
                      <option value=''>::Pilih::</option>
                      <option value='1'>A</option>
                      <option value='2'>B</option>
                       <option value='3'>AB</option>
                      <option value='4'>O</option>
                       <option value='5'>A+</option>
                      <option value='6'>A-</option>
                       <option value='7'>B+</option>
                      <option value='8'>B-</option>
                       <option value='9'>AB+</option>
                      <option value='10'>AB-</option>
                       <option value='11'>O+</option>
                      <option value='12'>O-</option>
                       <option value='13'>Tidak Tahu</option>
						</select>
        </tr>";	
echo"<tr>
        <td>Status Perkawinan</td>
        <td colspan='2'><div class='col-lg-5'>
		<select name='status_perkawinan' id='status_perkawinan' class='form-control' required>
                      <option value=''>::Pilih::</option>
                      <option value='1'>Belum Kawin</option>
                      <option value='2'>Kawin</option>
                       <option value='3'>Cerai Hidup</option>
                      <option value='4'>Cerai Mati</option>
						</select>
        </tr>";	
echo"<tr>
        <td>Akta Perkawinan</td>
        <td colspan='2'><div class='col-lg-4'>
		<input type='radio' name='akta_perkawinan' value='1' checked/> Tidak Ada 
        <input type='radio' name='akta_perkawinan' value='2' /> Ada </div></td>
        </tr>";	
echo"<tr><td>Nomor Perkawinan</td><td><div class='col-md-6'><input type=text name='no_akta_perkawinan' class='form-control'></div></td></tr>";	
echo"<tr><td>Tanggal Perkawinan</td><td><div class='col-md-10'> 
<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input4' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value=''>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input4' value='' name='tgl_perkawinan'></div></td></tr>";
echo"<tr>
        <td>Akta Perceraian</td>
        <td colspan='2'><div class='col-lg-4'>
		<input type='radio' name='akta_perceraian' value='1' checked/> Tidak Ada 
        <input type='radio' name='akta_perceraian' value='2' /> Ada </div></td>
        </tr>";	
echo"<tr><td>Nomor Perceraian</td><td><div class='col-md-6'><input type=text name='no_cerai' class='form-control'></div></td></tr>";	
echo"<tr><td>Tanggal perceraian</td><td><div class='col-md-10'> 
<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input5' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value=''>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input5' value='' name='tgl_cerai'></div></td></tr>";
echo"<tr><td>Posisi dalam Keluarga</td><td><div class='col-md-4'>
	<select name='hub_keluarga' id='hub_keluarga' class='form-control' required>
      <option value=''>::pilih::</option>";
      $posisikk = mysql_query ("SELECT * from tblposisikk ORDER BY PosisiKKID ASC");
      while($pkk = mysql_fetch_array($posisikk))
      {
      	echo"<option value='$pkk[PosisiKKID]'>$pkk[NamaPosisiKK]</option>";
      }
     	echo"</select></div></td></tr>";
echo"<tr>
        <td>Kelainan Fisik Dan Mental</td>
        <td colspan='2'><div class='col-lg-4'>
		<input type='radio' name='kelainan' value='1' checked/> Tidak Ada 
        <input type='radio' name='kelainan' value='2' /> Ada </div></td>
        </tr>";	
echo"<tr>
        <td>Penyandang Cacat</td>
        <td colspan='2'><div class='col-lg-5'>
		<select name='penyandang_cacat' id='penyandang_cacat' class='form-control'>
                      <option value='0'>Tidak Ada</option>
                      <option value='1'>Cacat Fisik</option>
                      <option value='2'>Cacat Netra/Buta</option>
                       <option value='3'>Cacat Rungu/Wicara</option>
                      <option value='4'>Cacat Mental/Jiwa</option>
                      <option value='4'>Cacat Fisik & Mental</option>
						</select>
        </tr>";	

echo"<tr><td>Pendidikan Terakhir </td>
				  <td><div class='col-md-5'><select name='pendidikan_terakhir' id='pendidikan_terakhir' class='form-control'>
                    <option value=''>::pilih::</option>";
                    $Pendidikan = mysql_query("SELECT * from tblpendidikan");
                    while ($pdd = mysql_fetch_array($Pendidikan))
                    {
                    echo" <option value='$pdd[PendidikanID]'>$pdd[NamaPendidikan]</option>";
                    }
echo"</div></select></td></tr>";  

echo"<tr><td>Pekerjaan</td><td><div class='col-md-5'>
						<select name='pekerjaan' id='pekerjaan' required class='selectpicker show-tick form-control' data-live-search='true' >
							<option value=''>::Pilih::</option>";
	$Pekerjaan = mysql_query("SELECT * from tblpekerjaan");
	while($pkj=mysql_fetch_array($Pekerjaan))
	{
		echo"<option value='$pkj[PekerjaanID]'>$pkj[NamaPekerjaan]</option>";
	}
echo"</div></select></td></tr>";	
echo"<tr><td>NIK Ayah</td><td><div class='col-md-5'><input type='text' name='nik_ayah' class='form-control'></div></td></tr>";
echo"<tr><td>Nama Ayah</td><td><div class='col-md-5'><input type='text' name='nama_ayah' class='form-control'></div></td></tr>";
echo"<tr><td>NIK Ibu</td><td><div class='col-md-5'><input type='text' name='nik_ibu' size='40' class='form-control'></div></td></tr>";
echo"<tr><td>Nama Ibu</td><td><div class='col-md-5'><input type='text' name='nama_ibu' size='40' class='form-control'></div></td></tr>";
echo"<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Simpan</button></p></td></tr>";
echo"</table>";
echo"</form>";
echo"</div>";
?>