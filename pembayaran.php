<?php

include "header.php";
include "menu.php";
?>
<?php
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
} 
if(!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}
$id = $_GET["id"];
$ambil = $koneksi->query ("SELECT * FROM pembelian WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
$harga = $detail['total_harga'];
$bayar = 15 / 100 * $harga;
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

<?php 

if (isset($_POST["kirim"]))
{
	$namabukti = $_FILES['bukti']['name'];
	$lokasibukti = $_FILES['bukti']['tmp_name'];
	$namafiks = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

	$idpem = $_GET["id"];
	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");

	$koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti,ket) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks','1')");
	$koneksi->query("UPDATE pembelian SET status_pembelian='1' WHERE id_pembelian='$idpem'");
	echo "<script>alert('Pembayaran Berhasil');</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>


<?php
include "footer.php";
?>

<script type="text/javascript">
var jumlah = document.getElementById("jumlah");
jumlah.addEventListener("keyup", function(e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  jumlah.value = formatRupiah(this.value, "Rp. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    jumlah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    jumlah += separator + ribuan.join(".");
  }

  jumlah = split[1] != undefined ? jumlah + "," + split[1] : jumlah;
  return prefix == undefined ? jumlah : jumlah ? "" + jumlah : "";
}

</script>