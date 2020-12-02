<?php

include "header.php";
include "menu.php";
?>
<?php
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
} 
if(!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}
$id = $_GET["id"];
$ambil = $koneksi->query ("SELECT * FROM pembelian WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
$harga = $detail['total_harga'];
$bayar1 = 15 / 100 * $harga;
$bayar2 = 50 / 100 * $harga;
$bayar3 = 35 / 100 * $harga;
?>

<div id="page-title">

    <div id="page-title-inner">

        <!-- start: Container -->
        <div class="container">

            <h2>Konfirmasi Pembayaran</h2>

        </div>
        <!-- end: Container  -->

    </div>

</div>

<?
$ambil1 = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$_GET[id]' AND tipe='1' ");
$bukti1 = $ambil1->fetch_assoc();

$ambil2 = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$_GET[id]' AND tipe='2'");
$bukti2 = $ambil2->fetch_assoc();

$ambil3 = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$_GET[id]' AND tipe='3'");
$bukti3 = $ambil3->fetch_assoc();

?>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#a" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span>
                            Pembayaran Pertama (15%)</a></li>
                    <li><a href="#b" data-toggle="tab"><span class="glyphicon glyphicon glyphicon-list-alt"></span>
                            Pembayaran Kedua (50%)</a></li>
                    <li><a href="#c" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span> Pembayaran
                            Ketiga (35%)</a></li>
                    <li><a href="#d" data-toggle="tab"><span class="glyphicon glyphicon-time"></span></a></li>
                    <li><a href="#e" data-toggle="tab"><span class="glyphicon glyphicon-calendar"></span></a></li>
                    <li><a href="#f" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span></a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="a">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h3 class="display-4">Pembayaran Pertama</h3>
                                <p class="lead">
                             <?   if ($bukti1['tipe'] == '1' AND $bukti1['ket'] > '0') {?>
                                    <table class="table">
                                        <tr>
                                            <td>Nama Transfer</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
                        
							echo $bukti1['nama'];
						?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bank</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
							echo $bukti1['bank'];
						?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
							echo $bukti1['tanggal'];
						?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
							if ($bukti1['ket'] == '2') {
                                echo "<u><i>Berhasil</i></u>";
                            }else{
                                echo "<u><i>Menunggu konfirmasi</i></u>";
                            }
						?>
                                                </b>
                                            </td>
                                        </tr>
                                    </table>
                                    <?}else {?>
                                        <div class="container">
                                        <h2>Konfirmasi Pembayaran</h2>
                                        <p>Kirim Bukti Pembarayan Di sini</p>
                                        <div class="alert alert-danger">Pembayaran Pertama <b>(DP)</b> 15% Dari Total
                                            Harga!
                                            <strong><?php echo rupiah($harga)?></strong>
                                        </div>

                                        <div class="alert alert-success">Total Tagihan Anda
                                            <strong><?php echo rupiah($bayar1)?></strong>
                                            <strong> || BANK BCA 124-020201-2121 CIPTA INFO</strong>
                                        </div>
                                     
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Nama Penyetor</label>
                                                <input type="text" class="form-control" name="nama">
                                            </div>
                                            <div class="form-group">
                                                <label>Bank</label>
                                                <input type="text" class="form-control" name="bank">
                                            </div>
                                            <div class="form-group" data-toggle="tooltip" data-placement="left"
                                                title="Jumlah Harus Sesuai!">
                                                <label>Jumlah</label>
                                                <input class="form-control" type="number" name="jumlah">
                                            </div>

                                            <div class="form-group">
                                                <label>FOTO Bukti</label>
                                                <input type="file" class="form-control" name="bukti"
                                                    required="Harus Diinput">
                                                <p class="text-danger">*foto bukti harus JPG max 2MB</p>
                                            </div>
                                            <button class="btn btn-success" name="form1">Kirim</button>
                                        </form>
                                    </div>
                                    

                                    <?}?>
                                    <?
                                    if (isset($_POST["form1"]))
                                    {
                                        $namabukti = $_FILES['bukti']['name'];
                                        $lokasibukti = $_FILES['bukti']['tmp_name'];
                                        $namafiks = date("YmdHis").$namabukti;
                                        move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");
                                    
                                        $idpem = $_GET["id"];
                                        $nama = $_POST["nama"];
                                        $bank = $_POST["bank"];
                                        $jumlah = $_POST["jumlah"];
                                        $tanggal = date("Y-m-d");
                                    
                                        $koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti,tipe,ket) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks','1','1')");

                                        echo "<script>alert('Pembayaran Berhasil');</script>";
                                        echo "<script>location='riwayat.php';</script>";
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    

                    <div class="tab-pane" id="b">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h3 class="display-4">Pembayaran Kedua</h3>
                                <p class="lead">
                                    <?
                            if ($bukti2['tipe'] == '2' AND $bukti2['ket'] > '0') {?>
                                    <table class="table">
                                        <tr>
                                            <td>Nama Transfer</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
                        
							echo $bukti2['nama'];
						?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bank</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
							echo $bukti2['bank'];
						?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
							echo $bukti2['tanggal'];
						?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
							if ($bukti2['ket'] == '2') {
                                echo "<u><i>Berhasil</i></u>";
                            }else if($bukti2['ket'] == '1'){
                                echo "<u><i>Menunggu konfirmasi</i></u>";
                            }
						?>
                                                </b>
                                            </td>
                                        </tr>
                                    </table>
                                    <?}else {?>
                                    <div class="container">
                                        <h2>Konfirmasi Pembayaran</h2>
                                        <p>Kirim Bukti Pembarayan Di sini</p>
                                        <div class="alert alert-danger">Pembayaran kedua <b>(Lanjutan)</b> 50% Dari Total
                                            Harga!
                                            <strong><?php echo rupiah($harga)?></strong>
                                        </div>

                                        <div class="alert alert-success">Total Tagihan Anda
                                            <strong><?php echo rupiah($bayar2)?></strong>
                                            <strong> || BANK BCA 124-020201-2121 CIPTA INFO</strong>
                                        </div>

                                        <form method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Nama Penyetor</label>
                                                <input type="text" class="form-control" name="nama">
                                            </div>
                                            <div class="form-group">
                                                <label>Bank</label>
                                                <input type="text" class="form-control" name="bank">
                                            </div>
                                            <div class="form-group" data-toggle="tooltip" data-placement="left"
                                                title="Jumlah Harus Sesuai!">
                                                <label>Jumlah</label>
                                                <input class="form-control" type="number" name="jumlah">
                                            </div>

                                            <div class="form-group">
                                                <label>FOTO Bukti</label>
                                                <input type="file" class="form-control" name="bukti"
                                                    required="Harus Diinput">
                                                <p class="text-danger">*foto bukti harus JPG max 2MB</p>
                                            </div>
                                            <button class="btn btn-success" name="form2">Kirim</button>
                                        </form>
                                    </div>



                                    <?}?>
                                    <?
                                    if (isset($_POST["form2"]))
                                    {
                                        $namabukti = $_FILES['bukti']['name'];
                                        $lokasibukti = $_FILES['bukti']['tmp_name'];
                                        $namafiks = date("YmdHis").$namabukti;
                                        move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");
                                    
                                        $idpem = $_GET["id"];
                                        $nama = $_POST["nama"];
                                        $bank = $_POST["bank"];
                                        $jumlah = $_POST["jumlah"];
                                        $tanggal = date("Y-m-d");
                                    
                                        $koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti,tipe,ket) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks','2','1')");

                                        echo "<script>alert('Pembayaran Berhasil');</script>";
                                        echo "<script>location='riwayat.php';</script>";
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="c">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h3 class="display-4">Pembayaran Ketiga</h3>
                                <p class="lead">
                                    <?
                            if ($bukti3['tipe'] == '3' AND $bukti3['ket'] > '0') {
                             
                                ?>
                                    <table class="table">
                                        <tr>
                                            <td>Nama Transfer</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
                        
							echo $bukti3['nama'];
						?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bank</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
							echo $bukti3['bank'];
						?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
							echo $bukti3['tanggal'];
						?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>:</td>
                                            <td>
                                                <b>
                                                    <?php
							if ($bukti3['ket'] == '2') {
                                echo "<u><i>Berhasil</i></u>";
                            }else if($bukti3['ket'] == '1'){
                                echo "<u><i>Menunggu konfirmasi</i></u>";
                            }
						?>
                                                </b>
                                            </td>
                                        </tr>
                                    </table>
                                    <?}else {?>
                                    <div class="container">
                                        <h2>Konfirmasi Pembayaran</h2>
                                        <p>Kirim Bukti Pembarayan Di sini</p>
                                        <div class="alert alert-danger">Pembayaran ketiga <b>(Lanjutan)</b> 35% Dari Total
                                            Harga!
                                            <strong><?php echo rupiah($harga)?></strong>
                                        </div>
                                 
                                        <div class="alert alert-success">Total Tagihan Anda
                                            <strong><?php echo rupiah($bayar3)?></strong>
                                            <strong> || BANK BCA 124-020201-2121 CIPTA INFO</strong>
                                        </div>
                                     
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Nama Penyetor</label>
                                                <input type="text" class="form-control" name="nama">
                                            </div>
                                            <div class="form-group">
                                                <label>Bank</label>
                                                <input type="text" class="form-control" name="bank">
                                            </div>
                                            <div class="form-group" data-toggle="tooltip" data-placement="left"
                                                title="Jumlah Harus Sesuai!">
                                                <label>Jumlah</label>
                                                <input class="form-control" type="number" name="jumlah">
                                            </div>

                                            <div class="form-group">
                                                <label>FOTO Bukti</label>
                                                <input type="file" class="form-control" name="bukti"
                                                    required="Harus Diinput">
                                                <p class="text-danger">*foto bukti harus JPG max 2MB</p>
                                            </div>
                                            <button class="btn btn-success" name="form3">Kirim</button>
                                        </form>
                                    </div>
                                    

                                    <?}?>
                                    <?
                                    if (isset($_POST["form3"]))
                                    {
                                        $namabukti = $_FILES['bukti']['name'];
                                        $lokasibukti = $_FILES['bukti']['tmp_name'];
                                        $namafiks = date("YmdHis").$namabukti;
                                        move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");
                                    
                                        $idpem = $_GET["id"];
                                        $nama = $_POST["nama"];
                                        $bank = $_POST["bank"];
                                        $jumlah = $_POST["jumlah"];
                                        $tanggal = date("Y-m-d");
                                    
                                        $koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti,tipe,ket) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks','3','1')");
                                
                                        echo "<script>alert('Pembayaran Berhasil');</script>";
                                        echo "<script>location='riwayat.php';</script>";
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>

                </div><!-- /tab-content -->
            </div><!-- /tabbable -->
        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /container -->

<style>
    .tabs {
        background-color: blue;
    }

    h3 {
        margin-top: 0;
    }

    .badge {
        background-color: #777;
    }

    .tabs-left {
        margin-top: 3rem;
        background-color: #ddd;
    }

    .nav-tabs {
        float: left;
        border-bottom: 0;


        li {
            float: none;
            margin: 0;

            a {
                margin-right: 0;
                border: 0;
                border-radius: 0;
                background-color: #333;

                &:hover {
                    background-color: #444;
                }
            }
        }

        .glyphicon {
            color: #fff;
        }

        .active .glyphicon {
            color: #333;
        }
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:hover,
    .nav-tabs>li.active>a:focus {
        border: 0;
    }

    .jumbotron {
        margin-left: -64px;
        margin-top: 20px;
        background-color: #ddd;
        border-radius: 10px;
    }

    .tab-content {
        margin-left: 45px;

        .tab-pane {
            display: none;
            /* background-color: #fff; */
            /* padding: 1.6rem; */
            overflow-y: auto;
        }

        .active {
            display: block;
        }
    }

    .list-group {
        width: 100%;

        .list-group-item {
            height: 50px;

            h4,
            span {
                line-height: 11px;
            }
        }
    }
</style>
<script>
    var tabsFn = (function () {

        function init() {
            setHeight();
        }

        function setHeight() {
            var $tabPane = $('.tab-pane'),
                tabsHeight = $('.nav-tabs').height();

            $tabPane.css({
                height: tabsHeight
            });
        }

        $(init);
    })();
</script>







<?php 

if (isset($_POST["kirim"]))
{
	$namabukti = $_FILES['bukti']['name'];
	$lokasibukti = $_FILES['bukti']['tmp_name'];
	$namafiks = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

	$idpem = $_GET["id"];
	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");

	$koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti,ket) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks','1')");
	$koneksi->query("UPDATE pembelian SET status_pembelian='1' WHERE id_pembelian='$idpem'");
	echo "<script>alert('Pembayaran Berhasil');</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>


<?php
include "footer.php";
?>

<script type="text/javascript">
    var jumlah = document.getElementById("jumlah");
    jumlah.addEventListener("keyup", function (e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        jumlah.value = formatRupiah(this.value, "Rp. ");
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            jumlah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            jumlah += separator + ribuan.join(".");
        }

        jumlah = split[1] != undefined ? jumlah + "," + split[1] : jumlah;
        return prefix == undefined ? jumlah : jumlah ? "" + jumlah : "";
    }
    $('#myTab a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    });
    $('#myTab a[href="#profile"]').tab('show') // Select tab by name
    $('#myTab li:first-child a').tab('show') // Select first tab
    $('#myTab li:last-child a').tab('show') // Select last tab
    $('#myTab li:nth-child(3) a').tab('show') // Select third tab
</script>