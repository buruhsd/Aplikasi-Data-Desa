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
$id		=$_GET['id'];
$data 	=mysql_query ("SELECT * from tblkematian where KematianID='$id'");
$dt 	=mysql_fetch_array ($data);	
echo"<form method='POST' action='media.php?mn=input_data_kematian_update' onSubmit='return cekkosong(this);'>";
echo"<input type=hidden name='id' id='id' value='$dt[KematianID]' class='form-control' required >";
echo"<table class='table'>
	<tr><td>No Surat Kematian</td><td><div class='col-md-3'>
	<input type=text name='no_kematian' value='$dt[NoSuratKematian]' class='form-control' required></div></td></tr>
	<tr>
	<tr><td>Nomor Kartu Keluarga</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='no_kk' id='NoKK' value='$dt[NoKK]' class='form-control' required >
	<span class='input-group-btn'>
	<a href='javascript:void(0)' onClick='open_win()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
	
	<tr><td>Nama Kepala Keluarga</td><td><div class='col-md-6'>
	<input type=text name='nama_KK' id='NamaKK' class='form-control' value='$dt[NamaKepalaKeluarga]' required></div></td></tr>
	<tr>
		<td colspan='2' bgcolor='#99CCFF'><b>J E N A Z A H</b></td>
	</tr>
	<tr>
		<td>NIK</td><td><div class='col-md-5'>
	<div class='input-group'><input type=text name='NoIdentitasJenazah' id='NoIdentitasJenazah' value='$dt[NIK_Jenazah]' class='form-control' required>
	<span class='input-group-btn'> 
	<a href='javascript:void(0)' onClick='open_win1()'>
	<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
	</span>
	</div></div></td></tr>
	<tr>
		<td>Nama Lengkap </td><td><div class='col-md-5'>
			<input type='text' name='NamaLengkapJenazah' id='NamaLengkapJenazah' value='$dt[NamaLengkapJenazah]' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Jenis Kelamin </td><td><div class='col-md-5'>";
		if ($dt['JenisKelaminJenazah'] == 0){
		echo"<input type='text' name='JenisKelaminJenazah' id='JenisKelaminJenazah' value='Laki-Laki' class='form-control' required/>
		<input type='hidden' name='JenisKelamin' id='JenisKelamin' class='form-control' value='$dt[JenisKelaminJenazah]' required/>";
		}else{
		echo"<input type='text' name='JenisKelaminJenazah' id='JenisKelaminJenazah' value='Perempuan' class='form-control' required/>
		<input type='hidden' name='JenisKelamin' id='JenisKelamin' class='form-control' value='$dt[JenisKelaminJenazah]' required/>";
		}
		echo"</div></td>
	</tr>
	<tr>
		<td>Tanggal Lahir / Umur </td><td><div class='col-md-3'>
		<input type='text' name='TanggalLahirJenazah' id='TanggalLahirJenazah' value='$dt[TanggalLahirJenazah]' class='form-control' required/></div>
		<div class='col-md-2'>
		<input type='text' name='UmurJenazah' id='UmurJenazah' class='form-control' value='$dt[Umur]' required/></div></td>
	</tr>
	<tr>
		<td>Tempat Lahir</td></td><td><div class='col-md-5'>
		<input type='text' name='TempatLahirIDJenazah' id='TempatLahirIDJenazah' value='$dt[TempatLahirIDJenazah]' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Agama</td><td><div class='col-md-5'>
		<input type='text' name='AgamaIDJenazah' id='AgamaIDJenazah' value='$dt[AgamaIDJenazah]' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Pekerjaan</td><td><div class='col-md-5'>
		<input type='text' name='PekerjaanJenazah' id='PekerjaanJenazah' value='$dt[PekerjaanIDJenazah]' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td><div class='col-md-5'><input type='text' name='AlamatJenazah' value='$dt[AlamatJenazah]' id='AlamatJenazah' class='form-control' required/>
		</div></td>
	</tr>
	<tr>
		<td>Kewarganegaraan</td>
		<td><div class='col-md-5'>
			<select name='KewarganegaraanJenazah' class='form-control' >		
				<option value='$dt[KewarganegaraanJenazah]'>$dt[KewarganegaraanJenazah]</option>
				<option value='WNI'>WNI</option>
				<option value='WNA'>WNA</option>
			</select></div>
		</td></tr>
	<tr><td>Keturunan</td><td><div class='col-md-10'>";
	  if ($dt['KeturunanIDJenazah'] == 'Eropa')
	  {
       echo"<input type='radio' name='keturunanJenazah' value='Eropa' checked/>Eropa
        <input type='radio' name='keturunanJenazah' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunanJenazah' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunanJenazah' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunanJenazah' value='Lainnya'/>Lainnya";
		}
	elseif ($dt['KeturunanIDJenazah'] == 'Cina/Timur Asing Lainnya')
	  {
       echo"<input type='radio' name='keturunanJenazah' value='Eropa'/>Eropa
        <input type='radio' name='keturunanJenazah' value='Cina/Timur Asing Lainnya' checked/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunanJenazah' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunanJenazah' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunanJenazah' value='Lainnya'/>Lainnya";
		}
	elseif ($dt['KeturunanIDJenazah'] == 'Indonesia')
	  {
       echo"<input type='radio' name='keturunanJenazah' value='Eropa'/>Eropa
        <input type='radio' name='keturunanJenazah' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunanJenazah' value='Indonesia' checked/>Indonesia 
        <input type='radio' name='keturunanJenazah' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunanJenazah' value='Lainnya'/>Lainnya";
		}
	elseif ($dt['KeturunanIDJenazah'] == 'Indonesia Nasional')
	  {
       echo"<input type='radio' name='keturunanJenazah' value='Eropa'/>Eropa
        <input type='radio' name='keturunanJenazah' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunanJenazah' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunanJenazah' value='Indonesia Nasional' checked/>Indonesia Nasional
        <input type='radio' name='keturunanJenazah' value='Lainnya'/>Lainnya";
		}
	else
	{
       echo"<input type='radio' name='keturunanJenazah' value='Eropa'/>Eropa
        <input type='radio' name='keturunanJenazah' value='Cina/Timur Asing Lainnya'/>Cina/Timur Asing Lainnya
        <input type='radio' name='keturunanJenazah' value='Indonesia'/>Indonesia 
        <input type='radio' name='keturunanJenazah' value='Indonesia Nasional'/>Indonesia Nasional
        <input type='radio' name='keturunanJenazah' value='Lainnya' checked/>Lainnya";
		}
      echo"<tr><td>Kebangsaan</td><td><div class='col-md-5'>
        <select name='kebangsaanJenazah' class='selectpicker show-tick form-control' data-live-search='true' required>
		<option value='INDONESIA'>INDONESIA</option>";
		$bangsa = mysql_query("SELECT NamaNegara,NegaraID FROM tblnegara");
		while ($bgs=mysql_fetch_array($bangsa))
			{
        echo"<option value='$bgs[NamaNegara]'>$bgs[NamaNegara]</option>";
		}
	echo"</select></div></td></tr>";
	echo"<tr><td>Tanggal Kematian</td><td><div class='col-md-10'> 
	<div class='input-group date form_date col-md-5' data-date='' data-date-format='dd MM yyyy' data-link-field='dtp_input2' data-link-format='yyyy-mm-dd'>
                    <input class='form-control' size='16' type='text' value='$dt[TglKematianJenazah]'>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
					<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                </div>
				<input type='hidden' id='dtp_input2' value='$dt[TglKematianJenazah]' name='tgl_kematian'></div></td></tr>";
				
    echo"<tr><td>Pukul</td><td><div class='col-md-3'>
		<input type='text' value='$dt[JamKematianJenazah]' name='JamKematianJenazah' class='form-control'></div></td></tr>";
	echo"<tr>
		<td>Sebab Kematian </td><td><div class='col-md-5'>
		<select name='sebab_kematian' class='selectpicker show-tick form-control' data-live-search='true' required>";
		 echo"<option value='$dt[SebabKematianIDJenazah]'>$dt[SebabKematianIDJenazah]</option>";
		$sebab = mysql_query("SELECT SebabKematianID,NamaSebabKematian FROM tblsebabkematian");
		while ($sbb=mysql_fetch_array($sebab)){
        echo"<option value='$sbb[NamaSebabKematian]'>$sbb[NamaSebabKematian]</option>";
		}
		echo"</select></div></td></tr>
		</div>
		
		</td>
	</tr>
	<tr>
		<td>Tempat Kematian </td><td><div class='col-md-5'>
		<input type='text' name='TempatKematianJenazah' id='TempatKematianJenazah' value='$dt[TempatKematianJenazah]' class='form-control' required/></div></td>
	</tr>
	<tr>
		<td>Yang Menerangkan </td><td><div class='col-md-3'>
		<select name='YangMenerangkanKematian' class='form-control'>
			<option value='$dt[YangMenerangkanKematian]'>$dt[YangMenerangkanKematian]</option>
			<option value='Dokter'>Dokter</option>
			<option value='Tenaga Kesehatan'>Tenaga Kesehatan</option>
			<option value='Kepolisian'>Kepolisian</option>
			<option value='Lainnya'>Lainnya</option>
		</select></div>
		</td>
	</tr>";

	$data_ayah 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NIK_Ayah]'");
	$ayah 		=mysql_fetch_array($data_ayah);

	$kerjaayah 	= mysql_query("SELECT PekerjaanID,NamaPekerjaan FROM tblpekerjaan where NamaPekerjaan='$dt[PekerjaanIDAyah]'");
	$krjayah 	= mysql_fetch_array($kerjaayah);

	$provayah=mysql_query("SELECT NamaProvinsi from tblprovinsi where ProvinsiID='$ayah[ProvinsiID]'");
		$payah=mysql_fetch_array($provayah);
		$kabayah=mysql_query("SELECT NamaKabKota from tblkabkota where KabKotaID='$ayah[KabupatenID]'");
		$bayah=mysql_fetch_array($kabayah);
		$kecayah=mysql_query("SELECT NamaKecamatan from tblkecamatan where KecamatanID='$ayah[KecamatanID]'");
		$cayah=mysql_fetch_array($kecayah);
		$kelayah=mysql_query("SELECT NamaKelurahan from tblkelurahan where KelurahanID='$ayah[KelurahanID]'");
		$layah=mysql_fetch_array($kelayah);

		$TanggalLahirAyah = tgl_indo($dt['TanggalLahirAyah']);
		$umurAyah 	= umur($dt['TanggalLahirAyah']);

