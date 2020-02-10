 <?php


require_once __DIR__ . '/vendor/autoload.php';
require 'functions.php';

if (!isset($_SESSION['dari']) AND !isset($_SESSION['sampai'])) {
	header("Location: error.php");
	exit;
}

if ($_SESSION['status'] != 'admin'){
	header("Location: index.php");
	exit;
}






$dari = $_SESSION['dari'];
$sampai = $_SESSION['sampai'];

	
	
	
	
	$isi = ("SELECT * FROM fix WHERE tanggal between '$dari' AND '$sampai' ");
$rows=[];
$result = mysqli_query($conn, $isi);
 while ($njir = mysqli_fetch_assoc($result)){
 	$rows[] = $njir;
 }


// die;

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html>
<head>
	<title>Cetak PDF</title>
	<link rel="stylesheet" href="css/print.css">

</head>

<body>
	<div>
	<h1>Log Pembelian</h1>
	<hr>

	<table border="1" cellpadding="15" cellspacing="1" width="80">
 		<tr><th>NO</th>
 		<th>Kode</th>
 		<th>Nama</th>
 		<th>Harga</th>
 		<th>Jumlah</th>
 		<th>Tanggal</th>
 		<th>Alamat</th>
 		
 		</tr>';
 $i=1;
foreach ($rows as $row) {
	

 $html .= '<tr>
 			<td>'.$i++.'</td>
 			<td>'.$row["kode"].'</td>
 			<td>'.$row["nama"].'</td>
 			<td>'.$row["harga"].'</td>
 			<td>'.$row["jumlah"].'</td>
 			<td>'.$row["tanggal"].'</td>
 			<td>'.$row["alamat"].'</td>
 			</tr>';	
}
$html .= '</table>	
</div>

</body>
</html>';



$mpdf->WriteHTML($html);
$mpdf->Output();



 