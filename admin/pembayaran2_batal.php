<html>
<form action="" method="post">
<button type="submit" name="batal" class="btn btn-danger">Batalkan Pembayaran</button>
</form>

<?
if (isset($_POST["batal"]))
{   
   
    $koneksi->query("DELETE FROM pembayaran WHERE id_pembelian=$id AND tipe='2'");

	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
}
?>
</html>