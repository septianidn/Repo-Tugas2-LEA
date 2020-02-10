<?php 
 

 
require 'functions.php';



if (isset($_POST['kembali'])) {
	
header("Location: menu.php");
exit;

}


if ($_SESSION =='' ){

		header("Location: index.php");
		exit;

}
if (isset($_POST['cetak'])){
  $_SESSION['cetak']= $_POST['cetak'];

  header("Location: cetak.php");
  exit;
}

if ($_SESSION['status'] != 'admin' AND $_SESSION['status'] != 'user'){
	header("Location: index.php");
	exit;
}


$username = $_SESSION['username'];
$history = query("SELECT * FROM sementara WHERE user = '$username' ORDER BY id ASC");

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>History</title>
 	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
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
        <a class="nav-link" href="menu.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active js-scroll-trigger">
<?php if ($_SESSION['status'] == 'admin'){
?>	 
	 

	<a class="nav-link" href="admin.php">Admin</a>


<?php } ?>      </li>

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

<br><br>


<div class="container">
 	
 	<h2 class="alert alert-primary text-center mt-4">Cart</h2>
 	<form method="post" action="">
 	<table class="table" >
 		<th>NO</th>
 		<th>Kode</th>
 		<th>Nama</th>
 		<th>Harga</th>
 		<th>Jumlah</th>
    <th>Total</th>
 		<th>Tanggal</th>
 		<th>Alamat</th>
 		<th>Aksi</th>

 		<tr>
 			<?php $i=1; ?>
 			<?php foreach ($history as $row) { ?>
 			<td><?= $i; ?></td>
 			<td><?= $row['kode']; ?></td>
 			<td><?= $row['nama']; ?></td>
 			<td><?= "Rp.". $row['harga']; ?></td>
 			<td><?= $row['jumlah']; ?></td>
      <td><?='Rp.'. $row['harga']*$row['jumlah']; ?></td>
 			<td><?= $row['tanggal']; ?></td>
 			<td><?= $row['alamat']; ?></td>
 			<td><a class="btn btn-success" href="cetak.php?id=<?= $row['id']; ?>" target="_blank" onclick="return confirm('Cetak data?')">Cetak</a>|<a href="hapuscetak.php?id=<?= $row['id']; ?>" class="btn btn-danger" name="hapus" onclick="return confirm('Hapus data?')">Hapus</a></td>
 			<?php $i++; ?>	

 		</tr>
<?php } ?>

 		
 			
 		
 		
 		



 	</table>
 	<button class="btn btn-primary" name="cetak" type="submit" onclick="return confirm('Cetak semua data?')">Cetak Semua</button>
 	<button class="btn btn-danger" href="menu.php" name="kembali">Tambah</button>
 	</form>
 </div>	
 	<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="popper.js"></script>	
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
 </body>
 </html>