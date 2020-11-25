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
				<th style="width:150px;">Harga Kayu</th>
				<th>Luas Bangunan</th>
				<th>Biaya Pengiriman</th>
				<th>Biaya Pemasangan</th>
				<th style="width:150px;"><b>Total Harga</b></th>
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
			<td><?php echo rupiah($pecah['harga_kayu']); ?> </td>
			<td><?php echo $pecah['panjang'].'X'.$pecah['lebar']; ?> M</td>
			<td><?php echo rupiah($pecah['ongkir']); ?></td>
			<td><i>Sudah Termasuk Harga Kayu </i></td>
			<td><?php echo rupiah($pecah['total_harga']); ?></td>
		</tr>

		<?php $nomor++; ?>
		<?php $totalharga+=$pecah['total_harga']; ?>
		<?php } ?>
	</tbody>


</table>

<?php 
$ambil1 = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil1->fetch_assoc();
$id = $_GET["id"];

$harga = $detail['total_harga'];
$bayar1= 15 / 100 * $harga;
$bayar2= 50 / 100 * $harga;
$bayar3= 35 / 100 * $harga;

$foto = $koneksi->query("SELECT * FROM produk WHERE '$detail[id_produk]'");
$gambar = $foto->fetch_assoc();
// var_dump($foto);die;
?>

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
		<tr>
			<td>Telp </td>
			<td> :</td>
			<td><?php echo $detail['tlp'] ?></td>
		</tr>
		<tr>
			<td>Status </td>
			<td> :</td>
			<td><b><u>
						<?php
						if ($detail['status_pembelian']=="1") {
							echo "<i>Menunggu Diproses</i>";
						}else{
							echo "<i>Dalam Pengerjaan</i>";
						}
						?>
			</td></b></u>
		</tr>
	</table>
</div>
<?php
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$_GET[id]'");
$bukti = $ambil->fetch_assoc();
?>

<div class="col-md-6">
	<form method="POST">
		<img src="../foto_produk/<?php echo $gambar['foto_produk'];?>" style="width:100%; height:300px">
		<br><br>
		<?if ($detail['status_pembelian']=="0") {?>
		<button type="submit" class="btn btn-primary" name="upload">Proses</button>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#batalkanModal">
			Batalkan
		</button>
		<?}?>


	</form>
</div>
</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

	<li class="nav-item">
		<a class="nav-link" id="pills-pembayaran-tab" data-toggle="pill" href="#pills-pembayaran" role="tab"
			aria-controls="pills-pembayaran" aria-selected="false">Pembayaran</a>
	</li>
	<?php if ($detail['status_pembelian'] >= "1") {?>
	<li class="nav-item">
		<a class="nav-link" id="pills-mandor-tab" data-toggle="pill" href="#pills-mandor" role="tab"
			aria-controls="pills-mandor" aria-selected="false">Mandor</a>
	</li>

	<li class="nav-item">
		<a class="nav-link" id="pills-pengerjaan-tab" data-toggle="pill" href="#pills-pengerjaan" role="tab"
			aria-controls="pills-pengerjaan" aria-selected="false">Pengerjaan</a>
	</li>
	<?}?>
