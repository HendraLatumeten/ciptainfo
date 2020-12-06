<html>
<form action="" method="post">
<button type="submit" name="batal3" class="btn btn-danger">Batalkan Pembayaran</button>
</form>

<?
if (isset($_POST["batal3"]))
{   
   
    $koneksi->query("DELETE FROM pembayaran WHERE id_pembelian=$id AND stipe='3'");
var_dump($koneksi);die;
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
}
?>
</html>