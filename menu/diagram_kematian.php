<?php

//Akses tanpa login
if (!isset($_SESSION['username'])) {
		echo '<script>alert("PERHATIAN!! Silahkan Login Dulu!")</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		header('location:../index.php');
	}
include "library/koneksi.php";

$aktifitas="User $_SESSION[username] Melihat Diagram Kematian";
        include"key_log.php";

$query   = "SELECT distinct(LEFT(TglKematianJenazah,4)) as thn, count(LEFT(TglKematianJenazah,4)) as jmh FROM tblkematian GROUP BY LEFT(TglKematianJenazah,4)";        
$query_jumlah = mysql_query( $query ) or die(mysql_error());
?>
 <html>
  <head>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
  var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'diagram',
            type: 'column'
         },   
         title: {
            text: 'Grafik Kematian Berdasarkan Tahun Kematian'
         },
         xAxis: {
            categories: ['Tahun']
         },
         yAxis: {
            title: {
               text: 'Jumlah Kematian'
            }
         },
              series:             
            [
           <?php

while ($ret = mysql_fetch_array($query_jumlah)) {
    $nama = $ret['thn'];
    $jumlah_kunjungan = $ret['jmh'];
    ?>
                        {
                            name: '<?php echo $nama; ?>',
                            data: [<?php echo $jumlah_kunjungan; ?>]
                        },
<?php 
} 
?>
            ]
        });
    }); 
        </script>
</script>
  </head>
  <body>
   <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Diagram Kematian Penduduk</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
    <div id='diagram'></div>    
    <p><h4>Rincian Data Kematian Penduduk</h4></p>
    <div class="box-body table-responsive">
      <table class="table table-bordered">
         <thead>
            <tr>
      <th>No</th>
      <th>Tahun Lahir</th>
      <th>Total Kematian</th>
      <th>Jumlah Laki-Laki</th>
      <th>Jumlah Perempuan</th>
          </tr>
            </thead>
            <tbody>
    <?php
    $no=1;
    $totpen =0;
    $totlaki=0;
    $totpr=0;
    $data =mysql_query("SELECT distinct(LEFT(TglKematianJenazah,4)) as thn, count(LEFT(TglKematianJenazah,4)) as jmh FROM tblkematian GROUP BY LEFT(TglKematianJenazah,4)");
    while ($dt =mysql_fetch_array($data))
    {
       $datalaki =mysql_query("SELECT distinct(LEFT(TglKematianJenazah,4)) as thn, count(LEFT(TglKematianJenazah,4)) as jmh FROM tblkematian where LEFT(TglKematianJenazah,4)='$dt[thn]' AND JenisKelaminJenazah ='0' GROUP BY LEFT(TglKematianJenazah,4)");
        $dtlk =mysql_fetch_array($datalaki);
        $datapr =mysql_query("SELECT distinct(LEFT(TglKematianJenazah,4)) as thn, count(LEFT(TglKematianJenazah,4)) as jmh FROM tblkematian where LEFT(TglKematianJenazah,4)='$dt[thn]' AND JenisKelaminJenazah ='1' GROUP BY LEFT(TglKematianJenazah,4)");
        $dtpr =mysql_fetch_array($datapr);
      echo"<tr><td>$no</td>
              <td>$dt[thn]</td>
              <td><span class='badge bg-red'>$dt[jmh]</span></td>
              <td><span class='badge bg-light-blue'>$dtlk[jmh]</span></td>
              <td><span class='badge bg-green'>$dtpr[jmh]</span></td>
              </tr>";
        $totpen  +=$dt['jmh'];
    $totlaki +=$dtlk['jmh'];
     $totpr  +=$dtpr['jmh'];
    $no++;
    }
    echo"<tr><td colspan=2>Jumlah Total Kematian</td>
              <td><span class='label label-danger'>$totpen</span></td>
              <td><span class='label label-primary'>$totlaki</span></td>
              <td><span class='label label-success'>$totpr</span></td></tr>";
    echo"</tbody></table>";
?>
</div></div>   
  </body>
</html>