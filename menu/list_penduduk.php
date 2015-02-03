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
			
// kelamin lahir kelamin1 lahir
	function pilih(nama,lahir,kelamin,kelamin1,tempat,tempat1,ktp){
		self.opener.document.forms[0].Nama.value=nama;
		self.opener.document.forms[0].Lahir.value=lahir;
        self.opener.document.forms[0].Kelamin.value=kelamin;
        self.opener.document.forms[0].Kelamin1.value=kelamin1;
        self.opener.document.forms[0].Tempat.value=tempat;
        self.opener.document.forms[0].Tempat1.value=tempat1;
        self.opener.document.forms[0].KTP.value=ktp;
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
											  <th>NIK</th>
											  <th>Nama Lengkap</th>
											  <th>Umur</th>
											  <th>Alamat</th>
											  </tr>
											</thead>
											<tbody>
  <?php 
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
    $kab    =mysql_query("SELECT SUBSTR(NamaKabKota,5,25)as NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$qq[KabupatenID]'");
    $b      =mysql_fetch_array($kab);
$nama 		 =$qq['NamaLengkap'];
$nokk        =$qq['NoKK'];
$ktp		 =$qq['NoIdentitas'];
$lahir		 =$qq['TanggalLahir'];
$umur 		 =hitUmur($lahir);
$kelamin=$qq['JenisKelamin'];
if($qq['JenisKelamin'] == 0){
$kelamin1     ="Laki-Laki";
}else{
$kelamin1    ="Perempuan";
}
$tempat1    =$b['NamaKabKota'];
$tempat     =$b['KabKotaID'];

?>
	<tr><td><?php echo"$no";?></td>
			<td><a href="#" onClick="javascript:pilih('<?php echo"$nama";?>',
														'<?php echo"$lahir";?>',
                                                        '<?php echo"$kelamin";?>',
                                                        '<?php echo"$kelamin1";?>',
                                                        '<?php echo"$tempat";?>',
                                                        '<?php echo"$tempat1";?>',
                                                        '<?php echo"$ktp";?>')"><?php echo"$ktp";?></a></td>
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