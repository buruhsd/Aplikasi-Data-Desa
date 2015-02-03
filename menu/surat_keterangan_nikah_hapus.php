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

$cek_surat  = mysql_query ("SELECT * FROM tblsuratketerangannikah where SuratKeteranganNikahID='$_GET[id]'");
    $cek            = mysql_fetch_array($cek_surat);

$aktifitas="User $_SESSION[username] Melakukan Peng-Hapus-an Surat Keterangan Nikah No $cek[SuratKeteranganNikah] , $cek[NamaCalonIstri] &  $cek[NamaCalonSuami]  ";
                include"key_log.php";

$data = mysql_query("INSERT INTO hapustblsuratketerangannikah (SuratKeteranganNikah,
                                                                        NoIdentitasCalonIstri,
                                                                        NamaCalonIstri,
                                                                        TempatLahirCalonIstri,

                                                                        TanggalLahirCalonIstri,
                                                                        KewarganegaraanCalonIstri,
                                                                        AgamaCalonIstri,
                                                                        PekerjaanCalonIstri,

                                                                        JalanCalonIstri,
                                                                        RTCalonIstri,
                                                                        RWCalonIstri,
                                                                        KelurahanCalonIstri,

                                                                        KecamatanCalonIstri,
                                                                        KabupatenCalonIstri,
                                                                        ProvinsiCalonIstri,
                                                                        StatusPerkawinanIstri,

                                                                        NoIdentitasCalonSuami,
                                                                        NamaCalonSuami,
                                                                        TempatLahirCalonSuami,
                                                                        TanggalLahirCalonSuami,

                                                                        KewarganegaraanCalonSuami,
                                                                        AgamaCalonSuami,
                                                                        PekerjaanCalonSuami,
                                                                        JalanCalonSuami,

                                                                        RTCalonSuami,
                                                                        RWCalonSuami,
                                                                        KelurahanCalonSuami,
                                                                        KecamatanCalonSuami,

                                                                        KabupatenCalonSuami,
                                                                        ProvinsiCalonSuami,
                                                                        StatusPerkawinanSuami,
                                                                        TanggalSurat,

                                                                        TanggalPernikahan,
                                                                        JamPernikahan,
                                                                        Maskawin,
                                                                        TunaiHutang,

                                                                        tanda_tangan,
                                                                        KelurahanID)
                                                                values('$cek[SuratKeteranganNikah]',
                                                                        '$cek[NoIdentitasCalonIstri]',
                                                                        '$cek[NamaCalonIstri]',
                                                                        '$cek[TempatLahirCalonIstri]',

                                                                        '$cek[TanggalLahirCalonIstri]',
                                                                        '$cek[KewarganegaraanCalonIstri]',
                                                                        '$cek[AgamaCalonIstri]',
                                                                        '$cek[PekerjaanCalonIstri]',

                                                                        '$cek[JalanCalonIstri]',
                                                                        '$cek[RTCalonIstri]',
                                                                        '$cek[RWCalonIstri]',
                                                                        '$cek[KelurahanCalonIstri]',

                                                                        '$cek[KecamatanCalonIstri]',
                                                                        '$cek[KabupatenCalonIstri]',
                                                                        '$cek[ProvinsiCalonIstri]',
                                                                        '$cek[StatusPerkawinanIstri]',

                                                                        '$cek[NoIdentitasCalonSuami]',
                                                                        '$cek[NamaCalonSuami]',
                                                                        '$cek[TempatLahirCalonSuami]',
                                                                        '$cek[TanggalLahirCalonSuami]',

                                                                        '$cek[KewarganegaraanCalonSuami]',
                                                                        '$cek[AgamaCalonSuami]',
                                                                        '$cek[PekerjaanCalonSuami]',
                                                                        '$cek[JalanCalonSuami]',

                                                                        '$cek[RTCalonSuami]',
                                                                        '$cek[RWCalonSuami]',
                                                                        '$cek[KelurahanCalonSuami]',
                                                                        '$cek[KecamatanCalonSuami]',

                                                                        '$cek[KabupatenCalonSuami]',
                                                                        '$cek[ProvinsiCalonSuami]',
                                                                        '$cek[StatusPerkawinanSuami]',
                                                                        '$cek[TanggalSurat]',

                                                                        '$cek[TanggalPernikahan]',
                                                                        '$cek[JamPernikahan]',
                                                                        '$cek[Maskawin]',
                                                                        '$cek[TunaiHutang]',

                                                                        '$cek[tanda_tangan]',
                                                                        '$cek[KelurahanID]')") or die (mysql_error());

$delete=mysql_query("delete FROM tblsuratketerangannikah where SuratKeteranganNikahID='$_GET[id]'") or die (mysql_error());
if($delete){				
$hal="?mn=data_surat_nikah";
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/><b>Data Surat Keterangan Berhasil Dihapus</b></p>";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}else{
echo "gagal";
}

echo"</div></div>";
?>
