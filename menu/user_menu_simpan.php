<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";

$nama_menu	=$_POST['nama_menu'];
$nama_link	=$_POST['link_menu'];
$link_menu	= 'mn='.$nama_link;
$sub_menu	=$_POST['sub_menu'];
$status		=$_POST['status'];

$menu	= mysql_query("select * from kel_menu where nama_menu='$nama_menu'");
$m		= mysql_num_rows($menu);


echo"<div class='box box-solid box-danger'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Informasi</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn btn-danger btn-xs' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                    </div>
                                </div>
                                <div class='box-body'>";

if ($m >0)
{
	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
	<br/>Nama Menu sudah pernah dibuat silahkan ulangi lagi !!</p>";
	$hal="?mn=user_menu_tambah";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
}
else
{

	$namafolder="image/"; //tempat menyimpan file 
	if (!empty($_FILES["nama_file"]["tmp_name"])) {     
	$jenis_gambar=$_FILES['nama_file']['type']; 
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")     
	{ 
	$gambar = $namafolder . basename($_FILES['nama_file']['name']);
	if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {

	$sql=mysql_query("INSERT INTO kel_menu (sub_menu,
														nama_menu,
														status,
														link_menu,
														nama_link,
														img_menu)
												VALUES ('$sub_menu',
														'$nama_menu',
														'$status',
														'$link_menu',
														'$nama_link',
														'$gambar')") or die (mysql_error());

											

	echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Menu <u>$nama_menu</u> berhasil ditambahkan dan gambar</b></p>";
		$hal="?mn=user_menu";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";


	} 
	else {
	    echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
				<br/>Gambar gagal dikirim</p>";
				$hal="?mn=user_menu_tambah";
				echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";     
	     }
	     } 
	else {
	   echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
				<br/>Jenis gambar yang anda kirim salah. Harus .jpg .gif .png .ico</p>";
				$hal="?mn=user_menu_tambah";
				echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";   
		} 
		} 

		else {

		$query		=mysql_query("INSERT INTO kel_menu (sub_menu,
														nama_menu,
														status,
														link_menu,
														nama_link)
												VALUES ('$sub_menu',
														'$nama_menu',
														'$status',
														'$link_menu',
														'$nama_link')") or die (mysql_error());
														
		echo"<br/><p align=center><img title='image/ajax-loader-7.gif' src='image/ajax-loader-7.gif'>
		<br/><b>Menu <u>$nama_menu</u> berhasil ditambahkan tanpa gambar</b></p>";
		$hal="?mn=user_menu";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
		}

}
echo"</div></div>";
?>
