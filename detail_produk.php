<?php

include "header.php";
include "menu.php";
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    * {
        box-sizing: border-box;
    }

    .img-zoom-container {
        position: relative;
    }

    .img-zoom-lens {
        position: absolute;
        border: 1px solid #d4d4d4;
        /*set the size of the lens:*/
        width: 40px;
        height: 40px;
    }

    .img-zoom-result {
        border: 1px solid #d4d4d4;
        /*set the size of the result div:*/
        width: 500px;
        height: 240px;
    }
</style>
<script>
    function imageZoom(imgID, resultID) {
        var img, lens, result, cx, cy;
        img = document.getElementById(imgID);
        result = document.getElementById(resultID);
        /*create lens:*/
        lens = document.createElement("DIV");
        lens.setAttribute("class", "img-zoom-lens");
        /*insert lens:*/
        img.parentElement.insertBefore(lens, img);
        /*calculate the ratio between result DIV and lens:*/
        cx = result.offsetWidth / lens.offsetWidth;
        cy = result.offsetHeight / lens.offsetHeight;
        /*set background properties for the result DIV:*/
        result.style.backgroundImage = "url('" + img.src + "')";
        result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
        /*execute a function when someone moves the cursor over the image, or the lens:*/
        lens.addEventListener("mousemove", moveLens);
        img.addEventListener("mousemove", moveLens);
        /*and also for touch screens:*/
        lens.addEventListener("touchmove", moveLens);
        img.addEventListener("touchmove", moveLens);

        function moveLens(e) {
            var pos, x, y;
            /*prevent any other actions that may occur when moving over the image:*/
            e.preventDefault();
            /*get the cursor's x and y positions:*/
            pos = getCursorPos(e);
            /*calculate the position of the lens:*/
            x = pos.x - (lens.offsetWidth / 2);
            y = pos.y - (lens.offsetHeight / 2);
            /*prevent the lens from being positioned outside the image:*/
            if (x > img.width - lens.offsetWidth) {
                x = img.width - lens.offsetWidth;
            }
            if (x < 0) {
                x = 0;
            }
            if (y > img.height - lens.offsetHeight) {
                y = img.height - lens.offsetHeight;
            }
            if (y < 0) {
                y = 0;
            }
            /*set the position of the lens:*/
            lens.style.left = x + "px";
            lens.style.top = y + "px";
            /*display what the lens "sees":*/
            result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
        }

        function getCursorPos(e) {
            var a, x = 0,
                y = 0;
            e = e || window.event;
            /*get the x and y positions of the image:*/
            a = img.getBoundingClientRect();
            /*calculate the cursor's x and y coordinates, relative to the image:*/
            x = e.pageX - a.left;
            y = e.pageY - a.top;
            /*consider any page scrolling:*/
            x = x - window.pageXOffset;
            y = y - window.pageYOffset;
            return {
                x: x,
                y: y
            };
        }
    }
</script>

