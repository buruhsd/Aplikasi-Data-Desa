<script>
function open_win() {
window.open( "menu/list_KK.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win1() {
window.open( "menu/list_ibu.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win2() {
window.open( "menu/list_KK2.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win3() {
window.open( "menu/list_KK3.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win4() {
window.open( "menu/list_KK4.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win5() {
window.open( "menu/list_ayah.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
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
                                    <h3 class="box-title">Surat Keterangan Nikah</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=input_data_kelahiran_simpan' onSubmit='return cekkosong(this);'>";
echo"<table class='table'>";
echo"<tr><td>NIK</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='no_kk' id='NoKK' class='form-control' required >
	<span class='input-group-btn'>
	<a href='javascript:void(0)' onClick='open_win()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
	<tr>
					<td>Nama Kepala Keluarga</td>
					<td><div class='col-md-5'><input type='text' name='NamaKepalaKeluarga' class='form-control'></div></td>
				</tr>
				<tr>
					<td>Alamat Asal</td>
					<td><div class='col-md-5'><textarea name='JalanLama' cols='23' rows='3'></textarea></div></td>
				</tr>
				<tr>
				<tr><td>RT / RW</td><td><div class='col-md-2'><input type='text' name='rt' id='rt' required class='form-control' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class='col-md-2'><input type='text' name='rw' id='rw' placeholder='RW' class='form-control' required onKeyPress='return numbersonly(this, event)'></div></td>
				</tr>
				<tr><td>Desa/Kelurahan Asal</td><td><div class='col-md-5'>
			<input type='text' name='kelurahan_ibu' id='KelurahanIbu' class='form-control'/></div></td></tr>
      <tr><td>Kecamatan Asal</td><td><div class='col-md-5'>
			<input type='text' name='kec_ibu' id='KecIbu' class='form-control'/></div></td></tr>
      <tr><td>Kabupaten/Kota Asal</td><td><div class='col-md-5'>
			<input type='text' name='kab_ibu' id='KabIbu' class='form-control'/></div></td></tr>
      <tr><td>Provinsi Asal</td><td><div class='col-md-5'>
			<input type='text' name='prov_ibu' class='form-control' id='ProvIbu'/></div></td></tr>
				<tr>
					<td>Kode Pos Asal</td>
					<td><div class='col-md-5'><input type='text' name='KodePosLama'></div></td>
				</tr>
				<tr>
					<td>No. KK</td>
				  <td><div class='col-md-5'><input type='text' name='NoKK'></div></td>
				</tr>
				<tr>
					<td>Alasan Pindah</td>
					<td><div class='col-md-5'><input type='text' name='NoKK'></div></td>
				</tr>
				<tr>
					<td>Alamat Tujuan</td><td><div class='col-md-5'>
					<td><textarea cols='23' rows='3' name='Jalan'></textarea></td>
				</tr>
				<tr><td>RT / RW Tujuan</td><td><div class='col-md-2'><input type='text' name='rt' id='rt' required class='form-control' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class='col-md-2'><input type='text' name='rw' id='rw' placeholder='RW' class='form-control' required onKeyPress='return numbersonly(this, event)'></div></td>
				</tr>
				<tr><td>Desa/Kelurahan Tujuan</td><td><div class='col-md-5'>
			<input type='text' name='kelurahan_ibu' id='KelurahanIbu' class='form-control'/></div></td></tr>
      <tr><td>Kecamatan Tujuan</td><td><div class='col-md-5'>
			<input type='text' name='kec_ibu' id='KecIbu' class='form-control'/></div></td></tr>
      <tr><td>Kabupaten/Kota Tujuan</td><td><div class='col-md-5'>
			<input type='text' name='kab_ibu' id='KabIbu' class='form-control'/></div></td></tr>
      <tr><td>Provinsi Tujuan/td><td><div class='col-md-5'>
			<input type='text' name='prov_ibu' class='form-control' id='ProvIbu'/></div></td></tr>
				<td>Kode Pos Tujuan</td>
					<td><div class='col-md-5'><input type='text' name='KodePosLama'></div></td>
				</tr>
		<td colspan="2">
			<table>
				<tr>
					<td>Klasifikasi Pindah</td>
					<td width="1%">:</td>
					<td><?=selectKlasifikasiPindah("KlasifikasiPindahID");?></td>
				</tr>
				<tr>
					<td>Jenis Kepindahan</td>
					<td width="1%">:</td>
					<td><?=selectJenisKepindahan("JenisKepindahanID");?></td>
				</tr>
				<tr>
					<td>Status No. KK <br> Bagi yang tidak pindah</td>
					<td width="1%">:</td>
					<td><?=selectStatusKK("StatusKKIDTidakPindah");?></td>
				</tr>
				<tr>
					<td>Status No. KK <br> Bagi yang pindah</td>
					<td width="1%">:</td>
					<td><?=selectStatusKK("StatusKKIDPindah");?></td>
				</tr>
				<tr>
					<td>Rencana Tanggal Pindah</td>
					<td width="1%">:</td>
					<td><input type="text" name="TanggalPindah" id="TanggalPindah" size="10">
						<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.mutasi_pindah_input.TanggalPindah);return false;" ><img name="popcal" align="absmiddle" src="WeekPicker/calbtn.gif" width="34" height="22" border="0" alt=""></a>
						<i>dd-mm-yyyy</i>
					</td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table width="100%">
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2"><div align="center"><input type="submit" name="Submit" value="Simpan"></div></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>