<h2 class="text-center">Data Produk</h2>

<table id="tabel1" class="display table table-bordered">
	<thead>
		<tr>
			<th title="urutkan berdasarkan nomor">NO</th>
			<th title="urutkan berdasarkan nomor">Id Produk</th>
			<th title="urutkan berdasarkan nama">Nama Produk</th>
			<th title="urutkan berdasarkan harga kategori">Kategori</th>
			<th title="urutkan berdasarkan harga kategori">Deskripsi</th>
			<th title="urutkan berdasarkan stok">Foto Produk</th>
			<th><center>Aksi</center></th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['id_produk']; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $pecah['kategori']; ?></td>
			<td><?php echo $pecah['deskripsi']; ?></td>
			<td><img src="../foto_produk/<?php echo $pecah['foto'] ?>" width="100" height="100"></td>
			
			<td><center>
				<a href="index.php?halaman=detail_produk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-primary" title="Lihat" >Detail</a>
				<a href="index.php?halaman=hapus_produk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-danger" title="Hapus"  onclick="return confirm('yakin ingin hapus data?')">Hapus</a>
			</center>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>

	</tbody>
</table>

<a href="index.php?halaman=tambah_produk" title="Tambah data produk" class="btn btn-primary">Tambah Produk</a>

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