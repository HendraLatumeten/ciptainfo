<?php

include "header.php";
include "menu.php";
?>

	<!-- start: Slider -->
<link href="cssslider/styleslider.css" rel="stylesheet">
	<div class="slider-wrapper">

	<?php

include "slide.php";

?>	
	</div>

	<script src="jsslider/jquery-1.8.2.js"></script>
  	<script src="jsslider/bootstrap.js"></script>
  	<script src="jsslider/flexslider.js"></script>
  	<script src="jsslider/carousel.js"></script>
  	<script src="jsslider/jquery.cslider.js"></script>
  	<script src="jsslider/slider.js"></script>
  	<script def src="jsslider/custom.js"></script>


<section class="konten">
	<div class="container">
		<div class ="content">
		<br><center><h1>Desain Jendela Rumah Minimalis</h1></center><br>
		<div class="row">

			<?php
			$sql = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC limit 12");
			while($data = mysqli_fetch_array($sql)){
			?>
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $data['foto_produk']; ?> " style="width:200px; height:200px" />
					<div class="caption">
						<h4><?php echo $data['nama_produk']; ?></h4>
						<b>Harga Disesuaikan Dengan Pembelian</b>
					<br>
						<a href="detail_produk.php?id_produk=<?php echo $data['id_produk'];?>" class="btn btn-md btn-warning">Lihat</a>
					</div>
				</div>
			</div>

 			<?php   
			}
			?>
		</div>
		</div>
	</div>
</section>

      		
<?php
include "footer.php";
?>

</body>
</html>