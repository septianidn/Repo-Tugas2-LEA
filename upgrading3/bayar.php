<?php 

 
require 'functions.php'; 



if (!isset($_SESSION) ){

        header("Location: index.php");
        exit;}

if ($_SESSION['status']== 'admin'){
        header("Location: admin.php");
    } 


if ( isset($_GET["id"]) AND $_SESSION !=='')   {

	 


//ambil data id dari url

$id = $_GET["id"];

// $jumlah = $_POST["jumlah"];
// var_dump($jumlah); 
// die;
//query data stok berdasarkan id

$item = query("SELECT * FROM stok where id = $id")[0];
$stok = query("SELECT stok FROM stok WHERE id = $id");


$false = false;

            

            if (isset($_POST['bayar']) ) {
    

    

    







    

 if ($_POST['jumlah']>$item['stok'])  {
    echo "<script>
    alert('Stok tidak mencukupi');
    </script>";
}

    else if (bayar($item,$_POST)>0){
$c=0;
        if ($c >= 0 ){

            $updatestok = $stok[0]['stok'] - $_POST['jumlah'];

            
            $queryupdate = "UPDATE stok SET stok = '$updatestok' WHERE id = '$id'"; 

            mysqli_query($conn, $queryupdate);

            $nama = $item['nama'];
            $kode = $item['kode'];
            $harga = $item['harga'];
            $jumlah = $_POST['jumlah'];
            $alamat = $_POST['alamat'];
            $username = $_SESSION['username'];

            $query = "INSERT INTO fix VALUES ('', '$kode','$nama','$harga','$jumlah', '".date('Y-m-d')."','$alamat','$username')";
            mysqli_query($conn,$query);

            
    echo "<script>
    alert('Data disimpan');
    document.location.href='history.php';
    </script>";
    return $conn;}

    else{

        echo "<script>
    alert('Nominal yang anda masukkan tidak cukup!!!');
    </script>";}

    }

// }

}

}



// $sementara = mysqli_query($conn, "INSERT INTO sementara VALUES ('','' )")
// if ( isset($_POST["update"])){

// 	$s = $_POST['jumlah']*$item['harga'];

	//cek keberhasilan input data
	// if ( ubah($_POST) > 0){
	// 	echo "
	// 		<script>
	// 		alert('Data berhasil diubah');
	// 		document.location.href = 'admin.php';
	// 		</script>
	// 	";
	// }
	// else {

	// 	echo "
	// 		<script>
	// 		alert('Data gagal diubah');
			
	// 		</script>
	// 	";
	// }



else {
    header("Location: menu.php");
     exit;
}







 ?>

<!DOCTYPE html>
<html>
<head>
	
	<title>Ubah Item</title>
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
      <li class="nav-item js-scroll-trigger">
<?php if ($_SESSION['status'] == 'admin'){
?>	 
	 

	<a class="nav-link" href="admin.php">Admin</a>


<?php } ?>      
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

<br><br>


	
<div class="container">
		<h2 class="alert alert-primary text-center mt-3">Ubah Data Barang</h2>

	<form action="" method="post" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $item["id"];  ?>">
<input type="hidden" name="gambarLama" value="<?= $item["gambar"];  ?>">


<?php 
			 
			 $c =0;
		 	$s = $item["harga"]*$item["stok"]; 
		   ?>


		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="kode">Kode Barang</label></div>
    				<div class="col-md-5">
    					<input class="form-control" type="text" name="kode" id="kode" required value="<?= $item["kode"]; ?>" readonly="true">
    				</div>		

    			</div>
    		</div>



    		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="nama">Nama Barang</label></div>
    				<div class="col-md-5">
    					<input class="form-control" type="text" name="nama" id="nama" required value="<?= $item["nama"]; ?>" readonly="true">
    				</div>		

    			</div>
    		</div>


    		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="harga">Harga Barang</label></div>
    				<div class="col-md-5">
    					<input class="form-control" type="text" name="harga" id="harga" required value="<?='Rp.'. $item["harga"]; ?>" readonly="true">
    				</div>		

    			</div>
    		</div>

    		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="stok">Stok Barang</label></div>
    				<div class="col-md-5">
    					<input class="form-control" type="text" name="stok" id="stok" required value="<?= $item["stok"]; ?>" readonly="true">
    				</div>		

    			</div>
    		</div>

    		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="jumlah">Jumlah Barang</label></div>
    				<div class="col-md-5">
    					<input class="form-control" type="number" min="1"

    					
    					 	 	

    					 	
    					 	 


    					 	name="jumlah" required>
    				</div>		

    			</div>
    		</div>

    		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-2">
    					<label for="alamat">Alamat</label></div>
    				<div class="col-md-5">
    					<input class="form-control" type="text" name="alamat" id="alamat" required <?php if (isset($_POST['update'])){?> value="<?= $_POST['alamat'];  ?>" <?php } ?>

    					>
    				</div>		

    			</div>
    		</div>

    		
    		



    		

    		
    		



		
		
		
		

		 	



 		<?php if ( isset($_POST["update"])){

	$s = $_POST['jumlah']*$item['harga'];

} ?>
 			

		<!-- <img src="<?= $item['gambar'];?>" width="100"><br>
			
		<label for="kode">Kode Barang</label>
		<input type="text" name="kode" id="kode" required value="<?= $item["kode"]; ?>" readonly="true">
		

			
		<label for="nama">Nama Barang</label>
		<input type="text" name="nama" id="nama" required value="<?= $item["nama"]; ?>" readonly="true">
		

			
		<label for="harga">Harga</label>
		<input type="text" name="harga" id="harga" required value="<?= $item["harga"]; ?>" readonly="true">
		

			
		<label for="stok">Stok</label>
		<input type="text" name="stok" id="stok" required value="<?= $item["stok"]; ?>" readonly="true">
		

			
		<label for="stok">Jumlah</label>
		<input type="text" name="jumlah" id="jumlah" required placeholder="Jumah yang akan dibeli"> -->
				
		
					
		
			<button class="btn btn-primary" type="submit" name="bayar">Bayar</button>
		<a class="btn btn-danger" href="index.php">Kembali</a>

	</form>		
		<br><br>
		
		

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="popper.js"></script>	
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php  










?>