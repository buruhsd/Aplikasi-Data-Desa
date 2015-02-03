<?php
	session_start();
	$aktifitas="USER $_SESSION[id_user] Logout ";
	$ip = getenv ( "REMOTE_ADDR" );
	include"key_log.php";
	session_destroy();
	header('location:index.php');

?>