<h2 class="text-center">Data Pembelian</h2>

<table id="tabel1" class="display table table-bordered">
	<thead>
		<tr>
			<th title="urutkan berdasarkan nomor">NO</th>
			<th title="urutkan berdasarkan customer">Id Pembelian</th>
			<th title="urutkan berdasarkan customer">Customer</th>
			<th title="urutkan berdasarkan tanggal">Tanggal</th>
			<th title="urutkan berdasarkan tanggal">Status</th>
		
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian AS a JOIN pelanggan AS b ON a.id_pelanggan=b.id_pelanggan ORDER BY a.id_pembelian DESC"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['id_pembelian']; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $pecah['tanggal_pembelian']; ?></td>
			
			<td><?php 
				if ($pecah['status_pembelian'] == "0") {
					echo  "Pesanan Ditolak";
				}else if($pecah['status_pembelian'] == "1"){
					echo  "Menunggu Konfirmasi";
				
				}else if($pecah['status_pembelian'] == "2"){
					echo  "Proses Pengerjaan";
				}else if($pecah['status_pembelian'] == "3"){
					echo  "Selesai";
				}
			?></td>
	
			<td>
				<a href="index.php?halaman=detail_beli&id=<?php echo $pecah['id_pembelian']; ?>">Detail</a>
				<? if ($pecah['status_pembelian'] == "3") {?>
					|| <a href="index.php?halaman=ulasan&id=<?php echo $pecah['id_pembelian']; ?>">Ulasan</a>
			
				<?}?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

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
