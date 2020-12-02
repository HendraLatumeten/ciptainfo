<?php
include 'koneksi.php';

$id = $_POST['id'];
$ulasan = $_POST['ulas'];
$tanggal = date("Y-m-d");
$ipuser = md5($_SERVER['REMOTE_ADDR']);

if (isset($_POST['rate']) && is_numeric($_POST['rate'])) {
    $rate = $koneksi->real_escape_string($_POST['rate']);

    //cek apakah user telah memberi penilaian
    $sql = $koneksi->query("SELECT * FROM `t_rating` WHERE id_pembelian = '" . $id . "'");

    //hitung row
    if ($sql->num_rows > 0) {
        //lakukan update jika user sudah pernah menilai
        $koneksi->query("UPDATE `t_rating` SET `rate` = '" . $rate . "' , `ulasan` = '" . $ulasan . "'  WHERE `id_pembelian` = '" . $id . "'");
    } else {
        //simpan jika user belum pernah menilai
        $koneksi->query("INSERT INTO `t_rating` VALUES ('". $ipuser . "' , '" . $id . "' ,'" . $ulasan . "' , '" . $rate . "' , '$tanggal' )");
        var_dump($koneksi);
    }

    //hitung rata-rata
    $q = $koneksi->query("SELECT AVG(rate) AS jml FROM t_rating")->fetch_assoc();

    echo $rate . '|' . ceil($q['jml']) . '|';
    for ($i = 0; $i < ceil($q['jml']); $i++) {
        echo '<span class="on"><i class="fa fa-star"></i></span>';
    }
    for ($i = 5; $i > ceil($q['jml']); $i--) {
        echo '<span class="off"><i class="fa fa-star"></i></span>';
    }
}
