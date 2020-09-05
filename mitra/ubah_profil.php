<?php 
	$ambil = $koneksi->query("SELECT * FROM supplier WHERE id_supplier='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();
?>

<h2 class="text-center">Form Ubah Profil</h2>

<form method="POST" enctype="multipart/form-data">
	<div class="form-grup">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_supplier'] ?>">
	</div>
	<div>
		<label>Email</label>
		<input class="form-control" type="email" name="email" value="<?php echo $pecah['email_supplier'] ?>">
	</div>
	<div>
		<label>Password</label>
		<input class="form-control" type="password" name="password" value="<?php echo $pecah['password_supplier'] ?>">
	</div>
	<div>
		<label>No Telp</label>
		<input class="form-control" type="number" name="notelp" value="<?php echo $pecah['notelp_supplier'] ?>">
	</div>
	<div>
		<label>Alamat</label>
		<textarea class="form-control" name="alamat" rows="10"><?php echo $pecah['alamat_supplier'] ?></textarea>
	</div>

	<br>
	<button class="btn btn-primary" name="simpan">Simpan Perubahan</button>
</form>
<?php
	if (isset($_POST['simpan'])) {
		
		$koneksi->query("UPDATE supplier SET nama_supplier='$_POST[nama]',email_supplier='$_POST[email]',password_supplier='$_POST[password]',notelp_supplier='$_POST[notelp]',alamat_supplier='$_POST[alamat]' WHERE id_supplier='$_GET[id]'");
		echo "<br>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=profil'>";
		echo "<div class='alert alert-info'>Data Berhasil Di Ubah</div>";
	}
?>