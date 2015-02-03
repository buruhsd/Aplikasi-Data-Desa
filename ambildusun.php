<?php
session_start();
include "library/koneksi.php";

$kel = $_GET['kel'];

echo"<option value=''>Pilih Dusun</option>";
$data_kec= mysql_query("SELECT NamaDusun,DusunID FROM tbldusun where KelurahanID='$kel'");
while($dtc 		 = mysql_fetch_array($data_kec)){
	$id_dusun 	 = $dtc['DusunID'];
		echo"<option value='$id_dusun'>".strtoupper($dtc['NamaDusun'])."</option>";
		}
?>
