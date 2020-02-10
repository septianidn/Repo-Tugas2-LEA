<?php 
//koneksi ke database

$conn = mysqli_connect("localhost", "root", "", "elektronik");

//ambil data dari tabel stok
$result = mysqli_query($conn, "SELECT * FROM stok");

if ( !$result){
	echo mysqli_error($conn);
}

//ambil data (fetch) stok dari object result

//while ($stok = mysqli_fetch_assoc($result)){
// var_dump($stok);
// }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Toko Elektronik</title>
</head>
<body>
	<h1>Toko Elektronik</h1>

<a href="tambah.php">Tambah Item</a>
	<table border="1" cellpadding="10" cellspacing="0">
		<th>No</th>
		<th>Kode Item</th>
		<th>Nama</th>
		<th>Harga</th>
		<th>Stok</th>
		<th>Gambar</th>
		<th>Aksi</th>

		<?php $i=1; ?>
		<?php while ( $row = mysqli_fetch_assoc($result)) : ?>
		<tr>
			<td><?= $i;?></td>
			<td><?= $row["kode"];?></td>
			<td><?= $row["nama"];?></td>
			<td><?= $row["harga"];?></td>
			<td><?= $row["stok"];?></td>
			<td><img src="<?= $row["gambar"];?>" width="50"></td>
			<td> <a href="ubah.php">Ubah</a> | <a href="hapus.php">Hapus</a></td>
			<?php $i++; ?>
		</tr>
	<?php endwhile; ?>
	</table>

</body>
</html>
