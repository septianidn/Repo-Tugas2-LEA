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


// untuk mencetak otomatis kode barang
$no = mysqli_query($conn , "SELECT kode FROM stok ORDER BY kode DESC ");


$kode_barang = mysqli_fetch_array($no);


$kode = $kode_barang['kode'];

$urut = substr($kode, 7, 3);



$tambah = (int) $urut + 1;

$bln = date("m");
$thn = date("y");

if (strlen($tambah)==1){

    $format = "BRG".$bln.$thn."00".$tambah;

}
else if (strlen($tambah)==2){
$format = "BRG".$bln.$thn."0".$tambah;
}
else{
    $format = "BRG".$bln.$thn.$tambah;
}

// akhir dari proses mencetak kode barang secara otomatis



if ( isset($_POST["submit"])){
	
	
	

	//cek keberhasilan input data
	if ( tambah($_POST) > 0){
		echo "
			<script>
			alert('Data berhasil ditambahkan');
			document.location.href = 'admin.php';
			</script>
		";
	}
	else {

		echo "
			<script>
			alert('Data gagal ditambahkan');
			
			</script>
		";
	}

} ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Item</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>



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
	<h2 class="alert alert-primary text-center mt-3">Tambah Barang</h2>
	<form action="" method="post" enctype="multipart/form-data">



		<div class="form-group">
    			
    			<div class="row">
                    
                    <div class="col-md-2">
                        <label for="kode">Kode Barang</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="kode" id="kode" required class="form-control" value="<?= $format;  ?>" readonly>
                    </div>      

                </div>
            </div>


    		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="nama">Nama Barang</label>
    				</div>
    				<div class="col-md-5">
    					<input type="text" name="nama" id="nama" required class="form-control">
    				</div>		

    			</div>
    		</div>

    		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="harga">Harga</label>
    				</div>
    				<div class="col-md-5">
    					<input type="number" name="harga" id="harga" required class="form-control">
    				</div>		

    			</div>
    		</div>

    		
    		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="stok">Stok</label>
    				</div>
    				<div class="col-md-5">
    					<input type="number" name="stok" id="stok" required class="form-control">
    				</div>		

    			</div>
    		</div>
		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="gambar">Gambar</label> (2 MB)
    				</div>
    				<div class="col-md-5">
    					<input type="file" name="gambar" id="gambar" required class="form-control">
    				</div>		

    			</div>
    		</div>

					
		<button class="btn btn-primary" type="submit" name="submit">Tambah</button>
		
		</li>
	</form>		

	</div>

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="popper.js"></script>	
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>