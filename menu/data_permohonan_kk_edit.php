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
$id = $_GET['id'];

$data   = mysql_query ("SELECT * from tblpermohonan_kk where id_kk='$id'");
$dt     = mysql_num_rows($data);

echo"<div class='box box-primary'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Data Permohonan KK</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-primary btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

echo"<form method='POST' action='media.php?mn=data_permohonan_kk_update'>";
$data =mysql_query ("SELECT * FROM tblpermohonan_kk where id_kk='$id'");
$dt   =mysql_fetch_array($data);

echo"<table class='table'>
<input type=hidden name='id_kk' value='$dt[id_kk]' class='form-control' required >
	<tr><td>Nama Lengkap</td><td><div class='col-md-7'><div class='input-group'><input type=text name='nama_lengkap' value='$dt[nama_lengkap]' id='Nama' class='form-control' required >
  <span class='input-group-btn'>
  <a href='javascript:void(0)' onClick='open_win()'>
  <button class='btn btn-info btn-flat' type='button'>Go!</button></a>
  </span>
  </div></td></tr>
	<tr><td>Jenis Kelamin</td><td><div class='col-md-5'>";
  if ($dt['jenis_kelamin'] == 0)
    {
      echo"<input type=text name='kelamin' id='Kelamin1' class='form-control' value='Laki-Laki' required>
           <input type=hidden name='jenis_kelamin' id='Kelamin' value='0' class='form-control' required> ";
    }
  else 
  {
     echo"<input type=text name='kelamin' id='Kelamin1' class='form-control' value='Perempuan' required>
           <input type=hidden name='jenis_kelamin' id='Kelamin' value='1' class='form-control' required> ";
  }

  $lahir    =mysql_query("SELECT SUBSTR(NamaKabKota,5,25)as NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$dt[tempat_lahir]'");
  $lhr      =mysql_fetch_array($lahir);
echo"<tr><td>Tempat Lahir</td><td>
	<div class='col-md-5'><input type=text name='tempat_lahir1' id='Tempat1' value='$lhr[NamaKabKota]' class='form-control' required>
                        <input type=hidden name='tempat_lahir' id='Tempat' value='$lhr[KabKotaID]' class='form-control' required>";
	echo"</div></td></tr>";
echo"<tr><td>Tanggal Lahir</td><td><div class='col-md-4'><input type=text name='tgl_lahir' value='$dt[tgl_lahir]' id='Lahir' class='form-control' required ></div></td></tr>";
echo"<tr><td>No Ktp</td><td><div class='col-md-6'><input type=text name='no_ktp' id='KTP' value='$dt[no_ktp]' class='form-control' required></div></td></tr>";
echo"<tr><td>No Passport</td><td><div class='col-md-6'><input type=text name='no_pasport' value='$dt[no_pasport]'' class='form-control'></div></td></tr>";
echo"<tr><td>Tanggal Terakhir Pasport</td><td><div class='col-md-10'> 
<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input3' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value='$dt[tgl_akhir_pasport]'>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
          <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
        <input type='hidden' id='dtp_input3' value='' name='tgl_akhir_pasport' value='$dt[tgl_akhir_pasport]'></div></td></tr>";	

echo"<tr><td>Agama</td><td><div class='col-md-5'>
            <select name='agama' id='agama' class='form-control' required>";
            $agama1 = mysql_query("SELECT * from tblagama where AgamaID='$dt[agama]'");
            $agm1   = mysql_fetch_array($agama1);
            echo"<option value='$agm1[AgamaID]'>$agm1[NamaAgama]</option>";

            $agama = mysql_query("SELECT * from tblagama where not AgamaID='$dt[agama]'");
            while ($agm = mysql_fetch_array($agama))
            {
            echo"<option value='$agm[AgamaID]'>$agm[NamaAgama]</option>"; 
            }
              echo"</div></select></td></tr>";

