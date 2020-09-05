<?php

include "header.php";
include "menu.php";
?>

    <div id="page-title">

        <div id="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h2>Detail Produk</h2>

            </div>
            <!-- end: Container  -->

        </div>  

    </div>

<?php

$id_produk = $_GET["id_produk"];

$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
$data  = mysqli_fetch_array($query);
?>
        

<section class="kontent">
    <div class="container" class="deskripsi">
        <div class="row">
            <div class="col-md-6">
                <img src="foto_produk/<?php echo $data['foto']; ?>" alt="" class="img-responsive" style="width:400px; height:300px">
            </div>
            <div class="col-md-6">
                <h3><b><?php echo $data["nama"]?></b></h3><br><br>
                <h2 style="color:#5cb85c;"><b>Rp. <?php echo number_format($data["harga"]);?></b></h2><br><br>
                <h4>Spesifikasi </h4><br>
                <h4>Stok  : <?php echo $data["stok"]?></h4><br>
                <form method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" class="form-control" min="1" name="jumlah" max="<?php echo $data["stok"]?>" required>
                        </div><br>
                        <button class="btn btn-success" name="beli">Masukan Keranjang</button>
                    </div>
                </form><br>

                <?php 

                if (isset($_POST["beli"]))
                {
                    $jumlah = $_POST["jumlah"];

                    $_SESSION["keranjang"][$id_produk] = $jumlah;
                    
                    echo "<script>alert('Produk Berhasil Ditambahkan Ke Keranjang');</script>";
                    echo "<script>location='keranjang.php';</script>";
                }
                ?>
            </div>
            </div><br>
            <div class="deskripsi"> 
                <h4>Deskripsi Produk :</h4><br>
                <h4><?php echo $data["deskripsi"];?></h4>
            </div>
        </div>
    </div>
</section>



<?php
include "footer.php";
?>