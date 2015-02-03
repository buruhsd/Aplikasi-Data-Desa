<?php
include "library/koneksi.php";
include"fungsi_menu.php";

error_reporting(0);
$sql=mysql_query("SELECT * FROM kel_menu where status='tampil'");

while ($row = mysql_fetch_object($sql)) {
	       $data[$row->sub_menu][] = $row;
      }
      $menu = get_menu($data);
      echo "$menu"; 
?>