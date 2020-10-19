<?php

include "header.php";
include "menu.php";
?>
	<!-- start: Page Title -->
	<div id="page-title">

		<div id="page-title-inner">

			<!-- start: Container -->
			<div class="container">

				<h2><i class="ico-stats ico-white"></i>Registrasi Form</h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: Page Title -->
	
	<!--start: Wrapper-->
	<div id="wrapper">
				
		<!--start: Container -->
    	<div class="container"> 
        <!--<div class="title"><h3>Keranjang Anda</h3></div>
            <div class="hero-unit">
            </div> -->            
      		<!-- start: Row -->
            
      		<div class="row">
<form name="form1" method="post" action="registrasi.php">
      <tr>
        <td><label>Nama</label></td>
        <td><input name="nama" type="text" class="form-control"  size="200" required></td>
      </tr>
        <tr>
        <td><label>Alamat</label></td>
        <td><textarea name="alamat" class="form-control" required></textarea></td>
      </tr>
       <tr>
            <td><label>Jenis Kelamin</label></td>
            <td>:</td>
            <br>
            <td><input type="radio" name="jk" value="L" checked>Laki-laki
            <input type="radio" name="jk" value="P">Perempuan
            </td>
      </tr>
		<br>
       <tr>
        <td><label>Pekerjaan</label></td>
        <td><textarea name="pekerjaan" class="form-control" placeholder="kontruktor" required></textarea></td>

      </tr>

       <tr>
        <td><label>No telepon</label></td>
        <td><input name="tlp" type="text" class="form-control" minlength="12" required></td>
      </tr>
      <br>
      <tr>
        <td><label>Email</label></td>
        <td><input name="email" type="email" class="form-control" required></td>
      </tr>
      <tr>
        <td><label>Password</label></td>
        <td><input name="password" type="password" class="form-control" minlength="6"  required></td>
      </tr>
	  <br>
	  <div class="g-recaptcha" data-sitekey="6LfyB9gZAAAAAFKSSYcDeSL60lDIoJdg7WzDcAeb"></div>
     <br>
      <button class="btn btn-primary" type="submit" name="insert">Daftar</button>

<?php
	if (isset($_POST["insert"])) {

		$secret_key = "6LfyB9gZAAAAAFQOZdGfs8bb2iByqaVEH7V4T75U";
		$verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
		$response = json_decode($verify);
		//

		$nama = $_POST["nama"];
		$jk = $_POST['jk'];
		$tlp = $_POST['tlp'];
		$pekerjaan = $_POST["pekerjaan"];
		$alamat = $_POST['alamat'];
		$email = $_POST["email"];
		$pass = md5($_POST["password"]);
		//token
		$token=hash('sha256', md5(date('Y-m-d'))) ;
		//
		

		
		if($response->success){ // Jika proses validasi captcha berhasil
			$sql = mysqli_query ($koneksi, "SELECT * FROM pelanggan WHERE email='$email'");
				$valid = $sql->num_rows;
				if ($valid==1)
				{
					echo "<script>alert ('Email telah digunakan');</script>";
					echo "<script>location='registrasi.php';</script>";
				}else{
					$sql = mysqli_query ($koneksi, "INSERT INTO pelanggan (nama,jk,tlp,pekerjaan,alamat,email,password,token,aktif) VALUES ('$nama','$jk','$tlp','$pekerjaan','$alamat','$email','$pass','$token','0')"); 
					// var_dump($koneksi);die;
					if ($koneksi);
					include("mail.php");
					echo "<script>alert('terima kasih sudah daftar,silahkan cek email anda untuk aktivasi login ') </script>";
					echo "<script>location ='login.php';</script>";
			}	


		}else{ // Jika captcha tidak valid
			echo "<script>alert('Maaf!,Anda Adalah Robot') </script>";
			echo "<script>location ='login.php';</script>";
		}


	
  
}	
?>
  
                   
              
              
<!---->
      		</div>
			<!-- end: Row -->
					
					
				</div>	
				
					
				</div>
				
			</div>
			<!--end: Row-->
	
		</div>
	
		<!--end: Container-->
				
		<!--start: Container -->
    	<?php
include "footer.php";
?>
	<script src='https://www.google.com/recaptcha/api.js'></script>

</body>
</html>	