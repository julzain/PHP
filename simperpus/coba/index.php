<!DOCTYPE html>
<html>
<head>
	<title>View Data | YELLOWWEB.ID</title>
</head>
<body>
	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Barang</th>
				<th colspan="2">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
				include "koneksi.php";
				include "fungsi-enkripsi.php";

				$sql = "SELECT * FROM tbl_barang";
				$query = mysqli_query($koneksi,$sql);

				$no = 1;


//$stringterenkripsi = base64_encrypt($stringawal,$key);

				while($data = mysql_fetch_object($query(base64_encrypt($key)))){?>

					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $data["nama_barang"];?></td>
						<td><a href="edit_data.php?id=<?php echo $data["id"];?>">Edit</a></td>
						
					</tr>

				<?php }

			?>
			
		</tbody>
	</table>

</body>
</html>