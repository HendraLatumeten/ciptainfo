<html>
<form action="" method="post">
<button type="submit" name="batal" class="btn btn-danger">Batalkan Pembayaran</button>
</form>

<?
if (isset($_POST["batal"]))
{   
    $status = "1";
    $id = $_GET['id'];
    $koneksi->query("UPDATE pembelian SET status_pembelian = '$status' WHERE id_pembelian = '$id'");
    
    $koneksi->query("UPDATE pembayaran SET ket = '0' WHERE id_pembelian = '$id'");
    

	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
}
?>
</html>