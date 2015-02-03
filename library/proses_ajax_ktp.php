<?php
 include "koneksi.php";

		if(isset($_POST['queryString'])) {
			$queryString = mysql_real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {

				$query = mysql_query("SELECT NamaLengkap,NoIdentitas,NoKK,Jalan,RT,RW,KodePos FROM tblpenduduk WHERE NoIdentitas LIKE '$queryString%'");
				
				if($query) {
				echo '<ul>';
					while ($result = mysql_fetch_object($query)) {
	         			echo '<li onClick="fill(\''.addslashes($result->NamaLengkap).'\'); 
	         			fill2(\''.addslashes($result->NoIdentitas).'\');
	         			fill3(\''.addslashes($result->NoKK).'\');
						fill4(\''.addslashes($result->Jalan).'\');
						fill5(\''.addslashes($result->RT).'\');
						fill6(\''.addslashes($result->RW).'\');
						fill7(\''.addslashes($result->KodePos).'\');
	         			">
	         			'.$result->NoIdentitas.'&nbsp;|&nbsp;'.$result->NamaLengkap.'</li>';

	         		}
				echo '</ul>';
					
				} else {
					echo '<ul>Ada Kesalahan Jaringan :(</ul>';
				}
			} else {
				echo '<ul>Data yang dicari tidak ada!!</ul>';
			}
		} else {
			echo '<ul>Data yang dicari tidak ada!!</ul>';
		}
?>