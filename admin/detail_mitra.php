<?php 
	$ambil = $koneksi->query("SELECT * FROM mitra WHERE id_mitra='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();
?>
<br>
<div>Data Mitra
	<table class="table">
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?php echo $pecah['nama_mitra'] ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><?php echo $pecah['email_mitra'] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?php echo $pecah['alamat_mitra'] ?></td>
		</tr>
		<tr>
			<td>Nomor Telpon</td>
			<td>:</td>
			<td><?php echo $pecah['tlp_mitra'] ?></td>
		</tr>
	</table>
</div>

<div>Riwayat Transaksi
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>NO</th>
				<th>No Nota</th>
				<th>Tanggal</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>

			<?php $nomor=1; ?>
			<?php $ambil1=$koneksi->query("SELECT * FROM pembelian WHERE id_mitra='$_GET[id]' ORDER BY pembelian . tgl_pembelian DESC"); ?>
		    <?php while ($pecah1=$ambil1->fetch_assoc()) {?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td>BELI<?php echo $pecah1['id_pembelian']; ?></td>
				<td><?php echo $pecah1['tgl_pembelian']; ?></td>
				<td><?php echo $pecah1['status_pembelian']; ?></td>
				<td>
					<a href="index.php?halaman=detail_beli&id=<?php echo $pecah1['id_pembelian']; ?>">Detail</a>
				</td>
			</tr>
			<?php $nomor++; ?>
			<?php } ?>
		</tbody>
	</table>
</div>