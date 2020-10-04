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

include('koneksi.php');
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$id = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian AS a JOIN produk ON a.id_produk=produk.id_produk INNER JOIN detail_pembelian ON a.id_pembelian=detail_pembelian.id_pembelian RIGHT JOIN data_kayu ON detail_pembelian.id_kayu=data_kayu.id_kayu  WHERE a.id_pembelian= $id ");
$html = '<img src="img/logos/logo1.jpg" alt="Logo"></center>';

$html = '<center><a class="brand" href="index.php"><img src="img/logos/logo1.jpg" alt="Logo"></a></center>
<center><text><h2>CIPTA INFO | Arsitek dan Kontraktor Rumah Kayu</h2></text></center>
<center><h4>Nota Pembelian</h4></center><hr/><br/>';
$html .= '<table border="1" width="100%">
        <tbody>
        <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Jenis Kayu</th>
        <th style="width:150px;" >Harga Kayu</th>
        <th>Luas Bangunan</th>
        <th>Biaya Pengiriman</th>
        <th>Biaya Pemasangan</th>
        <th style="width:150px;">Sub_Harga</th>
        </tr>';
        $nomor=1;
while($pecah = mysqli_fetch_array($ambil))
{
    $html .= "<tr>
        <td>".$nomor."</td>
        <td>".$pecah['nama_produk']."</td>
        <td>".$pecah['nama_kayu']."</td>
        <td>".rupiah($pecah['harga'])."</td>
        <td>".$pecah['panjang'].'X'.$pecah['lebar'].'m'."</td>
        <td>".rupiah($pecah['ongkir'])."</td>
        <td><i>Sudah Termasuk Harga Kayu </i></td>
        <td>".rupiah($pecah['total_harga'])."</td>
    </tr>";
    $nomor++;
}
$html .= '<tbody>';
$get = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian= $id");
        $detail = $get->fetch_assoc();
        $total = $detail[total_harga];
        $total_harga = $total * 10 / 100 + $total;
$html .= " 

            <tfoot>
				<tr><b>
					<td colspan='7'><i>PPN</i></td>
					<td><i>10%</i></td>
				</b></tr>
            </tfoot>
            
            <tfoot>
				<tr><b>
					<td colspan='7'><b>Total</b></td>
					<td><b>".rupiah($total_harga)."</b></td>
				</b></tr>
			</tfoot>
			

";
$tgl = date('d F Y');
$html .= "<p class='left'>".$tgl."</p>";
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('Nota_Pembelian.pdf');
?>