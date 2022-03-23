<!-- 
     cara agar tulisan di dalam form tidak ter reset saat menginput
     
     encripsi url
     crud upload image  -->

<?php      include "za_header.php";       ?>
<?php      include "zd_koneksi.php";       ?>

<?php 

function read($koneksi){

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $sql = "SELECT * FROM buku WHERE id = ?";
    if($stmt = mysqli_prepare($koneksi, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["judul"];
                $address = $row["pengarang"];
                $salary = $row["penerbit"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

?>




    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Data Buku</h2>
                        <a href="?"  class="btn btn-primary pull-right">Kembali</a>
                    </div>
    <table class="table table-bordered table-striped" >
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Pengarang</th>
        <th>Penerbit</th>   
    </tr>

        <tr>
            <td><?php $i=1; echo " $i ";   $i++; ?></td>
            <td><?php echo $row['judul']; ?></td>
            <td><?php echo $row['pengarang']; ?></td>
            <td><?php echo $row['penerbit']; ?></td>
        </tr>


<?php
                
            }

        }

?>

<!-- =========================== batas halaman read =========================== -->


<?php

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
                    header('Location: d_buku.php');
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
        <button type="submit" name="btn_simpan" class="btn btn-success pull-left"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-secondary"><i class="fa fa-reply-all"></i> Bersihkan</button>
        <a href="?"  class="btn btn-danger pull-right">Batal</a>

    </center>   
    </td>
    </tr>
    </table>
    <p><?php echo isset($pesan) ? $pesan : "" ?></p>
</form>
</center>



<?php 

            }

?>


<!-- =========================== batas halaman tambah data =========================== -->



<?php

function tampil_data($koneksi){
    $sql = "SELECT * FROM buku";
    $query = mysqli_query($koneksi, $sql);

?>


    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Data Buku</h2>
                        <a href="d_buku.php?aksi=create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Data Buku</a>
                    </div>
    <table class="table table-bordered table-striped" >
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Pilihan</th>
        </tr>




<?php

    $i=1;
    while($data = mysqli_fetch_array($query)){

?>




        <tr>
            <td><?php echo " $i ";   $i++; ?></td>
            <td><?php echo $data['judul']; ?></td>
            <td><?php echo $data['pengarang']; ?></td>
            <td><?php echo $data['penerbit']; ?></td>
            <td>
                <a href="d_buku.php?aksi=read&id=<?= $data['id']; ?>"class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                <a href="d_buku.php?aksi=update&id=<?= $data['id']; ?>&judul=<?= $data['judul']; ?>&pengarang=<?= $data['pengarang']; ?>&penerbit=<?= $data['penerbit']; ?>" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                <a href="d_buku.php?aksi=delete&id=<?= $data['id']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>
            </td>
        </tr>




<?php
                  }
?>




</table>
</center>



<?php
          }
?>


<!-- =========================== batas halaman data buku =========================== -->





<?php

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
                    header('Location: d_buku.php');
                }
            }
        }else{
            $pesan = "Data Tidak Lengkap!";
        }
    }
    if(isset($_GET['id'])){


?>


 
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
    <td colspan="2">
    <center>
        <button type="submit" name="btn_ubah" class="btn btn-success pull-left"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-secondary"><i class="fa fa-reply-all"></i> Bersihkan</button>
        <a href="?"  class="btn btn-danger pull-right">Batal</a>

    </center>   
    </td>
                <td>
                </td>
                </tr>
                </table>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
               
            </form>
            </center>


<?php

      }
   
    }

?>



<!-- =========================== batas halaman ubah data =========================== -->



<?php

// --- Tutup Fungsi Update
// --- Fungsi Delete
function hapus($koneksi){
    if(isset($_GET['id']) && isset($_GET['aksi'])){
        $id = $_GET['id'];
        $sql_hapus = "DELETE FROM buku WHERE id=" . $id;
        $hapus = mysqli_query($koneksi, $sql_hapus);
       
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('Location: d_buku.php');
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
            tambah($koneksi);
            break;
        case "read":
            read($koneksi);
            break;
        case "update":
            ubah($koneksi);
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
// ini di sebut dengan landing atau halaman yang di tampilkan di awal
    tampil_data($koneksi);
}
?>

































