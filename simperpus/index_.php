

<?php 
// berfungsi mengaktifkan session
session_start();
 
// berfungsi menghubungkan koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "simperpus_db";

$con = mysqli_connect($host,$user,$pass,$db);

if (!$con) {
	die("Koneksi gagal:".mysqli_connect_error());
}
 
// berfungsi menangkap data yang dikirim
$user = $_POST['username'];
$pass = md5($_POST['password']);
 
// berfungsi menyeleksi data user dengan username dan password yang sesuai
$sql = mysqli_query($con,"SELECT * FROM user WHERE username='$user' AND password='$pass'");
//berfungsi menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($sql);

// berfungsi mengecek apakah username dan password ada pada database
if($cek > 0){
	$data = mysqli_fetch_assoc($sql);

	// berfungsi mengecek jika user login sebagai admin
	if($data['level']=="admin"){
		// berfungsi membuat session
		$_SESSION['nama'] =  $data['nama_lengkap'];
		$_SESSION['level'] = "admin";
		//berfungsi mengalihkan ke halaman admin
		header("location:admin/index.php");
	// berfungsi mengecek jika user login sebagai moderator
	}else if($data['level']=="moderator"){
		// berfungsi membuat session
		$_SESSION['nama'] = $data['nama_lengkap'];
		$_SESSION['level'] = "moderator";
		// berfungsi mengalihkan ke halaman moderator
		header("location:moderator/index.php");

	}else{
		// berfungsi mengalihkan alihkan ke halaman login kembali
		header("location:index.php?alert=gagal");
	}	
}else{
	header("location:index.php?alert=gagal");
}
?>