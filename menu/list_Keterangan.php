<?php
include "../library/koneksi.php";
include "../library/fungsi_library.php";
?>
<script>
  $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
			
// namalenkpa, nomorkk, nik, alamat, rt, rw, kodepos
	function pilih(nama,nik,nokk,tempat_lahir,tgl,jkel,pekerjaan,kewarganegaraan,agama,alamat,kelurahan,kelurahanid,kec,kab){
		self.opener.document.forms[0].Nama.value=nama;
		self.opener.document.forms[0].Nik.value=nik;
		self.opener.document.forms[0].No_kk.value=nokk;
		self.opener.document.forms[0].Tempat_lahir.value=tempat_lahir;
		self.opener.document.forms[0].Tgl_lahir.value=tgl;
		self.opener.document.forms[0].Jkel.value=jkel;
		self.opener.document.forms[0].Pekerjaan.value=pekerjaan;
		self.opener.document.forms[0].Kewarganegaraan.value=kewarganegaraan;
		self.opener.document.forms[0].Agama.value=agama;
		self.opener.document.forms[0].Alamat.value=alamat;
		self.opener.document.forms[0].Kelurahan.value=kelurahan;
		self.opener.document.forms[0].KelurahanID.value=kelurahanid;
		self.opener.document.forms[0].Kec.value=kec;
		self.opener.document.forms[0].Kab.value=kab;
		window.close();
	}
	

</script>
<body>
<form name="formKK" action="" method="post">
<div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
											  <th>No</th>
											  <th>No Kartu Keluarga</th>
											  <th>NIK</th>
											  <th>Nama Lengkap</th>
											  <th>Umur</th>
											  <th>Alamat</th>
											  </tr>
											</thead>
											<tbody>
  <?php 
	$sql = "SELECT
			tblpekerjaan.NamaPekerjaan,
			tblpenduduk.TanggalLahir,
			tblkabkota.NamaKabKota,
			tblpenduduk.KartuID,
			tblpenduduk.NoIdentitas,
			tblpenduduk.NoKK,
			tblpenduduk.Jalan,
			tblnegara.NamaNegara,
			tblpenduduk.ProvinsiID,
			tblpenduduk.KabupatenID,
			tblpenduduk.KecamatanID,
			tblpenduduk.KelurahanID,
			tblpenduduk.DusunID,
			tblpenduduk.NamaLengkap,
			tblpenduduk.JenisKelamin,
			tblagama.NamaAgama
			FROM
			tblpekerjaan
			INNER JOIN tblpenduduk ON tblpekerjaan.PekerjaanID = tblpenduduk.Pekerjaan
			INNER JOIN tblkabkota ON tblpenduduk.TempatLahir = tblkabkota.KabKotaID
			INNER JOIN tblnegara ON tblnegara.NegaraID = tblpenduduk.NegaraID
			INNER JOIN tblagama ON tblagama.AgamaID = tblpenduduk.Agama ORDER BY tblpenduduk.TanggalLahir DESC"; 
	$q = mysql_query($sql); $no=0; while($qq=mysql_fetch_array($q)) { $no++; 
	$prov=mysql_query("SELECT NamaProvinsi,ProvinsiID from tblprovinsi where ProvinsiID='$qq[ProvinsiID]'");
		$p=mysql_fetch_array($prov);
		$kab=mysql_query("SELECT NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$qq[KabupatenID]'");
		$b=mysql_fetch_array($kab);
		$kec=mysql_query("SELECT NamaKecamatan,KecamatanID from tblkecamatan where KecamatanID='$qq[KecamatanID]'");
		$c=mysql_fetch_array($kec);
		$kel=mysql_query("SELECT NamaKelurahan,KelurahanID from tblkelurahan where KelurahanID='$qq[KelurahanID]'");
		$l=mysql_fetch_array($kel);
$nama		 =$qq['NamaLengkap'];
$nokk 		 =$qq['NoKK'];
$nik		 =$qq['NoIdentitas'];
$tempat_lahir=$qq['NamaKabKota'];
if($qq['JenisKelamin'] == 0){
$jkel	 	 ="Laki-Laki";
}else{
$jkel 		="Perempuan";
}
$pekerjaan	 =$qq['NamaPekerjaan'];
$kewarganegaraan=$qq['NamaNegara'];
$agama	 	 =$qq['NamaAgama'];
$alamat		 =$qq['Jalan'];
$provid		 =$qq['ProvinsiID'];
$prov		 =$p['NamaProvinsi'];
$kabid		 =$b['KabKotaID'];
$kab		 =$b['NamaKabKota'];
$kecid		 =$c['KecamatanID'];
$kec		 =$c['NamaKecamatan'];
$kelurahanid =$l['KelurahanID'];
$kelurahan 	 =$l['NamaKelurahan'];
$tgl		 =$qq['TanggalLahir'];
$umur 		 =umur($tgl);
?>
	<tr><td><?php echo"$no";?></td>
			<td><?php echo"$nokk";?></td>
			<td><a href="#" onClick="javascript:pilih('<?php echo"$nama";?>',
														'<?php echo"$nik";?>',
														'<?php echo"$nokk";?>',
														'<?php echo"$tempat_lahir";?>',
														'<?php echo"$tgl";?>',
														'<?php echo"$jkel";?>',
														'<?php echo"$pekerjaan";?>',
														'<?php echo"$kewarganegaraan";?>',
														'<?php echo"$agama";?>',
														'<?php echo"$alamat";?>',
														'<?php echo"$kelurahan";?>',
														'<?php echo"$kelurahanid";?>',
														'<?php echo"$kec";?>',
														'<?php echo"$kab";?>')"><?php echo"$nik";?></a></td>
			<td><?php echo"$nama";?></td>
			<td><?php echo"$umur";?></td>
			<td><?php echo"$qq[Jalan]";?></td>
	</tr>
<?php
	}
 echo"</tbody>
	</table>
	</div>
</form>";
?>
</body>