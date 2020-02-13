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

$id = $_GET["id"];

if (hapus($id) > 0){

	echo "
			<script>
			alert('Data berhasil dihapus');
			document.location.href = 'admin.php';
			</script>
		";
}

else {

"
			<script>
			alert('Data gagal dihapus');
			document.location.href = 'admin.php';
			</script>
		";

} ?>