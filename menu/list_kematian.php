<?php
include "../library/koneksi.php";
?>
<script>// namalenkpa, nomorkk, nik, alamat, rt, rw, kodepos
	function pilih(nama,nokk,nik,alamat,rt,rw,kodepos){
		self.opener.document.forms[0].NamaLengkap.value=nama;
		self.opener.document.forms[0].NoKK.value=nokk;
		self.opener.document.forms[0].NIK.value=nik;
		self.opener.document.forms[0].Alamat.value=alamat;
		self.opener.document.forms[0].RT.value=rt;
		self.opener.document.forms[0].RW.value=rw;
		self.opener.document.forms[0].KodePos.value=kodepos;
		window.close();
	}

</script>
<script language='javascript' src='../library/ajax.js'></script>
		<form>
		<font face='verdana' size='2'>Pencarian Nim&nbsp&nbsp: </font>
		<input type='text' name='searching' id='searching' size='25' onkeyup='nikktp(searching.value)' />
	</form>
<div id='pencarian'></div>

	
<form name="formKTP" action="" method="post">
<table width="747" border="0">
  <tr>
    <td width="151">Cari NIK / Nama Lengkap      </td>
    <td width="586"><input type="text" name="key" size="40 " onkeyup="cariKTP(this.value);" />
      <img src="../images/view.png" width="16" height="16" /></td>
    <!-- <td width="39">  <input type="submit" name="cari" value="Cari" />   </td> -->
  </tr>
</table>	
<div id="caria">
<table width="866" border="1" class="tipis">
  <tr>
    <th width="18">No</th>
    <th width="136" height="24"><div align="center">No Kartu Keluarga</div></th>
    <th width="163"><div align="center">NIK</div></th>
    <th width="309"><div align="center">Nama Lengkap </div></th>
    <th width="50"><div align="center">Umur</div></th>
    <th width="206">Alamat</th>
    </tr>
  <?php  
$sql = "select *,(Year(current_date())-Year(TanggalLahir)) as umur from tblpenduduk"; 
$q = mysql_query($sql); $no=0; while($get=mysql_fetch_array($q)) { $no++; ?>
  <tr>
    <td><?php=$no?></td>
    <td><div align="center">
   NOKK
    </div></td>
    <td>
    <div align="center">
	<a href="#" onClick="javascript:pilih('nama',
	'coba',
	'z',
	'a',
	'c',
	'd',
	'q')">
	ss</a>
    </div>
    </td>
    <td>sss</td>
    <td align="center">ss</td>
    <td>s</td>
    </tr>
  <?php } ?>
</table>
</div>
</form>