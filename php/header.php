<?php 
session_start();
$bdd = mysqli_connect("localhost", "root", "", "blog");

// Connexion //

if(isset($_POST['formconnexion'])) {

$loginconnect = ($_POST['loginconnect']);
$mdpconnect = ($_POST['mdpconnect']);
$res = mysqli_query($bdd,"SELECT * FROM utilisateurs");
$array= mysqli_fetch_all($res,MYSQLI_ASSOC);

foreach($array as $key =>$value)

if ($mdpconnect == $value['password'] && $loginconnect == $value['login']) {
   $_SESSION['login'] = $loginconnect;
   header ('Location: ./php/profil.php');
}

if($mdpconnect!=$value['password']) {
   echo 'Mauvais mot de passe';
}
}

if(isset($_POST['deco'])) {
    session_start();
    session_destroy();
    header('Location: ./blog/php/connexion.php');
}

// Header //

?>
<nav class="header">

    <ul>
<!-- Si pas connecté -->
        <?php
        if (!isset($_SESSION['login'])) {
            echo "<li><a href='../index.php'>Accueil</a></li>";
            echo "<li><a href='./php/inscription.php'>Inscription</a></li>";
            echo "<li><a href='./php/connexion.php'>Connexion</a></li>";
            echo "<select name='cat'>";
            echo "<option>Catégories</option>";
            echo "<option>Apéritifs</option>";
            echo "<option>Entrée</option>";
            echo "<option>Plats</option>";
            echo "<option>Désserts</option>";
        }
        ?>
<!-- Si connecté -->        
        <?php

        if (isset($_SESSION['login'])) {
        echo "<li><a href='../index.php'>Accueil</a></li>";
        echo "  <li><a href='./php/profil.php'>Mon profil</a></li>";
        echo "<select name='cat'>";
        echo "<option>Catégories</option>";
        echo "<option>Apéritifs</option>";
        echo "<option>Entrée</option>";
        echo "<option>Plats</option>";
        echo "<option>Désserts</option>";
        echo '<form method="POST" action="">
        <input type="submit" name="deco" value="deconnexion"/> 
    </form>';
        } else {
            echo "";
        }
// Si modérateur //

        if(isset($_SESSION['login'  == 'Moderateur'])) {
        echo "<li><a href='./php/creer-article.php'";
        }
// Si admin //
        if(isset($_SESSION['login'  == 'Admin'])) {
            echo "<li><a href='./php/admin'";
            }
        ?>
        </ul>
<!-- Connexion header -->        
        <?php
        if (!isset($_SESSION['login'])) {
        echo '<div id="form">
            <form method="POST" action="">
                <div class="inp">
                    <input  type="text" name="loginconnect" placeholder="Pseudo"/>
                    <input  type="password" name="mdpconnect" placeholder="Mot de passe"/>
                </div>
                <div class="inp2">
                    <input type="submit" name="formconnexion" value="Se connecter !"/>
                </div>
            </form>
    <p>Pas encore <a href="./php/inscription.php">inscrit</a> ?</p>
                </div>';
            }
                ?>
</nav>