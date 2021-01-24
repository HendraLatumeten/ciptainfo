<h2 class="text-center">Data Mandor</h2>
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
			<th title="urutkan berdasarkan nama ">Nama</th>
			<th title="urutkan berdasarkan alamat">Alamat</th>
			<th title="urutkan berdasarkan tlpn">Tlpn</th>
            <th title="urutkan berdasarkan tlpn">Status</th>
			<th><center>Aksi</center></th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM mandor"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) {?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $pecah['alamat']; ?></td>
			<td><?php echo $pecah['tlpn']; ?></td>
            <td><?php 
            if ($pecah['status'] == 1) {
                echo "<i>Aktif</i>";
            }else{
                echo "<b>Tidak Aktif</b>";
            }
            ?></td>
			<td><center>
				<a href="index.php?halaman=ubah_data_mandor&id=<?php echo $pecah['id_mandor']; ?>" class="btn btn-primary" title="Lihat" >Ubah</a>
				<a href="index.php?halaman=hapus_data_mandor&id=<?php echo $pecah['id_mandor']; ?>" class="btn btn-danger" title="Hapus"  onclick="return confirm('yakin ingin hapus data?')">Hapus</a>
                <?
                    if ($pecah['status'] == 1) {?>
                        	<a href="index.php?halaman=nonaktif_mandor&id=<?php echo $pecah['id_mandor']; ?>" class="btn btn-alert" title="Lihat" onclick="return confirm('yakin ingin Nonaktifkan akun?')" >NonAktifvasi</a>
                   <? }else{?>
                    <a href="index.php?halaman=aktif_mandor&id=<?php echo $pecah['id_mandor']; ?>" class="btn btn-alert" title="Lihat"onclick="return confirm('yakin ingin Aktifkan akun?')" >Aktifasi</a>
                    <?}
                ?>
			</center>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>

	</tbody>
</table>

<a href="index.php?halaman=tambah_data_mandor" title="Tambah Data Mandor" class="btn btn-primary">Tambah Mandor</a>

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