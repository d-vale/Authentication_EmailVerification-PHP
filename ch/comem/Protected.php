<?php
//Vérifier si l'utilisateur est connecté et a accès à la page
session_start();

if (!isset($_SESSION['email'])) {
    echo "<div class='alert alert-danger' role='alert'> Tu n'as pas accés au contenu de cette page</div>";
    echo '<div class="mt-4 text-center">
    <a href="register.php" class="btn btn-primary">Créer compte</a>
    <a href="login.php" class="btn btn-secondary">Login</a>
    </div>';
    exit;
}
?>
