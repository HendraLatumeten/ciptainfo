<?php

include "header.php";
include "menu.php";
?>


	
	<!-- start: Page Title -->
	<div id="page-title">

		<div id="page-title-inner">

			<!-- start: Container -->
			<div class="container">

				<h2>Checkout</h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: Page Title -->
	
	

	<div class=" w3l_related_products container">
		<h3 class="text-center">Check Out</h3>
		<br>
			<table class="table table-bordered">
				<thead>
					<tr>

						<th>No</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Jumlah Beli</th>
						<th>Subharga</th>
						<th>Total Harga</th>

					</tr>
			    <tbody>
					<?php 

					$nomor=1;
					$totalharga=0;
					$totalberat =0;
					foreach ($_SESSION['keranjang'] as $key => $jumlah):
					$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$key'");
					$pecah = $ambil->fetch_assoc();
					$total = $jumlah*$pecah['harga']; 
					?>

						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $pecah['nama']; ?></td>
							<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
							<td><center><?php echo number_format($jumlah); ?></center></td>
						
							<td>Rp. <?php echo number_format($total); ?></td>
				
						</tr>

					<?php $nomor++; ?>
					<?php $totalharga+=$total; 
					 ?>
					<?php endforeach ?>

				</tbody>
				<tfoot>
					<tr><b>
						<td colspan="5"><b>Total</b></td>
						
						<td><b>Rp. <?php echo number_format($totalharga); ?></b></td>
					</b></tr>
				</tfoot>
			</table>
		</thead>
	</table>
</div>



<div id="wrapper">
	<div class="container">
		<div class="title"><h3>Detail Penerima</h3></div>


<?php
            
$query = mysqli_query($koneksi, "SELECT * FROM pelanggan ");
$data  = mysqli_fetch_array($query);

?>

<form method="post">
	<div class="row">
		<div class="col-md4">
			<div class="form-group">
				<tr>
			        <td><label>Nama :</label></td>
			        <td>
			        	<input readonly type="text" class="form-control" value="<?php echo ($_SESSION["pelanggan"]['nama']);?> ">
			        </td>
			    </tr>
			</div>
		</div>
		<div class="col-md4">
			<div class="form-group">
				<tr>
			        <td><label>Email :</label></td>
			        <td><input readonly type="text" class="form-control" value="<?php echo ($_SESSION["pelanggan"]['email']);?> "></td>
			    </tr>
			</div>
		</div>
		<div class="col-md4">
			<div class="form-group">
				<tr>
			        <td><label>No Telp :</label></td>
			        <td><input  type="text" class="form-control" value="<?php echo ($_SESSION["pelanggan"]['tlp']);?> " required></td>
			    </tr>
			</div>
		</div>
		<div class="col-md4">
			<div class="form-group">
				<tr>
			        <td><label>Alamat :</label></td>
			        <td><textarea type="text" class="form-control" name="alamat"></textarea></td>
			    </tr> 
			</div>
		<div class="col-md4">
			<div class="form-group">
				<select class="form-control" name="id_ongkir" required="">
					<option value="">Pilih Ongkos kirim</option>
					<?php
					$ambil = $koneksi->query("SELECT * FROM ongkir");
					while ($perongkir = $ambil->fetch_assoc()){
					?>
					<option value="<?php echo $perongkir["id_ongkir"]?>">
						<?php echo $perongkir['nama_kota']?> -
						Rp. <?php echo number_format($perongkir['tarif'])?>
						</option>
					<?php }	?>
				</select>
			</div>
		</div><br>
		<button class="btn btn-success" name="checkout">Checkout</button>


		<?php
		if (isset($_POST["checkout"]))
		{
			// tambah tarif dan lihat pembelian
			$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
			$id_ongkir = $_POST["id_ongkir"];
			$tanggal_pembelian = date("Y-m-d");

			$ambil = $koneksi ->query("SELECT * FROM ongkir where id_ongkir='$id_ongkir'");
			$arrayongkir = $ambil->fetch_assoc();
			$nama_kota = $arrayongkir['nama_kota'];
			$tarif = $arrayongkir['tarif'];

			$alamat = $_POST['alamat'];
			$total_pembelian = $totalharga + $tarif;

			$koneksi->query("INSERT INTO pembelian (id_pelanggan,jenis_pembelian,tgl,total,alamat,status,keterangan) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$alamat','$nama_kota','$tarif')");


			$id_pembelian_barusan = $koneksi->insert_id;

			foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
			{

				$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$perproduk = $ambil->fetch_assoc();

				$nama = $perproduk['nama'];
				$harga = $perproduk['harga'];
				
				$subharga = $perproduk['harga_produk']*$jumlah;
				$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");


				$koneksi->query("UPDATE produk SET stok_produk=stok_produk-$jumlah WHERE id_produk='$id_produk'");

			}

			unset($_SESSION["keranjang"]);

		echo "<script>alert('pembelian_sukses');</script>";
		echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
		}

		?>
</div>
</form>
</div>
</div>


<pre><?php print_r($_SESSION['pelanggan'])?></pre>
<pre><?php print_r($_SESSION['keranjang'])?></pre>
<?php
include "footer.php";
?>


</body>
</html>