<?php 
	$ambil = $koneksi->query("SELECT * FROM data_kayu WHERE id_kayu='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();
?>

<h2 class="text-center">Form Ubah Data Kayu</h2>

<form method="POST" enctype="multipart/form-data">
	<div class="form-grup">
		<label>Nama Kayu</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_kayu'] ?>">
	</div>
	<div class="form-grup">
		<label>Harga Utama (Rp)</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga'] ?>">
	</div>
    <!-- <div class="form-grup">
		<label>Harga Partisi (Rp)</label>
		<input type="number" class="form-control" name="harga_partisi" value="<?php echo $pecah['harga_partisi'] ?>">
	</div> -->
    <div class="form-grup">
		<label>Satuan</label>
        <select class="form-control" name="satuan" required>
                        <option value="">-- Pilih Satuan --</option>
                        <option value="m2">m2</option>
                       
        </select>
    </div>
	<div class="form-grup">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok" value="<?php echo $pecah['stok'] ?>">
	</div>
	<br>
    <a href="index.php?halaman=data_kayu" class="btn btn-danger">Kembali</a>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php
	if (isset($_POST['ubah'])) {
		
		$koneksi->query("UPDATE data_kayu SET nama_kayu='$_POST[nama]',harga='$_POST[harga]',satuan='$_POST[satuan]',stok='$_POST[stok]' WHERE id_kayu='$_GET[id]'");
		echo "<script>alert('Produk Telah Diperbarui');</script>";
		echo "<script>location='index.php?halaman=data_kayu';</script>";
	}
?>