<!DOCTYPE html>
<html>
<head>
	<title>Edit Data | YELLOWWEB.ID</title>
</head>
<body>
	<form action="update_data.php" method="POST">

		<?php
			include "koneksi.php";
			include "fungsi-enkripsi.php";

			//error_reporting(0);

			$ide = decrypt($_GET["id"]);
			
			$sql = "SELECT * FROM tbl_barang WHERE id='$ide'";
			$query = mysql_query($sql) or die (mysql_error());

			$data_edit = mysql_fetch_array($query);



		?>

		<input type="hidden" name="id" value="<?php echo $data_edit["id"];?>">

		<table>
			<tr>
				<td>Nama Barang</td>
				<td>:</td>
				<td><input type="text" name="nmbrg" value="<?php echo $data_edit["nama_barang"];?>"></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<input type="submit" name="submit" value="Edit">
					<input type="button" value="Go Back" onclick="history.back(-1)" />
				</td>
			</tr>
		</table>
	</form>

</body>
</html>