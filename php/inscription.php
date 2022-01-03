<?php

if(isset($_POST['inscription'])) {
    $sign = new Inscription($_POST['login'], $_POST['password'], $_POST['password_confirmation'], $_POST['email'], 1);
 }

if (isset($_POST['deco'])) {
    session_start();
    session_destroy();
    header('location: ../connexion.php');
    exit;
       }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Inscription</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
</head>

<body>
<header>
<?php require 'header.php' ?>
    </header>

    <main>

<div id="form" align="center">
    <form method="POST" action="">
    <label for="login">Login :</label>
        <br>
            <input type="text" placeholder="Tapez votre login" id="login" name="login" value="<?php if(isset($login)) { echo $login; } ?>" />
    <br><br>
    <label for="mail">E-mail:</label>
        <br>
            <input type="mail" placeholder="Entrez votre mail" id="mail" name="mail"/>
    <br><br>
    <label for="password">Mot de passe :</label>
        <br>
            <input type="password" placeholder="Votre mot de passe" id="mdp" name="password" />
    <br><br>
    <label for="password2">Confirmation du mot de passe :</label>
        <br>
            <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="password2" />
    <br><br>
         <div class="inp">
            <input  type="submit" name="inscription" value="Je m'inscris" />
        </div>
</div>
    </main>

    <footer>
        <?php require 'footer.php' ?>
    </footer>
</body>
</html>