echo"<tr><td>Provinsi</td><td>
	 <div class='col-lg-5'>
	<select id='provinsi' name='provinsi' class='selectpicker show-tick form-control' data-live-search='true' required>";
  $data_provinsi  = mysql_query("SELECT * from tblprovinsi where ProvinsiID='$dt[provinsi]'");
  $dtprov     = mysql_fetch_array($data_provinsi);
  echo"<option value='$dtprov[ProvinsiID]'>$dtprov[NamaProvinsi]</option>";
  $provinsi = mysql_query("SELECT * from tblprovinsi where not ProvinsiID='$dt[provinsi]'");
  while ($prov=mysql_fetch_array($provinsi))
  {
    echo"<option value='$prov[ProvinsiID]'>$prov[NamaProvinsi]</option>";
  }
echo"</select></div></td></tr>";

echo"<tr><td>Kabupaten/Kota</td><td>
	 <div class='col-md-5'>
	<select id='kota' name='kabupaten' class='form-control' required>";
  $kab  = mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[kabupaten]'");
    $kb   = mysql_fetch_array($kab);
  echo"<option value='$kb[KabKotaID]'>$kb[NamaKabKota]</option>";
echo"</div></select></td></tr>";

echo"<tr><td>Kecamatan</td><td>
	 <div class='col-md-5'>
	<select id='kec' name='kecamatan' class='form-control' required>";
  $kec=mysql_query("SELECT * from tblkecamatan where KecamatanID='$dt[kecamatan]'");
  $c=mysql_fetch_array($kec);
  echo"<option value='$c[KecamatanID]'>$c[NamaKecamatan]</option>";
echo"</div></select></td></tr>";

echo"<tr><td>Kelurahan</td><td>
	 <div class='col-md-5'>
	<select id='kel' name='desa' class='form-control' required>";
  $kelurahan=mysql_query("SELECT * from tblkelurahan where KelurahanID='$dt[desa]'");
  $kl=mysql_fetch_array($kelurahan);
  echo"<option value='$kl[KelurahanID]'>$kl[NamaKelurahan]</option>";
echo"</div></select></td></tr>";

echo"<tr><td>Dusun</td><td><div class='col-md-5'>
		<select id='dusun' name='dusun' class='form-control'>";
    $dusun=mysql_query("SELECT * from tbldusun where DusunID='$dt[dusun]'");
  $dsn=mysql_fetch_array($dusun);
  echo"<option value='$dsn[DusunID]'>$dsn[NamaDusun]</option>";
    $dusun1  = mysql_query ("SELECT * from tbldusun ORDER BY NamaDusun ASC");
  while($dsn1  = mysql_fetch_array($dusun1))
  {
  echo"<option value='$dsn1[DusunID]'>$dsn1[NamaDusun]</option>";
  }
  echo"</div></select></td></tr>";
  
echo"<tr><td>Kode Pos</td><td><div class='col-md-4'><input type='text' name='kode_pos' value='$dt[kode_pos]' id='kode_pos' class='form-control' onKeyPress='return numbersonly(this, event)'></td></tr>";
echo"<tr><td>Alamat</td><td><div class='col-md-10'><input type='text' name='alamat' value='$dt[alamat]' id='alamat' class='form-control'></td></tr>";
echo"<tr>
        <td>Akta Lahir</td>
        <td colspan='2'><div class='col-lg-4'>";
        if ($dt['akta_lahir'] == 1)
        {
        echo"<input type='radio' name='akta_lahir' value='1' checked/> Tidak Ada 
        <input type='radio' name='akta_lahir' value='2' /> Ada ";
        }else{
           echo"<input type='radio' name='akta_lahir' value='1'/> Tidak Ada 
        <input type='radio' name='akta_lahir' value='2' checked/> Ada ";
        }
echo"</div></td>
        </tr>";	
