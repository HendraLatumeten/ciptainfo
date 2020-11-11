<?php
include "header.php";
include "menu.php";

?>
<?
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
} 
?>
<?php

if(!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}

$id = $_SESSION["pelanggan"]["id_pelanggan"];

$ambil = $koneksi->query ("SELECT * FROM pembelian WHERE pembelian.id_pembelian='$id'");
$detail = $ambil->fetch_assoc();
$harga = $detail['total_harga'];
$bayar = 15 / 100 * $harga;

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
					<th>Total</th>
					<th>Terbayar</th>
					<th>Sisa Pembayaran</th>
					<th>Status</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$nomor=1;
				$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
	
				$ambil = $koneksi->query("SELECT * FROM pembelian AS a JOIN pembayaran AS b ON a.id_pembelian=b.id_pembelian WHERE a.id_pelanggan='$id_pelanggan' AND ket='1' ORDER BY a.id_pembelian DESC");
			
				
				while ($pecah = $ambil->fetch_assoc()){
					
					$sisa = $pecah['total_harga'] - $pecah['jumlah'];

				?>
				
				<tr>
					<td><?php echo $nomor;?></td>
					<td><?php echo $pecah["tanggal_pembelian"]?></td>
					<td>Rp. <?php echo number_format($pecah['total_harga']); ?></td>
					<td>Rp. <?php echo number_format($pecah['jumlah']); ?></td>
					<td>Rp. <?php echo number_format($sisa); ?></td>
					<td><?php
							if ($pecah["status_pembelian"] == "1") {
								echo "Sedang Diproses";
							}elseif ($pecah["status_pembelian"] == "2") {
								echo "Permintaa Sudah Diterima";
							}elseif ($pecah["ket"] == "0") {
								echo "Kesalahan Pembayaran";
							}
					?></td>
					<td>
						<?php if ($pecah['status_pembelian']=="2") { ?>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-info">Nota</a>
						<a href="cicilan.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-primary">Cicilan</a>
						
			
					<?php } elseif ($pecah['tipe']=="2") { ?>
						<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-info">Cek Pembayaran</a>
						<a href="cicilan.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-primary">Cicilan</a>
						
					<?php } elseif ($pecah['status_pembelian']=="2") { ?>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-info">Info</a>
						
					<?php } elseif ($pecah['status_pembelian']=="2") { ?>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-info">Nota</a>
					<?php } elseif ($pecah['status_pembelian']=="4") { ?>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="container">
	<h2>Konfirmasi Pembayaran</h2>
	<p>Kirim Bukti Pembarayan Di sini</p>
	<div class="alert alert-danger">Pembayaran Tahap Awal <b>(DP)</b> 15% Dari Total Harga! <strong><?php echo rupiah($harga)?></strong>
	</div>
	
	<div class="alert alert-success">Total Tagihan Anda <strong><?php echo rupiah($bayar)?></strong>
	<strong>     || BANK BCA 124-020201-2121  CIPTA INFO</strong></div>

	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama Penyetor</label>
			<input type="text" class="form-control" name="nama">
		</div>
		<div class="form-group">
			<label>Bank</label>
			<input type="text" class="form-control" name="bank">
		</div>
		<div class="form-group" data-toggle="tooltip" data-placement="left" title="Jumlah Harus Sesuai!">
			<label>Jumlah</label>
			<input class="form-control" type="number" name="jumlah">
		</div>

		<div class="form-group">
			<label>FOTO Bukti</label>
			<input type="file" class="form-control" name="bukti" required="Harus Diinput">
			<p class="text-danger">*foto bukti harus JPG max 2MB</p>
		</div>
		<button class="btn btn-success" name="kirim">Kirim</button>
	</form>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php
include "footer.php";
?>