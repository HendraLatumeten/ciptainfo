<?php
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

//ambil rata-rata jumlah rating
$q      = $koneksi->query("SELECT AVG(rate) AS jml FROM rating")->fetch_assoc();
$hasil  = ceil($q['jml']);

//cek ip user
$cek    = $koneksi->query("SELECT * FROM `rating` WHERE id_pembelian = '$_GET[id]'");

if ($cek->num_rows > 0) {
    $cek = $cek->fetch_assoc();
    $c   = $cek['rate'];
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

	</table>
</div>
<div class="col-md-6">


    <div class="container">
        <div class="content">
           

            

            <h4><b>PENILAIAN</b></h4>

            <form id='rating' class="rating">

                <input type="radio" class="rate" id="star5" name="rating" value="5" <?php if (isset($c) && $c == '5') {
                                                                                        echo 'checked';
                                                                                    } ?> />
                <label for="star5" title="Sempurna - 5 Bintang"></label>

                <input type="radio" class="rate" id="star4" name="rating" value="4" <?php if (isset($c) && $c == '4') {
                                                                                        echo 'checked';
                                                                                    } ?> />
                <label for="star4" title="Sangat Bagus - 4 Bintang"></label>

                <input type="radio" class="rate" id="star3" name="rating" value="3" <?php if (isset($c) && $c == '3') {
                                                                                        echo 'checked';
                                                                                    } ?> />
                <label for="star3" title="Bagus - 3 Bintang"></label>

                <input type="radio" class="rate" id="star2" name="rating" value="2" <?php if (isset($c) && $c == '2') {
                                                                                        echo 'checked';
                                                                                    } ?> />
                <label for="star2" title="Tidak Buruk - 2 Bintang"></label>

                <input type="radio" class="rate" id="star1" name="rating" value="1" <?php if (isset($c) && $c == '1') {
                                                                                        echo 'checked';
                                                                                    } ?> />
                <label for="star1" title="Buruk - 1 Bintang"></label>

            </form>
            <br>
           
<?php
$ulasan1    = $koneksi->query("SELECT * FROM `rating` WHERE id_pembelian = '$_GET[id]'");
$ulasan = $ulasan1->fetch_assoc();


echo "<h4><b>ULASAN:</b></h4>"."<br>".$ulasan['ulasan'];


?>
        </div> <!-- end content -->
    </div> <!-- end container -->

    <script type="text/javascript" src="./jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#rating .rate").click(function() {

                $.ajax({
                    url: "rating_proses.php",
                    method: "POST",
                    
                    data: {
                        rate: $(this).val()
                    },
                    success: function(obj) {
                        var obj = obj.split('|');

                        $('#star' + obj[0]).attr('checked');
                        $('#hasil').html('Rating ' + obj[1] + '.0');
                        $('#star').html(obj[2]);
                        alert("terima kasih atas penilaian anda");
                    }
                });
            });
        });
    </script>
</div>
</div>
</div>
</div>

<style>
        @import url(./fonts/font-awesome/css/font-awesome.css);

       

        /* .content {
            width: 408px;
            border: 1px #ccc solid;
            padding: 15px;
            margin: auto;
            height: 200px;
        } */

        .rating {
            border: none;
            float: left;
        }

        .rating>input {
            display: none;
        }

        .rating>label::before {
            margin: 5px;
            font-size: 1.25em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        .rating>label {
            color: #ddd;
            float: right;
        }

        .rating>input:checked~label,
        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            color: #f7d106;
        }

        .rating>input:checked+label:hover,
        .rating>input:checked~label:hover,
        .rating>label:hover~input:checked~label,
        .rating>input:checked~label:hover~label {
            color: #fce873;
        }

        h4 {
            font-weight: normal;
            margin-top: 40px;
            margin-bottom: 0px;
        }

        #hasil {
            font-size: 20px;
        }

        #star {
            float: left;
            padding-right: 20px;
        }

        #star span {
            padding: 3px;
            font-size: 20px;
        }

        .on {
            color: #f7d106
        }

        .off {
            color: #ddd;
        }
    </style>
<?php if (isset($_POST['upload'])) {
	$status = "2";
	$id = $_GET['id'];
	$koneksi->query("UPDATE pembelian SET status_pembelian = '$status' WHERE id_pembelian = '$id'");
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
} ?>
<br>