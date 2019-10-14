<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "include/head.php"; ?>
    <title>Aïda M'DALLA Cosmétique capillaire | Produits pour cheveux qualité Professionnelle</title>
</head>
<body class="p-0 h-100">

<?php require "include/navbar.php"; ?>

<div id="carouselExampleControls" class="carousel slide carousel-fade m-0" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/01.jpg"
        alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/02.jpg"
        alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/03.jpg"
        alt="Third slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/04.jpg"
        alt="Fourth slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<?php require "include/footer.php"; ?>
    
</body>
</html>
<!-- RewriteEngine on
RewriteCond %{SERVER_PORT} 80
RewriteRule .* https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L] -->