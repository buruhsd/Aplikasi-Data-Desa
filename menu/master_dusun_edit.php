<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
$id 	= $_GET['id'];
echo"<div class='box box-primary'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Master Data Dusun</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-primary btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

 $master_dusun 	= mysql_query("SELECT * from tbldusun where DusunID='$id'");
 $md 		   	= mysql_fetch_array($master_dusun);

 $kelurahan    	= mysql_query("SELECT * from tblkelurahan where KelurahanID='$md[KelurahanID]'");
 $kl 			= mysql_fetch_array($kelurahan);

echo"<form method='POST' action='media.php?mn=master_dusun_update'>";
echo"<input type=hidden name='id' value='$id'>"; 
echo"<table class='table'>
		<tr><td>Nama Kelurahan</td><td><div class='col-md-5'><input type='text' name='nama_kelurahan' value=".strtoupper($kl['NamaKelurahan'])." readonly class='form-control'></div></td></tr>
		<tr><td>Nama Dusun</td><td><div class='col-md-5'><input type='text' name='nama_dusun' value=".strtoupper($md['NamaDusun'])." required class='form-control'></div></td></tr>";
echo"<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Update</button>
				<button type='reset' class='btn btn-primary' onclick=self.history.back()>
					<i class='fa fa-fw fa-repeat'></i>Batal</button></p></td></tr>";
		echo"</thead></table>";
				echo"</form>";
					echo"</div></div>";
					?>
	
