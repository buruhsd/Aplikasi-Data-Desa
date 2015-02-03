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
</script>
<?php 
include "../library/koneksi.php";

echo"<script language='javascript' src='../library/ajax.js'></script>
		<form>
		<font face='verdana' size='2'>Pencarian Nama Menu&nbsp&nbsp: </font><input type='text' name='searching' id='searching' size='25' onkeyup='ktp(searching.value)' />
	</form>";
	echo"<div id='pencarian'></div>";
//$q=$_GET["q"];
  $no=1;
  $data_ktp = mysql_query("SELECT
							tblpermohonanktp.NIK,
							tblpermohonanktp.Permohonan,
							tblpermohonanktp.tanda_tangan,
							tblpermohonanktp.NamaAparat,
							tblpenduduk.Jalan,
							tblpenduduk.NoKK,
							tblpenduduk.NamaLengkap
							FROM
							tblpermohonanktp
							LEFT JOIN tblpenduduk ON tblpenduduk.NoIdentitas = tblpermohonanktp.NIK
							where tblpermohonanktp.TanggalPermohonan like '%2014%' 
							ORDER BY TanggalPermohonan DESC");
	
?>
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
											  <th>No</th>
											  <th>Nama Lengkap</th>
											  <th>Nomor KK</th>
											  <th>NIK</th>
											  <th>Alamat</th>
											  <th>Keterangan</th>
											  <th>Yang Bertanda Tangan</th>
											  <th>Aksi</th>
											  </tr>
											</thead>
											<tbody>
<?php
  while ($ktp=mysql_fetch_array($data_ktp))
  {
    echo"<tr>
          <td>$no</td>
          <td>".strtoupper($ktp['NamaLengkap'])."</td>
		  <td>".$ktp['NoKK']."</td>
		  <td>".$ktp['NIK']."</td>
		  <td>".$ktp['Jalan']."</td>
		  <td>".$ktp['Permohonan']."</td>
		  <td>".$ktp['tanda_tangan']."</td>
          <td>
          <div class='btn-group'>
      <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
      <span class='glyphicon glyphicon-cog'> Pilih
          <span class='caret'></span>
        </button>
        <ul class='dropdown-menu'>
        <li><a href=Print/surat_permohonan_ktp.php?id=$ktp[NIK] target='_blank'><span class='glyphicon glyphicon-print'> Cetak</span></a></li>
		<li><a href=?mn=permohonan_ktp_edit&id=$ktp[NIK]><span class='glyphicon glyphicon-pencil'> Edit</span></a></li>
      <li><a href=?mn=permohonan_ktp_hapus&id=$ktp[NIK] onclick=\"return confirm('apakah akan menghapus data KTP  $ktp[NamaLengkap]')\"><span class='glyphicon glyphicon-trash'> Delete</span></a></li>
      </div></td>
      </tr>";
      $no++;
  } 
  echo"</tbody>
      </table>";
	  ?>