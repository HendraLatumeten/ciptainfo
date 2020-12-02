<?php
include 'koneksi.php';
//ambil rata-rata jumlah rating
$q      = $koneksi->query("SELECT AVG(rate) AS jml FROM t_rating")->fetch_assoc();
$hasil  = ceil($q['jml']);

//cek ip user
$cek    = $koneksi->query("SELECT * FROM `t_rating` WHERE ipuser = '" . md5($_SERVER['REMOTE_ADDR']) . "'");

if ($cek->num_rows > 0) {
    $cek = $cek->fetch_assoc();
    $c   = $cek['rate'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rating System</title>
    <style>
        @import url(./fonts/font-awesome/css/font-awesome.css);

        form,
        label {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 20px;
        }

        .content {
            width: 408px;
            border: 1px #ccc solid;
            padding: 15px;
            margin: auto;
            height: 200px;
        }

        .rating {
            border: none;
            float: left;
        }

        .rating>input {
            display: none;
        }

        .rating>label::before {
            margin: 5px;
            font-size: 1.25em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        .rating>label {
            color: #ddd;
            float: right;
        }

        .rating>input:checked~label,
        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            color: #f7d106;
        }

        .rating>input:checked+label:hover,
        .rating>input:checked~label:hover,
        .rating>label:hover~input:checked~label,
        .rating>input:checked~label:hover~label {
            color: #fce873;
        }

        h4 {
            font-weight: normal;
            margin-top: 40px;
            margin-bottom: 0px;
        }

        #hasil {
            font-size: 20px;
        }

        #star {
            float: left;
            padding-right: 20px;
        }

        #star span {
            padding: 3px;
            font-size: 20px;
        }

        .on {
            color: #f7d106
        }

        .off {
            color: #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <div id="star">
                <?php
                for ($i = 0; $i < $hasil; $i++) {
                    echo '<span class="on"><i class="fa fa-star"></i></span>';
                }

                for ($i = 5; $i > $hasil; $i--) {
                    echo '<span class="off"><i class="fa fa-star"></i></span>';
                }
                ?>
            </div>

            <div id="hasil">
                Rating <?php echo $hasil . '.0'; ?>
            </div>

            <h4>Silahkan Berikan penilaian anda</h4>

            <form id='rating' class="rating">

                <input type="radio" class="rate" id="star5" name="rating" value="5" <?php if (isset($c) && $c == '5') {
                                                                                        echo 'checked';
                                                                                    } ?> />
                <label for="star5" title="Sempurna - 5 Bintang"></label>

                <input type="radio" class="rate" id="star4" name="rating" value="4" <?php if (isset($c) && $c == '4') {
                                                                                        echo 'checked';
                                                                                    } ?> />
                <label for="star4" title="Sangat Bagus - 4 Bintang"></label>

                <input type="radio" class="rate" id="star3" name="rating" value="3" <?php if (isset($c) && $c == '3') {
                                                                                        echo 'checked';
                                                                                    } ?> />
                <label for="star3" title="Bagus - 3 Bintang"></label>

                <input type="radio" class="rate" id="star2" name="rating" value="2" <?php if (isset($c) && $c == '2') {
                                                                                        echo 'checked';
                                                                                    } ?> />
                <label for="star2" title="Tidak Buruk - 2 Bintang"></label>

                <input type="radio" class="rate" id="star1" name="rating" value="1" <?php if (isset($c) && $c == '1') {
                                                                                        echo 'checked';
                                                                                    } ?> />
                <label for="star1" title="Buruk - 1 Bintang"></label>

            </form>

        </div> <!-- end content -->
    </div> <!-- end container -->

    <script type="text/javascript" src="./jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#rating .rate").click(function() {

                $.ajax({
                    url: "rating_proses.php",
                    method: "POST",
                    
                    data: {
                        rate: $(this).val()
                    },
                    success: function(obj) {
                        var obj = obj.split('|');

                        $('#star' + obj[0]).attr('checked');
                        $('#hasil').html('Rating ' + obj[1] + '.0');
                        $('#star').html(obj[2]);
                        alert("terima kasih atas penilaian anda");
                    }
                });
            });
        });
    </script>
</body>

</html>