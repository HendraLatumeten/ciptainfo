<?php

include "header.php";
include "menu.php";
?>
<!-- start: Page Title -->

<!-- end: Page Title -->

<!--start: Wrapper-->
<div id="wrapper">

    <!--start: Container -->
    <div class="container">

        <div class="row">
            


<link href="css/bootstrap-4.3.1.min.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<script src="js/bootstrap-4.3.1.min.js"></script>	
<script src="js/jquery.min.js"></script>		
<div class="modal-header text-center">


 

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-9 col-md-7 col-lg-12 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <form id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Step 1</strong></li>
                        <li id="personal"><strong>Step 2</strong></li>
                        <li id="payment"><strong>Step 3</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
                    </ul>
                    <!-- <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>  -->
                    <br> <!-- fieldsets -->

                
                    <!-- step1 -->

                    <?php
    $progres1 = $koneksi->query ("SELECT * FROM progres WHERE id_pembelian='$_GET[id]'");
    $progres = $progres1->fetch_assoc();
    
    $data = mysqli_query($koneksi, "SELECT * FROM progres WHERE id_pembelian='$_GET[id]'");
    ?>
    <? foreach ($data as $row){?>
        
     
    
                    <?if($row['step1'] == '1'){ ?>
                        <fieldset>
                    <div class="container">
                        <div class="form-card" style="margin-right:20px;">
                            <div class="row">
                                <div class="col-5">
                                 
                                    <p>Bukti :</p>
					<center>
                    <img id="" src="bukti_pengerjaan/<?php echo $row['foto']; ?>" width="700px">
					
                    </center>
                                </div>
                                <div class="col-5">
                                <p><?php echo $row['ket']; ?></p>
                                </div>
                            </div> 
                                <p></p>
                        </div>
                    </div> 
                    
                
                  
                    <?}?>
                    <?if($row['step2'] == '1'){ ?>
                    <input type="button" name="next" class="next action-button" value="Selanjutnya" />
                    </fieldset>
                    <?}?>
       

   
                    <?if($row['step2'] == '1'){ ?>
                        <fieldset>
                    <div class="container">
                        <div class="form-card" style="margin-right:20px;">
                            <div class="row">
                                <div class="col-5">
                                 
                                    <p>Bukti :</p>
					<center>
                    <img id="" src="bukti_pengerjaan/<?php echo $row['foto']; ?>" width="700px">
					
                    </center>
                                </div>
                                <div class="col-5">
                                <p><?php echo $row['ket']; ?></p>
                                </div>
                            </div> 
                                <p></p>
                        </div>
                    </div> 
                    
                    <?}?>
                    <?if($row['step3'] == '1'){ ?>
                    <input type="button" name="next" class="next action-button" value="Selanjutnya" />&nbsp;
                    <input type="button" name="previous" class="previous action-button-previous" value="Kembali" />
                    </fieldset>
                    
                    <?}?>
                    
                 

                    <?if($row['step3'] == '1'){ ?>
                        <fieldset>
                    <div class="container">
                        <div class="form-card" style="margin-right:20px;">
                            <div class="row">
                                <div class="col-5">
                                 
                                    <p>Bukti :</p>
					<center>
                    <img id="" src="bukti_pengerjaan/<?php echo $row['foto']; ?>" width="700px">
					
                    </center>
                                </div>
                                <div class="col-5">
                                <p><?php echo $row['ket']; ?></p>
                                </div>
                            </div> 
                                <p></p>
                        </div>
                    </div> 
                    
                    <?}?>
                        <?if($row['step3'] == '1'){ ?>
                    <input type="button" name="next" class="next action-button" value="Selanjutnya" />&nbsp;
                    <input type="button" name="previous" class="previous action-button-previous" value="Kembali" />
                    </fieldset>
                   
                   <a href="rating/index.php?&id=<?php echo $progres['id_pembelian']; ?>" class="btn btn-primary">Rating</a>
                    
                    <?}?>


                   
   

           
    <? } ?>
    <fieldset>
     
           

                 

                </form>
                <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>Finish</strong></h2> <br>
                            <div class="row justify-content-center">
                            <? include 'rating/index.php'; ?>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">Thank You</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>

             
            </div>
        </div>
    </div>
</div>



<style>
* {
    margin: 0;
    padding: 0
}

html {
    height: 100%
}

p {
    color: grey
}

#heading {
    text-transform: uppercase;
    color: #673AB7;
    font-weight: normal
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

.form-card {
    text-align: left
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform input,
#msform textarea {
    padding: 8px 15px 8px 15px;
    border: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    background-color: #ECEFF1;
    font-size: 16px;
    letter-spacing: 1px
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #673AB7;
    outline-width: 0
}

#msform .action-button {
    width: 100px;
    background: #673AB7;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 0px 10px 5px;
    float: right
}

#msform .action-button:hover,
#msform .action-button:focus {
    background-color: #311B92
}

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    background-color: #000000
}

.card {
    z-index: 0;
    border: none;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #673AB7;
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left
}

.purple-text {
    color: #673AB7;
    font-weight: normal
}

.steps {
    font-size: 25px;
    color: gray;
    margin-bottom: 10px;
    font-weight: normal;
    text-align: right
}

.fieldlabels {
    color: gray;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #673AB7
}

#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f13e"
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f007"
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f030"
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #673AB7
}

.progress {
    height: 20px
}

.progress-bar {
    background-color: #673AB7
}

.fit-image {
    width: 100%;
    object-fit: cover
}
</style>
<script>
function step1() {
    alert("helo");
}
</script>
<script>
$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;
    
setProgressBar(current);

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(++current);
});

$(".previous").click(function(){

// if ($(".next").click() == TRUE) {
//     window.$(".next")Enabled;
// }
current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});
</script>
        </div>
    </div>
</div>


        <?php
include "footer.php";
?>
     
     <!-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      Modal content-->
      <!-- <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div> -->
        <script src='https://www.google.com/recaptcha/api.js'></script>
        </body>

        </html>