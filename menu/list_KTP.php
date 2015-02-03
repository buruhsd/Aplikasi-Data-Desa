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
//Data Tables
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
	function pilih(nama,nik,nokk,rt,rw,kodepos,alamat,provid,prov,kabid,kab,kecid,kec,kelurahanid,kelurahan){
		self.opener.document.forms[0].NamaLengkap.value=nama;
		self.opener.document.forms[0].NIK.value=nik;
		self.opener.document.forms[0].NoKK.value=nokk;
		self.opener.document.forms[0].RT.value=rt;
		self.opener.document.forms[0].RW.value=rw;
		self.opener.document.forms[0].KodePos.value=kodepos;
		self.opener.document.forms[0].Alamat.value=alamat;
		self.opener.document.forms[0].ProvID.value=provid;
		self.opener.document.forms[0].Prov.value=prov;
		self.opener.document.forms[0].KabID.value=kabid;
		self.opener.document.forms[0].Kab.value=kab;
		self.opener.document.forms[0].KecID.value=kecid;
		self.opener.document.forms[0].Kec.value=kec;
		self.opener.document.forms[0].KelurahanID.value=kelurahanid;
		self.opener.document.forms[0].Kelurahan.value=kelurahan;
		
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
  $sql = "select * from tblpenduduk ORDER BY TanggalLahir DESC"; 
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
$rt			 =$qq['RT'];
$rw			 =$qq['RW'];
$kodepos 	 =$qq['KodePos'];
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
$umur 		 =hitUmur($tgl);
?>
	<tr><td><?php echo"$no"; ?></td>
			<td><?php echo"$nokk";?></td>
			<td><a href="#" onClick="javascript:pilih('<?php echo"$nama";?>',
														'<?php echo"$nik";?>',
														'<?php echo"$nokk";?>',
														'<?php echo"$rt";?>',
														'<?php echo"$rw";?>',
														'<?php echo"$kodepos";?>',
														'<?php echo"$alamat";?>',
														'<?php echo"$provid";?>',
														'<?php echo"$prov";?>',
														'<?php echo"$kabid";?>',
														'<?php echo"$kab";?>',
														'<?php echo"$kecid";?>',
														'<?php echo"$kec";?>',
														'<?php echo"$kelurahanid";?>',
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