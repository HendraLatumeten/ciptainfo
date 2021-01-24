<?php 
	$ambil = $koneksi->query("SELECT * FROM mandor WHERE id_mandor='$_GET[id]'");
	$pecah = $ambil->fetch_assoc();
?>
<h2 class="text-center">Form Tambah Data Mandor</h2>
<div class="row">
<div class="col-6">
<form method="POST" enctype="multipart/form-data">


    
        <div class="form-grup">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="<? echo $pecah['nama'];?>" required="">
        </div>
        <div class="form-grup">
            <label>Alamat</label>
            <textarea name="alamat" id="" cols="10" class="form-control" rows="6"><? echo $pecah['alamat'];?></textarea>
        </div>

        <div class="form-grup">
            <label>Tlpn</label>
            <input type="number" class="form-control" value="<? echo $pecah['tlpn'];?>" name="tlpn" required="">
        </div>
    </div><br>
    <fieldset>
        <legend>Akses Login</legend>
        <label for="name">Name</label>
        <input type="text" name="username" id="name" class="form-control" value="<? echo $pecah['username'];?>" placeholder="input mandor username" />
        <label for="country">Password</label>
        <input type="password" name="password" id="country" class="form-control" value="<? echo $pecah['password'];?>" placeholder="input mandor passrod" />
    </fieldset>
    <button class="btn btn-primary" name="ubah">Ubah</button>
    <a href="index.php?halaman=mandor" class="btn btn-danger" title="Kembali">Kembali</a>
    <br>
    
    </div>
</form>
<style>
    fieldset {
        border: 1px solid #DDDDDD;
        display: inline-block;
        font-size: 14px;
        font-family: Arial, Helvetica;
        padding: 1em 2em;
    }

    legend {
        background: #BFD48C;
        /* Hijau */
        color: #FFFFFF;
        /* Putih */
        margin-bottom: 10px;
        padding: 0.5em 1em;
    }
</style>
<?php
	if (isset($_POST['ubah'])) {
		
	
		$koneksi->query("UPDATE mandor SET nama='$_POST[nama]',alamat='$_POST[alamat]',tlpn='$_POST[tlpn]',username='$_POST[username]',password='$_POST[password]' WHERE id_mandor='$_GET[id]'");
			
	

			

		echo "<script>alert('Data Telah Diperbarui');</script>";
		echo "<script>location='index.php?halaman=mandor';</script>";
	}
?>