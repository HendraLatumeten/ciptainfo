<?php 
$ambil1 = $koneksi->query("SELECT*FROM pembelian JOIN supplier ON pembelian.id_supplier=supplier.id_supplier WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil1->fetch_assoc();
$resi=""
?>
<form method="POST"><table class="table">
	<tr>
		<td>Nomor Faktur </td>
		<td> :</td>
		<td>BELI<?php echo $detail['id_pembelian'] ?></td>
	</tr>
	<tr>
		<td>Tanggal Faktur </td>
		<td> :</td>
		<td><?php echo $detail['tgl_pembelian'] ?></td>
	</tr>
	<tr>
		<td>Nama Supplier </td>
		<td> :</td>
		<td><?php echo $detail['nama_supplier'] ?></td>
	</tr>
	<tr>
		<td>Alamat Supplier </td>
		<td> :</td>
		<td><?php echo $detail['alamat_supplier'] ?></td>
	</tr>
	<?php 
	if ($detail['status_pembelian']=="Process") {
		echo"<tr>
				<td>Upload Resi </td>
				<td> :</td>
				<td><input type='text' class='form-control' name='resi' required=''></td>
			 </tr>";
	} elseif ($detail['status_pembelian']=="On The Way") {
		$adaresi=$detail['resi_pembelian'];
		echo"<tr>
				<td>Resi </td>
				<td> :</td>
				<td>$adaresi</td>
			 </tr>";
	} elseif ($detail['status_pembelian']=="Finish") {
		$adaresi=$detail['$resi_pembelian'];
		echo"<tr>
				<td>Resi </td>
				<td> :</td>
				<td>$adaresi</td>
			 </tr>";
	}; ?>
</table>
<br>
<table class="table table-bordered">
	<caption class="text-center">Detail Pembelian</caption>
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Jumlah Produk</th>
			<th>Harga</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>

		<?php $nomor=1;
			$jumlah=0;?>
		<?php $ambil=$koneksi->query("SELECT*FROM detail_pembelian JOIN produk ON detail_pembelian.id_produk=produk.id_produk WHERE detail_pembelian.id_pembelian='$_GET[id]'"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<?php $jumlah=$jumlah+($pecah['jumlah_pembelian']*$pecah['harga_beli_produk']); ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td><?php echo $pecah['jumlah_pembelian']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga_beli_produk']); ?></td>
			<td>Rp. <?php echo number_format($pecah['jumlah_pembelian']*$pecah['harga_beli_produk']); ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
		<tr>
			<td colspan="4"><h5><b>TOTAL</b></h5></td>
			<td><b>Rp. <?php echo number_format($jumlah); ?></b></td>
		</tr>
	</tbody>
</table>
<br>
<?php 
if ($detail['status_pembelian']=="Created") {
	echo "<input type='submit' name='process' class='btn btn-primary' value='Proses Pesanan'>";
	echo "&nbsp;";
	echo "&nbsp;";
	echo "<input type='submit' name='cancel' class='btn btn-danger' value='Batalkan Pesanan'>";

} elseif ($detail['status_pembelian']=="Process") {
	echo "<input type='submit' name='upload' class='btn btn-primary' value='Upload Nomor Resi'>";
} ?>
</form>

<?php 
if (isset($_POST['upload'])) {

 	$koneksi->query("UPDATE pembelian SET status_pembelian = 'On The Way',resi_pembelian = '$_POST[resi]' WHERE id_pembelian='$_GET[id]'");
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=riwayat_pesanan'>";

} elseif (isset($_POST['process'])) {

 	$koneksi->query("UPDATE pembelian SET status_pembelian = 'Process' WHERE id_pembelian='$_GET[id]'");
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pesanan'>";

} elseif (isset($_POST['cancel'])) {

 	$koneksi->query("UPDATE pembelian SET status_pembelian = 'Cancel' WHERE id_pembelian='$_GET[id]'");
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pesanan'>";

} ?>