</ul>
<div class="tab-content" id="pills-tabContent">

	<div class="tab-pane fade" id="pills-pembayaran" role="tabpanel" aria-labelledby="pills-pembayaran-tab">

		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<p class="lead">

					<table class="table">
						<!-- pembayaran1 -->
						<tr>
							<td>Pembayaran 1 </td>
							<td> :</td>
							<? 
							$ket11 = $koneksi->query("SELECT * FROM pembayaran WHERE tipe =1");
							$ket1 = $ket11->fetch_assoc();
							if ($ket1['tipe'] == 1 AND $ket1['ket'] == 1 ) { ?>

							<td><?php echo rupiah($ket1['jumlah']) ?></td>
							<td>
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal"
									data-target="#exampleModal">Detail</button>



								<button type="button" class="btn btn-danger" data-toggle="modal"
									data-target="#verifikasiModal1">Verifikasi Pembayaran</button>


							</td>
							
							<?}else if($ket1['tipe'] == 1 AND $ket1['ket'] == 2 ){?>
								<td><i>Pembayaran Sudah TerVerifikasi</i></td>
							<?}else if($ket1['tipe'] == 1 AND $ket1['ket'] == 0){?>
								<td><i>Harap Untuk Menghubungi Pembeli Untuk Melanjutkan Pembayaran Yang Telah Dibatalkan</i></td>
							<?}else{?>
								<td><i>Belum Melakukan pembayaran</i></td>
							<?}?>
						</tr>
						<!-- pembayaran2 -->
						<tr>
							<td>Pembayaran 2 </td>
							<td> :</td>
							<? 
							$ket22 = $koneksi->query("SELECT * FROM pembayaran WHERE tipe =2");
							$ket2 = $ket22->fetch_assoc();
							if ($ket2['tipe'] == 2 AND $ket2['ket'] == 1  ) { ?>
							<td><?php echo rupiah($ket2['jumlah']) ?></td>
							<td>
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal"
									data-target="#exampleModal2">Detail</button>
								<button type="button" class="btn btn-danger" data-toggle="modal"
									data-target="#verifikasiModal2">Verifikasi Pembayaran</button>



							</td>

							<?}else if($ket2['tipe'] == 2 AND $ket2['ket'] == 2 ){?>
								<td><i>Pembayaran Sudah TerVerifikasi</i></td>
							<?}else if($ket2['tipe'] == 2 AND $ket2['ket'] == 0){?>
								<td><i>Harap Untuk Menghubungi Pembeli Untuk Melanjutkan Pembayaran Yang Telah Dibatalkan</i></td>
							<?}else{?>
								<td><i>Belum Melakukan pembayaran</i></td>
							<?}?>
						</tr>
						<!-- pembayaran3 -->
						<tr>
							<td>Pembayaran 3 </td>
							<td> :</td>
							<? 
							$ket33= $koneksi->query("SELECT * FROM pembayaran WHERE tipe =3");
							$ket3 = $ket33->fetch_assoc();

							if ($ket3['tipe'] == 3 AND $ket3['ket'] == 1 ) { 
							?>

							<td><?php echo rupiah($ket3['jumlah']) ?></td>
							<td>
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal"
									data-target="#exampleModal3">Detail</button>
								<button type="button" class="btn btn-danger" data-toggle="modal"
									data-target="#verifikasiModal3">Verifikasi Pembayaran</button>



							</td>

							<?}else if($ket3['tipe'] == 3 AND $ket3['ket'] == 2 ){?>
								<td><i>Pembayaran Sudah TerVerifikasi</i></td>
							<?}else if($ket3['tipe'] == 3 AND $ket3['ket'] == 0){?>
								<td><i>Harap Untuk Menghubungi Pembeli Untuk Melanjutkan Pembayaran Yang Telah Dibatalkan</i></td>
							<?}else{?>
								<td><i>Belum Melakukan pembayaran</i></td>
							<?}?>
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
							<td><b>Status Pembayaran</b></td>
							<td> :</td>
							<td><?php 
							$tahap1= $koneksi->query("SELECT MAX(tipe) FROM pembayaran");
							
							$tahap = $tahap1->fetch_assoc();
							var_dump($tahap);
							if ($tahap =='1'){
						echo '<b><p>Tahap 1 : Survei</p></b>';

						}else if($tahap == '2'){
						echo '	<b><p>Tahap 2 : Pengiriman Dan Pemasangan</p></b>';
						}else if($tahap =="3"){
							echo '<b><p>Tahap 3 : Finishing</p></b>';
							
						}
							 ?>
						</td>
						</tr>
					</table>


				</p>
			</div>
		</div>

	</div>

	<div class="tab-pane fade" id="pills-mandor" role="tabpanel" aria-labelledby="pills-mandor-tab">

		<div class="jumbotron jumbotron-fluid">
			<div class="container">
			<h5 class="display-4">Mandor untuk Mengawasi Pengerjaan Proyek</h5>
			<?
			$mandor1 = $koneksi->query("SELECT id_mandor FROM pembelian WHERE id_pembelian='$_GET[id]'");
			$mandor2 = $mandor1->fetch_assoc();
			?>
			<?if ($mandor2 == 0) {?>
		
				<form action="" method="post">
				<select name="mandor">
					<option disabled selected> Pilih Mandor </option>
					<?php 
					$mandor=mysqli_query($koneksi,"SELECT * FROM mandor");
					while ($data=mysqli_fetch_array($mandor)) {
					?>
					<option value="<?=$data['id_mandor']?>"><?=$data['username']?></option> 
					<?php
					}
					?>
					</select>
					<button type="submit" class="btn btn-primary" name="savemandor">Simpan</button>
					</form>
					<?php if (isset($_POST['savemandor'])) {
			
					$id = $_GET['id'];
					$mandor = $_POST['mandor'];
					$koneksi->query("UPDATE pembelian SET id_mandor = '$mandor' WHERE id_pembelian = '$id'");
				
					echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
					} ?>
		<?	}else{ ?>
			<?php
	//   $mandor3 = $koneksi->query("SELECT * FROM pembelian JOIN mandor ON pembelian.id_mandor=mandor.id_mandor WHERE id_pembelian='$_GET[id]'");
		   $mandor4=$koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$_GET[id]'");
		   $mandor6 = $mandor4->fetch_assoc();  
		   $man = $mandor6['id_mandor'];
	
		   ?>
				<form action="" method="post">
			
			<select name="mandor" value="<? echo $mandor6?>">
			<option disabled selected> Pilih Mandor </option>
                           <?
						
							$mandor5=$koneksi->query("SELECT * FROM mandor");
							while ($data=mysqli_fetch_array($mandor5))
                            {
							$id_man=$data['id_mandor'];
							$name=$data['username'];
                           //Data akan terseleksi (selected) jika variabel $kode sama dengan $kdprincipal
                            if($man==$id_man){
                            $cek="selected";
                            }
                            else{
                            $cek="";
                            }
                            echo"<option value='$id_man' $cek>$name</option>";
                           
                            }
						
							?>
							</select>    
     
				
					
					<button type="submit" class="btn btn-primary" name="updatemandor">update</button>
					</form>
					<!--  -->
					<?php if (isset($_POST['updatemandor'])) {
			
            $id = $_GET['id'];
            $mandor = $_POST['mandor'];
            $koneksi->query("UPDATE pembelian SET id_mandor = '$mandor' WHERE id_pembelian = '$id'");
       
			echo "<script>alert('Mandor Berhasil Diganti') </script>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=detail_beli&id=$id'>";
            } ?>
			<?	} ?>
			</div>
		</div>

	</div>

	<div class="tab-pane fade" id="pills-pengerjaan" role="tabpanel" aria-labelledby="pills-pengerjaan-tab">

		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">pengerjaan</h1>
				<p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.
				</p>
			</div>
		</div>

	</div>




</div>


</div>
</div>
</div>

<?php if (isset($_POST['upload'])) {
	$status = "1";
	$id = $_GET['id'];
	$koneksi->query("UPDATE pembelian SET status_pembelian = '$status' WHERE id_pembelian = '$id'");
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
} ?>
<br>