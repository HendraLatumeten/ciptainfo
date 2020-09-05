<?php

	$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();
	$foto_produk = $pecah['foto'];

	if (file_exists("../foto_produk/&foto_produk")) {

		unlink("../foto_produk/$foto");
		echo "<script>alert('produk terhapus');</script>";
	}

	$koneksi->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

	echo "<script>alert('data produk terhapus');</script>";
	echo "<script>location='index.php?halaman=produk'</script>";

?>