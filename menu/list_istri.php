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
	function pilih(nama,nik,tempatlahir,tgl,umur){
		self.opener.document.forms[0].NoIdentitasCalonIstri.value=nik;
		self.opener.document.forms[0].NamaCalonIstri.value=nama;
		self.opener.document.forms[0].TempatLahirCalonIstri.value=tempatlahir;
		self.opener.document.forms[0].TanggalLahirCalonIstri.value=tgl;
		self.opener.document.forms[0].UmurCalonIstri.value=umur;
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
  $sql = "select * from tblpenduduk where JenisKelamin='1' ORDER BY NoKK DESC"; 
	$q = mysql_query($sql); $no=0; while($qq=mysql_fetch_array($q)) { $no++; 
		$kab=mysql_query("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota from tblkabkota where KabKotaID='$qq[TempatLahir]'");
		$b=mysql_fetch_array($kab);
		$kerja =mysql_query("SELECT NamaPekerjaan FROM tblpekerjaan where PekerjaanID='$qq[Pekerjaan]'");
		$krj   =mysql_fetch_array($kerja);
$nama		 =$qq['NamaLengkap'];
$nokk 		 =$qq['NoKK'];
$nik		 =$qq['NoIdentitas'];
$tgl		 =$qq['TanggalLahir'];
$pekerjaan	 =$krj['NamaPekerjaan'];
$tempatlahir =$b['NamaKabKota'];
$umur 		 =umur($tgl);
?>
	<tr><td><?php echo"$no";?></td>
			<td><?php echo"$nokk";?></td>
			<td><a href="#" onClick="javascript:pilih('<?php echo"$nama";?>',
														'<?php echo"$nik";?>',
														'<?php echo"$tempatlahir";?>',
														'<?php echo"$tgl";?>',
														'<?php echo"$umur";?>')"><?php echo"$nik";?></a></td>
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