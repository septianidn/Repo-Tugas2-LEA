<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'functions.php';




if ($_SESSION['status'] != 'admin' AND $_SESSION['status'] != 'user'){
	header("Location: index.php");
	exit;
}

if (isset($_GET['id'])){


$id = $_GET['id'];
$history = query("SELECT * FROM sementara 
				WHERE id = '$id' 
				ORDER BY id ASC");



$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html>
<head>
	<title>Cetak PDF</title>
</head>
<link rel="stylesheet" href="css/print.css"
<body>
	<h1>Log Pembelian</h1>

	<table border="1" cellpadding="10" cellspacing="0">
 		<tr><th>NO</th>
 		<th>Kode</th>
 		<th>Nama</th>
 		<th>Harga</th>
 		<th>Jumlah</th>
 		<th>Total</th>
 		<th>Tanggal</th>
 		<th>Alamat</th>
 		
 		</tr>';
 $i=1;
foreach ($history as $row) {
	

 $html .= '<tr>
 			<td>'.$i.'</td>
 			<td>'.$row["kode"].'</td>
 			<td>'.$row["nama"].'</td>
 			<td>'.$row["harga"].'</td>
 			<td>'.$row["jumlah"].'</td>
 			<td>'.$row["harga"]*$row["jumlah"].'</td>
 			<td>'.$row["tanggal"].'</td>
 			<td>'.$row["alamat"].'</td>
 			</tr>';	  
}
$html .= '</table>	

</body>
</html>';



$mpdf->WriteHTML($html);
$mpdf->Output();







}
else if (isset($_SESSION['cetak'])){

	$username= $_SESSION['username'];

$history = query("SELECT * FROM sementara WHERE user = '$username'
				ORDER BY id ASC");


$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html>
<head>
	<title>Cetak PDF</title>
	<link rel="stylesheet" href="css/print.css"
</head>

<body>
	<h1>Log Pembelian</h1>

	<table border="1" cellpadding="10" cellspacing="0">
 		<tr><th>NO</th>
 		<th>Kode</th>
 		<th>Nama</th>
 		<th>Harga</th>
 		<th>Jumlah</th>
 		<th>Total</th>
 		<th>Tanggal</th>
 		<th>Alamat</th>
 		
 		</tr>';
 $i=1;
foreach ($history as $row) {
	

 $html .= '<tr>
 			<td>'.$i++.'</td>
 			<td>'.$row["kode"].'</td>
 			<td>'.$row["nama"].'</td>
 			<td>'.$row["harga"].'</td>
 			<td>'.$row["jumlah"].'</td>
 			<td>'.$row["harga"]*$row["jumlah"].'</td>
 			<td>'.$row["tanggal"].'</td>
 			<td>'.$row["alamat"].'</td>
 			</tr>';	
}
$html .= '</table>	

</body>
</html>';



$mpdf->WriteHTML($html);
$mpdf->Output();







}
?>

  