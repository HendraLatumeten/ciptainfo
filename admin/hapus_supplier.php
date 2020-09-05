<?php

	$ambil = $koneksi->query("SELECT * FROM mitra WHERE id_mitra='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();

	$koneksi->query("DELETE FROM mitra WHERE id_mitra='$_GET[id]'");

	echo "<script>alert('data mitra terhapus');</script>";
	echo "<script>location='index.php?halaman=mitra'</script>";

?>