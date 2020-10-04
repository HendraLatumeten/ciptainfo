<h2 class="text-center">Data Project</h2>
<?php


include('../koneksi.php');

if (!isset($_SESSION['mandor'])) {
    echo "<script>alert('Anda Harus Login ! ');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
?>
<?php
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}



?>
<table id="tabel1" class="display table table-bordered">
	<thead>
		<tr>
			<th title="urutkan berdasarkan nomor">NO</th>
			<th title="urutkan berdasarkan Nama Produk">Nama Produk</th>
			<th title="urutkan berdasarkan Nama Pembeli">Nama Pembeli</th>
			<th title="urutkan berdasarkan Tlpn">Tlpn</th>
			<th title="urutkan berdasarkan Status Pengerjaan">Status Pengerjaan</th>
			<th><center>Aksi</center></th>
		</tr>
	</thead>
	<tbody>
		<?php $mandor= $_SESSION['mandor'];?>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN produk  ON pembelian.id_produk=produk.id_produk INNER JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE id_mandor=$mandor "); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<!-- <td><?php echo "Rp".number_format($pecah['harga'],2,',','.'); ?></td> -->
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $pecah['tlp']; ?></td>
			<td>
			<?php 
				if ($pecah['status_pengerjaan'] == 0) {
					echo "Proses pengerjaan"; 
					
				}else{
					echo "selesai"; 
				}
			
			?>
			</td>
			<td><center>
		
				<a href="index.php?halaman=ubah_data_kayu&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-danger" title="Lihat" >Update Pengerjaan</a>
				<a href="index.php?halaman=detail_project&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-primary" title="Lihat" >Detail</a>
			
			</center>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>

	</tbody>
</table>
<script type="text/javascript">
    $(document).ready(function(){
     $("#tabel1").DataTable({
            "language": {
                "decimal":        "",
                "emptyTable":     "Tidak ada data yang tersedia di tabel",
                "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ baris",
                "infoEmpty":      "Menampilkan 0 sampai 0 dari 0 baris",
                "infoFiltered":   "(difilter dari _MAX_ total baris)",
                "infoPostFix":    "",
                "thousands":      ".",
                "lengthMenu":     "Menampilkan _MENU_ baris",
                "loadingRecords": "memuat...",
                "processing":     "Sedang di proses...",
                "search":         "Pencarian:",
                "zeroRecords":    "Arsip tidak ditemukan",
                "paginate": {
                    "first":      "Pertama",
                    "last":       "Terakhir",
                    "next":       "lanjut",
                    "previous":   "kembali"
                },
                "aria": {
                    "sortAscending":  ": aktifkan urutan kolom ascending",
                    "sortDescending": ": aktifkan urutan kolom descending"
                }
            }
         });                       

    });
</script>