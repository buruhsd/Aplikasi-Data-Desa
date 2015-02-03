<?php
session_start();
include "library/koneksi.php";

$provinsi = $_GET['provinsi'];


echo"<option value=''>Pilih Kab Kota</option>";
$data_kota= mysql_query("SELECT * from tblkabkota where ProvinsiID ='$provinsi'");
while($dtc 		 = mysql_fetch_array($data_kota)){
	$id_kota 	 = $dtc['KabKotaID'];
		echo"<option value='$id_kota'>".strtoupper($dtc['NamaKabKota'])."</option>";
		}
?>
