<?php

include "header.php";
include "menu.php";
?>

<?php

if (!isset($_SESSION["pelanggan"])) {
}
?>

<div id="page-title">

    <div id="page-title-inner">

        <!-- start: Container -->
        <div class="container">

            <h2><i class="ico-stats ico-white"></i>Profil</h2>

        </div>
        <!-- end: Container  -->

    </div>

</div>
<!-- end: Page Title -->


<div id="wrapper">
    <div class="container">
        <div class="row">
            <form name="form1" method="post" action="registrasi.php">
                <tr>
                    <td></td>
                    <td>
                        <h3>Nama : <?php echo ($_SESSION["pelanggan"]['nama']); ?></h3>
                    </td>
                </tr>
                <tr>
                    <td></td>

                    <td>
                        <h3>Email : <?php echo ($_SESSION["pelanggan"]['email']); ?></h3>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <h3>Alamat : <?php echo ($_SESSION["pelanggan"]['alamat']); ?></h3>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <h3>No Telepon : <?php echo ($_SESSION["pelanggan"]['tlp']); ?></h3>
                    </td>
                </tr>
            </form>
        </div>
    </div>
</div>



<?php
include "footer.php";
?>