<?php 
$id_mitra=$_SESSION['mitra']['id_mitra'];
$ambil = $koneksi->query("SELECT * FROM mitra WHERE id_mitra='$id_mitra'");
$detail = $ambil->fetch_assoc();
?>
<h2 class="text-center">Profil mitra</h2>
<br><br>
<table class="table">
	<tr>
		<td>Nama</td>
		<td> : </td>
		<td><?php echo $detail['nama_mitra']; ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td> : </td>
		<td><?php echo $detail['email_mitra']; ?></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td> :</td>
		<td><?php echo $detail['alamat_mitra']; ?></td>
	</tr>
	<tr>
		<td>No Telpon</td>
		<td> : </td>
		<td><?php echo $detail['tlp_mitra']; ?></td>
	</tr>
</table>
<a href="index.php?halaman=ubah_profil&id=<?php echo $id_mitra ?>" class="btn btn-primary">Ubah Profil</a>
<br>