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

$barang= mysqli_query($koneksi, "SELECT * FROM data_kayu");
$jsArray = "var hrg_brg = new Array();\n"; 
?>


<section class="kontent">
    <div class="container" class="deskripsi">
        <div class="row">
            <div class="col-md-6">
                <img src="foto_produk/<?php echo $data['foto']; ?>" alt="" class="img-responsive" style="width:400px; height:300px">
            </div>
            <div class="col-md-6">
                
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                     <h5 class="display-4">Detail Pemesanan</h5>
                    <div class="form-grup">
                            <label>Jenis Kayu</label>
                        <select name="kd_brg" onchange="changeValue(this.value)" class="form-control">
		            <option>- Pilih -</option>
		            <?php if(mysqli_num_rows($barang)) {?>
		                <?php while($row_brg= mysqli_fetch_array($barang)) {?>
		                    <option value="<?php echo $row_brg["id_kayu"]?>"> <?php echo $row_brg["nama_kayu"]?> </option>
		                <?php $jsArray .= "hrg_brg['" . $row_brg['id_kayu'] . "'] = {hrg:'" . addslashes($row_brg['harga_partisi']) . "'};\n"; } ?>
                    <?php
                  
                
                } ?>
		        </select>
                    </div>
                    <div class="form-grup">
                        <div class="col-12">
                            <div class="col-6">
                            <?  echo $jsArray;?>
                                <b>Panjang</b><input type="number" id="panjang" class="form-control">
                            </div>
                            <div class="col-6">
                                <b>Lebar</b><input type="number" id="lebar" class="form-control">
                             </div>
                        </div>
                    </div>
                    <br>
                    <input type='button' class='btn-primary center-block' name='' onclick= hitung(); value='Cek Harga' >
                    <br>
                    <input type="hidden" class="form-control" name="hrg" id="hrg" value="0">
                  <b>Harga Rp. <input type="text" class="form-control" name="total" id="total" value="" readonly="readonly"></b>
                </div>
            </div>

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
            <h3><b><?php echo $data["nama"]?></b></h3><br><br>
                <h4>Deskripsi Produk :</h4><br>
                <h4><?php echo $data["deskripsi"];?></h4>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    <?php echo $jsArray; ?>
    function changeValue(kd_brg) {
        document.getElementById("hrg").value = hrg_brg[kd_brg].hrg;
        
    }
    function hitung() {
        if(kayu = parseInt(document.getElementById("hrg").value) == '') {
            alert('Harap Pilih Jenis kayu');
        }else{
    
        var kayu = parseInt(document.getElementById("hrg").value);
        var panjang = parseInt(document.getElementById("panjang").value);
        var lebar = parseInt(document.getElementById("lebar").value);
        var jumlah_harga = kayu * panjang * lebar;
        
        document.getElementById('total').value = rubah(jumlah_harga);

        }
       
    }
    function rubah(jumlah_harga){
        var reverse = jumlah_harga.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }
    </script> 
<?php
include "footer.php";
?>