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
?>
  <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Data Penduduk Edit</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
$data 	= mysql_query ("SELECT * from tblpenduduk where id='$id'");
$dt 	= mysql_fetch_array($data);

echo"<form method='POST' action='media.php?mn=input_data_penduduk_update' enctype='multipart/form-data' name='FUpload' id='FUpload'>";
echo"<table class='table'>
<input type=hidden name='id' class='form-control' value='$dt[id]'>
	<tr><td>Nama Lengkap</td><td><div class='col-md-5'><input type=text name='nama_lengkap' class='form-control' required value='$dt[NamaLengkap]'></div></td></tr>
	<tr><td>Jenis Kelamin</td><td><div class='col-md-5'>
		<select id='kelamin' name='kelamin' class='form-control' required>";
		if ($dt['JenisKelamin'] == 0)
		{	echo"<option value='0'>Laki-Laki</option>
			<option value='1'>Perempuan</option>"; }
		else
		{echo"<option value='1'>Perempuan</option>
			<option value='0'>Laki-Laki</option>";}
echo"</div></select></td></tr>
	<tr><td>Tempat Lahir</td><td>
	<div class='col-md-5'>
	<select id='tmp_lahir' name='tmp_lahir' class='selectpicker show-tick form-control' data-live-search='true' required>";
	$datalahir 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[TempatLahir]' ORDER BY NamaKabKota ASC");
	$lhr 	= mysql_fetch_array($datalahir);
	echo"<option value='$lhr[KabKotaID]'>$lhr[NamaKabKota]</option>";
	$tmp_lahir = mysql_query ("SELECT * from tblkabkota ORDER BY NamaKabKota ASC");
	while($lahir=mysql_fetch_array($tmp_lahir))
	{
	echo"<option value='$lahir[KabKotaID]'>$lahir[NamaKabKota]</option>";
	}
	echo"</div></select></td></tr>";

echo"<tr><td>Tanggal Lahir</td><td><div class='col-md-10'> 
<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value='$dt[TanggalLahir]''>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2' name='tgl_lahir' value='$dt[TanggalLahir]'></div></td></tr>";
echo"<tr><td>No Kartu Keluarga</td><td><div class='col-md-8'><input type=text name='no_kk' class='form-control' required value='$dt[NoKK]'></div></td></tr>";
echo"<tr><td>Posisi dalam Keluarga</td><td><div class='col-md-4'>
	<select name='PosisiKKID' id='PosisiKKID' class='selectpicker show-tick form-control' data-live-search='true' required>";
	$datakk = mysql_query ("SELECT * from tblposisikk where PosisiKKID='$dt[PosisiKKID]' ORDER BY PosisiKKID ASC");
	$kk 	= mysql_fetch_array($datakk);
	echo"<option value='$kk[PosisiKKID]'>$kk[NamaPosisiKK]</option>";
      $posisikk = mysql_query ("SELECT * from tblposisikk ORDER BY PosisiKKID ASC");
      while($pkk = mysql_fetch_array($posisikk))
      {
      	echo"<option value='$pkk[PosisiKKID]'>$pkk[NamaPosisiKK]</option>";
      }
echo"</select></div>
		<div class='col-md-3'><input type='text' name='UrutPosisiKK' Placeholder='Urutan Posisi KK' value='$dt[UrutPosisiKK]' required class='form-control' onKeyPress='return numbersonly(this, event)'>
		</div></td></tr>";
echo"<tr><td>Nomor NIK KK/Identitas</td><td>";
echo"<div class='col-md-2'>
		<select name='KartuID' id='KartuID' class='form-control' required>";
		if ($dt['KartuID'] == 0)
        {  echo"<option value='0'>KTP</option>
                <option value='1'>Passport</option>"; }
        else
        { echo"<option value='1'>Passport</option>
    			<option value='0'>KTP</option>";}
echo"</select>
		</div>";
echo"<div class='col-md-6'><input type=text name='noidentitas' class='form-control' value='$dt[NoIdentitas]' required></div></td></tr>";
echo"<tr><td>Agama</td><td><div class='col-md-5'>
		<select name='Agama' id='Agama' class='form-control' required>";
	$dataagama 	= mysql_query("SELECT * from tblagama where AgamaID='$dt[Agama]'");
	$dtagm 		= mysql_fetch_array($dataagama);
	echo"<option value='$dtagm[AgamaID]'>$dtagm[NamaAgama]</option>";
	$agama = mysql_query("SELECT * from tblagama ORDER BY NamaAgama ASC");
	while ($agm = mysql_fetch_array($agama))
	{
	echo"<option value='$agm[AgamaID]'>$agm[NamaAgama]</option>";	
	}
		echo"</div></select></td></tr>";	
echo"<tr><td>Status Perkawinan</td><td><div class='col-md-5'>
		<select name='StatusPerkawinan' id='StatusPerkawinan' class='form-control' required>";
	$datakawin 	= mysql_query ("SELECT * from tblstatuskawin where StatusPerkawinan='$dt[StatusPerkawinan]'");
	$kwn 		= mysql_fetch_array($datakawin);
	echo"<option value='$kwn[StatusPerkawinan]'>$kwn[NamaStatusPerkawinan]</option>";
	$StatusPerkawinan = mysql_query ("SELECT * from tblstatuskawin ORDER BY NamaStatusPerkawinan ASC");
	while ($kawin=mysql_fetch_array($StatusPerkawinan))
	{
		echo"<option value='$kawin[StatusPerkawinan]'>$kawin[NamaStatusPerkawinan]</option>";	
	}
echo"</div></select></td></tr>";							
echo"<tr><td>Status Kependudukan</td><td><div class='col-md-5'>
		<select name='StatusKependudukan' id='StatusKependudukan' class='form-control' required>";
		if ($dt['StatusKependudukan'] == '0')
			{ echo"<option value='0'>WNI</option>
					<option value='1'>WNA</option>"; }
		else
		{ echo"<option value='1'>WNA</option>
				<option value='0'>WNI</option>"; }
							
echo"</div></select></td></tr>";
echo"<tr><td>Penduduk Desa/Bukan</td><td><div class='col-md-5'>
		<select name='PendudukAsli' id='PendudukAsli' required class='form-control'>";
		if ($dt['PendudukAsli'] == '0')
			{ echo"<option value='0'>Desa</option>
				<option value='1'>Pendatang</option>";}
		else { echo"<option value='1'>Pendatang</option>
			<option value='0'>Desa</option>";}							
echo"</div></select></td></tr>";
echo"<tr><td>Pekerjaan</td><td><div class='col-md-5'>
		<select name='Pekerjaan' id='Pekerjaan' required class='selectpicker show-tick form-control' data-live-search='true' >";
	$dataPekerjaan = mysql_query("SELECT * from tblpekerjaan where PekerjaanID='$dt[Pekerjaan]'");
	$dtpkj = mysql_fetch_array ($dataPekerjaan);
	echo"<option value='$dtpkj[PekerjaanID]'>$dtpkj[NamaPekerjaan]</option>";
	$Pekerjaan = mysql_query("SELECT * from tblpekerjaan");
	while($pkj=mysql_fetch_array($Pekerjaan))
	{
		echo"<option value='$pkj[PekerjaanID]'>$pkj[NamaPekerjaan]</option>";
	}
echo"</div></select></td></tr>";	
echo"<tr><td>Jalan</td><td><div class='col-md-10'><input type='text' name='Jalan' id='Jalan' required value='$dt[Jalan]' class='form-control'></div></td></tr>";
echo"<tr><td>RT / RW</td><td><div class='col-md-2'>
	<input type='text' name='rt' id='rt' value='$dt[RT]' required class='form-control' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<div class='col-md-2'><input type='text' name='rw' value='$dt[RW]' id='rw' placeholder='RW' class='form-control' required onKeyPress='return numbersonly(this, event)'></div></td>
				</tr>
				<tr>";
echo"<tr><td>Provinsi</td><td>
	 <div class='col-lg-5'>
	<select id='provinsi' name='provinsi' class='selectpicker show-tick form-control' data-live-search='true' required>";
	$data_provinsi 	= mysql_query("SELECT * from tblprovinsi where ProvinsiID='$dt[ProvinsiID]'");
	$dtprov 	 	= mysql_fetch_array($data_provinsi);
	echo"<option value='$dtprov[ProvinsiID]'>$dtprov[NamaProvinsi]</option>";
	$provinsi = mysql_query("SELECT * from tblprovinsi");
	while ($prov=mysql_fetch_array($provinsi))
	{
		echo"<option value='$prov[ProvinsiID]'>$prov[NamaProvinsi]</option>";
	}
echo"</select></div></td></tr>";
echo"<tr><td>Kabupaten/Kota</td><td>
	 <div class='col-md-5'>
	<select id='kota' name='kota' class='form-control' required>";
	$kab 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[KabupatenID]'");
  	$kb 	= mysql_fetch_array($kab);
	echo"<option value='$kb[KabKotaID]'>$kb[NamaKabKota]</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kecamatan</td><td>
	 <div class='col-md-5'>
	<select id='kec' name='kec' class='form-control' required>";
	$kec=mysql_query("SELECT * from tblkecamatan where KecamatanID='$dt[KecamatanID]'");
	$c=mysql_fetch_array($kec);
	echo"<option value='$c[KecamatanID]'>$c[NamaKecamatan]</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kelurahan</td><td>
	 <div class='col-md-5'>
	<select id='kel' name='kel' class='form-control' required>";
	$kel=mysql_query("SELECT * from tblkelurahan where KelurahanID='$dt[KelurahanID]'");
	$l=mysql_fetch_array($kel);
	echo"<option value='$l[KelurahanID]'>$l[NamaKelurahan]</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Dusun</td><td><div class='col-md-5'>
		<select id='dusun' name='dusun' class='form-control'>";
	$dusun=mysql_query("SELECT * from tbldusun where DusunID='$dt[DusunID]'");
	$dsn=mysql_fetch_array($dusun);
	echo"<option value='$dsn[DusunID]'>$dsn[NamaDusun]</option>";
	$dusun1 	= mysql_query ("SELECT * from tbldusun where not DusunID='$dt[DusunID]' ORDER BY NamaDusun ASC");
	while($dsn1 	= mysql_fetch_array($dusun1))
	{
	echo"<option value='$dsn1[DusunID]'>$dsn1[NamaDusun]</option>";
	}
	echo"</div></select></td></tr>";
echo"<tr><td>Kode Pos</td><td><div class='col-md-4'>
	<input type='text' name='KodePos' id='KodePos' class='form-control' onKeyPress='return numbersonly(this, event)' value='$dt[KodePos]'></td></tr>";
echo"<tr><td>Pendidikan Terakhir </td>
			<td><div class='col-md-5'><select name='PendidikanID' id='PendidikanID' class='form-control'>";
			$dataPendidikan = mysql_query("SELECT * from tblpendidikan where PendidikanID='$dt[PendidikanID]'");
			$dtpen = mysql_fetch_array($dataPendidikan);
            echo"<option value='$dtpen[PendidikanID]'>$dtpen[NamaPendidikan]</option>";
                    $Pendidikan = mysql_query("SELECT * from tblpendidikan");
                    while ($pdd = mysql_fetch_array($Pendidikan))
                    {
                    echo" <option value='$pdd[PendidikanID]'>$pdd[NamaPendidikan]</option>";
                    }
echo"</div></select></td></tr>";   
echo"<tr><td>Dapat Membaca Huruf </td> 
				  <td><div class='col-md-5'><select name='BacaID' id='BacaID' class='form-control'>";
				  $datahuruf 	= mysql_query("SELECT * from tblbacahuruf where BacaID='$dt[BacaID]'");
				  $dthrf 		= mysql_fetch_array($datahuruf);
				  echo"<option value='$dthrf[BacaID]'>$dthrf[Keterangan]</option>";
					$sql_huruf = mysql_query("SELECT * from tblbacahuruf");
					while ($hrf = mysql_fetch_array($sql_huruf))
					{
					echo"<option value='$hrf[BacaID]'>$hrf[Keterangan]</option>";
					}
echo"</div></select></td></tr>";   
echo"<tr><td>No. Telpon</td><td><div class='col-md-3'>
		<input type='text' name='NoTelp' id='NoTelp' class='form-control' onKeyPress='return numbersonly(this, event)' value='$dt[NoTelp]'></div></td></tr>";
echo"<tr><td>No. Handphone</td><td><div class='col-md-3'>
		<input type='text' name='NoHP' id='NoHP' class='form-control' onKeyPress='return numbersonly(this, event)' value='$dt[NoHP]'></div></td></tr>";
echo"<tr><td>Email</td><td><div class='col-md-5'>
		<input type='text' name='Email' id='Email' class='form-control' value='$dt[Email]'></div></td></tr>";
echo"<tr><td>Website</td><td><div class='col-md-5'>
		<input type='text' name='WebSite' id='WebSite' class='form-control' value='$dt[WebSite]'></div></td></tr>";
echo"<tr><td>Kewarganegaraan</td> <td><div class='col-md-5'>
<select name='negara' id='negara' class='selectpicker show-tick form-control' data-live-search='true' required>";
			$dtnegara 	= mysql_query ("SELECT * from tblnegara where NegaraID='$dt[NegaraID]'");
			$dtngr 		= mysql_fetch_array($dtnegara);
            echo"<option value='$dtngr[NegaraID]'>$dtngr[NamaNegara]</option>";
			$negara = mysql_query ("SELECT * from tblnegara ORDER BY NamaNegara ASC");
			while ($ngr=mysql_fetch_array($negara)){
			echo"<option value='$ngr[NegaraID]'>$ngr[NamaNegara]</option>";
			}
echo"</div></select></td></tr>";
  echo"<tr>
        <td>Keturunan</td><td><div class='col-md-10'>";
         if ($dt['Keturunan'] == '1')
	  {
       echo"<input type='radio' name='Keturunan' value='1' checked/> Eropa 
        <input type='radio' name='Keturunan' value='2'/> Cina/Timur/Asing Lainnya
        <input type='radio' name='Keturunan' value='3'/> Indonesia 
        <input type='radio' name='Keturunan' value='4' /> Indonesia Nasional
        <input type='radio' name='Keturunan' value='5'/> Lainnya ";
		}
	elseif ($dt['Keturunan'] == '2')
	  {
       echo"<input type='radio' name='Keturunan' value='1'/> Eropa 
        <input type='radio' name='Keturunan' value='2' checked/> Cina/Timur/Asing Lainnya
        <input type='radio' name='Keturunan' value='3'/> Indonesia 
        <input type='radio' name='Keturunan' value='4' /> Indonesia Nasional
        <input type='radio' name='Keturunan' value='5'/> Lainnya ";
		}
	elseif ($dt['Keturunan'] == '3')
	  {
       echo"<input type='radio' name='Keturunan' value='1'/> Eropa 
        <input type='radio' name='Keturunan' value='2'/> Cina/Timur/Asing Lainnya
        <input type='radio' name='Keturunan' value='3' checked/> Indonesia 
        <input type='radio' name='Keturunan' value='4' /> Indonesia Nasional
        <input type='radio' name='Keturunan' value='5'/> Lainnya ";
		}
	elseif ($dt['Keturunan'] == '4')
	  {
       echo"<input type='radio' name='Keturunan' value='1'/> Eropa 
        <input type='radio' name='Keturunan' value='2'/> Cina/Timur/Asing Lainnya
        <input type='radio' name='Keturunan' value='3'/> Indonesia 
        <input type='radio' name='Keturunan' value='4' checked/> Indonesia Nasional
        <input type='radio' name='Keturunan' value='5'/> Lainnya ";
		}
	else
	{
       echo"<input type='radio' name='Keturunan' value='1'/> Eropa 
        <input type='radio' name='Keturunan' value='2'/> Cina/Timur/Asing Lainnya
        <input type='radio' name='Keturunan' value='3' /> Indonesia 
        <input type='radio' name='Keturunan' value='4' /> Indonesia Nasional
        <input type='radio' name='Keturunan' value='5' checked/> Lainnya ";
		}
      echo"</div></td></tr>";
echo"<tr><td>Nama Ayah</td><td><div class='col-md-5'><input type='text' name='NamaAyah' class='form-control' value='$dt[NamaAyah]'></div></td></tr>";
echo"<tr><td>Nama Ibu</td><td><div class='col-md-5'><input type='text' name='NamaIbu' size='40' class='form-control' value='$dt[NamaIbu]'></div></td></tr>";
echo"<tr><td>Ganti Foto</td><td><div class='col-md-10'>";
	if ($dt['Photo'] == '')
		{echo"Data Foto Tidak Ada"; }
	else{echo"<img src='$dt[Photo]' width='100' height='100'>"; }
	echo"<input type='file' name='nama_file' id='nama_file'>Bila Foto tidak ingin diganti dikosongi</div></td></tr>";
echo"</thead></table>";
echo"<table class='table'>";
echo"<tr><td><p align='right'><button type='submit' name='cetak' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Update</button></p></td>";
echo"</form>";
echo"<td><form method='POST' action='media.php?mn=laporan_data_penduduk' class='form-horizontal'>";
		echo"<button type='submit' class='btn btn-primary'><i class='fa fa-fw fa-repeat'></i>Batal</button>";
		echo"</form></td></tr>";
		echo"</table>";
				
					echo"</div></div>";
?>