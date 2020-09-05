
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mari Belajar Coding</title>
  <meta name="author" content="https://www.maribelajarcoding.com/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" align="center">
  <br>
    <?php
         include "koneksi.php";
         $token=$_GET['t'];
         $sql_cek=mysqli_query($koneksi,"SELECT * FROM customer WHERE token='".$token."' and aktif='0'");
         $jml_data=mysqli_num_rows($sql_cek);
         if ($jml_data>0) {
             //update data users aktif
             mysqli_query($koneksi,"UPDATE customer SET aktif='1' WHERE token='".$token."' and aktif='0'");
             echo '<div class="alert alert-success">
                        Akun anda sudah aktif, silahkan <a href="login.php">Login</a>
                        </div>';
         }else{
                    //data tidak di temukan
                     echo '<div class="alert alert-warning">
                        Invalid Token!
                        </div>';
                   }
    ?>
</div>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mari Belajar Coding</title>
  <meta name="author" content="https://www.maribelajarcoding.com/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
  session_start();
  if (empty($_SESSION['login'])) {
    header("Location:login.php");
  }
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">MariBelajarCoding</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>     
    </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  <h3>Selamat Datang, <?=$_SESSION['nama']?></h3>
 
</div>
</body>
</html>

