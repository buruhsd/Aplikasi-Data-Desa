<script>
function open_win() {
window.open( "menu/list_Keterangan.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
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
$id= $_GET['id'];
?>
  <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Surat Keterangan</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
$data = mysql_query ("SELECT
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
							tblagama.NamaAgama,
							tblskumum.id,
							tblskumum.tanggal_awal,
							tblskumum.tanggal_akhir,
							tblskumum.no_surat,
							tblskumum.keperluan,
							tblskumum.keterangan_lain,
							tblskumum.tanda_tangan
							FROM
							tblpekerjaan
							LEFT JOIN tblpenduduk ON tblpekerjaan.PekerjaanID = tblpenduduk.Pekerjaan
							LEFT JOIN tblkabkota ON tblpenduduk.TempatLahir = tblkabkota.KabKotaID
							LEFT JOIN tblnegara ON tblnegara.NegaraID = tblpenduduk.NegaraID
							LEFT JOIN tblagama ON tblagama.AgamaID = tblpenduduk.Agama
							LEFT JOIN tblskumum ON tblskumum.nik = tblpenduduk.NoIdentitas
							WHERE tblskumum.id='$id'
							ORDER BY tblpenduduk.TanggalLahir DESC");
		$dt = mysql_fetch_array ($data);
		$prov=mysql_query("SELECT NamaProvinsi,ProvinsiID from tblprovinsi where ProvinsiID='$dt[ProvinsiID]'");
		$p=mysql_fetch_array($prov);
		$kab=mysql_query("SELECT NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$dt[KabupatenID]'");
		$b=mysql_fetch_array($kab);
		$kec=mysql_query("SELECT NamaKecamatan,KecamatanID from tblkecamatan where KecamatanID='$dt[KecamatanID]'");
		$c=mysql_fetch_array($kec);
		$kel=mysql_query("SELECT NamaKelurahan,KelurahanID from tblkelurahan where KelurahanID='$dt[KelurahanID]'");
		$l=mysql_fetch_array($kel);
echo"<form method='POST' action='media.php?mn=surat_keterangan_update' onSubmit='return cekkosong(this);'>";
echo"<table class='table'>";
echo"<input type='hidden' name='id' id='id' value='$dt[id]' class='form-control' required>";
echo"<tr>
    <td>No Surat </td>
	<td><div class='col-md-5'>
	<input type='text' name='no_surat' id='no_surat' value='$dt[no_surat]' class='form-control' required></div></td>
	</tr>
  <tr>
    <td>Tanggal Mulai</td><td><div class='col-md-10'> 
	<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd'>
                    <input class='form-control' size='16' type='text' value='$dt[tanggal_awal]' placeholder='Tanggal Berlaku Mulai' required>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2' value='$dt[tanggal_awal]' name='tanggal_mulai'></div></td></tr>
  <tr>
    <td>Tanggal Berakhir</td>
    <td><div class='col-md-10'> 
	<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input3' data-link-format='yyyy-mm-dd'>
                    <input class='form-control' size='16' type='text' value='$dt[tanggal_akhir]' placeholder='Tanggal Berakhir' required>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input3' value='$dt[tanggal_akhir]' name='tanggal_akhir'></div></td></tr>
  <tr>
    <th colspan='2'><b>Pemohon :</b></th>
  </tr>
  <tr>
    <td>NIK</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='nik' id='Nik' value='$dt[NoIdentitas]' class='form-control' required>
	<span class='input-group-btn'>
	<a href='javascript:void(0)' onClick='open_win()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
  <tr>
    <td>Nama</td><td><div class='col-md-5'>
    <input type='text' name='nama' id='Nama' value='$dt[NamaLengkap]' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Nomor KK </td>
    <td><div class='col-md-5'>
    <input type='text' name='no_kk' id='No_kk' value='$dt[NoKK]' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Tempat Lahir </td><td><div class='col-md-4'>
    <input type='text' name='tempat_lahir' id='Tempat_lahir' value='$dt[NamaKabKota]' class='form-control'/></div>
  </tr>
  <tr><td>Tanggal Lahir</td>
	<td><div class='col-md-4'>
    <input type='text' name='tgl_lahir' id='Tgl_lahir' value='$dt[TanggalLahir]' class='form-control'/></div></td>
	</tr>
  <tr>
    <td>Jenis Kelamin </td>
    <td><div class='col-md-4'>";
	if($dt['JenisKelamin'] == 0){
	echo" <input type='text' name='jkel' id='Jkel' value='Laki-Laki' class='form-control'/>";
	}else{
	echo" <input type='text' name='jkel' id='Jkel' value='Perempuan' class='form-control'/>";
		}
   echo"</div></td>
  </tr>
  <tr>
    <td>Pekerjaan</td>
    <td><div class='col-md-5'>
    <input type='text' name='pekerjaan' id='Pekerjaan' value='$dt[NamaPekerjaan]' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Kewarganegaraan</td>
    <td><div class='col-md-4'>
    <input type='text' name='kewarganegaraan' id='Kewarganegaraan' value='$dt[NamaNegara]' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Agama</td>
    <td><div class='col-md-4'>
    <input type='text' name='agama' id='Agama' value='$dt[NamaAgama]' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td><div class='col-md-7'>
    <input type='text' name='alamat' id='Alamat' value='$dt[Jalan]' class='form-control'/></div></td>
  </tr>
  <tr>
  <tr><td>Desa/Kelurahan</td><td><div class='col-md-4'>
			<input type='text' name='kelurahan' id='Kelurahan' value='$l[NamaKelurahan]' class='form-control'/>
			<input type='hidden' name='kelurahanid' id='KelurahanID' value='$l[KelurahanID]' class='form-control'/></div></td></tr>
      <tr><td>Kecamatan</td><td><div class='col-md-4'>
			<input type='text' name='kec' id='Kec' class='form-control' value='$c[NamaKecamatan]'/></div></td></tr>
      <tr><td>Kabupaten/Kota</td><td><div class='col-md-4'>
			<input type='text' name='kab' id='Kab' class='form-control' value='$b[NamaKabKota]'/></div></td></tr>
  <tr>
    <td>Keperluan</td>
    <td><div class='col-md-5'>
      <textarea name='keperluan' rows='3' cols='38' required>$dt[keperluan]</textarea></div>
    </td>
  </tr>
  <tr>
    <td>Keterangan Lain</td>
    <td><div class='col-md-5'>
      <textarea name='keterangan_lain' rows='3' cols='38' required>$dt[keterangan_lain]</textarea>
    </td></tr>
	<tr><td>Tanda Tangan Kelurahan</td><td><div class='col-md-4'><select name='tanda_tangan' id='tanda_tangan' class='form-control'>
							<option value='$dt[tanda_tangan]'>$dt[tanda_tangan]</option>
							<option value='Kepala Desa'>Kepala Desa</option>
							<option value='Sekretaris Desa'>Sekretaris Desa</option>
	</div></select></td></tr>";
     echo"</thead></table>";
echo"<table class='table'>";
echo"<tr><td><p align='right'><button type='submit' name='cetak' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Update</button></p></td>";
echo"</form>";
echo"<td><form method='POST' action='media.php?mn=surat_keterangan' class='form-horizontal'>";
    echo"<button type='submit' class='btn btn-primary'><i class='fa fa-fw fa-repeat'></i>Batal</button>";
    echo"</form></td></tr>";
    echo"</table>";
          echo"</div></div>";
?>