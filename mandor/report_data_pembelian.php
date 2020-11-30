<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
<?php
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

include('../koneksi.php');
require_once("../dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$id = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan INNER JOIN produk ON pembelian.id_produk=produk.id_produk WHERE id_pembelian='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$a = $koneksi->query("SELECT * FROM detail_pembelian JOIN data_kayu ON detail_pembelian.id_kayu=data_kayu.id_kayu WHERE id_pembelian='$_GET[id]'");
$pecah1 = $a->fetch_assoc(); 

$prv = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN provinsi AS b ON a.id_prov=b.id_prov WHERE id_pembelian='$_GET[id]'");
$prov = $prv->fetch_assoc();

$kabu = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN kabupaten AS b ON a.id_kab=b.id_kab WHERE id_pembelian='$_GET[id]'");
$kab = $kabu->fetch_assoc();

$keca = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN kecamatan AS b ON a.id_kec=b.id_kec WHERE id_pembelian='$_GET[id]'");
$kec = $keca->fetch_assoc();

$kelu = $koneksi->query ("SELECT * FROM detail_pembelian AS a JOIN kelurahan AS b ON a.id_kel=b.id_kel WHERE id_pembelian='$_GET[id]'");
$kel = $kelu->fetch_assoc();

// function rupiah($angka){
	
// 		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
// 		return $hasil_rupiah;
	 
// }
$html = '<img src="img/logos/logo1.jpg" alt="Logo"></center>';

$html = '<center><a class="brand" href="index.php"><img src="img/logos/logo1.jpg" alt="Logo"></a></center>
<center><text><h2>CIPTA INFO | Arsitek dan Kontraktor Rumah Kayu</h2></text></center>
<center><h4>Nota Pembelian</h4></center><hr/><br/>';
$html .= "table class='table'>
<tr>
    <td width='200px'>Nama Pelanggan</td>
    <td>:	".$pecah['nama']."/td>
</tr>";
$tgl = date('d F Y');
$html .= "<p class='left'>".$tgl."</p>";
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('Report_Data_Pembelian.pdf');
?>