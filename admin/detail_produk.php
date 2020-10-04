<?php 
	$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();
?>
<h2 class="text-center"><?php echo $pecah['nama_produk']; ?></h2><br>
<center><img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" style="width:300px; height:300px"></center><br>

<table class="table">
	<tr>
		<td width="200px">Nama Produk</td>
		<td>:	<?php echo $pecah['nama_produk']; ?></td>
	</tr>
	<tr>
		<td>Kategori</td>
		<td>:	<?php echo $pecah['kategori_produk']; ?></td>
	</tr>
	<tr>
		<td>Deskripsi</td>
		<td>:	<?php echo $pecah['deskripsi_produk']; ?></td>
	</tr>
</table>
<td>
<a href="index.php?halaman=ubah_produk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-primary" title="Ubah" rel="tooltip" >Edit</a>
</td>


		