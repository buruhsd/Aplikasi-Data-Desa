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
echo"<form method='POST' action='media.php?mn=surat_keterangan_simpan' onSubmit='return cekkosong(this);'>";
echo"<table class='table'>";
// $tahun 		=date("Y");
	// $bulan 		=date("m");
	// $nomor = mysql_query ("SELECT MAX(SUBSTR(no_surat,6,4)) as no_surat FROM tblskumum");
	// $no 	= mysql_fetch_assoc($nomor);
	// $kode 		= $no['no_surat'];
	// $kode++;
	// $no_surat 	= sprintf("KTRG/%04s",$kode)."/".$bulan."/".$tahun;
echo"<tr>
    <td>No Surat </td>
	<td><div class='col-md-5'><input type='text' name='no_surat' id='no_surat' class='form-control' required></div></td>
	</tr>
  <tr>
    <td>Tanggal Mulai</td><td><div class='col-md-10'> 
	<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd'>
                    <input class='form-control' type='text' value='' placeholder='Tanggal Berlaku' required>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2' value='' name='tanggal_mulai'></div></td></tr>
  <tr>
    <td>Tanggal Berakhir</td>
    <td><div class='col-md-10'> 
	<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input3' data-link-format='yyyy-mm-dd'>
                    <input class='form-control' size='16' type='text' value='' placeholder='Tanggal Berakhir' required>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input3' value='' name='tanggal_akhir'></div></td></tr>
  <tr>
    <th colspan='2'><b>Pemohon :</b></th>
  </tr>
  <tr>
    <td>NIK</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='nik' id='Nik' class='form-control' required>
	<span class='input-group-btn'>
	<a href='javascript:void(0)' onClick='open_win()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
  <tr>
    <td>Nama</td><td><div class='col-md-5'>
    <input type='text' name='nama' id='Nama' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Nomor KK </td>
    <td><div class='col-md-5'>
    <input type='text' name='no_kk' id='No_kk' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Tempat Lahir </td><td><div class='col-md-4'>
    <input type='text' name='tempat_lahir' id='Tempat_lahir' class='form-control'/></div>
  </tr>
  <tr><td>Tanggal Lahir</td>
	<td><div class='col-md-4'>
    <input type='text' name='tgl_lahir' id='Tgl_lahir' class='form-control'/></div></td>
	</tr>
  <tr>
    <td>Jenis Kelamin </td>
    <td><div class='col-md-4'>
    <input type='text' name='jkel' id='Jkel' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Pekerjaan</td>
    <td><div class='col-md-5'>
    <input type='text' name='pekerjaan' id='Pekerjaan' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Kewarganegaraan</td>
    <td><div class='col-md-4'>
    <input type='text' name='kewarganegaraan' id='Kewarganegaraan' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Agama</td>
    <td><div class='col-md-4'>
    <input type='text' name='agama' id='Agama' class='form-control'/></div></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td><div class='col-md-7'>
    <input type='text' name='alamat' id='Alamat' class='form-control'/></div></td>
  </tr>
  <tr>
  <tr><td>Desa/Kelurahan</td><td><div class='col-md-4'>
			<input type='text' name='kelurahan' id='Kelurahan' class='form-control'/>
			<input type='hidden' name='kelurahanid' id='KelurahanID' class='form-control'/></div></td></tr>
      <tr><td>Kecamatan</td><td><div class='col-md-3'>
			<input type='text' name='kec' id='Kec' class='form-control'/></div></td></tr>
      <tr><td>Kabupaten/Kota</td><td><div class='col-md-3'>
			<input type='text' name='kab' id='Kab' class='form-control'/></div></td></tr>
  <tr>
    <td>Keperluan</td>
    <td><div class='col-md-5'>
      <textarea name='keperluan' rows='3' cols='38' required></textarea></div>
    </td>
  </tr>
  <tr>
    <td>Keterangan Lain</td>
    <td><div class='col-md-5'>
      <textarea name='keterangan_lain' rows='3' cols='38' required></textarea>
    </td></tr>
	<tr><td>Tanda Tangan Kelurahan</td><td><div class='col-md-4'><select name='tanda_tangan' id='tanda_tangan' class='form-control'>
							<option value='Kepala Desa'>Kepala Desa</option>
							<option value='Sekretaris Desa'>Sekretaris Desa</option>
	</div></select></td></tr>";
	      echo"<tr><td colspan='2'>
				<p align='center'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Simpan Dan Cetak</button>
				<button type='reset' class='btn btn-primary'>
					<i class='fa fa-fw fa-repeat'></i>Batal</button></p></td></tr>";
	
	echo"</thead></table>";
				echo"</form>";
					echo"</div></div>";
?>