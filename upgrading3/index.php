<?php

 require 'functions.php';


//cek cookie
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])){
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	$result = mysqli_query($conn, "SELECT username FROM user WHERE 
		id = $id");
	
	$row = mysqli_fetch_assoc($result);

$hasil = mysqli_query($conn, "SELECT status FROM user WHERE id ='$id'");
$status = mysqli_fetch_assoc($hasil);
	//cek cookie dan username

	if ($key===hash('sha256', $row['username'])){

		$_SESSION['login'] = $status;

	}
}




if (isset($_SESSION['status'])){
	

	$_SESSION = $status;
	header("Location: menu.php");
	 exit;
}



 if (isset($_POST["login"]))
 {

 	$username = $_POST["username"];
 	$password = $_POST["password"];
 	
 $result=mysqli_query($conn, "SELECT * FROM user WHERE 
 		username = '$username'");
$hasil = mysqli_query($conn, "SELECT status FROM user WHERE username ='$username'");
$status = mysqli_fetch_assoc($hasil);
 
//cek username

 	if (mysqli_num_rows($result) === 1){

 		//cek password

 		$row = mysqli_fetch_assoc($result);



 		if (password_verify($password, $row["password"])){
 			//cek session

 			$_SESSION = base64_encode($status);
 			$_SESSION['username'] = $_POST['username'];
var_dump($_SESSION); die;
 			// cek cookie
 			if (isset($_POST["cek"])){
 				//buat cookie
 				setcookie('id', $row["id"], time()+600);
 				setcookie('key', hash('sha256', $row["username"]), time()+600);
 			}
 			header("Location: menu.php");
 			exit;
 		}

 	}

 	$error = true;
 }


  ?>



<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		
		.container{
			width: 30%;
			margin-top: 9%;
			box-shadow: 0 3px 20px rgba(0,0,0,0.4);
			padding: 50px;
		}
		.cek {
			float: left;
		}
	</style>
</head>

<body>
	
	

<?php if (isset($error)){ ?>
	<div class="alert alert-danger alert-dismissable fade show" style="width: 50%; margin: auto; margin-top: 5%;">Username / Password anda salah!
		
	</div>
<?php } ?>





<div class="container">
		<h4 class="text-center">Halaman Login</h4>
		<hr>

	
	<form action="" method="post">
		<div class="form-group">
			<label for="username">Username</label>
		<input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username Anda..." autocomplete="off">

		</div>
		<div class="form-group">
			<label for="password">Password</label>
		<input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Anda..." autocomplete="off">

		</div>
		
		<div class="form-group">
			
			<div class="row">
				<div class="col-md-2">
						<input type="checkbox" name="cek" id="cek" class="form-control col">
				</div>

			<div class="col-md-9">
						<label for="cek" style="margin-top: 5px; margin-left: -20px;">Ingat Saya?</label>	
			</div>

			</div>
		</div>			
		
		<div class="form-group">
			<button type="submit" name="login" class="btn btn-primary" style="width: 48%;">Log In</button>
			<a href="registrasi.php" class="btn btn-success " style="width: 48%;">Buat Akun!</a>
		</div>

	
	
	</form>
</div>	
	
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="popper.js"></script>	
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>