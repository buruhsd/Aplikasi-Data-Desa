<?php
echo"<table>
	<tr>
	<form method='POST' action='/Print/surat_pengantar.php' target='_blank'>
	<td><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-print'></span> Permohonan Pengantar</button></td>
	</form>
	</tr>
	<tr>
	
	<form method='POST' action='Print/surat_permohonan_ktp.php' target='_blank'>
	<td><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-print'></span> Permohonan KTP</button></td>
	</form>
	</tr>
	<tr>
	<form method='POST' action='Print/surat_kelahiran.php' target='_blank'>
	<td><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-print'></span> Surat Kelahiran</button></td>
	</form>
	<form method='POST' action='Print/surat_kelahiran_new.php' target='_blank'>
	<td><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-print'></span> Surat Kelahiran</button></td>
	</form>
	</tr>
	<tr>
	<form method='POST' action='Print/surat_kematian.php' target='_blank'>
	<td><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-print'></span> Surat Kematian</button></td>
	</form>
	<form method='POST' action='Print/surat_kematian_new.php' target='_blank'>
	<td><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-print'></span> Surat Kematian</button></td>
	</form>
	</tr>
	<form method='POST' action='Print/surat_pindah_wni.php' target='_blank'>
	<td><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-print'></span> Pindah WNI</button></td>
	</form>
	<form method='POST' action='buku_mutasi.php' target='_blank'>
	<td><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-print'></span> Pindah WNI lagi</button></td>
	</form>
	</tr>
	</table>";
	?>