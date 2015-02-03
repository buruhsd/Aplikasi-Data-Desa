<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";

echo"<div class='box box-solid box-danger'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Informasi</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-danger btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";
								
$nama_menu	=$_POST['nama_menu'];
$nama_link	=$_POST['link_menu'];
$link_menu	= 'mn='.$nama_link;
$sub_menu	=$_POST['sub_menu'];
$status		=$_POST['status'];
$id 		=$_POST['id'];


	$namafolder="image/"; //tempat menyimpan file 
	if (!empty($_FILES["nama_file"]["tmp_name"])) {     
	$jenis_gambar=$_FILES['nama_file']['type']; 
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")     
	{ 
	$gambar = $namafolder . basename($_FILES['nama_file']['name']);
	if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {

	$sql=mysql_query("UPDATE kel_menu SET sub_menu = '$sub_menu',
											nama_menu	='$nama_menu', 
											status 		='$status',
											link_menu	='$link_menu',
											nama_link 	='$nama_link',
											img_menu 	='$gambar' where id_menu_utama ='$id'")	or die (mysql_error());

											

	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Menu <u>$nama_menu</u> berhasil diupdate dengan gambar</b></p>";
		$hal="?mn=user_menu";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";


	} 
	else {
	    echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
				<br/>Gambar gagal dikirim</p>";
				$hal="?mn=user_menu";
				echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";     
	     }
	     } 
	else {
	   echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
				<br/>Jenis gambar yang anda kirim salah. Harus .jpg .gif .png .ico</p>";
				$hal="?mn=user_menu";
				echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";   
		} 
		} 

		else {

		$sql=mysql_query("UPDATE kel_menu SET sub_menu = '$sub_menu',
											nama_menu	='$nama_menu', 
											status 		='$status',
											link_menu	='$link_menu',
											nama_link 	='$nama_link' where id_menu_utama ='$id'")	or die (mysql_error());
														
		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Menu <u>$nama_menu</u> berhasil diupdate tanpa gambar</b></p>";
		$hal="?mn=user_menu";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
		}

?>
