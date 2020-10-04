<h2 class="text-center">Data Kayu</h2>
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
			<th title="urutkan berdasarkan nama Kayu">Nama Kayu</th>
			<th title="urutkan berdasarkan harga Utama">Harga</th>
			<th title="urutkan berdasarkan harga kategori">Stok</th>
			<th title="urutkan berdasarkan harga kategori">Satuan</th>
			<th><center>Aksi</center></th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM data_kayu"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_kayu']; ?></td>
			<td><?php echo "Rp".number_format($pecah['harga'],2,',','.'); ?></td>
			<td><?php echo $pecah['stok']; ?></td>
			<td><?php echo $pecah['satuan']; ?></td>
			<td><center>
				<a href="index.php?halaman=ubah_data_kayu&id=<?php echo $pecah['id_kayu']; ?>" class="btn btn-primary" title="Lihat" >Ubah</a>
				<a href="index.php?halaman=hapus_data_kayu&id=<?php echo $pecah['id_kayu']; ?>" class="btn btn-danger" title="Hapus"  onclick="return confirm('yakin ingin hapus data?')">Hapus</a>
			</center>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>

	</tbody>
</table>

<a href="index.php?halaman=tambah_data_kayu" title="Tambah data Kayu" class="btn btn-primary">Tambah Kayu</a>

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