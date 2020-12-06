<?php
include '../koneksi.php';

$id = $_POST['id'];
$ulasan = $_POST['ulas'];
$tanggal = date("Y-m-d");


if (isset($_POST['rate']) && is_numeric($_POST['rate'])) {
    $rate = $koneksi->real_escape_string($_POST['rate']);

    //cek apakah user telah memberi penilaian
    $sql = $koneksi->query("SELECT * FROM `rating` WHERE id_pembelian = '" . $id . "'");

    //hitung row
    if ($sql->num_rows > 0) {
        //lakukan update jika user sudah pernah menilai
        $koneksi->query("UPDATE `rating` SET `rate` = '" . $rate . "' , `ulasan` = '" . $ulasan . "'  WHERE `id_pembelian` = '" . $id . "'");
    } else {
        //simpan jika user belum pernah menilai
        $koneksi->query("INSERT INTO `rating` (id_pembelian,ulasan,rate,date) VALUES ('" . $id . "' ,'" . $ulasan . "' , '" . $rate . "' , '$tanggal' )");
        
        $idrating = $koneksi->query("SELECT * FROM `rating` WHERE id_pembelian = '" . $id . "'");
        $data  = mysqli_fetch_array($idrating);
        $id_rating = $data['id_rating'];
        
        $koneksi->query("UPDATE `pembelian` SET `id_rating`='" . $id_rating . "'  WHERE `id_pembelian` = '" . $id . "'   ");
        
    }

    //hitung rata-rata
    $q = $koneksi->query("SELECT AVG(rate) AS jml FROM rating")->fetch_assoc();

    echo $rate . '|' . ceil($q['jml']) . '|';
    for ($i = 0; $i < ceil($q['jml']); $i++) {
        echo '<span class="on"><i class="fa fa-star"></i></span>';
    }
    for ($i = 5; $i > ceil($q['jml']); $i--) {
        echo '<span class="off"><i class="fa fa-star"></i></span>';
    }
}
