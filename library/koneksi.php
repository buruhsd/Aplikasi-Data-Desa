<?php
$host		="localhost"; //localhost //192.168.0.3
$user		="root"; //root //md //admin_md
$pass		=""; //mdjaya //mdadmin
$database	="kelurahan";
$koneksi	= mysql_connect($host,$user,$pass);

if(!$koneksi)
die("Tidak Bisa terhubung dengan server!");

if(!mysql_select_db($database,$koneksi))
die("Database tidak bisa di akses!");
?>
