<?php 
	$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan INNER JOIN produk ON pembelian.id_produk=produk.id_produk WHERE id_pembelian='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();

	$a = $koneksi->query("SELECT * FROM detail_pembelian JOIN data_kayu ON detail_pembelian.id_kayu=data_kayu.id_kayu WHERE id_pembelian='$_GET[id]'");
	$pecah1 = $a->fetch_assoc(); 


	function rupiah($angka){
	
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;
	 
	}

?>

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
<?php 
	$prv = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN provinsi AS b ON a.id_prov=b.id_prov WHERE id_pembelian='$_GET[id]'");
	$prov = $prv->fetch_assoc();

	$kabu = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN kabupaten AS b ON a.id_kab=b.id_kab WHERE id_pembelian='$_GET[id]'");
	$kab = $kabu->fetch_assoc();

	$keca = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN kecamatan AS b ON a.id_kec=b.id_kec WHERE id_pembelian='$_GET[id]'");
	$kec = $keca->fetch_assoc();

	$kelu = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN kelurahan AS b ON a.id_kel=b.id_kel WHERE id_pembelian='$_GET[id]'");
	$kel = $kelu->fetch_assoc();
?>
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

<td>
<a href="index.php?halaman=project" class="btn btn-info" title="kembali" rel="tooltip" >Kembali</a>
<a href="index.php?halaman=ubah_produk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-primary" title="proses pengerjaan" rel="tooltip" >Proses Pengerjaan</a>
</td>


		