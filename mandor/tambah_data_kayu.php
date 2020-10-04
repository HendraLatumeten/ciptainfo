<h2 class="text-center">Form Tambah Data Kayu</h2>

<form method="POST" enctype="multipart/form-data">
	<div class="form-grup">
		<label>Nama Kayu</label>
		<input type="text" class="form-control" name="nama" required="">
	</div>
	<div class="form-grup">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga" required="">
	</div>
	<!-- <div class="form-grup">
		<label>Harga Partisi(Rp)</label>
		<input type="number" class="form-control" name="harga_partisi" required="">
	</div> -->
	<div class="form-grup">
		<label>Satuan</label>
        <select class="form-control" name="satuan" required="">
                        <option value="1">-- Pilih Satuan --</option>
                        <option value="m2">m2</option>
                       
        </select>
    </div>
	<div class="form-grup">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok" required="">
	</div>
    
	<br>
	<button class="btn btn-primary" name="simpan">Simpan</button>
</form>
<?php
	if (isset($_POST['simpan'])) {
		if ($_POST['nama']=="") {
			echo "<script>alert('harap isi nama');</script>";
		} elseif ($_POST['harga']=="") {
			echo "<script>alert('harap isi harga utama');</script>";
		} else {
			$koneksi->query("INSERT INTO data_kayu (nama_kayu,harga,satuan,stok) VALUES ('$_POST[nama]','$_POST[harga]','$_POST[satuan]','$_POST[stok]')");
			echo "<script>alert('Data Berhasil Ditambahkan');</script>";
			echo "<script>location='index.php?halaman=data_kayu';</script>";
		}
	}
?>