echo"<tr><td>Nomor Akta Kelahiran</td><td><div class='col-md-6'><input type=text name='no_akta_lahir' value='$dt[no_akta_lahir]' class='form-control'></div></td></tr>";		
echo"<tr>
        <td>Golongan Darah</td>
        <td colspan='2'><div class='col-lg-5'>
		<select name='gol_darah' id='gol_darah' class='form-control' required>";
    if($dt['gol_darah'] == '1')
    {
      echo" <option value='1'>A</option>
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
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '2')
    {
      echo" <option value='2'>B</option>
                      <option value='1'>A</option>
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
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '3')
    {
      echo" <option value='3'>AB</option>
			<option value='2'>B</option>
                      <option value='1'>A</option>
                      <option value='4'>O</option>
                       <option value='5'>A+</option>
                      <option value='6'>A-</option>
                       <option value='7'>B+</option>
                      <option value='8'>B-</option>
                       <option value='9'>AB+</option>
                      <option value='10'>AB-</option>
                       <option value='11'>O+</option>
                      <option value='12'>O-</option>
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '4')
    {
      echo" 
                      <option value='4'>O</option>
					  <option value='2'>B</option>
                      <option value='1'>A</option>
                       <option value='3'>AB</option>
                       <option value='5'>A+</option>
                      <option value='6'>A-</option>
                       <option value='7'>B+</option>
                      <option value='8'>B-</option>
                       <option value='9'>AB+</option>
                      <option value='10'>AB-</option>
                       <option value='11'>O+</option>
                      <option value='12'>O-</option>
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '5')
    {
      echo" 
                       <option value='5'>A+</option>
					   <option value='2'>B</option>
                      <option value='1'>A</option>
                       <option value='3'>AB</option>
                      <option value='4'>O</option>
                      <option value='6'>A-</option>
                       <option value='7'>B+</option>
                      <option value='8'>B-</option>
                       <option value='9'>AB+</option>
                      <option value='10'>AB-</option>
                       <option value='11'>O+</option>
                      <option value='12'>O-</option>
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '6')
    {
      echo" 
                      <option value='6'>A-</option>
					  <option value='2'>B</option>
                      <option value='1'>A</option>
                       <option value='3'>AB</option>
                      <option value='4'>O</option>
                       <option value='5'>A+</option>
                       <option value='7'>B+</option>
                      <option value='8'>B-</option>
                       <option value='9'>AB+</option>
                      <option value='10'>AB-</option>
                       <option value='11'>O+</option>
                      <option value='12'>O-</option>
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '7')
    {
      echo" 
                       <option value='7'>B+</option>
					   <option value='2'>B</option>
                      <option value='1'>A</option>
                       <option value='3'>AB</option>
                      <option value='4'>O</option>
                       <option value='5'>A+</option>
                      <option value='6'>A-</option>
                      <option value='8'>B-</option>
                       <option value='9'>AB+</option>
                      <option value='10'>AB-</option>
                       <option value='11'>O+</option>
                      <option value='12'>O-</option>
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '8')
    {
      echo" 
                      <option value='8'>B-</option>
					  <option value='2'>B</option>
                      <option value='1'>A</option>
                       <option value='3'>AB</option>
                      <option value='4'>O</option>
                       <option value='5'>A+</option>
                      <option value='6'>A-</option>
                       <option value='7'>B+</option>
                       <option value='9'>AB+</option>
                      <option value='10'>AB-</option>
                       <option value='11'>O+</option>
                      <option value='12'>O-</option>
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '9')
    {
      echo" 
                       <option value='9'>AB+</option>
					   <option value='2'>B</option>
                      <option value='1'>A</option>
                       <option value='3'>AB</option>
                      <option value='4'>O</option>
                       <option value='5'>A+</option>
                      <option value='6'>A-</option>
                       <option value='7'>B+</option>
                      <option value='8'>B-</option>
                      <option value='10'>AB-</option>
                       <option value='11'>O+</option>
                      <option value='12'>O-</option>
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '10')
    {
      echo" 
                      <option value='10'>AB-</option>
					  <option value='2'>B</option>
                      <option value='1'>A</option>
                       <option value='3'>AB</option>
                      <option value='4'>O</option>
                       <option value='5'>A+</option>
                      <option value='6'>A-</option>
                       <option value='7'>B+</option>
                      <option value='8'>B-</option>
                       <option value='9'>AB+</option>
                       <option value='11'>O+</option>
                      <option value='12'>O-</option>
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '11')
    {
      echo" 
                       <option value='11'>O+</option>
					   <option value='2'>B</option>
                      <option value='1'>A</option>
                       <option value='3'>AB</option>
                      <option value='4'>O</option>
                       <option value='5'>A+</option>
                      <option value='6'>A-</option>
                       <option value='7'>B+</option>
                      <option value='8'>B-</option>
                       <option value='9'>AB+</option>
                      <option value='10'>AB-</option>
                      <option value='12'>O-</option>
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '12')
    {
      echo"
                      <option value='12'>O-</option>
					  <option value='2'>B</option>
                      <option value='1'>A</option>
                       <option value='3'>AB</option>
                      <option value='4'>O</option>
                       <option value='5'>A+</option>
                      <option value='6'>A-</option>
                       <option value='7'>B+</option>
                      <option value='8'>B-</option>
                       <option value='9'>AB+</option>
                      <option value='10'>AB-</option>
                       <option value='11'>O+</option>
                       <option value='13'>Tidak Tahu</option>";
    }
    elseif($dt['gol_darah'] == '13')
    {
      echo" 
                       <option value='13'>Tidak Tahu</option>
					   <option value='2'>B</option>
                      <option value='1'>A</option>
                       <option value='3'>AB</option>
                      <option value='4'>O</option>
                       <option value='5'>A+</option>
                      <option value='6'>A-</option>
                       <option value='7'>B+</option>
                      <option value='8'>B-</option>
                       <option value='9'>AB+</option>
                      <option value='10'>AB-</option>
                       <option value='11'>O+</option>
                      <option value='12'>O-</option>";
    }
