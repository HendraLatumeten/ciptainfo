<?php

include "header.php";
include "menu.php";
?>

    <div id="page-title">

        <div id="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <h2>Pesanan</h2>

            </div>
            <!-- end: Container  -->

        </div>  

    </div>

<?php
if(!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
}
$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
$id_produk = $_GET["id_produk"];

$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
$data  = mysqli_fetch_array($query);

$barang= mysqli_query($koneksi, "SELECT * FROM data_kayu");
$jsArray = "var hrg_brg = new Array();\n"; 
?>

<form action="" method="POST">
<section class="kontent">
    <div class="container" class="deskripsi">
        <div class="row">
            <center>
            <h2><b><?php echo $data['nama_produk']; ?></b></h2>
            <img src="foto_produk/<?php echo $data['foto_produk']; ?>" alt="" class="img-responsive" style="width:400px; height:300px">
            </center>
           
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                     <h3 class="display-4"><center>Detail Pemesanan</center></h3>
                    <div class="form-grup">
                            <label>Jenis Kayu</label>
                        <select name="j_kayu" onchange="changeValue(this.value)" class="form-control">
		            <option>- Pilih -</option>
		            <?php if(mysqli_num_rows($barang)) {?>
		                <?php while($row_brg= mysqli_fetch_array($barang)) {?>
		                    <option value="<?php echo $row_brg["id_kayu"]?>"> <?php echo $row_brg["nama_kayu"]?> </option>
		                <?php $jsArray .= "hrg_brg['" . $row_brg['id_kayu'] . "'] = {hrg:'" . addslashes($row_brg['harga']) . "'};\n"; } ?>
                    <?php
                  
                
                } ?>
		        </select>
                    </div>
                    <div class="form-grup">
                        <div class="col-12">
                            <div class="col-6">
                           
                                <b>Panjang</b><input type="number" id="panjang" name="panjang" class="form-control">
                            </div>
                            <div class="col-6">
                                <b>Lebar</b><input type="number" id="lebar" name="lebar" class="form-control">
                             </div>
                        </div>
                    </div>
                    <br>
                    <input type='button' class='btn-primary center-block' name='' onclick= hitung(); value='Cek Harga' >
                    <br>
                    <input type="hidden" class="form-control" name="hrg" id="hrg" value="0">
                  <b>Harga Rp. <input type="text" class="form-control" name="total" id="total" value="" readonly="readonly"></b>
                </div>
                <input type="hidden" class="form-control" name="total1" id="total1" value="" readonly="readonly">
                <p style="color:red;font-size:11px;"><i>*biaya pemesanan kayu sudah termasuk biaya pengerjaan</i></p>
            </div>
            

               
            </div>
            <div class="col-md-6">
            
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                     <h3 class="display-4"><center>Alamat Pengiriman</center></h3>
                     <marquee width="100%" height="50"><p style="color:red;font-size:15px;"><i>Untuk sementara pengiriman wilayah pulau jawa</i></p></marquee>
                     
                     <div class="form-group">
				<label>Provinsi</label>
				<select class="form-control" name="provinsi" id="provinsi">
					<option value=""> Pilih Provinsi</option>
				</select>
			</div>
			
			<div class="form-group">
				<label>Kabupaten</label>
				<select class="form-control" name="kabupaten" id="kabupaten">
					<option value=""></option>
				</select>
			</div>
 
			<div class="form-group">
				<label>Kecamatan</label>
				<select class="form-control" name="kecamatan" id="kecamatan">
					<option value=""></option>
				</select>
			</div>
 
			<div class="form-group">
				<label>Kelurahan</label>
				<select class="form-control" name="kelurahan" id="kelurahan">
					<option value=""></option>
				</select>
			</div>
            <div class="form-group">
				<label>Detail Lokasi</label><br>
				<textarea class="form-control" name="lokasi" id="" cols="57" rows="3">
                </textarea>
			</div>
                </div>
            </div>
         
            <br>
            <br>
            <br>              
            </div>
            </div><br>
        </div>
    </div>
