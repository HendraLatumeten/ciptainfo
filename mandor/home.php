<tbody>
		<?php $mandor= $_SESSION['mandor'];
		
		?>
		<?php $ambil=$koneksi->query("SELECT * FROM mandor WHERE id_mandor =$mandor"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<tr>
			<td><h2>Selamat Datang <?php echo $pecah['username']; ?>!</td>
			</h2></td>
		</tr>
		</tbody>
		<?php } ?>

<?php
$project = $koneksi->query("SELECT * FROM pembelian WHERE id_mandor = '$mandor'");
$mandor1 = $project->num_rows;

$a = $koneksi->query("SELECT * FROM pembelian WHERE id_mandor = '$mandor' AND status_pembelian='2'");
$progres = $a->num_rows;
$b = $koneksi->query("SELECT * FROM pembelian WHERE id_mandor = '$mandor' AND status_pembelian='3'");
$selesai = $b->num_rows;

//-- $ambiljumlahpelanggan = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan");
// $pelanggan = $ambiljumlahpelanggan->num_rows;

// -- $ambiljumlahproduk = $koneksi->query("SELECT * FROM produk WHERE id_produk");
// -- $produk = $ambiljumlahproduk->num_rows;



//  $ambiljumlahpenjualan = $koneksi->query("SELECT * FROM penjualan WHERE id_penjualan");
//  $penjualan = $ambiljumlahpenjualan->num_rows;
 

//   $ambiljumlahpembelian = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian");
//   $pembelian = $ambiljumlahpembelian->num_rows;
   ?> 

<div class="col-md-4">
	<h3>Info Data Pengerjaan Mandor CIPTAINFO</h3>
	<p>Total Project: <?php echo $mandor1; ?></p>
  <h4 class="alert alert-danger"><b><?php echo $progres; ?></b> Proses</h4>
  <h4 class="alert alert-info"><b><?php echo $selesai; ?></b> Selesai</h4>  
</div>
			
