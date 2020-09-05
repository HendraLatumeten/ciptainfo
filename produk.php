<?php

include "header.php";
include "menu.php";
?>	
	<link href="cssslider/styleslider.css" rel="stylesheet">
				
<div class="container">
	<h2>Daftar Produk</h2>	
</div>



<section class="konten">
	<div class="container">
		<div class ="content">
		<h1>Produk Terbaru</h1>
		<div class="row">

			<?php
			$sql = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC limit 20");
			while($data = $sql->fetch_assoc()){
			?>
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $data['foto']; ?> " style="width:200px; height:200px" />
					<div class="caption">
						<h4><?php echo $data['nama']; ?></h4>
						<h5>Rp.<?php echo number_format($data['harga']);?></h5><br>
						<a href="detail_produk.php?id_produk=<?php echo $data['id_produk'];?>" class="btn btn-md btn-warning">Detail</a>
						<a href="detail_produk.php?id_produk=<?php echo $data['id_produk'];?>" class="btn btn-md btn-success">Beli </a>
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