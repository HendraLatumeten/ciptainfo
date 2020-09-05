<?php 
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]' ");
	$pecah = $ambil->fetch_assoc();
?>
<br>
<div>Data pelanggan
	<table class="table">
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?php echo $pecah['nama'] ?></td>
		</tr>
			<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?php echo $pecah['alamat'] ?></td>
		</tr>
			<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td><?php echo $pecah['jk'] ?></td>
		</tr>
			<tr>
			<td>Pekerjaan</td>
			<td>:</td>
			<td><?php echo $pecah['pekerjaan'] ?></td>
		</tr>
		<tr>
			<td>Nomor Telpon</td>
			<td>:</td>
			<td><?php echo $pecah['tlp'] ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><?php echo $pecah['email'] ?></td>
		</tr>
	
		
	</table>
	<a href="index.php?halaman=pelanggan" class="btn btn-primary">Kembali</a>
</div>
