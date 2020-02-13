<?php 

 require 'functions.php';


if (!isset($_SESSION) ){

		header("Location: index.php");
		exit;

}

if ($_SESSION['status'] == NULL){
	header("Location: error.php");
	exit;
}

$id = $_GET["id"];



$history = query("SELECT * FROM sementara WHERE id = '$id' " );


if (hapus2($history, $id) > 0){

	echo "
			<script>
			alert('Data berhasil dihapus');
			document.location.href = 'history.php';
			</script>
		";
}

else {

"
			<script>
			alert('Data gagal dihapus');
			document.location.href = 'history.php';
			</script>
		";

} ?>