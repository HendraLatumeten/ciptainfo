<?php 
$ambil1 = $koneksi->query("SELECT*FROM penjualan JOIN customer ON penjualan.id_customer=customer.id_customer WHERE penjualan.id_penjualan='$_GET[id]'");
$detail1 = $ambil1->fetch_assoc();
?>
<div class="col-md-6">
	<table class="table">
		<tr>
			<td>Nomor Nota </td>
			<td>JUAL<?php echo $detail1['id_penjualan'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Nota </td>
			<td><?php echo $detail1['tgl_penjualan'] ?></td>
		</tr>
		<tr>
			<td>Nama Customer </td>
			<td><?php echo $detail1['nama_customer'] ?></td>
		</tr>
		<tr>
			<td>Alamat Customer </td>
			<td><?php echo $detail1['alamat_customer']; ?></td>
		</tr>
	</table>
</div>
<div class="col-md-6">
	<form method="POST">
		<table class="table">
			<?php if ($detail1['status_penjualan']=="Process") { ?>
				<tr>
					<td>Bukti Transfer </td>
					<td>
						<img src="../bukti_penjualan/<?php echo $detail1['bukti_penjualan']; ?>" width="100">
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
			<?php } elseif ($detail1['status_penjualan']!="Created") { ?>
				<tr>
					<td>Bukti Transfer </td>
					<td>
						<img src="../bukti_penjualan/<?php echo $detail1['bukti_penjualan']; ?>" width="100">
					</td>
				</tr>
				<tr>
					<td>Resi</td>
					<td><input type="text" name="resi" class="form-control" readonly="" value="<?php echo $detail1['resi_penjualan']; ?>"></td>
				</tr>
			<?php } ?>
		</table>
	</form>
</div>
<?php if (isset($_POST['upload'])) {
	$resi = $_POST['resi'];
	$status = "On The Way";
	$id = $_GET['id'];
	$koneksi->query("UPDATE penjualan SET resi_penjualan = '$resi', status_penjualan = '$status' WHERE id_penjualan = '$id'");
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=penjualan'>";
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

		<?php $nomor=1;
			$jumlah=0; ?>
		<?php $ambil=$koneksi->query("SELECT*FROM detail_penjualan JOIN produk ON detail_penjualan.id_produk=produk.id_produk WHERE detail_penjualan.id_penjualan='$_GET[id]'"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<?php $jumlah=$jumlah+($pecah['jumlah_penjualan']*$pecah['harga_jual_produk']);  ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td><?php echo $pecah['jumlah_penjualan']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga_jual_produk']); ?></td>
			<td>Rp. <?php echo number_format($pecah['jumlah_penjualan']*$pecah['harga_jual_produk']); ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
		<tr>
			<td colspan="4"><h5><b>TOTAL</b></h5></td>
			<td><b>Rp. <?php echo number_format($jumlah); ?></b></td>
		</tr>
	</tbody>
</table>