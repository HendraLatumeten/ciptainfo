<?php

	

	$koneksi->query("UPDATE mandor SET status='0' WHERE id_mandor='$_GET[id]'");

	echo "<script>location='index.php?halaman=mandor'</script>";

?>