<?php

$ambil = $koneksi->query("SELECT * FROM pembelian");
$detail = $ambil->fetch_assoc();
$resi = $_POST[resi];

if ($detail['status_pembelian']=="Created") {
	
	$koneksi->query("UPDATE pembelian SET status_pembelian = 'Process' WHERE id_pembelian='$_GET[id]'");
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pesanan'>";

} elseif ($detail['status_pembelian']=="Process") {

	$koneksi->query("UPDATE pembelian SET status_pembelian = 'On The Way' WHERE id_pembelian='$_GET[id]'");
	$koneksi->query("UPDATE pembelian SET resi_pembelian = '$_POST[resi]' WHERE id_pembelian='$_GET[id]'");
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pesanan'>";

}

?>