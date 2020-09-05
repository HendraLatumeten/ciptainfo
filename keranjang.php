<?php

include "header.php";
include "menu.php";
?>

<?php

if(!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
}
elseif(!isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Keranjang Anda Kosong');</script>";
	echo "<script>location='produk.php';</script>";
}
?>

	
	<!-- start: Page Title -->
	<div id="page-title">

		<div id="page-title-inner">

			<!-- start: Container -->
			<div class="container">

				<h2><i class="ico-usd ico-white"></i>Keranjang</h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: Page Title -->
	
	<!--start: Wrapper-->
		<div class=" w3l_related_products container">
		<h3 class="text-center">Keranjang</h3>
		<br>
			<table class="table table-bordered">
				<thead>
					<tr>

						<th>No</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Jumlah Beli</th>
						<th>Subharga</th>
						<th><center>Aksi</center></th>
						
					</tr>
				</thead>
				<tbody>
					<?php 

					$nomor=1;
					$totalharga=0;
					$totalberat =0;
					foreach ($_SESSION["keranjang"] as $key => $jumlah):
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
							<td><center><a href="beli.php?act=plus&amp;id_produk=<?php echo $key; ?>&amp;ref=keranjang.php" class="btn btn-xs btn-success" style="width:25px; height:25px">+</a> <a href="beli.php?act=min&amp;id_produk=<?php echo $key; ?>&amp;ref=keranjang.php" class="btn btn-xs btn-warning" style="width:25px; height:25px">-</a> <a href="beli.php?act=del&amp;id_produk=<?php echo $key; ?>&amp;ref=keranjang.php" class="btn btn-xs btn-danger" style="width:50px; height:25px">Hapus</a></center></td>
				
						</tr>

					<?php $nomor++; ?>
					<?php $totalharga+=$total; ?>
					
					<?php endforeach ?>

				</tbody>
				<tfoot>
					<tr><b>
						<td colspan="5"><b>Total</b></td>
						
						<td><b>Rp. <?php echo number_format($totalharga); ?></b></td>
					</b></tr>
				</tfoot>
			</table>

			<?php
				if($totalharga == 0){
					echo '<tr><td colspan="5" align="center">Ups, Keranjang kosong!</td></tr></table>';
					echo '<p><div align="right">
						<a href="index.php" class="btn btn-info btn-lg">&laquo; Tambah Lagi?</a>
						</div></p>';
				} else {
					echo '<a href="index.php" class="btn btn-info">&laquo; Tambah Lagi?</a> &nbsp';
					echo '<a href="checkout.php" class="btn btn-success"> CHECKOUT &raquo;</a>';
				}
				?>
			
				
			<!-- end: Table -->

		</div>
		<!-- end: Container -->
				
	</div>
	<!-- end: Wrapper  -->			

    <!-- start: Footer Menu -->


    
	<?php
include "footer.php";
?>

</body>
</html>