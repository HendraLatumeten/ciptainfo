
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- start: Meta -->
  <meta charset="utf-8">
  <title>CIPTA INFO | Arsitek dan Kontraktor Rumah Kayu</title> 
  
    <link href="css/menu.css" rel="stylesheet">
</head>
<body>
    
  <!--start: Header -->
<header>
<center><a class="brand" href="index.php"><img src="img/logos/logo1.jpg" alt="Logo"></a></center>
<center><text><h2>CIPTA INFO | Arsitek dan Kontraktor Rumah Kayu</h2></text></center>
    
    <!--start: Container -->  
<div id="menu-kanan">
  <div class="container">
  <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="produk.php">Produk Kami</a></li>
          <li><a href="keranjang.php">Tentang Kami</a></li>
             <?php if (isset($_SESSION["pelanggan"])):?>
          <li><a href="produk.php">Produk Custom</a></li>
          <li><a href="profil.php" >Profil</a></li>
          <li><a href="status_pembelian.php" >Status Pembelian</a></li>
          <li><a href="logout.php">Logout</a></li>
             <?php else: ?>
          <li><a href="login.php">Login</a></li>
             <?php endif ?>
      </ul>
    </div>
  </div>
</header>


</body>
</html>
