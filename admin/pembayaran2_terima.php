<html>
<form action="" method="post">
<button type="submit" name="terima2" class="btn btn-primary">Lanjutkan</button>
</form>

<?
if (isset($_POST["terima2"]))
{   
    $status = "2";
    $id = $_GET['id'];
    $koneksi->query("UPDATE pembelian SET status_pembelian = '$status' WHERE id_pembelian = '$id'");
    
    $koneksi->query("UPDATE pembayaran SET ket = '2' WHERE tipe='2' AND id_pembelian = '$id'");
    
    

	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
}
?>
</html>