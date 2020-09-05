<?php 
	$ambil = $koneksi->query("SELECT * FROM mitra WHERE id_mitra='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();
?>

<h2 class="text-center">Form Ubah Mitra</h2>

<form method="POST" enctype="multipart/form-data">
	<div class="form-grup">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_mitra'] ?>">
	</div>
	<div>
		<label>Email</label>
		<input class="form-control" type="email" name="email" value="<?php echo $pecah['email_mitra'] ?>">
	</div>
	<div>
		<label>Password</label>
		<input class="form-control" type="password" name="password" value="<?php echo $pecah['password_mitra'] ?>">
	</div>
	<div>
		<label>No Telp</label>
		<input class="form-control" type="number" name="tlp" value="<?php echo $pecah['tlp_mitra'] ?>">
	</div>
	<div>
		<label>Alamat</label>
		<textarea class="form-control" name="alamat" rows="10"><?php echo $pecah['alamat_mitra'] ?></textarea>
	</div>

	<br>
	<button class="btn btn-primary" name="simpan">Simpan Perubahan</button>
</form>
<?php
	if (isset($_POST['simpan'])) {
		
		$koneksi->query("UPDATE mitra SET nama_mitra='$_POST[nama]',email_mitra='$_POST[email]',password_mitra='$_POST[password]',tlp_mitra='$_POST[tlp]',alamat_mitra='$_POST[alamat]' WHERE id_mitra='$_GET[id]'");


		echo "<script>alert('Data Telah Diupdate');</script>";
		echo "<script>location='index.php?halaman=mitra';</script>";
	}
?>