<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box
        }

        body {
            font-family: "Lato", sans-serif;
        }

        /* Style the tab */
        .tab {
            float: left;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            width: 30%;
            height: 500px;
        }

        /* Style the buttons inside the tab */
        .tab button {
            display: block;
            background-color: inherit;
            color: black;
            padding: 22px 16px;
            width: 100%;
            border: none;
            outline: none;
            text-align: left;
            cursor: pointer;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current "tab button" class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            float: left;
            padding: 0px 12px;
            border: 1px solid #ccc;
            width: 70%;
            border-left: none;
            height: 500px;
        }
    </style>
    <?php 
	$progres1 = $koneksi->query("SELECT * FROM progres WHERE id_pembelian='$_GET[id]' AND step1='1' ");
    $progresA = $progres1->fetch_assoc();
    
    $progres2 = $koneksi->query("SELECT * FROM progres WHERE id_pembelian='$_GET[id]' AND step2='1' ");
    $progresB = $progres2->fetch_assoc();
    
    $progres3 = $koneksi->query("SELECT * FROM progres WHERE id_pembelian='$_GET[id]' AND step3='1' ");
	$progresC = $progres3->fetch_assoc();
    ?>
</head>

<body>
<a href="index.php?halaman=project" class="btn btn-primary"><- Kembali</a>
    <h2>Progres Pekerjaan</h2>

    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Step1')" id="defaultOpen">Step1</button>
        <button class="tablinks" onclick="openCity(event, 'Step2')">Step2</button>
        <button class="tablinks" onclick="openCity(event, 'Step3')">Step3</button>
    </div>

    <div id="Step1" class="tabcontent">
        <h3>15%</h3>
        <?if ($progresA['step1'] == NULL) {?>
        <form method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="form-group">
                    <div class="row">
                        <input type="file" id="file" name="foto" required onchange="return fileValidation()" />
                        <div class="col-12">

                            <div id="imagePreview"></div><br>
                            <p>Ket.</p>
                            <textarea name="ket" class="form-group" cols="90" rows="3" required></textarea>


                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success" name="step1">Simpan</button>
        </form>
        <?}else{?>
        <p>Bukti :</p>
        <img id="" src="../bukti_pengerjaan/<?php echo $progresA['foto']; ?>" width="300px">
        <p><?php echo $progresA['ket']; ?></p>
        <?}?>
        <?
                                    if (isset($_POST["step1"]))
                                    {
                                        $namabukti = $_FILES['foto']['name'];
                                        $lokasibukti = $_FILES['foto']['tmp_name'];
                                        $namafiks = "step1_".date("YmdHis").$namabukti;
                                        move_uploaded_file($lokasibukti, "../bukti_pengerjaan/$namafiks");
                                    
                                        $idpem = $_GET["id"];
                                        $ket = $_POST["ket"];
                                        $tgl = date("Y-m-d");
                                       
                                    
                                        $koneksi->query("INSERT INTO progres (id_pembelian,ket,foto,step1,step2,step3,presentase,date) VALUES ('$idpem','$ket','$namafiks','1',NULL,NULL,'15','$tgl')");
                                       
                                        echo "<script>alert('Berhasil Disimpan');</script>";
                                        echo "<script>location='index.php?halaman=project';</script>";
                                    }
        ?>
    </div>

    <div id="Step2" class="tabcontent">
        <h3>50%</h3>
        <?if ($progresB['step2'] == NULL) {?>
        <form method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="form-group">
                    <div class="row">
                        <input type="file" id="file" name="foto" required onchange="return fileValidation()" />
                        <div class="col-12">

                            <div id="imagePreview"></div><br>
                            <p>Ket.</p>
                            <textarea name="ket" class="form-group" cols="90" rows="3" required></textarea>


                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success" name="step2">Simpan</button>
        </form>
        <?}else{?>
        <p>Bukti :</p>
        <img id="" src="../bukti_pengerjaan/<?php echo $progresB['foto']; ?>" width="300px">
        <p><?php echo $progresB['ket']; ?></p>
        <?}?>
        <?
                                    if (isset($_POST["step2"]))
                                    {
                                        $namabukti = $_FILES['foto']['name'];
                                        $lokasibukti = $_FILES['foto']['tmp_name'];
                                        $namafiks = "step2_".date("YmdHis").$namabukti;
                                        move_uploaded_file($lokasibukti, "../bukti_pengerjaan/$namafiks");
                                    
                                        $idpem = $_GET["id"];
                                        $ket = $_POST["ket"];
                                        $tgl = date("Y-m-d");
                                       
                                    
                                        $koneksi->query("INSERT INTO progres (id_pembelian,ket,foto,step1,step2,step3,presentase,date) VALUES ('$idpem','$ket','$namafiks',NULL,'1',NULL,'50','$tgl')");
                                       
                                        echo "<script>alert('Berhasil Disimpan');</script>";
                                        echo "<script>location='index.php?halaman=project';</script>";
                                    }
        ?>
    </div>

    <div id="Step3" class="tabcontent">
        <h3>35%</h3>
        <?if ($progresC['step3'] == NULL) {?>
        <form method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="form-group">
                    <div class="row">
                        <input type="file" id="file" name="foto" required onchange="return fileValidation()" />
                        <div class="col-12">

                            <div id="imagePreview"></div><br>
                            <p>Ket.</p>
                            <textarea name="ket" class="form-group" cols="90" rows="3" required></textarea>


                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success" name="step3">Simpan</button>
        </form>
        <?}else{?>
        <p>Bukti :</p>
        <img id="" src="../bukti_pengerjaan/<?php echo $progresC['foto']; ?>" width="300px">
        <p><?php echo $progresC['ket']; ?></p>
        <?}?>
        <?
                                    if (isset($_POST["step3"]))
                                    {
                                        $namabukti = $_FILES['foto']['name'];
                                        $lokasibukti = $_FILES['foto']['tmp_name'];
                                        $namafiks = "step3_".date("YmdHis").$namabukti;
                                        move_uploaded_file($lokasibukti, "../bukti_pengerjaan/$namafiks");
                                    
                                        $idpem = $_GET["id"];
                                        $ket = $_POST["ket"];
                                        $tgl = date("Y-m-d");
                                       
                                    
                                        $koneksi->query("INSERT INTO progres (id_pembelian,ket,foto,step1,step2,step3,presentase,date) VALUES ('$idpem','$ket','$namafiks',NULL,NULL,'1','35','$tgl')");
                                       
                                        echo "<script>alert('Berhasil Disimpan');</script>";
                                        echo "<script>location='index.php?halaman=project';</script>";
                                    }
        ?>
    </div>

    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

        function fileValidation() {
            var fileInput = document.getElementById('file');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
                fileInput.value = '';
                return false;
            } else {
                //Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('imagePreview').innerHTML = '<img src="' + e.target.result +
                            '"/>';
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>

</body>

</html>