<?php
session_start();
include "library/koneksi.php";

$kota = $_GET['kota1'];

echo"<option value=''>Pilih Kecamatan</option>";
$data_kec= mysql_query("SELECT * from tblkecamatan where KabKotaID ='$kota'");
while($dtc 		 = mysql_fetch_array($data_kec)){
	$id_kec 	 = $dtc['KecamatanID'];
		echo"<option value='$id_kec'>".strtoupper($dtc['NamaKecamatan'])."</option>";
		}
?>
