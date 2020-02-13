<?php

 
require 'functions.php';

// redirect jika session kosong
// if ($_SESSION[0] =='' ){

// 		header("Location: index.php");
// 		die;



if ( !$_SESSION['status'] ){
	

	header("Location: index.php");
	exit;
}

if ($_SESSION['status']== 'admin'){
		header("Location: admin.php");
	}


// if (isset($_POST["cart"])){

// 	var_dump($_POST["cart"]);
// 	die;
// }

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

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

    <title>Toko Elektronik</title>
    <style type="text/css">
    	table {

		text-align: center;
		
		    	}
		  .card img{
		  	display: inline-block;
		  	width: 150px;
		  	height: 150px;
		  	margin-left: 20%;
		  	margin-top: 5%;
		  }  	
		  .row a{
		  	text-decoration: none;
		  } 	
    </style>
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
      <li class="nav-item active">
        <a class="nav-link" href="menu.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item js-scroll-trigger">
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















	
<br><br><br>

	
	 <!-- <div class="container"> -->
	<!-- <h1>Toko Elektronik</h1> -->
	

<br><!-- <form action="bayar.php" method="post">
	<table class="table" border="1" cellpadding="10" cellspacing="0">
		<th scope="col">No</th>
		<th scope="col">Kode Item</th>
		<th scope="col">Nama</th>
		<th scope="col">Harga</th>
		<th scope="col">Stok</th>
		<th scope="col">Gambar</th>
		<th scope="col">Aksi</th>

		<?php $i=1; ?>
		<?php foreach($isi as $row) : ?>
		 <tr>
			<td scope="row"><?= $i;?></td>
			<td><?= $row['kode']; ?></td>
			<td><?= $row['nama']; ?></td>
			<td><?='Rp.'. $row['harga']; ?></td>
			<td><?= $row['stok']; ?></td>
			<td><img src="img/<?= $row['gambar']; ?>" width="50"></td>
			<td><a class="btn btn-primary" href="bayar.php?id=<?= $row['id']; ?> &action=add">Beli</a></td>
			<?php $i++; ?>
		</tr>
	<?php endforeach; ?>
	</table>
	</form>
	</div>
	<br><br> -->

<div class="container">
	<form action="" method="post">
		<input type="text" name="keyword" size="40" placeholder="Masukkan keyword pencarian...">
		<button class="btn btn-light" type="submit" name="cari">Cari</button>
		
	</form>
	<br>
	<div class="row">
		<?php foreach ($isi as $row) { ?>
		<a href="bayar.php?id=<?= $row['id']; ?>"><div class="col-md-3 mt-3">
				<div class="card">
			  <img src="img/<?= $row['gambar']; ?>" class="card-img-top" alt="..." >
			  <div class="card-body">
			    <h5 class="card-title m-1 text-warning"><?= $row['nama']; ?></h5>
			    <p class="card-text m-1 text-secondary"><?= $row['kode'].'-'.$row['nama']; ?></p>
			    <a href="bayar.php?id=<?= $row['id']; ?>" class="btn btn-primary"><?= 'Rp.'.$row['harga']; ?></a>
			    <a href="bayar.php?id=<?= $row['id']; ?>" class="btn btn-success"><?= $row['stok']; ?></a>
			  </div>
			</div>
		</div>
		</a>
	<?php } ?>
	</div>
</div>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


    <script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="popper.js"></script>	
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>