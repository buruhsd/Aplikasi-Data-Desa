<?php
session_start();
include "../library/koneksi.php";
include "../library/fungsi_library.php";
define('FPDF_FONTPATH', 'fpdf/font/');
include "fpdf/fpdf.php";
//include "fpdf/dash.php";
date_default_timezone_set("Asia/Jakarta");

class PDF extends FPDF
{
	function Header()
  	{
		
		
		$this->Image('grobogan.jpg',6,0.4,1.5);
		
		$this->SetFont('Times','','9');
		$this->Cell(29,0.4,'PEMERINTAH KABUPATEN GROBOGAN',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','B','9');
		$this->Cell(29,0.4,'DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','','9');
		$this->Cell(29,0.4,'Jln.Dr.Sutomo No.5 Telp.(0292) 421940 Purwodadi 58111',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','B','9');
		$this->Cell(29,0.4,'FORMULIR ISIAN BIODATA PENDUDUK UNTUK WNI (PER KELUARGA) ',0,0,'C');
	
		//$this->Line(1,3.45,29,3.45);
		//$this->Line(1,3.4,29,3.4);
  	}
  
  	function Footer()
  	{	
   		// $this->SetY(-2,5);
		//$this->Cell(0,1,$this->PageNo(),0,0,'C');
  	}
}
$pdf = new PDF('L','cm','A4');
	$pdf->SetMargins(0.4,0.4,0.4);
   	$pdf->Open();
   	$pdf->AliasNbPages();
   	$pdf->AddPage();
	$pdf->SetXY(0.4,2.5);
	
	$id = $_GET['id'];
	$data 	= mysql_query("SELECT * from tblpermohonan_kk where no_kk_kel='$id'");
	$dt 	= mysql_fetch_array($data);

	$datakepala = mysql_query("SELECT * FROM tblpermohonan_kk where no_kk_kel='$dt[no_kk_kel]' AND hub_keluarga='0'");
	$dtkpl		=mysql_fetch_array($datakepala);

	$data_jmh 	= mysql_query("SELECT * FROM tblpermohonan_kk where no_kk_kel='$dt[no_kk_kel]'");
	$jmh 		= mysql_num_rows($data_jmh);

	$pdf->SetFont('Times','','9');
	$pdf->Cell(22,0.4,'PERHATIAN : Isilah formulir ini dengan huruf cetak dan jelas serta mengikuti "TATA CARA PENGISIAN FORMULIR " pada halaman sebaliknya',1,0,'L');
	$pdf->Cell(3,0.4,'',0,0,'L');
	$pdf->Cell(2,0.4,'F-101',1,1,'L');
	$pdf->Cell(3,0.1,'',0,1,'L');
	$pdf->SetFont('Times','B','8');
	$pdf->Cell(22,0.4,'DATA KEPALA KELUARGA',0,1,'L');
	$pdf->SetFont('Times','','8');
	$pdf->Cell(4,0.4,'Nama Kepala Keluarga ',0,0,'L');
	$pdf->Cell(0.4,0.4,':',0,0,'L');
	$pdf->Cell(9.5,0.4,strtoupper($dtkpl['nama_lengkap']),1,0,'L'); //data
	$pdf->Cell(1.5,0.4,'',0,0,'L');

	$data_provinsi 	= mysql_query("SELECT * from tblprovinsi where ProvinsiID='$dt[provinsi]'");
	$dtprov 	 	= mysql_fetch_array($data_provinsi);
	$pdf->Cell(4,0.4,'Kode-Nama Provinsi ',0,0,'L');
	$pdf->Cell(0.4,0.4,':',0,0,'L');
	$pdf->Cell(1,0.4,$dtprov['ProvinsiID'],1,0,'L'); //data
	$pdf->Cell(2,0.4,'',0,0,'L');
	$pdf->Cell(5,0.4,$dtprov['NamaProvinsi'],1,1,'L'); //data
	
	$pdf->Cell(4,0.4,'Alamat ',0,0,'L');
	$pdf->Cell(0.4,0.4,':',0,0,'L');
	$pdf->Cell(9.5,0.4,$dt['alamat'],1,0,'L'); //data
	$pdf->Cell(1.5,0.4,'',0,0,'L');

	$kab 	= mysql_query ("SELECT SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID from tblkabkota where KabKotaID='$dt[kabupaten]'");
  	$kb 	= mysql_fetch_array($kab);
	$pdf->Cell(4,0.4,'Kode-Nama Kabupaten ',0,0,'L');
	$pdf->Cell(0.4,0.4,':',0,0,'L');
	$pdf->Cell(1,0.4,$kb['KabKotaID'],1,0,'L'); //data
	$pdf->Cell(2,0.4,'',0,0,'L');
	$pdf->Cell(5,0.4,$kb['NamaKabKota'],1,1,'L'); //data
	
	$pdf->Cell(4,0.4,'Kode Pos ',0,0,'L');
	$pdf->Cell(0.4,0.4,':',0,0,'L');
	$pdf->Cell(1.5,0.4,$dt['kode_pos'],1,0,'L'); //data
	$pdf->Cell(0.8,0.4,'RT ',0,0,'L');
	$pdf->Cell(0.8,0.4,$dt['rt'],1,0,'L'); //data
	$pdf->Cell(0.8,0.4,'RW ',0,0,'L');
	$pdf->Cell(0.8,0.4,$dt['rw'],1,0,'L'); //data
	$pdf->Cell(4,0.4,'Jumlah Anggota Keluarga ',0,0,'L');
	$pdf->Cell(0.8,0.4,$jmh,1,0,'L'); //data
	$pdf->Cell(1,0.4,'orang',0,0,'L'); 
	$pdf->Cell(0.5,0.4,'',0,0,'L');

	$kec=mysql_query("SELECT * from tblkecamatan where KecamatanID='$dt[kecamatan]'");
	$c=mysql_fetch_array($kec);
	$pdf->Cell(4,0.4,'Kode-Nama Kecamatan ',0,0,'L');
	$pdf->Cell(0.4,0.4,':',0,0,'L');
	$pdf->Cell(1.5,0.4,$c['KecamatanID'],1,0,'L'); //data
	$pdf->Cell(1.5,0.4,'',0,0,'L');
	$pdf->Cell(5,0.4,$c['NamaKecamatan'],1,1,'L'); //data

	$pdf->Cell(4,0.4,'Telepon ',0,0,'L');
	$pdf->Cell(0.4,0.4,':',0,0,'L');
	$pdf->Cell(9.5,0.4,$dt['telepon'],1,0,'L'); //data
	$pdf->Cell(1.5,0.4,'',0,0,'L');

	$kel=mysql_query("SELECT * from tblkelurahan where KelurahanID='$dt[desa]'");
	$l=mysql_fetch_array($kel);
	$pdf->Cell(4,0.4,'Kode-Nama Desa ',0,0,'L');
	$pdf->Cell(0.4,0.4,':',0,0,'L');
	$pdf->Cell(2,0.4,$l['KelurahanID'],1,0,'L'); //data
	$pdf->Cell(1,0.4,'',0,0,'L');
	$pdf->Cell(5,0.4,$l['NamaKelurahan'],1,1,'L'); //data

	$pdf->Cell(4,0.4,' ',0,0,'L');
	$pdf->Cell(0.4,0.4,'',0,0,'L');
	$pdf->Cell(9.5,0.4,'',0,0,'L');
	$pdf->Cell(1.5,0.4,'',0,0,'L');

	$dusun=mysql_query("SELECT * from tbldusun where DusunID='$dt[dusun]'");
	$dsn=mysql_fetch_array($dusun);
	$pdf->Cell(4,0.4,'Nama Dusun ',0,0,'L');
	$pdf->Cell(0.4,0.4,':',0,0,'L');
	$pdf->Cell(8,0.4,$dsn['NamaDusun'],1,1,'L'); //data
	
	$pdf->SetFont('Times','B','10');
	$pdf->Cell(19,0.4,'DATA KELUARGA',0,1,'L');
	$pdf->SetFont('Times','','6');
	$pdf->Cell(0.8,0.4,'No',1,0,'C');
	$pdf->Cell(6.5,0.4,'Nama Lengkap',1,0,'C');
	$pdf->Cell(4.5,0.4,'Nomor KTP/Nopen',1,0,'C');
	$pdf->Cell(8,0.4,'Alamat Sebelumnya',1,0,'C');
	$pdf->Cell(4.5,0.4,'Nomor Pasport',1,0,'C');
	$pdf->Cell(4.5,0.4,'Tanggal Berakhir Pasport',1,1,'C');
	$pdf->Cell(1,0.1,'',0,1,'C');

	$pdf->Cell(0.8,0.4,'1',1,0,'C');
	$pdf->Cell(6.5,0.4,'2',1,0,'C');
	$pdf->Cell(4.5,0.4,'3',1,0,'C');
	$pdf->Cell(8,0.4,'4',1,0,'C');
	$pdf->Cell(4.5,0.4,'5',1,0,'C');
	$pdf->Cell(4.5,0.4,'6',1,1,'C');
	$pdf->Cell(1,0.1,'',0,1,'C');

	//Colom1
	$no=1;
	$keluarga 	= mysql_query("SELECT * from tblpermohonan_kk where no_kk_kel='$dt[no_kk_kel]' ORDER BY hub_keluarga ASC");
	while($klg 	= mysql_fetch_array($keluarga))
	{
	$pdf->Cell(0.8,0.4,$no,1,0,'C');//data
	$pdf->Cell(6.5,0.4,$klg['nama_lengkap'],1,0,'L');//data
	$pdf->Cell(4.5,0.4,$klg['no_ktp'],1,0,'L');//data
	$pdf->Cell(8,0.4,$klg['alamat'],1,0,'L');//data
	$pdf->Cell(4.5,0.4,$klg['no_pasport'],1,0,'L');//data
	$pdf->Cell(4.5,0.4,$klg['tgl_akhir_pasport'],1,1,'L');//data
	
	$pdf->Cell(1,0.1,'',0,1,'C');
	$no++;
	}

	$pdf->Cell(0.8,0.4,'No','TLR',0,'C');
	$pdf->Cell(1.5,0.4,'Jenis','TLR',0,'C');
	$pdf->Cell(2,0.4,'Tempat','TLR',0,'C');
	$pdf->Cell(2,0.4,'Tgl/Bln/Thn','TLR',0,'C');
	$pdf->Cell(1,0.4,'Umur','TLR',0,'C');
	$pdf->Cell(1.5,0.4,'Akta Lahir/','TLR',0,'C');
	$pdf->Cell(2,0.4,'Kelahiran/','TLR',0,'C');
	$pdf->Cell(1.5,0.4,'Golongan','TLR',0,'C');
	$pdf->Cell(1.5,0.4,'Agama','TLR',0,'C');
	$pdf->Cell(1.5,0.4,'Status','TLR',0,'C');
	$pdf->Cell(2,0.4,'Akta Perkwn/','TLR',0,'C');
	$pdf->Cell(2.5,0.4,'Nomor Akta Perkwn/','TLR',0,'C');
	$pdf->Cell(2,0.4,'Tanggal','TLR',0,'C');
	$pdf->Cell(2,0.4,'Akta Cerai','TLR',0,'C');
	$pdf->Cell(3,0.4,'Nomor Akta Perceraian/','TLR',0,'C');
	$pdf->Cell(2,0.4,'Tanggal','TLR',1,'C');

	$pdf->Cell(0.8,0.4,'','BLR',0,'C');
	$pdf->Cell(1.5,0.4,'Kelamin','BLR',0,'C');
	$pdf->Cell(2,0.4,'Lahir','BLR',0,'C');
	$pdf->Cell(2,0.4,'Lahir','BLR',0,'C');
	$pdf->Cell(1,0.4,'','BLR',0,'C');
	$pdf->Cell(1.5,0.4,'Surat Lahir','BLR',0,'C');
	$pdf->Cell(2,0.4,'Surat Kenal Lahir','BLR',0,'C');
	$pdf->Cell(1.5,0.4,'Darah','BLR',0,'C');
	$pdf->Cell(1.5,0.4,'','BLR',0,'C');
	$pdf->Cell(1.5,0.4,'Perkawinan','BLR',0,'C');
	$pdf->Cell(2,0.4,'Buku Nikah*)','BLR',0,'C');
	$pdf->Cell(2.5,0.4,'Buku Nikah*)','BLR',0,'C');
	$pdf->Cell(2,0.4,'Perkawinan*)','BLR',0,'C');
	$pdf->Cell(2,0.4,'Perkawinan*)','BLR',0,'C');
	$pdf->Cell(3,0.4,'Surat Cerai*)','BLR',0,'C');
	$pdf->Cell(2,0.4,'Perceraian*)','BLR',1,'C');

	$pdf->Cell(0.8,0.4,'','1',0,'C');
	$pdf->Cell(1.5,0.4,'7','1',0,'C');
	$pdf->Cell(2,0.4,'8','1',0,'C');
	$pdf->Cell(2,0.4,'9','1',0,'C');
	$pdf->Cell(1,0.4,'10','1',0,'C');
	$pdf->Cell(1.5,0.4,'11',1,0,'C');
	$pdf->Cell(2,0.4,'12',1,0,'C');
	$pdf->Cell(1.5,0.4,'13',1,0,'C');
	$pdf->Cell(1.5,0.4,'14',1,0,'C');
	$pdf->Cell(1.5,0.4,'15',1,0,'C');
	$pdf->Cell(2,0.4,'16',1,0,'C');
	$pdf->Cell(2.5,0.4,'17',1,0,'C');
	$pdf->Cell(2,0.4,'18',1,0,'C');
	$pdf->Cell(2,0.4,'19',1,0,'C');
	$pdf->Cell(3,0.4,'20',1,0,'C');
	$pdf->Cell(2,0.4,'21',1,1,'C');

	$nom=1;
	$keluarga2 	= mysql_query("SELECT * from tblpermohonan_kk where no_kk_kel='$dt[no_kk_kel]' ORDER BY hub_keluarga ASC");
	while($klg2 	= mysql_fetch_array($keluarga2))
	{
	$pdf->Cell(0.8,0.4,$nom,'1',0,'C');
	if ($klg2['jenis_kelamin'] =='0')
	{
	$pdf->Cell(0.5,0.4,'0','1',0,'C');//jenis kelamin
	$pdf->Cell(0.5,0.4,'','1',0,'C');//jenis kelamin
	$pdf->Cell(0.5,0.4,'','1','0','C');//jenis kelamin
	}elseif ($klg2['jenis_kelamin'] =='1')
	{
	$pdf->Cell(0.5,0.4,'','1',0,'C');//jenis kelamin
	$pdf->Cell(0.5,0.4,'1','1',0,'C');//jenis kelamin
	$pdf->Cell(0.5,0.4,'','1','0','C');//jenis kelamin
	}

	$kabkotakk = mysql_query("SELECT  SUBSTR(NamaKabKota,5,25) as NamaKabKota,KabKotaID FROM tblkabkota where KabKotaID='$klg2[tempat_lahir]'");
	$kkk	 = mysql_fetch_array($kabkotakk);
	$umur 	=umur($klg2['tgl_lahir']);
	$pdf->Cell(2,0.4,$kkk['NamaKabKota'],'1',0,'L');
	$pdf->Cell(2,0.4,$klg2['tgl_lahir'],'1',0,'L');
	$pdf->Cell(1,0.4,$umur,'1',0,'L');
	$pdf->Cell(0.5,0.4,'','1',0,'C');//akta lahir
	$pdf->Cell(0.5,0.4,'','1',0,'C');//akta lahir
	$pdf->Cell(0.5,0.4,'','1',0,'C');//akta lahir
	$pdf->Cell(2,0.4,'',1,0,'C');
	$pdf->Cell(0.5,0.4,'','1',0,'C');//gol darah
	$pdf->Cell(0.5,0.4,'','1',0,'C');//gol darah
	$pdf->Cell(0.5,0.4,'','1',0,'C');//gol darah
	$pdf->Cell(0.5,0.4,'','1',0,'C');//agama
	$pdf->Cell(0.5,0.4,'','1',0,'C');//
	$pdf->Cell(0.5,0.4,'','1',0,'C');//
	$pdf->Cell(0.5,0.4,'','1',0,'C');//astatus
	$pdf->Cell(0.5,0.4,'','1',0,'C');//
	$pdf->Cell(0.5,0.4,'','1',0,'C');//
	$pdf->Cell(0.6,0.4,'','1',0,'C');//akta
	$pdf->Cell(0.8,0.4,'','1',0,'C');//
	$pdf->Cell(0.6,0.4,'','1',0,'C');//
	$pdf->Cell(2.5,0.4,'',1,0,'C');//tanggal
	$pdf->Cell(1.2,0.4,'',1,0,'C');
	$pdf->Cell(0.8,0.4,'',1,0,'C');
	$pdf->Cell(0.6,0.4,'','1',0,'C');//suratcerai
	$pdf->Cell(0.8,0.4,'','1',0,'C');//
	$pdf->Cell(0.6,0.4,'','1',0,'C');//
	$pdf->Cell(3,0.4,'',1,0,'C');
	$pdf->Cell(2,0.4,'',1,1,'C');
	$nom++;
	}
	$pdf->Cell(1,0.1,'',0,1,'C');//enter

	$pdf->Cell(0.8,0.4,'No','TLR',0,'C');
	$pdf->Cell(2,0.4,'Status Hub.','TLR',0,'C');
	$pdf->Cell(2,0.4,'Kelainan','TLR',0,'C');
	$pdf->Cell(2,0.4,'Penyandang','TLR',0,'C');
	$pdf->Cell(2,0.4,'Pendidikan','TLR',0,'C');
	$pdf->Cell(2,0.4,'Pekerjaaan','TLR',0,'C');
	$pdf->Cell(4,0.4,'NIK Ibu','TLR',0,'C');
	$pdf->Cell(5,0.4,'Nama Lengkap Ibu','TLR',0,'C');
	$pdf->Cell(4,0.4,'NIK Ayah','TLR',0,'C');
	$pdf->Cell(5,0.4,'Nama Lengkap Ayah','TLR',1,'C');

	$pdf->Cell(0.8,0.4,'','BLR',0,'C');
	$pdf->Cell(2,0.4,'Dlm Keluarga','BLR',0,'C');
	$pdf->Cell(2,0.4,'Fisik & Mental','BLR',0,'C');
	$pdf->Cell(2,0.4,'Cacat','BLR',0,'C');
	$pdf->Cell(2,0.4,'Terakhir','BLR',0,'C');
	$pdf->Cell(2,0.4,'','BLR',0,'C');
	$pdf->Cell(4,0.4,'','BLR',0,'C');
	$pdf->Cell(5,0.4,'','BLR',0,'C');
	$pdf->Cell(4,0.4,'','BLR',0,'C');
	$pdf->Cell(5,0.4,'','BLR',1,'C');

	$pdf->Cell(0.8,0.4,'','1',0,'C');
	$pdf->Cell(2,0.4,'22','1',0,'C');
	$pdf->Cell(2,0.4,'23','1',0,'C');
	$pdf->Cell(2,0.4,'24','1',0,'C');
	$pdf->Cell(2,0.4,'25','1',0,'C');
	$pdf->Cell(2,0.4,'26',1,0,'C');
	$pdf->Cell(4,0.4,'27',1,0,'C');
	$pdf->Cell(5,0.4,'28',1,0,'C');
	$pdf->Cell(4,0.4,'29',1,0,'C');
	$pdf->Cell(5,0.4,'30',1,1,'C');

	$nomo=1;
	$keluarga3 	= mysql_query("SELECT * from tblpermohonan_kk where no_kk_kel='$dt[no_kk_kel]' ORDER BY hub_keluarga ASC");
	while($klg3 	= mysql_fetch_array($keluarga3))
	{
	$shdk 		= mysql_query("SELECT * from tblpermohonan_kk where hub_keluarga='$klg3[hub_keluarga]'");
	$sh 		= mysql_fetch_array($shdk);

	$pdf->Cell(0.8,0.4,$nomo,'1',0,'C');
	$pdf->Cell(0.7,0.4,$sh['hub_keluarga'],'1',0,'C');//shdk
	$pdf->Cell(0.6,0.4,'','1',0,'C');//
	$pdf->Cell(0.7,0.4,'','1',0,'C');//
	$pdf->Cell(0.7,0.4,'','1',0,'C');//Kelainan Fisik
	$pdf->Cell(0.6,0.4,'','1',0,'C');//
	$pdf->Cell(0.7,0.4,'','1',0,'C');//
	$pdf->Cell(0.7,0.4,'','1',0,'C');//penyandang
	$pdf->Cell(0.6,0.4,'','1',0,'C');//
	$pdf->Cell(0.7,0.4,'','1',0,'C');//
	$pdf->Cell(0.7,0.4,$klg3['pendidikan_terakhir'],'1',0,'C');//Pendidikan
	$pdf->Cell(0.6,0.4,'','1',0,'C');//
	$pdf->Cell(0.7,0.4,'','1',0,'C');//
	$pdf->Cell(0.7,0.4,$klg3['pekerjaan'],'1',0,'C');//Pekerjaan
	$pdf->Cell(0.6,0.4,'','1',0,'C');//
	$pdf->Cell(0.7,0.4,'','1',0,'C');//

	$ibu = mysql_query("SELECT * from tblpermohonan_kk where no_kk_kel='$dt[no_kk_kel]' AND hub_keluarga='1'");
	$ib	=mysql_fetch_array($ibu);
	$pdf->Cell(4,0.4,$dt['nik_ibu'],'1',0,'L');//NikIbu
	$pdf->Cell(5,0.4,$dt['nama_ibu'],'1',0,'L');//

	$ayah = mysql_query("SELECT * from tblpermohonan_kk where no_kk_kel='$dt[no_kk_kel]' AND hub_keluarga='0'");
	$ayh		=mysql_fetch_array($ayah);
	$pdf->Cell(4,0.4,$dt['nik_ayah'],'1',0,'L');//NikAyah
	$pdf->Cell(5,0.4,$dt['nama_ayah'],'1',1,'L');//a
	$nomo++;
	}

	$pdf->Ln();
	$pdf->SetFont('Times','','9');
	$pdf->Cell(6,0.4,'Nama Ketua RT :',0,0,'L'); 
	$pdf->Cell(10,0.4,'Regristasi/Petugas',0,0,'C'); 
	$pdf->Cell(6,0.4,'Mengetahui',0,0,'C');
	$pdf->Cell(4,0.4,$l['NamaKelurahan'].", ",0,1,'C'); 

	$pdf->Cell(6,0.4,'',0,0,'L'); 
	$pdf->Cell(10,0.4,'Pencatat Data Penduduk',0,0,'C'); 
	$pdf->Cell(6,0.4,"Kepala Desa ".$l['NamaKelurahan'],0,0,'C');
	$pdf->Cell(4,0.4,"Kepala Keluarga",0,1,'C'); 

	
	$pdf->Cell(6,0.4,'Nama Ketua RW :',0,0,'L'); 
	$pdf->Cell(10,0.4,"Kepala Desa ".$l['NamaKelurahan'],0,1,'C'); 
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();

	$pdf->Cell(6,0.4,'',0,0,'L'); 
	$pdf->Cell(10,0.4,'',0,0,'C');
	$pdf->Cell(1,0.4,'',0,0,'C'); 
	$pdf->Cell(4,0.4,'','B',0,'C');
	$pdf->Cell(1,0.4,'',0,0,'C');
	$pdf->Cell(4,0.4,'','B',1,'C'); 

	$pdf->Cell(6,0.4,'Peryataan',0,1,'L'); 
	$pdf->Cell(10,0.4,'Demikian Formulir ini saya/kami isi dengan sesungguhnya. Apabila Keterangan tersebut tidak sesuai dengan',0,1,'L'); 
	$pdf->Cell(10,0.4,'keadaan sebenarnya, saya brsedia dikenakan sanksi sesuai ketentuan peraturan perundang-undangan yang berlaku',0,1,'L');
	
	$pdf->Ln();
	$pdf->output("Surat Pengantar","I");
?>
		
		