echo"</select>
        </tr>";	
echo"<tr>
        <td>Status Perkawinan</td>
        <td colspan='2'><div class='col-lg-5'>
		<select name='status_perkawinan' id='status_perkawinan' class='form-control' required>";
    if ($dt['status_perkawinan'] == '1')
    {
      echo" <option value='1'>Belum Kawin</option>
                      <option value='2'>Kawin</option>
                       <option value='3'>Cerai Hidup</option>
                      <option value='4'>Cerai Mati</option>";
    }
    elseif ($dt['status_perkawinan'] == '2')
       {
      echo" 
                      <option value='2'>Kawin</option>
                      <option value='1'>Belum Kawin</option>
                       <option value='3'>Cerai Hidup</option>
                      <option value='4'>Cerai Mati</option>";
    }
    elseif ($dt['status_perkawinan'] == '3')
       {
      echo" 
                       <option value='3'>Cerai Hidup</option>
                       <option value='1'>Belum Kawin</option>
                      <option value='2'>Kawin</option>
                      <option value='4'>Cerai Mati</option>";
    }
    elseif ($dt['status_perkawinan'] == '4')
       {
      echo" 
                      <option value='4'>Cerai Mati</option>
                      <option value='1'>Belum Kawin</option>
                      <option value='2'>Kawin</option>
                       <option value='3'>Cerai Hidup</option>";
    }
echo"</select>
        </tr>";	
echo"<tr>
        <td>Akta Perkawinan</td>
        <td colspan='2'><div class='col-lg-4'>";
        if ($dt['akta_perkawinan'] == 1)
        {
		 echo"<input type='radio' name='akta_perkawinan' value='1' checked/> Tidak Ada 
        <input type='radio' name='akta_perkawinan' value='2' /> Ada ";
        }
        else
        {
          echo"<input type='radio' name='akta_perkawinan' value='1'/> Tidak Ada 
        <input type='radio' name='akta_perkawinan' value='2' checked/> Ada ";
        }
		
echo"</div></td>
        </tr>";	
echo"<tr><td>Nomor Perkawinan</td><td><div class='col-md-6'><input type=text name='no_akta_perkawinan' value='$dt[no_akta_perkawinan]' class='form-control'></div></td></tr>";	
echo"<tr><td>Tanggal Perkawinan</td><td><div class='col-md-10'> 
<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input4' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value='$dt[tgl_perkawinan]'>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input4' value='$dt[tgl_perkawinan]' name='tgl_perkawinan'></div></td></tr>";
echo"<tr>
        <td>Akta Perceraian</td>
        <td colspan='2'><div class='col-lg-4'>";
        if ($dt['akta_perceraian'] == '1')
        {
          echo"<input type='radio' name='akta_perceraian' value='1' checked/> Tidak Ada 
        <input type='radio' name='akta_perceraian' value='2' /> Ada ";
        }
        else
        {
          echo"<input type='radio' name='akta_perceraian' value='1'/> Tidak Ada 
        <input type='radio' name='akta_perceraian' value='2' checked/> Ada ";
        }
