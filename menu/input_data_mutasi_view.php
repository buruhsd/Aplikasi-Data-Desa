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
                                    <h3 class="box-title">Data Penduduk</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
$data 	= mysql_query ("SELECT * from tblpenduduk where id='$id'");
$dt 	= mysql_fetch_array($data);

echo"<table class='table'>
	<tr><td colspan='2'><div class='col-md-10'><center>";
	if ($dt['Photo'] == '')
		{echo"Data Foto Tidak Ada"; }
	else{echo"<img src='$dt[Photo]' width='150' height='150'>"; }
echo"</center></div></td></tr>
	<tr><td>Nama Lengkap</td><td><div class='col-md-8'>".strtoupper($dt['NamaLengkap'])."</div></td></tr>
	<tr><td>Jenis Kelamin</td><td><div class='col-md-5'>";
		if ($dt['JenisKelamin'] == 0)
		{	echo"Laki-Laki";  }
		else
		{echo"Perempuan";}
echo"<tr><td>Tempat Lahir</td><td>
	<div class='col-md-5'>";
	$datalahir 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[TempatLahir]' ORDER BY NamaKabKota ASC");
	$lhr 	= mysql_fetch_array($datalahir);
	echo"$lhr[NamaKabKota]";
	echo"</div></td></tr>";
echo"<tr><td>Tanggal Lahir</td><td><div class='col-md-10'> $dt[TanggalLahir]</div></td></tr>";
echo"<tr><td>No Kartu Keluarga</td><td><div class='col-md-8'>$dt[NoKK]</div></td></tr>";
echo"<tr><td>Posisi dalam Keluarga</td><td><div class='col-md-4'>";
	$datakk = mysql_query ("SELECT * from tblposisikk where PosisiKKID='$dt[PosisiKKID]' ORDER BY PosisiKKID ASC");
	$kk 	= mysql_fetch_array($datakk);
	echo"$kk[NamaPosisiKK]";
echo"</div>
		<div class='col-md-4'>Urutan Ke $dt[UrutPosisiKK]</div></td></tr>";
echo"<tr><td>Nomor NIK KK/Identitas</td><td>";
echo"<div class='col-md-4'>";
		if ($dt['KartuID'] == 0)
        {  echo"KTP"; }
        else
        { echo"Passport";}
echo"</div>";
echo"<div class='col-md-4'>$dt[NoIdentitas]</div></td></tr>";
echo"<tr><td>Agama</td><td><div class='col-md-5'>";
	$dataagama 	= mysql_query("SELECT * from tblagama where AgamaID='$dt[Agama]'");
	$dtagm 		= mysql_fetch_array($dataagama);
	echo"$dtagm[NamaAgama]";
echo"</div></td></tr>";	
echo"<tr><td>Status Perkawinan</td><td><div class='col-md-5'>";
	$datakawin 	= mysql_query ("SELECT * from tblstatuskawin where StatusPerkawinan='$dt[StatusPerkawinan]'");
	$kwn 		= mysql_fetch_array($datakawin);
	echo"$kwn[NamaStatusPerkawinan]";
echo"</div></td></tr>";							
echo"<tr><td>Status Kependudukan</td><td><div class='col-md-5'>";
		if ($dt['StatusKependudukan'] == '0')
			{ echo"WNI"; }
		else
		{ echo"WNA"; }
							
echo"</div></select></td></tr>";
echo"<tr><td>Penduduk Desa/Bukan</td><td><div class='col-md-5'>";
		if ($dt['PendudukAsli'] == '0')
			{ echo"Desa";}
		else { echo"Pendatang";}							
echo"</div></td></tr>";
echo"<tr><td>Pekerjaan</td><td><div class='col-md-5'>";
	$dataPekerjaan = mysql_query("SELECT * from tblpekerjaan where PekerjaanID='$dt[Pekerjaan]'");
	$dtpkj = mysql_fetch_array ($dataPekerjaan);
	echo"$dtpkj[NamaPekerjaan]";
