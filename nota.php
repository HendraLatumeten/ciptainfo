<?php

include "header.php";
include "menu.php";
?>
<?php

if(!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}

?>
	<div id="page-title">

		<div id="page-title-inner">

			<!-- start: Container -->
			<div class="container">

				<h2><i class="ico-usd ico-white"></i>Nota Pembelian</h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: Page Title -->
	
	

<div class="container">
	<h3 class="text-center">Nota</h3>
		<br>
		<?php 
		$ambil = $koneksi->query ("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
		$detail = $ambil->fetch_assoc();
		?>

		<?php

		$idpelangganbeli = $detail["id_pelanggan"];

		$idpelangganlogin = $_SESSION["pelanggan"]["id_pelanggan"];

		if ($idpelangganbeli!==$idpelangganlogin)
		{
			echo "<script>alert('Acces Denied');</script>";
			echo "<script>location='riwayat.php';</script>";
		}
		?>

		<div class="row">
			<div class="col-md-4">
				<h3>Pembelian</h3>
				<strong>No. Pembelian <?php echo $detail ['id_pembelian']; ?></strong><br>
				Tanggal : <?php echo $detail ['tgl']; ?><br>
				Total :Rp. <?php echo number_format($detail ['total']); ?>
			</div>
			<div class="col-md-4">
				<h3>Pelanggan</h3>
				<strong>Nama Pelanggan : <?php echo $detail ['nama']; ?></strong><br>
					<?php echo $detail ['tlp']; ?><br>
					<?php echo $detail ['email']; ?>
			</div>
			<div class="col-md-4">
				<h3>Pengiriman</h3>
				<strong><?php echo $detail ['alamat']; ?></strong><br>
				<strong><?php echo $detail ['nama_kota']; ?></strong><br>
				Ongkos Kirim : Rp. <?php echo number_format ($detail['tarif']);?>
			</div>
		</div><br>

		<table class="table table-bordered">
			<div class="col-md-7">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Berat</th>
						<th>Jumlah Beli</th>
						<th>Subberat</th>
						<th>Subharga</th>
					</tr>
				</thead>
			</div>
			<tbody>
				<?php 
				$nomor=1;
				$totalharga=0;
				$totalberat =0;
				$ambil=$koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$_GET[id]'");
				?>

				<?php 
				while($pecah = $ambil->fetch_assoc()){ 
				?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama']; ?></td>
						<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
						<td><?php echo number_format($pecah['berat']); ?> Gr</td>
						<td><?php echo number_format($pecah['jumlah']); ?></td>
						<td><?php echo number_format($pecah['subberat']); ?> Gr</td>
						<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
					</tr>
				
				<?php $nomor++; ?>
				<?php $totalharga+=$pecah['subharga']; ?>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr><b>
					<td colspan="6"><b>Total</b></td>
					<td><b>Rp. <?php echo number_format($totalharga); ?></b></td>
				</b></tr>
			</tfoot>
		</table>
<?php
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$_GET[id]'");
$bukti = $ambil->fetch_assoc();
?>

<?php if ($detail['status_pembelian']=="Sedang Dikirim") { ?>

			<tr>
				<div class="col-md-3">
					<form method="POST">
						<td>Bukti Transfer :</td><br><br>
						<td><img src="bukti_pembayaran/<?php echo $bukti['bukti']; ?>" width="200">
					</td>
				</div>
			</tr>
			<tr>
				<div class="col-md-3">
					<td>No Resi :</td><br><br>
					<td><input type="text" name="resi" class="form-control" readonly="" value="<?php echo $detail['no_resi']; ?>"></td>
				</div>
			</tr>
			<tr>
				<div class="col-md-3">
					<td>Apakah Barang Sudah Diterima ?</td><br><br>
					<button name="upload" class="btn btn-success">Sudah</button>
				</div>
			</tr>
			<?php } elseif ($detail['status_pembelian']=="Sedang Diproses") { ?>
			<tr>
				<td>Bukti Transfer :</td><br>
				<td>
					<img src="bukti_pembayaran/<?php echo $bukti['bukti']; ?>" width="200">
				</td>
			</tr><br><br>
			<?php } elseif ($detail['status_pembelian']=="pending") { ?>
			<tr>
				<div class="col-md-5">
					<div class="alert alert-success">
						<d>
						Silahkan melakukan pembayaran Rp. <?php echo number_format($detail ['total_pembelian']); ?> ke <br>
						<strong>BANK BCA 124-020201-2121  CIPTA INFO</strong>
						</d>
					</div><br>
				</div>
			</tr>
			<a href="pembayaran.php?id=<?php echo $detail["id_pembelian"];?>" class="btn btn-success">Bayar Sekarang</a>
			<?php } ?>
		</div>
	</div>
</div>

<?php if (isset($_POST['upload'])) {
	$status = "Finish";
	$id = $_GET['id'];
	$koneksi->query("UPDATE pembelian SET status_pembelian = '$status' WHERE id_pembelian = '$id'");
	echo "<script>alert('Terima Kasih Telah Berbelanja');</script>";
	echo "<script>location='riwayat.php';</script>";
} ?>

<?php
	  include "footer.php";
?>

</body>
</html>