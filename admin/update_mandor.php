<?php if (isset($_POST['updatemandor'])) {
			
            $id = $_GET['id'];
            $mandor = $_POST['mandor'];
            $koneksi->query("UPDATE pembelian SET id_mandor = '$mandor' WHERE id_pembelian = '$id'");
        
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
            } ?>