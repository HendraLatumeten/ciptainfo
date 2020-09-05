<h2 class="text-center">Data Mitra</h2>

<table id="tabel1" class="display table table-bordered">
	<thead>
		<tr>
			<th title="urutkan berdasarkan nomor">NO</th>
			<th title="urutkan berdasarkan nama">Nama</th>
			<th title="urutkan berdasarkan email">Email</th>
			<th title="urutkan berdasarkan alamat">Alamat</th>
			<th title="urutkan berdasarkan nomor telpon">No Telp</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>

		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM mitra"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_mitra']; ?></td>
			<td><?php echo $pecah['email_mitra']; ?></td>
			<td><?php echo $pecah['alamat_mitra']; ?></td>
			<td><?php echo $pecah['tlp_mitra']; ?></td>
			<td>
				<a href="index.php?halaman=detail_mitra&id=<?php echo $pecah['id_mitra']; ?>" class="pe-7s-look" title="Lihat" rel="tooltip"></a>
				<a href="index.php?halaman=ubah_mitra&id=<?php echo $pecah['id_mitra']; ?>" class="pe-7s-pen" title="Ubah" rel="tooltip"></a>
				<a href="index.php?halaman=hapus_mitra&id=<?php echo $pecah['id_mitra']; ?>" class="pe-7s-trash" title="Hapus" rel="tooltip" onclick="return confirm('yakin ingin hapus data?')"></a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>

<a href="index.php?halaman=tambah_mitra" class="btn btn-primary " title="Tambah" >Tambah Data</a>

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