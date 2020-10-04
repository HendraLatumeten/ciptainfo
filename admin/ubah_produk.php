<?php 
	$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();
?>

<h2 class="text-center">Form Ubah Produk</h2>

<form method="POST" enctype="multipart/form-data">
	<div class="form-grup">
		<label>Nama Produk</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk'] ?>">
	</div>
	<div class="form-grup">
		<label>Kategori</label>
		<select class="form-control" name="kategori" required value="<?php echo $pecah['kategori_produk'] ?>">
			<option value="">-- Pilih Kategori --</option>
            <option value="rumah kayu">Rumah Kayu</option>
        	<option value="Kayu">Kayu</option>
		</select>
	</div>
	<div class="form-grup">
		<br>
		<img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="100">
	</div>
	<div>
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<div class="form-grup" class="deskripsi">
		<label>Deskripsi Produk</label>
		<textarea class="form-control" name="deskripsi" rows="10">
			<?php echo $pecah['deskripsi_produk'] ?>
		</textarea>
	</div>
	<br>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php
	if (isset($_POST['ubah'])) {
		$namafoto = $_FILES['foto']['name'];
		$deskripsi = $_POST['deskripsi'];
		$lokasifoto = $_FILES['foto']['tmp_name'];
		$harga_jual_produk = $_POST[harga_beli]+($_POST[harga_beli]*20/100);
		
		if (!empty($lokasifoto)) {

			move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");
		
			$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',kategori_produk='$_POST[kategori]',foto_produk='$namafoto',deskripsi_produk='$deskripsi' WHERE id_produk='$_GET[id]'");
			
		} else {

			$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',kategori_produk='$_POST[kategori]',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
		}

		echo "<script>alert('Produk Telah Diperbarui');</script>";
		echo "<script>location='index.php?halaman=produk';</script>";
	}
?>