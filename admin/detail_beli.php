<?php 
$ambil1 = $koneksi->query("SELECT * FROM pembelian JOIN customer ON pembelian.id_customer=customer.id_customer WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil1->fetch_assoc();
?>
<div class="col-md-6">
	<table class="table">
		<tr>
			<td>Nomor Pembelian </td>
			<td> :</td>
			<td><?php echo $detail['id_pembelian'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Pembelian </td>
			<td> :</td>
			<td><?php echo $detail['tanggal_pembelian'] ?></td>
		</tr>
		<tr>
			<td>Nama Customer </td>
			<td> :</td>
			<td><?php echo $detail['nama_customer'] ?></td>
		</tr>
		<tr>
			<td>Alamat Costumer </td>
			<td> :</td>
			<td><?php echo $detail['alamat_customer'] ?></td>
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
			<?php if ($detail['status_pembelian']=="Sedang Diproses") { ?>
				<tr>
					<td>Bukti Transfer </td>
					<td>
						<img src="../bukti_pembayaran/<?php echo $bukti['bukti']; ?>" width="100">
					</td>
				</tr>
				<tr>
					<td>Resi</td>
					<td><input type="text" name="resi" class="form-control" required=""></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button name="upload" class="btn btn-primary">Upload Resi</button>
					</td>
				</tr>
			<?php } elseif ($detail['status_pembelian']=="Sedang Dikirim") { ?>
				<tr>
					<td>Bukti Transfer </td>
					<td>
						<img src="../bukti_pembayaran/<?php echo $bukti['bukti']; ?>" width="100">
					</td>
				</tr>
				<tr>
					<td>Resi</td>
					<td><input type="text" name="resi" class="form-control" readonly="" value="<?php echo $detail['no_resi']; ?>"></td>
				</tr>
			<?php } ?>
		</table>
	</form>
</div>

<?php if (isset($_POST['upload'])) {
	$resi = $_POST['resi'];
	$status = "Sedang Dikirim";
	$id = $_GET['id'];
	$koneksi->query("UPDATE pembelian SET no_resi = '$resi', status_pembelian = '$status' WHERE id_pembelian = '$id'");
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
} ?>
<br>
<table class="table table-bordered">
	<caption class="text-center">Detail Penjualan</caption>
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Jumlah Produk</th>
			<th>Harga jual</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>

		<?php 
		$nomor=1;
		$jumlah=0; 
		$totalharga=0;
		?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<?php   
		$jumlah=$jumlah+($pecah['jumlah']*$pecah['harga_produk']);  ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
			<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
		<tr>
			<td colspan="4"><h5><b>TOTAL</b></h5></td>
			<td><b>Rp. <?php echo number_format($jumlah); ?></b></td>
		</tr>
	</tbody>
</table>