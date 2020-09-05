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

				<h2>Riwayat Belanja</h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>


<sectionclass class="riwayat">
	<div class="container">
		<h3>Riwayat Pembelian</h3>
		
		<table class="table table-boredered">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th>total</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$nomor=1;
				$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];

				$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ORDER BY id_pembelian DESC");
				while ($pecah = $ambil->fetch_assoc()){
				?>
				<tr>
					<td><?php echo $nomor;?></td>
					<td><?php echo $pecah["tgl"]?></td>
					<td><?php echo $pecah["status"]?></td>
					<td>Rp. <?php echo number_format($pecah['total']); ?></td>
					<td>
						<?php if ($pecah['status_pembelian']=="Sedang Dikirim") { ?>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-info">Nota</a>
					<?php } elseif ($pecah['status_pembelian']=="Finish") { ?>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-info">Nota</a>
					<?php } elseif ($pecah['status_pembelian']=="Sedang Diproses") { ?>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-info">Nota</a>
					<?php } elseif ($pecah['status_pembelian']=="pending") { ?>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-info">Nota</a>
						<a href="hapus_pesanan.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-danger">Batalkan</a>
					</td>
				</tr>
				<?php } ?>
				<?php $nomor++;?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</section>


<?php
include "footer.php";
?>