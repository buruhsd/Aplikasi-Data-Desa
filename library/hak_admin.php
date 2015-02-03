<?php
if (!isset($_SESSION['username'])) {
		echo '<script>alert("<b>Warning!!</b>Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
###########################
# Akses untuk Modul Admin #
###########################
/* if($_SESSION['levelisasi']=='dosen' OR $_SESSION['levelisasi']=='baak' OR $_SESSION['levelisasi']=='fakultas' OR $_SESSION['levelisasi']=='mahasiswa')
{
	echo '<script>alert("Maaf,Anda tidak berhak akses menu ini!")</script>';
	echo '<meta http-equiv="refresh" content="0; url=index.php" />';
	header('location:../index.php');
} */
?>
