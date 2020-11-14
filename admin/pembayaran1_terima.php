<html>
<form action="" method="post">
<button type="submit" name="terima" class="btn btn-primary">Lanjutkan</button>
</form>

<?
if (isset($_POST["terima"]))
{   
    $status = "2";
    $id = $_GET['id'];
    $koneksi->query("UPDATE pembelian SET status_pembelian = '$status' WHERE id_pembelian = '$id'");
    
    $koneksi->query("UPDATE pembayaran SET ket = '1' WHERE id_pembelian = '$id'");
    

	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
}
?>
</html>