//Data Ayah
    echo"<tr><td colspan='2' bgcolor='#99CCFF'><strong>A Y A H </strong></td></tr>
      <tr><td>NIK</td><td><div class='col-md-5'>
	  	<div class='input-group'><input type=text name='NIK_Ayah' value='$dt[NIK_Ayah]' id='NikAyah' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win2()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
      <tr><td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='NamaLengkapAyah' value='$dt[NamaLengkapAyah]' id='NamaAyah' class='form-control'/>
		</div></td></tr>
       <tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
				<input type='text' name='TanggalLahirAyah' value='$dt[TanggalLahirAyah]' id='tglAyah' class='form-control'/>
		</div><div class='col-md-2'>
				<input type='text' name='umur_ayah' value='$umurAyah' id='UmurAyah' class='form-control'/>
		</div></td></tr>
      <tr><td>Pekerjaan</td><td><div class='col-md-5'>
				<input type='text' name='PekerjaanIDAyah' value='$krjayah[NamaPekerjaan]' id='PekerjaanAyah' class='form-control'/>
		</div></td></tr>
      <tr><td>Alamat</td><td><div class='col-md-6'>
				<input type='text' name='AlamatAyah' value='$dt[AlamatAyah]' id='AlamatAyah' class='form-control'/>
		</div></td></tr>
	  <tr><td>Desa/Kelurahan</td><td><div class='col-md-5'> 
				<input type='text' name='KelurahanIDAyah' value='$layah[NamaKelurahan]' id='KelurahanAyah' class='form-control'/>
		</div></td></tr>";

	$data_ibu 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NIK_Ibu]'");
	$ibu 		=mysql_fetch_array($data_ibu);
	$kerjaibu 	= mysql_query("SELECT PekerjaanID,NamaPekerjaan FROM tblpekerjaan where NamaPekerjaan='$dt[PekerjaanIbu]'");
	$krjibu 	= mysql_fetch_array($kerjaibu);
	$provibu=mysql_query("SELECT NamaProvinsi from tblprovinsi where ProvinsiID='$ibu[ProvinsiID]'");
		$pibu=mysql_fetch_array($provibu);
		$kabibu=mysql_query("SELECT NamaKabKota from tblkabkota where KabKotaID='$ibu[KabupatenID]'");
		$bibu=mysql_fetch_array($kabibu);
		$kecibu=mysql_query("SELECT NamaKecamatan from tblkecamatan where KecamatanID='$ibu[KecamatanID]'");
		$cibu=mysql_fetch_array($kecibu);
		$kelibu=mysql_query("SELECT NamaKelurahan from tblkelurahan where KelurahanID='$ibu[KelurahanID]'");
		$libu=mysql_fetch_array($kelibu);

	$TanggalLahirIbu = tgl_indo($dt['TanggalLahirIbu']);
	$umurIbu 	= umur($dt['TanggalLahirIbu']);

	//Data Ibu
		echo"<tr><td colspan='2' bgcolor='#99CCFF'><strong>I B U</strong></td></tr>
		<tr><td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='NIK_Ibu' value='$dt[NIK_Ibu]' id='NikIbu' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win3()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
		<tr><td>Nama Lengkap </td><td><div class='col-md-6'>
			<input type='text' name='NamaLengkapIbu' id='NamaIbu' value='$dt[NamaLengkapIbu]' class='form-control'/></div></td></tr>
		<tr><td>Tanggal Lahir / umur </td><td><div class='col-md-3'>
			<input type='text' class='form-control' name='TanggalLahirIbu' value='$dt[TanggalLahirIbu]' id='TglIbu'/></div><div class='col-md-2'>
											<input type='text' name='umur_ibu' value='$umurIbu' id='UmurIbu' class='form-control'/></div></td></tr>
		<tr><td>Pekerjaan</td><td><div class='col-md-5'>
			<input type='text' name='PekerjaanIbu' value='$krjibu[NamaPekerjaan]' class='form-control' id='PekerjaanIbu'/></div></td></tr>
		<tr><td>Alamat</td><td><div class='col-md-5'>
			<input type='text' name='AlamatIbu' value='$dt[AlamatIbu]' class='form-control' id='AlamatIbu'/></div></td>
      <tr><td>Desa/Kelurahan</td><td><div class='col-md-5'>
			<input type='text' name='KelurahanIDIbu' value='$libu[NamaKelurahan]' id='KelurahanIbu' class='form-control'/></div></td></tr>";
	//Data Pelapor
	$pelapor 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NIK_Pelapor]'");
	$plp 		=mysql_fetch_array($pelapor);

      echo"<tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>P E L A P O R </strong></td>
      </tr>
      <tr>
        <td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='nik_pelapor' value='$dt[NIK_Pelapor]' id='NikPelapor' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win4()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div>
		</div></td></tr>
      <tr>
        <td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='nama_pelapor' id='NamaPelapor' value='$dt[NamaLengkapPelapor]' class='form-control'/>
		</div></td></tr>
		 <tr>
        <td>Hubungan Dengan Mati </td><td><div class='col-md-6'>
				<input type='text' name='hubungan' class='form-control' value='$dt[HubunganJenazah]' required/>
		</div></td></tr>";

	 //Saksi 1
	$saksi1 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NIK_Saksi1]'");
	$sks1 		=mysql_fetch_array($saksi1);

      echo" <tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>SAKSI I </strong></td>
      </tr><tr>
        <td>NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='NIK_Saksi1' value='$sks1[NoIdentitas]' id='NikSaksi1' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win5()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div></div></td></tr>
      <tr>
        <td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='NamaLengkapSaksi1' value='$sks1[NamaLengkap]' id='NamaSaksi1' class='form-control'/>
		</div></td></tr>
      <tr>
        <td colspan='3' bgcolor='#99CCFF'><strong>SAKSI II </strong></td>
      </tr>";

	  //Saksi 2
	 $saksi2 	=mysql_query("SELECT * FROM tblpenduduk where NoIdentitas='$dt[NIK_Saksi2]'");
	$sks2 		=mysql_fetch_array($saksi2);
      echo"<tr>
        <td >NIK</td><td><div class='col-md-5'>
		<div class='input-group'><input type=text name='NIK_Saksi2' id='NikSaksi2' value='$sks2[NoIdentitas]' class='form-control' required >
		<span class='input-group-btn'>
		<a href='javascript:void(0)' onClick='open_win6()'>
		<button class='btn btn-info btn-flat' type='button'>Go!</button></a>
		</span>
		</div</div></td></tr>
	<td>Nama Lengkap </td><td><div class='col-md-6'>
				<input type='text' name='NamaLengkapSaksi2' value='$sks2[NamaLengkap]' id='NamaSaksi2' class='form-control'/>
		</div></td></tr>";

//	echo"<tr><td>Tanda Tangan Kelurahan</td><td><div class='col-md-3'><select name='tanda_tangan' id='tanda_tangan' class='form-control'>
	//						<option value='$dt[tanda_tangan]'>$dt[tanda_tangan]</option>
		//					<option value='Kepala Desa'>Kepala Desa</option>
			//				<option value='Sekretaris Desa'>Sekretaris Desa</option>
	//</div></select></td></tr>";
     echo"</thead></table>";
echo"<table class='table'>";
echo"<tr><td><p align='right'><button type='submit' name='cetak' class='btn btn-primary btn-line' data-original-title=''><i class='fa fa-fw fa-save'></i>Update</button></p></td>";
echo"</form>";
echo"<td><form method='POST' action='media.php?mn=data_kematian' class='form-horizontal'>";
		echo"<button type='submit' class='btn btn-primary'><i class='fa fa-fw fa-repeat'></i>Batal</button>";
		echo"</form></td></tr>";
		echo"</table>";
					echo"</div></div>";
?>
	