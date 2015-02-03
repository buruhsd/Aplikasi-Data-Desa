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
$data_nikah = mysql_query("SELECT * from tblsuratketerangannikah where SuratKeteranganNikahID='$_GET[id]'");
$dt 		= mysql_fetch_array($data_nikah);
echo"<form method='POST' action='media.php?mn=surat_keterangan_nikah_update' onSubmit='return cekkosong(this);'>";
echo"<table class='table'>
	<input type='hidden' name='id' class='form-control' value='$dt[SuratKeteranganNikahID]'/>";
echo"<tr><td>No Surat Nikah </td><td><div class='col-md-3'>
				<input type='text' name='no_surat_nikah' class='form-control' value='$dt[SuratKeteranganNikah]' required/>
				</div></td></tr>
				<tr><td colspan='2'><b>CALON SUAMI</b></td>
				</tr>
				<tr>
				<tr><td>No Identitas</td><td><div class='col-md-5'>
				<div class='input-group'><input type=text name='NoIdentitasCalonSuami' value='$dt[NoIdentitasCalonSuami]' id='NoIdentitasCalonSuami' class='form-control' required >
				<span class='input-group-btn'>
				<a href='javascript:void(0)' onClick='open_win()'>
				<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
				</span>
					</div></div></td></tr>
				</tr>
				  <tr><td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='NamaCalonSuami' id='NamaCalonSuami' value='$dt[NamaCalonSuami]' class='form-control'/>
				</div></td></tr>
				 <tr><td>Tempat Lahir </td><td><div class='col-md-6'>
				<input type='text' name='TempatLahirCalonSuami' value='$dt[TempatLahirCalonSuami]' id='TempatLahirCalonSuami' class='form-control'/>
				</div></td></tr>
			   <tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
						<input type='text' name='TanggalLahirCalonSuami' value='$dt[TanggalLahirCalonSuami]' id='TanggalLahirCalonSuami' class='form-control'/>
				</div>
				<div class='col-md-2'>
						<input type='text' name='UmurCalonSuami' id='UmurCalonSuami' value=".umur($dt['TanggalLahirCalonSuami'])." class='form-control'/>
				</div></td></tr>";
		echo"<tr><td>Pekerjaan</td><td><div class='col-md-5'>
				<select name='PekerjaanCalonSuami' id='PekerjaanCalonSuami' required class='selectpicker show-tick form-control' data-live-search='true' >";
				$dataPekerjaan 	= mysql_query("SELECT * from tblpekerjaan where PekerjaanID='$dt[PekerjaanCalonSuami]'");
				$dtpkj 			= mysql_fetch_array($dataPekerjaan);
				echo"<option value='$dtpkj[PekerjaanID]'>$dtpkj[NamaPekerjaan]</option>";
				$Pekerjaan = mysql_query("SELECT * from tblpekerjaan where not PekerjaanID='$dtpkj[PekerjaanID]'");
				while($pkj=mysql_fetch_array($Pekerjaan))
				{
					echo"<option value='$pkj[PekerjaanID]'>$pkj[NamaPekerjaan]</option>";
				}
			echo"</div></select></td></tr>";	
				echo"<tr><td>Agama</td><td><div class='col-md-5'>
			<select name='AgamaCalonSuami' id='AgamaCalonSuami' class='form-control' required>";
			$dtagama	= mysql_query("SELECT * from tblagama where AgamaID='$dt[AgamaCalonSuami]'");
			$dtagm 		= mysql_fetch_array($dtagama); 		
			echo"<option value='$dtagm[AgamaID]'>$dtagm[NamaAgama]</option>";
			$agama = mysql_query("SELECT * from tblagama where not AgamaID='$dtagm[AgamaID]'");
			while ($agm = mysql_fetch_array($agama))
			{
			echo"<option value='$agm[AgamaID]'>$agm[NamaAgama]</option>";	
			}
				echo"</div></select></td></tr>";
    echo"<tr><td>Alamat</td><td><div class='col-md-6'>
				<input type='text' name='JalanCalonSuami' id='JalanCalonSuami' value='$dt[JalanCalonSuami]' class='form-control'/>
		</div></td></tr>
		<tr><td>RT / RW</td><td>
		<div class='col-md-2'>
		<input type='text' name='RTCalonSuami' id='RTCalonSuami' value='$dt[RTCalonSuami]' required class='form-control' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
		<div class='col-md-2'><input type='text' name='RWCalonSuami' value='$dt[RWCalonSuami]' id='RWCalonSuami' placeholder='RW' class='form-control' required onKeyPress='return numbersonly(this, event)'>
		</div></td></tr>";
		echo"<tr><td>Provinsi</td><td>
			 <div class='col-lg-5'>
			<select id='provinsi' name='ProvinsiCalonSuami' class='selectpicker show-tick form-control' data-live-search='true' required>";
			$provinsi1 = mysql_query("SELECT * from tblprovinsi  where ProvinsiID='$dt[ProvinsiCalonSuami]'");
			$prov1=mysql_fetch_array($provinsi1);
			echo"<option value='$prov1[ProvinsiID]'>$prov1[NamaProvinsi]</option>";
			$provinsi = mysql_query("SELECT * from tblprovinsi");
			while ($prov=mysql_fetch_array($provinsi))
			{
				echo"<option value='$prov[ProvinsiID]'>$prov[NamaProvinsi]</option>";
			}
		echo"</select></div></td></tr>";
		echo"<tr><td>Kabupaten/Kota</td><td>
			 <div class='col-md-5'>
			<select id='kota' name='KabupatenCalonSuami' class='form-control'>";
			$kab 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[KabupatenCalonSuami]'");
  			$kb 	= mysql_fetch_array($kab);
		echo"<option value='$kb[KabKotaID]'>$kb[NamaKabKota]</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kecamatan</td><td>
			 <div class='col-md-5'>
			<select id='kec' name='KecamatanCalonSuami' class='form-control'>";
	$kec=mysql_query("SELECT * from tblkecamatan where KecamatanID='$dt[KecamatanCalonSuami]'");
	$c=mysql_fetch_array($kec);
	echo"<option value='$c[KecamatanID]'>$c[NamaKecamatan]</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kelurahan</td><td>
			 <div class='col-md-5'>
			<select id='kel' name='KelurahanCalonSuami' class='form-control'>";
	$kel=mysql_query("SELECT * from tblkelurahan where KelurahanID='$dt[KelurahanCalonSuami]'");
	$l=mysql_fetch_array($kel);
	echo"<option value='$l[KelurahanID]'>$l[NamaKelurahan]</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kewarganegaraan</td><td><div class='col-md-5'>
				<select id='KewarganegaraanCalonSuami' name='KewarganegaraanCalonSuami' class='selectpicker show-tick form-control' data-live-search='true' required>
			<option value='$dt[KewarganegaraanCalonSuami]'>$dt[KewarganegaraanCalonSuami]</option>";
			$negara = mysql_query("SELECT NamaNegara FROM tblnegara");
			while ($ngr=mysql_fetch_array($negara))
			{
				echo"<option value='$ngr[NamaNegara]'>$ngr[NamaNegara]</option>";
			}
		echo"</select></div></td></tr>
				<tr>
					<td>Status Perkawinan</td>
					<td><div class='col-md-3'>
						<select name='StatusPerkawinanSuami' class='form-control'>";
						if ($dt['StatusPerkawinanSuami'] =='Perjaka')
						{
						echo"<option value='Perjaka'>Perjaka</option>
							<option value='Duda'>Duda</option>";
						}
						else
						{
							echo"
							<option value='Duda'>Duda</option>
							<option value='Perjaka'>Perjaka</option>";
						}
					echo"</select>
					</div></td>
				</tr>";
				//Calon Istri
			echo"<tr>
					<td colspan='2'><b>CALON ISTRI</b></td>
				</tr>
				<tr><td>No Identitas</td><td><div class='col-md-5'>
				<div class='input-group'><input type=text name='NoIdentitasCalonIstri' value='$dt[NoIdentitasCalonIstri]' id='NoIdentitasCalonIstri' class='form-control' required >
				<span class='input-group-btn'>
				<a href='javascript:void(0)' onClick='open_win1()'>
				<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
				</span>
					</div></div></td></tr>
				</tr>
				</tr>
				  <tr><td>Nama Lengkap </td><td><div class='col-md-3'>
				<input type='text' name='NamaCalonIstri' value='$dt[NamaCalonIstri]' id='NamaCalonIstri' class='form-control'/>
				</div></td></tr>
				 <tr><td>Tempat Lahir </td><td><div class='col-md-6'>
				<input type='text' name='TempatLahirCalonIstri' value='$dt[TempatLahirCalonIstri]' id='TempatLahirCalonIstri' class='form-control'/>
				</div></td></tr>
			   <tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
						<input type='text' name='TanggalLahirCalonIstri' value='$dt[TanggalLahirCalonIstri]' id='TanggalLahirCalonIstri' class='form-control'/>
				</div>
				<div class='col-md-2'>
						<input type='text' name='UmurCalonIstri' value=".umur($dt['TanggalLahirCalonIstri'])." id='UmurCalonIstri' class='form-control'/>
				</div></td></tr>";
		echo"<tr><td>Pekerjaan</td><td><div class='col-md-5'>
						<select name='PekerjaanCalonIstri' id='PekerjaanCalonIstri' required class='selectpicker show-tick form-control' data-live-search='true' >";
				$dataPekerjaan1 	= mysql_query("SELECT * from tblpekerjaan where PekerjaanID='$dt[PekerjaanCalonIstri]'");
				$dtpkj1 			= mysql_fetch_array($dataPekerjaan1);
				echo"<option value='$dtpkj1[PekerjaanID]'>$dtpkj1[NamaPekerjaan]</option>";
				$Pekerjaan1 = mysql_query("SELECT * from tblpekerjaan where not PekerjaanID='$dtpkj1[PekerjaanID]'");
				while($pkj1=mysql_fetch_array($Pekerjaan1))
				{
					echo"<option value='$pkj1[PekerjaanID]'>$pkj1[NamaPekerjaan]</option>";
				}
			echo"</div></select></td></tr>";	
		echo"<tr><td>Agama</td><td><div class='col-md-5'>
						<select name='AgamaCalonIstri' id='AgamaCalonIstri' class='form-control' required>";
			$dtagama1	= mysql_query("SELECT * from tblagama where AgamaID='$dt[AgamaCalonIstri]'");
			$dtagm1 		= mysql_fetch_array($dtagama1); 		
			echo"<option value='$dtagm1[AgamaID]'>$dtagm1[NamaAgama]</option>";
			$agama1 = mysql_query("SELECT * from tblagama where not AgamaID='$dtagm1[AgamaID]'");
			while ($agm1 = mysql_fetch_array($agama1))
			{
			echo"<option value='$agm1[AgamaID]'>$agm1[NamaAgama]</option>";	
			}
				echo"</div></select></td></tr>";
    echo"<tr><td>Alamat</td><td><div class='col-md-6'>
				<input type='text' name='JalanCalonIstri' id='JalanCalonIstri' value='$dt[JalanCalonIstri]' class='form-control'/>
		</div></td></tr>
		<tr><td>RT / RW</td><td>
		<div class='col-md-2'>
		<input type='text' name='RTCalonIstri' value='$dt[RTCalonIstri]' id='RTCalonIstri' required class='form-control' placeholder='RT' onKeyPress='return numbersonly(this, event)'></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<div class='col-md-2'><input type='text' name='RWCalonIstri' value='$dt[RTCalonIstri]' id='RWCalonIstri' placeholder='RW' class='form-control' required onKeyPress='return numbersonly(this, event)'>
		</div></td></tr>";
		echo"<tr><td>Provinsi</td><td>
			 <div class='col-lg-5'>
			<select id='provinsi1' name='ProvinsiCalonIstri' class='selectpicker show-tick form-control' data-live-search='true' required>";
			$provinsi2 = mysql_query("SELECT * from tblprovinsi  where ProvinsiID='$dt[ProvinsiCalonIstri]'");
			$prov2=mysql_fetch_array($provinsi2);
			echo"<option value='$prov2[ProvinsiID]'>$prov2[NamaProvinsi]</option>";
			$provinsi3 = mysql_query("SELECT * from tblprovinsi");
			while ($prov3=mysql_fetch_array($provinsi3))
			{
				echo"<option value='$prov3[ProvinsiID]'>$prov3[NamaProvinsi]</option>";
			}
		echo"</select></div></td></tr>";
		echo"<tr><td>Kabupaten/Kota</td><td>
			 <div class='col-md-5'>
			<select id='kota1' name='KabupatenCalonIstri' class='form-control'>";
				$kab1 	= mysql_query ("SELECT * from tblkabkota where KabKotaID='$dt[KabupatenCalonIstri]'");
  			$kb1 	= mysql_fetch_array($kab1);
		echo"<option value='$kb1[KabKotaID]'>$kb1[NamaKabKota]</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kecamatan</td><td>
			 <div class='col-md-5'>
			<select id='kec1' name='KecamatanCalonIstri' class='form-control'>";
			$kec1=mysql_query("SELECT * from tblkecamatan where KecamatanID='$dt[KecamatanCalonIstri]'");
	$c1=mysql_fetch_array($kec1);
	echo"<option value='$c1[KecamatanID]'>$c1[NamaKecamatan]</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kelurahan</td><td>
			 <div class='col-md-5'>
			<select id='kel1' name='KelurahanCalonIstri' class='form-control'>";
				$kel1=mysql_query("SELECT * from tblkelurahan where KelurahanID='$dt[KelurahanCalonIstri]'");
	$l1=mysql_fetch_array($kel1);
	echo"<option value='$l1[KelurahanID]'>$l1[NamaKelurahan]</option>";
		echo"</div></select></td></tr>";
		echo"<tr><td>Kewarganegaraan</td><td><div class='col-md-5'>
				<select id='KewarganegaraanCalonIstri' name='KewarganegaraanCalonIstri' class='selectpicker show-tick form-control' data-live-search='true' required>
			<option value='$dt[KewarganegaraanCalonIstri]'>$dt[KewarganegaraanCalonIstri]</option>";
			$negara = mysql_query("SELECT NamaNegara FROM tblnegara");
			while ($ngr=mysql_fetch_array($negara))
			{
				echo"<option value='$ngr[NamaNegara]'>$ngr[NamaNegara]</option>";
			}
		echo"</select></div></td></tr>
				<tr>
					<td>Status Perkawinan</td>
					<td><div class='col-md-3'>
						<select name='StatusPerkawinanIstri' class='form-control'>";
						if($dt['StatusPerkawinanIstri'] == 'Perawan')
						{
						echo"<option value='Perawan'>Perawan</option>
							<option value='Janda'>Janda</option>";
						}
						else
						{
							echo"<option value='Janda'>Janda</option>
							<option value='Perawan'>Perawan</option>";
						}
					echo"</select>
					</div></td>
				</tr>";
		echo"<tr><td>Tanggal Pernikahan</td><td><div class='col-md-10'> 
