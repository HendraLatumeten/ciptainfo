<h2>Selamat Datang <?php echo $_SESSION['supplier']['nama_supplier']; ?>!</h2>

<?php
$id = $_SESSION['supplier']['id_supplier'];
$ambilCreated = $koneksi->query("SELECT * FROM pembelian WHERE id_supplier = '$id' AND status_pembelian = 'Created'");
$ambilProcess = $koneksi->query("SELECT * FROM pembelian WHERE id_supplier = '$id' AND status_pembelian = 'Process'");
$ambilOTW = $koneksi->query("SELECT * FROM pembelian WHERE id_supplier = '$id' AND status_pembelian = 'On The Way'");
$ambilFinish = $koneksi->query("SELECT * FROM pembelian WHERE id_supplier = '$id' AND status_pembelian = 'Finish'");
$ambilCancel = $koneksi->query("SELECT * FROM pembelian WHERE id_supplier = '$id' AND status_pembelian = 'Cancel'");
$ambilExpired = $koneksi->query("SELECT * FROM pembelian WHERE id_supplier = '$id' AND status_pembelian = 'Expired'");
$created = $ambilCreated->num_rows;
$process = $ambilProcess->num_rows;
$otw = $ambilOTW->num_rows;
$finish = $ambilFinish->num_rows;
$cancel = $ambilCancel->num_rows;
$expired = $ambilExpired->num_rows;

?>

<div class="col-md-4">
	<h3>Info Pesanan : </h3>
	<h4 class="alert alert-info"><b><?php echo $created; ?></b> Pesanan dengan status Created</h4>
	<h4 class="alert alert-info"><b><?php echo $process; ?></b> Pesanan dengan status Process</h4>
	<h4 class="alert alert-success"><b><?php echo $otw; ?></b> Pesanan dengan status On The Way</h4>
	<h4 class="alert alert-success"><b><?php echo $finish; ?></b> Pesanan dengan status Finish</h4>
	<h4 class="alert alert-warning"><b><?php echo $cancel; ?></b> Pesanan dengan status Cancel</h4>
	<h4 class="alert alert-danger"><b><?php echo $expired; ?></b> Pesanan dengan status Expired</h4>
</div>