echo"</div></td>
        </tr>";	
echo"<tr><td>Nomor Perceraian</td><td><div class='col-md-6'><input type=text name='no_cerai' value='$dt[no_cerai]' class='form-control'></div></td></tr>";	
echo"<tr><td>Tanggal perceraian</td><td><div class='col-md-10'> 
<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input5' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value='$dt[tgl_cerai]'>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input5' value='$dt[tgl_cerai]' name='tgl_cerai'></div></td></tr>";
echo"<tr><td>Posisi dalam Keluarga</td><td><div class='col-md-4'>
	<select name='hub_keluarga' id='hub_keluarga' class='form-control' required>";
      $posisikk1 = mysql_query ("SELECT * from tblposisikk where PosisiKKID='$dt[hub_keluarga]' ORDER BY PosisiKKID ASC");
      $pkk1 = mysql_fetch_array($posisikk1);
      echo"<option value='$pkk1[PosisiKKID]'>$pkk1[NamaPosisiKK]</option>";
      $posisikk = mysql_query ("SELECT * from tblposisikk ORDER BY PosisiKKID ASC");
      while($pkk = mysql_fetch_array($posisikk))
      {
      	echo"<option value='$pkk[PosisiKKID]'>$pkk[NamaPosisiKK]</option>";
      }
     	echo"</select></div></td></tr>";
echo"<tr>
        <td>Kelainan Fisik Dan Mental</td>
        <td colspan='2'><div class='col-lg-4'>";
        if ($dt['kelainan'] == '1')
        {
          echo"<input type='radio' name='kelainan' value='1' checked/> Tidak Ada 
        <input type='radio' name='kelainan' value='2' /> Ada";
        }
        else
        {
          echo"<input type='radio' name='kelainan' value='1'/> Tidak Ada 
        <input type='radio' name='kelainan' value='2' checked/> Ada";
        }    
echo" </div></td>
        </tr>";	
echo"<tr>
        <td>Penyandang Cacat</td>
        <td colspan='2'><div class='col-lg-5'>
		<select name='penyandang_cacat' id='penyandang_cacat' class='form-control'>";
    if ($dt['penyandang_cacat'] == '1')
    {
      echo" <option value='1'>Cacat Fisik</option>
            <option value='2'>Cacat Netra/Buta</option>
            <option value='3'>Cacat Rungu/Wicara</option>
            <option value='4'>Cacat Mental/Jiwa</option>
            <option value='5'>Cacat Fisik & Mental</option>
            <option value='0'>Tidak Ada</option>";
    }
  elseif ($dt['penyandang_cacat'] == '2')
    {
      echo" 
            <option value='2'>Cacat Netra/Buta</option>
			<option value='1'>Cacat Fisik</option>
            <option value='3'>Cacat Rungu/Wicara</option>
            <option value='4'>Cacat Mental/Jiwa</option>
            <option value='5'>Cacat Fisik & Mental</option>
            <option value='0'>Tidak Ada</option>";
    }
    elseif ($dt['penyandang_cacat'] == '3')
    {
      echo" 
            <option value='3'>Cacat Rungu/Wicara</option>
			<option value='1'>Cacat Fisik</option>
            <option value='2'>Cacat Netra/Buta</option>
            <option value='4'>Cacat Mental/Jiwa</option>
            <option value='5'>Cacat Fisik & Mental</option>
            <option value='0'>Tidak Ada</option>";
    }
    elseif ($dt['penyandang_cacat'] == '4')
    {
      echo" 
            <option value='4'>Cacat Mental/Jiwa</option>
			<option value='1'>Cacat Fisik</option>
            <option value='2'>Cacat Netra/Buta</option>
            <option value='3'>Cacat Rungu/Wicara</option>
            <option value='5'>Cacat Fisik & Mental</option>
            <option value='n'>Tidak Ada</option>";
    }
    elseif ($dt['penyandang_cacat'] == '5')
    {
      echo" 
            <option value='5'>Cacat Fisik & Mental</option>
			<option value='1'>Cacat Fisik</option>
            <option value='2'>Cacat Netra/Buta</option>
            <option value='3'>Cacat Rungu/Wicara</option>
            <option value='4'>Cacat Mental/Jiwa</option>
            <option value='0'>Tidak Ada</option>";
    }
    else
    {
      echo" 
            <option value='0'>Tidak Ada</option>
			<option value='1'>Cacat Fisik</option>
            <option value='2'>Cacat Netra/Buta</option>
            <option value='3'>Cacat Rungu/Wicara</option>
            <option value='4'>Cacat Mental/Jiwa</option>
            <option value='5'>Cacat Fisik & Mental</option>";
    }                     
