<?php

include "header.php";
include "menu.php";
?>
<?php

if(!isset($_SESSION["customer"]))
{
	echo "<script>alert('silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

$id_customer_beli = $detpem["id_customer"];
$id_customer_login = $_SESSION["customer"]["id_customer"];

if($id_customer_login !==$id_customer_beli)
{
	echo "<script>alert('Acces Denied');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

<div id="page-title">

		<div id="page-title-inner">

			<!-- start: Container -->
			<div class="container">

				<h2>Konfirmasi Pembayaran</h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>

<div class="container">
	<h2>Konfirmasi Pembayaran</h2>
	<p>Kirim Bukti Pembarayan Di sini</p>
	<div class="alert alert-success">Total Tagihan Anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"])?></strong></div>

	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama Penyetor</label>
			<input type="text" class="form-control" name="nama">
		</div>
		<div class="form-group">
			<label>Bank</label>
			<input type="text" class="form-control" name="bank">
		</div>
		<div class="form-group">
			<label>Jumlah</label>
			<input type="number" class="form-control" name="jumlah" min="1">
		</div>
		<div class="form-group">
			<label>FOTO Bukti</label>
			<input type="file" class="form-control" name="bukti" >
			<p class="text-danger">*foto bukti harus JPG max 2MB</p>
		</div>
		<button class="btn btn-success" name="kirim">Kirim</button>
	</form>
</div>

<?php 

if (isset($_POST["kirim"]))
{
	$namabukti = $_FILES['bukti']['name'];
	$lokasibukti = $_FILES['bukti']['tmp_name'];
	$namafiks = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");

	$koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");

	$koneksi->query("UPDATE pembelian SET status_pembelian='Sedang Diproses' WHERE id_pembelian='$idpem'");
	echo "<script>alert('Pembayaran Berhasil');</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>


<?php
include "footer.php";
?>