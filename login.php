<?php

include "header.php";
include "menu.php";
?>
	<!-- start: Page Title -->
	<div id="page-title">

		<div id="page-title-inner">

			<!-- start: Container -->
			<div class="container">

				<h2><i class="ico-stats ico-white"></i>Login Form</h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: Page Title -->
	
	<!--start: Wrapper-->
	<div id="wrapper">
				
		<!--start: Container -->
    	<div class="container"> 
            
      		<div class="row">

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Login </h3>
				</div>
				<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<input type="hidden" class="form-control" name="id_pelanggan">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="name" class="form-control" name="email">
					</div><br>
					<div class="form-gorup">
						<label>Password</label>
						<input type="password" class="form-control" name="password">
					<div><a href="registrasi.php">Create a new account?</a></div>
					</div><br>
					<button class="btn btn-primary" name="login">Login</button>
				</form> 
			</div>
		</div>
	</div>
</div>
</div>
	<?php
	if (isset($_POST["login"])){
	//variabel untuk menyimpan kiriman dari form
	$email = $_POST['email'];
	$pass = md5($_POST['password']);
	
	if($email=='' || $pass==''){
		echo "Form belum lengkap!!";
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM pelanggan 
						WHERE email='$email' AND password='$pass'");
		$valid = $query->num_rows;

	if($valid==1)
	{
		//anda login
		$akun = $query->fetch_assoc();
			$_SESSION["pelanggan"] = $akun;
			echo "<script>alert ('Login Berhasil');</script>";
			echo "<script>location='index.php?halaman=home';</script>";
		}else{
			echo "<script>alert ('Username dan Password anda Salah!!!');</script>";
		}
	}
}
?>
                   

<?php
include "footer.php";
?>

</body>
</html>	