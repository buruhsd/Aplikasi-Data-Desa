<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
//include "koneksi/fungsi_library.php";
date_default_timezone_set("Asia/Jakarta");
?>
<div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Informasi</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-defaul btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<p>Selamat Datang.. <b>$_SESSION[username]</b>, di Aplikasi Kelurahan Desa Jepara.</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>";

echo "<p align=right>Login Hari ini: ";
 echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo "</p>";
echo"</div></div>";
?>