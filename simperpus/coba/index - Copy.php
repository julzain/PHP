<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Memubat crud 1 file denagn OOP</title>
    <link rel="icon" href="ci-rpl.jpg">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
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
    </style>
</head>
<body>
<h2><center>Membuat CRUD 1 File dengan OOP | <a href="http://muhfajarshodiq.blogspot.co.id/">muhfajarshodiq.blogspot.com</a></center></h2>
<br><br>
<?php 

$koneksi = mysqli_connect("localhost","root","","simperpus_db");

function tambah($koneksi){
    if(isset($_POST['btn_simpan'])){
        $id = time();
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];

        if(!empty($judul) && !empty($pengarang) && !empty($penerbit)){
            $sql = "INSERT INTO buku (id, judul, pengarang, penerbit) VALUES ('$id','$judul','$pengarang','$penerbit')";
            $simpan = mysqli_query($koneksi, $sql);
            if($simpan && isset($_GET['aksi']) ){
                if($_GET['aksi'] == 'create'){
                    header('Location: index.php');
                }
            }
        }else{
            $pesan = "<p style='color: red'>Tidak dapat menyimpan atau data belum lengkap!</p>";
        }
    }

?>
<center>
<form action="" method="post" class="form-group">
<h3 style="margin-top:1px;  ">Tambah Data</h3>
    <table class="tabel-form" border="0">
    <tr>
        <td></td>
        <td><input type="hidden" name="id"></td>
    </tr>
    <tr>
        <td> Judul Buku </td>
        <td><input type="text" name="judul"></td>
    </tr>
    <tr>
        <td> Pengarang Buku </td>
        <td><input type="text" name="pengarang"></td>
    </tr>
    <tr>
        <td> Penerbit Buku</td>
        <td><input type="text" name="penerbit"></td>
    </tr>
    <tr>
    <td colspan="2">
    <center>
        <button type="submit" name="btn_simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-danger"><i class="fa fa-reply-all"></i> Bersihkan</button>
    </center>   
    </td>
    </tr>
    </table>
    <p><?php echo isset($pesan) ? $pesan : "" ?></p>
</form>
</center>
<br><br>
<?php 

}


function tampil_data($koneksi){
    $sql = "SELECT * FROM buku";
    $query = mysqli_query($koneksi, $sql);

    echo"<center>";
    echo"<legend><h3 style='margin-top:0px;'>Data Buku</h3></legend>";

    echo"<table class='tabel-data' class='table-hover' class='table-bordered' border='1' >";
    echo"<tr>
        <th>Judul</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Pilihan</th>
        </tr>";
    while($data = mysqli_fetch_array($query)){

        ?>
        <tr>
            <td><?php echo $data['judul']; ?></td>
            <td><?php echo $data['pengarang']; ?></td>
            <td><?php echo $data['penerbit']; ?></td>
            <td>
                <a href="index.php?aksi=update&id=<?= $data['id']; ?>&judul=<?= $data['judul']; ?>&pengarang=<?= $data['pengarang']; ?>&penerbit=<?= $data['penerbit']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> edit </a>
                <a href="index.php?aksi=delete&id=<?= $data['id']; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i>delete </a>
            </td>
        </tr>
<?php
}
"</table>";
"</center>";
}


function ubah($koneksi){
    if(isset($_POST['btn_ubah'])){
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];

        if(!empty($judul) && !empty($pengarang) && !empty($penerbit)){
            $sql_update = "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit' WHERE id=$id";
            $update = mysqli_query($koneksi, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('Location: index.php');
                }
            }
        }else{
            $pesan = "Data Tidak Lengkap!";
        }
    }
    if(isset($_GET['id'])){
        ?>


        <a href="index.php" class="btn btn-info"><i class="fa fa-home"></i> Home</a> &nbsp;
            <a href="index.php?aksi=create" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <center>
            <form action="" method="POST">
            <h2>Ubah data</h2>
            <table>
            <tr>
            <td></td>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/></td>
                </tr>
                <tr>
                <td>Judul </td>
                <td><input type="text" name="judul" value="<?php echo $_GET['judul'] ?>"/></td>
                </tr>
                <tr>
                <td>Pengarang </td>
                <td><input type="text" name="pengarang" value="<?php echo $_GET['pengarang'] ?>"/></td>
                </tr>
                <tr>
                <td>Penerbit </td>
                <td><input type="text" name="penerbit" value="<?php echo $_GET['penerbit'] ?>"/></td>
                </tr>
                <tr><td></td><td></td></tr>
                <tr>
                <td>
                    <button type="submit" name="btn_ubah" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
                </td>
                <td>
                <a href="index.php?aksi=delete&id=<?php echo $_GET['id'] ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i>ni!</a>
                </td>
                </tr>
                </table>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
               
            </form>
            </center>
        <?php
    }
   
}
// --- Tutup Fungsi Update
// --- Fungsi Delete
function hapus($koneksi){
    if(isset($_GET['id']) && isset($_GET['aksi'])){
        $id = $_GET['id'];
        $sql_hapus = "DELETE FROM buku WHERE id=" . $id;
        $hapus = mysqli_query($koneksi, $sql_hapus);
       
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('Location: index.php');
            }
        }
    }
   
}
// --- Tutup Fungsi Hapus
// ===================================================================
// --- Program Utama
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "create":
            echo '<a href="index.php" class="btn btn-info"> &laquo; Home</a>';
            tambah($koneksi);
            break;
        case "read":
            tampil_data($koneksi);
            break;
        case "update":
            ubah($koneksi);
            tampil_data($koneksi);
            break;
        case "delete":
            hapus($koneksi);
            break;
        default:
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidak ada!</h3>";
            tambah($koneksi);
            tampil_data($koneksi);
    }
} else {
    tambah($koneksi);
    tampil_data($koneksi);
}
?>
</body>
</html>