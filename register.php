<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site</title>
    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="page1_unprotected.php">Page 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page2_protected.php">Page 2</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Formulaire de création de compte -->
    <div class="container mt-5">
        <h2 class="text-center">Créer un compte</h2>
        <form action="" method="post" class="mt-4">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="portable">No Portable</label>
                <input type="text" class="form-control" id="noTel" name="noTel" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
        <p class="mt-3 text-center">
            <a href="login.php">Se connecter</a>
        </p>
    </div>

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<!-- Ajout d'utilisateur dans la base de donnée si le formulaire est envoyé -->
<?php
require_once("./config/autoload.php");

use ch\comem\DbManagerCRUD;
use ch\comem\Utilisateur;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = filter_input(INPUT_POST, 'nom', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}([a-zçéèêëàâîïôùû]+|([a-zçéèêëàâîïôùû]+-[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}[a-zçéèêëàâîïôùû]+)){1,19}$/"]]);
    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}([a-zçéèêëàâîïôùû]+|([a-zçéèêëàâîïôùû]+-[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}[a-zçéèêëàâîïôùû]+)){1,19}$/"]]);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $noTel = filter_input(INPUT_POST, 'noTel', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^(\+41|0041|0){1}([1-9]{1}[0-9]{1})[0-9]{3}[0-9]{2}[0-9]{2}$/"]]);
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(32));

    $utilisateur = new Utilisateur($prenom, $nom, $email, $noTel, $password, $token, $verify = false);
    $dbManager = new DbManagerCRUD();
    $dbManager->creeTableUtilisateur();
    $dbManager->ajouteUtilisateur($utilisateur);
}
?>