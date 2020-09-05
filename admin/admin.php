
<h2 class="text-center">Data Admin</h2>

<table id="tabel1" class="display table table-bordered">
	<thead>
		<tr>
			<th title="urutkan berdasarkan nomor">NO</th>
			<th title="urutkan berdasarkan nomor">Id Admin</th>
			<th title="urutkan berdasarkan nama">Username</th>
			<th title="urutkan berdasarkan nomor">password</th>
			<th title="urutkan berdasarkan nama">jenis kelamin</th>
			<th title="urutkan berdasarkan nomor">alamat</th>
			<th title="urutkan berdasarkan nama">email</th>
			<th title="urutkan berdasarkan nomor">no_tlp</th>
			<th><center>Aksi</center></th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM admin"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['id_admin']; ?></td>
			<td><?php echo $pecah['username']; ?></td>
			<td><?php echo $pecah['passsword']; ?></td>
			<td><?php echo $pecah['jenis_kelamin']; ?></td>
			<td><?php echo $pecah['alamat']; ?></td>
			<td><?php echo $pecah['email']; ?></td>
			<td><?php echo $pecah['no_telp']; ?></td>
			<td><center>
				
				<a href="index.php?halaman=hapus_admin&id=<?php echo $pecah['id_admin']; ?>" class="btn btn-danger" title="Hapus"  onclick="return confirm('yakin ingin hapus data?')">Hapus</a>
			</center>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>

	</tbody>
</table>

<a href="index.php?halaman=tambah_admin" title="Tambah data admin" class="btn btn-primary">Tambah Admin</a>
