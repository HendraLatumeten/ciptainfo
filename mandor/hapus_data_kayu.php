<?php


	$koneksi->query("DELETE FROM data_kayu WHERE id_kayu='$_GET[id]'");

	echo "<script>alert('data produk terhapus');</script>";
	echo "<script>location='index.php?halaman=data_kayu'</script>";

?>