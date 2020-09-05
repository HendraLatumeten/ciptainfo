<?php
  $sql = mysqli_query($koneksi, "SELECT * FROM produk");
  $data = $sql->fetch_assoc();
?>

<link rel="stylesheet" type="text/css" href="css/footer.css">
  <div class="footer">
    <div class="container">
     <h1 class="text-center">Profil</h1>
     <div class="sliderfig">
      <ul id="flexiselDemo1">
    
      <li>
        <img src="img/profil/1.jpg" alt=" " class="img-responsive" width="200px"/>
      </li>
      <li>
        <img src="img/profil/2.jpg" alt=" " class="img-responsive" width="200px"/>
      </li>
      <li>
        <img src="img/profil/3.jpg" alt=" " class="img-responsive" width="200px"/>
      </li>
      <li>
        <img src="img/profil/4.jpg" alt=" " class="img-responsive" width="200px"/>
      </li>
      <li>
        <img src="img/profil/5.jpg" alt=" " class="img-responsive" width="200px"/>
      </li>

       <li>
        <img src="img/profil/6.jpg" alt=" " class="img-responsive" width="200px"/>
      </li>
      <li>
        <img src="img/profil/7.jpg" alt=" " class="img-responsive" width="200px"/>
      </li>
      <li>
        <img src="img/profil/8.jpg" alt=" " class="img-responsive" width="200px"/>
      </li>
      <li>
        <img src="img/profil/9.jpg" alt=" " class="img-responsive" width="200px"/>
      </li>
      <li>
        <img src="img/profil/10.jpg" alt=" " class="img-responsive" width="200px"/>
      </li>
      
    </ul>
  </div>

  <script src="js/jquery-1.8.2.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/flexslider.js"></script>
<script src="js/carousel.js"></script>
<script src="js/jquery.cslider.js"></script>
<script src="js/slider.js"></script>
<script def src="js/custom.js"></script>

  <script type="text/javascript">
   $(window).load(function() {
    $("#flexiselDemo1").flexisel({
     visibleItems: 4,
     animationSpeed: 1000,
     autoPlay: true,
     autoPlaySpeed: 3000,
     pauseOnHover: true,
     enableResponsiveBreakpoints: true,
     responsiveBreakpoints: {
      portrait: {
       changePoint:480,
       visibleItems: 1
     },
     landscape: {
       changePoint:640,
       visibleItems:2
     },
     tablet: {
       changePoint:768,
       visibleItems: 3
     }
   }
 });

  });
</script>
<script type="text/javascript" src="js/jquery.flexisel.js"></script>
</div>
</div>