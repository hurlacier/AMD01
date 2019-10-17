<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "include/head.php"; ?>
    <title>Aïda M'DALLA Cosmétique capillaire | Paramètres de compte</title>
</head>
<body class="p-0 h-100">
<?php require "include/navbar.php"; ?>

<main class="min-vh-100 d-flex justify-content-center align-items-center">
<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
?>
        <nav class="">
            <p>coucou <?= $_SESSION['user_name'].' '. $_SESSION['user_names'];?>
        </nav>
<?php
    }else{
        header("Location:login.php?Message=9");
    }
?>
</main>

<?php require "include/footer.php"; ?>
    
</body>
</html>