echo"</select>
        </tr>";	

echo"<tr><td>Pendidikan Terakhir </td>
				  <td><div class='col-md-5'><select name='pendidikan_terakhir' id='pendidikan_terakhir' class='form-control'>";
                     $Pendidikan1 = mysql_query("SELECT * from tblpendidikan where PendidikanID='$dt[pendidikan_terakhir]'");
                    $pdd1 = mysql_fetch_array($Pendidikan1);
                     echo" <option value='$pdd1[PendidikanID]'>$pdd1[NamaPendidikan]</option>";

                    $Pendidikan = mysql_query("SELECT * from tblpendidikan");
                    while ($pdd = mysql_fetch_array($Pendidikan))
                    {
                    echo" <option value='$pdd[PendidikanID]'>$pdd[NamaPendidikan]</option>";
                    }
echo"</div></select></td></tr>";  

echo"<tr><td>Pekerjaan</td><td><div class='col-md-5'>
						<select name='pekerjaan' id='pekerjaan' required class='selectpicker show-tick form-control' data-live-search='true'>";
            $Pekerjaan1 = mysql_query("SELECT * from tblpekerjaan where PekerjaanID='$dt[pekerjaan]'");
            $pkj1=mysql_fetch_array($Pekerjaan1);
              echo"<option value='$pkj1[PekerjaanID]'>$pkj1[NamaPekerjaan]</option>";
          	$Pekerjaan = mysql_query("SELECT * from tblpekerjaan");
          	while($pkj=mysql_fetch_array($Pekerjaan))
          	{
          		echo"<option value='$pkj[PekerjaanID]'>$pkj[NamaPekerjaan]</option>";
          	}
echo"</div></select></td></tr>";	
echo"<tr><td>NIK Ayah</td><td><div class='col-md-5'><input type='text' name='nik_ayah' value='$dt[nik_ayah]' class='form-control'></div></td></tr>";
echo"<tr><td>Nama Ayah</td><td><div class='col-md-5'><input type='text' name='nama_ayah' value='$dt[nama_ayah]' class='form-control'></div></td></tr>";
echo"<tr><td>NIK Ibu</td><td><div class='col-md-5'><input type='text' name='nik_ibu' size='40' value='$dt[nik_ibu]' class='form-control'></div></td></tr>";
echo"<tr><td>Nama Ibu</td><td><div class='col-md-5'><input type='text' name='nama_ibu' size='40' value='$dt[nama_ibu]' class='form-control'></div></td></tr>";
echo"</thead></table>";
echo"<table class='table'>";
echo"<tr><td><p align='right'><button type='submit' name='cetak' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Update</button></p></td>";
echo"</form>";
echo"<td><form method='POST' action='media.php?mn=data_permohonan_kk' class='form-horizontal'>";
		echo"<button type='submit' class='btn btn-primary'><i class='fa fa-fw fa-repeat'></i>Batal</button>";
		echo"</form></td></tr>";
		echo"</table>";
					echo"</div></div>";?>