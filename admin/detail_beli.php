
	
	<?php
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}
	?>
		<table class="table table-bordered">
			<div class="col-md-7">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Jenis Kayu</th>
						<th style="width:150px;" >Harga Kayu</th>
						<th>Luas Bangunan</th>
						<th>Biaya Pengiriman</th>
						<th>Biaya Pemasangan</th>
						<th style="width:150px;">Sub_Harga</th>
					</tr>
				</thead>
			</div>
			<tbody>
				<?php 
				$nomor=1;
				$totalharga=0;
				$totalberat =0;
				$ambil = $koneksi->query ("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
				$detail = $ambil->fetch_assoc();
				
				$ambil=$koneksi->query("SELECT * FROM pembelian AS a JOIN produk ON a.id_produk=produk.id_produk INNER JOIN detail_pembelian ON a.id_pembelian=detail_pembelian.id_pembelian RIGHT JOIN data_kayu ON detail_pembelian.id_kayu=data_kayu.id_kayu  WHERE a.id_pembelian='$_GET[id]'");
				
				?>

				<?php 
				while($pecah = $ambil->fetch_assoc()){ 
				?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama_produk']; ?></td>
						<td><?php echo $pecah['nama_kayu']; ?></td>
						<td><?php echo rupiah($pecah['harga']); ?> m2</td>
						<td><?php echo $pecah['panjang'].'X'.$pecah['lebar']; ?> M</td>
						<td><?php echo rupiah($pecah['ongkir']); ?></td>
						<td><i>Sudah Termasuk Harga Kayu </i></td>
						<td><?php echo rupiah($pecah['total_harga']); ?></td>
					</tr>
				
				<?php $nomor++; ?>
				<?php $totalharga+=$pecah['total_harga']; ?>
				<?php } ?>
			</tbody>
		
			<tfoot>
				<tr><b>
					<td colspan="7"><b>Total</b></td>
					<?php
						$total = $detail['total_harga'];
						$total_harga = $total * 10 / 100 + $total;
					?>
					<td><b><?php echo rupiah($total_harga); ?></b></td>
				</b></tr>
			</tfoot>
			<tfoot>
				<tr><b>
					<td colspan="7"><i>PPN</i></td>
					<td><i>10%</i></td>
				</b></tr>
			</tfoot>
		</table>
				
<?php 
$ambil1 = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil1->fetch_assoc();

$foto = $koneksi->query("SELECT * FROM produk WHERE '$detail[id_produk]'");
$gambar = $foto->fetch_assoc();
// var_dump($foto);die;
?>
<center><img src="../foto_produk/<?php echo $gambar['foto_produk'];?>" style="width:300px; height:300px"></center><br>
							
<div class="col-md-6">
	<table class="table">
		<tr>
			<td>ID Pembelian </td>
			<td> :</td>
			<td><?php echo $detail['id_pembelian'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Pembelian </td>
			<td> :</td>
			<td><?php echo $detail['tanggal_pembelian'] ?></td>
		</tr>
		<tr>
			<td>Nama Pelnggan </td>
			<td> :</td>
			<td><?php echo $detail['nama'] ?></td>
		</tr>
		<tr>
			<td>Alamat Pelanggan </td>
			<td> :</td>
			<td><?php echo $detail['alamat'] ?></td>
		</tr>
	</table>
</div>
<?php
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$_GET[id]'");
$bukti = $ambil->fetch_assoc();
?>

<div class="col-md-6">
	<form method="POST">
		<table class="table">
			<?php if ($detail['status_pembelian']=="1") { ?>
				<tr>
					<td>Bukti Transfer </td>
					<td>
						<img src="../bukti_pembayaran/<?php echo $bukti['bukti']; ?>" width="100">
					</td>
				</tr>

				<tr>
					<td><b>Status</b></td>
					<td>
						<?php
						if ($detail['status_pembelian']=="1") {
							echo "<i>Menunggu Diproses</i>";
						}
						?>
					</td>
				</tr>
			
			<?php } ?>
		</table>
		<button name="upload">Lanjutakn</button>
		<button name="upload">batalkan</button>
	</form>
</div>
</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Pembayaran</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Mandor</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="pills-pengerjaan-tab" data-toggle="pill" href="#pills-pengerjaan" role="tab" aria-controls="pills-pengerjaan" aria-selected="false">Pengerjaan</a>
  </li>

</ul>
<div class="tab-content" id="pills-tabContent">

  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  
  <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <p class="lead">

	<table class="table">
	<!-- pembayaran1 -->
	<tr>
			<td>Pembayaran 1 </td>
			<td> :</td>
	<? 
	$ket1 = $koneksi->query("SELECT * FROM pembayaran WHERE ket =1");
	$ket = $ket1->fetch_assoc();
	if ($ket['ket'] == 1) { ?>
		
			<td><?php echo rupiah($bukti['jumlah']) ?></td>
			<td>
			<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Detail</button>



			</td>
	<?}else{?>
		<td><i>Belum Melakukan Pembayaran</i></td>

	<?}	?>
	</tr>
		<!-- pembayaran2 -->
	<tr>
			<td>Pembayaran 2 </td>
			<td> :</td>
	<? 
	$ket1 = $koneksi->query("SELECT * FROM pembayaran WHERE ket =2");
	$ket = $ket1->fetch_assoc();
	if ($ket['ket'] == 2) { ?>
			<td><?php echo rupiah($bukti['jumlah']) ?></td>
			<td>
			<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Detail</button>



			</td>
		
	<?}else{?>
		<td><i>Belum Melakukan Pembayaran</i></td>

	<?}	?>
	</tr>
		<!-- pembayaran3 -->
		<tr>
			<td>Pembayaran 3 </td>
			<td> :</td>
	<? 
	$ket1 = $koneksi->query("SELECT * FROM pembayaran WHERE ket =3");
	$ket = $ket1->fetch_assoc();

	if ($ket['ket'] == 3) { ?>
	
			<td><?php echo rupiah($bukti['jumlah']) ?></td>
			<td>
			<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Detail</button>



			</td>
		
	<?}else{?>
		<td><i>Belum Melakukan Pembayaran</i></td>

	<?}	?>
</tr>



<!-- 		
		<tr>
			<td>Pembayaran 2 </td>
			<td> :</td>
			<td><?php echo $detail['tanggal_pembelian'] ?></td>
		</tr>
		<tr>
			<td>Pembayaran 3 </td>
			<td> :</td>
			<td><?php echo $detail['nama'] ?></td>
		</tr> -->
		<tr>
			<td>Status </td>
			<td> :</td>
			<td><?php echo $detail['alamat'] ?></td>
		</tr>
	</table>
	
	
	</p>
  </div>
</div>
  
  </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
  
  <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Mandor</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
  </div>
</div>

  </div>

  <div class="tab-pane fade" id="pills-pengerjaan" role="tabpanel" aria-labelledby="pills-pengerjaan-tab">
  
  <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">pengerjaan</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
  </div>
</div>

  </div>

</div>


</div>
</div>
</div>

<?php if (isset($_POST['upload'])) {
	$status = "2";
	$id = $_GET['id'];
	$koneksi->query("UPDATE pembelian SET id_mandor = '1', status_pembelian = '$status' WHERE id_pembelian = '$id'");
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
} ?>
<br>

