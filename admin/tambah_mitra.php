<h2 class="text-center">Form Tambah Supplier</h2>

<form method="POST" enctype="multipart/form-data">
	<div class="form-grup">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" required="">
	</div>
	<div>
		<label>Email</label>
		<input class="form-control" type="email" name="email" required="">
	</div>
	<div>
		<label>Password</label>
		<input class="form-control" type="password" name="password" required="">
	</div>
	<div>
		<label>No Telp</label>
		<input class="form-control" type="number" name="tlp" required="">
	</div>
	<div>
		<label>Alamat</label>
		<textarea class="form-control" name="alamat" rows="10" required=""></textarea>
	</div>

	<br>
	<button class="btn btn-primary" name="simpan">Simpan</button>
</form>
<?php
	if (isset($_POST['simpan'])) {
		
		$koneksi->query("INSERT INTO supplier (nama_supplier,email_supplier,password_supplier,alamat_supplier,tlp_supplier) VALUES ('$_POST[nama]','$_POST[email]','$_POST[password]','$_POST[alamat]','$_POST[tlp]')");


		echo "<script>alert('Data Telah Ditambahkan');</script>";
		echo "<script>location='index.php?halaman=supplier';</script>";
	}
?>