<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd' readonly>
                    <input class='form-control' size='16' type='text' value='$dt[TanggalPernikahan]'>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2'  value='$dt[TanggalPernikahan]' name='TanggalPernikahan'></div></td></tr>";
		 echo"<tr><td>Pukul</td><td><div class='col-md-2'>
		 <input type='text' name='JamPernikahan' value='$dt[JamPernikahan]' required class='form-control'>
				</div></td></tr>";
		echo"<tr>
					<td>Maskawin berupa</td><td><div class='col-md-4'>
					<textarea name='Maskawin' class='form-control' required>$dt[Maskawin]</textarea></div></td>
				</tr>
				<tr>
					<td>Dibayar</td><td><div class='col-md-3'>
						<select name='TunaiHutang' id='TunaiHutang' class='form-control'>";
						if ($dt['TunaiHutang'] == 'Dibayar Tunai')
						{
						echo"<option value='Dibayar Tunai'>Dibayar Tunai</option>
							<option value='Hutang'>Hutang</option>";
						}
						else
						{
							echo"
							<option value='Hutang'>Hutang</option>
							<option value='Dibayar Tunai'>Dibayar Tunai</option>";
						}
				echo"</select></div>
					</td>
				</tr>";
				echo"</thead></table>";
echo"<table class='table'>";
echo"<tr><td><p align='right'><button type='submit' name='cetak' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Update</button></p></td>";
echo"</form>";
echo"<td><form method='POST' action='media.php?mn=data_surat_nikah' class='form-horizontal'>";
    echo"<button type='submit' class='btn btn-primary'><i class='fa fa-fw fa-repeat'></i>Batal</button>";
    echo"</form></td></tr>";
    echo"</table>";
          echo"</div></div>";
?>