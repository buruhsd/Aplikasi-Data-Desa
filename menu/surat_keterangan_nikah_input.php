<script>
function open_win() {
window.open( "menu/list_suami.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win1() {
window.open( "menu/list_istri.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
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
echo"<form method='POST' action='media.php?mn=surat_keterangan_nikah_simpan' onSubmit='return cekkosong(this);'>";
echo"<table class='table'>";
echo"<tr><td>No Surat Nikah </td><td><div class='col-md-3'>
				<input type='text' name='no_surat_nikah' class='form-control' required/>
				</div></td></tr>
				<tr><td colspan='2'><b>CALON SUAMI</b></td>
				</tr>
				<tr>
				<tr><td>No Identitas</td><td><div class='col-md-5'>
				<div class='input-group'><input type=text name='NoIdentitasCalonSuami' id='NoIdentitasCalonSuami' class='form-control' required >
				<span class='input-group-btn'>
				<a href='javascript:void(0)' onClick='open_win()'>
				<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
				</span>
					</div></div></td></tr>
				</tr>
				  <tr><td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='NamaCalonSuami' id='NamaCalonSuami' class='form-control'/>
				</div></td></tr>
				 <tr><td>Tempat Lahir </td><td><div class='col-md-6'>
				<input type='text' name='TempatLahirCalonSuami' id='TempatLahirCalonSuami' class='form-control'/>
				</div></td></tr>
			   <tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
						<input type='text' name='TanggalLahirCalonSuami' id='TanggalLahirCalonSuami' class='form-control'/>
				</div>
				<div class='col-md-2'>
						<input type='text' name='UmurCalonSuami' id='UmurCalonSuami' class='form-control'/>
				</div></td></tr>";
		echo"<tr><td>Pekerjaan</td><td><div class='col-md-5'>
						<select name='PekerjaanCalonSuami' id='PekerjaanCalonSuami' required class='selectpicker show-tick form-control' data-live-search='true' >
							<option value=''>::Pilih::</option>";
				$Pekerjaan = mysql_query("SELECT * from tblpekerjaan");
				while($pkj=mysql_fetch_array($Pekerjaan))
				{
					echo"<option value='$pkj[PekerjaanID]'>$pkj[NamaPekerjaan]</option>";
				}
			echo"</div></select></td></tr>";	
				echo"<tr><td>Agama</td><td><div class='col-md-5'>
			<select name='AgamaCalonSuami' id='AgamaCalonSuami' class='form-control' required>
			<option value=''>::Pilih::</option>";
			$agama = mysql_query("SELECT * from tblagama");
			while ($agm = mysql_fetch_array($agama))
			{
			echo"<option value='$agm[AgamaID]'>$agm[NamaAgama]</option>";	
			}
				echo"</div></select></td></tr>";
    echo"<tr><td>Alamat</td><td><div class='col-md-6'>
				<input type='text' name='JalanCalonSuami' id='JalanCalonSuami' class='form-control'/>
		</div></td></tr>
		<tr><td>RT / RW</td><td>
		<div class='col-md-2'>
		<input type='text' name='RTCalonSuami' id='RTCalonSuami' required class='form-control' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
		<div class='col-md-2'><input type='text' name='RWCalonSuami' id='RWCalonSuami' placeholder='RW' class='form-control' required onKeyPress='return numbersonly(this, event)'>
		</div></td></tr>";
		echo"<tr><td>Provinsi</td><td>
			 <div class='col-lg-5'>
			<select id='provinsi' name='ProvinsiCalonSuami' class='selectpicker show-tick form-control' data-live-search='true' required>
			<option value=''>Pilih Provinsi</option>";
			$provinsi1 = mysql_query("SELECT * from tblprovinsi");
			while ($prov1=mysql_fetch_array($provinsi1))
			{
				echo"<option value='$prov1[ProvinsiID]'>$prov1[NamaProvinsi]</option>";
			}
		echo"</select></div></td></tr>";
		echo"<tr><td>Kabupaten/Kota</td><td>
			 <div class='col-md-5'>
			<select id='kota' name='KabupatenCalonSuami' class='form-control'>
			<option value=''>Pilih Kab Kota</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kecamatan</td><td>
			 <div class='col-md-5'>
			<select id='kec' name='KecamatanCalonSuami' class='form-control'>
			<option value=''>Pilih Kecamatan</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kelurahan</td><td>
			 <div class='col-md-5'>
			<select id='kel' name='KelurahanCalonSuami' class='form-control'>
			<option value=''>Pilih Kelurahan</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kewarganegaraan</td><td><div class='col-md-5'>
				<select id='KewarganegaraanCalonSuami' name='KewarganegaraanCalonSuami' class='selectpicker show-tick form-control' data-live-search='true' required>
			<option value='INDONESIA'>INDONESIA</option>";
			$negara = mysql_query("SELECT NamaNegara FROM tblnegara");
			while ($ngr=mysql_fetch_array($negara))
			{
				echo"<option value='$ngr[NamaNegara]'>$ngr[NamaNegara]</option>";
			}
		echo"</select></div></td></tr>
				<tr>
					<td>Status Perkawinan</td>
					<td><div class='col-md-3'>
						<select name='StatusPerkawinanSuami' class='form-control'>
							<option value='Perjaka'>Perjaka</option>
							<option value='Duda'>Duda</option>
						</select>
					</div></td>
				</tr>";
				//Calon Istri
			echo"<tr>
					<td colspan='2'><b>CALON ISTRI</b></td>
				</tr>
				<tr><td>No Identitas</td><td><div class='col-md-5'>
				<div class='input-group'><input type=text name='NoIdentitasCalonIstri' id='NoIdentitasCalonIstri' class='form-control' required >
				<span class='input-group-btn'>
				<a href='javascript:void(0)' onClick='open_win1()'>
				<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
				</span>
					</div></div></td></tr>
				</tr>
				</tr>
				  <tr><td>Nama Lengkap </td><td><div class='col-md-3'>
				<input type='text' name='NamaCalonIstri' id='NamaCalonIstri' class='form-control'/>
				</div></td></tr>
				 <tr><td>Tempat Lahir </td><td><div class='col-md-6'>
				<input type='text' name='TempatLahirCalonIstri' id='TempatLahirCalonIstri' class='form-control'/>
				</div></td></tr>
			   <tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
						<input type='text' name='TanggalLahirCalonIstri' id='TanggalLahirCalonIstri' class='form-control'/>
				</div>
				<div class='col-md-2'>
						<input type='text' name='UmurCalonIstri' id='UmurCalonIstri' class='form-control'/>
				</div></td></tr>";
		echo"<tr><td>Pekerjaan</td><td><div class='col-md-5'>
						<select name='PekerjaanCalonIstri' id='PekerjaanCalonIstri' required class='selectpicker show-tick form-control' data-live-search='true' >
							<option value=''>::Pilih::</option>";
				$Pekerjaan = mysql_query("SELECT * from tblpekerjaan");
				while($pkj=mysql_fetch_array($Pekerjaan))
				{
					echo"<option value='$pkj[PekerjaanID]'>$pkj[NamaPekerjaan]</option>";
				}
			echo"</div></select></td></tr>";	
		echo"<tr><td>Agama</td><td><div class='col-md-5'>
						<select name='AgamaCalonIstri' id='AgamaCalonIstri' class='form-control' required>
							<option value=''>::Pilih::</option>";
			$agama = mysql_query("SELECT * from tblagama");
			while ($agm = mysql_fetch_array($agama))
			{
			echo"<option value='$agm[AgamaID]'>$agm[NamaAgama]</option>";	
			}
				echo"</div></select></td></tr>";
    echo"<tr><td>Alamat</td><td><div class='col-md-6'>
				<input type='text' name='JalanCalonIstri' id='JalanCalonIstri' class='form-control'/>
		</div></td></tr>
		<tr><td>RT / RW</td><td>
		<div class='col-md-2'>
		<input type='text' name='RTCalonIstri' id='RTCalonIstri' required class='form-control' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<div class='col-md-2'><input type='text' name='RWCalonIstri' id='RWCalonIstri' placeholder='RW' class='form-control' required onKeyPress='return numbersonly(this, event)'>
		</div></td></tr>";
		echo"<tr><td>Provinsi</td><td>
			 <div class='col-lg-5'>
			<select id='provinsi1' name='ProvinsiCalonIstri' class='selectpicker show-tick form-control' data-live-search='true' required>
			<option value=''>Pilih Provinsi</option>";
			$provinsi = mysql_query("SELECT * from tblprovinsi");
			while ($prov=mysql_fetch_array($provinsi))
			{
				echo"<option value='$prov[ProvinsiID]'>$prov[NamaProvinsi]</option>";
			}
		echo"</select></div></td></tr>";
		echo"<tr><td>Kabupaten/Kota</td><td>
			 <div class='col-md-5'>
			<select id='kota1' name='KabupatenCalonIstri' class='form-control'>
			<option value=''>Pilih Kab Kota</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kecamatan</td><td>
			 <div class='col-md-5'>
			<select id='kec1' name='KecamatanCalonIstri' class='form-control'>
			<option value=''>Pilih Kecamatan</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kelurahan</td><td>
			 <div class='col-md-5'>
			<select id='kel1' name='KelurahanCalonIstri' class='form-control'>
			<option value=''>Pilih Kelurahan</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kewarganegaraan</td><td><div class='col-md-5'>
				<select id='KewarganegaraanCalonIstri' name='KewarganegaraanCalonIstri' class='selectpicker show-tick form-control' data-live-search='true' required>
			<option value='INDONESIA'>INDONESIA</option>";
			$negara = mysql_query("SELECT NamaNegara FROM tblnegara");
			while ($ngr=mysql_fetch_array($negara))
			{
				echo"<option value='$ngr[NamaNegara]'>$ngr[NamaNegara]</option>";
			}
		echo"</select></div></td></tr>
				<tr>
					<td>Status Perkawinan</td>
					<td><div class='col-md-3'>
						<select name='StatusPerkawinanIstri' class='form-control'>
							<option value='Perawan'>Perawan</option>
							<option value='Janda'>Janda</option>
						</select>
					</div></td>
				</tr>";
		echo"<tr><td>Tanggal Pernikahan</td><td><div class='col-md-10'> 
<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value=''>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2' value='' name='TanggalPernikahan'></div></td></tr>";
		 echo"<tr><td>Pukul</td><td><div class='col-md-2'>
		 <input type='text' value='00:00' name='JamPernikahan' required class='form-control'>
				</div></td></tr>";
		echo"<tr>
					<td>Maskawin berupa</td><td><div class='col-md-4'>
					<textarea name='Maskawin' class='form-control' required></textarea></div></td>
				</tr>
				<tr>
					<td>Dibayar</td><td><div class='col-md-3'>
						<select name='TunaiHutang' id='TunaiHutang' class='form-control'>
							<option value='Dibayar Tunai'>Dibayar Tunai</option>
							<option value='Hutang'>Hutang</option>
						</select></div>
					</td>
				</tr>";
				  echo"<tr><td></td><td>
				<p align='left'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Simpan Dan Cetak</button>
				<button type='reset' class='btn btn-primary'>
					<i class='fa fa-fw fa-repeat'></i>Batal</button></p></td></tr>";
	echo"</thead></table>";
				echo"</form>";
					echo"</div></div>";
?>