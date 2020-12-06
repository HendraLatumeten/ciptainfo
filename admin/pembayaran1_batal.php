<html>
<form action="" method="post">
<button type="submit" name="batal1" class="btn btn-danger">Batalkan Pembayaran</button>
</form>

<?
if (isset($_POST["batal1"]))
{   
    $status = "0";
    $id = $_GET['id'];
  
    $koneksi->query("DELETE FROM pembayaran WHERE id_pembelian=$id AND tipe='1'");
    

	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
}
?>
</html>