<?php 
session_start();
//koneksi ke database

$conn = mysqli_connect("localhost", "root", "", "elektronik");




function query($query){
	global $conn;
	//ambil data dari tabel stok
$result = mysqli_query($conn, $query);
$rows = [];
while ( $row = mysqli_fetch_assoc($result)) {

	$rows[] = $row;
}
return $rows; 
}


function tambah ($data){
	global $conn;

	$kode = htmlspecialchars($data["kode"]);
	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);
	$stok = htmlspecialchars($data["stok"]);

	//jalankan upload gambar

	$gambar = upload();

	if ( !$gambar){
		return false;
	}

	//query insert data
	$query = "INSERT INTO stok
					VALUES 
					('','$kode','$nama','$harga','$stok','$gambar')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload(){

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload

	if ( $error === 4){

		echo "<script>
			alert('Pilih gambar terlebih dahulu!');
			</script>	";
			return false;
		}
	//cek apakah yang di upload memang gambar 
	$ekstensigambarvalid = ['jpeg','jpg','png'];
	$ekstensigambar = explode('.', $namaFile);
	$ekstensigambar = strtolower(end($ekstensigambar));

	if ( !in_array($ekstensigambar, $ekstensigambarvalid)){
		echo "<script>
			alert('Yang anda upload bukan gambar');
			</script>	";
			return false;
	}

	//cek apakah ukuran gambar besar

	if ($ukuranFile > 2000000){
		echo "<script>
			alert('Ukuran gambar terlalu besar!');
			</script>	";
			return false;

	}	

	//jika lolos syarat upload file
	//mengubah nama file

	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $ekstensigambar;

	move_uploaded_file($tmpName, 'img/' . $namafilebaru);

	return $namafilebaru;
}

function hapus($id){

global $conn;
mysqli_query($conn, "DELETE FROM stok WHERE id = $id");
return mysqli_affected_rows($conn);
}

function hapus2($history, $id){

global $conn;
$kode=$history[0]['kode'];
$nama=$history[0]['nama'];
$harga=$history[0]['harga'];
$jumlah=$history[0]['jumlah'];
$tanggal=$history[0]['tanggal'];
$alamat=$history[0]['alamat'];
mysqli_query($conn, "UPDATE sementara
					SET 
					kode = '$kode',
					nama = '$nama',
					harga = '$harga',
					jumlah = '$jumlah',
					tanggal = '$tanggal',
					alamat = '$alamat',
					status = 'Dicetak'
 WHERE id = $id");
return mysqli_affected_rows($conn);
}





function ubah($data){
	global $conn;

	$id = $data["id"];
	$kode = htmlspecialchars($data["kode"]);
	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);
	$stok = htmlspecialchars($data["stok"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah user upload gambar baru atau tidak
	if ( $_FILES['gambar']['error'] === 4){
		$gambar = $gambarLama;
	} else {
		$gambar = upload();



	}

	//query insert data
	$query = "UPDATE stok SET
				kode = '$kode',
				nama = '$nama',
				harga = '$harga',
				stok = '$stok',
				gambar = '$gambar'
				WHERE id = '$id'
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
} 

function cari($keyword){
	$query = "SELECT * FROM stok
				WHERE
				nama LIKE '%$keyword%' OR
				kode LIKE '%$keyword%' OR
				stok LIKE '%$keyword%' OR
				harga LIKE '%$keyword%' 
				";

return query($query);				

}

function registrasi($data)
{
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_escape_string($conn, $data["password"]);
	$password2 = mysqli_escape_string($conn, $data["password2"]);


// cek username apakah sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
	
	if (mysqli_fetch_assoc($result) > 0){
		echo "<script>
			alert('Username sudah terdaftar!');
			</script>";

			return false;
	}

	// cek konfirmasi password

	if ($password !== $password2){
		echo "<script>
		alert('Konfirmasi password tidak sesuai');
		 	</script>";

		 	return false;
	}

	//enkripsi password

	$password = password_hash($password, PASSWORD_DEFAULT);

	//insert ke database

	mysqli_query($conn, "INSERT INTO user VALUES ('','$username','$password','user')");

	return mysqli_affected_rows($conn);
}




function bayar($item,$data){
	global $conn;
	global $_SESSION;

	$kodeS=$item["kode"];
	$namaS=$item["nama"];
	$hargaS=$item["harga"];
	$alamat=$data["alamat"];
	$jumlahS=$data["jumlah"];
	$username = $_SESSION['username'];
	$sementara = "INSERT INTO sementara VALUES 
		('','$kodeS','$namaS','$hargaS','$jumlahS','".date('d-m-Y')."','$alamat','$username','Belum dicetak')";

	mysqli_query($conn, $sementara);
	
	return mysqli_affected_rows($conn);

	
}























?>