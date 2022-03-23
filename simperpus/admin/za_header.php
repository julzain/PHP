<?php
  function encrypt( $q ) {
      $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
      $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
      return( $qEncoded );
  }

  function decrypt( $q ) {
      $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
      $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
      return( $qDecoded );
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Simperpus</title>
</head>
<body>
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<style>


        body {
            font-family: Raleway;
        }
        .table-data , .th, .td {
            padding: 10px;
            border: 1px solid grey;
            border-style: solid;
            border-collapse: collapse;
        }
        .tabel-form , th , td {
            border: 0px;
            padding: 7px;
            border-style: solid;
            border-collapse: collapse;
        }
        h2 {
            color: #000;
            margin-bottom: 1px;
        }
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }



</style>



<script>



        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });



</script>


</head>

<?php 
session_start();
//berfungsi mengecek apakah user sudah login atau belum
if($_SESSION['level']==""){
  header("location:../index.php?alert=belum_login");
//berfungsi mengecek apakah user admin atau bukan
}if($_SESSION['level']!="admin"){
    die("<br><br><br><br><br><br><br><br><br><center><h1>Anda bukan Admin");
}

?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>


<div class="container col-6 ">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="d_siswa.php">Data Siswa</a>
          <a class="dropdown-item" href="d_buku.php">Data Buku</a>
          <a class="dropdown-item" href="d_user.php">Data User</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="zc_logout.php" onclick="return confirm('Anda yakin ingin log out ?')">Logout</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#"></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

</div>
</nav>