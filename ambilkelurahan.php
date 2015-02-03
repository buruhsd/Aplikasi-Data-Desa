<?php
session_start();
include "library/koneksi.php";

$kec = $_GET['kec'];


echo"<option value=''>Pilih Kelurahan</option>";
$data_kec= mysql_query("SELECT * from tblkelurahan where KecamatanID ='$kec'");
while($dtc 		 = mysql_fetch_array($data_kec)){
	$id_kec 	 = $dtc['KelurahanID'];
		echo"<option value='$id_kec'>".strtoupper($dtc['NamaKelurahan'])."</option>";
		}
?>