</section>
<button class="btn btn-success" name="beli">Beli</button>
            </form>
<?php 

if (isset($_POST["beli"]))
{   
    //jenis kayu
    $j_kayu    = $_POST["j_kayu"];
    $panjang   = $_POST["panjang"];
    $lebar     = $_POST["lebar"];
    $total     = $_POST["total"];
    $total1    = $_POST["total1"];
    //alamat
    $provinsi  = $_POST["provinsi"];
    $kabupaten = $_POST["kabupaten"];
    $kecamatan = $_POST["kecamatan"];
    $kelurahan = $_POST["kelurahan"];
    $lokasi = $_POST["lokasi"];
  

    $prov = $_POST["provinsi"];

   if ($prov == "36") { //banten
        $ongkir = 2000000;
   }else if ($prov == "35") { //jawa timur
        $ongkir = 2500000;
   }else if ($prov == "32") { //jawa barat
        $ongkir = 1000000;
   }else if ($prov == "34") { //yogja
        $ongkir = 3000000;
   }else if ($prov == "33") { //jawa tengah
        $ongkir = 2500000;
   }
   $totalharga = $ongkir + $total1 ;
 
   $tgl = date('d-m-Y');

   //pembelian
   $koneksi->query("INSERT INTO pembelian (id_produk,id_pelanggan,id_mandor,total_harga,tanggal_pembelian,status_pembelian,status_pengerjaan) 
   VALUES ('$id_produk','$id_pelanggan',null,'$totalharga','$tgl','0',null)");
  
   $query = mysqli_query($koneksi, "SELECT  MAX(id_pembelian) FROM pembelian");
   $data  = mysqli_fetch_array($query);
 
   foreach ($data as $key => $value) {
    $lastid = $value;
 
   }
    // detail pembelian
    $koneksi->query("INSERT INTO detail_pembelian (id_pembelian,id_kayu,panjang,lebar,harga_kayu,id_prov,id_kab,id_kec,id_kel,lokasi,ongkir) 
    VALUES ('$lastid','$j_kayu','$panjang','$lebar','$total1','$provinsi','$kabupaten','$kecamatan','$kelurahan','$lokasi','$ongkir')");
  
    echo "<script>alert('Produk Berhasil Diproses, Mohon Tunggu Konfirmasi Admin);</script>";

	echo "<script>location='nota.php?id=$lastid';</script>";

}
?>

<script type="text/javascript">
    <?php echo $jsArray; ?>
    function changeValue(j_kayu) {
        document.getElementById("hrg").value = hrg_brg[j_kayu].hrg;
        
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
        document.getElementById('total1').value = jumlah_harga;

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
<script type="text/javascript">
	$(document).ready(function(){
      	$.ajax({
            type: 'POST',
          	url: "get_provinsi.php",
          	cache: false, 
          	success: function(msg){
              $("#provinsi").html(msg);
            }
        });
 
      	$("#provinsi").change(function(){
      	var provinsi = $("#provinsi").val();
          	$.ajax({
          		type: 'POST',
              	url: "get_kabupaten.php",
              	data: {provinsi: provinsi},
              	cache: false,
              	success: function(msg){
                  $("#kabupaten").html(msg);
                }
            });
        });
 
        $("#kabupaten").change(function(){
      	var kabupaten = $("#kabupaten").val();
          	$.ajax({
          		type: 'POST',
              	url: "get_kecamatan.php",
              	data: {kabupaten: kabupaten},
              	cache: false,
              	success: function(msg){
                  $("#kecamatan").html(msg);
                }
            });
        });
 
        $("#kecamatan").change(function(){
      	var kecamatan = $("#kecamatan").val();
          	$.ajax({
          		type: 'POST',
              	url: "get_kelurahan.php",
              	data: {kecamatan: kecamatan},
              	cache: false,
              	success: function(msg){
                  $("#kelurahan").html(msg);
                }
            });
        });
     });
</script>