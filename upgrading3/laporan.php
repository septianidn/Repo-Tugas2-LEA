<?php 

require 'functions.php';

if ($_SESSION['status'] != 'admin'){
	header("Location: index.php");
	exit;
}

if (isset($_POST['cetak'])) {

	$dari = $_POST['dari'];
	$sampai = $_POST['sampai'];
	$isi = query("SELECT tanggal FROM fix WHERE tanggal BETWEEN '$dari' AND '$sampai'");
	
	$_SESSION['dari'] = $isi;


	$arr1 = explode("-", $_POST['dari']);
	$arr2 = explode("-", $_POST['sampai']);

	
	if ($isi==NULL){

		echo "<script>
		alert('Data tidak ditemukan!');
		document.location.href='laporan.php';
		</script>";
		return false;
		

	}



	for ($a=0; $a<=2; $a++){
	if ($arr1[$a]=='' OR $arr2[$a]==''){
		echo "<script>
		alert('Masukan Format tanggal');
		document.location.href='laporan.php';
		</script>";
		return false;

	}
}

	
	

	if ($arr1[2]>$arr2[2]){
		echo "<script>
		alert('Masukan Tanggal dengan benar');
		</script>";
		
	}

	else if ($arr1[1]>$arr2[1]){
		echo "<script>
		alert('Masukan Bulan dengan benar');
		
		</script>";
		
	}

	else if ($arr1[0]>$arr2[0]){
		echo "<script>
		alert('Masukan Tahun dengan benar');
		
		</script>";
		
	}

	 


	else {

	$_SESSION['dari'] = $_POST['dari'];	
	$_SESSION['sampai'] = $_POST['sampai'];			

		header("Location: cetaklaporan.php");
		exit;
	}


	
}




 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

	
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
	<div class="container">
  <a class="navbar-brand" href="menu.php">Electronicash</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item ">
        <a class="nav-link " href="menu.php">Home </a>
      </li>
      <li class="nav-item js-scroll-trigger">
<?php if ($_SESSION['status'] == 'admin'){
?>	 
	 

	<a class="nav-link" href="admin.php">Admin <span class="sr-only">(current)</span></a>


<?php } ?>      </li>

	<li class="nav-item js-scroll-trigger">
        <a class="nav-link" href="history.php">Cart</a>
      </li>
	
	<li class="nav-item active js-scroll-trigger">
        <a class="nav-link" href="laporan.php">Laporan</a>
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
	<h2 class="alert alert-primary text-center mt-4">Cetak Laporan Keuangan</h2>
	<form method="post" action="">

		<div class="form-group">
    			
    			<div class="row">
    				
    				<div class="col-md-4">
    					<input class="form-control" type="date" name="dari">
    				</div>
    				<div class="col-md-2">
    					<center>s.d</center>
    				</div>
    				<div class="col-md-4">
    					<input class="form-control" type="date" name="sampai">
    				</div>
    				<div class="col-md-2">
    					<button class="form-control btn btn-success" type="submit" name="cetak">
					Cetak
				</button>
    				</div>		

    			</div>
    		</div>
				
			
				
			
				
			
				
			
	</form>
	</div>

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="popper.js"></script>	
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>