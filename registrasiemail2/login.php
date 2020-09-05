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
<div class="container">
  <br>
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="panel panel-default">
          <div class="panel-heading" align="center">Login</div>
          <div class="panel-body">
            <?php
              session_start();
              //jika sudah login maka akan dialihkan ke home
               if (!empty($_SESSION['login'])) {
                    header("Location:index.php");
                  }                  
               include "koneksi.php";
              if (isset($_POST['login'])) {
                  $Username=$_POST['Username'];
                  $Password=$_POST['Password'];
                  //cek user terdaftar dan aktif
                   $sql_cek=mysqli_query($koneksi,"SELECT * FROM users WHERE username='".$Username."' AND password='".$Password."' AND aktif='1'") or die(mysqli_error($koneksi));
                   $r_cek=mysqli_fetch_array($sql_cek);
                   $jml_data=mysqli_num_rows($sql_cek);
                   if ($jml_data>0) {
                    //buat session login dan redirect ke halaman utama
                    $_SESSION['login']=md5($r_cek['username']);
                    $_SESSION['username']=$r_cek['username'];
                    $_SESSION['nama']=$r_cek['nama'];
                     header("Location:index.php");
                   }else{
                    //data tidak di temukan
                     echo '<div class="alert alert-warning">
                         Username dan Password anda salah!
                        </div>';
                   }
                }

            ?>
            <form class="form-horizontal" method="POST">
              <div class="form-group">
                <label class="control-label col-sm-3" for="Username">Username:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="Username" name="Username">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="Password">Password:</label>
                <div class="col-sm-9">          
                  <input type="password" class="form-control" id="Password" name="Password">
                </div>
              </div>
              <div class="form-group">        
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                </div>
              </div>
            </form>
            Tidak punya akun? <a href="register.php">Register</a>
          </div>
        </div>      
    </div>
  </div>
</div>
</body>
</html>
