<?php
include "library/koneksi.php";
$var 	= $_GET['mn'];
$menu	= mysql_query("SELECT * from kel_menu where nama_link='$var'");
$mn 	= mysql_fetch_array($menu);
$link 	= $mn['nama_link'];

//membuka data
if ($_GET['mn'] == $link)
{
	$folder="menu/".$link.".php";
	if(file_exists($folder))
	{
		include "$folder";
	}
//apabila modul tidak ditemukan
	else
	{
	?>
  <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Informasi</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-defaul btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
            <?php
	echo"<p><center><b>MENU BELUM TERINSTALL</b></center></p>";
	echo"</div>";
	}	
}
?>
</div></div>
