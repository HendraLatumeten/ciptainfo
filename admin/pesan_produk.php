<?php 
	$ambilproduk = $koneksi->query("SELECT * FROM produk");

	$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();

	$ambilsupplier = $koneksi->query("SELECT * FROM supplier");
	$supplier = $ambilsupplier->fetch_assoc();
	$jumlahsupplier = $ambilsupplier->num_rows;

	$ambilfaktur = $koneksi->query("SELECT * FROM `pembelian` ORDER BY `pembelian`.`id_pembelian` ASC");
	$nofaktur = 1+$ambilfaktur->num_rows;
?>

<h2 class="text-center">Form Pemesanan Produk</h2>
<br>
<form method="POST">
	<div>
		<table class="table">
			<caption>Header</caption>
			<tr>
				<td width="250px">No Faktur</td>
				<td>
					<?php
					echo "BELI",$nofaktur; ?>
				</td>
			</tr>
			<tr>
				<td>Supplier </td>
				<td>
					<select class="form-control" name="supplier" required="">
						<?php for ($i=0; $i <= $jumlahsupplier; $i++) { 
							$ambilsupplier = $koneksi->query("SELECT * FROM supplier WHERE id_supplier='$i'");
							$supplier = $ambilsupplier->fetch_assoc();
							echo "<option value=";
							echo $supplier['id_supplier'];
							echo ">";
							echo $supplier['nama_supplier'];
							echo "</option>";
						} ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td><?php echo date('Y-m-d'); ?></td>
			</tr>
		</table>
	</div>
	<br>
	<div>
		<table class="table table-bordered">
			<caption>Detail</caption>
			<tr>
				<th>Nama</th>
				<th>Harga Produk</th>
				<th>Jumlah</th>
			</tr>
			<tr>
				<td><?php echo $pecah['nama_produk'] ?></td>
				<td><?php echo $pecah['harga_beli_produk'] ?></td>
				<td><input class="form-control" name="jumlah" type="number" required=""></td>
			</tr>
	</table>
	</div>
	
	<button class="btn btn-primary" name="proses">Pesan</button>
</form>
<?php if (isset($_POST['proses'])) {
	$id_supplier = $_POST['supplier'];
	$tanggal = date('Y-m-d');
	$jumlah_produk = $_POST['jumlah'];
	$id_admin = $_SESSION['admin']['id_admin'];
	$total_pembelian = $pecah['harga_beli_produk']*$jumlah_produk;
	$status = "Created";

	if ($jumlah_produk<=0) {
		echo "<script>alert('Jumlah minimal 1 ! ');</script>";
	} else {
		$koneksi->query("INSERT INTO pembelian (id_pembelian,tgl_pembelian,id_supplier,id_admin,status_pembelian) VALUES ('$nofaktur','$tanggal','$id_supplier','$id_admin','$status') ");

		$koneksi->query("INSERT INTO detail_pembelian (id_pembelian,id_produk,jumlah_pembelian,total_pembelian) VALUES ('$nofaktur','$_GET[id]','$jumlah_produk','$total_pembelian') ");

		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
		echo "<div class='alert alert-info'>Data Tersimpan</div>";
	}
} ?>