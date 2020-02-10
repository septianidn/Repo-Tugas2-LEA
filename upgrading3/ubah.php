<?php 
 
require 'functions.php';

if (!isset($_SESSION) ){

		header("Location: index.php");
		exit;

}

if ($_SESSION['status'] != 'admin'){
	header("Location: error.php");
	exit;
}

if ( !isset($_GET["id"]) OR $_SESSION ==''){

	header("Location: admin.php");
	exit;
}
//ambil data id dari url

$id = $_GET["id"];

//query data stok berdasarkan id

$item = query("SELECT * FROM stok where id = $id")[0];


if ( isset($_POST["submit"])){

	//cek keberhasilan input data
	if ( ubah($_POST) > 0){
		echo "
			<script>
			alert('Data berhasil diubah');
			document.location.href = 'admin.php';
			</script>
		";
	}
	else {

		echo "
			<script>
			alert('Data gagal diubah');
			
			</script>
		";
	}

} ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

    <title>Ubah Item</title>
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
    	<h2 class="alert alert-primary text-center mt-3">Ubah Data Barang</h2>

    	<form action="" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="id" value="<?= $item["id"];  ?>">
		<input type="hidden" name="gambarLama" value="<?= $item["gambar"];  ?>">
    		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="kode">Kode Barang</label>
    				</div>
    				<div class="col-md-5">
    					<input class="form-control" type="text" name="kode" id="kode" required value="<?= $item["kode"]; ?>">
    				</div>		

    			</div>
    		</div>
		
		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="nama">Nama Barang</label></div>
    				<div class="col-md-5">
    					<input class="form-control" type="text" name="nama" id="nama" required value="<?= $item["nama"]; ?>">
    				</div>		

    			</div>
    		</div>



    		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="harga">Harga</label>
    				</div>
    				<div class="col-md-5">
    					<input class="form-control" type="text" name="harga" id="harga" required value="<?= $item["harga"]; ?>">
    				</div>		

    			</div>
    		</div>
		

    		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="stok">Stok</label>
    				</div>
    				<div class="col-md-5">
    					<input class="form-control" type="text" name="stok" id="stok" required value="<?= $item["stok"]; ?>">
    				</div>		

    			</div>
    		</div>

		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="gambar">Gambar</label>
    				</div>
    				<div class="col-md-5">
    					<img src="img/<?= $item['gambar'];?>" width="40"><br>
						<input type="file" name="gambar" id="gambar" class="form-control">
    				</div>		

    			</div>
    		</div>

					
		<button type="submit" name="submit" class="btn btn-primary col-md-1">Ubah</button>
		<a class="btn btn-danger" href="admin.php">Kembali</a>
		
		
	</form>	
    </div>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="popper.js"></script>	
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>