<div id="page-title">

    <div id="page-title-inner">

        <!-- start: Container -->
        <div class="container">

            <h2>View Produk</h2>

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
            <center>
                <h2>Video Produk</h2>
            </center>
            <div class='text-center'>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/2c6HDkcJ0LI" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <br>
        </div>
        <div class="row">
            <center>
                <h2>Foto Produk</h2>
            </center>
            <div class="col-md-6">

                <div class="img-zoom-container">
                    <img id="myimage" src="foto_produk/<?php echo $data['foto_produk']; ?>" width="500" height="240"
                        alt="Girl">

                </div>

            </div>
            <div class="col-md-6">
                <div id="myresult" class="img-zoom-result"></div>
            </div>
            <br>
            <div class="container">
                &#8226; <b>Produk : </b><i><?php echo $data['nama_produk']; ?></i><br>
                &#8226; <b>Kategori : </b><i><?php echo $data['kategori_produk']; ?></i><br>
                &#8226; <b>Deskripsi : </b><i><?php echo $data['deskripsi_produk']; ?></i><br>
            </div>
        </div>
        <br>






        <hr>
        <b>Ulasan Produk :</b>
        <div class="table-wrapper-scroll-y my-custom-scrollbar">

            <table class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th scope="col" width="100px" style="text-align:center;">Nama</th>
                        <th scope="col" width="100px" style="text-align:center;">Rate</th>
                        <th scope="col" width="300px" style="text-align:center;">Ulasan</th>
                        <th scope="col2" width="150px" style="text-align:center;">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                $rating= $koneksi->query("SELECT nama,rate,ulasan,tanggal_pembelian FROM pembelian AS a JOIN pelanggan AS b ON a.id_pelanggan=b.id_pelanggan JOIN rating AS c ON a.id_rating=c.id_rating WHERE a.id_produk='81'");
                while ($pecah=$rating->fetch_assoc()) {?>
                    <?
                
                $a = $pecah['rate'];
                
                ?>
                    <tr>

                        <th scope="row" style="text-align:center;">
                            <p>
                                <? echo $pecah['nama']; ?>
                            </p>
                        </th>

                        <td style="text-align:center;">
                            <center>
                                <?php
                            for ($i = 0; $i < $a; $i++) {
                                echo '<span class="on"><i class="fa fa-star"></i></span>';
                            }

                            for ($i = 5; $i > $a; $i--) {
                                echo '<span class="off"><i class="fa fa-star"></i></span>';
                            }
                            ?>
                            </center>
                        </td>
                        <td style="text-align:center;">
                            <p>
                                <? echo $pecah['ulasan']; ?>
                            </p>
                        </td>

                        <td style="text-align:center;">
                            <p>
                                <? echo date('d F Y', strtotime($pecah['tanggal_pembelian'])); ?>
                            </p>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <style>
            .my-custom-scrollbar {
                position: relative;
                height: 200px;
                overflow: auto;

            }

            .table-wrapper-scroll-y {
                display: block;
            }
        </style>
        <style>
            @import url(rating/fonts/font-awesome/css/font-awesome.css);


            .fa-star{
                padding-top: 27px;
            }

            .on {
                color: #f7d106;
                
            }

            .off {
                color: #ddd;
                
            }
        </style>

        <br>
        <br>
        <a href="index.php" class="btn btn-md btn-warning">
            <- Kembali</a> <a href="detail_pemesanan.php?id_produk=<?php echo $id_produk;?>"
                class="btn btn-md btn-success">Cek Harga
        </a>
    </div>
    </div>
</section>
<script type="text/javascript">
    < ? php echo $jsArray; ? >
    function
    changeValue(kd_brg)
    {
    document.getElementById("hrg").value
    =
    hrg_brg[kd_brg].hrg;
    }
    function
    hitung()
    {
    if (kayu
    =
    parseInt(document.getElementById("hrg").value)
    ==
    '')
    {
    alert('Harap
    Pilih
    Jenis
    kayu ');
    } else {
    var
    kayu
    =
    parseInt(document.getElementById("hrg").value);
    var
    panjang
    =
    parseInt(document.getElementById("panjang").value);
    var
    lebar
    =
    parseInt(document.getElementById("lebar").value);
    var
    jumlah_harga
    =
    kayu
    *
    panjang
    *
    lebar;
    document.getElementById('total').value
    =
    rubah(jumlah_harga);
    }
    }
    function
    rubah(jumlah_harga) {
    var
    reverse
    =
    jumlah_harga.toString().split('').reverse().join(''),
    ribuan
    =
    reverse.match(/\d{1,3}/g);
    ribuan
    =
    ribuan.join('.').split('').reverse().join('');
    return
    ribuan;
    }
</script>
<?php
include "footer.php";
?>
<script>
    // Initiate zoom effect:
    imageZoom("myimage", "myresult");
</script>