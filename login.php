<?php

include "header.php";
include "menu.php";
?>
	<!-- start: Page Title -->
	
	<!-- end: Page Title -->
	
	<!--start: Wrapper-->
	<div id="wrapper">
				
		<!--start: Container -->
    	<div class="container"> 
            
      		<div class="row">
<div id="card"> 

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center><h2 class="text">Login </h2></center>
				</div>
				<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<input type="hidden" class="form-control" name="id_pelanggan">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="name" class="form-control" name="email">
					</div>
					<div class="form-gorup">
						<label>Password</label>
						<input type="password" class="form-control" name="password">
					<div><a href="registrasi.php">Daftar?</a></div>
					</div><br>
					<div class="g-recaptcha" data-sitekey="6LfyB9gZAAAAAFKSSYcDeSL60lDIoJdg7WzDcAeb"></div>
					<br>
					<button id="submit-btn" class="btn btn-primary" name="login">Login</button>
				</form> 
			</div>
		</div>
	</div>
</div>
</div>
</div> 
	<?php
	if (isset($_POST["login"])){

	$secret_key = "6LfyB9gZAAAAAFQOZdGfs8bb2iByqaVEH7V4T75U";
	$verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
	$response = json_decode($verify);
  //

	//variabel untuk menyimpan kiriman dari form
	$email = $_POST['email'];
	$pass = md5($_POST['password']);
	
	if($email=='' || $pass==''){
		echo "Form belum lengkap!!";
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM pelanggan 
						WHERE email='$email' AND password='$pass'");
		$valid = $query->num_rows;
	

if($response->success){ // Jika proses validasi captcha berhasil
	if($valid==1)
	{
		//anda login
		$akun = $query->fetch_assoc();
		// var_dump($akun['aktif']);die;
		if ($akun['aktif'] < '1') {
			echo "<script>alert ('Anda belum melakukan aktivasi akun, silahkan periksa kembali email anda!');</script>";
			}else{

			$_SESSION["pelanggan"] = $akun;
			echo "<script>location='index.php?halaman=home';</script>";
			}
			
	}else{
			echo "<script>alert ('Username dan Password anda Salah!!!');</script>";
	}
	
	
	}else{
	echo "<script>alert('Maaf!,Anda Adalah Robot') </script>";
	echo "<script>location ='login.php';</script>";

	}
}
	}





?>
       <style>
	   #card {
        background: white;
        border-radius: 8px;
        box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
        height: 410px;
        margin: 6rem auto 8.1rem auto;
        width: 500px;
		padding-right:24px;
		height:426px;
		}
		#submit-btn {
		background: #89c236;
		border: none;
		border-radius: 21px;
		box-shadow: 0px 1px 8px #24c64f;
		cursor: pointer;
		color: white;
		font-family: "Raleway SemiBold", sans-serif;
		height: 42.3px;
		margin: 0 auto;
		margin-top: 22px;
		margin-left: 140px;
		transition: 0.25s;
		width: 153px;
		
		}
	   </style>            

<?php
include "footer.php";
?>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>	