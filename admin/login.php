<?php 
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","ciptainfo");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Login Admin</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

    <div>
       
        <div class="row">
                <br><br>
                <h2 class="text-center">Login Admin CIPTAINFO</h2>
                <br>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Silahkan Lakukan Login</strong></h3>
                    </div>
                    <div class="panel-body">
						<form method="post" action="">
							
                                <div class="form-group">
                                 <label>Username</label>
                                 <input class="form-control" name="username" type="text">
                                </div>
                                <div class="form-group">
                                	<label>Password</label>
                                    <input class="form-control" name="password" type="password">
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="button" value="Login" name="login">
                            

                        </form>
                        <?php
                        if(isset($_POST['login']))
                        {
                        	$ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[username]' AND password='$_POST[password]'");
                            $pecah = $ambil->fetch_assoc();
                        	$yangcocok = $ambil->num_rows;
                        	if ($yangcocok==1) {
                                $_SESSION['admin']=$pecah['id_admin'];
                        		echo "<br>";
                        		echo "<div class='alert alert-info'>Login Sukses</div>";
                        		echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                        	}
                        	else {
                        		echo "<br>";
                        		echo "<div class='alert alert-danger'>Login Gagal</div>";
                        		//echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                        	}
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>