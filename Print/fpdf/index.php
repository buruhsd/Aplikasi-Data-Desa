<?php
if (!isset($_SESSION[namauser])) {

		echo"<div align ='center'><h2><blink>Maaf, Anda masuk daerah terlarang</blink></h2></div>";
		$hal="../index.php";

	echo "<meta http-equiv=\"refresh\" content=\"2;url=$hal\">";
	}


?>