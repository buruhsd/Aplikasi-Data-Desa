<?php
include "../library/koneksi.php";
$cmd=$_GET["cmd"]; if($cmd=="cekKematian") { $id=psi($_GET["id"]);  
?>
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
		  $sql = "select *
		  from tblpenduduk where (NoIdentitas like '%$id%' or NamaLengkap like '%$id%') order by NoKK,PosisiKKID,UrutPosisiKK"; 
		  $q=mysql_query("select *,(Year(current_date())-Year(TanggalLahir)) as umur from tblpenduduk 
		  where (NoIdentitas like '%$id%' or NamaLengkap like '%$id%') order by NoKK,PosisiKKID,UrutPosisiKK"); 
		  $no=0; while($get=mysql_fetch_array($q)) { $no++; ?>
				<tr>
					<td><?php=$no?></td>
					<td><div align="center">
					<?php=$get["NoKK"];?>
					</div></td>
                    <td>
                    <div align="center">
                            <a href="#" onClick="javascript:pilih('<?php=psi($get[NamaLengkap]);?>',
							'<?php=$get["NoKK"];?>','<?php=$get["NoIdentitas"];?>',
							'<?php=$get["Jalan"];?>','<?php=$get["RT"];?>',
							'<?php=$get["RW"];?>','<?php=$get["KodePos"];?>')">
							<?php=$get["NoIdentitas"];?></a>
                            <?php=$get["NoIdentitas"];?>
                    </div>
                    </td>
					<td><?php=$get[NamaLengkap];?></td>
					<td align="center"><?php=$get[umur];?></td>
					<td><?php=$get["Jalan"];?></td>
				</tr>
				<?php } ?>
		</table>
		</table>
	<?php } ?>
	