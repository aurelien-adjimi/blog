<?php
session_start();
$bdd = mysqli_connect("localhost", "root", "", "blog");


if (isset ($_POST['inscription'])) {

    $login = $_POST['login'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if (!empty( $_POST['login']) && !empty($_POST['mail']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO utilisateurs(login, email, password, id_droits) VALUES ('$login', '$mail','$password', 1)"; 

    $sel = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login = '".$_POST['login']."'");
    if (mysqli_num_rows($sel)) {
        exit('Ce login existe déjà');

    }   
        if ($password == $password2) {
            mysqli_query($bdd,$sql);
            header ('Location: ../php/connexion.php');
            }
            
            if ($password != $password2) {
                echo 'Vérifiez votre mot de passe';
            }
    }
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
            <input  type="submit" name="inscription" value="Je m'inscris !" />
        </div>
</div>
    </main>

    <footer>
        <?php require 'footer.php' ?>
    </footer>
</body>
</html>