echo"</div></td></tr>";	
echo"<tr><td>Jalan</td><td><div class='col-md-10'>$dt[Jalan] </div> <div class='col-md-3'> RT $dt[RT]  / RW $dt[RW]</div></td></tr>";
echo"<tr><td>Provinsi</td><td>
	 <div class='col-lg-5'>";
	$data_provinsi 	= mysql_query("SELECT * from tblprovinsi where ProvinsiID='$dt[ProvinsiID]'");
	$dtprov 	 	= mysql_fetch_array($data_provinsi);
	echo"$dtprov[NamaProvinsi]";
echo"</div></td></tr>";
echo"<tr><td>Kabupaten/Kota</td><td>
	 <div class='col-md-5'>";
	$kab 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[KabupatenID]'");
  	$kb 	= mysql_fetch_array($kab);
	echo"$kb[KabKotaID]";
echo"</div></td></tr>";
echo"<tr><td>Kecamatan</td><td>
	 <div class='col-md-5'>";
	$kec=mysql_query("SELECT * from tblkecamatan where KecamatanID='$dt[KecamatanID]'");
	$c=mysql_fetch_array($kec);
	echo"$c[NamaKecamatan]";
echo"</div></td></tr>";
echo"<tr><td>Kelurahan</td><td>
	 <div class='col-md-5'>";
	$kel=mysql_query("SELECT * from tblkelurahan where KelurahanID='$dt[KelurahanID]'");
	$l=mysql_fetch_array($kel);
	echo"$l[NamaKelurahan]";
echo"</div></select></td></tr>";
echo"<tr><td>Dusun</td><td><div class='col-md-5'>";
	$dusun=mysql_query("SELECT * from tbldusun where DusunID='$dt[DusunID]'");
	$dsn=mysql_fetch_array($dusun);
	echo"$dsn[NamaDusun]";
	echo"</div></td></tr>";
echo"<tr><td>Kode Pos</td><td><div class='col-md-4'>$dt[KodePos]</td></tr>";
echo"<tr><td>Pendidikan Terakhir </td><td><div class='col-md-10'>";
			$dataPendidikan = mysql_query("SELECT * from tblpendidikan where PendidikanID='$dt[PendidikanID]'");
			$dtpen = mysql_fetch_array($dataPendidikan);
            echo"$dtpen[NamaPendidikan]";
echo"</div></td></tr>";   
echo"<tr><td>Dapat Membaca Huruf </td> 
				  <td><div class='col-md-5'>";
				  $datahuruf 	= mysql_query("SELECT * from tblbacahuruf where BacaID='$dt[BacaID]'");
				  $dthrf 		= mysql_fetch_array($datahuruf);
				  echo"$dthrf[Keterangan]";
echo"</div></td></tr>";   
echo"<tr><td>No. Telpon</td><td><div class='col-md-3'>$dt[NoTelp]</div></td></tr>";
echo"<tr><td>No. Handphone</td><td><div class='col-md-3'>$dt[NoHP]</div></td></tr>";
echo"<tr><td>Email</td><td><div class='col-md-5'>$dt[Email]</div></td></tr>";
echo"<tr><td>Website</td><td><div class='col-md-5'>$dt[WebSite]</div></td></tr>";
echo"<tr><td>Kewarganegaraan</td> <td><div class='col-md-5'>";
			$dtnegara 	= mysql_query ("SELECT * from tblnegara where NegaraID='$dt[NegaraID]'");
			$dtngr 		= mysql_fetch_array($dtnegara);
            echo"$dtngr[NamaNegara]";
echo"</div></td></tr>";
//echo"<tr><td>Nama Ayah</td><td><div class='col-md-8'>$dt[NamaAyah]</div></td></tr>";
//echo"<tr><td>Nama Ibu</td><td><div class='col-md-8'>$dt[NamaIbu]</div></td></tr>";
echo"<tr><td>Status Mutasi</td><td><div class='col-md-8'>".strtoupper($dt['status'])."</div></td></tr>";
echo"</table>";
echo"</div>";
?>