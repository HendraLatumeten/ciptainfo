<?php
$id_supplier = $_SESSION['supplier']['id_supplier'];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_supplier='$id_supplier'");
$gagal1 = $koneksi->query("SELECT * FROM pembelian WHERE id_supplier='$id_supplier' AND status_pembelian='Cancel'");
$gagal2 = $koneksi->query("SELECT * FROM pembelian WHERE id_supplier='$id_supplier' AND status_pembelian='Expired'");

$jumlahambil = mysqli_num_rows($ambil);
$jumlahgagal1 = mysqli_num_rows($gagal1);
$jumlahgagal2 = mysqli_num_rows($gagal2);
$jumlahgagal = $jumlahgagal1+$jumlahgagal2;
$jumlahberhasil = $jumlahambil-$jumlahgagal;
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Status Pesanan', 'Jumlah'],
      ['Sukses',     <?php echo $jumlahberhasil; ?>],
      ['Gagal',      <?php echo $jumlahgagal; ?>]
    ]);

    var options = {
      title: 'Data berdasarkan pada pesanan yang di proses oleh Supplier'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>
 
 <h2 class="text-center">Index Prestasi Supplier</h2>
<div id="piechart" style="width: 1000px; height: 500px;"></div>