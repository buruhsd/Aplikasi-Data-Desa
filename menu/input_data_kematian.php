<script>
function open_win() {
window.open( "menu/list_KK.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win1() {
window.open( "menu/list_Mati.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win2() {
window.open( "menu/list_ayah.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win3() {
window.open( "menu/list_ibu.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win4() {
window.open( "menu/list_KK2.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win5() {
window.open( "menu/list_KK3.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win6() {
window.open( "menu/list_KK4.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
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
                                    <h3 class="box-title">Data Kematian Input</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=input_data_kematian_simpan' onSubmit='return cekkosong(this);'>";
echo"<table class='table'>
	<tr><td>No Surat Kematian</td><td><div class='col-md-3'>
	<input type=text name='no_kematian' class='form-control' required></div></td></tr>
	<tr>
	<tr><td>Nomor Kartu Keluarga</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='no_kk' id='NoKK' class='form-control' required >
	<span class='input-group-btn'>
	<a href='javascript:void(0)' onClick='open_win()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
	
	<tr><td>Nama Kepala Keluarga</td><td><div class='col-md-6'>
	<input type=text name='nama_KK' id='NamaKK' class='form-control' required></div></td></tr>
	<tr>
		<td colspan='2' bgcolor='#99CCFF'><b>J E N A Z A H</b></td>
	</tr>
	<tr>
		<td>NIK</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='NoIdentitasJenazah' id='NoIdentitasJenazah' class='form-control' required>
	<span class='input-group-btn'>
	<a href='javascript:void(0)' onClick='open_win1()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
	<tr>
		<td>Nama Lengkap </td><td><div class='col-md-5'>
			<input type='text' name='NamaLengkapJenazah' id='NamaLengkapJenazah' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Jenis Kelamin </td><td><div class='col-md-5'>
		<input type='text' name='JenisKelaminJenazah' id='JenisKelaminJenazah' class='form-control' required/>
		<input type='hidden' name='JenisKelamin' id='JenisKelamin' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Tanggal Lahir / Umur </td><td><div class='col-md-3'>
		<input type='text' name='TanggalLahirJenazah' id='TanggalLahirJenazah' class='form-control' required/></div>
		<div class='col-md-2'>
		<input type='text' name='UmurJenazah' id='UmurJenazah' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Tempat Lahir</td></td><td><div class='col-md-5'>
		<input type='text' name='TempatLahirIDJenazah' id='TempatLahirIDJenazah' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Agama</td><td><div class='col-md-5'>
		<input type='text' name='AgamaIDJenazah' id='AgamaIDJenazah' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Pekerjaan</td><td><div class='col-md-5'>
		<input type='text' name='PekerjaanJenazah' id='PekerjaanJenazah' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td><div class='col-md-5'><input type='text' name='AlamatJenazah' id='AlamatJenazah' class='form-control' required/>
		</div></td>
	</tr>
	<tr>
		<td>Kewarganegaraan</td>
		<td><div class='col-md-5'>
			<select name='KewarganegaraanJenazah' class='form-control' >			
				<option value='WNI'>WNI</option>
				<option value='WNA'>WNA</option>
			</select></div>
		</td></tr>
	 <tr><td>Keturunan</td><td><div class='col-md-10'>
        <input type='radio' name='keturunanJenazah' value='Eropa'/>Eropa
        <input type='radio' name='keturunanJenazah' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunanJenazah' value='Indonesia' checked/>Indonesia 
        <input type='radio' name='keturunanJenazah' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunanJenazah' value='Lainnya'/>Lainnya
        </div></td></tr>
      <tr><td>Kebangsaan</td><td><div class='col-md-5'>
        <select name='kebangsaanJenazah' class='selectpicker show-tick form-control' data-live-search='true' required>
		<option value='INDONESIA'>INDONESIA</option>";
		$bangsa = mysql_query("SELECT NamaNegara,NegaraID FROM tblnegara");
		while ($bgs=mysql_fetch_array($bangsa))
			{
        echo"<option value='$bgs[NamaNegara]'>$bgs[NamaNegara]</option>";
		}
	echo"</select></div></td></tr>";
	echo"<tr>
		<td>Anak Ke</td><td><div class='col-md-5'>
		<input type='text' name='AnakKeJenazah' id='AnakKeJenazah' class='form-control'/></div></td>
	</tr>";
	echo"<tr><td>Tanggal Kematian</td><td><div class='col-md-10'> 
	<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd' required>
                    <input class='form-control' size='16' type='text' value=''>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2' value='' name='tgl_kematian'></div></td></tr>";
				
    echo"<tr><td>Pukul</td><td><div class='col-md-2'>
		<select name='jam' class='form-control' required>
		<option value=''>Jam</option>";
		for($i=1;$i<=24;$i++) { if($_POST["jam"]==$i) { $selected="selected"; } else { $selected=""; } if($i<10) 
		{ echo "<option value=0$i $selected>0$i</option>"; } else { echo "<option value=$i $selected>$i</option>"; } }
		echo"</select></div>";
		echo"<div class='col-md-2'><select name='menit' class='form-control' required>
          <option value=''>Menit</option>";
          for($i=1;$i<=59;$i++) { if($_POST["menit"]==$i) { $selected="selected"; } else { $selected=""; } if($i<10) 
		  { echo "<option value=0$i $selected>0$i</option>"; } else { echo "<option value=$i $selected>$i</option>"; } }
        echo"</select></div></td></tr>";
	echo"<tr>
		<td>Sebab Kematian </td><td><div class='col-md-5'>
		<select name='sebab_kematian' class='selectpicker show-tick form-control' data-live-search='true' required>";
		$sebab = mysql_query("SELECT SebabKematianID, NamaSebabKematian FROM tblsebabkematian");
		while ($sbb=mysql_fetch_array($sebab)){
        echo"<option value='$sbb[NamaSebabKematian]'>$sbb[NamaSebabKematian]</option>";
		}
		echo"</select></div></td></tr>
		</div>
		
		</td>
	</tr>
	<tr>
		<td>Tempat Kematian </td><td><div class='col-md-5'>
		<input type='text' name='TempatKematianJenazah' id='TempatKematianJenazah' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Yang Menerangkan </td><td><div class='col-md-3'>
		<select name='YangMenerangkanKematian' class='form-control'>
			<option value='Dokter'>Dokter</option>
			<option value='Tenaga Kesehatan'>Tenaga Kesehatan</option>
			<option value='Kepolisian'>Kepolisian</option>
			<option value='Lainnya'>Lainnya</option>
		</select></div>
		</td>
	</tr>";
	//Data Ayah
    echo"<tr><td colspan='2' bgcolor='#99CCFF'><strong>A Y A H </strong></td></tr>
      <tr><td>NIK</td><td><div class='col-md-5'>
	  	<div class='input-group'><input type=text name='NIK_Ayah' id='NikAyah' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win2()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
      <tr><td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='NamaLengkapAyah' id='NamaAyah' class='form-control'/>
		</div></td></tr>
       <tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
				<input type='text' name='TanggalLahirAyah' id='tglAyah' class='form-control'/>
		</div><div class='col-md-2'>
				<input type='text' name='umur_ayah' id='UmurAyah' class='form-control'/>
		</div></td></tr>
      <tr><td>Pekerjaan</td><td><div class='col-md-5'>
				<input type='text' name='PekerjaanIDAyah' id='PekerjaanAyah' class='form-control'/>
		</div></td></tr>
      <tr><td>Alamat</td><td><div class='col-md-6'>
				<input type='text' name='AlamatAyah' id='AlamatAyah' class='form-control'/>
		</div></td></tr>
	  <tr><td>Desa/Kelurahan</td><td><div class='col-md-5'> 
				<input type='text' name='KelurahanIDAyah' id='KelurahanAyah' class='form-control'/>
		</div></td></tr>";
	//Data Ibu
		echo"<tr><td colspan='2' bgcolor='#99CCFF'><strong>I B U</strong></td></tr>
		<tr><td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='NIK_Ibu' id='NikIbu' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win3()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
		<tr><td>Nama Lengkap </td><td><div class='col-md-6'>
			<input type='text' name='NamaLengkapIbu' id='NamaIbu' class='form-control'/></div></td></tr>
		<tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
			<input type='text' class='form-control' name='TanggalLahirIbu' id='TglIbu'/></div><div class='col-md-2'>
											<input type='text' name='umur_ibu' id='UmurIbu' class='form-control'/></div></td></tr>
		<tr><td>Pekerjaan</td><td><div class='col-md-5'>
			<input type='text' name='PekerjaanIbu' class='form-control' id='PekerjaanIbu'/></div></td></tr>
		<tr><td>Alamat</td><td><div class='col-md-5'>
			<input type='text' name='AlamatIbu' class='form-control' id='AlamatIbu'/></div></td>
      <tr><td>Desa/Kelurahan</td><td><div class='col-md-5'>
			<input type='text' name='KelurahanIDIbu' id='KelurahanIbu' class='form-control'/></div></td></tr>";
	//Data Pelapor
      echo"<tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>P E L A P O R </strong></td>
      </tr>
      <tr>
        <td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='nik_pelapor' id='NikPelapor' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win4()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div>
		</div></td></tr>
      <tr>
        <td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='nama_pelapor' id='NamaPelapor' class='form-control' required/>
		</div></td></tr>
		 <tr>
        <td>Hubungan Dengan Mati </td><td><div class='col-md-6'>
				<input type='text' name='hubungan' class='form-control' required/>
		</div></td></tr>";
	 //Saksi 1
      echo" <tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>SAKSI I </strong></td>
      </tr><tr>
        <td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='NIK_Saksi1' id='NikSaksi1' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win5()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
      <tr>
        <td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='NamaLengkapSaksi1' id='NamaSaksi1' class='form-control'/>
		</div></td></tr>
      <tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>SAKSI II </strong></td>
      </tr>";
	  //Saksi 2
      echo"<tr>
        <td >NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='NIK_Saksi2' id='NikSaksi2' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win6()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div</div></td></tr>
	<td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='NamaLengkapSaksi2' id='NamaSaksi2' class='form-control'/>
		</div></td></tr>";
	//echo"<tr><td>Tanda Tangan Kelurahan</td><td><div class='col-md-3'><select name='tanda_tangan' id='tanda_tangan' class='form-control'>
							//<option value='Kepala Desa'>Kepala Desa</option>
							//<option value='Sekretaris Desa'>Sekretaris Desa</option>
	//</div></select></td></tr>";
      echo"<tr><td></td><td>
				<p align='left'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Simpan Dan Cetak</button>
				<button type='reset' class='btn btn-primary' onclick=self.history.back()>
					<i class='fa fa-fw fa-repeat'></i>Batal</button></p></td></tr>";
	echo"</thead></table>";
				echo"</form>";
					echo"</div></div>";
?>
	