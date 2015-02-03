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
$tanggal_entri 	= date('Y-m-d');

$id= $_POST['id'];
$noidentitas 	=$_POST['NoIdentitas'];
$nama_lengkap	=$_POST['NamaLengkap'];
					
$namafolder="image/"; //tempat menyimpan file 
	if (!empty($_FILES["nama_file"]["tmp_name"])) {     
	$jenis_gambar=$_FILES['nama_file']['type']; 
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")     
	{ 
	$gambar = $namafolder . basename($_FILES['nama_file']['name']);
	if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
	
	$sql=mysql_query("UPDATE tblpenduduk SET NoKK		='$_POST[NoKK]',
											PosisiKKID	='$_POST[PosisiKKID]',
											UrutPosisiKK='$_POST[UrutPosisiKK]',
											KartuID		='$_POST[KartuID]',

											NoIdentitas ='$_POST[NoIdentitas]',
											NamaLengkap='$_POST[NamaLengkap]',

											JenisKelamin='$_POST[JenisKelamin]',
											TempatLahir	='$_POST[TempatLahir]',
											TanggalLahir='$_POST[TanggalLahir]',
											Agama		='$_POST[Agama]',

											StatusPerkawinan='$_POST[StatusPerkawinan]',
											Pekerjaan		='$_POST[Pekerjaan]',
											StatusKependudukan='$_POST[StatusKependudukan]',
											PendudukAsli='Pendatang',

											Jalan 		='$_POST[Jalan]',
											RT 			='$_POST[RT]',
											RW 			='$_POST[RW]',
											NegaraID 	='$_POST[xNegaraID]',
											ProvinsiID 	='$_POST[provinsi]',

											KabupatenID ='$_POST[kota]',
											KecamatanID ='$_POST[kec]',
											KelurahanID ='$_POST[kel]',
											DusunID 	='$_POST[dusun]',

											KodePos 	='$_POST[KodePos]',
											NoTelp 		='$_POST[NoTelp]',
											NoHP 		='$_POST[NoHP]',
											Email 		='$_POST[Email]',

											WebSite 	='$_POST[WebSite]',
											JalanLama 	='$_POST[xJalanLama]',
											RTLama 		='$_POST[xRTLama]',
											RWLama 		='$_POST[xRWLama]',

											KelurahanIDLama='$_POST[kel1]',
											KecamatanIDLama='$_POST[kec1]',
											KabupatenIDLama='$_POST[kota1]',
											ProvinsiIDLama='$_POST[provinsi1]',

											NegaraIDLama 	='',
											KodePosLama 	='$_POST[xKodePosLama]',
											Photo 			='$gambar',
											TanggalEntry 	='$tanggal_entri',

											StatusTinggal 	='$_POST[StatusTinggal]',
											PendidikanID 	='$_POST[PendidikanID]',
											BacaID 			='$_POST[BacaID]',
											MutasiID 		='$_POST[MutasiID]',
											Keterangan 		='hidup',

											kk_pindah 		='$_POST[KKPindah]',
											kk_tidak_pindah ='$_POST[KKTidakPindah]',
											TanggalDatang 	='$_POST[xTanggalPindah]',
											status 			='mutasi datang',

											AlasanPindahID  ='$_POST[AlasanPindah]',
											KlasifikasiPindahID='$_POST[KlasifikasiPindah]',
											JenisKepindahanID='$_POST[JenisKepindahan]',
											xNoKKLama 		='$_POST[xNoKKLama]'
											where id = '$id' ") or die (mysql_error());

$aktifitas="User $_SESSION[username] Melakukan Peng-update-an Data Mutasi Penduduk No. $noidentitas dan $nama_lengkap dan photo";
				include"key_log.php";
											

echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
<br/><b>Nama Penduduk <u>$nama_lengkap</u> NIK <u>$noidentitas</u> berhasil ditambahkan dan photo $_POST[KKTidakPindah]</b></p>";
$hal="?mn=data_mutasi";
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
											
			$sql=mysql_query("UPDATE tblpenduduk SET NoKK		='$_POST[NoKK]',
											PosisiKKID	='$_POST[PosisiKKID]',
											UrutPosisiKK='$_POST[UrutPosisiKK]',
											KartuID		='$_POST[KartuID]',

											NoIdentitas ='$_POST[NoIdentitas]',
											NamaLengkap='$_POST[NamaLengkap]',

											JenisKelamin='$_POST[JenisKelamin]',
											TempatLahir	='$_POST[TempatLahir]',
											TanggalLahir='$_POST[TanggalLahir]',
											Agama		='$_POST[Agama]',

											StatusPerkawinan='$_POST[StatusPerkawinan]',
											Pekerjaan		='$_POST[Pekerjaan]',
											StatusKependudukan='$_POST[StatusKependudukan]',
											PendudukAsli='Pendatang',

											Jalan 		='$_POST[Jalan]',
											RT 			='$_POST[RT]',
											RW 			='$_POST[RW]',
											NegaraID 	='$_POST[xNegaraID]',
											ProvinsiID 	='$_POST[provinsi]',

											KabupatenID ='$_POST[kota]',
											KecamatanID ='$_POST[kec]',
											KelurahanID ='$_POST[kel]',
											DusunID 	='$_POST[dusun]',

											KodePos 	='$_POST[KodePos]',
											NoTelp 		='$_POST[NoTelp]',
											NoHP 		='$_POST[NoHP]',
											Email 		='$_POST[Email]',

											WebSite 	='$_POST[WebSite]',
											JalanLama 	='$_POST[xJalanLama]',
											RTLama 		='$_POST[xRTLama]',
											RWLama 		='$_POST[xRWLama]',

											KelurahanIDLama='$_POST[kel1]',
											KecamatanIDLama='$_POST[kec1]',
											KabupatenIDLama='$_POST[kota1]',
											ProvinsiIDLama='$_POST[provinsi1]',

											NegaraIDLama 	='',
											KodePosLama 	='$_POST[xKodePosLama]',
											TanggalEntry 	='$tanggal_entri',

											StatusTinggal 	='$_POST[StatusTinggal]',
											PendidikanID 	='$_POST[PendidikanID]',
											BacaID 			='$_POST[BacaID]',
											MutasiID 		='$_POST[MutasiID]',
											Keterangan 		='hidup',

											kk_pindah 		='$_POST[KKPindah]',
											kk_tidak_pindah ='$_POST[KKTidakPindah]',
											TanggalDatang 	='$_POST[xTanggalPindah]',
											status 			='mutasi datang',

											AlasanPindahID  ='$_POST[AlasanPindah]',
											KlasifikasiPindahID='$_POST[KlasifikasiPindah]',
											JenisKepindahanID='$_POST[JenisKepindahan]',
											xNoKKLama 		='$_POST[xNoKKLama]'
											where id = '$id' ") or die (mysql_error());


	$aktifitas="User $_SESSION[username] Melakukan Peng-update-an Data Mutasi Penduduk No. $noidentitas dan $nama_lengkap tanpa photo";
				include"key_log.php";

	
echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
<br/><b>Nama Penduduk <u>$nama_lengkap</u> NIK <u>$noidentitas</u> berhasil diUpdate tanpa photo</b></p>";
$hal="?mn=data_mutasi";
echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}											
echo"</div></div>";
?>									
