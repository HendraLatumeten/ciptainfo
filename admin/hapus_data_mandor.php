<?php



	$koneksi->query("DELETE FROM mandor WHERE id_mandor='$_GET[id]'");

	echo "<script>alert('data mandor terhapus');</script>";
	echo "<script>location='index.php?halaman=mandor'</script>";

?>