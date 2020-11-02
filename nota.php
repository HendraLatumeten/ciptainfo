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

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
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
	<h3 class="text-center">Nota Pembelian</h3>
		<br>
		<?php 
		$ambil = $koneksi->query ("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
		$detail = $ambil->fetch_assoc();

		$prv = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN provinsi AS b ON a.id_prov=b.id_prov WHERE id_pembelian='$_GET[id]'");
		$prov = $prv->fetch_assoc();

		$kabu = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN kabupaten AS b ON a.id_kab=b.id_kab WHERE id_pembelian='$_GET[id]'");
		$kab = $kabu->fetch_assoc();

		$keca = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN kecamatan AS b ON a.id_kec=b.id_kec WHERE id_pembelian='$_GET[id]'");
		$kec = $keca->fetch_assoc();
	
		$kelu = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN kelurahan AS b ON a.id_kel=b.id_kel WHERE id_pembelian='$_GET[id]'");
		$kel = $kelu->fetch_assoc();
	
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
				Tanggal : <?php echo $detail ['tanggal_pembelian']; ?><br>
				Total :<?php echo rupiah($detail ['total_harga']); ?>
			</div>
			<div class="col-md-4">
				<h3>Pelanggan</h3>
				<strong>Nama Pelanggan : <?php echo $detail ['nama']; ?></strong><br>
					<?php echo $detail ['tlp']; ?><br>
					<?php echo $detail ['email']; ?>
			</div>
			<div class="col-md-4">
				<h3>Pengiriman</h3>
				<strong><?php echo $prov['nama']; ?></strong><br>
				<strong><?php echo $kab['nama'].','.$kec['nama'].','.$kel['nama']; ?></strong><br>
				<B>Detail Lokasi: </b> <u><?php echo $prov['lokasi']; ?></u><br>
				Total Biaya Sudah Termasuk Pengiriman
			</div>
		</div><br>

		<table class="table table-bordered">
			<div class="col-md-7">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Jenis Kayu</th>
						<th style="width:150px;" >Harga Kayu</th>
						<th>Luas Bangunan</th>
						<th>Biaya Pengiriman</th>
						<th>Biaya Pemasangan</th>
						<th style="width:150px;">Sub_Harga</th>
					</tr>
				</thead>
			</div>
			<tbody>
				<?php 
				$nomor=1;
				$totalharga=0;
				$totalberat =0;
				$ambil=$koneksi->query("SELECT * FROM pembelian AS a JOIN produk ON a.id_produk=produk.id_produk INNER JOIN detail_pembelian ON a.id_pembelian=detail_pembelian.id_pembelian RIGHT JOIN data_kayu ON detail_pembelian.id_kayu=data_kayu.id_kayu  WHERE a.id_pembelian='$_GET[id]'");
				
				?>

				<?php 
				while($pecah = $ambil->fetch_assoc()){ 
				?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama_produk']; ?></td>
						<td><?php echo $pecah['nama_kayu']; ?></td>
						<td><?php echo rupiah($pecah['harga']); ?> m2</td>
						<td><?php echo $pecah['panjang'].'X'.$pecah['lebar']; ?> M</td>
						<td><?php echo $pecah['ongkir']; ?></td>
						<td><i>Sudah Termasuk Harga Kayu </i></td>
						<td><?php echo rupiah($pecah['total_harga']); ?></td>
					</tr>
				
				<?php $nomor++; ?>
				<?php $totalharga+=$pecah['total_harga']; ?>
				<?php } ?>
			</tbody>
		
			<tfoot>
				<tr><b>
					<td colspan="7"><b>Total</b></td>
					<?php
						$total = $detail['total_harga'];
						$total_harga = $total * 10 / 100 + $total;
					?>
					<td><b><?php echo rupiah($total_harga); ?></b></td>
				</b></tr>
			</tfoot>
			<tfoot>
				<tr><b>
					<td colspan="7"><i>PPN</i></td>
					<td><i>10%</i></td>
				</b></tr>
			</tfoot>
		</table>
		<form action="" method="post">
		<input type="hidden" name="total" value="<?php echo $total_harga ?>" >
		
		<a href="report_nota.php?id=<?php echo $detail["id_pembelian"];?>" class="btn btn-danger"><i class="fa fa-print" style="font-size:40x;color:black;"></i> Print</a>
		<button class="btn btn-success" name="bayar"><i class="fa fa-credit-card" style="font-size:40x;color:black;"></i>Bayar</button>
		</form>
		<?php 
			if (isset($_POST["bayar"]))
			{   
				$total_update = $_POST['total'];
				$id = $_GET['id'];
				$koneksi->query("UPDATE pembelian SET total_harga='$total_update' WHERE id_pembelian='$_GET[id]'");
				echo "<script>alert('Terima Kasih, Silahkan Melakukan Pembayaran');</script>";
				echo "<script>location='pembayaran.php?id=$id';</script>";
			}
		?>
		
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