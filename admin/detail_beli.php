<table class="table table-bordered">
	<caption class="text-center">Detail Pembelian</caption>
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Luas</th>
			<th>Harga Pembelian</th>
			<th>Terbayar</th>
			<th>Sisa Pembayaran</th>
		</tr>
	</thead>
	<tbody>

		<?php 
		$nomor=1;
		$jumlah=0; 
		$totalharga=0;
		?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian AS a JOIN produk AS b ON a.id_produk=b.id_produk JOIN pembayaran AS c ON a.id_pembelian=c.id_pembelian JOIN detail_pembelian AS d ON a.id_pembelian=d.id_pembelian WHERE a.id_pembelian='$_GET[id]'"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {
			
			$sisa = $pecah['total_harga'] - $pecah['jumlah'];
			?>
			<center><img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" style="width:300px; height:300px"></center><br>

		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td><?php echo 	$pecah['panjang'].'X'.$pecah['lebar']; ?> m</td>
			<td>Rp. <?php echo number_format($pecah['total_harga']); ?></td>
			<td>Rp. <?php echo number_format($pecah['jumlah']); ?></td>
			<td><b>Rp. <?php echo number_format($sisa); ?></b></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
		<!-- <tr>
			<td colspan="4"><h5><b>TOTAL</b></h5></td>
			<td><b>Rp. <?php echo number_format($jumlah); ?></b></td>
		</tr> -->
	</tbody>
</table>

<?php 
$ambil1 = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil1->fetch_assoc();
?>
<div class="col-md-6">
	<table class="table">
		<tr>
			<td>ID Pembelian </td>
			<td> :</td>
			<td><?php echo $detail['id_pembelian'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Pembelian </td>
			<td> :</td>
			<td><?php echo $detail['tanggal_pembelian'] ?></td>
		</tr>
		<tr>
			<td>Nama Pelnggan </td>
			<td> :</td>
			<td><?php echo $detail['nama'] ?></td>
		</tr>
		<tr>
			<td>Alamat Pelanggan </td>
			<td> :</td>
			<td><?php echo $detail['alamat'] ?></td>
		</tr>
	</table>
</div>
<?php
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$_GET[id]'");
$bukti = $ambil->fetch_assoc();
?>

<div class="col-md-6">
	<form method="POST">
		<table class="table">
			<?php if ($detail['status_pembelian']=="1") { ?>
				<tr>
					<td>Bukti Transfer </td>
					<td>
						<img src="../bukti_pembayaran/<?php echo $bukti['bukti']; ?>" width="100">
					</td>
				</tr>

				<tr>
					<td><b>Status</b></td>
					<td>
						<?php
						if ($detail['status_pembelian']=="1") {
							echo "<i>Menunggu Diproses</i>";
						}
						?>
					</td>
				</tr>
			

			<?php } elseif ($detail['status_pembelian']=="2") { ?>
				<tr>
					<td>Bukti Transfer </td>
					<td>
						<img src="../bukti_pembayaran/<?php echo $bukti['bukti']; ?>" width="100">
					</td>
				</tr>
			<?php } ?>
		</table>
		<button name="upload">Pilih Mandor</button>
		<button name="upload">batalkan</button>
	</form>
</div>

<?php if (isset($_POST['upload'])) {
	$status = "2";
	$id = $_GET['id'];
	$koneksi->query("UPDATE pembelian SET id_mandor = '1', status_pembelian = '$status' WHERE id_pembelian = '$id'");
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
} ?>
<br>
