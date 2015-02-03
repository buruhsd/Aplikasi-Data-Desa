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
                                    <h3 class="box-title">Data Kelahiran Edit</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
<?php
$id = $_GET['id'];
$data = mysql_query("SELECT * FROM tblkelahiran where id='$id' ORDER BY no_kelahiran desc");
$dt=mysql_fetch_array($data);
  $kepala = mysql_query("SELECT * FROM tblpenduduk where NoKK='$dt[NoKK]'");
  $kpl 	= mysql_fetch_array($kepala);
  $kab 	= mysql_query ("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota from tblkabkota where KabKotaID='$dt[TempatKelahiran]'");
  $kb 	= mysql_fetch_array($kab);
echo"<form method='POST' action='media.php?mn=input_data_kelahiran_update' onSubmit='return cekkosong(this);'>";
echo"<input type=hidden name='id' value='$id' class='form-control'>";
echo"<table class='table'>
	<tr><td>No Kelahiran</td><td><div class='col-md-4'>
	<input type=text name='no_kelahiran' value='$dt[no_kelahiran]' class='form-control' required></div></td></tr>
	<tr><td>Nomor Kartu Keluarga</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='no_kk' id='NoKK' value='$kpl[NoKK]' class='form-control' required >
	<span class='input-group-btn'>
	<a href='javascript:void(0)' onClick='open_win()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
	
	<tr><td>Nama Kepala Keluarga</td><td><div class='col-md-6'>
	<input type=text name='nama_KK' id='NamaKK' value='$kpl[NamaLengkap]' class='form-control' required></div></td></tr>
	
	<tr><td colspan='2' bgcolor='#99CCFF'><strong>B A Y I</strong></td></tr>
	
	<tr><td>Nama</td><td><div class='col-md-6'><input type=text name='nama_bayi' value='$dt[NamaBayi]' class='form-control' required></div></td></tr>
     
	<tr><td>Jenis Kelamin</td><td><div class='col-md-5'>";
		if($dt['JKelBayi'] == '0'){
		echo"<input type='radio' name='kelamin' value='0' checked/> Laki-Laki  
         <input type='radio' name='kelamin' value='1' /> Perempuan";
		 }
		else
		{
		echo"<input type='radio' name='kelamin' value='0'/> Laki-Laki  
         <input type='radio' name='kelamin' value='1' checked/> Perempuan";
		 }
		 echo"</div></select></td></tr>
    <tr><td>Tempat dilahirkan </td><td><div class='col-md-10'>";
	if ($dt['TempatDilahirkan'] =='RS/RB')
	{
    echo"<input type='radio' name='tempat_dilahirkan' value='RS/RB' checked/> RS/RB  
         <input type='radio' name='tempat_dilahirkan' value='Puskesmas' /> Puskesmas 
          <input type='radio' name='tempat_dilahirkan' value='Polindes' /> Polindes 
          <input type='radio' name='tempat_dilahirkan' value='Rumah'/> Rumah 
          <input type='radio' name='tempat_dilahirkan' value='lainnya' /> lainnya";
	}
	elseif ($dt['TempatDilahirkan'] =='Puskesmas')
	{
	echo"<input type='radio' name='tempat_dilahirkan' value='RS/RB'/> RS/RB  
         <input type='radio' name='tempat_dilahirkan' value='Puskesmas' checked/> Puskesmas 
          <input type='radio' name='tempat_dilahirkan' value='Polindes' /> Polindes 
          <input type='radio' name='tempat_dilahirkan' value='Rumah'/> Rumah 
          <input type='radio' name='tempat_dilahirkan' value='lainnya' /> lainnya";
	}
	elseif ($dt['TempatDilahirkan'] =='Polindes')
	{
	echo"<input type='radio' name='tempat_dilahirkan' value='RS/RB'/> RS/RB  
         <input type='radio' name='tempat_dilahirkan' value='Puskesmas'/> Puskesmas 
          <input type='radio' name='tempat_dilahirkan' value='Polindes' checked/> Polindes 
          <input type='radio' name='tempat_dilahirkan' value='Rumah'/> Rumah 
          <input type='radio' name='tempat_dilahirkan' value='lainnya' /> lainnya";
	}
	elseif ($dt['TempatDilahirkan'] =='Rumah')
	{
	echo"<input type='radio' name='tempat_dilahirkan' value='RS/RB'/> RS/RB  
         <input type='radio' name='tempat_dilahirkan' value='Puskesmas'/> Puskesmas 
          <input type='radio' name='tempat_dilahirkan' value='Polindes' /> Polindes 
          <input type='radio' name='tempat_dilahirkan' value='Rumah' checked/> Rumah 
          <input type='radio' name='tempat_dilahirkan' value='lainnya' /> lainnya";
	}
	else
	{
	echo"<input type='radio' name='tempat_dilahirkan' value='RS/RB'/> RS/RB  
         <input type='radio' name='tempat_dilahirkan' value='Puskesmas'/> Puskesmas 
          <input type='radio' name='tempat_dilahirkan' value='Polindes' /> Polindes 
          <input type='radio' name='tempat_dilahirkan' value='Rumah'/> Rumah 
          <input type='radio' name='tempat_dilahirkan' value='lainnya' checked/> lainnya";
	}
	echo"</div></td></tr>
	<tr><td>Tempat Kelahiran</td><td>
	<div class='col-md-5'>
	<select id='tmp_lahir' name='tmp_lahir' class='selectpicker show-tick form-control' data-live-search='true' required>";
	$tmplahir = mysql_query ("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$dt[TempatKelahiran]' ORDER BY NamaKabKota ASC");
	$tlhr	= mysql_fetch_array($tmplahir);
	echo"<option value='$tlhr[KabKotaID]'>$tlhr[NamaKabKota]</option>";
	$tmp_lahir = mysql_query ("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID from tblkabkota ORDER BY NamaKabKota ASC");
	while($lahir=mysql_fetch_array($tmp_lahir))
	{
	echo"<option value='$lahir[KabKotaID]'>$lahir[NamaKabKota]</option>";
	}
	echo"</select></div></td></tr>";
	
	echo"<tr><td>Tanggal Lahir</td><td><div class='col-md-10'> 
	<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd'>
                    <input class='form-control' size='16' type='text' value='$dt[TglLahir]' required>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2' value='$dt[TglLahir]' name='tgl_lahir'></div></td></tr>";
				
    echo"<tr><td>Pukul</td><td><div class='col-md-3'>
	<input type='text' id='dtp_input2' value='$dt[Pukul]' name='pukul' class='form-control' onKeyPress='return numbersonly(this, event)'></div></td></tr>";
	if ($dt['JKelahiran'] =='Tunggal')
	{
	echo"<tr><td>Jenis Kelahiran </td><td><div class='col-md-10'>
        <input type='radio' name='jenis_kelahiran' value='Tunggal' checked/> Tunggal 
        <input type='radio' name='jenis_kelahiran' value='Kembar 2' /> Kembar 2 
        <input type='radio' name='jenis_kelahiran' value='Kembar 3' /> Kembar 3 
        <input type='radio' name='jenis_kelahiran' value='Kembar 4' /> Kembar 4
        <input type='radio' name='jenis_kelahiran' value='Lainnya' />Lainnya";
	}
	elseif ($dt['JKelahiran'] =='Kembar 2')
	{
	echo"<tr><td>Jenis Kelahiran </td><td><div class='col-md-10'>
        <input type='radio' name='jenis_kelahiran' value='Tunggal' /> Tunggal 
        <input type='radio' name='jenis_kelahiran' value='Kembar 2' checked/> Kembar 2 
        <input type='radio' name='jenis_kelahiran' value='Kembar 3' /> Kembar 3 
        <input type='radio' name='jenis_kelahiran' value='Kembar 4' /> Kembar 4
        <input type='radio' name='jenis_kelahiran' value='Lainnya' />Lainnya";
	}
	elseif ($dt['JKelahiran'] =='Kembar 3')
	{
	echo"<tr><td>Jenis Kelahiran </td><td><div class='col-md-10'>
        <input type='radio' name='jenis_kelahiran' value='Tunggal' /> Tunggal 
        <input type='radio' name='jenis_kelahiran' value='Kembar 2' /> Kembar 2 
        <input type='radio' name='jenis_kelahiran' value='Kembar 3' checked/> Kembar 3 
        <input type='radio' name='jenis_kelahiran' value='Kembar 4' /> Kembar 4
        <input type='radio' name='jenis_kelahiran' value='Lainnya' />Lainnya";
	}
	elseif ($dt['JKelahiran'] =='Kembar 4')
	{
	echo"<tr><td>Jenis Kelahiran </td><td><div class='col-md-10'>
        <input type='radio' name='jenis_kelahiran' value='Tunggal' /> Tunggal 
        <input type='radio' name='jenis_kelahiran' value='Kembar 2' /> Kembar 2 
        <input type='radio' name='jenis_kelahiran' value='Kembar 3' /> Kembar 3 
        <input type='radio' name='jenis_kelahiran' value='Kembar 4' checked/> Kembar 4
        <input type='radio' name='jenis_kelahiran' value='Lainnya' />Lainnya";
	}
	else
	{
	echo"<tr><td>Jenis Kelahiran </td><td><div class='col-md-10'>
        <input type='radio' name='jenis_kelahiran' value='Tunggal' /> Tunggal 
        <input type='radio' name='jenis_kelahiran' value='Kembar 2' /> Kembar 2 
        <input type='radio' name='jenis_kelahiran' value='Kembar 3' /> Kembar 3 
        <input type='radio' name='jenis_kelahiran' value='Kembar 4'/> Kembar 4
        <input type='radio' name='jenis_kelahiran' value='Lainnya' checked/>Lainnya";
	}
    echo"</div></td></tr>";
	  
     echo"<tr>
        <td>Jika Kembar anak ini lahir ke </td><td><div class='col-md-2'>
		<input type=text name='anak_ke' class='form-control' value='$dt[KelahiranKe]' onKeyPress='return numbersonly(this, event)' required></div></td></tr>
		
		<tr><td>Penolong Kelahiran </td><td><div class='col-md-5'>
		<input type=text name='penolong' class='form-control' value='$dt[PenolongKelahiran]' required></div></td></tr>
        
		<tr><td>Berat bayi </td><td><div class='col-md-2'>
		<input type=text name='berat_bayi' class='form-control' value='$dt[BeratBayi]' onKeyPress='return numbersonly(this, event)' required></div>KG</td></tr>";
	echo"<tr><td>Desa</td><td>
	 <div class='col-lg-5'>	
	<select id='dusun' name='dusun' class='selectpicker show-tick form-control' data-live-search='true' required>
	<option value='$dt[Dusun]'>$dt[Dusun]</option>";
	$dusun = mysql_query("SELECT NamaDusun FROM tbldusun");
	while ($dsn=mysql_fetch_array($dusun))
	{
		echo"<option value='$dsn[NamaDusun]'>$dsn[NamaDusun]</option>";
	}
	echo"</select></div></td></tr>";
	//Ibu
	$ibu 	= mysql_query ("SELECT
							tblpekerjaan.NamaPekerjaan,
							tblpenduduk.NoIdentitas,
							tblpenduduk.NamaLengkap,
							tblpenduduk.TanggalLahir,
							tblpenduduk.Jalan,
							tblkelurahan.NamaKelurahan
							FROM
							tblpenduduk
							LEFT JOIN tblpekerjaan ON tblpenduduk.Pekerjaan = tblpekerjaan.PekerjaanID
							LEFT JOIN tblkelurahan ON tblpenduduk.KelurahanID = tblkelurahan.KelurahanID
							where tblpenduduk.NoIdentitas='$dt[nik_ibu]'");
	$ib	= mysql_fetch_array($ibu);
 
	echo"<tr><td colspan='2' bgcolor='#99CCFF'><strong>I B U</strong></td></tr>
		<tr><td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='nik_ibu' value='$ib[NoIdentitas]' id='NikIbu' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win1()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
		<tr><td>Nama Lengkap </td><td><div class='col-md-6'>
			<input type='text' name='nama_ibu' id='NamaIbu' value='$ib[NamaLengkap]' class='form-control'/></div></td></tr>";
		$umur_ibu 		 =umur($ib['TanggalLahir']);
		echo"<tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
			<input type='text' class='form-control' name='tgl_kelahiran_ibu' id='TglIbu' value='$ib[TanggalLahir]'/></div>
			<div class='col-md-2'>
			<input type='text' name='umur_ibu' id='UmurIbu' value='$umur_ibu' class='form-control'/></div></td></tr>
		<tr><td>Pekerjaan</td><td><div class='col-md-5'>
			<input type='text' name='pekerjaan_ibu' class='form-control' id='PekerjaanIbu' value='$ib[NamaPekerjaan]'/>
			</div></td></tr>
		<tr><td>Alamat</td><td><div class='col-md-5'>
			<input type='text' name='alamat_ibu' value='$ib[Jalan]' class='form-control' id='AlamatIbu'/>
			</div></td></tr>
		  <tr><td>Desa/Kelurahan</td><td><div class='col-md-5'>
			<input type='text' name='kelurahan_ibu' id='KelurahanIbu' value='$ib[NamaKelurahan]' class='form-control'/></div></td></tr>";
	  echo"<tr><td>Keturunan</td><td><div class='col-md-10'>";
	  if ($dt['keturunan_ibu'] == 'Eropa')
	  {
       echo"<input type='radio' name='keturunan_ibu' value='Eropa' checked/>Eropa
        <input type='radio' name='keturunan_ibu' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ibu' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunan_ibu' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunan_ibu' value='Lainnya'/>Lainnya";
		}
	elseif ($dt['keturunan_ibu'] == 'Cina/Timur Asing Lainnya')
	  {
       echo"<input type='radio' name='keturunan_ibu' value='Eropa'/>Eropa
        <input type='radio' name='keturunan_ibu' value='Cina/Timur Asing Lainnya' checked/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ibu' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunan_ibu' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunan_ibu' value='Lainnya'/>Lainnya";
		}
	elseif ($dt['keturunan_ibu'] == 'Indonesia')
	  {
       echo"<input type='radio' name='keturunan_ibu' value='Eropa'/>Eropa
        <input type='radio' name='keturunan_ibu' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ibu' value='Indonesia' checked/>Indonesia 
        <input type='radio' name='keturunan_ibu' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunan_ibu' value='Lainnya'/>Lainnya";
		}
	elseif ($dt['keturunan_ibu'] == 'Indonesia Nasional')
	  {
       echo"<input type='radio' name='keturunan_ibu' value='Eropa'/>Eropa
        <input type='radio' name='keturunan_ibu' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ibu' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunan_ibu' value='Indonesia Nasional' checked/>Indonesia Nasional
        <input type='radio' name='keturunan_ibu' value='Lainnya'/>Lainnya";
		}
	else
	{
       echo"<input type='radio' name='keturunan_ibu' value='Eropa'/>Eropa
        <input type='radio' name='keturunan_ibu' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ibu' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunan_ibu' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunan_ibu' value='Lainnya' checked/>Lainnya";
		}
      echo"</div></td></tr>
      <tr><td>Kebangsaan</td><td><div class='col-md-3'>
        <select name='kebangsaan_ibu' class='form-control'>
            <option value='$dt[kebangsaan_ibu]'>$dt[kebangsaan_ibu]</option>
          <option value='WNI' selected>WNI</option>
		  <option value='WNA'>WNA</option>
          </select></div></td></tr>
      <tr><td>Tgl pencatatan perkawinan </td><td><div class='col-md-10'> 
	<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input3' data-link-format='yyyy-mm-dd'>
                    <input class='form-control' size='16' type='text' value='$dt[tgl_perkawinan_ibu]' required>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input3' value='$dt[tgl_perkawinan_ibu]' name='tgl_perkawinan'></div></div></td></tr>";			
	//Data Ayah
	 $ayah = mysql_query ("SELECT
							tblpekerjaan.NamaPekerjaan,
							tblpenduduk.NoIdentitas,
							tblpenduduk.NamaLengkap,
							tblpenduduk.TanggalLahir,
							tblpenduduk.Jalan,
							tblkelurahan.NamaKelurahan
							FROM
							tblpenduduk
							LEFT JOIN tblpekerjaan ON tblpenduduk.Pekerjaan = tblpekerjaan.PekerjaanID
							LEFT JOIN tblkelurahan ON tblpenduduk.KelurahanID = tblkelurahan.KelurahanID
							where tblpenduduk.NoIdentitas='$dt[nik_ayah]'");
	 $ay	= mysql_fetch_array($ayah);
	 $umur_ayah 		 =umur($ay['TanggalLahir']);
    echo"<tr><td colspan='2' bgcolor='#99CCFF'><strong>A Y A H </strong></td></tr>
      <tr><td>NIK</td><td><div class='col-md-5'>
	  	<div class='input-group'><input type=text name='nik_ayah' value='$ay[NoIdentitas]' id='NikAyah' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win2()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
      <tr><td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='nama_ayah' id='NamaAyah' value='$ay[NamaLengkap]' class='form-control'/>
		</div></td></tr>
       <tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
				<input type='text' name='tgl_kelahiran_ayah' id='tglAyah' value='$ay[TanggalLahir]' class='form-control'/>
		</div><div class='col-md-2'>
				<input type='text' name='umur_ayah' id='UmurAyah' value='$umur_ayah' class='form-control'/>
		</div></td></tr>
      <tr><td>Pekerjaan</td><td><div class='col-md-5'>
				<input type='text' name='pekerjaan_ayah' id='PekerjaanAyah' value='$ay[NamaPekerjaan]' class='form-control'/>
		</div></td></tr>
      <tr><td>Alamat</td><td><div class='col-md-6'>
				<input type='text' name='alamat_ayah' id='AlamatAyah' value='$ay[Jalan]' class='form-control'/>
		</div></td></tr>
		  <tr><td>Desa/Kelurahan</td><td><div class='col-md-5'> 
				<input type='text' name='kelurahan_ayah' id='KelurahanAyah' value='$ay[NamaKelurahan]' class='form-control'/>
		</div></td></tr>";
	  echo"<tr>
        <td>Keturunan</td><td><div class='col-md-10'>";
         if ($dt['keturunan_ayah'] == 'Eropa')
	  {
       echo"<input type='radio' name='keturunan_ayah' value='Eropa' checked/>Eropa
        <input type='radio' name='keturunan_ayah' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ayah' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunan_ayah' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunan_ayah' value='Lainnya'/>Lainnya";
		}
	elseif ($dt['keturunan_ayah'] == 'Cina/Timur Asing Lainnya')
	  {
       echo"<input type='radio' name='keturunan_ayah' value='Eropa'/>Eropa
        <input type='radio' name='keturunan_ayah' value='Cina/Timur Asing Lainnya' checked/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ayah' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunan_ayah' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunan_ayah' value='Lainnya'/>Lainnya";
		}
	elseif ($dt['keturunan_ayah'] == 'Indonesia')
	  {
       echo"<input type='radio' name='keturunan_ayah' value='Eropa'/>Eropa
        <input type='radio' name='keturunan_ayah' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ayah' value='Indonesia' checked/>Indonesia 
        <input type='radio' name='keturunan_ayah' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunan_ayah' value='Lainnya'/>Lainnya";
		}
	elseif ($dt['keturunan_ayah'] == 'Indonesia Nasional')
	  {
       echo"<input type='radio' name='keturunan_ayah' value='Eropa'/>Eropa
        <input type='radio' name='keturunan_ayah' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ayah' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunan_ayah' value='Indonesia Nasional' checked/>Indonesia Nasional
        <input type='radio' name='keturunan_ayah' value='Lainnya'/>Lainnya";
		}
	else
	{
       echo"<input type='radio' name='keturunan_ayah' value='Eropa'/>Eropa
        <input type='radio' name='keturunan_ayah' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunan_ayah' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunan_ayah' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunan_ayah' value='Lainnya' checked/>Lainnya";
		}
      echo"</div></td></tr>
      <tr><td>Kebangsaan</td><td><div class='col-md-3'>
        <select name='kebangsaan_ayah'  class='form-control'>
           <option value='$dt[kebangsaan_ayah]'>$dt[kebangsaan_ayah]</option>
          <option value='WNI' selected>WNI</option>
		  <option value='WNA'>WNA</option>
          </select></div></td></tr>";
	//Data Pelapor
	$pelapor = mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[nik_pelapor]'");
	$plp 	= mysql_fetch_array($pelapor);
      echo"<tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>P E L A P O R </strong></td>
      </tr>
      <tr>
        <td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'>
		<input type=text name='nik_pelapor' value='$plp[NoIdentitas]' id='NikPelapor' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win3()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div>
		</div></td></tr>
      <tr>
        <td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='nama_pelapor' value='$plp[NamaLengkap]' id='NamaPelapor' class='form-control'/>
		</div></td></tr>
		<td>Hubungan dengan bayi  </td><td><div class='col-md-6'>
				<input type='text' name='hubungan' id='hubungan' value='$dt[hubungan_bayi]' class='form-control' required/>
		</div></td></tr>";
	  //Saksi 1
	$saksi1 = mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[nik_saksi1]'");
	$sks1 	= mysql_fetch_array($saksi1);
      echo" <tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>SAKSI I </strong></td>
      </tr><tr>
        <td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='nik_saksi1' id='NikSaksi1' value='$sks1[NoIdentitas]' value='' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win4()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
      <tr>
        <td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='nama_saksi1' id='NamaSaksi1' value='$sks1[NamaLengkap]' class='form-control'/>
		</div></td></tr>
      <tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>SAKSI II </strong></td>
      </tr>";
	  //Saksi 2
	  $saksi2 = mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[nik_saksi2]'");
	$sks2 	= mysql_fetch_array($saksi2);
      echo"<tr>
        <td >NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='nik_saksi2' value='$sks2[NoIdentitas]' id='NikSaksi2' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win5()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div</div></td></tr>
	<td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='nama_saksi2' id='NamaSaksi2' value='$sks2[NamaLengkap]' class='form-control'/>
		</div></td></tr>";
	//echo"<tr><td>Tanda Tangan Kelurahan</td><td><div class='col-md-3'>
	//<select name='tanda_tangan' id='tanda_tangan' class='form-control'>
			//				<option value='$dt[tanda_tangan]'>$dt[tanda_tangan]</option>
		//					<option value='Kepala Desa'>Kepala Desa</option>
	//						<option value='Sekretaris Desa'>Sekretaris Desa</option>
//	</div></select></td></tr>";
     echo"</thead></table>";
echo"<table class='table'>";
echo"<tr><td><p align='right'><button type='submit' name='cetak' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Update</button></p></td>";
echo"</form>";
echo"<td><form method='POST' action='media.php?mn=data_kelahiran' class='form-horizontal'>";
		echo"<button type='submit' class='btn btn-primary'><i class='fa fa-fw fa-repeat'></i>Batal</button>";
		echo"</form></td></tr>";
		echo"</table>";
					echo"</div></div>";
?>