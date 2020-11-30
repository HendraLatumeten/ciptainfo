

<h2 class="text-center"><?php echo $pecah['nama']; ?></h2><br>
<center><img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" style="width:300px; height:200px"></center><br>

<div class="row">
<b>Pelanggan</b>
<div class="col-6">
<table class="table">
	<tr>
		<td width="200px">Nama Pelanggan</td>
		<td>:	<?php echo $pecah['nama']; ?></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:	<?php echo $pecah['alamat']; ?></td>
	</tr>
	<tr>
		<td>Tlpn</td>
		<td>:	<?php echo $pecah['tlp']; ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td>:	<?php echo $pecah['email']; ?></td>
	</tr>
</table>
</div>

<div class="col-6">
<b>Pembelian</b>
<table class="table">
	<tr>
		<td width="200px">Nama Produk</td>
		<td>:	<?php echo $pecah['nama_produk']; ?></td>
	</tr>
	<tr>
		<td>Jenis Kayu</td>
		<td>:	<?php echo $pecah1['nama_kayu']; ?></td>
	</tr>
	<tr>
		<td>Panjang</td>
		<td>:	<?php echo $pecah1['panjang']."m";?></td>
	</tr>
	<tr>
		<td>Lebar</td>
		<td>:	<?php echo $pecah1['lebar']."m"; ?></td>
	</tr>
	<tr>
		<td>Harga Kayu</td>
		<td>:	<?php echo "Rp"." ".number_format($pecah1['harga_kayu'],2,',','.'); ?></td>
	</tr>	
	<tr>
		<td>Total Harga</td>
		<td>:	<?php echo "Rp"." ".number_format($pecah['total_harga'],2,',','.'); ?></td>
	</tr>
</table>
<b>Alamat Pembelian</b>

<table class="table">
	<tr>
		<td width="200px">Provinsi</td>
		<td>:	<?php echo $prov['nama']; ?></td>
	</tr>
	<tr>
		<td>Kabupaten</td>
		<td>:	<?php echo $kab['nama']; ?></td>
	</tr>
	<tr>
		<td>Kecamatan</td>
		<td>:	<?php echo $kec['nama']; ?></td>
	</tr>
	<tr>
		<td>Kelurahan</td>
		<td>:	<?php echo $kel['nama']; ?></td>
	</tr>
	<tr>
		<td>Lokasi</td>
		<td>:	<?php echo $pecah1['lokasi']; ?></td>
	</tr>

</table>
</div>

</div>



		