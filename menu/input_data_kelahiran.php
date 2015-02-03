<script>
function open_win() {
window.open( "menu/list_KK.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win1() {
window.open( "menu/list_ibu.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win2() {
window.open( "menu/list_ayah.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win3() {
window.open( "menu/list_KK2.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win4() {
window.open( "menu/list_KK3.php", "myWindow", "status=no,menubar=no,toolbar=no,scrollbars=yes,width=900,height=900,resizable=no" )
}
function open_win5() {
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
                                    <h3 class="box-title">Data Kelahiran Input</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
echo"<form method='POST' action='media.php?mn=input_data_kelahiran_simpan' onSubmit='return cekkosong(this);'>";
echo"<table class='table'>
	<tr><td>No Kelahiran</td><td><div class='col-md-4'>
	<input type=text name='no_kelahiran' id='no_kelahiran' class='form-control' required></div></td></tr>
	<tr><td>Nomor Kartu Keluarga</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='no_kk' id='NoKK' class='form-control' required >
	<span class='input-group-btn'>
	<a href='javascript:void(0)' onClick='open_win()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
	
	<tr><td>Nama Kepala Keluarga</td><td><div class='col-md-6'>
	<input type=text name='nama_KK' id='NamaKK' class='form-control' required></div></td></tr>
	
	<tr><td colspan='2' bgcolor='#99CCFF'><strong>B A Y I</strong></td></tr>
	
	<tr><td>Nama</td><td><div class='col-md-6'><input type=text name='nama_bayi' class='form-control' required></div></td></tr>
     
	<tr><td>Jenis Kelamin</td><td><div class='col-md-10'>
		<input type='radio' name='kelamin' value='0' checked/> Laki-Laki  
         <input type='radio' name='kelamin' value='1' /> Perempuan
		</div></select></td></tr>
		
    <tr><td>Tempat dilahirkan </td><td><div class='col-md-10'>
        <input type='radio' name='tempat_dilahirkan' value='RS/RB'/> RS/RB  
         <input type='radio' name='tempat_dilahirkan' value='Puskesmas' /> Puskesmas 
          <input type='radio' name='tempat_dilahirkan' value='Polindes' /> Polindes 
          <input type='radio' name='tempat_dilahirkan' value='Rumah' checked/> Rumah 
          <input type='radio' name='tempat_dilahirkan' value='lainnya' /> lainnya </td></tr>
	
	<tr><td>Tempat Kelahiran</td><td>
	<div class='col-md-5'>
	<select id='tmp_lahir' name='tmp_lahir' class='selectpicker show-tick form-control' data-live-search='true' required>
	<option value='3320'>JEPARA</option>";
	$tmp_lahir = mysql_query ("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID from tblkabkota ORDER BY NamaKabKota ASC");
	while($lahir=mysql_fetch_array($tmp_lahir))
	{
	echo"<option value='$lahir[KabKotaID]'>$lahir[NamaKabKota]</option>";
	}
	echo"</select></div></td></tr>";
	
	echo"<tr><td>Tanggal Lahir</td><td><div class='col-md-10'> 
	<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd'>
                    <input class='form-control' size='16' type='text' value='' required>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2' value='' name='tgl_lahir'></div></td></tr>";
				
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
      
	echo"<tr><td>Jenis Kelahiran </td><td><div class='col-md-10'>
        <input type='radio' name='jenis_kelahiran' value='Tunggal' checked/> Tunggal 
        <input type='radio' name='jenis_kelahiran' value='Kembar 2' /> Kembar 2 
        <input type='radio' name='jenis_kelahiran' value='Kembar 3' /> Kembar 3 
        <input type='radio' name='jenis_kelahiran' value='Kembar 4' /> Kembar 4
        <input type='radio' name='jenis_kelahiran' value='Lainnya' />Lainnya</td>
     </select></div></td></tr>";
     echo"<tr>
        <td>Jika Kembar anak ini lahir ke </td><td><div class='col-md-2'><input type=text name='anak_ke' class='form-control' onKeyPress='return numbersonly(this, event)'></div></td></tr>
		
		<tr><td>Penolong Kelahiran </td><td><div class='col-md-5'>
		 <input type='radio' name='penolong' value='Dokter' checked/> Dokter 
        <input type='radio' name='penolong' value='Bidan' /> Bidan
        <input type='radio' name='penolong' value='Dukun' /> Dukun 
        <input type='radio' name='penolong' value='Lainnya' /> Lainnya </div></td></tr>
        
		<tr><td>Berat bayi </td><td><div class='col-md-2'><input type=text name='berat_bayi' class='form-control' onKeyPress='return numbersonly(this, event)' required></div>KG</td></tr>";
	 echo"<tr><td>Desa</td><td>
	 <div class='col-lg-5'>
	<select id='dusun' name='dusun' class='selectpicker show-tick form-control' data-live-search='true' required>
	<option value=''>Pilih Desa</option>";
	$dusun = mysql_query("SELECT NamaDusun FROM tbldusun");
	while ($dsn=mysql_fetch_array($dusun))
	{
		echo"<option value='$dsn[NamaDusun]'>$dsn[NamaDusun]</option>";
	}
	echo"</select></div></td></tr>";
	
	//Ibu
	echo"<tr><td colspan='2' bgcolor='#99CCFF'><strong>I B U</strong></td></tr>
		<tr><td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='nik_ibu' id='NikIbu' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win1()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
		<tr><td>Nama Lengkap </td><td><div class='col-md-6'>
			<input type='text' name='nama_ibu' id='NamaIbu' class='form-control'/></div></td></tr>
		<tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
			<input type='text' class='form-control' name='tgl_kelahiran_ibu' id='TglIbu'/></div><div class='col-md-2'>
											<input type='text' name='umur_ibu' id='UmurIbu' class='form-control'/></div></td></tr>
		<tr><td>Pekerjaan</td><td><div class='col-md-5'>
			<input type='text' name='pekerjaan_ibu' class='form-control' id='PekerjaanIbu'/></div></td></tr>
		<tr><td>Alamat</td><td><div class='col-md-5'>
			<input type='text' name='alamat_ibu' class='form-control' id='AlamatIbu'/></div></td>
      <tr><td>Desa/Kelurahan</td><td><div class='col-md-5'>
			<input type='text' name='kelurahan_ibu' id='KelurahanIbu' class='form-control'/></div></td></tr>
      <tr><td>Keturunan</td><td><div class='col-md-10'>
        <input type='radio' name='keturunan_ibu' value='Eropa'/>Eropa
        <input type='radio' name='keturunan_ibu' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ibu' value='Indonesia' checked/>Indonesia 
        <input type='radio' name='keturunan_ibu' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunan_ibu' value='Lainnya'/>Lainnya
        </div></td></tr>
      <tr><td>Kewarganegaraan</td><td><div class='col-md-3'>
        <select name='kebangsaan_ibu' class='form-control'>
            <option value=''>::pilih::</option>
          <option value='WNI' selected>WNI</option>
		  <option value='WNA'>WNA</option>
          </select></div></td></tr>
      <tr><td>Tgl pencatatan perkawinan </td><td><div class='col-md-10'> 
	<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input3' data-link-format='yyyy-mm-dd'>
                    <input class='form-control' size='16' type='text' value='' required>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input3' value='' name='tgl_perkawinan'></div></div></td></tr>";			
	//Data Ayah
    echo"<tr><td colspan='2' bgcolor='#99CCFF'><strong>A Y A H </strong></td></tr>
      <tr><td>NIK</td><td><div class='col-md-5'>
	  	<div class='input-group'><input type=text name='nik_ayah' id='NikAyah' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win2()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
      <tr><td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='nama_ayah' id='NamaAyah' class='form-control'/>
		</div></td></tr>
       <tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
				<input type='text' name='tgl_kelahiran_ayah' id='tglAyah' class='form-control'/>
		</div><div class='col-md-2'>
				<input type='text' name='umur_ayah' id='UmurAyah' class='form-control'/>
		</div></td></tr>
      <tr><td>Pekerjaan</td><td><div class='col-md-5'>
				<input type='text' name='pekerjaan_ayah' id='PekerjaanAyah' class='form-control'/>
		</div></td></tr>
      <tr><td>Alamat</td><td><div class='col-md-6'>
				<input type='text' name='alamat_ayah' id='AlamatAyah' class='form-control'/>
		</div></td></tr>
	  <tr><td>Desa/Kelurahan</td><td><div class='col-md-5'> 
				<input type='text' name='kelurahan_ayah' id='KelurahanAyah' class='form-control'/>
		</div></td></tr>
      <tr>
        <td>Keturunan</td><td><div class='col-md-10'>
         <input type='radio' name='keturunan_ayah' value='Eropa'/>Eropa
        <input type='radio' name='keturunan_ayah' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ayah' value='Indonesia' checked/>Indonesia 
        <input type='radio' name='keturunan_ayah' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunan_ayah' value='Lainnya'/>Lainnya
        </div></td></tr>
      <tr><td>Kewarganegaraan</td><td><div class='col-md-3'>
        <select name='kebangsaan_ayah'  class='form-control'>
            <option value=''>::pilih::</option>
          <option value='WNI' selected>WNI</option>
		  <option value='WNA'>WNA</option>
          </select></div></td></tr>";
	//Data Pelapor
      echo"<tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>P E L A P O R </strong></td>
      </tr>
      <tr>
        <td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='nik_pelapor' id='NikPelapor' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win3()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div>
		</div></td></tr>
      <tr>
        <td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='nama_pelapor' id='NamaPelapor' class='form-control'/>
		</div></td></tr>
		 <tr>
        <td>Hubungan dengan bayi  </td><td><div class='col-md-6'>
				<input type='text' name='hubungan' id='hubungan' class='form-control' required/>
		</div></td></tr>";
	  //Saksi 1
      echo" <tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>SAKSI I </strong></td>
      </tr><tr>
        <td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='nik_saksi1' id='NikSaksi1' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win4()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
      <tr>
        <td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='nama_saksi1' id='NamaSaksi1' class='form-control'/>
		</div></td></tr>
      <tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>SAKSI II </strong></td>
      </tr>";
	  //Saksi 2
      echo"<tr>
        <td >NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='nik_saksi2' id='NikSaksi2' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win5()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div</div></td></tr>
	<td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='nama_saksi2' id='NamaSaksi2' class='form-control'/>
		</div></td></tr>";
	//echo"<tr><td>Tanda Tangan Kelurahan</td><td><div class='col-md-3'><select name='tanda_tangan' id='tanda_tangan' class='form-control'>
		//					<option value='Kepala Desa'>Kepala Desa</option>
			//				<option value='Sekretaris Desa'>Sekretaris Desa</option>
	//</div></select></td></tr>";
      echo"<tr><td></td><td>
				<p align='left'><button type='submit' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Simpan Dan Cetak</button>
				<button type='reset' class='btn btn-primary' onclick=self.history.back()>
					<i class='fa fa-fw fa-repeat'></i>Batal</button></p></td></tr>";
	echo"</thead></table>";
				echo"</form>";
					echo"</div></div>";
?>