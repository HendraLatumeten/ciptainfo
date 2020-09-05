<h2 class="text-center">Data pelanggan</h2>

<table id="tabel1" class="display table table-bordered" width="2000px" >
	<thead>
		<tr>
			<th title="urutkan berdasarkan nomor">NO</th>
			<th title="urutkan berdasarkan nama">Nama</th>
			<th title="urutkan berdasarkan email">Email</th>
			<th title="urutkan berdasarkan alamat">Alamat</th>
			<th title="urutkan berdasarkan nomor telpon">No Telp</th>
			<th width="40px">Aksi</th>
		</tr>
	</thead>
	<tbody>

		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pelanggan"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $pecah['email']; ?></td>
			<td><?php echo $pecah['alamat']; ?></td>
			<td><?php echo $pecah['tlp']; ?></td>
			<td>
				<a href="index.php?halaman=detail_pelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" >Detail</a>
				<a href="index.php?halaman=ubah_pelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" >Ubah</a>
				<a href="index.php?halaman=hapus_pelanggan&id=<?php echo $pecah['id_pelanggan']; ?>"   onclick="return confirm('yakin ingin hapus data?')">Hapus</a>
				
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