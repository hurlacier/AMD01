<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-white z-depth-3 border-bottom fixed-top scrolling-navbar">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="index.php"><img id="logo" src="img/logo.png" alt="logo"></a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav mx-auto">
      <li class="nav-item">
        <a class="nav-link font-weight-bold" href="shampooing.php">Shampooings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold" href="soin.php">Soins</a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold" href="">traitements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold" href="spray.php">Coiffants</a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold" href="coffrets.php">Coffrets</a>
      </li>
    </ul>

    <?php
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            // On teste si une session de 'User' est déjà active
            // Si oui on affiche le message de bienvenue et le bouton de déconnection
            if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
                if($_SESSION['user_id'] != $_GET['profile']){
                  $_GET['page'];
                  header("Location:?page=".$_GET['page']."&profile=".$_SESSION['user_id']."");
                  // urlencode($_GET['profile']) === $_SESSION['user_id'];
                }else{
                  echo '<ul class="navbar-nav ">
                        <li class="nav-item dropdown">
                          <div class=" d-flex flex-column"  id="navbarDropdownMenuLink" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                            <i class="nav-link fas fa-2x fa-user text-center"></i>
                            <p class="font-weight-bold text-center">'.$_SESSION['user_name'] .'</p>
                          </div>
                          <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">';
                          ?>
                            <a class="dropdown-item" href="settings.php?profile=<?= $_SESSION['user_id'] ?>">Paramètre de Compte</a>
                          <?php 
                          echo '  <a class="dropdown-item" href="traitements/deconnexion.php">Deconnexion</a>
                          </div>
                        </li>
                        <li class="nav-item ml-5 mr-3">
                          <i class="nav-link fas fa-2x fa-shopping-bag"></i>
                        </li>
                      </ul>';
                }
            }else{
              echo '<ul class="navbar-nav ">
                      <li class="nav-item">
                        <a class="nav-link border-right" href="login.php">Se connecter</a>
                      </li>
                      <li class="">
                        <a class="nav-link" href="inscription.php">S\'incrire</i></a>
                      </li>
                      <li class="nav-item ml-5 mr-3">
                        <i class="fas fa-2x fa-shopping-bag nav-link"></i>
                      </li>
                    </ul>';
            }
        ?>
  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->