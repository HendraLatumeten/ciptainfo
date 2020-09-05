<?php
require_once("koneksi.php");
    if (!isset($_SESSION)) {
        session_start();
    }
     
    if (isset($_GET['act']) && isset($_GET['ref'])) {
        $act = $_GET['act'];
        $ref = $_GET['ref'];
             
        if ($act == "add") {
            if (isset($_GET['id_produk'])) {
                $id_produk = $_GET['id_produk'];
                if (isset($_SESSION['keranjang'][$id_produk])) {
                    $_SESSION['keranjang'][$id_produk] += 1;
                } else {
                    $_SESSION['keranjang'][$id_produk] = 1; 
                }
            }
        } elseif ($act == "plus") {
            if (isset($_GET['id_produk'])) {
                $id_produk = $_GET['id_produk'];
                if (isset($_SESSION['keranjang'][$id_produk])) {
                    $_SESSION['keranjang'][$id_produk] += 1;
                }
            }
        } elseif ($act == "min") {
            if (isset($_GET['id_produk'])) {
                $id_produk = $_GET['id_produk'];
                if (isset($_SESSION['keranjang'][$id_produk])) {
                    $_SESSION['keranjang'][$id_produk] -= 1;
                }
            }
        } elseif ($act == "del") {
            if (isset($_GET['id_produk'])) {
                $id_produk = $_GET['id_produk'];
                if (isset($_SESSION['keranjang'][$id_produk])) {
                    unset($_SESSION['keranjang'][$id_produk]);
                }
            }
        } elseif ($act == "clear") {
            if (isset($_SESSION['keranjang'])) {
                foreach ($_SESSION['keranjang'] as $key => $val) {
                    unset($_SESSION['keranjang'][$key]);
                }
                unset($_SESSION['keranjang']);
            }
        } 
         
        header ("location:" . $ref);
    }
?>