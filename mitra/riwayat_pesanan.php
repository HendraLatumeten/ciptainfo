<h2 class="text-center">Riwayat Pesanan</h2>

<table id="tabel1" class="display table table-bordered">
	<thead>
		<tr>
			<th title="urutkan berdasarkan nomor">NO</th>
			<th title="urutkan berdasarkan nomor faktur">No Faktur</th>
			<th title="urutkan berdasarkan tanggal">Tanggal</th>
			<th title="urutkan berdasarkan status">Status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>

		<?php $id_supplier = $_SESSION['supplier']['id_supplier'] ?>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian WHERE id_supplier='$id_supplier' AND NOT status_pembelian ='Created' AND NOT status_pembelian='Process'"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td>BELI<?php echo $pecah['id_pembelian']; ?></td>
			<td><?php echo $pecah['tgl_pembelian']; ?></td>
			<td
			<?php if ($pecah['status_pembelian']=="Expired") {
						echo "class='danger'";
					} elseif($pecah['status_pembelian']=="Cancel") {
						echo "class='warning'";
					} elseif($pecah['status_pembelian']=="") {
						echo "class=''";
					} else {
						echo "class='success'";
					} ?> ><?php echo $pecah['status_pembelian']; ?></td>
			<td>
				<a href="index.php?halaman=detail_pesanan&id=<?php echo $pecah['id_pembelian']; ?>">Detail</a>
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