<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";

$id= $_GET['id'];

echo"<div class='box box-solid box-danger'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Informasi</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-danger btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

                                
$data   = mysql_query ("SELECT * FROM tblpenduduk where id='$_GET[id]'");
$dt = mysql_fetch_array ($data);
$aktifitas="User $_SESSION[username] Melakukan Penghapusan Data Penduduk $dt[NoIdentitas] $dt[NamaLengkap]";
                include"key_log.php";
    
$sql=mysql_query("INSERT INTO hapustblpenduduk (NoKK,
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
                                                Keterangan)
                                        VALUES('$dt[NoKK]',
                                                '$dt[PosisiKKID]',
                                                '$dt[UrutPosisiKK]',
                                                '$dt[KartuID]',
                                                
                                                '$dt[NoIdentitas]',
                                                '$dt[NamaLengkap]',
                                                '$dt[NamaAyah]',
                                                '$dt[NamaIbu]',
                                                
                                                '$dt[JenisKelamin]',
                                                '$dt[TempatLahir]',
                                                '$dt[TanggalLahir]',
                                                '$dt[Agama]',
                                                
                                                '$dt[StatusPerkawinan]',
                                                '$dt[Pekerjaan]',
                                                '$dt[StatusKependudukan]',
                                                '$dt[PendudukAsli]',
                                                
                                                '$dt[Jalan]',
                                                '$dt[RT]',
                                                '$dt[RW]',
                                                '$dt[NegaraID]',
                                                
                                                '$dt[ProvinsiID]',
                                                '$dt[KabupatenID]',
                                                '$dt[KecamatanID]',
                                                '$dt[KelurahanID]',
                                                
                                                '$dt[DusunID]',
                                                '$dt[KodePos]',
                                                '$dt[NoTelp]',
                                                '$dt[NoHP]',
                                                
                                                '$dt[Email]',
                                                '$dt[WebSite]',
                                                '$dt[TanggalEntry]',
                                                
                                                '$dt[StatusTinggal]',
                                                '$dt[PendidikanID]',
                                                '$dt[BacaID]',
                                                '$dt[Keterangan]')") or die (mysql_error());             
$delete=mysql_query("delete FROM tblpenduduk where id='$_GET[id]'") or die (mysql_error());

 

if($delete){                
$hal="?mn=laporan_data_penduduk";
    echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
    <br/><b>Data Penduduk Berhasil Dihapus</b></p>";
    echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}else{
echo "gagal";
}

echo"</div></div>";
?>

