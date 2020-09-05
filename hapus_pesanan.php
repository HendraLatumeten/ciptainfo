
<?php

include "koneksi.php";

$koneksi->query("DELETE FROM pembelian WHERE id_pembelian='$_GET[id]'");

    
    echo "<script>alert('Batalkan Pesanan Berhasil');</script>";
	echo "<script>location='riwayat.php';</script>";

?>