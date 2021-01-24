<h2 class="text-center">Form Tambah Data Mandor</h2>
<div class="row">
<div class="col-6">
<form method="POST" enctype="multipart/form-data">


    
        <div class="form-grup">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" required="">
        </div>
        <div class="form-grup">
            <label>Alamat</label>
            <textarea name="alamat" id="" cols="10" class="form-control" rows="6"></textarea>
        </div>

        <div class="form-grup">
            <label>Tlpn</label>
            <input type="number" class="form-control" name="tlpn" required="">
        </div>
    </div><br>
    <fieldset>
        <legend>Akses Login</legend>
        <label for="name">Name</label>
        <input type="text" name="username" id="name" class="form-control" placeholder="input mandor username" />
        <label for="country">Password</label>
        <input type="text" name="password" id="country" class="form-control" placeholder="input mandor passrod" />
    </fieldset>
    <button class="btn btn-primary" name="simpan">Simpan</button>
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
	if (isset($_POST['simpan'])) {
		if ($_POST['nama']=="") {
			echo "<script>alert('harap isi nama');</script>";
		} elseif ($_POST['alamat']=="") {
            echo "<script>alert('harap isi alamat');</script>";
        } elseif ($_POST['tlpn']=="") {
            echo "<script>alert('harap isi tlpn');</script>";
        } elseif ($_POST['username']=="") {
            echo "<script>alert('harap isi username');</script>";
        } elseif ($_POST['password']=="") {
			echo "<script>alert('harap isi password');</script>";
		} else {
			$koneksi->query("INSERT INTO mandor (nama,alamat,tlpn,username,password,status) VALUES ('$_POST[nama]','$_POST[alamat]','$_POST[tlpn]','$_POST[username]','$_POST[password]','1')");
			echo "<script>alert('Data Berhasil Ditambahkan');</script>";
			echo "<script>location='index.php?halaman=mandor';</script>";
		}
	}
?>