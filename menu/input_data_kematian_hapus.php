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

								
$mati	= mysql_query ("SELECT * FROM tblkematian where KematianID='$_GET[id]'");
$mt	= mysql_fetch_array ($mati);

$aktifitas="User $_SESSION[username] Melakukan Penghapusan Data Kematian Nomer $mt[NoSuratKematian]";
				include"key_log.php";

$data = mysql_query("INSERT INTO hapustblkematian (NoSuratKematian,
                                                TanggalSurat,
                                                NoKK,
                                                NamaKepalaKeluarga,
                                                
                                                NIK_Jenazah,
                                                NamaLengkapJenazah,
                                                JenisKelaminJenazah,
                                                TanggalLahirJenazah,
                                                
                                                Umur,
                                                TempatLahirIDJenazah,
                                                AgamaIDJenazah,
                                                PekerjaanIDJenazah,
                                                
                                                AlamatJenazah,
                                                KewarganegaraanJenazah,
                                                KeturunanIDJenazah,
                                                KebangsaanIDJenazah,
                                                
                                                TglKematianJenazah,
                                                JamKematianJenazah,
                                                SebabKematianIDJenazah,
                                                TempatKematianJenazah,
                                                
                                                YangMenerangkanKematian,
                                                NIK_Pelapor,
                                                NamaLengkapPelapor,
                                                HubunganJenazah,
                                                tanda_tangan,
                                                TanggalEntry,
                                                KelurahanID)
                                    values ('$mt[NoSuratKematian]',
                                            '$mt[TanggalSurat]',
                                            '$mt[NoKK]',
                                            '$mt[NamaKepalaKeluarga]',
                                            
                                            '$mt[NIK_Jenazah]',
                                            '$mt[NamaLengkapJenazah]',
                                            '$mt[JenisKelaminJenazah]',
                                            '$mt[TanggalLahirJenazah]',
                                            
                                            '$mt[Umur]',
                                            '$mt[TempatLahirIDJenazah]',
                                            '$mt[AgamaIDJenazah]',
                                            '$mt[PekerjaanIDJenazah]',
                                            
                                            '$mt[AlamatJenazah]',
                                            '$mt[KewarganegaraanJenazah]',
                                            '$mt[KeturunanIDJenazah]',
                                            '$mt[KebangsaanIDJenazah]',
                                            
                                            '$mt[TglKematianJenazah]',
                                            '$mt[JamKematianJenazah]',
                                            '$mt[SebabKematianIDJenazah]',
                                            '$mt[TempatKematianJenazah]',
                                            
                                            '$mt[YangMenerangkanKematian]',
                                            '$mt[NIK_Pelapor]',
                                            '$mt[NamaLengkapPelapor]',
                                            '$mt[HubunganJenazah]',
                                            '$mt[tanda_tangan]',
                                            '$mt[TanggalEntry]',
                                            '$_SESSION[kelurahan]')") or die (mysql_error());

$status=mysql_query("UPDATE tblpenduduk SET Keterangan      ='hidup'
                                                where NoIdentitas ='$mt[NIK_Jenazah]'") or die (mysql_error());
				
$delete=mysql_query("delete FROM tblkematian where KematianID='$_GET[id]'") or die (mysql_error());

if($delete){				
$hal="?mn=data_kematian";
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/><b>Data Kematian Berhasil Dihapus</b></p>";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}else{
echo "gagal";
}

echo"</div></div>";
?>
