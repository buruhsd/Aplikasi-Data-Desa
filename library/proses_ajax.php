<?php
//buat koneksi
include"koneksi.php";

//pencarian nama
echo "<font face=verdana size=2px>NIM yang Anda cari adalah : </font>".$key=$_GET['searching'];
$result=mysql_query("select * from tblpenduduk where NoIdentitas like '%$key%'"); 
$get_pages=mysql_num_rows($result);

if ($get_pages){
	?>
		<br /><br />
		<table>
		<tr>
			<th>No</th>
			<th>NIM</th>
			<th>Nama</th>
            <th>Tgl Lahir</th>
			<th>No.Hp</th>
            <th>Aksi</th>
		  </th>
	<?php
	$offset=0;
	while ($row=mysql_fetch_array($result)){
		$nim=$row['NoIdentitas'];
		$nama=$row['NamaLengkap'];
		$lahir=$row['NamaAyah'];
		$telepon=$row['NamaIbu'];
		?>
		<tr>
			<td><?php echo $offset=$offset+1; ?></td>
			<td><?php echo $nim;?></td>
			<td><?php echo $nama;?></td>
			<td><?php echo $lahir;?></td>
			<td><?php echo $telepon;?></td>
            
		  </tr>
		<?php
	}
	
	
	?></table>
		<?php
}else{
	?><br /><b>Belum ada data!!</b><?php
}
?>