<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
date_default_timezone_set("Asia/Jakarta");
echo"<div class='box box-solid box-danger'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Informasi</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-danger btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

$nama_lengkap 	= $_POST['nama_lengkap'];
$kelamin 		= $_POST['kelamin'];
$tmp_lahir		= $_POST['tmp_lahir'];
$tgl_lahir 		= $_POST['tgl_lahir'];
$no_kk 			= $_POST['no_kk'];
$PosisiKKID 	= $_POST['PosisiKKID'];
$KartuID 		= $_POST['KartuID'];
$UrutPosisiKK 	= $_POST['UrutPosisiKK'];
$noidentitas	= $_POST['noidentitas'];
$Agama 			= $_POST['Agama'];
$StatusPerkawinan = $_POST['StatusPerkawinan'];
$StatusKependudukan = $_POST['StatusKependudukan'];
$PendudukAsli 	= $_POST['PendudukAsli'];
$Pekerjaan 		= $_POST['Pekerjaan'];
$Jalan 			= $_POST['Jalan'];
$rt 			= $_POST['rt'];
$rw 			= $_POST['rw'];
$provinsi 		= $_POST['provinsi'];
$kota 			= $_POST['kota'];
$kec 			= $_POST['kec'];
$kel 			= $_POST['kel'];
$Dusun 			= $_POST['dusun'];
$KodePos 		= $_POST['KodePos'];
$PendidikanID 	= $_POST['PendidikanID'];
$BacaID 		= $_POST['BacaID'];
$NoTelp 		= $_POST['NoTelp'];
$NoHP 			= $_POST['NoHP'];
$Email 			= $_POST['Email'];
$WebSite 		= $_POST['WebSite'];
$negara 		= $_POST['negara'];
$NamaAyah 		= $_POST['NamaAyah'];
$NamaIbu 		= $_POST['NamaIbu'];
$tanggal_entri 	= date('Y-m-d');
$jam			= date('H:i:s');
$waktu			=$tanggal_entri.' '.$jam;
$Keturunan 		= $_POST['Keturunan'];
 
$cek_identitas = mysql_query ("SELECT * from tblpenduduk where KartuID='$KartuID' AND NoIdentitas='$noidentitas'");
$cek = mysql_num_rows($cek_identitas);

if ($cek >0)
{
		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
			<br/>No Identitas Sudah pernah dibuat..silahkan Cek lagi !!</p>";
			$hal="?mn=input_data_penduduk";
			echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}
else
{						
$namafolder="image/"; //tempat menyimpan file 
	if (!empty($_FILES["nama_file"]["tmp_name"])) {     
	$jenis_gambar=$_FILES['nama_file']['type']; 
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")     
	{ 
	$gambar = $namafolder . basename($_FILES['nama_file']['name']);
	if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
	
	$sql=mysql_query("INSERT INTO tblpenduduk (NoKK,
												PosisiKKID,
												UrutPosisiKK,
												KartuID,
												
												NoIdentitas,
												NamaLengkap,
												NamaAyah,
												NamaIbu,
												
												JenisKelamin,
												TempatLahir,
												TanggalLahir,
												Agama,
												
												StatusPerkawinan,
												Pekerjaan,
												StatusKependudukan,
												PendudukAsli,
												
												Jalan,
												RT,
												RW,
												NegaraID,
												
												ProvinsiID,
												KabupatenID,
												KecamatanID,
												KelurahanID,
												
												DusunID,
												KodePos,
												NoTelp,
												NoHP,
												
												Email,
												WebSite,
												Photo,
												TanggalEntry,
												
												StatusTinggal,
												PendidikanID,
												BacaID,
												Keterangan,
												status,
												Keturunan)
										VALUES('$no_kk',
												'$PosisiKKID',
												'$UrutPosisiKK ',
												'$KartuID',
												
												'$noidentitas',
												'$nama_lengkap',
												'$NamaAyah',
												'$NamaIbu',
												
												'$kelamin',
												'$tmp_lahir',
												'$tgl_lahir',
												'$Agama',
												
												'$StatusPerkawinan',
												'$Pekerjaan',
												'$StatusKependudukan',
												'$PendudukAsli',
												
												'$Jalan',
												'$rt',
												'$rw',
												'$negara',
												
												'$provinsi',
												'$kota',
												'$kec',
												'$kel',
												
												'$Dusun',
												'$KodePos',
												'$NoTelp',
												'$NoHP',
												
												'$Email',
												'$WebSite',
												'$gambar',
												'$waktu',
												
												'',
												'$PendidikanID',
												'$BacaID',
												'hidup',
												'asli',
												'$Keturunan')") or die (mysql_error());

$aktifitas="User $_SESSION[username] Melakukan Penginputan Data Penduduk No. $noidentitas dan $nama_lengkap dan photo";
				include"key_log.php";
											

echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
<br/><b>Nama Penduduk <u>$nama_lengkap</u> NIK <u>$noidentitas</u> berhasil ditambahkan dan photo</b></p>";
$hal="?mn=input_data_penduduk";
echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";

	} 
	else {
	    echo "Gambar gagal dikirim";        
	     }
	     } 
	else {
	    echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";    
		} 
		} 
else {
												
		$sql=mysql_query("INSERT INTO tblpenduduk (NoKK,
												PosisiKKID,
												UrutPosisiKK,
												KartuID,
												
												NoIdentitas,
												NamaLengkap,
												NamaAyah,
												NamaIbu,
												
												JenisKelamin,
												TempatLahir,
												TanggalLahir,
												Agama,
												
												StatusPerkawinan,
												Pekerjaan,
												StatusKependudukan,
												PendudukAsli,
												
												Jalan,
												RT,
												RW,
												NegaraID,
												
												ProvinsiID,
												KabupatenID,
												KecamatanID,
												KelurahanID,
												
												DusunID,
												KodePos,
												NoTelp,
												NoHP,
												
												Email,
												WebSite,
												TanggalEntry,
												
												StatusTinggal,
												PendidikanID,
												BacaID,
												Keterangan,
												status,
												Keturunan)
										VALUES('$no_kk',
												'$PosisiKKID',
												'$UrutPosisiKK ',
												'$KartuID',
												
												'$noidentitas',
												'$nama_lengkap',
												'$NamaAyah',
												'$NamaIbu',
												
												'$kelamin',
												'$tmp_lahir',
												'$tgl_lahir',
												'$Agama',
												
												'$StatusPerkawinan',
												'$Pekerjaan',
												'$StatusKependudukan',
												'$PendudukAsli',
												
												'$Jalan',
												'$rt',
												'$rw',
												'$negara',
												
												'$provinsi',
												'$kota',
												'$kec',
												'$kel',
												
												'$Dusun',
												'$KodePos',
												'$NoTelp',
												'$NoHP',
												
												'$Email',
												'$WebSite',
												'tanggal_entri',
												
												'',
												'$PendidikanID',
												'$BacaID',
												'hidup',
												'asli',
												'$Keturunan')") or die (mysql_error());	
												
	$aktifitas="User $_SESSION[username] Melakukan Penginputan Data Penduduk No. $noidentitas dan $nama_lengkap tanpa photo";
				include"key_log.php";

	
echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
<br/><b>Nama Penduduk <u>$nama_lengkap'</u> NIK <u>$noidentitas</u> berhasil ditambahkan tanpa photo</b></p>";
$hal="?mn=input_data_penduduk";
echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}
}											
echo"</div></div>";
?>