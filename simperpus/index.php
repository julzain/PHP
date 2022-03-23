

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<br><br><br><br><br><br>

	<center>
	<?php
      	if(isset($_GET['alert'])){
      		if($_GET['alert']=="gagal"){
      			echo "<p>Maaf ! Username & Password Salah</p>";
      		}else if($_GET['alert']=="belum_login"){
      			echo "<p>Anda Harus Login Terlebih Dulu !</p>";
      		}else if($_GET['alert']=="logout"){
      			echo "<p>Anda Telah Logout !</p>";
      		}
      	}
	?>
	</center>


<form action="index_.php" method="post">

<div class="container ">
<div class="container col-6 col-md-3 ">

  <div class="mb-3">
    <input type="text" class="form-control" name="username" placeholder="Username" required="required">
  </div>

  <div class="mb-3">
    <input type="password" class="form-control" name="password" placeholder="Password" required="required">
  </div>


  <center>
  <button  type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0">Log In</button>
  
</div>

</form>




















