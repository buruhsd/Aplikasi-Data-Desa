 <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- jQuery 2.0.2 -->
        <script src="../js/jqueryv2.0.0.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<?php
include "../library/koneksi.php";
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
	function pilih(nama,nik,tgl,umur,pekerjaan,alamat,kelurahan){
		self.opener.document.forms[0].NikAyah.value=nik;
		self.opener.document.forms[0].NamaAyah.value=nama;
		self.opener.document.forms[0].tglAyah.value=tgl;
		self.opener.document.forms[0].UmurAyah.value=umur;
		self.opener.document.forms[0].PekerjaanAyah.value=pekerjaan;
		self.opener.document.forms[0].AlamatAyah.value=alamat;
		self.opener.document.forms[0].KelurahanAyah.value=kelurahan;
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
  //Umur
	function hitUmur($tgllahir) {
        $tgl = explode("-", $tgllahir);
        $umur = date("Y") - $tgl[0];  //ini untuk ngitung umurnya
        if(($tgl[1] > date("m")) || ($tgl[1] == date("m") && date("d") < $tgl[2])) //ngecek apakah tgl lahir dan bulannya belum lewat?
        {
            $umur -= 1;
        }
        return $umur;
		} 
  $sql = "select * from tblpenduduk where JenisKelamin='0' ORDER BY NoKK DESC"; 
	$q = mysql_query($sql); $no=0; while($qq=mysql_fetch_array($q)) { $no++; 
$prov=mysql_query("SELECT NamaProvinsi from tblprovinsi where ProvinsiID='$qq[ProvinsiID]'");
		$p=mysql_fetch_array($prov);
		$kab=mysql_query("SELECT NamaKabKota from tblkabkota where KabKotaID='$qq[KabupatenID]'");
		$b=mysql_fetch_array($kab);
		$kec=mysql_query("SELECT NamaKecamatan from tblkecamatan where KecamatanID='$qq[KecamatanID]'");
		$c=mysql_fetch_array($kec);
		$kel=mysql_query("SELECT NamaKelurahan from tblkelurahan where KelurahanID='$qq[KelurahanID]'");
		$l=mysql_fetch_array($kel);
		$ngr=mysql_query("SELECT NamaNegara from tblnegara where NegaraID='$qq[NegaraID]'");
		$n=mysql_fetch_array($ngr);
		$kerja =mysql_query("SELECT NamaPekerjaan FROM tblpekerjaan where PekerjaanID='$qq[Pekerjaan]'");
		$krj   =mysql_fetch_array($kerja);
$nama		 =$qq['NamaLengkap'];
$nokk 		 =$qq['NoKK'];
$nik		 =$qq['NoIdentitas'];
$tgl		 =$qq['TanggalLahir'];
$pekerjaan	 =$krj['NamaPekerjaan'];
$alamat		 =$qq['Jalan'];
$rt			 =$qq['RT'];
$rw			 =$qq['RW'];
$kelurahan 	 =$l['NamaKelurahan'];
$kec		 =$c['NamaKecamatan'];
$kab		 =$b['NamaKabKota'];
$prov		 =$p['NamaProvinsi'];
$warga	 	 =$n['NamaNegara'];
$umur 		 =hitUmur($tgl);
?>
	<tr><td><?php echo"$no";?></td>
			<td><?php echo"$nokk";?></td>
			<td><a href="#" onClick="javascript:pilih('<?php echo"$nama";?>',
														'<?php echo"$nik";?>',
														'<?php echo"$tgl";?>',
														'<?php echo"$umur";?>',
														'<?php echo"$pekerjaan";?>',
														'<?php echo"$alamat";?>',
														'<?php echo"$kelurahan";?>')"><?php echo"$nik";?></a></td>
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