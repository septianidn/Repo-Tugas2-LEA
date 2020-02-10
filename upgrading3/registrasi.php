<?php 
require 'functions.php';

if (isset($_SESSION['status'])){
	

	$_SESSION = $status;
	header("Location: menu.php");
	 exit;
}

if (isset($_POST["regis"])){

	if ( registrasi($_POST)> 0){
		echo "<script>
		alert('registrasi berhasil!');
		</script>";
		header("Location: index.php");
		exit;
	}
	else{
		echo mysqli_error($conn);
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registrasi User</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<style type="text/css">
			.container{
			width: 30%;
			margin-top: 9%;
			box-shadow: 0 3px 20px rgba(0,0,0,0.4);
			padding: 50px;
		}
		input{
			font-size: 20px;
		}
		</style>

</head>

<body>


<div class="container">
		<h4 class="text-center">Halaman Login</h4>
		<hr>

	
	<form action="" method="post">
		<div class="form-group">
			<label for="username">Username</label>
		<input type="text" name="username" id="username" autocomplete="off" class="form-control" placeholder="Masukkan Usernma Anda...">

		</div>
		<div class="form-group">
			<label for="password">Password</label>
		<input type="password" name="password" id="password" autocomplete="off" class="form-control" placeholder="Masukkan Password Anda...">

		</div>
		
		<div class="form-group">
			
						<label for="password2">Konfirmasi Password</label>
				

			
						<input type="password" name="password2" id="password2" autocomplete="off" class="form-control " placeholder="Konfirmasi password anda...">	
			

			</div>
		

	<button class="btn btn-primary" type="submit" name="regis">Registrasi Akun</button>
	<a href="index.php" class="btn btn-danger" style="width: 45%;">Kembali</a>
	
	</form>
</div>




		
		
		
	
	
	<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="popper.js"></script>	
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>