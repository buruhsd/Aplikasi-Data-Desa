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
$cek_identitas = mysql_query ("SELECT * from tblpenduduk where KartuID='$_POST[KartuID]' AND NoIdentitas='$_POST[NoIdentitas]'");
$cek = mysql_num_rows($cek_identitas);

$noidentitas 	=$_POST['NoIdentitas'];
$nama_lengkap	=$_POST['NamaLengkap'];

if ($cek >0)
{
		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
			<br/>No Identitas Sudah pernah dibuat..silahkan Cek lagi !!</p>";
			$hal="?mn=input_mutasi_datang";
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
											JalanLama,
											RTLama,
											RWLama,

											KelurahanIDLama,
											KecamatanIDLama,
											KabupatenIDLama,
											ProvinsiIDLama,

											NegaraIDLama,
											KodePosLama,
											Photo,
											TanggalEntry,

											StatusTinggal,
											PendidikanID,
											BacaID,
											MutasiID,
											Keterangan,

											kk_pindah,
											kk_tidak_pindah,
											TanggalDatang,
											status,

											AlasanPindahID,
											KlasifikasiPindahID,
											JenisKepindahanID)
							VALUES (		'$_POST[NoKK]',
											'$_POST[PosisiKKID]',
											'$_POST[UrutPosisiKK]',
											'$_POST[KartuID]',

											'$_POST[NoIdentitas]',
											'$_POST[NamaLengkap]',

											'$_POST[JenisKelamin]',
											'$_POST[TempatLahir]',
											'$_POST[TanggalLahir]',
											'$_POST[Agama]',

											'$_POST[StatusPerkawinan]',
											'$_POST[Pekerjaan]',
											'$_POST[StatusKependudukan]',
											'Pendatang',

											'$_POST[Jalan]',
											'$_POST[RT]',
											'$_POST[RW]',
											'$_POST[xNegaraID]',
											'$_POST[provinsi]',

											'$_POST[kota]',
											'$_POST[kec]',
											'$_POST[kel]',
											'$_POST[dusun]',

											'$_POST[KodePos]',
											'$_POST[NoTelp]',
											'$_POST[NoHP]',
											'$_POST[Email]',

											'$_POST[WebSite]',
											'$_POST[xJalanLama]',
											'$_POST[xRTLama]',
											'$_POST[xRWLama]',

											'$_POST[kel1]',
											'$_POST[kec1]',
											'$_POST[kota1]',
											'$_POST[provinsi1]',

											'',
											'$_POST[xKodePosLama]',
											'$gambar',
											'$tanggal_entri',

											'$_POST[StatusTinggal]',
											'$_POST[PendidikanID]',
											'$_POST[BacaID]',
											'$_POST[MutasiID]',
											'hidup',

											'$_POST[KKPindah]',
											'$_POST[KKTidakPindah]',
											'$_POST[xTanggalPindah]',
											'$_POST[status]',

											'$_POST[AlasanPindah]',
											'$_POST[KlasifikasiPindah]',
											'$_POST[JenisKepindahan]')") or die (mysql_error());

$aktifitas="User $_SESSION[username] Melakukan Penginputan Data Mutasi Penduduk No. $noidentitas dan $nama_lengkap dan photo";
				include"key_log.php";
											

echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
<br/><b>Nama Penduduk <u>$nama_lengkap</u> NIK <u>$noidentitas</u> berhasil ditambahkan dan photo $_POST[KKTidakPindah]</b></p>";
$hal="?mn=data_mutasi_datang_view&id=$_POST[NoKK]";
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
											JalanLama,
											RTLama,
											RWLama,

											KelurahanIDLama,
											KecamatanIDLama,
											KabupatenIDLama,
											ProvinsiIDLama,

											NegaraIDLama,
											KodePosLama,
											TanggalEntry,

											StatusTinggal,
											PendidikanID,
											BacaID,
											MutasiID,
											Keterangan,

											kk_pindah,
											kk_tidak_pindah,
											TanggalDatang,
											status,

											AlasanPindahID,
											KlasifikasiPindahID,
											JenisKepindahanID,
											xNoKKLama)
							VALUES (		'$_POST[NoKK]',
											'$_POST[PosisiKKID]',
											'$_POST[UrutPosisiKK]',
											'$_POST[KartuID]',

											'$_POST[NoIdentitas]',
											'$_POST[NamaLengkap]',

											'$_POST[JenisKelamin]',
											'$_POST[TempatLahir]',
											'$_POST[TanggalLahir]',
											'$_POST[Agama]',

											'$_POST[StatusPerkawinan]',
											'$_POST[Pekerjaan]',
											'$_POST[StatusKependudukan]',
											'Pendatang',

											'$_POST[Jalan]',
											'$_POST[RT]',
											'$_POST[RW]',
											'$_POST[xNegaraID]',
											'$_POST[provinsi]',

											'$_POST[kota]',
											'$_POST[kec]',
											'$_POST[kel]',
											'$_POST[dusun]',

											'$_POST[KodePos]',
											'$_POST[NoTelp]',
											'$_POST[NoHP]',
											'$_POST[Email]',

											'$_POST[WebSite]',
											'$_POST[xJalanLama]',
											'$_POST[xRTLama]',
											'$_POST[xRWLama]',

											'$_POST[kel1]',
											'$_POST[kec1]',
											'$_POST[kota1]',
											'$_POST[provinsi1]',

											'',
											'$_POST[xKodePosLama]',
											'$tanggal_entri',

											'$_POST[StatusTinggal]',
											'$_POST[PendidikanID]',
											'$_POST[BacaID]',
											'$_POST[MutasiID]',
											'Hidup',

											'$_POST[KKPindah]',
											'$_POST[KKTidakPindah]',
											'$_POST[xTanggalPindah]',
											'$_POST[status]',

											'$_POST[AlasanPindah]',
											'$_POST[KlasifikasiPindah]',
											'$_POST[JenisKepindahan]',
											'$_POST[xNoKKLama]')") or die (mysql_error());

	$aktifitas="User $_SESSION[username] Melakukan Penginputan Data Mutasi Penduduk No. $noidentitas dan $nama_lengkap tanpa photo";
				include"key_log.php";

	
echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
<br/><b>Nama Penduduk <u>$nama_lengkap</u> NIK <u>$noidentitas</u> berhasil ditambahkan tanpa photo</b></p>";
$hal="?mn=data_mutasi_datang_view&id=$_POST[NoKK]";
echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}
}											
echo"</div></div>";
?>									
