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
                                    <h3 class="box-title">Data Mutasi Datang Edit</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
$id = $_GET['id'];
$data 	= mysql_query ("SELECT * from tblpenduduk where id='$id'");
$dt 	= mysql_fetch_array($data);
echo"<form method='POST' action='media.php?mn=input_data_mutasi_update' enctype='multipart/form-data' name='FUpload' id='FUpload'>";
echo"<input type='hidden' value='$id' name='id'>";
echo"<table class='table'>
		<tr>
			<td>Nama Lengkap</td><td><div class='col-md-5'><input type=text name='NamaLengkap' class='form-control' value='$dt[NamaLengkap]' required></div></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
				<td><div class='col-md-5'>
						<select name='JenisKelamin' id='JenisKelamin' class='form-control'>
							";
						if ($dt['JenisKelamin'] == 0)
						{	echo"<option value='0'>Laki-Laki</option>
							<option value='1'>Perempuan</option>"; }
						else
						{echo"<option value='1'>Perempuan</option>
							<option value='0'>Laki-Laki</option>";}
		echo"</div></select></td></tr>
				</tr>
				<tr>
					<td>Tempat Lahir</td>
					<td><div class='col-md-5'>
						<select name='TempatLahir' id='TempatLahir' class='selectpicker show-tick form-control' data-live-search='true'>";
						$datalahir 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[TempatLahir]' ORDER BY NamaKabKota ASC");
						$lhr 	= mysql_fetch_array($datalahir);
						echo"<option value='$lhr[KabKotaID]'>$lhr[NamaKabKota]</option>";
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
                    <input class='form-control' size='16' type='text'  value='$dt[TanggalLahir]'>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2' name='TanggalLahir' value='$dt[TanggalLahir]'></div></td></tr>
				<tr>
					<td>No. Kartu Keluarga Lama</td>
					<td><div class='col-md-5'><input type='text' name='xNoKKLama' class='form-control' value='$dt[NoKK]'/></td>
				</tr>
				<tr>
					<td>Posisi dalam Keluarga</td>
					<td><div class='col-md-4'><select name='PosisiKKID' id='PosisiKKID' class='selectpicker show-tick form-control' data-live-search='true' required>";
					      $posisikk = mysql_query ("SELECT * from tblposisikk ORDER BY PosisiKKID ASC");
					      while($pkk = mysql_fetch_array($posisikk))
					      {
					      	echo"<option value='$pkk[PosisiKKID]'>$pkk[NamaPosisiKK]</option>";
					      }
					     	echo"</select></div><div class='col-md-3'>
					     	<input type='text' name='UrutPosisiKK' Placeholder='Urutan Posisi KK' value='$dt[UrutPosisiKK]' required class='form-control' onKeyPress='return numbersonly(this, event)'></div>
					     	</td></tr>
				<tr>
					<td>Nomor NIK/Identitas</td>
					<td><div class='col-md-2'>
					<select name='KartuID' id='KartuID' class='form-control' required>";
						if ($dt['KartuID'] == 0)
				        {  echo"<option value='0'>KTP</option>
				                <option value='1'>Passport</option>"; }
				        else
				        { echo"<option value='1'>Passport</option>
				    			<option value='0'>KTP</option>";}
				echo"</select>
						</div>";
echo"<div class='col-md-6'>
	<input type=text name='NoIdentitas' class='form-control' value='$dt[NoIdentitas]' required></div></td></tr>
				<tr>
<tr>
					<td>No. Kartu Keluarga Lama</td>
					<td><div class='col-md-5'><input type='text' name='xNoKKLama' value='$dt[xNoKKLama]' class='form-control'/></td>
				</tr>
					<td>Agama</td>
					<td><div class='col-md-5'><select name='Agama' id='Agama' class='form-control' required>";
	$dataagama 	= mysql_query("SELECT * from tblagama where AgamaID='$dt[Agama]'");
	$dtagm 		= mysql_fetch_array($dataagama);
	echo"<option value='$dtagm[AgamaID]'>$dtagm[NamaAgama]</option>";
	$agama = mysql_query("SELECT * from tblagama ORDER BY NamaAgama ASC");
	while ($agm = mysql_fetch_array($agama))
	{
	echo"<option value='$agm[AgamaID]'>$agm[NamaAgama]</option>";	
	}
		echo"</div></select></td></tr>
				<tr>
					<td>Status Perkawinan</td>
					<td><div class='col-md-5'><select name='StatusPerkawinan' id='StatusPerkawinan' class='form-control' required>";
					$datakawin 	= mysql_query ("SELECT * from tblstatuskawin where StatusPerkawinan='$dt[StatusPerkawinan]'");
					$kwn 		= mysql_fetch_array($datakawin);
					echo"<option value='$kwn[StatusPerkawinan]'>$kwn[NamaStatusPerkawinan]</option>";
					$StatusPerkawinan = mysql_query ("SELECT * from tblstatuskawin ORDER BY NamaStatusPerkawinan ASC");
					while ($kawin=mysql_fetch_array($StatusPerkawinan))
					{
						echo"<option value='$kawin[StatusPerkawinan]'>$kawin[NamaStatusPerkawinan]</option>";	
					}
echo"</div></select></td></tr>
			<tr><td>Status Kependudukan</td><td><div class='col-md-5'>
						<select name='StatusKependudukan' id='StatusKependudukan' class='form-control' required>";
					if ($dt['StatusKependudukan'] == '0')
						{ echo"<option value='0'>WNI</option>
								<option value='1'>WNA</option>"; }
					else
					{ echo"<option value='1'>WNA</option>
							<option value='0'>WNI</option>"; }					
echo"</div></select></td></tr>
	<tr><td>Pekerjaan</td><td><div class='col-md-5'>
						<select name='Pekerjaan' id='Pekerjaan' required class='selectpicker show-tick form-control' data-live-search='true'>";
	$dataPekerjaan = mysql_query("SELECT * from tblpekerjaan where PekerjaanID='$dt[Pekerjaan]'");
	$dtpkj = mysql_fetch_array ($dataPekerjaan);
	echo"<option value='$dtpkj[PekerjaanID]'>$dtpkj[NamaPekerjaan]</option>";
	$Pekerjaan = mysql_query("SELECT * from tblpekerjaan");
	while($pkj=mysql_fetch_array($Pekerjaan))
	{
		echo"<option value='$pkj[PekerjaanID]'>$pkj[NamaPekerjaan]</option>";
	}
echo"</div></select></td></tr>";	
echo"<tr><td>Provinsi Lama</td><td>
	 <div class='col-lg-5'>
	<select id='provinsi1' name='provinsi1' class='selectpicker show-tick form-control' data-live-search='true' required>";
	$data_provinsi 	= mysql_query("SELECT * from tblprovinsi where ProvinsiID='$dt[ProvinsiIDLama]'");
	$dtprov 	 	= mysql_fetch_array($data_provinsi);
	echo"<option value='$dtprov[ProvinsiID]'>$dtprov[NamaProvinsi]</option>";
	$provinsi = mysql_query("SELECT * from tblprovinsi");
	while ($prov=mysql_fetch_array($provinsi))
	{
		echo"<option value='$prov[ProvinsiID]'>$prov[NamaProvinsi]</option>";
	}
echo"</select></div></td></tr>";
echo"<tr><td>Kabupaten Lama</td><td>
	 <div class='col-md-5'>
	<select id='kota1' name='kota1' class='form-control'>";
	$kab 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[KabupatenIDLama]'");
  	$kb 	= mysql_fetch_array($kab);
	echo"<option value='$kb[KabKotaID]'>$kb[NamaKabKota]</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kecamatan Lama</td><td>
	 <div class='col-md-5'>
	<select id='kec1' name='kec1' class='form-control'>";
	$kec=mysql_query("SELECT * from tblkecamatan where KecamatanID='$dt[KecamatanIDLama]'");
	$c=mysql_fetch_array($kec);
	echo"<option value='$c[KecamatanID]'>$c[NamaKecamatan]</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kelurahan Lama</td><td>
	 <div class='col-md-5'>
	<select id='kel1' name='kel1' class='form-control'>";
	$kel=mysql_query("SELECT * from tblkelurahan where KelurahanID='$dt[KelurahanIDLama]'");
	$l=mysql_fetch_array($kel);
	echo"<option value='$l[KelurahanID]'>$l[NamaKelurahan]</option>";
echo"</div></select></td></tr>";
echo"<tr>
                  <td>Nama Jalan Lama</td>
				  <td> <div class='col-md-5'><input type='text' name='xJalanLama' id='xJalanLama' class='form-control' value='$dt[JalanLama]'/></td>
			  </tr>";
echo"<tr><td>RT Lama / RW Lama</td><td><div class='col-md-2'><input type='text' name='xRTLama' id='xRTLama' required class='form-control' value='$dt[RTLama]' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
							<div class='col-md-2'><input type='text' name='xRWLama' id='xRWLama' placeholder='RW' value='$dt[RWLama]' class='form-control' required onKeyPress='return numbersonly(this, event)'></div></td>
				</tr>
				<tr>";
echo"<tr><td>Kode Pos Lama</td><td><div class='col-md-4'><input type='text' name='xKodePosLama' id='xKodePosLama' value='$dt[KodePosLama]' class='form-control' onKeyPress='return numbersonly(this, event)'></td></tr>";
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
echo"<tr><td>No. Telpon</td><td><div class='col-md-3'><input type='text' name='NoTelp' id='NoTelp' class='form-control' onKeyPress='return numbersonly(this, event)' value='$dt[NoTelp]'></div></td></tr>";
echo"<tr><td>No. Handphone</td><td><div class='col-md-3'><input type='text' name='NoHP' id='NoHP' class='form-control' onKeyPress='return numbersonly(this, event)' value='$dt[NoHP]'></div></td></tr>";
echo"<tr><td>Email</td><td><div class='col-md-5'><input type='text' name='Email' id='Email' class='form-control' value='$dt[Email]'></div></td></tr>";
echo"<tr><td>Website</td><td><div class='col-md-5'><input type='text' name='WebSite' id='WebSite' class='form-control' value='$dt[WebSite]'></div></td></tr>";
echo"<tr><td colspan='2'><b>Keterangan</b></td></tr>";
echo"<tr><td>Alasan Pindah</td> 
				  <td><div class='col-md-5'><select name='AlasanPindah' id='AlasanPindah' class='form-control' required>";
				  $pindah1= mysql_query("SELECT AlasanPindahID,NamaAlasanPindah FROM tblalasanpindah where AlasanPindahID='$dt[AlasanPindahID]'");
				  $pdh1 = mysql_fetch_array($pindah1);
					echo"<option value='$pdh1[AlasanPindahID]'>$pdh1[NamaAlasanPindah]</option>";
					$pindah= mysql_query("SELECT AlasanPindahID,NamaAlasanPindah FROM tblalasanpindah where NOT AlasanPindahID='$dt[AlasanPindahID]'");
					while ($pdh = mysql_fetch_array($pindah))
					{
					echo"<option value='$pdh[AlasanPindahID]'>$pdh[NamaAlasanPindah]</option>";
					}
echo"</div></select></td></tr>";  
echo"<tr><td>Klasifikasi Pindah</td> 
				  <td><div class='col-md-5'><select name='KlasifikasiPindah' id='KlasifikasiPindah' class='form-control' required>";
				  $kpindah1= mysql_query("SELECT KlasifikasiPindahID,NamaKlasifikasiPindah FROM tblklasifikasipindah where KlasifikasiPindahID='$dt[KlasifikasiPindahID]'");
				  $kpdh1 = mysql_fetch_array($kpindah1);
					echo"<option value='$kpdh1[KlasifikasiPindahID]'>$kpdh1[NamaKlasifikasiPindah]</option>";
					$kpindah= mysql_query("SELECT KlasifikasiPindahID,NamaKlasifikasiPindah FROM tblklasifikasipindah where NOT KlasifikasiPindahID='$dt[KlasifikasiPindahID]'");
					while ($kpdh = mysql_fetch_array($kpindah))
					{
					echo"<option value='$kpdh[KlasifikasiPindahID]'>$kpdh[NamaKlasifikasiPindah]</option>";
					}
echo"</div></select></td></tr>";  
echo"<tr><td>Jenis Kepindahan</td> 
				  <td><div class='col-md-5'><select name='JenisKepindahan' id='JenisKepindahan' class='form-control' required>";
				  $jpindah1= mysql_query("SELECT JenisKepindahanID, NamaJenisKepindahan FROM tbljeniskepindahan where JenisKepindahanID='$dt[JenisKepindahanID]'");
					$jpdh1 = mysql_fetch_array($jpindah1);
					echo"<option value='$jpdh1[JenisKepindahanID]'>$jpdh1[NamaJenisKepindahan]</option>";
					$jpindah= mysql_query("SELECT JenisKepindahanID, NamaJenisKepindahan FROM tbljeniskepindahan where not JenisKepindahanID='$dt[JenisKepindahanID]'");
					while ($jpdh = mysql_fetch_array($jpindah))
					{
					echo"<option value='$jpdh[JenisKepindahanID]'>$jpdh[NamaJenisKepindahan]</option>";
					}
echo"</div></select></td></tr>";
echo"<tr><td>Status KK Tidak Pindah</td> 
				  <td><div class='col-md-5'><select name='KKTidakPindah' id='KKTidakPindah' class='form-control' required>";
				  $ktpindah1= mysql_query("SELECT StatusKKID,NamaStatusKK FROM tblstatuskk where StatusKKID='$dt[kk_tidak_pindah]'");
				  $ktpdh1 = mysql_fetch_array($ktpindah1);
					echo"<option value='$ktpdh1[StatusKKID]'>$ktpdh1[NamaStatusKK]</option>";
					$ktpindah= mysql_query("SELECT StatusKKID,NamaStatusKK FROM tblstatuskk where not StatusKKID='$dt[kk_tidak_pindah]'");
					while ($ktpdh = mysql_fetch_array($ktpindah))
					{
					echo"<option value='$ktpdh[StatusKKID]'>$ktpdh[NamaStatusKK]</option>";
					}
echo"</div></select></td></tr>"; 
echo"<tr><td>Status KK Pindah</td> 
				  <td><div class='col-md-5'><select name='KKPindah' id='KKPindah' class='form-control' required>";
				  	$kkpindah1= mysql_query("SELECT StatusKKID,NamaStatusKK FROM tblstatuskk where StatusKKID='$dt[kk_pindah]'");
					$kkpdh1 = mysql_fetch_array($kkpindah1);
					echo"<option value='$kkpdh1[StatusKKID]'>$kkpdh1[NamaStatusKK]</option>";
					$kkpindah= mysql_query("SELECT StatusKKID,NamaStatusKK FROM tblstatuskk where not StatusKKID='$dt[kk_pindah]'");
					while ($kkpdh = mysql_fetch_array($kkpindah))
					{
					echo"<option value='$kkpdh[StatusKKID]'>$kkpdh[NamaStatusKK]</option>";
					}
echo"</div></select></td></tr>"; 
echo"<tr>
					<td>Tanggal Datang</td>
					<td><div class='col-md-10'> 
						<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input3' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value='$dt[TanggalDatang]'>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input3' name='xTanggalPindah' value='$dt[TanggalDatang]'></div></td></tr>
					<tr>
						<td colspan='2'><b>Alamat Sekarang (untuk Pendatang/Pindahan/Temporary)</b></td>
					</tr>";
echo"<tr><td>Kewarganegaraan</td> <td><div class='col-md-5'>
<select name='xNegaraID' id='xNegaraID' class='selectpicker show-tick form-control' data-live-search='true' required>";
             $negara1 = mysql_query ("SELECT * from tblnegara where NegaraID='$dt[NegaraID]' ORDER BY NamaNegara ASC");
			 $ngr1=mysql_fetch_array($negara1);
			echo"<option value='$ngr1[NegaraID]'>$ngr1[NamaNegara]</option>";

			$negara = mysql_query ("SELECT * from tblnegara where NOT NegaraID='$dt[NegaraID]' ORDER BY NamaNegara ASC");
			while ($ngr=mysql_fetch_array($negara)){
			echo"<option value='$ngr[NegaraID]'>$ngr[NamaNegara]</option>";
			}
echo"</div></select></td></tr>";
echo"<tr><td>No Kartu Keluarga</td><td><div class='col-md-8'><input type=text name='NoKK' class='form-control' value='$dt[NoKK]' required></div></td></tr>";
echo"<tr>
		<td>Jalan</td>
		<td><div class='col-md-5'><input type='text' name='Jalan' id='Jalan' value='$dt[Jalan]' required class='form-control'></div>
		</td></tr>";
echo"<tr><td>RT / RW</td><td><div class='col-md-2'><input type='text' name='RT' id='RT'  value='$dt[RT]' required class='form-control' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
							<div class='col-md-2'><input type='text' name='RW' id='RW' value='$dt[RW]' placeholder='RW' class='form-control' required onKeyPress='return numbersonly(this, event)'></div></td>
				</tr>";
echo"<tr><td>Provinsi</td><td>
	 <div class='col-lg-5'>
	<select id='provinsi' name='provinsi' class='selectpicker show-tick form-control' data-live-search='true' required>";
	$provinsi1 = mysql_query("SELECT * from tblprovinsi where ProvinsiID='$dt[ProvinsiID]'");
	$prov1=mysql_fetch_array($provinsi1);
		echo"<option value='$prov1[ProvinsiID]'>$prov1[NamaProvinsi]</option>";
	$provinsi = mysql_query("SELECT * from tblprovinsi where NOT ProvinsiID='$dt[ProvinsiID]'");
	while ($prov=mysql_fetch_array($provinsi))
	{
		echo"<option value='$prov[ProvinsiID]'>$prov[NamaProvinsi]</option>";
	}
echo"</select></div></td></tr>";
echo"<tr><td>Kabupaten/Kota</td><td>
	 <div class='col-md-5'>
	<select id='kota' name='kota' class='form-control' required>";
	$kab1 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[KabupatenID]'");
  	$kb1 	= mysql_fetch_array($kab1);
	echo"<option value='$kb1[KabKotaID]'>$kb1[NamaKabKota]</option>";
echo"</div></select></td></tr>";
echo"<tr><td>Kecamatan</td><td>
	 <div class='col-md-5'>
	<select id='kec' name='kec' class='form-control' required>";
	$kec1=mysql_query("SELECT * from tblkecamatan where KecamatanID='$dt[KecamatanID]'");
	$c1=mysql_fetch_array($kec1);
	echo"<option value='$c1[KecamatanID]'>$c1[NamaKecamatan]</option>";
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
	 $dusun1  = mysql_query ("SELECT * from tbldusun ORDER BY NamaDusun ASC");
  while($dsn1  = mysql_fetch_array($dusun1))
  {
  echo"<option value='$dsn1[DusunID]'>$dsn1[NamaDusun]</option>";
  }
	echo"</div></select></td></tr>";
echo"<tr><td>Kode Pos</td><td><div class='col-md-4'><input type='text' name='KodePos' value='$dt[KodePos]' id='KodePos' class='form-control' onKeyPress='return numbersonly(this, event)'></td></tr>";
echo"<tr><td>Upload Foto</td><td><div class='col-md-10'>";
	if ($dt['Photo'] == '')
		{echo"Data Foto Tidak Ada"; }
	else{echo"<img src='$dt[Photo]' width='100' height='100'>"; }
	echo"<input type='file' name='nama_file' id='nama_file'>Bila Foto tidak ada kosongi saja</div></td></tr>";
echo"<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Update</button></p></td></tr>";
echo"</table>";
echo"</form>";
echo"</div>";
?>