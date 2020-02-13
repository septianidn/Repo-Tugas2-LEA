<?php


 
require 'functions.php';


if (!isset($_SESSION) ){

		header("Location: index.php");
		exit;


}


// var_dump($_SESSION);
// die;
if ($_SESSION['status'] != 'admin'){
	header("Location: error.php");
	exit;
}				
		


$isi = query("SELECT * FROM stok ORDER BY id DESC");

// cek apakah tombol cari ditekan

if ( isset($_POST["cari"])){

	$isi = cari($_POST["keyword"]);	
}
?>






<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

    <title>Admin</title>
  </head>
  <body>

  	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
	<div class="container">
  <a class="navbar-brand" href="#">Electronicash</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item ">
        <a class="nav-link " href="menu.php">Home </a>
      </li>
      <li class="nav-item active js-scroll-trigger">
<?php if ($_SESSION['status'] == 'admin'){
?>	 
	 

	<a class="nav-link" href="admin.php">Admin <span class="sr-only">(current)</span></a>


<?php } ?>      </li>
	
	<li class="nav-item js-scroll-trigger">
        <a class="nav-link" href="laporan.php">Laporan</a>
      </li>

      <li class="nav-item js-scroll-trigger">
        <a class="nav-link" href="history.php">Cart</a>
      </li>
      <li class="nav-item js-scroll-trigger">
        <a class="nav-link" href="logout.php">Log out</a>
      </li>

     
    </ul>
  </div>
  </div>
</nav>
<br><br><br>
    

<div class="container">


    
	 
	
	<form action="" method="post">
		<input type="text" name="keyword" size="40" placeholder="Masukkan keyword pencarian...">
		<button class="btn btn-light" type="submit" name="cari">Cari</button>
		
	</form>

<br>
	<table class="table">
		<th>No</th>
		<th>Kode Item</th>
		<th>Nama</th>
		<th>Harga</th>
		<th>Stok</th>
		<th>Gambar</th>
		<th>Aksi</th>

		<?php $i=1; ?>
		<?php foreach($isi as $row) : ?>
		 <tr>
			<td><?= $i;?></td>
			<td><?= $row['kode']; ?></td>
			<td><?= $row['nama']; ?></td>
			<td><?='Rp.'. $row['harga']; ?></td>
			<td><?= $row['stok']; ?></td>
			<td><img src="img/<?= $row['gambar']; ?>" width="50"></td>
			<td> <a class="btn btn-primary" href="ubah.php?id=<?= $row['id']; ?>">Ubah</a> | <a class="btn btn-danger" href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Data yang anda pilih akan dihapus\nApakah anda yakin?');">Hapus</a></td>
			<?php $i++; ?>
		</tr>
	<?php endforeach; ?>
	</table>
<div>
<a class="btn btn-success" href="tambah.php">Tambah Item</a>
</div>


</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="popper.js"></script>	
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>


 