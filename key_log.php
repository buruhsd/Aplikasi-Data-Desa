<?php
include "library/koneksi.php";
date_default_timezone_set("Asia/Jakarta");


$LogSystem = "log_system";
$ip = getenv ( "REMOTE_ADDR" );
$waktu=date('Y-m-d H:i:s');
$operator=$_SESSION['username'];

$keylog="INSERT INTO history (ip,keterangan,tanggal,user) VALUES ('$ip','$aktifitas','$waktu','$operator')";
mysql_query($keylog) or die (mysql_error());

?>