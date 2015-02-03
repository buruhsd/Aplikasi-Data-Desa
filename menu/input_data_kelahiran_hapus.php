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

$lahir 	= mysql_query ("SELECT * from tblkelahiran where id='$_GET[id]'");
$lhr	= mysql_fetch_array ($lahir);
$aktifitas="User $_SESSION[username] Melakukan Penghapusan Data Kelahiran Nomer $lhr[no_kelahiran]";
				include"key_log.php";

$data = mysql_query("INSERT INTO hapustblkelahiran (no_kelahiran,
                                                                NoKK,
                                                                NamaBayi,
                                                                
                                                                JKelBayi,
                                                                TempatDilahirkan,
                                                                TempatKelahiran,
                                                                HariLahir,
                                                                
                                                                TglLahir,
                                                                Pukul,
                                                                JKelahiran,
                                                                KelahiranKe,
                                                                
                                                                Dusun,
                                                                
                                                                PenolongKelahiran,
                                                                BeratBayi,
                                                                nik_ibu,
                                                                nik_ayah,
                                                                
                                                                nik_pelapor,
                                                                hubungan_bayi,
                                                                nik_saksi1,
                                                                nik_saksi2,
                                                                KelurahanID,
                                                                
                                                                DusunID,
                                                                keturunan_ibu,
                                                                keturunan_ayah,
                                                                kebangsaan_ibu,
                                                                
                                                                kebangsaan_ayah,
                                                                tgl_perkawinan_ibu,
                                                                tanda_tangan,
                                                                TanggalEntry)
                                                        values('$lhr[no_kelahiran]',
                                                                '$lhr[NoKK]',
                                                                '$lhr[NamaBayi]',
                                                                
                                                                '$lhr[JKelBayi]',
                                                                '$lhr[TempatDilahirkan]',
                                                                '$lhr[TempatKelahiran]',
                                                                '$lhr[HariLahir]',
                                                                
                                                                '$lhr[TglLahir]',
                                                                '$lhr[Pukul]',
                                                                '$lhr[JKelahiran]',
                                                                '$lhr[KelahiranKe]',
                                                                
                                                                '$lhr[Dusun]',
                                                                
                                                                '$lhr[PenolongKelahiran]',
                                                                '$lhr[BeratBayi]',
                                                                '$lhr[nik_ibu]',
                                                                '$lhr[nik_ayah]',
                                                                
                                                                '$lhr[nik_pelapor]',
                                                                '$lhr[hubungan_bayi]',
                                                                '$lhr[nik_saksi1]',
                                                                '$lhr[nik_saksi2]',
                                                                '$lhr[KelurahanID]',
                                                                
                                                                'DUSUNID',
                                                                '$lhr[keturunan_ibu]',
                                                                '$lhr[keturunan_ayah]',
                                                                '$lhr[kebangsaan_ibu]',
                                                                
                                                                '$lhr[kebangsaan_ayah]',
                                                                '$lhr[tgl_perkawinan_ibu]',
                                                                '$lhr[tanda_tangan]',
                                                                '$lhr[TanggalEntry]')") or die (mysql_error());
								
	$delete=mysql_query("delete FROM tblkelahiran where id='$_GET[id]'") or die (mysql_error());

if($delete){				
$hal="?mn=data_kelahiran";
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/><b>Data Kelahiran Nomer $lhr[no_kelahiran] Berhasil Dihapus</b></p>";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}else{
echo "gagal";
}

echo"</div></div>";
?>
