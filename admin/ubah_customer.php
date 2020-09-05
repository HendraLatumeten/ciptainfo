<?php 
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();
?>

<h2 class="text-center">Form Ubah Pelanggan</h2>

<form method="POST" enctype="multipart/form-data">
	<div class="form-grup">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama'] ?>">
	</div>
	<div>
		<label>Email</label>
		<input class="form-control" type="email" name="email" value="<?php echo $pecah['email'] ?>">
	</div>
	<div>
		<label>No Telp</label>
		<input class="form-control" type="number" name="notelp" value="<?php echo $pecah['tlp'] ?>">
	</div>
	<div>
		<label>Alamat</label>
		<textarea class="form-control" name="alamat" rows="10"><?php echo $pecah['alamat'] ?></textarea>
	</div>

	<br>
	<button class="btn btn-primary" name="simpan">Simpan Perubahan</button>
</form>
<?php
	if (isset($_POST['simpan'])) {
		
		$koneksi->query("UPDATE pelanggan SET nama='$_POST[nama]',email='$_POST[email]',tlp='$_POST[notelp]',alamat='$_POST[alamat]' WHERE id_pelanggan='$_GET[id]'");

		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
		echo "<div class='alert alert-info'>Data Berhasil Di Ubah</div>";
	}
?>