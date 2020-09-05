<h2 class="text-center">Form Tambah Produk</h2>

<form method="POST" enctype="multipart/form-data">
	<div class="form-grup">
		<label>Nama Produk</label>
		<input type="text" class="form-control" name="nama" required="">
	</div>
	<div class="form-grup">
		<label>Kategori</label>
		<select class="form-control" name="kategori" required="">
                        <option value="1">-- Pilih Kategori --</option>
                        <option value="dekstop">PC Dekstop</option>
                        <option value="laptop">Laptop</option>
                        <option value="processor">Processor</option>
                        <option value="motherboard">Motherboard</option>
                        <option value="ram">RAM</option>
                        <option value="vga">VGA</option>
                        <option value="power_supply">Power Supply</option>
                        <option value="hardsik">Hardisk</option>
                        <option value="ssd">SSD</option>
                        <option value="headphone">Headphone</option>
                        <option value="mouse">Mouse</option>
                        <option value="keyboard">Keyboad</option>
                        <option value="fan">Fan</option>
                        <option value="casing">Casing</option>
                        <option value="lain-lain">Lain - lain</option>
        </select>
	</div>
	<div class="form-grup">
		<label>Harga Beli (Rp)</label>
		<input type="number" class="form-control" name="harga_produk" required="">
	</div>
	<div class="form-grup">
		<label>Berat Produk (Gr)</label>
		<input type="number" class="form-control" name="berat" required="">
	</div>
	<div class="form-grup" class="deskripsi">
		<label>Deskripsi Produk</label>
		<textarea class="form-control" name="deskripsi" rows="10" required=""></textarea>
	</div>
	<div class="form-grup">
		<label>Foto Produk</label>
		<input type="file" name="foto" class="form-control" required="">
	</div>
	<br>
	<button class="btn btn-primary" name="simpan">Simpan</button>
</form>
<?php
	if (isset($_POST['simpan'])) {
		if ($_POST[kategori]==1) {
			echo "<script>alert('harap isi kategori');</script>";
		} elseif ($_POST[nama]=="") {
			echo "<script>alert('harap isi nama');</script>";
		} elseif ($_POST[harga_produk]=="") {
			echo "<script>alert('harap isi harga beli produk');</script>";
		} elseif ($_POST[berat]=="") {
			echo "<script>alert('harap isi berat');</script>";
		} else {
			$nama = $_FILES['foto']['name'];
			$lokasi = $_FILES['foto']['tmp_name'];
			$harga_jual_produk = $_POST[harga_beli]+($_POST[harga_beli]*15/100);
			move_uploaded_file($lokasi, "../foto_produk/".$nama);
			
			$koneksi->query("INSERT INTO produk (nama_produk,kategori_produk,harga_produk,berat_produk,stok_produk,deskripsi_produk,foto_produk) VALUES ('$_POST[nama]','$_POST[kategori]','$_POST[harga_produk]','$_POST[berat]','0','$_POST[deskripsi]','$nama')");

			echo "<script>alert('Data Berhasil Ditambahkan');</script>";
			echo "<script>location='index.php?halaman=produk';</script>";
		}
	}
?>