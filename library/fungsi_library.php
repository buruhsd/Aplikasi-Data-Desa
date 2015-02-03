<?php
# Fungsi untuk membuat format rupiah pada angka (uang)
function format_angka($angka) {
	$hasil =  number_format($angka,0, ",",".");
	return $hasil;
}

//fungsi tanggal 
	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
			
		function hari()
			{
			$hari2=date("w");
			Switch ($hari2){
			case 0 : $hari="Ahad";
			Break;
			case 1 : $hari="Senin";
			Break;
			case 2 : $hari="Selasa";
			Break;
			case 3 : $hari="Rabu";
			Break;
			case 4 : $hari="Kamis";
			Break;
			case 5 : $hari="Jumat";
			Break;
			case 6 : $hari="Sabtu";
			Break;
			}
			return $hari;
			}
	function umur($birthday){
		list($year,$month,$day) = explode("-",$birthday);
		$year_diff = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff = date("d") - $day;
		if ($month_diff < 0) $year_diff--;
		elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
		return $year_diff;
		}
?>