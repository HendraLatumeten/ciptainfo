<tbody>
		<?php $admin= $_SESSION['admin'];
		
		?>
		<?php $ambil=$koneksi->query("SELECT * FROM admin WHERE id_admin =$admin"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<tr>
			<td><h2>Selamat Datang <?php echo $pecah['fullname']; ?>!</td>
			</h2></td>
		</tr>
		</tbody>
		<?php } ?>

<?php
$ambiljumlahkayu = $koneksi->query("SELECT * FROM data_kayu WHERE id_kayu");
$kayu = $ambiljumlahkayu->num_rows;

$ambiljumlahpelanggan = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan");
$pelanggan = $ambiljumlahpelanggan->num_rows;



// $ambiljumlahproduk = $koneksi->query("SELECT * FROM supplier WHERE id_supplier");
// $supplier = $ambiljumlahproduk->num_rows;



//  $ambiljumlahpenjualan = $koneksi->query("SELECT * FROM penjualan WHERE id_penjualan");
//  $penjualan = $ambiljumlahpenjualan->num_rows;
 

//   $ambiljumlahpembelian = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian");
//   $pembelian = $ambiljumlahpembelian->num_rows;
   ?> 

<div class="col-md-4">
	<h3>Info Data CIPTAINFO : </h3>
  <h4 class="alert alert-info"><b><?php echo $kayu; ?></b> DATA KAYU</h4>
  <h4 class="alert alert-info"><b><?php echo $pelanggan; ?></b> DATA PELANGGAN</h4>
	<!-- <h4 class="alert alert-info"><b><?php echo $supplier; ?></b> JUMLAH SUPPLIER</h4> -->
  <!-- <h4 class="alert alert-info"><b><?php echo $penjualan; ?></b> DATA PENJUALAN</h4> -->
  <!-- <h4 class="alert alert-info"><b><?php echo $pembelian; ?></b> DATA PEMBELIAN</h4> -->
  <!-- <h4 class="alert alert-info"><b><?php echo $pembelian; ?></b> DATA PEMBELIAN</h4> -->
  
</div>
			
