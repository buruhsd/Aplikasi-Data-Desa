<script>
function open_win() {
window.open( "menu/list_KTP.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
</script>
<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
	
include "library/koneksi.php";
$id = $_GET['id'];
?>
  <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Surat Permohonan KTP</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
$data_ktp =mysql_query("SELECT
						tblpermohonanktp.no_pengajuan,
						tblpermohonanktp.NIK,
						tblpermohonanktp.Permohonan,
						tblpermohonanktp.tanda_tangan,
						tblpermohonanktp.NamaAparat,
						tblpenduduk.Jalan,
						tblpenduduk.NoKK,
						tblpenduduk.NamaLengkap,
						tblpenduduk.KodePos,
						tblpenduduk.KelurahanID,
						tblpenduduk.KecamatanID,
						tblpenduduk.KabupatenID,
						tblpenduduk.ProvinsiID,
						tblpenduduk.RW,
						tblpenduduk.RT
						FROM
						tblpermohonanktp
						LEFT JOIN tblpenduduk ON tblpenduduk.NoIdentitas = tblpermohonanktp.NIK WHERE tblpermohonanktp.NIK='$id'");
$ktp 	= mysql_fetch_assoc($data_ktp);
		$prov=mysql_query("SELECT NamaProvinsi,ProvinsiID from tblprovinsi where ProvinsiID='$ktp[ProvinsiID]'");
		$p=mysql_fetch_array($prov);
		$kab=mysql_query("SELECT NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$ktp[KabupatenID]'");
		$b=mysql_fetch_array($kab);
		$kec=mysql_query("SELECT NamaKecamatan,KecamatanID from tblkecamatan where KecamatanID='$ktp[KecamatanID]'");
		$c=mysql_fetch_array($kec);
		$kel=mysql_query("SELECT NamaKelurahan,KelurahanID from tblkelurahan where KelurahanID='$ktp[KelurahanID]'");
		$l=mysql_fetch_array($kel);

echo"<form method='POST' action='media.php?mn=permohonan_ktp_update' onSubmit='return cekkosong(this);'>";
echo"<table class='table'>";
echo"<input type=hidden name='id' value='$ktp[NIK]'>";
echo"<tr><td>No Pengajuan KTP</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='no_ktp' id='no_ktp' value='$ktp[no_pengajuan]' class='form-control' required></div></td></tr>
	<tr>";
echo"<tr>
        <td>Permohonan KTP</td>
        <td colspan='2'><div class='col-lg-10'>";
  if ($ktp['Permohonan']=='Baru'){
    echo "<input type='radio' name='permohonanKTP' value='Baru' checked/> A. Baru 
        <input type='radio' name='permohonanKTP' value='Perpanjangan' /> B. Perpanjangan 
		<input type='radio' name='permohonanKTP' value='Penggantian' /> C. Penggantian 		</div></td>
        </tr>";
  }
  elseif ($ktp['Permohonan']=='Perpanjangan'){
    echo "<input type='radio' name='permohonanKTP' value='Baru'/> A. Baru 
        <input type='radio' name='permohonanKTP' value='Perpanjangan' checked/> B. Perpanjangan 
		<input type='radio' name='permohonanKTP' value='Penggantian' /> C. Penggantian 		</div></td>
        </tr>";
  }
  else{
    echo "<input type='radio' name='permohonanKTP' value='Baru'/> A. Baru 
        <input type='radio' name='permohonanKTP' value='Perpanjangan'/> B. Perpanjangan 
		<input type='radio' name='permohonanKTP' value='Penggantian' checked/> C. Penggantian 		</div></td>
        </tr>";
  }

echo"<tr><td>NIK</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='NIK' id='NIK' value='$ktp[NIK]' class='form-control' required >
	<span class='input-group-btn'>
	<a href='javascript:void(0)' onClick='open_win()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
	<tr>";
echo"<tr><td>Nama Lengkap</td><td><div class='col-lg-5'>
		<input name='NamaLengkap' type='text' id='NamaLengkap' value='$ktp[NamaLengkap]' readonly='true' class='form-control'/></div></td></tr>";
echo"<tr><td>Nomor KK </td><td><div class='col-lg-5'>
		<input name='NoKK' type='text' id='NoKK' readonly='true' value='$ktp[NoKK]' class='form-control'/></div></td></tr>";
echo"<tr><td>RT / RW</td><td><div class='col-lg-2'>
		<input name='RT' type='text' id='RT' readonly='true' value='$ktp[RT]' class='form-control' /></div>
          <div class='col-lg-2'><input name='RW' type='text' id='RW' value='$ktp[RW]' readonly='true' class='form-control' /></div></td></tr>
	<tr><td>Kode Pos</td><td><div class='col-lg-2'>
		<input name='KodePos' type='text' id='KodePos' value='$ktp[KodePos]' readonly='true' class='form-control' /></td></tr>";
echo"<tr><td>Alamat</td><td><div class='col-lg-6'>
		<input name='Alamat' type='text' id='Alamat' value='$ktp[Jalan]' readonly='true' class='form-control'/></td></tr>";
echo" <tr><td>Provinsi</td><td><div class='col-md-3'>
			<input type='text' name='ProvID' readonly='true' value='$ktp[ProvinsiID]' class='form-control' id='ProvID'/></div>
		<div class='col-md-4'>
			<input type='text' name='Prov' readonly='true' value='$p[NamaProvinsi]' class='form-control' id='Prov'/></div></td></tr>
	<tr><td>Kabupaten/Kota</td><td><div class='col-md-3'>
			<input type='text' name='KabID' id='KabID' value='$ktp[KabupatenID]' readonly='true' class='form-control'/></div>
			<div class='col-md-4'>
			<input type='text' name='Kab' id='Kab' value='$b[NamaKabKota]' readonly='true' class='form-control'/></div></td></tr>
	 <tr><td>Kecamatan</td><td><div class='col-md-3'>
			<input type='text' name='KecID' id='KecID' value='$ktp[KecamatanID]' readonly='true' class='form-control'/></div>
			<div class='col-md-4'>
			<input type='text' name='Kec' id='Kec' value='$c[NamaKecamatan]' readonly='true' class='form-control'/></div></td></tr>
     <tr><td>Desa/Kelurahan</td><td><div class='col-md-3'>
			<input type='text' name='KelurahanID' value='$ktp[KelurahanID]' id='KelurahanID' readonly='true' class='form-control'/></div>
			<div class='col-md-4'>
			<input type='text' name='Kelurahan' value='$l[NamaKelurahan]' id='Kelurahan' readonly='true' class='form-control'/></div></td></tr>
	<tr><td>Tanda Tangan Kelurahan</td><td><div class='col-md-3'><select name='tanda_tangan' id='tanda_tangan' class='form-control'>
							<option value='$ktp[tanda_tangan]'>$ktp[tanda_tangan]</option>
							<option value='Kepala Desa'>Kepala Desa</option>
							<option value='Sekretaris Desa'>Sekretaris Desa</option>
	</div></select></td></tr>";
echo"</thead></table>";
echo"<table class='table'>";
echo"<tr><td><p align='right'><button type='submit' name='cetak' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Update</button></p></td>";
echo"</form>";
echo"<td><form method='POST' action='media.php?mn=permohonan_ktp_data' class='form-horizontal'>";
		echo"<button type='submit' class='btn btn-primary'><i class='fa fa-fw fa-repeat'></i>Batal</button>";
		echo"</form></td></tr>";
		echo"</table>";
				
					echo"</div></div>";
?>