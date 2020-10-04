<h2 class="text-center">Form Tambah Produk</h2>

<form method="POST" enctype="multipart/form-data">
	<div class="form-grup">
		<label>Nama Produk</label>
		<input type="text" class="form-control" name="nama" required="">
	</div>

	<div class="form-grup">
		<label>Kategori</label>
		<select class="form-control" name="kategori" required="">
                        <option value="1">-- Pilih Katalog Produk --</option>
                        <option value="rumah kayu">Desain Jendela Rumah Minimalis</option>
                        <option value="Kayu">Plafon untuk Rumah</option>
						<option value="Kayu">Kayu Pelapis Dinding</option>
						<option value="Kayu">lantai kayu</option>
                       
        </select>
	</div>
	
	<!-- <div class="form-grup">
	<label>Jenis Kayu</label>
		<select name="kayu" class="form-control">
			<option disabled selected>--Pilih-- </option>
				<?php 
				$sql = $koneksi->query("SELECT * FROM data_kayu");
				while ($data=mysqli_fetch_array($sql)) {
				?>
			<option value="<?=$data['nama_kayu']?>"><?=$data['nama_kayu']?></option> 
				<?php
				}
				?>
		</select>
		
	</div> -->
	<!-- <div class="form-grup">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga" required="">
	</div> -->
	<!-- <div class="form-grup">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok" required="">
	</div> -->
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
		if ($_POST['kategori']==1) {
			echo "<script>alert('harap isi kategori');</script>";
		} elseif ($_POST['nama']=="") {
			echo "<script>alert('harap isi nama');</script>";
		} else {
			$nama = $_FILES['foto']['name'];
			$lokasi = $_FILES['foto']['tmp_name'];
			move_uploaded_file($lokasi, "../foto_produk/".$nama);
			
			$koneksi->query("INSERT INTO produk (nama_produk,kategori_produk,deskripsi_produk,foto_produk) VALUES ('$_POST[nama]','$_POST[kategori]','$_POST[deskripsi]','$nama')");
			
			echo "<script>alert('Data Berhasil Ditambahkan');</script>";
			echo "<script>location='index.php?halaman=produk';</script>";
		}
	}
?>